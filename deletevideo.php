<?php
// deletevideo.php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $video_id = $_POST['video_id'];
    require 'connection.php';

    $stmt ="DELETE FROM tutorial WHERE id = '$video_id'";
    $delete = mysqli_query($connection,$stmt);

}
?>
