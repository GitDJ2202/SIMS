<?php
    session_start();
    include('db.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Dashboard</title>
        <link rel="stylesheet" type="text/css" href="./css/login.css">
        <link rel="stylesheet" type="text/css" href="./css/dashboard.css">
        <link rel="stylesheet" type="text/css" href="./css/form.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        
    </head>

    <body>
        <div id="dashboardMainContainer">
            <!-- sidebar -->
            <?php
                include('./partials/sidebar.php');
            ?>
            <div class="dashboard_contentContainer" id="dashboard_contentContainer">
            <!-- nav-bar -->
                <?php
                    include('./partials/topnav.php');
                ?>
            <!-- content -->
                <div class="dashboard_content">
                    <div class="dashboard_contentMain">
                        <?php
                        if($_SESSION['loginStatus'] == '1')
                        {   /*Only adminsitrator can add*/
                            if($_SESSION['AccType'] == "SYSTEM ADMINISTRATOR")
                            {

                                    if($_POST['btnUpdate'])
                                    {
                                        //Retrieve data from the form
                                        $id = trim($_POST["txtId"]);
                                        $password = md5(trim($_POST["txtPass"]));
                                        $role = "USER";
                                        $fname = strtoupper(trim($_POST["txtFName"]));
                                        $lname = strtoupper(trim($_POST["txtLName"]));
                                        $dob = $_POST["txtDob"];
                                        $gender = $_POST["txtGender"];
                                        $status = $_POST["Status"];
                                        $phone = trim($_POST["txtPhone"]);
                                        $email = trim($_POST["txtEmail"]);
                                        $address = strtoupper(trim($_POST["txtAddress"]));
                                        $postcode = trim($_POST["txtPostcode"]);
                                        $city = strtoupper(trim($_POST["txtCity"]));
                                        $state = strtoupper(trim($_POST["txtState"]));
                                        $country = strtoupper(trim($_POST["txtCountry"]));

                                        $QueryUserLogin = "UPDATE userLogin SET `pword` = '$password',
                                        `status` = '$status' WHERE `id` = '$id' ";
                                        $result_userLogin = $con->query($QueryUserLogin);

                                        $QueryUser = "UPDATE users SET `Fname` = '$fname',
                                        `Lname` = '$lname',
                                        `DOB` = '$dob',
                                        `gender` = '$gender' WHERE `id` = '$id'";
                                        $result_user = $con->query($QueryUser);

                                        $QueryContact = "UPDATE contact SET `phoneNo` = '$phone', 
                                        `email` = '$email',
                                        `address` = '$address',
                                        `postcode` = '$postcode',
                                        `city` = '$city',
                                        `state` = '$state',
                                        `country` = '$country' WHERE `id` = '$id' ";
                                        $result_Contact = $con->query($QueryContact);

                                        if($result_userLogin && $result_user && $result_Contact)
                                            echo "<script>alert('Record updated');</script>";
                                    }
                                    
                                    if (isset($_POST['btnSubmit'])) 
                                    {
                                        if($_POST["txtId"]!="" && $_POST["txtPass"]!="" && $_POST["Status"]!="" && $_POST["txtFName"]!="" && $_POST["txtLName"]!="" && $_POST["txtDob"]!="" && 
                                           $_POST["txtGender"]!="" && $_POST["txtPhone"]!="" && $_POST["txtEmail"]!="" && $_POST["txtAddress"]!="" && $_POST["txtPostcode"]!="" && $_POST["txtCity"]!="" && 
                                           $_POST["txtState"]!="" && $_POST["txtCountry"]!="")
                                           {
                                                //Retrieve data from the form
                                                $id = trim($_POST["txtId"]);
                                                $password = md5(trim($_POST["txtPass"]));
                                                $role = "USER";
                                                $fname = strtoupper(trim($_POST["txtFName"]));
                                                $lname = strtoupper(trim($_POST["txtLName"]));
                                                $dob = $_POST["txtDob"];
                                                $gender = $_POST["txtGender"];
                                                $status = $_POST["Status"];
                                                $phone = trim($_POST["txtPhone"]);
                                                $email = trim($_POST["txtEmail"]);
                                                $address = strtoupper(trim($_POST["txtAddress"]));
                                                $postcode = trim($_POST["txtPostcode"]);
                                                $city = strtoupper(trim($_POST["txtCity"]));
                                                $state = strtoupper(trim($_POST["txtState"]));
                                                $country = strtoupper(trim($_POST["txtCountry"]));
                                                
                                                //Saving to database or displaying the data
                                                echo "<h2>Submitted Data:</h2>";
                                                echo "<p>ID: $id</p>";
                                                echo "<p>FName: $fname</p>";
                                                echo "<p>LName: $lname</p>";
                                                echo "<p>Date of Birth: $dob</p>";
                                                echo "<p>Gender: $gender</p>";
                                                echo "<p>Status: $status</p>";
                                                echo "<p>Phone Number: $phone</p>";
                                                echo "<p>Email: $email</p>";
                                                echo "<p>Address: $address</p>";
                                                echo "<p>Postcode: $postcode</p>";
                                                echo "<p>City: $city</p>";
                                                echo "<p>State: $state</p>";
                                                echo "<p>Country: $country</p>";  
                                                
                                                $addUserLoginQuery = "INSERT INTO userLogin (id, pword, userRole, `status`) VALUES
                                                                ('".strtoupper(trim($_POST["txtId"]))."', 
                                                                '".md5(trim($_POST["txtPass"]))."',
                                                                'USER',
                                                                '".strtoupper(trim($_POST["Status"]))."')";
                                                $addUserLoginResult = $con->query($addUserLoginQuery);
                                                //var_dump($addUserLoginResult);
                                                
                                                $addUserQuery = "INSERT INTO users (id, Fname, Lname, DOB, gender) VALUES
                                                                ('".strtoupper(trim($_POST["txtId"]))."', 
                                                                '".strtoupper(trim($_POST["txtFName"]))."',
                                                                '".strtoupper(trim($_POST["txtLName"]))."',
                                                                '".trim($_POST["txtDob"])."',
                                                                    '".strtoupper(trim($_POST["txtGender"]))."')";
                                                $addUserResult = $con->query($addUserQuery);
                                                //var_dump($addUserResult);
                                            
                                                $addContactQuery = "INSERT INTO contact (id, phoneNo, email, `address`, postcode, city, `state`, country) VALUES
                                                                    ('".strtoupper(trim($_POST["txtId"]))."',
                                                                    '".trim($_POST["txtPhone"])."',
                                                                    '".trim($_POST["txtEmail"])."',
                                                                    '".strtoupper(trim($_POST["txtAddress"]))."',
                                                                    '".trim($_POST["txtPostcode"])."',
                                                                    '".strtoupper(trim($_POST["txtCity"]))."',
                                                                    '".strtoupper(trim($_POST["txtState"]))."',
                                                                    '".strtoupper(trim($_POST["txtCountry"]))."')";
                                                $addContactResult = $con->query($addContactQuery);
                                                //var_dump($addContactResult);
                                                
                                                if ($addUserLoginResult && $addUserResult && $addContactResult) {
                                                    echo "<script>alert('New User Info Added');</script>";
                                                }
                                           }else{
                                                echo "<script>alert('Enter all fields please!!');</script>";
                                           }
                                        
                                    
                                }

                                if(trim($_GET['id']) != "")
                                {
                                    $Query = "SELECT * FROM userLogin, users, contact WHERE contact.id = userLogin.id AND userLogin.id = users.id AND users.id = '".strtoupper(trim($_GET['id']))."'";
                                    $Result = $con->query($Query);
                                    if($Result->num_rows > 0)
                                        $Row = $Result->fetch_array(MYSQLI_ASSOC);
                                }


                                ?>
                                
                                <div class="form-main">
                                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                        <fieldset id="info">
                                            <legend><h1>Add User</h1></legend><br>
                                            <div class="form-margin">
                                                <label for="txtId">User ID:</label>
                                                <input type="text" id="txtId" name="txtId" value="<?php echo $Row['id']; ?>" <?php if(trim($_GET['id']) != "") echo "readonly"; ?>><br><br>

                                                <label for="txtPass">Password:</label>
                                                <input type="text" id="txtPass" name="txtPass" value="<?php echo $Row['pword'] ?>"><br><br>
                                            
                                                <label for="txtFName">First Name:</label>
                                                <input type="text" id="txtFName" name="txtFName" value="<?php echo $Row['Fname']; ?>"><br><br>
                                            
                                                <label for="txtLName">Last Name:</label>
                                                <input type="text" id="txtLName" name="txtLName" value="<?php echo $Row['Lname']; ?>"><br><br>

                                                <label for="txtDob">Date of Birth:</label>
                                                <input type="date" placeholder="mm/dd/yyyy" id="txtDob" name="txtDob" value="<?php echo $Row['DOB']; ?>"><br><br>
                                            
                                                <label>Gender:</label>
                                                <input type="radio" id="txtMale" name="txtGender" value="M" <?php if($Row['gender'] == "M") echo " checked"; ?>>
                                                <label for="txtMale">Male</label>
                                                <input type="radio" id="txtFemale" name="txtGender" value="F" <?php if($Row['gender'] == "F") echo " checked"; ?>>
                                                <label for="txtFemale">Female</label><br><br>

                                                <label>Status:</label>
                                                <select id="Status" name="Status">
                                                    <option value="ACTIVE" <?php if($Row['status'] == "ACTIVE") echo " selected"; ?> >Active</option>
                                                    <option value="INACTIVE" <?php if($Row['status'] == "INACTIVE") echo " selected"; ?>>Inactive</option>
                                                </select><br><br>
                                            
                                                <label for="txtPhone">Phone Number:</label>
                                                <input type="text" id="txtPhone" name="txtPhone" value="<?php echo $Row['phoneNo']; ?>"><br><br>
                                            
                                                <label for="txtEmail">Email:</label>
                                                <input type="text" id="txtEmail" name="txtEmail" value="<?php echo $Row['email']; ?>"><br><br>
                                            
                                                <label class="label-top" for="txtAddress">Address:</label>
                                                <textarea name="txtAddress" id="txtAddress" cols="30" rows="4"><?php echo $Row['address']; ?></textarea><br><br>
                                            
                                                <label for="txtPostcode">Postcode:</label>
                                                <input type="text" id="txtPostcode" name="txtPostcode" value="<?php echo $Row['postcode']; ?>"><br><br>
                                            
                                                <label for="txtCity">City:</label>
                                                <input type="text" id="txtCity" name="txtCity" value="<?php echo $Row['city']; ?>"><br><br>
                                            
                                                <label for="txtState">State:</label>
                                                <input type="text" id="txtState" name="txtState" value="<?php echo $Row['state']; ?>"><br><br>
                                            
                                                <label for="txtCountry">Country:</label>
                                                <input type="text" id="txtCountry" name="txtCountry" value="<?php echo $Row['country']; ?>"><br><br>
                                            </div>
                                        
                                            <div id="buttons">
                                                <div class="form-margin">
                                                    <input type="submit" value="<?php if(trim($_GET['id'] != "")) echo "Update"; else echo "Submit"; ?>" name="<?php if(trim($_GET['id'] != "")) echo "btnUpdate"; else echo "btnSubmit"; ?>" 
                                                    id="<?php if(trim($_GET['id'] != "")) echo "btnUpdate"; else echo "btnSubmit"; ?>">
                                                    
                                                    <input type="reset" value="Reset" name="btnReset">
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>
                                    <?php
                            }
                            else
                            {
                                echo "<script>alert('Access Denied, please contact your System Administrator.')</script>";
                                echo "<script>location='./dashboard.php'</script>";
                            }
                        }
                            ?>
                                </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            var menuBtnOpen = true;
            
            btnMenu.addEventListener( 'click', (event) => {
            event.preventDefault();
            if(menuBtnOpen)
            {
                dashboard_sidebar.style.width = '10%';
                dashboard_sidebar.style.transition = '0.3 all';
                dashboard_contentContainer.style.width = '90%';
                dashboard_logo.style.fontSize = '30px';
                usernameText.style.fontSize = '10px';
                userImage.style.width = '30px';

                menuText = document.getElementsByClassName('menuText');
                for(var i = 0; i < menuText.length; i++)
                {
                    menuText[i].style.display = 'none';
                }

                document.getElementsByClassName('dashboard_Menuitems')[0].style.textAlign ='center';
                menuBtnOpen = false;
            }
            else
            {
                dashboard_sidebar.style.width = '20%';
                dashboard_sidebar.style.transition = '0.3 all';
                dashboard_contentContainer.style.width = '80%';
                dashboard_logo.style.fontSize = '50px';
                usernameText.style.fontSize = '20px';
                userImage.style.width = '50px';

                menuText = document.getElementsByClassName('menuText');
                for(var i = 0; i < menuText.length; i++)
                {
                    menuText[i].style.display = 'inline-block';
                }

                document.getElementsByClassName('dashboard_Menuitems')[0].style.textAlign ='left';
                menuBtnOpen = true;
            }
        });

        </script>
    </body>
</html>