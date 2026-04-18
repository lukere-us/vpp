<?php

class user extends controller {

    function __construct($module) {
        parent::__construct($module);
    }

    /**
     * Display the user list
     */
    function index($reqUserType = null, $reqUserLevel = null) {
        auth::handleLogin();
        auth::isLevel1User();
        try {
            $login_model = $this->loadModel('user');
            if (!$login_model) {
                throw new Exception("object not found");
            }
            $this->view->loggedUserType = session::get('user_type');
            $this->view->render('user/index', false, false, $this->module);
        } catch (Exception $e) {
            echo 'Exception: ' . $e->getMessage() . "(model_company :line 24)";
        }
    }

    function newUser() {
        auth::handleLogin();
        auth::isLevel1User();
        $login_model = $this->loadModel('user');
        $this->view->render('user/new_user', false, false, $this->module);
    }

    function jsonCreateNewUser() {
        auth::handleLogin();
        auth::isLevel1User();
        $login_model = $this->loadModel('user');
        $login_model_comp = $this->loadModel('company');
        $res = $login_model->registerNewUser();
        if ($res) {
            $data = array('success' => true, 'error' => $this->view->renderFeedbackMessagesForJson());
            echo json_encode($data);
        } else {
            $data = array('success' => false, 'error' => $this->view->renderFeedbackMessagesForJson());
            echo json_encode($data);
        }
    }

    /**
     * Display the user login page
     */
    function login() {
        $this->view->render('user/login', false, true, $this->module);
    }

    /**
     * Display the register sccreen
     */
    function register() {

        $this->view->render('user/register', false, false, $this->module);
    }

    /**
     * The user login
     */
    function loginAction() {
        $isLogged = false;
        try {
            $login_model = $this->loadModel('user');
            if (!$login_model) {
                throw new Exception("object not found");
            }
            //Create a login model to perform the doCompanyRegister() method
            $isLogged = $login_model->doLogin();
            //Open dashbord if valid user 
            if ($isLogged) {
                Session::init();
                $userType = Session::get('user_type');
                header('location: ' . URL);
            } else {

                header('location: ' . URL . 'user/login');
            }
        } catch (Exception $e) {
            echo 'Exception: ' . $e->getMessage() . "(model_company :line 24)";
        }
    }

    /**
     * The user logout
     */
    function logout() {
        $login_model = $this->loadModel('user');
        $login_model->logout();
        // redirect user to base URL
        header('location: ' . URL . 'user/login');
    }

    /*
     * Get all users
     */

    function jsonGetUsers() {
        auth::handleLogin();
        auth::isLevel1User();
        try {

            $login_model = $this->loadModel('user');
            if (!$login_model) {
                throw new Exception("object not found");
            }
            $loggedUserType = session::get('user_type');
            $users = $login_model->getUsers($loggedUserType);
            if ($users) {
                $data = array('success' => true, 'users' => $users);
                echo json_encode($data);
            } else {
                $data = array('success' => false, 'error' => $this->view->renderFeedbackMessagesForJson());
                echo json_encode($data);
            }
        } catch (Exception $e) {
            echo json_encode('Exception: ' . $e->getMessage() . "(model_company :line 24)");
        }
    }

    function error() {
        $this->view->render('user/error', false, false, $this->module);
    }

    function changePassword() {
        $this->view->render('user/change_password', false, false, $this->module);
    }

    function jsonChangePassword() {
        $login_model = $this->loadModel('user');
        $res = $login_model->changePassword();
        if ($res) {
            $data = array('success' => true, 'error' => $this->view->renderFeedbackMessagesForJson());
            echo json_encode($data);
        } else {
            $data = array('success' => false, 'error' => $this->view->renderFeedbackMessagesForJson());
            echo json_encode($data);
        }
    }

    function forgotPassword() {
        $this->view->render('user/froget_password', false, true, $this->module);
    }

    function jsonChangeForgotPass() {
        $login_model = $this->loadModel('user');
        $res = $login_model->changeFrogotPassword();
        if ($res) {
            $data = array('success' => true, 'error' => $this->view->renderFeedbackMessagesForJson());
            echo json_encode($data);
        } else {
            $data = array('success' => false, 'error' => $this->view->renderFeedbackMessagesForJson());
            echo json_encode($data);
        }
    }

    function activateUser($status = null, $user = null) {
        auth::handleLogin();
        auth::isLevel1User();
        $login_model = $this->loadModel('user');
        $res = $login_model->activateUser($status, $user);
        header('location: ' . URL . '/user/index/');
    }

    function deleteUser($user = null) {
        auth::handleLogin();
        auth::isLevel1User();
        $login_model = $this->loadModel('user');
        $res = $login_model->deleteUser($user);
        header('location: ' . URL . '/user/index/');
    }

    function jsonPrivileges() {
        $menu = null;
        $authorizedMenu = null;
        require DOC_PATH . 'backoffice/application/views/user/privileges.php';
        echo $html;
    }

}

?>