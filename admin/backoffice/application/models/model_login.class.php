<?php

class loginModel extends model {

    /**
     * Constructor, expects a Database connection
     * @param Database $db The Database object
     */
    public function doLogin() {
        //validate all post values
        $postValues = $this->getFormPost();
        if ($postValues) {
            //Check valid login
            $getUserInfoQry = "SELECT * FROM tbl_users WHERE user_email='" . mysql_real_escape_string($postValues['user_email']) . "' AND user_pass='" . md5(mysql_real_escape_string($postValues['password'])) . "'";
            //Get one record
            $userInfo = $this->db->queryUniqueObject($getUserInfoQry);
            if (!$userInfo) {
                $this->session->setError("feedback_negative", FEEDBACK_LOGIN_INVALID_LOGIN);
                return false;
            }
            if ($userInfo->user_status == 'I') {
                $this->session->setError("feedback_negative", FEEDBACK_LOGIN_STATUS_INACTIVE);
                return false;
            }


            Session::init();
            Session::set('user_logged_in', true);
            Session::set('user_id', $userInfo->user_code);
            Session::set('user_name', $userInfo->user_email);
            Session::set('user_type', $userInfo->user_type);
            Session::set('user_level', $userInfo->user_level);
            Session::set('user_company_code', $userInfo->company_code);
            return true;
        }
        return false;
    }

    public function logout() {
        // delete the session
        Session::destroy();
    }

}

?>