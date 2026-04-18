<?php

/**
 * Class Auth
 * Simply checks if user is logged in. In the app, several controllers use Auth::handleLogin() to
 * check if user if user is logged in, useful to show controllers/methods only to logged-in users.
 */
class auth {

    public static function handleLogin() {
        // initialize the session
        session::init();

        // if user is still not logged in, then destroy session, handle user as "not logged in" and
        // redirect user to login page
        if (!isset($_SESSION['user_logged_in']) OR $_SESSION['user_logged_in'] != true) {
            session::destroy();
            header('location: ' . URL . 'user/login');
            die();
        }
    }

    public static function handlecompany() {
        // initialize the session
        session::init();

        // if user is still not logged in, then destroy session, handle user as "not logged in" and
        // redirect user to login page
        if (!isset($_SESSION['user_company_code']) || !$_SESSION['user_company_code']) {
            session::setError("feedback_negative", FEEDBACK_COMPANY_LOGGED_ERROR);
            header('location: ' . URL . 'user/error/');
            die();
        }
    }

    public static function isAdmin() {
        // initialize the session
        session::init();

        // if user is still not logged in, then destroy session, handle user as "not logged in" and
        // redirect user to login page
        if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'A') {
            session::setError("feedback_negative", FEEDBACK_COMPANY_ACCESS_PROHIBIT);
            header('location: ' . URL . 'user/error/');
            die();
        }
    }

    public static function isCompany() {
        // initialize the session
        session::init();

        // if user is still not logged in, then destroy session, handle user as "not logged in" and
        // redirect user to login page
        if (!isset($_SESSION['user_company_code']) || $_SESSION['user_company_code'] != 'C') {
            session::setError("feedback_negative", FEEDBACK_COMPANY_ACCESS_PROHIBIT);
            header('location: ' . URL . 'user/error/');
            die();
        }
    }

    public static function isLevel1User() {
        // initialize the session
        session::init();

        // if user is still not logged in, then destroy session, handle user as "not logged in" and
        // redirect user to login page
        if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'A') {
            session::setError("feedback_negative", FEEDBACK_COMPANY_ACCESS_PROHIBIT);
            header('location: ' . URL . 'user/error/');
            die();
        }
    }

}
