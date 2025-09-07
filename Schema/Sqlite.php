<?php

namespace Kanboard\Plugin\KanboardGit\Schema;

use PDO;

const VERSION = 1;

function version_1(PDO $pdo)
{
    error_log("IM HERE");
    $pdo->exec('
    CREATE TABLE IF NOT EXISTS git_commits (
        id INTEGER PRIMARY KEY,
        hash TEXT NOT NULL UNIQUE,
        message TEXT NOT NULL,
        author TEXT NOT NULL,
        date TEXT NOT NULL,
        link TEXT,
        branch_name TEXT,
        task_id INTEGER,
        new_column_title TEXT,
        description TEXT,
        replaced INTEGER DEFAULT 0 
    )');
}