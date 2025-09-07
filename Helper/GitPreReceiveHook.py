#!/usr/bin/env python3
import sys
import os
import kanboard

parent_dir = os.path.abspath(os.path.join(os.path.dirname(__file__), ".."))
sys.path.insert(0, parent_dir)
from GitParser import GitParser, print_error




# Fails push if:
# 1) branch/commit has task id that doesn't exist
# 2) commit is being moved to a column that it cannot move to
# 3) commit has a column it's being moved to but no task_id
def main():
    kb = kanboard.Client('http://host.docker.internal:8000/jsonrpc.php', 'admin', 'admin')

    git_parser = GitParser()
    git_parser.parse_stdin()

    for branch in git_parser.branch_list:
        if branch.new_branch:
            if branch.task_id and not kb.get_task(task_id=branch.task_id):
                print_error(f"New branch {branch.branch_name} doesn't have valid task_id in name")
                sys.exit(1)

        for commit in branch.commit_list:
            if commit.task_id:
                if not kb.get_task(task_id=commit.task_id):
                    print_error(f"New commit '{commit.message}' doesn't have valid task_id in name")
                    sys.exit(1)

                if commit.new_column_title and not kb.can_task_move_to_column(task_id=commit.task_id,
                                                                              column_title=commit.new_column_title):
                    print_error(f"New commit '{commit.message}' doesn't have valid column to move to in name")
                    sys.exit(1)

            elif commit.new_column_title:
                print_error(f"New commit '{commit.message}' is moving columns but doesn't have a task_id")
                sys.exit(1)


if __name__ == "__main__":
    main()
