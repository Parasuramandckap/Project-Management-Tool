
<html>
    <head>
        <title>task create</title>
    </head>
    <body>
        <h3>Created a Task</h3>
        <form action="/created-task" method="post" enctype="multipart/form-data">
            <div>
                <label>Task Name</label>
                <input type="text" name="task-name" placeholder="task name">
            </div>
            <div>
                <label>Task images</label>
                <input type="file" name="task-images[]" multiple="multiple" >
            </div>
            <div>
                <label>Task Description</label>
                <input type="text" name="task-description" placeholder="description">
            </div>
            <input type="hidden" name="tasks-projectId" value="<?php echo $proId?>">
            <button type="submit">create a task</button>
        </form>
    </body>
</html>