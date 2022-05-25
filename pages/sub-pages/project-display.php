<?php

require_once('../config.php');
session_start();
if (!isset($_SESSION['username'])){
    header('Location: ../login.php');
}


if (isset($_SESSION['id']) && isset($_SESSION['username'])) {
                
    $user = $_SESSION['username'];
    $projectid = $_GET['id'];
    $orgid = $_GET['orgid'];

    $sql = "SELECT * FROM bugs WHERE projectID='$projectid'; ";
    $result = mysqli_query($con, $sql);

    $getproject = "SELECT * FROM projects WHERE id='$projectid'; ";
    $getprojectResult = mysqli_query($con, $getproject);
    
    $isDone = "SELECT * FROM bugs WHERE isDone='1' AND projectID='$projectid'; ";
    $isDoneResult = mysqli_query($con, $isDone);

    

    $inProgress = "SELECT * FROM bugs WHERE inProgress='1' AND projectID='$projectid'; ";
    $inProgressResult = mysqli_query($con, $inProgress);

    $highPriority = "SELECT * FROM bugs WHERE priority='high' AND projectID='$projectid';";
    $highPriorityResult = mysqli_query($con, $highPriority);

    $mediumPriority = "SELECT * FROM bugs WHERE priority='medium' AND projectID='$projectid';";
    $mediumPriorityResult = mysqli_query($con, $mediumPriority);

    $lowPriority = "SELECT * FROM bugs WHERE priority='low' AND projectID='$projectid';";
    $lowPriorityResult = mysqli_query($con, $lowPriority);

    

    $totalBugCount = mysqli_num_rows($result);

    $inProgressCount = mysqli_num_rows($inProgressResult);
    $highPriorityCount = mysqli_num_rows($highPriorityResult);
    $mediumPriorityCount = mysqli_num_rows($mediumPriorityResult);
    $lowPriorityCount = mysqli_num_rows($lowPriorityResult);


    $isDoneCount = mysqli_num_rows($isDoneResult);

    if ($getprojectResult->num_rows > 0) {
        while($row1 = $getprojectResult->fetch_assoc()) {
            $projectName = $row1['projectName'];
            $orgname = $row1['orgName'];
        }
    }
}





?>
<!DOCTYPE html>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="../../styles/styles.css">
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <title>Project Display</title>
        <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Bugs', 'Status Count'],
                <?php
                echo "['"."Bugs In Progress"."',".$inProgressCount."],";
                echo "['"."Finished Bugs"."',".$isDoneCount."],";
                ?>
                
            ]);

            var data1 = google.visualization.arrayToDataTable([
                ['Bugs', 'Priority Count'],
                <?php
                echo "['"."High Priority"."',".$highPriorityCount."],";
                echo "['"."Medium Priority"."',".$mediumPriorityCount."],";
                echo "['"."Low Priority"."',".$lowPriorityCount."],";
                ?>
                
            ]);

            

            var options = {
                backgroundColor: 'transparent',
                textStyle: 'white',
                legend: {  position: 'bottom', textStyle: {color: 'white' , fontSize: 14} },
                titleTextStyle: { color: 'white'  },
                pieSliceText: 'value-and-percentage',
                colors: ['#C70039', '#27C683'],
                pieSliceText: 'value'
            };

            var options1 = {
                backgroundColor: 'transparent',
                textStyle: 'black',
                legend: {  position: 'bottom', textStyle: {color: 'white' , fontSize: 14} },
                titleTextStyle: { color: 'white'  },
                pieSliceText: 'value-and-percentage',
                colors: ['#C70039', '#FF5733', '#27C683'],
                pieSliceText: 'value'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            var chart1 = new google.visualization.PieChart(document.getElementById('piechart1'));

            chart.draw(data, options);
            chart1.draw(data1, options1);
            
        }
        </script>
    </head>
    <body>
        <div class="container-fluid px-0">
            <div class="row no-gutters">
                <div class="nav-bar">
                    <ul>
                        <div class="title">
                            <li><h4>Bug Tracker</h4></li>
                        </div>
                        <li><a href="#">Dashboard</a></li>
                        <li><a href="#">Tickets</a></li>
                        <li><a href="../orgs.php">Organization</a></li>
                    </ul>
                </div>
            </div>  
            <?php
            
            ?>
                <span class="float-start" style="margin-left: 9vw; margin-top: 1vh;">
                    <button style="width: 5vw; height: 5vh;"  onclick="location.href='./org_display.php?id=<?=$orgid?>'" class="btn1">Back</button>
                </span>
                <?php
                    $sql2 = "SELECT * FROM org_members WHERE username='$user' AND orgID='$orgid' AND orgRole='owner' OR orgRole='editor'; ";
                    $result2 = mysqli_query($con, $sql2);
                    if ($result2->num_rows > 0) {
                        
                ?>
                <span class="float-end" style="margin-left: 9vw; margin-top: 1vh;">
                    <button onclick="location.href='./add-bugs.php?id=<?=$projectid?>&name=<?=$projectName?>&orgid=<?=$orgid?>&orgname=<?=$orgname?>'" class="btn1">Add Bug</button>
                </span>
                <?php
                    }
                ?>
                <div class="container" style="display: block-inline; margin-left: 10vw;">
                    <div class="row">
                        <div class="col-md-6">
                            <div  id="piechart" style=" color: 'white'; background-color: transparent; vertical-align:middle;  width: 32vw; height: 30vh;"></div>
                        </div>
                        <div class="col-md-6">
                            <div  id="piechart1" style=" color: 'white'; background-color: transparent; vertical-align:middle;  width: 32vw; height: 30vh;"></div>
                        </div>
                    </div>
                </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    </body>
</html>