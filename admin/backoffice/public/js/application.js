var URL = "http://vpp.biotechnocrat.com/admin/";
var CONTROLLER_PATH = "application/controllers/";
var MODELS_PATH = "application/models/";
var VIEWS_PATH = "application/views/";

//ERROR TEXT
var ERROR_ADD_CATEGORY = "Enter your new category name";
var ERROR_ADD_TYPE = "Enter your new type name";
var ERROR_ADD_BRAND = "Enter your new brand name";
var ERROR_EDIT_CATEGORY = "Selected category does't exist";
var ERROR_EDIT_TYPE = "Selected type does't exist";
var ERROR_EDIT_BRAND = "Selected brand does't exist";
var ERROR_CATEGORY_UPDATE = "Category successfully updated";
var ERROR_TYPE_UPDATE = "Type successfully updated";
var ERROR_BRAND_UPDATE = "Brand successfully updated";
var ERROR_CATEGORY_DELETE = "Category successfully deleted";
var ERROR_TYPE_DELETE = "Type successfully deleted";
var ERROR_BRAND_DELETE = "Brand successfully deleted";
var ERROR_VEHICLE_NAME_EMPTY = "Please enter name and max pax for vehicle";
var ERROR_VEHICLE_CATEGORY_EMPTY = "You must select at least one of category,type and brand";
var ERROR_EDIT_VEHICLE = "Vehicle Code empty";
var ERROR_EDIT_VEHICLE_SUCCESS = "Vehicle successfully update";
var ERROR_DELETE_VEHICLE_SUCCESS = "Vehicle successfully deleted";
var ERROR_RATE_PARAM_EMPTY = "Select driven optin ,curruncy and vehicle";
var ERROR_DATES_EMPTY = "Please enter start and end date";
var ERROR_AMENDMENT_VEHICLE = "Please select vehicle";
var ERROR_IMAGE_UPLOAD = "Image Successfully upload";
var ERROR_IMAGE_DELETE = "Image Successfully delete";

function ConfirmDelete()
{
    var x = confirm("Are you sure you want to delete?");
    if (x)
        return true;
    else
        return false;
}
function doConfirm(msg) {
    var x = confirm(msg);
    if (x)
        return true;
    else
        return false;
}

function xmlRequest(param, div, returnFunc)
{
    var xmlhttp;
    if (param == "")
    {
        document.getElementById(div).innerHTML = "";
        return;
    }
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    }
    else
    {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function()
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {

            if (typeof returnFunc === 'function') {
                returnFunc(xmlhttp.responseText);
            }


        }
    }
    xmlhttp.open("GET", param, true);
    xmlhttp.send();
}

function isNumberKey(evt)
{
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if (charCode != 46 && charCode > 31
            && (charCode < 48 || charCode > 57))
        return false;

    return true;
}



function isOnlyNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    return !(charCode > 31 && (charCode < 48 || charCode > 57));
}

function enableDisabledBlkInventory(val) {
    if (val) {
        if (document.getElementById(val + "_blk_chk").checked == true) {
            document.getElementById(val + "_blk_input").disabled = false;
            document.getElementById(val + "_blk_input").value = '';
        } else {
            document.getElementById(val + "_blk_input").disabled = true;
            document.getElementById(val + "_blk_input").value = '';
        }
    }
}
function enableCompanySelect(val) {
    if (val == 'C') {
        document.getElementById("userCompany").disabled = false;
    } else {
        document.getElementById("userCompany").disabled = true;
    }
}
function overlayEnable() {
    if (document.getElementById("overlay")) {
        document.getElementById("overlay").style.display = "block";
    }
    if (document.getElementById("waitingDiv")) {
        document.getElementById("waitingDiv").style.display = "block";
    }
    return true;
}
function overlayDisable() {
    if (document.getElementById("overlay")) {
        document.getElementById("overlay").style.display = "none";
    }
    if (document.getElementById("waitingDiv")) {
        document.getElementById("waitingDiv").style.display = "none";
    }
    return true;
}
function companySelect() {
    document.getElementById("myCompany").submit();
}
