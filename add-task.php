<?php
    include('constants.php');
?>
<!DOCTYPE html>
<html lang = "en-US">
    <head>
        <meta charset = "UTF-8">    
        <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
        <meta http-equiv = "X-UA-Compatible" content = "ie=edge">
        <title>Task Manager</title>
        <link rel = "stylesheet" href = "<?php echo SITEURL; ?>css/style.css">
    </head>
    <body>
        <div class = "container">
            <h1>Task Manager</h1>
            <a class = "btn-secondary" href = "<?php echo SITEURL; ?>">Home</a>
            <h3>Add Task Page</h3>
            <p>
                <?php
                    if(isset($_SESSION['add_fail'])) {
                        echo $_SESSION['add_fail'];
                        unset($_SESSION['add_fail']);
                    }
                ?>
            </p>
            <form action = "<?php echo SITEURL; ?>add-task.php" method = "POST">
                <form method = "POST" action = "">
                    <table class = "tbl-half">
                        <tr>
                            <td>Task Name: </td>
                            <td><input type = "text" name = "task_name" placeholder = "Type your Task Name" required = "required" /> </td>
                        </tr>
                        <tr>
                            <td>Task Description: </td>
                            <td><textarea name = "task_description" placeholder = "Type Task Description"></textarea></td>
                        </tr>
                        <tr>
                            <td>Select List:</td>
                            <td>
                                <select name = "list_id">
                                    <?php
                                        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
                                        $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
                                        $sql = "SELECT * FROM tbl_lists";
                                        $res = mysqli_query($conn, $sql);
                                        if($res == true) {
                                            while($row = mysqli_fetch_assoc($res)) {
                                                $list_id = $row['list_id'];
                                                $list_name = $row['list_name'];
                                                ?>
                                                <option value = "<?php echo $list_id; ?>"><?php echo $list_name; ?></option>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <option value = "0">None</option>p
                                            <?php
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Priority: </td>
                            <td>
                                <select name = "priority">
                                    <option value = "High">High</option>
                                    <option value = "Medium">Medium</option>
                                    <option value = "Low">Low</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Deadline: </td>
                            <td>
                                <input type = "date" name = "deadline"></td>
                        </tr>
                        <tr>
                            <td><input class = "btn-primary btn-lg" type = "submit" name = "Submit" value = "SAVE"/></td>
                        </tr>
                    </table>
                </form>
            </form>
        </div>
    </body>
</html>

<?php
    if(isset($_POST['submit'])) {
        $task_name = $_POST['task_name'];
        $task_description = $_POST['task_description'];
        $list_id = $_POST['list_id'];
        $priority = $_POST['priority'];
        $deadline = $_POST['deadline'];
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
        $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
        $sql = "INSERT INTO tbl_tasks SET
            task_name = '$task_name',
            task_description = '$task_description',
            list_id = '$list_id',
            priority = '$priority',
            deadline = '$deadline'
        ";
        $res = mysqli_query($conn, $sql);
        if($res == true) {
            $_SESSION['add'] = "Task Added Successfully";
            header('location:'.SITEURL.'index.php');
        } else {
            $_SESSION['add_fail'] = "Failed to Add Task";
            header('location:'.SITEURL.'add-task.php');
        }
    }
?>



                                    
                        
                                



        
