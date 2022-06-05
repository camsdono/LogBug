<?php

require_once('../config.php');
session_start();
if (!isset($_SESSION['username'])){
    header('Location: ../login.php');
}

$bugname = $_GET['bugname'];
$orgid = $_GET['orgid'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <title>Edit Bugs</title>
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
        <span class="float-start" style="margin-left: 9vw; margin-top: 1vh;">
            <button style="width: 5vw; height: 5vh;"  onclick="location.href='./project-display.php?id=<?=$_GET['projectid']?>&orgid=<?=$_GET['orgid']?>'" class="btn1">Back</button>
        </span>
        <div class="body2">
            
            <div class="col-12">
                <h6>Change Bug Information:</h6><br>
                <form action="../process.php" method="post">
                    <input type="text" placeholder="Bug Name" class="txt1" name="bugname" required><br>
                    <input type="text" placeholder="Bug Description" class="txt1" name="bugdesc" required><br>
                    <input type="text" style="display: none;" value="<?=$_GET['id']?>" class="txt1" name="bugid" required>
                    <input type="text" style="display: none;" value="<?=$_GET['projectid']?>" class="txt1" name="projectid" required>
                    <input type="text" value=<?=$orgid ?> class="txt1" name="orgid" required style="display: none;">
                    <input type="submit" value="Submit Changes" class="btn" name="btn-edit-bug"><br>
                </form><br>

                <div class="innerModal" id="modal" style="display: none;">
                    <div class="fixedHolder">
                        <table>
                            <tr>
                                <td>

                                    <div class="innerModalHolder" id="" style="max-width: 40vh;">
                                        <div class="innerHeader">
                                            <div class="innerTitle">
                                                Notice
                                            </div>
                                        </div>
                                        <div class="innerContent">

                                            <div class="info">
                                                <p>The user you tried assigning is already assigned to this bug</p><br>

                                            </div>

                                            <div class="buttonHolder">
                                                <div class="button button1" onclick="CloseModal();">
                                                    Confirm
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <script>
                    <?php
                        if($_GET['useradded'] == "true") {
                            ?>
                                OpenModal();
                            <?php
                        }
                    ?>

                    function OpenModal(){
                        var options = document.getElementById("modal");
                        options.style.display = "block";
                    }

                    function CloseModal(){
                        var options = document.getElementById("modal");
                        options.style.display = "none";
                    }



	            </script>

                <form action="../process.php" method="post">
                    <h6>Assign Bug:</h6><br>
                    <input type="text" placeholder="Username" class="txt1" name="username" required><br>
                    <input type="text" value=<?=$bugname ?> class="txt1" name="bugname" required style="display: none;">
                    <input type="text" value=<?=$orgid ?> class="txt1" name="orgid" required style="display: none;">
                    <input type="text" style="display: none;" value="<?=$_GET['id']?>" class="txt1" name="bugid" required>
                    <input type="text" style="display: none;" value="<?=$_GET['projectid']?>" class="txt1" name="projectid" required>
                    Due date: <input type="date" placeholder="Date Due" class="txt1" name="duedate" required><br><br>
                    <input type="submit" value="Assign User" class="btn" name="btn-assign-bug"><br>
                </form>
            </div>
            
        </div> 
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>