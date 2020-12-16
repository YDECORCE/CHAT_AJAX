<?php
    session_start();
    $json_response = json_encode($_SESSION['nom']);
    echo $json_response;
?>