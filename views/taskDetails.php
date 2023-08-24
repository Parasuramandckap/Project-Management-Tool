<html>
    <head>
        <title>task details</title>
        <link rel="stylesheet" href="style1.css">
    </head>
<body>
    <div class="main">
        <h2>Task Details</h2>
        <?php foreach ($perticularTask as $task_details ): ?>
        <h2><?php echo $task_details->tasks_name?></h2>
        <img class="img" src="<?php echo $task_details->tasks_images?>">
        <p><?php echo  $task_details->tasks_description?></p>
        <form action="/delete-task" method="post">
            <input type="hidden" name="delete-id" value="<?php echo $task_details->id?>">
            <button type="submit">delete task</button>
        </form>
        <?php endforeach;?>
    </div>
</body>
</html>