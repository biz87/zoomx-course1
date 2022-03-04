<?php

namespace Zoomx\Controllers\Api;

use modUser;
use modX;
use Zoomx\Controllers\Controller;

class BaseController extends Controller
{
    public function __construct(modX $modx)
    {
        parent::__construct($modx);
        $this->adminAuth();
    }

    private function adminAuth()
    {
        $username = 'zoomxuser';
        $password = 'rvYzxdG4xW';

        $response = $this->modx->runProcessor(
            'security/login',
            array('username' => $username, 'password' => $password)
        );
        if ($response->isError()) {
            $this->modx->log(modX::LOG_LEVEL_ERROR, print_r($response->response, 1));
        }
        $user = $this->modx->getObject(modUser::class, array('username' => $username));
        if ($user) {
            $this->modx->user = $user;
            $this->modx->initialize('web');
        }
    }
}
