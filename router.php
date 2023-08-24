<?php
require "controller/UserController.php";

class Router
{
    public $routes = [];
    public $controller = [];
    public function __construct()

    {
        $this->controller =  new UserController();
    }

    public function get($uri, $controller) {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => 'GET',
        ];

    }

    public function post($uri, $controller) {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => 'POST',
        ];

    }

    public function route()
    {
        foreach ($this->routes as $route){
            if($route["uri"] === $_SERVER["REQUEST_URI"]){
                $action = $route["controller"];
               switch ($action){
                   case "index":
                       $this->controller->index();
                       break;
                   case "create-project":
                       $this->controller->createProject($_POST,$_FILES);
                       break;
                   case "list-task":
                       $this->controller->list_task($_POST["projects-id"]);
                       break;
                   case "create-task":
                       $this->controller->taskPage($_POST);
                       break;
                   case "created-task":
                       $this->controller->createTask($_POST,$_FILES);
                       break;
                   case "task-details":
                      $this->controller->readTask($_POST["task-id"]);
                      break;
                   case "delete-task":
                       $this->controller->deleteTask($_POST["delete-id"]);
                       break;
                   case "deleted-task":
                       $this->controller->Deleted_task($_POST["projects-id"]);
                       break;
                   case "undeleted-task":
                       $this->controller->undeletedTask($_POST["undeleted-task"]);
                       break;
               }
            }
        }
    }
}