import re
import json
import sys
import subprocess
import os

RED = "\033[91m"
RESET = "\033[0m"


def print_error(message):
    print(f"{RED}{message}{RESET}", file=sys.stderr)


class Commit:
    message_pattern = re.compile(
        r'^(?:(?:#(?P<task_id>[0-9]+))\s*)?'  # optional #123 → captures only 123
        r'(?:\[(?P<column_title>[^\]]+)\]\s*)?'  # optional @column → captures only column name
        r'(?P<desc>.+)$'
    )

    def __init__(self, commit_hash, message, author, date, link, branch_name):
        self.hash = commit_hash
        self.message = message
        self.author = author
        self.date = date
        self.link = link
        self.branch_name = branch_name

        self.task_id = None
        self.new_column_title = None
        self.desc = None

        match = re.match(self.message_pattern, self.message)
        if match:
            self.task_id = int(match.group('task_id')) if match.group('task_id') else None
            self.new_column_title = match.group('column_title')
            self.desc = match.group('desc')

    def to_string(self):
        return json.dumps(self, default=lambda o: o.__dict__)


class Branch:
    branch_pattern = re.compile(r'^(?P<task_id>\d+)-[a-z0-9-]+$')

    def __init__(self, branch_name, new_branch=False):
        self.commit_list = []
        self.branch_name = branch_name
        self.new_branch = new_branch

        self.task_id = Branch.name_to_task_id(branch_name)

    def add_commit(self, commit):
        if not commit.task_id:
            commit.task_id = self.task_id

        self.commit_list.append(commit)

    @staticmethod
    def name_to_task_id(branch_name):
        match = re.match(Branch.branch_pattern, branch_name)
        if match:
            return int(match.group('task_id'))
        return None


class GitParser:
    ROOT_URL = os.getenv("GITEA_ROOT_URL", "http://ROOT_URL_UNAVAILABLE")

    def __init__(self):
        self.branches = []

    def parse_stdin(self):
        self.branch_list = []
        for line in sys.stdin:
            oldrev, newrev, refname = line.strip().split()

            # not a branch in this case
            if not refname.startswith("refs/heads/"):
                continue

            branch_name = refname.replace("refs/heads/", "")
            # the branch is new if oldrev is 40 zeros
            new_branch = (oldrev == "0" * 40)

            branch = Branch(branch_name, new_branch=new_branch)

            rev_list = subprocess.run(
                ['git', 'rev-list', f'{oldrev}..{newrev}'],
                capture_output=True,
                text=True,
                check=True
            ).stdout.strip().splitlines()

            # iterating list of pushed commits in given branch
            for commit_hash in rev_list:
                commit = self.parse_commit_hash(commit_hash, branch_name)
                if not commit.task_id:
                    commit.task_id = branch.task_id
                branch.add_commit(commit)

            self.branch_list.append(branch)

    def parse_commit_hash(self, commit_hash, branch_name):
        message = subprocess.run(
            ['git', 'log', '-1', '--pretty=%B', commit_hash],
            capture_output=True,
            text=True,
            check=True
        ).stdout.strip()

        author = subprocess.run(
            ['git', 'log', '-1', '--pretty=%an', commit_hash],
            capture_output=True,
            text=True,
            check=True
        ).stdout.strip()

        date = subprocess.run(
            ['git', 'show', '-s', '--format=%cI', commit_hash],
            capture_output=True,
            text=True,
            check=True
        ).stdout.strip()

        link = GitParser.create_commit_link(commit_hash)

        return Commit(commit_hash, message, author, date, link, branch_name)

    @staticmethod
    def create_commit_link(commit_hash):
        repo_owner = os.getenv("GITEA_REPO_OWNER")
        repo_name = os.getenv("GITEA_REPO_NAME")

        # sometimes those env variables are not set
        # then we can get those values from the working directory path
        path_parts = os.getcwd().strip(os.sep).split(os.sep)
        if len(path_parts) >= 2:
            repo_owner = repo_owner or path_parts[-2]
            repo_name = repo_name or path_parts[-1]
            if repo_name.endswith(".git"):
                repo_name = repo_name[:-4]

        if not repo_owner or not repo_name:
            return "unknown repo owner/name"

        return f"{GitParser.ROOT_URL}/{repo_owner}/{repo_name}/commit/{commit_hash}"