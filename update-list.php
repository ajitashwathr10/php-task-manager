<?php
    include('constants.php');
    if(isset($_GET['list_id'])) {
        $list_id = $_GET['list_id'];
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
        $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
        $sql = "SELECT * FROM tbl_lists WHERE list_id = $list_id";
        $res = mysqli_query($conn, $sql);
        if($res == true) {
            $row = mysqli_fetch_assoc($res);
            $list_name = $row['list_name'];
            $list_description = $row['list_description'];
        } else {
            header('location:'.SITEURL.'manage-list.php');
        }
    }
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
            <a class = "btn-secondary" href = "<?php echo SITEURL; ?>manage-list.php">Manage Lists<a>
                