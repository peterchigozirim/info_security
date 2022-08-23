<div class="row">
    <div class="col-md-6">
        <div class="tile">
        <h3 class="tile-title">Personnel'S Attendance Statistics</h3>
        <div class="embed-responsive embed-responsive-16by9">
            <canvas class="embed-responsive-item" id="lineChartDemo"></canvas>
        </div>
        <div class="row" style="margin-top:10px;">
            <div class="col-md-6"><span class="key" id="key5"></span> Attendance flow</div>
        </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="tile">
        <h3 class="tile-title">Punctuality Percentage - %</h3>
        <div class="embed-responsive embed-responsive-16by9">
            <canvas class="embed-responsive-item" id="pieChartDemo"></canvas>
        </div>
        <div class="row" style="margin-top:10px;">
            <div class="col-md-6"><span class="key" id="key1"></span> Punctual</div>
            <div class="col-md-6"><span class="key" id="key2"></span> Late</div>
        </div>
        </div>
    </div>
</div>


<!-- Page specific javascripts-->
<script type="text/javascript" src="js/plugins/chart.js"></script>
<script type="text/javascript">
    function checkAttendance() {
        $empid = $('input[name=empid]').val();
        $.ajax({
            type: 'post',
            url: 'backend/attendance_mngr.php',
            data: {empid: $empid, action:'fetch_stats'},
            dataType: 'json',
            success: function (res) {
                console.log(res);
                loadchart(res.stats);
            }
        })
    }
    checkAttendance()
    function loadchart(statistics) {
        var data = {
            labels: statistics.mon_labels,
            datasets: [
                {
                    label: "Healthy Refugee",
                    fillColor: "rgba(151,187,205,0.2)",
                    strokeColor: "rgba(151,187,205,1)",
                    pointColor: "rgba(151,187,205,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(151,187,205,1)",
                    data: statistics.mon_data,
                }
            ]
        };
        var pdata = [
            {
                value: 30,
                color:"#F7464A",
                highlight: "#FF5A5E",
                label: "% for Late"
            },
            {
                value: 70,
                color:"#222d32",
                highlight: "#444d32",
                label: "% for Puntuality"
            }
        ];
        
        var ctxl = $("#lineChartDemo").get(0).getContext("2d");
        var lineChart = new Chart(ctxl).Line(data);
        
        var ctxp = $("#pieChartDemo").get(0).getContext("2d");
        var pieChart = new Chart(ctxp).Pie(pdata);
    }
</script>