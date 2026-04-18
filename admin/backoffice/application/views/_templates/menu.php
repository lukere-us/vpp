
<div id="header">
    <h2>Simulator</h2>
    <div id="loginInfo"><?php echo Session::get('user_name') ?>  |  <a style='color:#FFF;' href="<?php echo URL . "user/changePassword/" ?>">Change Password</a> | <a style='color:#FFF;' href="<?php echo URL . "user/logout/" ?>">Logout</a></div>


    <div id="topmenu">

        <ul>
            <?php if (session::get('user_type') == 'A') { ?>
                <li <?php echo ($this->mainMenuItem == 'user' ? "class='current'" : ""); ?> ><a href="<?php echo URL . "user/" ?>">Users</a></li>
                <li <?php echo ($this->mainMenuItem == 'company' ? "class='current'" : ""); ?> ><a href="<?php echo URL . "activity/" ?>">Activity</a></li>
            <?php } else { ?>
                <li <?php echo ($this->mainMenuItem == 'company' ? "class='current'" : ""); ?> ><a href="<?php echo URL . "activity/" ?>">Activity</a></li>

            <?php } ?>
        </ul>

    </div>
</div>
<div id="top-panel">
    <div id="panel">


        <?php if ($this->mainMenuItem == 'user') { ?>
            <ul>
                <li><a class="report" href="<?php echo URL . "user/" ?>">Registered Users</a></li>
                <li><a class="report" href="<?php echo URL . "user/newUser/" ?>">New user</a></li>

            </ul>
        <?php } else if ($this->mainMenuItem == 'activity') { ?>
            <ul>
                <li><a class="report" href="<?php echo URL . "activity/" ?>">User Activities</a></li>
            </ul>
            <?php
        }
        ?>
    </div>
</div>
