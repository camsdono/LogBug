<?php

    $con = mysqli_connect('localhost', 'root','','bug_tracker');

    if(!$con) {
        echo "Please check database connection";
    }
?>