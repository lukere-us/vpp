(function ($) {
    'use strict';

    var dataChartInstance = null;
    var sparkInstances = [];
    var currentTrendData = null;
    var currentSpan = '8h';

    function destroySparkCharts() {
        sparkInstances.forEach(function (ch) {
            if (ch) {
                ch.destroy();
            }
        });
        sparkInstances = [];
    }

    function destroyDataChart() {
        destroySparkCharts();
        if (dataChartInstance) {
            dataChartInstance.destroy();
            dataChartInstance = null;
        }
    }

    function whenCanvasSized(canvas, done, attemptsLeft) {
        var rect = canvas.getBoundingClientRect();
        if (rect.width >= 2 && rect.height >= 2) {
            done();
            return;
        }
        if (attemptsLeft <= 0) {
            done();
            return;
        }
        window.requestAnimationFrame(function () {
            whenCanvasSized(canvas, done, attemptsLeft - 1);
        });
    }

    function smoothWave(i, n, phase, amp) {
        return Math.sin((i / (n - 1 || 1)) * Math.PI * 2 + phase) * amp;
    }

    function generateTrendData(span) {
        var labels;
        var n;
        var i;
        var crude;
        var rffa;
        var soaps;
        var moist;

        if (span === '1h') {
            n = 13;
            labels = [];
            for (i = 0; i < n; i++) {
                labels.push('-' + (60 - i * 5) + 'm');
            }
        } else if (span === '8h') {
            n = 11;
            labels = ['12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00', '22:00'];
        } else if (span === '24h') {
            n = 12;
            labels = [];
            for (i = 0; i < n; i++) {
                labels.push((i * 2) + ':00');
            }
        } else {
            n = 7;
            labels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
        }

        crude = [];
        rffa = [];
        soaps = [];
        moist = [];
        for (i = 0; i < n; i++) {
            crude.push(
                0.6 +
                smoothWave(i, n, 0.4, 0.12) +
                0.03 * Math.sin(i * 1.7 + 1) +
                (span === '1h' ? 0.02 * Math.sin(i * 3) : 0)
            );
            rffa.push(0.05 + smoothWave(i, n, 2.1, 0.003) + 0.0006 * Math.sin(i * 0.9));
            soaps.push(0.42 + smoothWave(i, n, 0.8, 0.08) + 0.02 * Math.sin(i * 1.2));
            moist.push(0.14 + smoothWave(i, n, 1.2, 0.04) + 0.015 * Math.cos(i * 0.7));
        }

        return {
            labels: labels,
            crude: crude,
            rffa: rffa,
            soaps: soaps,
            moist: moist
        };
    }

    function chartTextColor() {
        return '#a8a8b0';
    }

    function chartGridColor() {
        return 'rgba(255,255,255,0.08)';
    }

    function buildMainChartConfig(data) {
        return {
            type: 'line',
            data: {
                labels: data.labels,
                datasets: [
                    {
                        label: 'Crude-Oil FFA',
                        data: data.crude,
                        borderColor: '#e6c229',
                        backgroundColor: 'rgba(230, 194, 41, 0.06)',
                        yAxisID: 'y1',
                        tension: 0.35,
                        borderWidth: 2,
                        pointRadius: 0,
                        pointHoverRadius: 4
                    },
                    {
                        label: 'Refined Oil FFA',
                        data: data.rffa,
                        borderColor: '#3ecf6e',
                        backgroundColor: 'transparent',
                        yAxisID: 'y1',
                        tension: 0.35,
                        borderWidth: 2,
                        pointRadius: 0,
                        pointHoverRadius: 4
                    },
                    {
                        label: 'Crude Oil Mositure',
                        data: data.soaps,
                        borderColor: '#e55353',
                        backgroundColor: 'transparent',
                        yAxisID: 'y1',
                        tension: 0.35,
                        borderWidth: 2,
                        pointRadius: 0,
                        pointHoverRadius: 4
                    },
                    {
                        label: 'Refined Oil Moisture',
                        data: data.moist,
                        borderColor: '#5eb3ff',
                        backgroundColor: 'transparent',
                        yAxisID: 'y1',
                        tension: 0.35,
                        borderWidth: 2,
                        pointRadius: 0,
                        pointHoverRadius: 4
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: { mode: 'index', intersect: false },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: 'rgba(30,30,34,0.95)',
                        titleColor: '#eee',
                        bodyColor: '#ccc',
                        borderColor: 'rgba(255,255,255,0.12)',
                        borderWidth: 1
                    }
                },
                scales: {
                    x: {
                        ticks: { color: chartTextColor(), maxRotation: 0 },
                        grid: { color: chartGridColor() }
                    },
                    y: {
                        type: 'linear',
                        display: false,
                        position: 'right',
                        min: 0,
                        max: 8,
                        title: {
                            display: false,
                            text: 'FFA/Moisture',
                            color: chartTextColor()
                        },
                        ticks: { color: chartTextColor() },
                        grid: { drawOnChartArea: false }
                    },
                    y1: {
                        type: 'linear',
                        display: true,
                        position: 'left',
                        min: 0,
                        max: 0.8,
                        title: {
                            display: true,
                            text: 'FFA/Moisture',
                            color: chartTextColor()
                        },
                        ticks: {
                            color: chartTextColor(),
                            stepSize: 0.1,
                            callback: function (value) {
                                return Number(value).toFixed(1).replace(/\.0$/, '');
                            }
                        },
                        grid: { color: chartGridColor() }
                    }
                }
            }
        };
    }

    function sparkOptions(color, values) {
        var min = Math.min.apply(null, values);
        var max = Math.max.apply(null, values);
        var pad = (max - min) * 0.15 || 0.02;
        return {
            type: 'line',
            data: {
                labels: values.map(function (_, idx) {
                    return idx;
                }),
                datasets: [
                    {
                        data: values,
                        borderColor: color,
                        borderWidth: 1.5,
                        tension: 0.35,
                        pointRadius: 0,
                        fill: false
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: false,
                plugins: { legend: { display: false }, tooltip: { enabled: false } },
                scales: {
                    x: { display: false },
                    y: {
                        display: false,
                        min: min - pad,
                        max: max + pad
                    }
                },
                layout: { padding: 2 }
            }
        };
    }

    function updateLegendAndSparks(data) {
        var series = [data.crude, data.rffa, data.soaps, data.moist];
        var colors = ['#e6c229', '#3ecf6e', '#e55353', '#5eb3ff'];
        var decimals = [1, 2, 2, 2];
        var last = data.labels.length - 1;
        var i;
        var val;
        var canvas;

        for (i = 0; i < 4; i++) {
            val = series[i][last];
            $('#oilTrendsVal' + i).text(val.toFixed(decimals[i]) + ' %');
        }

        destroySparkCharts();
        for (i = 0; i < 4; i++) {
            canvas = document.getElementById('oilTrendsSpark' + i);
            if (!canvas) {
                continue;
            }
            sparkInstances.push(
                new Chart(canvas.getContext('2d'), sparkOptions(colors[i], series[i]))
            );
        }
    }

    function applyTrendData(data, span) {
        currentTrendData = data;
        currentSpan = span;
        if (dataChartInstance) {
            dataChartInstance.data.labels = data.labels;
            dataChartInstance.data.datasets[0].data = data.crude;
            dataChartInstance.data.datasets[1].data = data.rffa;
            dataChartInstance.data.datasets[2].data = data.soaps;
            dataChartInstance.data.datasets[3].data = data.moist;
            dataChartInstance.update();
        }
        updateLegendAndSparks(data);
    }

    function initDataChart() {
        var canvas = document.getElementById('myChart');
        if (!canvas || typeof Chart === 'undefined') {
            return;
        }
        destroyDataChart();
        var span = $('.oil-trends-seg-btn.is-active').data('span') || '8h';
        if (!span) {
            span = '8h';
        }
        var data = generateTrendData(span);
        dataChartInstance = new Chart(canvas.getContext('2d'), buildMainChartConfig(data));
        currentTrendData = data;
        currentSpan = span;
        updateLegendAndSparks(data);
    }

    function exportCsv() {
        if (!currentTrendData) {
            return;
        }
        var d = currentTrendData;
        var rows = [['Time', 'Crude-Oil FFA (%)', 'Refined Oil FFA (%)', 'Crude Oil Moisture', 'Refined Oil Moisture (%)']];
        var i;
        for (i = 0; i < d.labels.length; i++) {
            rows.push([
                d.labels[i],
                d.crude[i].toFixed(3),
                d.rffa[i].toFixed(3),
                d.soaps[i].toFixed(4),
                d.moist[i].toFixed(4)
            ]);
        }
        var csv = rows.map(function (r) {
            return r.map(function (c) {
                return '"' + String(c).replace(/"/g, '""') + '"';
            }).join(',');
        }).join('\r\n');
        var blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
        var url = URL.createObjectURL(blob);
        var a = document.createElement('a');
        a.href = url;
        a.download = 'oil-trends-' + currentSpan + '.csv';
        a.click();
        URL.revokeObjectURL(url);
    }

    $(function () {
        $(document).on('afterShow.fb', function (e, instance, current) {
            if (!current || !current.$content || !current.$content.find('#myChart').length) {
                return;
            }
            var canvas = document.getElementById('myChart');
            if (!canvas) {
                return;
            }
            window.requestAnimationFrame(function () {
                whenCanvasSized(canvas, initDataChart, 24);
            });
        });

        $(document).on('afterClose.fb', function (e, instance, current) {
            if (current && current.$content && current.$content.find('#myChart').length) {
                destroyDataChart();
            }
        });

        $(document).on('click', '.oil-trends-seg-btn', function () {
            var $btn = $(this);
            var span = $btn.data('span');
            if (!span || !$btn.closest('#dataChart').length) {
                return;
            }
            $btn.siblings().removeClass('is-active');
            $btn.addClass('is-active');
            if (!dataChartInstance) {
                return;
            }
            applyTrendData(generateTrendData(span), span);
        });

        $(document).on('click', '#oilTrendsExport', function () {
            if ($(this).closest('#dataChart').length) {
                exportCsv();
            }
        });
    });
})(jQuery);
