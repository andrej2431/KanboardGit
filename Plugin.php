<?php
namespace Kanboard\Plugin\KanboardGit;

use Kanboard\Core\Plugin\Base;
use Kanboard\Core\Translator;
use Exception;
use Kanboard\Plugin\KanboardGit\Helper\KanboardGitHelper;
use Kanboard\Helper; 
use Kanboard\Plugin\KanboardGit\Model\CommitModel;

class Plugin extends Base
{
    public function initialize()
    {
        $this->helper->register('KanboardGitHelper', '\Kanboard\Plugin\KanboardGit\Helper\KanboardGitHelper');

        $this->hook->on('template:layout:css', array('template' => 'plugins/KanboardGit/Assets/css/kanboard-git.css'));
        $this->hook->on('template:layout:js', array('template' => 'plugins/KanboardGit/Assets/js/kanboard-git.js'));

        // Setting
        $this->template->hook->attach('template:config:sidebar', 'KanboardGit:config/sidebar');
        $this->route->addRoute('/settings/KanboardGit', 'KanboardGitController', 'config', 'KanboardGit');

        // Commits section in Task details

        $this->template->hook->attachCallable('template:task:show:bottom', 'KanboardGit:TaskCommits',
            fn($task, $project)=>$this->commitModel->getCommitsByTask($task));
        
        $this->api->getProcedureHandler()->withCallback('addCommit',
            fn($commit)=>$this->commitModel->addCommit($commit));

        $this->api->getProcedureHandler()->withCallback('canTaskMoveToColumn', 
            fn($task_id, $column_name)=>$this->helper->KanboardGitHelper->canTaskMoveToColumn($task_id, $column_name));
    }

    public function onStartup()
    {
        Translator::load($this->languageModel->getCurrentLanguage(), __DIR__ . '/Locale');
    }

    public function getPluginName()
    {
        return 'KanboardGit';
    }

    public function getClasses() {
        return array(
            'Plugin\KanboardGit\Model' => array(
                'CommitModel',
            )
        );
    }

    public function getPluginDescription()
    {
        return t('Kanboard plugin for integration with Git.');
    }

    public function getPluginAuthor()
    {
        return 'Andrej Thomas Dobrev';
    }

    public function getPluginVersion()
    {
        return '1.0.0';
    }

    public function getCompatibleVersion()
    {
        return '>=1.2.32';
    }

    public function getPluginHomepage()
    {
        return 'https://github.com/andrej2431/KanboardGitPlugin';
    }
}
