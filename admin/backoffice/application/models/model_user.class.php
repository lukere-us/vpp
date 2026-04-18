<?php

class userModel extends model {

    /**
     * Constructor, expects a Database connection
     * @param Database $db The Database object
     */
    public function doLogin($regCompany = null) {
        //validate all post values
        $postValues = $this->getFormPost();
        if ($postValues) {
            //Check valid login
            $getUserInfoQry = "SELECT * FROM tbl_users WHERE user_name='" . ($postValues['username']) . "' AND password='" . md5(($postValues['password'])) . "'";
            //Get one record
            $userInfo = $this->db->queryUniqueObject($getUserInfoQry);
            if (!$userInfo) {
                $this->session->setError("feedback_negative", FEEDBACK_LOGIN_INVALID_LOGIN);
                return false;
            }
            if ($userInfo->status == 0) {
                $this->session->setError("feedback_negative", FEEDBACK_LOGIN_STATUS_INACTIVE);
                return false;
            }

            Session::init();
            Session::set('user_logged_in', true);
            Session::set('user_id', $userInfo->id);
            Session::set('user_code', $userInfo->user_code);
            Session::set('user_name', $userInfo->email);
            Session::set('user_type', $userInfo->type);
            /* Action save */
            $actionArr = array();
            $actionArr['code'] = $userInfo->user_code;
            $actionArr['action'] = 'Sussfully loged';
            $actionArr['action_type'] = 'LOGIN';
            $actionArr['execute'] = session::get('user_name');
            $this->saveAction($actionArr);
            /* ############ */
            return true;
        }
        return false;
    }

    public function logout() {
        // delete the session
        /* Action save */
        $actionArr = array();
        $actionArr['code'] = session::get('user_code');
        $actionArr['action'] = 'Sussfully log out';
        $actionArr['action_type'] = 'LOGIN';
        $actionArr['execute'] = session::get('user_name');
        $this->saveAction($actionArr);
        /* ############ */
        Session::destroy();
    }

    function getUsers($loggedUserType) {


        $reqUserType = $this->read->get("uType", "GET");
        $reqUserStatus = $this->read->get("uStaus", "GET");
        if ($loggedUserType) {
            if (($loggedUserType == 'A')) {//logged as admin
                $whrReqUserType = ($reqUserType ? " type='" . ($reqUserType) . "'" : " type NOT IN('A')");
                $whrReqUserStaus = ($reqUserStatus ? " status='" . ($reqUserStatus) . "' AND status NOT IN(3)" : "status NOT IN(3)");

                $getUsersQry = "SELECT * FROM tbl_users WHERE " . ($whrReqUserType ? $whrReqUserType : "") . " " . ($whrReqUserStaus ? "AND " . $whrReqUserStaus : "") . "";
                $users = $this->db->queryMultipleObjects($getUsersQry);
                if ($users) {
                    return $users;
                } else {
                    $this->session->setError("feedback_negative", FEEDBACK_NO_USERS);
                    return false;
                }
            }
        }
    }

    function registerNewUser() {
        $reqUserType = $this->read->get("userType", "GET");
        $reqUserFName = $this->read->get("fName", "GET");
        $reqUserLName = $this->read->get("lName", "GET");
        $reqUserEmail = $this->read->get("uEmail", "GET");
        $reqUserName = $this->read->get("uName", "GET");
        $pass = $this->read->get("uPass", "GET");
        $cPass = $this->read->get("uCPass", "GET");
        if ($reqUserType && $reqUserFName && $reqUserLName && $reqUserEmail && $reqUserName && $pass && $cPass) {

            if ($this->isEmail($reqUserEmail)) {
                $pass = trim($pass);
                $cPass = trim($cPass);
                $passLength = strlen($pass);
                if ($passLength >= 6 && $passLength <= 10) {
                    if ($pass == $cPass) {
                        $userCodeSerQry = "SELECT MAX(id) FROM tbl_users";
                        $userCode = $this->db->queryUniqueValue($userCodeSerQry);
                        //Check email allredy exist
                        $chkUserEmailSerQry = "SELECT id FROM tbl_users WHERE email='" . $reqUserEmail . "' OR user_name='" . $reqUserName . "'";
                        $chkUserCode = $this->db->queryUniqueValue($chkUserEmailSerQry);
                        if (!$chkUserCode) {
                            if ($userCode) {
                                $userCode = str_replace('U', '', $userCode);
                                $userCode = intval(ltrim($userCode, '0')); //Remove stsrt 'C' character and Start all '0's
                                $userCode+=1; //Increase company number from 1
                                $newUserCode = 'U';
                                for ($i = (5 - strlen(strval($userCode))); $i > 0; $i--) {
                                    $newUserCode.='0';
                                }
                                $newUserCode.=$userCode;
                            } else {
                                $newUserCode = 'U00001';
                            }
                        } else {
                            $this->session->setError("feedback_negative", FEEDBACK_NEW_USER_EMAIL_EXIST);
                            return false;
                        }
                        $newUserQry = "
                            INSERT INTO tbl_users
                            (
                                user_code,
                                f_name,
                                l_name,
                                email,
                                user_name,
                                password,
                                type
                            ) 
                            VALUES
                            (
                            '" . ($newUserCode) . "',
                            '" . ($reqUserFName) . "',
                            '" . ($reqUserLName) . "',
                            '" . ($reqUserEmail) . "',
                            '" . ($reqUserName) . "',
                            '" . (md5($pass)) . "',
                            '" . ($reqUserType) . "')";

                        $result = $this->db->execute($newUserQry);
                        if ($result) {
//                            $massage = "<html><body>";
//                            $massage.="Dear User, </br></br>";
//                            $massage.="<p>Your OVRS back office access detail send with this massage.</p></br></br>";
//                            $massage.="<p>User email: " . $email . "</p></br>";
//                            $massage.="<p>Password: " . $pass . "</p></br>";
//                            $massage.="<p>Access URL</p></br>";
//                            $massage.="<p><a href='" . URL . "'>Login to back office</a></p></br></br>";
//                            $massage.="<p>Warm Regards,</p></br>";
//                            $massage.="<b>The OVRS Team.</b>";
//                            $massage.="</body></html>";
//                            $res = $this->sendMail($massage, "OVRS-User Login Detail", $email);
                            session::setError("feedback_positive", FEEDBACK_NEW_USER_SUCCESS);
                            return true;
                        } else {
                            $this->session->setError("feedback_negative", FEEDBACK_NEW_USER_FAILED);
                            return false;
                        }
                    } else {
                        $this->session->setError("feedback_negative", FEEDBACK_PASSWORD_NOT_MATCH);
                        return false;
                    }
                } else {
                    $this->session->setError("feedback_negative", FEEDBACK_PASSWORD_LENGTH);
                    return false;
                }
            } else {
                $this->session->setError("feedback_negative", FEEDBACK_NEW_USER_EMAIL_ERROR);
                return false;
            }
        } else {
            $this->session->setError("feedback_negative", FEEDBACK_NEW_USER_SET_ALL_FIELDS);
            return false;
        }
    }

    function changePassword() {
        $userEmail = $this->read->get("uName", "GET");
        $oldPass = $this->read->get("oldPass", "GET");
        $newPass = $this->read->get("nPass", "GET");
        $cPass = $this->read->get("cPass", "GET");
        if ($userEmail && $oldPass && $newPass && $cPass) {
            $chkUser = "SELECT user_code FROM tbl_users WHERE email='" . ($userEmail) . "' AND password='" . md5($oldPass) . "'";
            $chkUserCode = $this->db->queryUniqueValue($chkUser);
            if ($chkUserCode) {
                $newPass = trim($newPass);
                $cPass = trim($cPass);
                $passLength = strlen($newPass);
                if ($passLength >= 6 && $passLength <= 10) {
                    if ($newPass == $cPass) {
                        $updatePass = "UPDATE tbl_users SET password='" . (md5($newPass)) . "' WHERE email='" . ($userEmail) . "'";
                        $result = $this->db->execute($updatePass);
                        if ($result) {
                            session::setError("feedback_positive", FEEDBACK_PASSWORD_CHANGE_SUCCESS);
                            /* Action save */
                            $actionArr = array();
                            $actionArr['code'] = session::get('user_code');
                            $actionArr['action'] = 'Password changed';
                            $actionArr['action_type'] = 'LOGIN';
                            $actionArr['execute'] = session::get('user_name');
                            $this->saveAction($actionArr);
                            /* ############ */
                            return true;
                        } else {
                            $this->session->setError("feedback_negative", FEEDBACK_PASSWORD_CHANGE_FAILED);
                            return false;
                        }
                    } else {
                        $this->session->setError("feedback_negative", FEEDBACK_PASSWORD_NOT_MATCH);
                        return false;
                    }
                } else {
                    $this->session->setError("feedback_negative", FEEDBACK_PASSWORD_LENGTH);
                    return false;
                }
            } else {
                $this->session->setError("feedback_negative", FEEDBACK_PASSWORD_CHANGE);
                return false;
            }
        } else {
            $this->session->setError("feedback_negative", FEEDBACK_NEW_USER_SET_ALL_FIELDS);
            return false;
        }
    }

    function changeFrogotPassword() {
        $userEmail = $this->read->get("email", "GET");
        $capcha = $this->read->get("captcha", "GET");
        $num1 = Session::get('froPassNum1');
        $num2 = Session::get('froPassNum2');
        if ($capcha && $userEmail) {
            if (($num1 + $num2) == $capcha) {
                if ($this->isEmail($userEmail)) {
                    $chkUserEmailSerQry = "SELECT user_code FROM tbl_users WHERE user_email='" . mysql_real_escape_string($userEmail) . "'";
                    $chkUserCode = $this->db->queryUniqueValue($chkUserEmailSerQry);
                    if ($chkUserCode) {
                        $newPass = rand(100000, 1000000000);
                        $updatePass = "UPDATE tbl_users SET user_pass='" . mysql_real_escape_string(md5($newPass)) . "' WHERE user_email='" . mysql_real_escape_string($userEmail) . "'";
                        $result = $this->db->execute($updatePass);
                        if ($result) {
                            $massage = "<html><body>";
                            $massage.="Dear User, </br></br>";
                            $massage.="<p>You have requested that new password details be sent to you via email.</p></br></br>";
                            $massage.="<p>Password: <b>" . $newPass . "</b></p></br>";
                            $massage.="<p>Access URL</p></br>";
                            $massage.="<p><a href='" . URL . "'>Login to back office</a></p></br></br>";
                            $massage.="<p>Warm Regards,</p></br>";
                            $massage.="<b>The OVRS Team.</b>";
                            $massage.="</body></html>";
                            $res = $this->sendMail($massage, "OVRS-New Password", $userEmail);
                            session::setError("feedback_positive", FEEDBACK_FROGOT_PASSWORD_NEW);
                            return true;
                        } else {
                            $this->session->setError("feedback_negative", FEEDBACK_FROGOT_PASSWORD_EMAIL_FAILED);
                            return false;
                        }
                    } else {
                        $this->session->setError("feedback_negative", FEEDBACK_FROGOT_PASSWORD_EMAIL_FAILED);
                        return false;
                    }
                } else {
                    $this->session->setError("feedback_negative", FEEDBACK_NEW_USER_EMAIL_ERROR);
                    return false;
                }
            } else {
                $this->session->setError("feedback_negative", FEEDBACK_FROGOT_PASSWORD_CAPCHA_FAILED);
                return false;
            }
        } else {
            $this->session->setError("feedback_negative", FEEDBACK_NEW_USER_SET_ALL_FIELDS);
            return false;
        }
    }

    function activateUser($status, $user) {
        if ($status && $user) {
            if ($status == 'A' || $status = 'I') {
                $updateStatus = "UPDATE tbl_users SET status='" . ($status == 'A' ? 1 : 0) . "' WHERE user_code='" . ($user) . "'";
                $result = $this->db->execute($updateStatus);
                if ($result) {
                    session::setError("feedback_positive", FEEDBACK_USER_STATUS_UPDATE_SUCCESS);
                    /* Action save */
                    $actionArr = array();
                    $actionArr['code'] = $user;
                    $actionArr['action'] = ($status == 'A' ? 'User activated' : 'User deactivated');
                    $actionArr['action_type'] = 'ACTIVATION';
                    $actionArr['execute'] = session::get('user_name');
                    $this->saveAction($actionArr);
                    /* ############ */
                    return true;
                } else {
                    $this->session->setError("feedback_negative", FEEDBACK_USER_STATUS_UPDATE_FAILED);
                    return false;
                }
            } else {
                $this->session->setError("feedback_negative", FEEDBACK_USER_STATUS_INVALID);
                return false;
            }
        }
        return false;
    }

    function deleteUser($user) {
        if ($user) {
            $updateStatus = "UPDATE tbl_users SET status=3 WHERE user_code='" . ($user) . "'";
            $result = $this->db->execute($updateStatus);
            if ($result) {
                session::setError("feedback_positive", FEEDBACK_USER_DELETE_SUCCESS);
                /* Action save */
                $actionArr = array();
                $actionArr['code'] = $user;
                $actionArr['action'] = 'Delete user';
                $actionArr['action_type'] = 'ACTIVATION';
                $actionArr['execute'] = session::get('user_name');
                $this->saveAction($actionArr);
                /* ############ */
                return true;
            } else {
                $this->session->setError("feedback_negative", FEEDBACK_USER_DELETE_FAILED);
                return false;
            }
        } else {
            return false;
        }
    }

}

?>