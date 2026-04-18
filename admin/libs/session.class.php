<?php

/**
 * Session class
 *
 * handles the session stuff. creates session when no one exists, sets and
 * gets values, and closes the session properly (=logout). Those methods
 * are STATIC, which means you can call them with Session::get(XXX);
 */
class session {

    /**
     * starts the session
     */
    public static function init() {
        // if no session exist, start the session
        if (session_id() == '') {
            session_start();
        }
    }

    /**
     * sets a specific value to a specific key of the session
     * @param mixed $key
     * @param mixed $value
     */
    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    /**
     * sets a specific error value to a specific key of the session
     * @param mixed $key
     * @param mixed $value
     */
    public static function setError($key, $value) {
        $_SESSION[$key][] = $value;
    }

    /**
     * gets/returns the value of a specific key of the session
     * @param mixed $key Usually a string, right ?
     * @return mixed
     */
    public static function get($key) {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
    }

    /**
     * deletes the session (= logs the user out)
     */
    public static function destroy() {
        session_destroy();
    }

    /**
     * Set form post value
     */
    public function setFromValue($key, $value) {
        $fromValue = array();
        if (isset($_SESSION['fromValue']) && !empty($_SESSION['fromValue'])) {
            $fromValue = $_SESSION['fromValue'];
            $fromValue[$key] = $value;
            $_SESSION['fromValue'] = $fromValue;
        } else {
            $fromValue[$key] = $value;
            $_SESSION['fromValue'] = $fromValue;
        }
    }

    /**
     * Get form post value
     */
    public function getFromValue() {
        if (isset($_SESSION['fromValue']) && !empty($_SESSION['fromValue'])) {
            $fromValue = $_SESSION['fromValue'];
            unset($_SESSION['fromValue']);
            return $fromValue;
        }
    }

}
