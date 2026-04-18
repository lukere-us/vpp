<?php

/**
 * Class View
 *
 * Provides the methods all views will have
 */
class view {

    private $module;

    function __construct($module) {
        $this->module = $module;
    }

    /**
     * simply includes (=shows) the view. this is done from the controller. In the controller, you usually say
     * $this->view->render('help/index'); to show (in this example) the view index.php in the folder help.
     * Usually the Class and the method are the same like the view, but sometimes you need to show different views.
     * @param string $filename Path of the to-be-rendered view, usually folder/file(.php)
     * @param boolean $render_without_header_and_footer Optional: Set this to true if you don't want to include header and footer
     */
    public function render($filename, $render_without_header_and_footer = false, $render_without_menu = false, $module) {
        $this->module = $module;
        $jsFile = explode('/', $filename);
        $this->mainMenuItem = $jsFile[0];
        $jsController = $this->module . "/" . CONTROLLER_PATH . $jsFile[0] . "/controller_" . $jsFile[0] . '.js';
        $jsView = $this->module . "/" . VIEWS_PATH . $jsFile[0] . "/view_" . $jsFile[0] . '.js';
        // page without header and footer, for whatever reason

        if ($render_without_header_and_footer == true) {
            require $this->module . "/" . VIEWS_PATH . $filename . '.php';
        } else {

            require $this->module . "/" . VIEWS_PATH . '_templates/header.php';
            ($render_without_menu ? "" : require $this->module . "/" . VIEWS_PATH . '_templates/menu.php');
            require $this->module . "/" . VIEWS_PATH . $filename . '.php';
            require $this->module . "/" . VIEWS_PATH . '_templates/footer.php';
        }
    }

    public function jsonRender($filename, $module) {
        
    }

    /**
     * renders the feedback messages into the view
     */
    public function renderFeedbackMessages() {
        // echo out the feedback messages (errors and success messages etc.),
        // they are in $_SESSION["feedback_positive"] and $_SESSION["feedback_negative"]

        require $this->module . "/" . VIEWS_PATH . '_templates/feedback.php';

        // delete these messages (as they are not needed anymore and we want to avoid to show them twice
        Session::set('feedback_positive', null);
        Session::set('feedback_negative', null);
    }

    public function renderFeedbackMessagesReservation() {
        // echo out the feedback messages (errors and success messages etc.),
        // they are in $_SESSION["feedback_positive"] and $_SESSION["feedback_negative"]
        $feedback_positive = Session::get('feedback_positive');
        $feedback_negative = Session::get('feedback_negative');
        $pHtml = null;
        $nHtml = null;
// echo out positive messages
        if (isset($feedback_positive)) {
            foreach ($feedback_positive as $feedback) {
                $pHtml.= ' <div class="vehicle" style="height:80px;">
            <img style="  float: left; margin: 7px 0 0 20px; width: 49px;" src="'.URL.'reservation/public/images/error.jpg"/>
            <div style="color: green;float: left;font-size: 14px;margin: 18px 0 0 20px;"><p>' . $feedback . '</p></div>
        </div>';
            }
        }

// echo out negative messages
        if (isset($feedback_negative)) {
            foreach ($feedback_negative as $feedback) {
                $nHtml.='<div class="vehicle" style="height:80px;">
            <img style="  float: left; margin: 7px 0 0 20px; width: 49px;" src="'.URL.'reservation/public/images/error.jpg"/>
            <div style="color: red;float: left;font-size: 14px;margin: 18px 0 0 20px;"><p>' . $feedback . '</p></div>
        </div>';
            }
        }
        // delete these messages (as they are not needed anymore and we want to avoid to show them twice
        echo $pHtml . $nHtml;
        Session::set('feedback_positive', null);
        Session::set('feedback_negative', null);
    }

    /**
     * renders the feedback messages into the view
     */
    public function renderFeedbackMessagesForJson() {
        // echo out the feedback messages (errors and success messages etc.),
        // they are in $_SESSION["feedback_positive"] and $_SESSION["feedback_negative"]
        // get the feedback (they are arrays, to make multiple positive/negative messages possible)
        $feedback_positive = Session::get('feedback_positive');
        $feedback_negative = Session::get('feedback_negative');
        $pHtml = null;
        $nHtml = null;
// echo out positive messages
        if (isset($feedback_positive)) {
            foreach ($feedback_positive as $feedback) {
                $pHtml.= '<div class="feedback_success">' . $feedback . '</div>';
            }
        }

// echo out negative messages
        if (isset($feedback_negative)) {
            foreach ($feedback_negative as $feedback) {
                $nHtml.='<div class="feedback_error">' . $feedback . '</div>';
            }
        }

        // delete these messages (as they are not needed anymore and we want to avoid to show them twice
        Session::set('feedback_positive', null);
        Session::set('feedback_negative', null);
        return $pHtml . $nHtml;
    }

    /**
     * Checks if the passed string is the currently active controller.
     * Useful for handling the navigation's active/non-active link.
     * @param string $filename
     * @param string $navigation_controller
     * @return bool Shows if the controller is used or not
     */
    private function checkForActiveController($filename, $navigation_controller) {
        $split_filename = explode("/", $filename);
        $active_controller = $split_filename[0];

        if ($active_controller == $navigation_controller) {
            return true;
        }
        // default return
        return false;
    }

    /**
     * Checks if the passed string is the currently active controller-action (=method).
     * Useful for handling the navigation's active/non-active link.
     * @param string $filename
     * @param string $navigation_action
     * @return bool Shows if the action/method is used or not
     */
    private function checkForActiveAction($filename, $navigation_action) {
        $split_filename = explode("/", $filename);
        $active_action = $split_filename[1];

        if ($active_action == $navigation_action) {
            return true;
        }
        // default return of not true
        return false;
    }

    /**
     * Checks if the passed string is the currently active controller and controller-action.
     * Useful for handling the navigation's active/non-active link.
     * @param string $filename
     * @param string $navigation_controller_and_action
     * @return bool
     */
    private function checkForActiveControllerAndAction($filename, $navigation_controller_and_action) {
        $split_filename = explode("/", $filename);
        $active_controller = $split_filename[0];
        $active_action = $split_filename[1];

        $split_filename = explode("/", $navigation_controller_and_action);
        $navigation_controller = $split_filename[0];
        $navigation_action = $split_filename[1];

        if ($active_controller == $navigation_controller AND $active_action == $navigation_action) {
            return true;
        }
        // default return of not true
        return false;
    }

}
