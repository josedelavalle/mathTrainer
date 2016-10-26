<?php

if(!isset($_REQUEST)) {
    echo 'error';
} else {
    $userName = $_REQUEST['username'];
    $passWord = $_REQUEST['password'];
    $password_hash = password_hash($passWord, PASSWORD_BCRYPT);

    $email = $_REQUEST['email'];
    $connect = mysqli_connect("localhost", "jdelaval_root", "d3l4v4ll3", "jdelaval_mathdb");
    //$connect = mysqli_connect("localhost", "root", "root", "jdelaval_mathdb");
    
    $sql = "SELECT id FROM user WHERE username='".$userName."'";
    
    $result = mysqli_query($connect, $sql);
    if (mysqli_connect_errno()) {
        echo "Failed to connect to database: " . mysqli_connect_error();
    } else {
        if (mysqli_num_rows($result) == 0) {
            $sql = "SELECT id FROM user WHERE email='".$email."'";
            $result = mysqli_query($connect, $sqlw;
            if (mysqli_num_rows($result) == 0) {

                $sql = "INSERT INTO user (username, email, password, highscore) VALUES ('".$userName."','".$email."','".$password_hash."','0,0,0,0,0,0')";
                
                $result = mysqli_query($connect, $sql);
                
                $sql = "SELECT id FROM user WHERE username = '".$userName."'";
                
                $result = mysqli_query($connect, $sql);

                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_array($result);
                    
                    $id = $row["id"];
                    $cookie_name = "id";
                    $cookie_value = $id;
                    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
                    
                }
                echo "Success";
            } else {
                echo "Email already registered";
            }
        } else {
            echo "Username not available";
        }
    }
    
    /*if ($result) {
        echo "Success";
    } else {
        echo mysqli_connect_error();
    }*/
    

    
    mysqli_close($connect); 
}
?>