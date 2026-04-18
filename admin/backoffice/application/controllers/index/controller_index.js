function genarateChartReport() {
    var params = $('form').serialize();
    var from = document.getElementById('startDate').value;
    var to = document.getElementById('endDate').value;
    var reqParam = params;


    var param = URL + "reports/jsongetTotalBookings?" + reqParam;
    xmlRequest(param, null, function(responseText) {
        var jsonData = JSON.parse(responseText);
        if (jsonData.success == true) {
            if (jsonData.Confirmed > 0 || jsonData.Canceled > 0 || jsonData.Failed > 0) {
                document.getElementById('totAval').innerHTML = jsonData.Confirmed;
                document.getElementById('totCval').innerHTML = jsonData.Canceled;
                document.getElementById('totFval').innerHTML = jsonData.Failed;
                document.getElementById("totVal").style.display = "block";
                $(function() {
                    $('#chartReport').highcharts({
                        chart: {
                            type: 'bar'
                        },
                        title: {
                            text: 'Reservation overview'
                        },
                        subtitle: {
                            text: 'Today so far'
                        },
                        xAxis: {
                            categories: ['Bookings'],
                            title: {
                                text: null
                            }
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: 'Population (millions)',
                                align: 'high'
                            },
                            labels: {
                                overflow: 'justify'
                            }
                        },
                        tooltip: {
                            valueSuffix: ' millions'
                        },
                        plotOptions: {
                            bar: {
                                dataLabels: {
                                    enabled: true
                                }
                            }
                        },
                        legend: {
                            layout: 'vertical',
                            align: 'right',
                            verticalAlign: 'top',
                            x: -40,
                            y: 100,
                            floating: true,
                            borderWidth: 1,
                            backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor || '#FFFFFF'),
                            shadow: true
                        },
                        credits: {
                            enabled: false
                        },
                        series: [{
                                name: 'Cancled',
                                data: [parseInt(jsonData.Canceled)],
                                color: '#F15C80'
                            }, {
                                name: 'Payment failed',
                                data: [parseInt(jsonData.Failed)],
                                color: '#7CB5EC'
                            }, {
                                name: 'Confirmed',
                                data: [parseInt(jsonData.Confirmed)],
                                color: '#33DB62'

                            }]
                    });
                });
            } else {
                document.getElementById('error').innerHTML = "<p style=' color: green;font-size: 14px;margin: 23px 0 0;'>Welcome to the OVRS back office..<br><span style='color:#000;font-size:12px;'>No reservation data to today so far</span></p>";
            }
        }
    });



}