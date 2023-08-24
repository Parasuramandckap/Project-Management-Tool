<?php


class UserController extends Database{


    public function index() {

       $project =  $this->db->query("SELECT * FROM projects ");
        $project = $project->fetchAll(PDO::FETCH_OBJ);

        require "views/create.php";
    }
    public function createProject($project,$files) {

        $projectName = $project["project-name"];
        $this->db->query("INSERT INTO projects(projects_name)VALUES('$projectName')");

        $last =  $this->db->query("SELECT id as lastId from projects ORDER by id DESC LIMIT 1");
        $last = $last->fetch(PDO::FETCH_OBJ);
        $lastId = $last->lastId;

        $filecount = count($files["pro-file"]["name"]);

        for ($i=0;$i<$filecount;$i++){

            $newFilePath = "images/".$files['pro-file']['name'][$i];
            $tmpFilePath = $files['pro-file']['tmp_name'][$i];
            move_uploaded_file($tmpFilePath, $newFilePath);

            $this->db->query("INSERT INTO images(images_path,module_name,module_id)VALUES('$newFilePath','project','$lastId')");
        }



        header("location:/");
    }

    public function createTask($data,$files){


        $taskName = $data["task-name"];
        $taskDescription = $data["task-description"];
        $taskForProject = $data["tasks-projectId"];
        $count = count($files["task-images"]["name"]);


        //insert task details store in task table
     $this->db->query("INSERT INTO tasks(tasks_name,tasks_description,projects_id)VALUES('$taskName','$taskDescription','$taskForProject')");


     // Get last insert task id for stroing multiple image in images table
        $lastTask =$this->db->query("SELECT id as lastId from tasks ORDER by id DESC");
        $lastTask = $lastTask->fetch(PDO::FETCH_OBJ);
        $lastTask = $lastTask->lastId;

            //this loop used to store images file in localhost
        for ($i=0;$i<$count;$i++){
            $newPath = "images/".$files["task-images"]["name"][$i];
            $tmp_file = $files["task-images"]["tmp_name"][$i];
             move_uploaded_file($tmp_file,$newPath);
            $this->db->query("INSERT INTO images(images_path,module_name,module_id)VALUES ('$newPath','task','$lastTask')");
        }

        header("location:/");
    }
    public function list_task($id){
        $project_id =$id;


        $_SESSION["projects-id"] = [
            "id"=>$project_id
        ];

        //SELECT * from tasks JOIN images on images.module_id = tasks.id and tasks.deleted_at is null;

        $tasks= $this->db->query("SELECT * from tasks where projects_id ='$id' and deleted_at is null ");
        $tasks = $tasks->fetchAll(PDO::FETCH_OBJ);



        $project =  $this->db->query("SELECT * FROM projects ");
        $project = $project->fetchAll(PDO::FETCH_OBJ);

        $Deletedcount = $this->db->query("SELECT COUNT(id) as deleted_task FROM tasks WHERE deleted_at AND projects_id = '$project_id'");
        $Deletedcount = $Deletedcount->fetchAll(PDO::FETCH_OBJ);


       $projectImage =  $this->db->query("SELECT images_path from images where module_id = '$project_id' and module_name = 'project';");
        $projectImage = $projectImage->fetchAll(PDO::FETCH_OBJ);


        require "views/create.php";
    }
    public function taskPage($projectId){
        $proId = $projectId["project-id"];
        require "views/taskCreate.php";
    }
    public function readTask($id){

       $perticularTask =  $this->db->query("select * from tasks where id='$id'");
        $perticularTask = $perticularTask->fetchAll(PDO::FETCH_OBJ);
        require "views/taskDetails.php";
    }
    public function deleteTask($id){
        $deletedId = $id;

        $this->db->query("UPDATE tasks SET deleted_at = now() where id = '$deletedId'");
        header("location:/");
    }

    public function Deleted_task($deleted_task){


        $_SESSION["deleted-id"] = [
            "id"=>$deleted_task
        ];
         $deletedTask =  $this->db->query("SELECT * from tasks  JOIN projects WHERE tasks.projects_id ='$deleted_task' and  projects.id = '$deleted_task' AND deleted_at");
         $deletedTask = $deletedTask->fetchAll(PDO::FETCH_OBJ);

         $undeletedCount = $this->db->query("SELECT count(id) as undeleted FROM tasks WHERE projects_id = '$deleted_task' and deleted_at is null");
         $undeletedCount = $undeletedCount->fetchAll(PDO::FETCH_OBJ);

        require "views/Deleted-task.php";
    }
    public function undeletedTask($undeleted_task){

      $undeletedTask  =  $this->db->query("SELECT * from tasks  JOIN projects WHERE tasks.projects_id = '$undeleted_task' and  projects.id = '$undeleted_task' AND deleted_at is null");
      $undeletedTask = $undeletedTask->fetchAll(PDO::FETCH_OBJ);



        require "views/Undeleted-tasks.php";
    }
}

class Database
{
    public $db;

    public function __construct()
    {
        try{
            $this->db = new PDO
            (
                'mysql:host=localhost;dbname=project_management_tool',
                'dckap',
                'Dckap2023Ecommerce'
            );

        }
        catch(Exception $e){
            die("connection error");
        }
    }

}