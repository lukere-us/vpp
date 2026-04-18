function catchDisplay(result)
{
    var jsonData = JSON.parse(result);
    var html = null;
    if (jsonData.success == true) {
        html = "<table>";
        html = html + "<thead><tr>";
        html = html + "<th>User Code</th>";
        html = html + "<th>User first name</th>";
        html = html + "<th>User email</th>";
        html = html + "<th>Action</th>";
        html = html + "<th>Action type</th>";
        html = html + "<th>Time</th>";
        html = html + "<th>Execute by</th>";
//        html = html + "<th>Privileges</th>";
        html = html + "</tr></thead>";
        for (var i in jsonData.activity) {
            html = html + "<tbody><tr>";
            html = html + "<td>" + jsonData.activity[i]['user_code'] + "</td>";
            html = html + "<td>" + jsonData.activity[i]['f_name'] + "</td>";
            html = html + "<td>" + jsonData.activity[i]['email'] + "</td>";
            html = html + "<td>" + jsonData.activity[i]['action'] + "</td>";
            html = html + "<td>" + jsonData.activity[i]['action_type'] + "</td>";
            html = html + "<td>" + jsonData.activity[i]['time'] + "</td>";
            html = html + "<td>" + jsonData.activity[i]['execute_by'] + "</td>";
            html = html + "</tr></tbody>";

            //Privileges form load
            html = html + "<tr class='hideme'>";
            html = html + "<td colspan='17'>\n\
                            <div id='" + jsonData.activity[i]['user_code'] + "_div' style='display: block;margin: 15px;padding: 10px;display:none;' ></div></td>";
            html = html + "</tr>";
        }
        html = html + "</table>";
        document.getElementById('activityes').innerHTML = html;
    } else {
        document.getElementById('activityes').innerHTML = jsonData.error;

    }
}