$(document).ready(function() {
    "use strict";
    let siteUrl = $('meta[name="site-url"]').attr('content');

    $.get(siteUrl + "/dashboard/get-chart-data")
        .done(function(data) {
            renderDashboardCharts(data);
        })
        .fail(function(xhr) {
            console.error('Dashboard chart data failed:', xhr.status, xhr.responseText);
        });
});

function renderDashboardCharts(data) {
    var monthly = data.monthlyDebitCredit || {};
    var labels = monthly.labels || [];
    var credits = monthly.credits || [];
    var debits = monthly.debits || [];

    if (labels.length && $('#barChart').length) {
        var areaChartData = {
            labels: labels,
            datasets: [
                {
                    label: 'Credits',
                    backgroundColor: 'rgba(210, 214, 222, 1)',
                    borderColor: 'rgba(210, 214, 222, 1)',
                    pointRadius: false,
                    pointColor: 'rgba(210, 214, 222, 1)',
                    pointStrokeColor: '#c1c7d1',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(220,220,220,1)',
                    data: credits
                },
                {
                    label: 'Debits',
                    backgroundColor: 'rgba(60,141,188,0.9)',
                    borderColor: 'rgba(60,141,188,0.8)',
                    pointRadius: false,
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: debits
                }
            ]
        };

        var barChartCanvas = $('#barChart').get(0).getContext('2d');
        var barChartData = $.extend(true, {}, areaChartData);
        var temp0 = areaChartData.datasets[0];
        var temp1 = areaChartData.datasets[1];
        barChartData.datasets[0] = temp1;
        barChartData.datasets[1] = temp0;

        new Chart(barChartCanvas, {
            type: 'bar',
            data: barChartData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: false
            }
        });
    }

    if ($('#donutChart1').length && data.currentYearDebitCredit) {
        new Chart($('#donutChart1').get(0).getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: ['Debit', 'Credit'],
                datasets: [{
                    data: [
                        data.currentYearDebitCredit.debits,
                        data.currentYearDebitCredit.credits
                    ],
                    backgroundColor: ['#00a65a', '#f56954']
                }]
            },
            options: {
                maintainAspectRatio: false,
                responsive: true
            }
        });
    }

    if ($('#donutChart2').length && data.overallDebitCredit) {
        new Chart($('#donutChart2').get(0).getContext('2d'), {
            type: 'pie',
            data: {
                labels: ['Debit', 'Credit'],
                datasets: [{
                    data: [
                        data.overallDebitCredit.debits,
                        data.overallDebitCredit.credits
                    ],
                    backgroundColor: ['#00a65a', '#f56954']
                }]
            },
            options: {
                maintainAspectRatio: false,
                responsive: true
            }
        });
    }
}
