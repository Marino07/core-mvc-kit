<?php

namespace marinopusic\PhpMvcCore\middlewares;

use marinopusic\PhpMvcCore\Application;
use marinopusic\PhpMvcCore\exception\ForbiddenException;

class AuthMiddleware extends BaseMiddleware
{
    public array $actions = [];

    /**
     * @param array $actions
     */
    public function __construct(array $actions= [])
    {
        $this->actions = $actions;
    }


    public function execute()
    {
        if(Application::isGuest()){
            if(empty($this->actions) || in_array(Application::$app->controller->action,$this->actions)){
                throw new ForbiddenException();
            }
        }
    }
}