$(function () {
    window.data_bp_chart = function (id, total, jml1, jml2, jml3, tot1, tot2, tot3) {
        $(id).highcharts({
            chart: {
                type: 'bar',
                renderTo: id
            }, title: {
                text: ''
            },
            subtitle: {
                text: 'Progres BP yang sudah di-LPJ-kan'
            },
            xAxis: {
                categories: ['Data']
            }, yAxis: {
                min: 0,
                max: 100,
                title: {
                    text: 'Total Data BP : <b>' + total + '</b>'
                },
                labels: {
                    formatter: function () {
                        return this.value + '%';
                    }
                }

            },
            legend: {
                enabled: false
            },
            plotOptions: {
                series: {
                    stacking: 'normal',
                    pointWidth: 50
                }
            },
            tooltip: {
                valueSuffix: '',
                formatter: function () {
                    return "<b>" + this.point.val + " BP " + this.series.name + " (" + Math.round(this.point.y * 100) / 100 + "%)</b>";
                }
            },
            credits: {
                enabled: false
            },
            series: [{
                    name: 'Draft',
                    data: [{y: jml1, val: tot1}],
                    color: '#fad687'}, {
                    name: 'Final',
                    data: [{y: jml2, val: tot2}],
                    color: '#5cb85c',
                },
                {
                    name: 'Sudah LPJ',
                    data: [{y: jml3, val: tot3}],
                    color: '#81e2d7'
                }]
        });
    }
    window.data_bp = function (id, jml1, jml2) {
        $(id).sparkline([jml1, jml2], {
            type: 'pie',
            width: '100px',
            height: '80px',
            sliceColors: ['#d9534f', '#5cb85c'],
            borderWidth: 1,
            borderColor: '#f5f5f5',
            tooltipFormat: '<span style="color: {{color}}">&#9679;</span> {{offset:names}} ({{percent.1}}%)',
            tooltipValueLookups: {
                names: {
                    0: 'Belum di LPJ kan',
                    1: 'Sudah di LPJ kan'
                }
            }
        });
    }
});
