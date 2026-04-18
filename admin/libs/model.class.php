<?php

class model extends common {

    function __construct() {

        // create database connection
        try {
            $this->db = new database();
        } catch (Exception $e) {
            die('Database connection could not be established.');
        }

        $this->read = new read();
        $this->session = new session();
        $this->email = new phpmailer();
        $this->arr = array();
    }

    public function getFormPost() {

        $formValid = true;
        ($this->read->get('fields', POST) ? $this->createFromValue($this->read->get('fields', POST)) : "");
        ($this->read->get('fields_req', POST) ? $this->createFromValue($this->read->get('fields_req', POST)) : "");
        ($this->read->get('field_email_req', POST) ? $this->createFromValue($this->read->get('field_email_req', POST)) : "");
        ($this->read->get('field_int', POST) ? $this->createFromValue($this->read->get('field_int', POST)) : "");
        ($this->read->get('field_int_req', POST) ? $this->createFromValue($this->read->get('field_int_req', POST)) : "");
        ($this->read->get('field_email', POST) ? $this->createFromValue($this->read->get('field_email', POST)) : "");
        ($this->read->get('field_string', POST) ? $this->createFromValue($this->read->get('field_string', POST)) : "");
        ($this->read->get('field_string_req', POST) ? $this->createFromValue($this->read->get('field_string_req', POST)) : "");


        if ($this->read->get('fields', POST)) {

            $isfFieldSet = true;
            $values = $this->setArray($this->read->get('fields', POST), $methode = false, $validate = false);
            if (!$values) {
                $formValid = false;
            } else {
                $this->collectFieldSet($values);
                $values = false;
            }
        }

        if ($this->read->get('fields_req', POST)) {

            $isfFieldSet = true;
            $values = $this->setArray($this->read->get('fields_req', POST), $methode = 'req', $validate = false);

            if (!$values) {
                $formValid = false;
            } else {
                $this->collectFieldSet($values);
                $values = false;
            }
        }

        if ($this->read->get('field_email_req', POST)) {
            $isfFieldSet = true;

            $values = $this->setArray($this->read->get('field_email_req', POST), $methode = 'req', $validate = 'email');
            if (!$values) {
                $formValid = false;
            } else {
                $this->collectFieldSet($values);
                $values = false;
            }
        }
        if ($this->read->get('field_email', POST)) {
            $isfFieldSet = true;

            $values = $this->setArray($this->read->get('field_email', POST), $methode = false, $validate = 'email');
            if (!$values) {
                $formValid = false;
            } else {
                $this->collectFieldSet($values);
                $values = false;
            }
        }

        if ($this->read->get('field_int', POST)) {
            $isfFieldSet = true;
            $values = $this->setArray($this->read->get('field_int', POST), $methode = false, $validate = 'int');

            if (!$values) {
                $formValid = false;
            } else {
                $this->collectFieldSet($values);
                $values = false;
            }
        }

        if ($this->read->get('field_int_req', POST)) {
            $isfFieldSet = true;
            $values = $this->setArray($this->read->get('field_int_req', POST), $methode = 'req', $validate = 'int');
            if (!$values) {
                $formValid = false;
            } else {
                $this->collectFieldSet($values);
                $values = false;
            }
        }
        if ($this->read->get('field_string', POST)) {
            $isfFieldSet = true;
            $values = $this->setArray($this->read->get('field_string', POST), $methode = false, $validate = 'string');

            if (!$values) {
                $formValid = false;
            } else {
                $this->collectFieldSet($values);
                $values = false;
            }
        }
        if ($this->read->get('field_string_req', POST)) {
            $isfFieldSet = true;
            $values = $this->setArray($this->read->get('field_string_req', POST), $methode = 'req', $validate = 'string');
            if (!$values) {
                $formValid = false;
            } else {
                $this->collectFieldSet($values);
                $values = false;
            }
        }

        return ( $formValid ? $this->arr : false);
    }

    private function createFromValue($index) {
        foreach ($index as $gkey => $gvalue) {
            $this->session->setFromValue($gkey, $gvalue);
        }
    }

    private function collectFieldSet($index) {
        foreach ($index as $fkey => $fvalue) {
            $this->arr[$fkey] = $fvalue;
        }
    }

    public function insertQuery($setOfFields = false, $table = false) {
        $fields = false;
        $values = false;
        if ($setOfFields && $table) {
            $sql = "INSERT INTO " . $table;

            foreach ($setOfFields as $key => $value) {
                $fields.="`" . $key . "`,";
                $values.="'" . $value . "',";
            }
            $nfields = substr($fields, 0, -1);
            $nvalues = substr($values, 0, -1);
            $sql.="(" . $nfields . ") VALUES(" . $nvalues . ")";

            return $sql;
        }
    }

    public function updateQuery($setOfFields = false, $table = false, $where1 = null, $where2 = null, $where3 = null) {
        $fields = false;
        $values = false;
        if ($setOfFields && $table) {
            $sql = "UPDATE " . $table . " SET ";

            foreach ($setOfFields as $key => $value) {
                $fields.=$key . "=" . "'" . mysql_real_escape_string($value) . "',";
            }
            $nfields = substr($fields, 0, -1);
            $sql.=$nfields;
            $qry1 = null;
            $qry2 = null;
            $qry3 = null;
            if ($where1) {
                $qry1 = ($where1 && isset($where1[0]) && isset($where1[1]) ? " WHERE " . $where1[0] . "=" . "'" . mysql_real_escape_string($where1[1]) . "'" : null);
                $qry2 = ($where2 && isset($where2[0]) && isset($where2[1]) ? " AND " . $where2[0] . "=" . "'" . mysql_real_escape_string($where2[1]) . "'" : null);
                $qry3 = ($where3 && isset($where3[0]) && isset($where3[1]) ? " AND " . $where3[0] . "=" . "'" . mysql_real_escape_string($where3[1]) . "'" : null);
            }
            $sql.=$qry1 . $qry2 . $qry3;

            return $sql;
        }
        return false;
    }

    public function setValidaton($index, $method = false, $validation = false) {


        if ($index) {
            $isfFieldSet = true;
            $this->valueSet = $this->setArray($index, $method, $validation);

            if (!$this->valueSet) {
                return false;
                exit();
            } else {
                return $this->valueSet;
            }
        }
    }

    public function setArray($index, $methode = false, $validate = false) {

        $i = 0;
        $data = false;
        $dd = false;
        $isValid = true;

        foreach ($index as $key => $value) {


            (!$value ? $value = null : $value = $value);

            if ($methode == 'req' && !$value) {
                session::setError("feedback_negative", $key . " " . FEEDBACK_REQUIRED_FIELD);
                $isValid = false;
            }

            if ($validate == 'int') {
                $intVal = $this->isInt($value);
                if (!$intVal) {
                    session::setError("feedback_negative", $key . " " . FEEDBACK_INTEGER_FIELD);
                    $isValid = false;
                }
            }

            if ($validate == 'email') {
                $emilVal = $this->isEmail($value);
                if (!$emilVal) {
                    session::setError("feedback_negative", $key . " " . FEEDBACK_EMAIL_FIELD);
                    $isValid = false;
                }
            }
            if ($validate == 'string') {
                if (!preg_match('/^[a-zA-Z ]*$/', $value)) {
                    session::setError("feedback_negative", $key . " " . FEEDBACK_STRING_FIELD);
                    $isValid = false;
                }
            }


            $dd[$key] = $value;
            $i++;
        }
        $data = $dd;
        return ($isValid ? $data : false);
    }

    public function isInt($value) {
        $value = trim($value);
        if ($value == '') {
            return true;
        }
        if ($value == 0) {
            return 0;
        } else if (intval($value > 0)) {
            return intval($value);
        } else {
            return false;
        }
    }

    public function isEmail($value) {
        $value = trim($value);
        if ($value == '') {
            return true;
        }
        if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }

    public function isString($value) {
        $value = trim($value);
        if ($value == '') {
            return true;
        }
        if (ctype_alpha($value)) {
            return true;
        } else {
            return false;
        }
    }

    public function isAlphaNumeric($value) {
        $value = trim($value);
        if ($value == '') {
            return true;
        }
        if (ctype_alnum($value)) {
            return true;
        } else {
            return false;
        }
    }

    public function isContainSpecialChars($value) {
        // $value = trim($value);
        if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $value)) {
            return true;
        } else {
            return false;
        }
    }

    function dateValidate($date) {
        if (!preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $date)) {
            return false;
        }
        return true;
    }

    function validStringOnly($value) {
        if (!preg_match('/^[A-Za-z ]*$/', $value)) {
            return false;
        }
        return true;
    }

    function validIntOnly($value) {
        if (!preg_match('/^[0-9]*$/', $value)) {
            return false;
        }
        return true;
    }

    function decimalValidate($val) {
        if (preg_match('/^[0-9]+(\.[0-9]{1,2})?$/', $val) || preg_match('/^[0-9]*$/', $val)) {
            return true;
        }
        return false;
    }

    public function isNumeric($value) {
        $value = trim($value);

        if (is_numeric($value)) {
            return true;
        } else {
            return false;
        }
    }

    function sendMail($Message, $Subject, $ToEmail) {

        $FromEmail = 'lakmalwimaladasa@yahoo.com';
        $FromName = 'OVRS';
        $this->email->From = $FromEmail;
        $this->email->FromName = $FromName;

        $this->email->IsSMTP();

        $this->email->SMTPAuth = true;     // turn of SMTP authentication
        $this->email->Username = "lakmalwimaladasa@yahoo.com";  // SMTP username  (Ex: sumithnets@yahoo.com)
        $this->email->Password = "123456"; // SMTP password  (Ex: yahoo email password)
        $this->email->SMTPSecure = "ssl";

        $this->email->Host = "smtp.mail.yahoo.com";
        $this->email->Port = 465;

        $this->email->SMTPDebug = 2; // Enables SMTP debug information (for testing, remove this line on production mode)
        // 1 = errors and messages
        // 2 = messages only

        $this->email->Sender = $FromEmail; // $bounce_email;
        $this->email->ConfirmReadingTo = $FromEmail;

        $this->email->AddReplyTo($FromEmail);
        $this->email->IsHTML(true); //turn on to send html email
        $this->email->Subject = $Subject;

        $this->email->Body = $Message;
        $this->email->AltBody = "ALTERNATIVE MESSAGE FOR TEXT WEB BROWSER LIKE SQUIRRELMAIL";

        $this->email->AddAddress($ToEmail, $ToEmail);

        if ($this->email->Send()) {
            $this->email->ClearAddresses();
            return true;
        } else {
            session::setError("feedback_negative", "Mailer Error: " . $this->email->ErrorInfo);
            return false;
        }
    }

    function sms($msg, $no) {

        $user = "lakmal";
        $password = "R1okGUCy";
        $api_id = "3397131";
        $baseurl = "http://api.clickatell.com";

        $text = urlencode($msg);
        $to = $no;


        // auth call
        $url = "$baseurl/http/auth?user=$user&password=$password&api_id=$api_id";

        // do auth call
        $ret = file($url);

        // explode our response. return string is on first line of the data returned
        $sess = explode(":", $ret[0]);
        if ($sess[0] == "OK") {

            $sess_id = trim($sess[1]); // remove any whitespace
            $url = "$baseurl/http/sendmsg?session_id=$sess_id&to=$to&text=$text";

            // do sendmsg call
            $ret = file($url);
            $send = explode(":", $ret[0]);

            if ($send[0] == "ID") {
                session::setError("feedback_positive", "successnmessage ID: " . $send[1]);
                return true;
            } else {
                session::setError("feedback_negative", "Massage sending failed");
                return false;
            }
        } else {
            session::setError("feedback_negative", "Authentication failure: " . $ret[0]);
            return false;
        }
    }

    function saveAction($arr) {
        $actionQry = "
                            INSERT INTO tbl_action
                            (
                                user_code,
                                action,
                                action_type,
                                execute_by
                            ) 
                            VALUES
                            (
                            '" . ($arr['code']) . "',
                            '" . ($arr['action']) . "',
                            '" . ($arr['action_type']) . "',
                            '" . ($arr['execute']) . "')";

        return $this->db->execute($actionQry);
    }

}

?>