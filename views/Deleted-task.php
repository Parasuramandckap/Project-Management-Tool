<html>
    <head>
        <title>Deleted task</title>
    </head>
    <body>
        <h1>Deleted Tasks</h1>
        <?php foreach ($deletedTask as $deletedTasks) :?>
            <h2>Project Name : <?php echo $deletedTasks->projects_name?></h2>
            <h3>Task Name : <?php echo $deletedTasks->tasks_name?></h3>
            <img src="<?php echo $deletedTasks->tasks_images?>">
            <p>Task Description : <?php echo $deletedTasks->tasks_description?></p>
        <?php endforeach;?>
        <?php if (isset($_SESSION["deleted-id"])):?>
            <form action="/undeleted-task" method="post">
                <input type="hidden" name="undeleted-task" value="<?php echo $deletedTasks->projects_id ?>">
                <button type="submit">Undeleted Task
                    <?php foreach ($undeletedCount as $undeletedCounts):?>
                        <span><?php echo $undeletedCounts->undeleted?></span>
                    <?php endforeach;?>
                </button>
            </form>
            <a href="/">back to projects</a>
        <?php endif;?>
    </body>
</html>