<?php

namespace Kanboard\Plugin\KanboardGit\Helper;

use Kanboard\Core\Base;
use Exception;

class KanboardGitHelper extends Base
{
    public function canTaskMoveToColumn(int $task_id, string $column_title)
    {
        if (empty($task_id) || empty($column_title)) {
            throw new Exception('Missing required parameters: task_id (int), column_title (string)');
        }

        $task = $this->taskFinderModel->getById($task_id);
        if (empty($task)) {
            throw new Exception("Task {$task_id} not found");
        }

        $column_id = $this->columnModel->getColumnIdByTitle($task['project_id'], $column_title);
    
        if (empty($column_id)) {
            throw new Exception("Column '{$column_title}' not found in project {$task['project_id']}");
        }

        return true;
        
    }

    public function moveTaskToColumn(int $task_id, string $column_title)
    {
        if (empty($task_id) || empty($column_title)) {
            throw new Exception('Missing required parameters: task_id (int), column_title (string)');
        }

        $task = $this->taskFinderModel->getById($task_id);
        if (empty($task)) {
            throw new Exception("Task {$task_id} not found");
        }

        $column_id = $this->columnModel->getColumnIdByTitle($task['project_id'], $column_title);
    
        if (empty($column_id)) {
            throw new Exception("Column '{$column_title}' not found in project {$task['project_id']}");
        }

        $result = $this->taskPositionModel->movePosition($task['project_id'], $task_id, $column_id,1, $task['swimlane_id']);

        if (!$result) {
            throw new Exception("Failed to move task {$task_id} to column '{$column_title}'");
        }

        // Success response
        return [
            'status'     => 'success',
            'task_id'    => $task_id,
            'column_id'  => $column_id,
            'column_title'=> $column_title,
        ];
        
    }   

}
