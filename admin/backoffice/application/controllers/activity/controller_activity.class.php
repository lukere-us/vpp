<?php

class activity extends controller {

    function __construct($module) {
        parent::__construct($module);
    }

    /**
     * Display the user list
     */
    function index() {
        auth::handleLogin();
        try {
            $login_model = $this->loadModel('activity');
            if (!$login_model) {
                throw new Exception("object not found");
            }
            $this->view->loggedUserType = session::get('user_type');
            $this->view->render('activity/index', false, false, $this->module);
        } catch (Exception $e) {
            echo 'Exception: ' . $e->getMessage() . "(model_company :line 24)";
        }
    }

    function jsonGetactivityList() {
        auth::handleLogin();
        try {
            $login_model = $this->loadModel('activity');
            if (!$login_model) {
                throw new Exception("object not found");
            }
            $activities = $login_model->getActivityes(session::get('user_type'), session::get('user_code'));
            if ($activities) {
                $data = array('success' => true, 'activity' => $activities);
                echo json_encode($data);
            } else {
                $data = array('success' => false, 'error' => $this->view->renderFeedbackMessagesForJson());
                echo json_encode($data);
            }
        } catch (Exception $e) {
            echo 'Exception: ' . $e->getMessage() . "(model_company :line 24)";
        }
    }

}

?>