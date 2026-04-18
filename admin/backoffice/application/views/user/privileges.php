<?php
$html='<form id="form">
    <fieldset style=" margin: 0 auto;width:41%;float:none;" class="fieldClassColom_2"  id="personal">
        <legend>Set Privileges</legend>
        <span>
            <label for="lastname">Menu Item : </label></br> 
            <select size="10" onchange="saveNewAmendment(this.value)" id="def_amendments">';
                if ($menu) {
                    foreach ($menu as $m) {
                        $html.="<option value='" . $m->menu . "'>" . $m->amendment_name . "</option>";
                    }
                }
            $html.='</select>
        </span>
        <span>
            <label for="lastname">User`s Authorized Menu Item : </label></br> 
            <select size="10" onchange="deleteAmendment(this.value)" id="selected_amendments">';
                if ($authorizedMenu) {
                    foreach ($authorizedMenu as $aM) {
                        $html.="<option value='" . $aM->amendment_code . "'>" . $aM->amendment_name . "</option>";
                    }
                }
            $html.='</select>
        </span>
    </fieldset>
</form>';
?>