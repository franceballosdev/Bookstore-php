<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>

<div class="container">
<?php

    /* at the top of 'check.php' */
    if ($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
        /* 
           Up to you which header to send, some prefer 404 even if 
           the files does exist for security
        */
        header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
        die( header( 'location: '.APPURL.'' ));
    }

    if(!isset($_SESSION['username'])) {
        header('location: '.APPURL. "");
    }


    if(isset($_POST['delete'])) {

        $id = $_POST['id'];

        $delete = $conn->prepare("DELETE FROM cart WHERE id = '$id'");
        $delete->execute();
    }
?>



</div>
<?php require "../includes/footer.php"; ?>