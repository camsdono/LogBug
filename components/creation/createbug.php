<?php

require('../../backend/config.php');

session_start();

if(!$_SESSION['username'] == null) {
    $username = $_SESSION['username'];
} else {
    header("Location: ../auth/login.php");
}

$projectid = $_GET['id'];

$getProject = "SELECT * FROM projects WHERE id='$projectid'";
$getProjectRes = $conn->query($getProject);

if(mysqli_num_rows($getProjectRes) > 0) {
    while ($row = mysqli_fetch_array($getProjectRes)) {
        $projectName = $row['projectName'];
    }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title id="title">Create Bug</title>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width; initial-scale=1; maximum-scale=1; user-scalable=0">
        <meta name="author" content="Camsdono Studios">
        <meta name="description" content="A better place to keep track of your bugs and manage teams">

        <link rel="apple-touch-icon" sizes="180x180" href="../../images/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../../images/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="../../images/favicon/favicon-16x16.png">
        <link rel="manifest" href="../../images/favicon/site.webmanifest">

        <link rel="stylesheet" href="../../styles/styles.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <section class="blue">
            <div class="curve"></div>
            <div class="topnav" id="myTopnav">
                <a href="../root/home.php">Home</a>
                <a href="../root/organization.php">Organizations</a>
                <a href="#">Tickets</a>
                <a href="../../backend/auth/logout.php">Logout</a>

                <a href="javascript:void(0);" class="icon" onclick="OpenCloseNav()">
                    <i class="fa fa-bars"></i>
                </a>
            </div>

            <h2>Add Bug</h2>

            <div class="back-button" onclick="window.location = '../displays/projectdisplay.php?id=<?=$projectid?>&page=1'">
                <h4 class="back-button-item">Back</h4>
            </div>

            <form method="POST" action="../../backend/createprocesses/createbugprocess.php">
                <div class="input-row">
                    <input type="text"  maxlength="20"  placeholder="Bug Name" name="bugName" require>
                </div>
                <div class="input-row">
                    <input type="text"  maxlength="50"  placeholder="Bug Description" name="bugDesc" require>
                </div>
                <label for="priority">priority:</label>
                <div class="input-row">
                    <select name="priority" id="priority" require>
                        <option value="low">Low</option>
                        <option value="medium">Medium</option>
                        <option value="high">High</option>
                    </select>
                </div><br>
                <label>Due Date:</label>
                <div class="input-row">
                    <input type="date" name="dueDate" require>
                </div>
                <div class="input-row" style="display: none;">
                    <input type="text" value="<?=$projectid?>" name="projectID" hidden>
                </div>
                <div class="input-row" style="display: none;">
                    <input type="text" value="<?=htmlspecialchars($projectName)?>" name="projectName" hidden>
                </div>
                <div class="input-row">
                    <input type="submit" value="Add Bug" name="create-bug-btn">
                </div>

                
            </form>
        </section>
        <footer>
            <p class="footer-txt">@Camsdono Studios</p>
        </footer>
    </body>
</html>
<script src="../../js/openCloseNavBar.js"></script>