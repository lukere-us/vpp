function getActivity() {
//    var userType = document.getElementById('userType').value;
//    var userCompany = document.getElementById('userCompany').value;
//    var userLevel = document.getElementById('userLevel').value;
//    var userStatus = document.getElementById('userStatus').value;
    //var reqParam = "uType=" + userType + "&uCompany=" + userCompany + "&uLevel=" + userLevel + "&uStaus=" + userStatus;
    var reqParam = '';
    var param = URL + "activity/jsonGetactivityList?" + reqParam + "";
    xmlRequest(param, null, function(responseText) {
        catchDisplay(responseText);
    });
}

