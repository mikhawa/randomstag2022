<?php


class UserManager implements ManagerInterface
{

    protected \PDO $connect;

    public function __construct(\PDO $db)
    {
        $this->connect = $db;
    }

    public function connectUser(UserModel $user):bool{

        $sql = "SELECT * FROM user WHERE username = ?";
        $request = $this->connect->prepare($sql);

        try {
            $request->execute([$user->getUsername()]);

        }catch (\Exception $e ){
            return $e->getMessage();

        }
        if($request->rowCount()==0){
            return false;

        }else{
            $userConnect = $request->fetch(PDO::FETCH_ASSOC);
            if(password_verify($user->getUserpwd(),$userConnect['userpwd'])){
                $goodUser = new UserModel($userConnect);
                return $this->connectSession($goodUser);
            }else{
                return false;
            }
        }
    }

    private function connectSession(UserModel $user): bool{
        $_SESSION['myidsession']= session_id();
        $_SESSION['username']=$user->getUsername();
        $_SESSION['iduser']=$user->getIduser();
        $_SESSION['perm']=$user->getPerm();
        $_SESSION['clefunique']=$user->getClefunique();
        $_SESSION['usermail']=$user->getThemail();

        return true;
    }

    public static function disconnect(): bool{

        $_SESSION = array();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();
        return true;
    }

}