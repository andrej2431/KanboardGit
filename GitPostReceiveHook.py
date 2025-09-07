#!/usr/bin/env python3
import sys
import os
import kanboard


parent_dir = os.path.abspath(os.path.join(os.path.dirname(__file__), ".."))
sys.path.insert(0, parent_dir)
from GitParser import GitParser, print_error


def main():
    kb = kanboard.Client('http://host.docker.internal:8000/jsonrpc.php', 'admin', 'admin')

    git_parser = GitParser()
    git_parser.parse_stdin()

    for branch in git_parser.branch_list:
        for commit in branch.commit_list:
            kb.add_commit(commit=commit.to_string())
            if commit.new_column_title and commit.task_id:
                try:
                    kb.move_task_to_column(task_id=commit.task_id, column_title=commit.new_column_title)
                except:
                    print_error(f"Could not move task {commit.task_id} to column {commit.new_column_title}")


if __name__ == "__main__":
    main()
