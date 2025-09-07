<li <?= $this->app->checkMenuSelection('KanboardGitController', 'config') ?>>
    <?= $this->url->link(t('Kanboard Git'), 'KanboardGitController', 'config', array('plugin' => 'KanboardGit')) ?>
</li>