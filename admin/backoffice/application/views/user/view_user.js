function catchDisplay(result)
{
    var jsonData = JSON.parse(result);
    var html = null;
    if (jsonData.success == true) {
        html = "<table>";
        html = html + "<thead><tr>";
        html = html + "<th>User Code</th>";
        html = html + "<th>User first name</th>";
        html = html + "<th>User last name</th>";
        html = html + "<th>User email</th>";
        html = html + "<th>User Type</th>";
        html = html + "<th>User status</th>";
        html = html + "<th>Action</th>";
//        html = html + "<th>Privileges</th>";
        html = html + "</tr></thead>";
        for (var i in jsonData.users) {
            html = html + "<tbody><tr>";
            html = html + "<td>" + jsonData.users[i]['user_code'] + "</td>";
            html = html + "<td>" + jsonData.users[i]['f_name'] + "</td>";
            html = html + "<td>" + jsonData.users[i]['l_name'] + "</td>";
            html = html + "<td>" + jsonData.users[i]['email'] + "</td>";
            html = html + "<td>" + (jsonData.users[i]['type'] == 'A' ? 'ADMIN' : 'USER') + "</td>";
            html = html + "<td>" + (jsonData.users[i]['status'] == 1 ? "<a Onclick='return doConfirm(`Are you confirm to inactive this user?`);' href='" + URL + "user/activateUser/I/" + jsonData.users[i]['user_code'] + "'><img width='16' height='16' title='Click to inactive' src='" + URL + "backoffice/public/img/active.png'></a>" : "<a Onclick='return doConfirm(`Are you confirm to active this user?`);' href='" + URL + "user/activateUser/A/" + jsonData.users[i]['user_code'] + "'><img width='16' height='16' title='Click to active' src='" + URL + "backoffice/public/img/inactive.png'></a>") + "</td>";
            html = html + "<td><a Onclick='return doConfirm(`Are you confirm to delete this user?`);' href='" + URL + "user/deleteUser/" + jsonData.users[i]['user_code'] + "'><img width='16' height='16' title='Click to delete' src='" + URL + "backoffice/public/img/delete.png'></a></td>";
//            html = html + "<td><a style='cursor: pointer;' onclick=loadPrivileges('" + jsonData.users[i]['user_code'] + "')><img width='17' height='17' title='Click to edit' src='" + URL + "public/img/lock.png'></a></td>";
            html = html + "</tr></tbody>";

            //Privileges form load
            html = html + "<tr class='hideme'>";
            html = html + "<td colspan='17'>\n\
                            <div id='" + jsonData.users[i]['user_code'] + "_div' style='display: block;margin: 15px;padding: 10px;display:none;' ></div></td>";
            html = html + "</tr>";
        }
        html = html + "</table>";
        document.getElementById('userList').innerHTML = html;
    } else {
        document.getElementById('userList').innerHTML = jsonData.error;

    }
}