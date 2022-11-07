<?php

$userManager = new UserManager($connect);

if(isset($_POST['username'],$_POST['userpwd'])){
    $user = new UserModel(["username"=>$_POST['username'],"userpwd"=>$_POST['userpwd']]);

    if($userManager->connectUser($user)){
        header("Location: ./");
        exit();
    }else{
        $error = "<p style='text-align: center'>Login ou mot de passe incorrecte.</p>";
    }

     //var_dump($user);
     //echo password_hash($user->getUserpwd(), PASSWORD_DEFAULT);
     //echo "<hr>".uniqid(true);

}


// View
require_once "../view/loginView.php";