<?php
require_once('../config.php');
session_start();
if (!isset($_SESSION['username'])){
    header('Location: login.php');
}

?>

<!DOCTYPE html>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="../../styles/styles.css">
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
                        <li><a href="../orgs.php">Organization</a></li>
                    </ul>
                </div>
            </div>
            
                    <div class="col-12">
                        <?php
                            if (isset($_SESSION['id']) && isset($_SESSION['username'])) {
                                $user = $_SESSION['username'];
                                $orgid = $_GET['id'];
                                $sql = "SELECT * FROM orgs WHERE id='$orgid'; ";
                                $result = mysqli_query($con, $sql);

                                $sql1 = "SELECT * FROM projects WHERE orgID='$orgid'; ";
                                $result1 = mysqli_query($con, $sql1);
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                    ?>

                                        <head>
                                            <title><?=$row['org_name'] ?> Projects</title>
                                        </head>
                                        <div class="body py-2 g-0">
                                            <div class="row g-0">
                                                <div class="col-12">
                                                        <h3><?=$row['org_name'] ?> Projects
                                                        <?php
                                                        $sql2 = "SELECT * FROM org_members WHERE username='$user' AND orgID='$orgid' AND orgRole='owner'; ";
                                                        $result2 = mysqli_query($con, $sql2);
                                                        if ($result2->num_rows > 0) {
                                                            
                                                            ?>
                                                                <span class="float-end">
                                                                    <button onclick="location.href='./create-project.php?id=<?=$row['id']?>'" class="btn1">Create Project</button>
                                                                </span>
                                                                <span class="float-end">
                                                                    <button onclick="location.href='./manage-org.php?id=<?=$row['id']?>'" class="btn1">Manage Org</button>
                                                                </span>
                                                            <?php
                                                            
                                                        } 
                                                        ?>
                                                    </h3>
                                                </div>
                                            </div>
                        
                                <?php
                                    if ($result1->num_rows > 0) {
                                        while($row1 = $result1->fetch_assoc()) {
                                            ?>
                                            <div class="card" id="card" name="card" onclick="location.href='./project-display.php?id=<?=$row1['id']?>&orgid=<?=$orgid?>'">
                                                <h4 style="padding-top: 5px;">
                                                    <?=$row1["projectName"] ?>
                                                </h4>
                                                <p>
                                                    Org Name:
                                                    <?=$row1["orgName"] ?>
                                                </p>
                                                <p>
                                                    Description:<br>
                                                    <?=$row1["projectDescription"] ?>
                                                </p>
                                            </div>

                                
                                <?php
                                    }
                                } else {
                                    ?>
                                        <p>No Projects To Display. How About You Create One?</p>
                                    <?php
                                }
                                }
                                } else {
                                    ?>
                                    <title>Bug Tracker | Projects</title>
                                    <?php
                                    echo "Org has either been deleted or made private";
                                }
                            } else {
                                header("Location: ../login.php");
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