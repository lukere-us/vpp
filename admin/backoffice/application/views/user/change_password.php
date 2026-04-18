<div id="wrapper">
    <div id="content">
        <div id="box">
            <div id="error">
            </div>
            <form id="form">
                <fieldset class="fieldFullWidth"  id="personal">
                    <legend>Change Password</legend>
                    <span class="spanLeft">
                        <label for="lastname">User Email : </label></br>
                        <input disabled type="text" name="" value="<?php echo Session::get('user_name') ?>" id=""/>
                        <input type="hidden" name="uName" value="<?php echo Session::get('user_name') ?>" id="uName"/>
                    </span>
                    <span class="spanLeft">
                        <label style="width:150px;" for="lastname">Old password : </label></br> 
                        <input maxlength="10" type="password" name="oldPass" id="uPass"/>
                    </span>
                    <span class="spanLeft">
                        <label style="width:150px;" for="lastname">Password(length 6 to 10) : </label></br> 
                        <input maxlength="10" type="password" name="nPass" id="uPass"/>
                    </span>
                    <span  class="spanLeft">
                        <label style="width:120px;" for="lastname">Confirm Password : </label></br> 
                        <input maxlength="10" type="password" name="cPass" id="uCPass"/>
                    </span>
                    <span class="vehCatBtnSpan">
                        <button type="button" onclick="changePassword()">Change Password</button>
                    </span>
                </fieldset>
            </form>
        </div>
        <div id="box">
            <div id="userList"></div>
        </div>
    </div>
</div>

