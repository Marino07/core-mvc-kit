<?php
namespace marinopusic\PhpMvcCore;

use marinopusic\PhpMvcCore\db\Database;
use marinopusic\PhpMvcCore\db\DbModel;

class Application
{
public static string $ROOT_DIR;
public string $layout = 'main';
public string $userClass;
public Router $router;
public Request $request;
public Session $session;
public Response $response;
public Database $db;
public ?UserModel $user;
public View $view;


public static Application $app;
public ?Controller $controller = null;

public function __construct($rootPath, array $config)
{
$this->userClass = $config['userClass'];
self::$ROOT_DIR = $rootPath;
self::$app = $this;
$this->request = new Request();
$this->response = new Response();
$this->session = new Session();
$this->router = new Router($this->request, $this->response);
$this->view = new View();

$this->db = new Database($config['db']);
$primaryValue = $this->session->get('user'); // number id
if($primaryValue){
    $primaryKey = $this->userClass::PrimaryKey();
    $this->user =$this->userClass::findOne([$primaryKey => $primaryValue]);
}else{
    $this->user = null;
}

}
    public function run()
    {
        try {
            echo $this->router->resolve();
        } catch (\Exception $e) {
            $this->response->setStatusCode($e->getCode() ?: 500);
            echo $this->view->renderView('_error', [
                'exception' => $e
            ]);
        }
    }
public function getController(): Controller
{
return $this->controller;
}

public function setController(Controller $controller): void
{
$this->controller = $controller;
}

public function login(UserModel $user)
{
$this->user = $user;
$primaryKey = $user->primaryKey(); //checking id
$primaryValue = $user->{$primaryKey}; //assign number id
$this->session->set('user', $primaryValue);
return true;
}

public function logout()
{
$this->user = null;
$this->session->remove('user');
}
public static function isGuest(){
    return !self::$app->user;

}
}
