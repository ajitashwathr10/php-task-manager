<?php
    include('constants.php');
    $list_id_url = $_GET['list_id'];
?>

<!DOCTYPE html>
<html lang = "en-US">
    <head>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
        <meta http-equiv = "X-UA-Compatible" content = "ie=edge">
        <title>Task Manager</title>
        <link rel="stylesheet" href="<?php echo SITEURL; ?>css/style.css" />
    </head>
    <body>
        <div class = "container">
            <h1>Task Manager</h1>
            <div class = "menu">
                <a href = "<?php echo SITEURL; ?>">Home</a>
                <?php
                    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME) or die(mysqli_error($conn));
                    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn));
                    $sql = "SELECT * FROM tbl_lists";
                    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                    if($res == true) {
                        while($row = mysqli_fetch_assoc($res)) {
                            $list_id = $row['list_id'];
                            $list_name = $row['list_name'];
                            ?>
                            <a href = "<?php echo SITEURL; ?>list-task.php?list_id=<?php echo $list_id; ?>"><?php echo $list_name; ?></a>
                            <?php
                        }
                    }
                ?>
                <a href = "<?php echo SITEURL; ?>manage-list.php">Manage Lists</a>
            </div>
            <div class = "all-task">
                <a class = "btn-primary" href = "<?php echo SITEURL; ?>add-task.php">Add Task</a>
                <table class = "tbl-full">
                    <tr>
                        <th>S No.</th>
                        <th>Task Name</th>
                        <th>Priority</th>
                        <th>Deadline</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); 
                        $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
                        $sql = "SELECT * FROM tbl_tasks WHERE list_id = $list_id_url";
                        $res = mysqli_query($conn, $sql);
                        if($res == true) {
                            $count_rows = mysql_num_rows($res);
                            if($count_rows > 0) {
                                while($row = mysqli_fetch_assoc($res)) {
                                    $task_id = $row['task_id'];
                                    $task_name = $row['task_name'];
                                    $priority = $row['priority'];
                                    $deadline = $row['deadline'];
                                    ?>
                                    <tr>
                                        <td>1.</td>
                                        <td><?php echo $task_name; ?></td>
                                        <td><?php echo $priority; ?></td>
                                        <td><?php echo $deadline; ?></td>
                                        <td>
                                            <a href = "<?php echo SITEURL; ?>update-task.php?task_id=<?php echo $task_id; ?>">Update</a>
                                            <a href = "<?php echo SITEURL; ?>delete-task.php?task_id=<?php echo $task_id; ?>">Delete</a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan = "5">No Task Added Yet</td>
                                </tr>
                                <?php
                            }
                        }
                    ?>
                </table>
            </div>
        </div>
    </body>
</html>

         
                    
