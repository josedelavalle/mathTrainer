<?php
 session_start();
 unset($_SESSION['userId']);
 if (isset($_COOKIE['id'])) {
    unset($_COOKIE['id']);
    setcookie('id', '', time() - 3600, '/'); // empty value and old timestamp
}
if (isset($_COOKIE['highscore'])) {
    unset($_COOKIE['highscore']);
    setcookie('highscore', '', time() - 3600, '/'); // empty value and old timestamp
}
?>