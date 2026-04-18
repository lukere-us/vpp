<?php

define("GET", "GET");
define("POST", "POST");
define("REQUSET", "REQUSET");
define("SESSION", "SESSION");
define("COOKIE", "COOKIE");

class read {

    var $rawdata;
    var $data;
    var $lastread;

    function __construct() {
        
    }

    public function get($index, $method = REQUSET, $validate = false) {
        $ex = explode(",", $index);
        if (is_array($ex))
            if (isset($ex[1]))
                if ($ex[1] != null) {
                    foreach ($ex as $e) {
                        $s[$e] = $this->sget($e, $method, $validate);
                    }
                    return $s;
                } else {
                    return $this->sget($index, $method, $validate);
                } else {
                return $this->sget($index, $method, $validate);
            }
    }

    private function sget($index, $method = REQUSET, $validate = false) {
        $this->lastread = false;
        if ($method == GET) {
            $this->lastread = (isset($_GET[$index])) ? $_GET[$index] : false;
        } else if ($method == POST) {
            $this->lastread = (isset($_POST[$index])) ? $_POST[$index] : false;
        } else if ($method == SESSION) {
            $this->lastread = (isset($_SESSION[$index])) ? $_SESSION[$index] : false;
        } else if ($method == COOKIE) {
            $this->lastread = (isset($_COOKIE[$index])) ? $_COOKIE[$index] : false;
        } else {
            $this->lastread = (isset($_REQUEST[$index])) ? $_REQUEST[$index] : false;
        }

        if ($this->lastread && $validate) {
            if ($validate == 'int') {
                if ($this->lastread == 0) {
                    return 0;
                } else if (intval($this->lastread) > 0) {
                    return intval($this->lastread);
                } else {
                    return false;
                }
            } else if ($validate == 'double') {
                if ($this->lastread == 0) {
                    return 0;
                } else if (doubleval($this->lastread) > 0) {
                    return doubleval($this->lastread);
                } else {
                    return false;
                }
            }
        }

        return $this->lastread;
    }

    public function getArrayForKey($index, $method = REQUSET) {
        if ($method == GET) {
            $this->rawdata = (isset($_GET)) ? $_GET : false;
        } else if ($method == POST) {
            $this->rawdata = (isset($_POST)) ? $_POST : false;
        } else if ($method == SESSION) {
            $this->rawdata = (isset($_SESSION)) ? $_POST : false;
        } else if ($method == COOKIE) {
            $this->rawdata = (isset($_COOKIE)) ? $_POST : false;
        } else {
            $this->rawdata = (isset($_REQUEST)) ? $_REQUEST : false;
        }
        $this->dataset($index);
        return $this->data;
    }

    private function dataset($index) {
        $i = 0;
        $this->data = false;
        $dd = false;
        foreach ($this->rawdata as $key => $value) {
            if (preg_match('/' . $index . '[0-9]+/i', $key)) {
                if ($value != null) {
                    $dd[$i]->id = str_replace($index, "", $key);
                    $dd[$i]->index = $key;
                    $dd[$i]->value = $value;
                    $i++;
                }
            }
        }
        $this->data = $dd;
        //print_r($this->data);
    }

}

?>
