<?php

namespace Kanboard\Plugin\KanboardGit\Schema;

use PDO;

const VERSION = 1;

function version_1(PDO $pdo)
{
    $pdo->exec('
        CREATE TABLE IF NOT EXISTS git_commits (
            id INT AUTO_INCREMENT PRIMARY KEY,
            hash VARCHAR(64) NOT NULL,
            message TEXT NOT NULL,
            author VARCHAR(255) NOT NULL,
            date DATETIME NOT NULL,
            link VARCHAR(512),
            branch_name VARCHAR(255),
            task_id INT,
            new_column_title VARCHAR(255),
            description TEXT,
            replaced TINYINT(1) DEFAULT 0,

            UNIQUE KEY unique_hash (hash),
        ) ENGINE=InnoDB CHARSET=utf8');
}