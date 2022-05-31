<?php
require_once('config.php');
session_start();
if (!isset($_SESSION['username'])){
    header('Location: login.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Bug Tracker | Orgs</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="../styles/styles.css">
    </head>
    <body>
        <div class="container-fluid px-0">
            <div class="row g-0">
                <div class="nav-bar">
                    <ul>
                        <div class="title">
                            <li>
                                <h4>Bug Tracker</h4>
                            </li>
                        </div>
                        <li><a href="#">Dashboard</a></li>
                        <li><a href="#">Tickets</a></li>
                        <li><a href="orgs.php">Organization</a></li>
                    </ul>
                </div>
            </div>
            <div class="body py-2 g-0">
            <div class="row g-0">
                <div class="col-12">
                    <h3>Organizations
                        <span class="float-end">
                            <button onclick="window.location.href='./sub-pages/create-org.php'" class="btn1">Create Org</button>
                        </span>
                    </h3>
                </div>
            
                <div class="row g-4">
                    <div class="col-12">
                        <?php
                            if (isset($_SESSION['id']) && isset($_SESSION['username'])) {
                                $user = $_SESSION['username'];
                                $sql = "SELECT * FROM org_members WHERE confirmJoined='1' AND username='$_SESSION[username]'";
                                $result = mysqli_query($con, $sql);

                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        $sql1 = "SELECT * FROM orgs WHERE id='$row[orgID]'";
                                        $result1 = mysqli_query($con, $sql1);
                                        $row1 = $result1->fetch_assoc();

                        ?>
                        <div class="card" id="card" onClick="location.href='./sub-pages/org_display.php?id=<?=$row["orgID"] ?>'" name="card">
                            <h4 style="padding-top: 5px;">
                                
                                <?=$row["orgName"] ?>
                            </h4>
                            <p>
                                Owner:
                                <?=$row1["org_owner"] ?>
                            </p>
                            <p>
                                Description:<br>
                                <?=$row1["org_description"] ?>
                            </p>
                        </div>
                        <?php
                                        
                                }
                                } else {
                                    echo "You are not in any orgs how about you join one?";
                                }
                                
                            } else {
                                header("Location: login.php");
                                exit();
                            }

                        ?>
                    </div>
                </div>

                
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    </body>
</html>