<?php
session_start();
// var_dump($_SESSION);
require_once "chat_function.php";


if(isset($_GET['action'])&&($_GET['action']=='send')){
    $id=$_SESSION['ID_user'];
    $message=$_GET['message'];
    addapost($id,$message);
 }

 if(isset($_GET['action'])&&($_GET['action']=='read')){
    readallpost();
 }

