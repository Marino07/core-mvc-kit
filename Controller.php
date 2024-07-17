<?php

namespace app\core;

use app\core\middlewares\BaseMiddleware;

class Controller
{
    public string $action = '';
    protected array $middlewares = [];
    public string $layout = 'main';
    public function render($view,$params = []){
        return Application::$app->view->renderView($view,$params);
    }
    public function setLayout($layout){
        $this->layout = $layout;

    }
    public function registerMiddleWare(BaseMiddleware $middleware){
        $this->middlewares[] = $middleware;
    }
    /**
     * @return array
     */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }


}