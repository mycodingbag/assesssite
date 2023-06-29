<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<body>
    
    <div class="chart-container" style="position: relative;">
        <div style="text-align:right;margin-right:30px;padding:5px;">Year : <select id="yearid" onchange="updatechart(this.value)"> </select> </div>
        <canvas id="myChart" height="50px"></canvas>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script>


    var ctx = document.getElementById('myChart').getContext('2d');
    var jsondata  = <?php echo file_get_contents('js/log.json');?>;
    var yearid = document.getElementById('yearid');

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
        console.log(date.getMonth());
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
                    'rgba(255, 99, 132, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        },
        options:{
            legend:{
                display:false
            }
        }
    });

    }

    var curdate = new Date();
    updatechart(curdate.getFullYear());



    </script>
</body>
</html>