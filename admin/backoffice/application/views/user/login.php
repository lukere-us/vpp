<div id="wrapper">
    <div style="margin:200px 0 !important;"id="content">
        <div id="errorMsg"> 
            <?php
            $this->renderFeedbackMessages();
            ?>
        </div>
        <div style="margin:0 auto; width:330px; float:none !important;" id="box">
            <form id="form" action="<?php echo URL ?>user/loginaction" method="POST">
                <fieldset id="personal">
                    <legend>Login</legend>
                    <label>User Name</label>
                    <input type="text" name="fields_req[username]"/>
                    <label>Password</label>
                    <input type="password" name="fields_req[password]"/>
                    <button type="submit">Sign in</button>
                    <a href="<?php echo URL ?>user/forgotPassword/">Forgot password</a>
            </fieldset>
        </form>
    </div>
</div>
</div>