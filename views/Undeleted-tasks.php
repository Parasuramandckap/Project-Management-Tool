<html>
    <head>
        <title>
            Undeleted Tasks
        </title>
    </head>
    <body>
        <h1>Undeleted Tasks</h1>
        <?php foreach ($undeletedTask as $undeletedTasks):?>
        <h2>Project Name : <?php echo $undeletedTasks->projects_name?></h2>
        <h3>Task Name : <?php  echo $undeletedTasks->tasks_name?></h3>
        <img src="<?php echo $undeletedTasks->tasks_images?>">
        <p>Task Description : <?php echo $undeletedTasks->tasks_description?></p>
        <?php endforeach; ?>
        <a href="/">back to projects</a>
    </body>
</html>