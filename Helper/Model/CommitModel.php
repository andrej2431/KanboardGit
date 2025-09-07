<?php 
namespace Kanboard\Plugin\KanboardGit\Model;

use Kanboard\Model\ProjectFileModel;
use Kanboard\Model\ProjectMetadataModel;
use Kanboard\Model\TaskModel;
use Kanboard\Core\Base;

class CommitModel extends Base {

    const TABLE = 'git_commits';

    public function getAllCommits()
    {
        return $this->db->table(self::TABLE)->findAll();
    }
    
    public function addCommit(string $commit){
        if (empty($commit)){
            throw new Exception('Missing required parameters: commit(string)');
        }

        error_log($commit);
        $commit = json_decode($commit, true);

        $values = array(
            'hash' => $commit["hash"],
            'message' => $commit["message"],
            'author' => $commit["author"],
            'date' => $commit["date"],
            'link' => $commit["link"],
            'branch_name' => $commit["branch_name"],
            'task_id' => (int) $commit["task_id"],
            'description' => $commit["desc"],
            'new_column_title' => $commit["new_column_title"],
            'replaced' => false,
        );
    
        return $this->db->table(self::TABLE)->persist($values);
    }

    public function getCommitsByTask($task){
        return ["commits" => $this->db->table(self::TABLE)->eq('task_id', $task['id'])->findAll()];
    }
}