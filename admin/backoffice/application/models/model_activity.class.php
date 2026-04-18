<?php

class activityModel extends model {

    function getActivityes($loggedUserType, $userCode) {
        $reqUserType = $this->read->get("uType", "GET");
        $reqUserStatus = $this->read->get("uStaus", "GET");
        if ($loggedUserType) {
            $whrReqUserType = ($reqUserType ? " type='" . ($reqUserType) . "'" : "");
            $whrReqUserStaus = ($reqUserStatus ? " status='" . ($reqUserStatus) . "' AND status NOT IN(3)" : "");
            if (($loggedUserType == 'A')) {//logged as admin
                $getUsersQry = "SELECT * FROM tbl_action ac 
                                INNER JOIN
                                tbl_users us ON  us.user_code=ac.user_code";

                //WHERE " . ($whrReqUserType ? $whrReqUserType : "") . " " . ($whrReqUserStaus ? "AND " . $whrReqUserStaus : "") . "";
            } else {
                $getUsersQry = "SELECT * FROM tbl_action ac 
                                INNER JOIN
                                tbl_users us ON  us.user_code=ac.user_code
                                WHERE ac.user_code='" . $userCode . "'";
                //($whrReqUserType ? $whrReqUserType : "") . " " . ($whrReqUserStaus ? "AND " . $whrReqUserStaus : "") . " AND ac.user_code='" . $userCode . "'";
            }
            $activity = $this->db->queryMultipleObjects($getUsersQry);
            if ($activity) {
                return $activity;
            } else {
                $this->session->setError("feedback_negative", FEEDBACK_NO_USERS);
                return false;
            }
        }
    }

}

?>