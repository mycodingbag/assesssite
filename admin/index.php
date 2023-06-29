<!-- *** Head Section *** -->
<?php include('header_m.html'); ?>

    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>

            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <small>Visitors</small> 
                        </div>
                        <div id="visitor" class="card-body py-0 text-right pr-5" style="font-size:3em;">00</div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <small>Subscribers</small> 
                        </div>
                        <div id="subscriber" class="card-body py-0 text-right pr-5" style="font-size:3em;">00</div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <small>Enquirys</small> 
                        </div>

                        <?php
                            // Database Connection 
                            $host = 'localhost:3306';  
                            $user = 'root';  
                            $pass = '';  
                            $dbname = 'assessdb';

                            $conn = mysqli_connect($host, $user, $pass,$dbname);  
                            $sql = 'SELECT * FROM enquiryinfo';

                            $retval =  mysqli_query($conn, $sql);
                            $rowcount=mysqli_num_rows($retval);

                        ?>
                        <div class="card-body py-0 text-right pr-5" style="font-size:3em;"><?php echo $rowcount ?></div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <small>Today Visitor</small> 
                        </div>
                        <div id="todayvisitor" class="card-body py-0 text-right pr-5" style="font-size:3em;">00</div>
                    </div>
                </div>
            </div>




            <div class="row">
                <div class="col-md-8">
                    <!-- Line Graph -->
                    <div class="card mb-4">
                        <div class="card-header"><i class="fas fa-chart-area mr-1"></i>Number of Visitor in a Month</div>
                        <div class="chart-container" style="position: relative;">
                            <div style="text-align:right;margin-right:30px;padding:5px;">Year : <select id="yearid" onchange="updatechart(this.value)"> </select> </div>
                            <canvas id="myChart" height="100px"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <!-- Column Graph -->
                    <div class="card mb-4">
                        <div class="card-header"><i class="fas fa-chart-area mr-1"></i>Number of Visitor in a Year</div>
                        <div class="chart-container" style="position: relative;">
                            <canvas id="mybarchart" height="235px"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script>


    var ctx = document.getElementById('myChart').getContext('2d');
    var btx = document.getElementById('mybarchart').getContext('2d');
    var jsondata  = <?php echo file_get_contents('js/log.json');?>;
    var jsondata1  = <?php echo file_get_contents('js/subscriber.json');?>;
    var yearid = document.getElementById('yearid');
    var curdate = new Date();
    var visitors = 0;
    
    document.getElementById('visitor').innerHTML = jsondata.length;
    document.getElementById('subscriber').innerHTML = jsondata1.length;


    function updatechart(years){
    
        var datas = [0,0,0,0,0,0,0,0,0,0,0,0];
        var prevs = "";
        yearid.innerHTML = "";

        jsondata.forEach(element => {
            var date = new Date(element);
            if(prevs != date.getFullYear()){
                var createel = document.createElement("option");
                createel.innerHTML = date.getFullYear();
                createel.value = date.getFullYear();

                if(date.getFullYear() == years){
                    createel.setAttribute("selected",'selected');
                }
                yearid.appendChild(createel);
                prevs = date.getFullYear();
                
            }
            if(date.getFullYear() == years){
                datas[date.getMonth()]++;
            }
            if(date.getDay()==curdate.getDay()){
                visitors++; 
            }
        });
        console.log(datas);
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
                datasets: [{
                    label: 'Year '+years,
                    data: datas,
                    backgroundColor: [
                        'rgba(2,117,216,0.2)'
                    ],
                    borderColor: [
                        'rgba(2,117,216,1)'
                    ],
                    pointRadius: 5,
                    pointBackgroundColor: "rgba(2,117,216,1)",
                    pointBorderColor: "rgba(255,255,255,0.8)",
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "rgba(2,117,216,1)",
                    pointHitRadius: 50,
                    pointBorderWidth: 2,
                    lineTension: 0.3
                }]
            },
            options:{
                legend:{
                    display:true
                }
            }
        });

    }

    function updatebarchart(){
        var datas = [0,0,0];

        jsondata.forEach(element => {
            var date = new Date(element);
            if(curdate.getFullYear()-2 == date.getFullYear()){
                datas[0]++;
            }else if(curdate.getFullYear()-1 == date.getFullYear()){
                datas[1]++;
            }else if(curdate.getFullYear() == date.getFullYear()){
                datas[2]++;
            }

        });
        var myChart = new Chart(btx, {
            type: 'bar',
            data: {
                labels: [curdate.getFullYear()-2,curdate.getFullYear()-1,curdate.getFullYear()],
                datasets: [{
                    data: datas,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 206, 86, 0.5)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderWidth: 2
                }],
                options: {
                    legend: {
                        display: false
                        }
                    }
                }
        });
    }

    
    updatechart(curdate.getFullYear());
    updatebarchart();
    document.getElementById('todayvisitor').innerHTML = visitors;

    </script>

<!-- *** Footer Section *** -->
           
</div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>

    </body>
</html>
