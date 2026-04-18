function getUsers() {
//    var userType = document.getElementById('userType').value;
//    var userCompany = document.getElementById('userCompany').value;
//    var userLevel = document.getElementById('userLevel').value;
//    var userStatus = document.getElementById('userStatus').value;
    //var reqParam = "uType=" + userType + "&uCompany=" + userCompany + "&uLevel=" + userLevel + "&uStaus=" + userStatus;
    var reqParam ='';
    var param = URL + "user/jsonGetUsers?" + reqParam + "";
    xmlRequest(param, null, function(responseText) {
        catchDisplay(responseText);
    });
}
function createNewUser() {
    overlayEnable();
    var params = $('form').serialize();
    var reqParam = params;
    var param = URL + "user/jsonCreateNewUser?" + reqParam;
    xmlRequest(param, null, function(responseText) {
        overlayDisable();
        var jsonData = JSON.parse(responseText);
        document.getElementById('error').innerHTML = jsonData.error;
        if (jsonData.success == true) {
            document.getElementById("form").reset();
            if (document.getElementById('userCompany')) {
                document.getElementById('userCompany').disabled = true;
            }
        }
    });
}
function changePassword() {

    var params = $('form').serialize();
    var reqParam = params;
    var param = URL + "user/jsonChangePassword?" + reqParam;
    xmlRequest(param, null, function(responseText) {
        var jsonData = JSON.parse(responseText);
        document.getElementById('error').innerHTML = jsonData.error;
        if (jsonData.success == true) {
            document.getElementById("form").reset();
        }
    });
}

function createNewPassword() {
    var params = $('form').serialize();
    var reqParam = params;
    var param = URL + "user/jsonChangeForgotPass?" + reqParam;
    xmlRequest(param, null, function(responseText) {
        var jsonData = JSON.parse(responseText);
        document.getElementById('error').innerHTML = jsonData.error;
        if (jsonData.success == true) {
            document.getElementById("form").reset();
        }
    });
}
function loadPrivileges(id) {
    $('#' + id + "_div").slideToggle(500);
    //Get detail summary
    var reqParam = id;
    var param = URL + "user/jsonPrivileges?bn=" + reqParam + "";
    xmlRequest(param, null, function(responseText) {
        $('#' + id + "_div").html(responseText);
    });
    return false;
}

