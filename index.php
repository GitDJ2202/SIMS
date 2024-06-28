<?php
    session_start();
?>

<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" type="text/css" href="css/login.css">
<link rel="stylesheet" type="text/css" href="css/background.css">

</head>
<?php
    include('db.php');
    include('addUserSession.php');

    if($_GET['id'] == 'logout') 
    {
        session_destroy();
        echo "<script>location='index.php';</script>";
    }    
    else if(isset($_POST['btnLogin']))
	{
        if($_POST['txtUserId'] != "" && $_POST['txtPassword'] != "")
        {
            $uid = $_POST['txtUserId'];
            $pass = $_POST['txtPassword'];
            
            $CheckUser = "SELECT * FROM userLogin WHERE id = '".strtoupper(trim($uid))."' AND pword = '".md5(trim($pass))."'";
            $CheckUserResult = $con->query($CheckUser);
            if($CheckUserResult->num_rows > 0)
            {
               $row = $CheckUserResult->fetch_array(MYSQLI_ASSOC);
                $_SESSION['userID'] = $row['id'];
                $_SESSION['AccType'] = $row['userRole'];
                $_SESSION['loginStatus'] = '1';

                echo "<script>location='./dashboard.php';</script>";
            } 
            else 
            {
                echo "<script>alert('Invalid credentials');</script>";
            }
        }
    }
?>

<body id="login">

    <div class="container">
      <div class="loginHeader">
          <h1>SIMS</h1>
          <p>School Inventory Management System</p>
      </div>
        
      <form action="index.php" method="POST" class="loginBody">
      <div class="loginInput">
          <label for="">User ID</label>
          <input placeholder="User ID" name="txtUserId" type="text" required/>
      </div>
      <div class="loginInput">
          <label for="">Password</label>
          <input placeholder="Password" name="txtPassword" type="password" required/>
      </div>
      <div class="loginBtn">
         <input type="submit" name="btnLogin" id="btnLogin" value="Login">
      </div>
      </form>
      
    </div>

</body>
</html>
