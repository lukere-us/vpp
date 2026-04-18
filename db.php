<?php

class DB {

    public $error;

    function connect() {
        $con = mysqli_connect(host, user, pwd, db);
        if ($con) {
            return $con;
        } else {
            echo $this->error = "Failed to connect to MySQL: " . mysqli_connect_error();
            return false;
        }
    }

    function login($uname, $pwd) {
        $con = $this->connect();
        if ($con) {
            $sql = "SELECT id  FROM tbl_users WHERE user_name='" . $uname . "' AND password='" . md5($pwd) . "' AND status=1";
            $Res = $con->query($sql);
            if ($Res->num_rows > 0) {
                $obj = $Res->fetch_object();
                $_SESSION["cus_id"] = $obj->id;
                $_SESSION["cus_user_name"] = $obj->user_name;
                return true;
            }
        }
        return false;
    }

    function logout() {
        session_destroy();
        header("Location:" . base_url); /* Redirect browser */
        exit;
    }

    function redirect($url) {
        header("Location:" . $url); /* Redirect browser */
    }

    function is_login() {
        if (isset($_SESSION["cus_id"]) && !empty($_SESSION["cus_id"])) {
            return true;
        }
        return false;
    }

}

?>