<?php
    $conn = mysqli_connect('localhost', 'Manoj', 'prabhu@123', 'my_favourites');
    if(!$conn){
        echo 'Connection error: ' . mysqli_connect_error();
    }
?>