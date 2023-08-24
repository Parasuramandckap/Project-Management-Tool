<!DOCTYPE html>
<html>
<head>
    <title>Projects</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" />
    <script src="https://kit.fontawesome.com/52d2b40c3f.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="views/style.css">
</head>
<body>
<div class="main">
    <div class="mainHeading">
    <h1>Project Management Tool</h1>
    </div>
    <div class="left-side">
        <div class="allProjects">
            <h1 class="allProjectsHead">All Projects</h1>
        </div>
        <button id="add">Add New Project</button>
        <div class="projectList">
            <?php foreach ($project as $projects):?>
                <form action="/list-task" method="post">
                    <input type="hidden" name="projects-id" value="<?php echo $projects->id?>">
                    <button class="btn project" id="proName" type="submit"><?php echo $projects->projects_name?></button>
                </form>
            <?php endforeach;?>
        </div>
    </div>

        <div class="createProjectInputs">

            <form action="/create-project" method="post" class="form hide" enctype="multipart/form-data">

                <input type="text" name="project-name" placeholder="project-name">
                <input type="file" name="pro-file[]" multiple="multiple">
                <button type="submit" class="createbtn">create project</button>
            </form>

        </div>



    <div class="display-div">
        <?php foreach ($tasks as $tasks_list):?>
        <form action="/task-details" method="post">
            <input type="hidden" name="task-id" value="<?php echo $tasks_list->id?>">
            <button class="taskname" type="submit"><?php echo  $tasks_list->tasks_name?></button>
        </form>
        <?php endforeach;?>

        <?php if (isset($_SESSION["projects-id"])):?>
                <form action="/create-task" method="post">
                    <input type="hidden" name="project-id" value="<?php echo $_SESSION["projects-id"]["id"]?>">
                    <button type="submit" class="createTask">create a task</button>
                </form>
                <form action="/deleted-task" method="post">
                    <input type="hidden" name="projects-id" value="<?php echo $_SESSION["projects-id"]["id"]?>">
                    <button type="submit" class="deleteTask">deleted task
                        <?php foreach ($Deletedcount as $deleted_task): ?>
                        <span><?php echo $deleted_task->deleted_task?></span>
                        <?php endforeach;?>
                    </button>
                </form>
        <?php endif;?>
        <div class="images-pro">
            <?php foreach ($projectImage as $projectImages):?>
                <img src="<?php echo $projectImages->images_path?>">
            <?php endforeach;?>
        </div>
    </div>
</div>
    <script type="text/javascript">
        let add = document.querySelector("#add")
        add.addEventListener("click",()=>{
            let form  = document.querySelector(".form")
            form.classList.toggle("hide")
        })
        let project = document.querySelectorAll(".project")
        let show = document.querySelector(".display")
        project.forEach(element=>{
            element.addEventListener("click",()=>{
                show.classList.toggle("hide")
            })
        })
    </script>
</body>
</html>














































































































<!--<html>-->
<!--    <head>-->
<!--        <title>main page</title>-->
<!--    </head>-->
<!--    <body>-->
<!--        <button id="new">Add New</button>-->
<!--        <form action="/create" method="post" id="form" enctype="multipart/form-data">-->
<!--            project-name-->
<!--            <br>-->
<!--            <input type="text" name="pro-name" placeholder="project-name">-->
<!--            <div>-->
<!--                create task-->
<!--                <br>-->
<!--                <input type="text" name="task-name" placeholder="task name">-->
<!--                <br>-->
<!--                <input type="file" name="task-image">-->
<!--                <br>-->
<!--                <input type="text" name="task-description" placeholder="task-description">-->
<!--                <br>-->
<!--                <button type="submit" id="submit">create task</button>-->
<!--            </div>-->
<!--        </form>-->
<!--    </body>-->
<!--    <script type="text/javascript">-->
<!--        let form = document.querySelector("form")-->
<!--        window.addEventListener("DOMContentLoaded",()=>{-->
<!---->
<!--            form.style.visibility = "hidden"-->
<!--        })-->
<!--        let submit =  document.querySelector("#new")-->
<!--        let count = 0;-->
<!--        submit.addEventListener("click",()=>{-->
<!--            form.style.visibility = "visible";-->
<!--        })-->
<!---->
<!--    </script>-->
<!--</html>-->