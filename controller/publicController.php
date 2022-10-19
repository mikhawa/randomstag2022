<?php

if(isset($_POST['username'],$_POST['userpwd'])){
    $user = new UserModel(["username"=>$_POST['username'],"userpwd"=>$_POST['userpwd']]);
    var_dump($user);
    echo password_hash($user->getUserpwd(), PASSWORD_DEFAULT);
    echo "<hr>".uniqid(true);

}


// View
require_once "../view/loginView.php";