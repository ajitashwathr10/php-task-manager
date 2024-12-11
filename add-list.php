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
            <a class = "btn-secondary" href = "<?php echo SITEURL; ?>manage-list.php">Manage Lists</a>

            <h3>Add List Page</h3>
            <p>
                <?php
                    if(isset($_SESSION['add_fail'])) {
                        echo $_SESSION['add_fail'];
                        unset($_SESSION['add_fail']);
                    }
                ?>
            </p>
            <form action = "<?php echo SITEURL; ?>add-list.php" method = "POST">
                <form method = "POST" action = "">
                    <table class = "tbl-half">
                        <tr>
                            <td>List Name: </td>
                            <td>
                                <input type = "text" name = "list_name" placeholder = "Enter List Name">
                            </td>
                        </tr>
                        <tr>
                            <td colspan = "2">
                                <input type = "submit" name = "submit" value = "Add List" class = "btn-primary">
                            </td>
                        </tr>
                    </table>
                </form>
            </form>
        </div>  
    </body>
</html>

<?php
    if(isset($_POST['submit'])) {
        $list_name = $_POST['list_name'];
        $list_description = $_POST['list_description'];
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
        $db_select = mysqli_select_db($conn, DB_NAME);
        $sql = "INSERT INTO tbl_lists SET 
            list_name = '$list_name',
            list_description = '$list_description'
        ";
        $res = mysqli_query($conn, $sql);
        if($res == true) {
            $_SESSION['add'] = "List Added Successfully";
            header('location:'.SITEURL.'manage-list.php');   
            
        } else {
            $_SESSION['add_fail'] = "Failed to Add List";
            header('location:'.SITEURL.'add-list.php');
        }       
    }
?>

