<?php

require_once('config.php');

if(isset($_POST['btn-login'])) {
    session_start();
    
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $Pass = md5($password);
    

    $sql = "SELECT * FROM users WHERE username = '$username' AND password='$Pass'";
    $result = mysqli_query($con, $sql);
    
    if(mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        if($row['username'] === $username && $row['password'] === $Pass) {
            echo "Logged In";
            $_SESSION['username'] = $row['username'];
            $_SESSION['id'] = $row['id'];
            $_SESSION['email'] = $row['email'];
            header("Location: home.php");
        } else {
            header("Location: login.php?"); 
            echo "Incorrect username or password";
            exit();
        }
    } else {
        header("Location: login.php?"); 
        echo "Incorrect username or password";
        exit();
    } 
}

if(isset($_POST['btn-signup'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    $firstname = mysqli_real_escape_string($con, $_POST['firstname']);
    $surname = mysqli_real_escape_string($con, $_POST['surname']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $dob = mysqli_real_escape_string($con, $_POST['dob']);

    if($password != $cpassword) {
        header("Location: signup.php?"); 
        echo "Passwords do not match";
    }
    else {
        $Pass = md5($password);
        $sql = "INSERT INTO users (username, firstname, surname, password, email, dob) values('$username', '$firstname', '$surname', '$Pass', '$email', '$dob')";
        $result = mysqli_query($con, $sql);

        if($result) {
            echo "Your account has been created";
            header("Location: login.php"); 
        } else {
            echo "An error has occured please try again later";
            header("Location: signup.php?"); 
        }
    }
}

if(isset($_POST['btn-create-org'])) {
    session_start();
    $orgname = mysqli_real_escape_string($con, $_POST['orgname']);
    $orgdesc = mysqli_real_escape_string($con, $_POST['orgdesc']);
    $orgemail = mysqli_real_escape_string($con, $_POST['orgemail']);

    
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];


    $sql = "INSERT INTO orgs (org_name, org_description, org_email, org_owner) values('$orgname', '$orgdesc', '$orgemail', '$username')";
    $result = mysqli_query($con, $sql);
        
    if($result) {
        echo "Your org has been created";
        $last_id = $con->insert_id;

        $sql1 = "INSERT INTO org_members (username, email, orgID, orgName, orgRole, confirmJoined) values('$username', '$email', '$last_id', '$orgname', 'owner', '1')";
        $result1 = mysqli_query($con, $sql1);
        if($result1) {
            header("Location: ./orgs.php"); 
        } else {
            header("Location: ./orgs.php?"); 
            echo "An error has occured please try again later";
        }
        
    } else {
        echo "An error has occured please try again later";
        header("Location: ./orgs.php?"); 
    }
}

if(isset($_POST['btn-create-project'])) {
    require_once('./config.php');
    session_start();
    $projectname = mysqli_real_escape_string($con, $_POST['projectname']);
    $projectdesc = mysqli_real_escape_string($con, $_POST['projectdesc']);
    $orgid = mysqli_real_escape_string($con, $_POST['id']);
    
    $username = $_SESSION['username'];
    
    
    $sql1 = "SELECT * FROM orgs WHERE id='$orgid'; ";
    $result1 = mysqli_query($con, $sql1);

    if ($result1->num_rows > 0) {
        while($row = $result1->fetch_assoc()) {
            $orgname = $row['org_name'];
            $sql = "INSERT INTO projects (projectName, projectDescription, orgID, orgName) values('$projectname', '$projectdesc', '$orgid', '$orgname')";
            $result = mysqli_query($con, $sql);

            if($result) {
                echo "Your org has been created";
                header("Location: ./orgs.php"); 
            } else {
                echo "An error has occured please try again later";
                header("Location: ./orgs.php?"); 
            }
        }
    }


    
}

if(isset($_POST['btn-adduser-org'])) {
    require_once('./config.php');
    session_start();
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $orgid = mysqli_real_escape_string($con, $_POST['id']);

    $orgRole = mysqli_real_escape_string($con, $_POST['role']);

    $sql2 = "SELECT * FROM orgs WHERE id='$orgid'; ";
    $result2 = mysqli_query($con, $sql2);
    
    
    $sql1 = "SELECT * FROM users WHERE email='$email'; ";
    $result1 = mysqli_query($con, $sql1);

    if ($result1->num_rows > 0) {
        while($row = $result1->fetch_assoc()) {
        
            while($row1 = $result2->fetch_assoc()) {
                $username = $row['username'];
                $confirmcode = random_int(000000, 999999);
                $message = "You have been added to a org click the link to verify you want to join: http://localhost/bug-tracker/pages/sub-pages/join-org.php?user=$username&code=$confirmcode";
                    
                $orgname = $row1['org_name'];
                
                $sql = "INSERT INTO org_members (username, email, orgID, orgName, orgRole, joinCode, confirmJoined) values('$username', '$email', '$orgid', '$orgname', '$orgRole', '$confirmcode', '0')";
                $result = mysqli_query($con, $sql);

                mail($email, "Bug Tracker, Added To Org", $message, "From: DoNotReply@bugtracker.com");
            }

            if($result) {
                echo "User has been added to org";
                header("Location: ./orgs.php"); 
            } else {
                echo "An error has occured please try again later";
                header("Location: ./orgs.php?"); 
            }
        }
    }
}

if(isset($_POST['btn-addbug-project'])) {
    require_once('./config.php');
    session_start();

    $bugName = mysqli_real_escape_string($con, $_POST['bugname']);
    $bugDesc = mysqli_real_escape_string($con, $_POST['bugdesc']);
    $priority = mysqli_real_escape_string($con, $_POST['priority']);
    $projectid = mysqli_real_escape_string($con, $_POST['projectid']);
    $projectname = mysqli_real_escape_string($con, $_POST['projectname']);
    $orgid = mysqli_real_escape_string($con, $_POST['orgid']);
    $orgname = mysqli_real_escape_string($con, $_POST['orgname']);
    $createduser = mysqli_real_escape_string($con, $_POST['createdUser']);
    $dateCreated = mysqli_real_escape_string($con, $_POST['dateCreated']);

    $sql = "INSERT INTO bugs (bugName, bugDescription, projectID, projectName, orgID, orgName, createdUser, dateCreated, needsDone, priority) 
    values('$bugName', '$bugDesc', '$projectid', '$projectname', '$orgid', '$orgname', '$createduser', '$dateCreated', '1', '$priority')";
    $result = mysqli_query($con, $sql);
    if($result) {
        echo "Bug Has Been Created";
        header("Location: ./sub-pages/project-display.php?id=$projectid&orgid=$orgid"); 
    } else {
        echo "An error has occured please try again later";
        header("Location: ./sub-pages/project-display.php?id=$projectid&orgid=$orgid"); 
    }
}

if(isset($_POST['btn-edit-bug'])) {
    require_once('./config.php');
    session_start();

    $bugname = mysqli_real_escape_string($con, $_POST['bugname']);
    $bugDesc = mysqli_real_escape_string($con, $_POST['bugdesc']);
    $bugID = mysqli_real_escape_string($con, $_POST['bugid']);
    $orgid = mysqli_real_escape_string($con, $_POST['orgid']);
    $projectid = mysqli_real_escape_string($con, $_POST['projectid']);

    $sql = "SELECT * FROM bugs WHERE id=$bugID";
    $result = mysqli_query($con, $sql);

    if($result) {
       
        $updateBug = "UPDATE bugs SET bugName='$bugname', bugDescription='$bugDesc' WHERE id=$bugID";
        $result1 = mysqli_query($con, $updateBug);
        
        if($result1) {
            if ($result->num_rows > 0) {
                while($row = $result -> fetch_assoc()) {
                    $projectid = $row['projectID'];
                }
            }
            echo "Bug Has Been Created";
            header("Location: ./sub-pages/edit-bugs.php?id=$bugID&orgid=$orgid&bugname=$bugname&projectid=$projectid"); 
        } else {
            echo "An error has occured please try again later";
            header("Location: ./sub-pages/edit-bugs.php?id=$bugID&orgid=$orgid&bugname=$bugname&projectid=$projectid"); 
        }
       
    } else {
        echo "An error has occured please try again later";
        header("Location: ./sub-pages/edit-bugs.php?id=$bugID&orgid=$orgid&bugname=$bugname&projectid=$projectid"); 
    }
}

if(isset($_POST['btn-assign-bug'])) {
    require_once('./config.php');
    session_start();

    $bugname = mysqli_real_escape_string($con, $_POST['bugname']);
    $orgid = mysqli_real_escape_string($con, $_POST['orgid']);
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $duedate = mysqli_real_escape_string($con, $_POST['duedate']);
    $bugID = mysqli_real_escape_string($con, $_POST['bugid']);
    $date = date("Y-m-d");

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($con, $sql);

    if($result) {
        
        $sql2 = "SELECT * FROM bugs_assigned WHERE assingedUser='$username'";
        $result2 = mysqli_query($con, $sql2);
        if(!$result2) {
            $sql1 = "INSERT INTO bugs_assigned (bugName, orgID, assingedUser, dateAssigned, dueDate) values('$bugname', '$orgid', '$username', '$date', '$duedate')";
            $result1 = mysqli_query($con, $sql1);
        } else {
            header("Location: ./sub-pages/edit-bugs.php?id=$bugID&orgid=$orgid&bugname=$bugname&useradded=true"); 
            echo "<span style='color:white;text-align:center;'>User you tried adding alredy is added</span>";
        }
    } else {
        header("Location: ./sub-pages/edit-bugs.php?id=$bugID&orgid=$orgid&bugname=$bugname"); 
        echo "<span style='color:white;text-align:center;'>An error has occured please try again later</span>";
    }
}

?>