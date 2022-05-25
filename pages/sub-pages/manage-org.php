<?php
require_once('../config.php');
session_start();
if (!isset($_SESSION['username'])){
    header('Location: ../login.php');
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Bug Tracker | Manage Org</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="../../styles/styles.css">
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
            <div class="body1">
                <div class="col">
                    <form action="../process.php?" method="post">
                        <h5 style="margin-left: 0vw;">Add User:</h5>
                        <input type="text" placeholder="Add User (Email)" class="txt1" name="email" style="width: 20vw;" required><br>
                        
                        Permissions: 
                        <select name="role" class="txt1" required>
                            <option value="guest">Guest</option>
                            <option value="member">Member</option>
                            <option value="editor">Editor</option>
                            <option value="owner">Owner</option>
                        </select><br><br>

                        <input type="text" value="<?=$_GET['id']?>" class="txt1" name="id" style="display: none;" required>
                        <input type="submit" value="Add User" class="btn2" name="btn-adduser-org"><br>
                    </form>
                    <h5 style="margin-left: 0vw;">Org Members:</h5>
                </div>
            </div>
        </div>
            
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    </body>
</html>