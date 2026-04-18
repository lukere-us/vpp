<?php
Session::set('froPassNum1', rand(0, 10));
Session::set('froPassNum2', rand(0, 10));
?>
<div id="wrapper">
    <div style="margin:200px 0 !important;"id="content">
        <div id="error"> 

        </div>
        <div style="margin:0 auto; width:330px; float:none !important;" id="box">
            <form id="form">
                <fieldset id="personal">
                    <legend>Forgot Password</legend>
                    <label>Your email</label>
                    <input type="text" name="email"/>
                    <label><?php echo Session::get('froPassNum1'); ?>+<?php echo Session::get('froPassNum2'); ?>=?</label>
                    <input type="text" name="captcha"/>
                    <button type="button" onclick="createNewPassword()" >Continue</button>
                    <a href="<?php echo URL ?>">Login</a>
                </fieldset>
            </form>
        </div>
    </div>
</div>