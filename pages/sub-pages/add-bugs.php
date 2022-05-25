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
        <title>Add Bug</title>
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
                <button style="width: 5vw; height: 5vh;"  onclick="location.href='./project-display.php?id=<?=$_GET['id']?>&orgid=<?=$_GET['orgid']?>'" class="btn1">Back</button>
            </span>
            <div class="body1">
                <div class="col-12">
                    
                    <form action="../process.php" method="post">
                        <input type="text" placeholder="Bug Name" name="bugname" class="txt1" required><br>
                        <input type="text" placeholder="Bug Description" name="bugdesc" class="txt1" required><br>
                        Bug Priority: 
                        <select name="priority" class="txt1" required>
                            <option value="low">Low</option>
                            <option value="medium">Medium</option>
                            <option value="high">High</option>
                        </select><br><br>
                        <input type="text" value="<?=$_GET['id']?>" class="txt1" name="projectid" style="display: none;" required>
                        <input type="text" value="<?=$_GET['name']?>" class="txt1" name="projectname" style="display: none;" required>
                        <input type="text" value="<?=$_GET['orgid']?>" class="txt1" name="orgid" style="display: none;" required>
                        <input type="text" value="<?=$_GET['orgname']?>" class="txt1" name="orgname" style="display: none;" required>
                        <input type="text" value="<?=$_SESSION['username']?>" class="txt1" name="createdUser" style="display: none;" required>
                        <input type="text" value="<?=date("Y-m-d")?>" class="txt1" name="dateCreated" style="display: none;" required><br>
                      
                        <input type="submit" value="Add Bug" class="btn2" name="btn-addbug-project"><br>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>