<?php

namespace Kanboard\Plugin\KanboardGit\Helper;

use Kanboard\Core\Base;
use Exception;

class KanboardGitHelper extends Base
{
    public function addCommitToTask(array $commit, int $task_id){
        if (empty($commit) || empty($task_id)){
            throw new Exception('Missing required parameters: commit(array), task_id (int)');
        }

        $task = $this->taskFinderModel->getById($task_id);
        if (empty($task)) {
            throw new Exception("Task {$task_id} not found");
        }
        
        $commits_json = $this->taskMetadataModel->get($task['id'], 'commits', '[]');
        $commits = json_decode($commits_json, true);
        
        $this->taskMetadataModel->save($task_id, ['' => 'something']);
    }

    public function getTaskCommits($task, $project){
        $commits_json = $this->taskMetadataModel->get($task['id'], 'commits', '[]');
        $commits = json_decode($commits_json, true);
        return ['commits' => $commits];
    }

    public function canTaskMoveToColumn(int $task_id, string $column_name)
    {
        if (empty($task_id) || empty($column_name)) {
            throw new Exception('Missing required parameters: task_id (int), column_name (string)');
        }

        $task = $this->taskFinderModel->getById($task_id);
        if (empty($task)) {
            throw new Exception("Task {$task_id} not found");
        }

        $column_id = $this->columnModel->getColumnIdByTitle($task['project_id'], $column_name);
    
        if (empty($column_id)) {
            throw new Exception("Column '{$column_name}' not found in project {$task['project_id']}");
        }

        $result = $this->taskPositionModel->movePosition($task['project_id'], $task_id, $column_id,1, $task['swimlane_id']);

        if (!$result) {
            throw new Exception("Failed to move task {$task_id} to column '{$column_name}'");
        }

        // Success response
        return [
            'status'     => 'success',
            'task_id'    => $task_id,
            'column_id'  => $column_id,
            'column_name'=> $column_name,
        ];
        
    }   

}
