<div id="wrapper">
    <div id="content">
        <div id="box">
            <div id="error">
            </div>
            <form id="form">
                <fieldset class="fieldFullWidth"  id="personal">
                    <legend>User Info</legend>
                    <span class="spanLeft">
                        <label for="fname">User First Name : </label></br>
                        <input type="text" name="fName" id="fName"/>
                    </span>
                    <span class="spanLeft">
                        <label for="lastname">User Last Name : </label></br>
                        <input type="text" name="lName" id="lName"/>
                    </span>
                    <span class="spanLeft">
                        <label for="email">User Email : </label></br>
                        <input type="text" name="uEmail" id="uEmail"/>
                    </span>
                    <span class="spanLeft">
                        <label for="lastname">User Type : </label></br>
                        <select name="userType" id="userType">
                            <option value="">-</option>                           
                            <option value="A">Admin</option>
                            <option value="U">User</option>
                        </select>
                    </span>
                </fieldset>
                <fieldset class="fieldFullWidth"  id="personal">
                    <legend>Credential</legend>
                    <span class="spanLeft">
                        <label for="lastname">User Name : </label></br>
                        <input type="text" name="uName" id="uName"/>
                    </span>
                    <span class="spanLeft">
                        <label style="width:150px;" for="lastname">Password(length 6 to 10) : </label></br> 
                        <input maxlength="10" type="password" name="uPass" id="uPass"/>
                    </span>
                    <span  class="spanLeft">
                        <label style="width:120px;" for="lastname">Confirm Password : </label></br> 
                        <input maxlength="10" type="password" name="uCPass" id="uCPass"/>
                    </span>
                    <span class="vehCatBtnSpan">
                        <button type="button" onclick="createNewUser()">Create new user</button>
                    </span>
                </fieldset>
            </form>
        </div>
        <div id="box">
            <div id="userList"></div>
        </div>
    </div>
</div>

