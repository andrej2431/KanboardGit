<?php

namespace Kanboard\Plugin\KanboardGit\Controller;

use Kanboard\Controller\BaseController;
use Kanboard\Core\Plugin\Directory;


class KanboardGitController extends \Kanboard\Controller\BaseController
{
    public function config()
    {
        $this->response->html($this->helper->layout->config('KanboardGit:config/index', [
            'title' => 'KanboardGit Plugin Settings'
        ]));
    }
}