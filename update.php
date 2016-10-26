<?php

if(!isset($_REQUEST)) {
    echo 'error';
} else {
    $id = $_REQUEST['id'];
    $newhighscore = $_REQUEST['newhighscore'];

    $cookie_name = "highscore";
            $cookie_value = $newhighscore;
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
    $connect = mysqli_connect("localhost", "jdelaval_root", "d3l4v4ll3", "jdelaval_mathdb");
    // $connect = mysqli_connect("localhost", "root", "root", "jdelaval_mathdb");
    
    
    
    $sql = "UPDATE user SET highscore='".$newhighscore."' WHERE id = '".$id."'";
    //echo $sql;
    $result = mysqli_query($connect, $sql);
    mysqli_close($connect);
    if ($result) {
        echo "New Record! Good Job!";
    } else {
        echo "Error";
    }
    

    

}
?>