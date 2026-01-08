<?php
    session_start();
    include_once(__DIR__ . "/classes/Db.php");
    
    session_destroy();
    header("Location: login.php");
    exit();
?>