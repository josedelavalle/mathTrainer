<?php
@session_start();
if(!isset($_REQUEST)) {
    echo 'error';
} else {
    $userName = $_REQUEST['username'];
    $passWord = $_REQUEST['password'];
    
    $connect = mysqli_connect("localhost", "jdelaval_root", "d3l4v4ll3", "jdelaval_mathdb");
    //$connect = mysqli_connect("localhost", "root", "root", "jdelaval_mathdb");
    
    $sql = "SELECT id, password, highscore FROM user WHERE username='" . $userName . "'";
    
    $result = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        
        $id = $row["id"];
        $passWordHash = $row["password"];
        $highscore = $row["highscore"];
        if (password_verify($passWord, $passWordHash)) {
            $list = array('id'=>$id, 'highscore'=>$highscore);
            $_SESSION['userId']=$id;
            $cookie_name = "id";
            $cookie_value = $id;
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
            $_SESSION['highscore']=$highscore;
            $cookie_name = "highscore";
            $cookie_value = $highscore;
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
        } else {
            $id=$passWordHash;
            $list = array('id'=>$id, 'highscore'=>$highscore);
        }
    } else {
        $id = null;
        $list = array('id'=>$id, 'highscore'=>mysqli_connect_error());
    }
    mysqli_close($connect);

    $c = json_encode($list);

    echo $c;

}
?>