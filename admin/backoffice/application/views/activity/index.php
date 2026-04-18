
<div id="wrapper">
    <div id="content">
        <div id="box">
            <div id="error"> 
                <?php
                $this->renderFeedbackMessages();
                ?>
            </div>
            <form id="form">
                <!--                <fieldset class="fieldFullWidth"  id="personal">
                                    <legend>Search Users</legend>
                                    <span class="spanLeft">
                                        <label for="lastname">User Level : </label></br> 
                                        <select id="userLevel">
                                            <option value="">-ALL-</option>
                                            <option value="1">Level 1</option>
                                            <option value="2">Level 2</option>
                                        </select>
                                    </span>
                                    <span class="spanLeft">
                                        <label for="lastname">User Status : </label></br> 
                                        <select id="userStatus">
                                            <option value="">-ALL-</option>
                                            <option value="A">Active</option>
                                            <option value="I">Inactive</option>
                                        </select>
                                    </span>
                                    <span class="vehCatBtnSpan">
                                        <button type="button" onclick="getUsers()">Get Users</button>
                                    </span>
                                    <br />
                                </fieldset>-->
            </form>
        </div>
        <div id="box">
            <div id="activityes"></div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        getActivity();
    });
</script>

