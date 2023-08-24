<?php
require "router.php";

$controller = new Router();
$controller->post("/","index");
$controller->post("/list-task","list-task");
$controller->post("/create-project","create-project");
$controller->post("/create-task","create-task");
$controller->post("/created-task","created-task");
$controller->post("/task-details","task-details");
$controller->post("/delete-task","delete-task");
$controller->post("/deleted-task","deleted-task");
$controller->post("/undeleted-task","undeleted-task");
$controller->route();