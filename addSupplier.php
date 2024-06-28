<?php
    session_start();
    include('db.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Dashboard</title>
        <link rel="stylesheet" type="text/css" href="css/login.css">
        <link rel="stylesheet" type="text/css" href="css/dashboard.css">
        <link rel="stylesheet" type="text/css" href="css/form.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        
    </head>

    <body>
        <div id="dashboardMainContainer">
            <!-- sidebar -->
            <?php
                include('partials/sidebar.php');
            ?>
            <div class="dashboard_contentContainer" id="dashboard_contentContainer">
            <!-- nav-bar -->
                <?php
                    include('partials/topnav.php');
                ?>
            <!-- content -->
                <div class="dashboard_content">
                    <div class="dashboard_contentMain">
                        <?php
                        if($_SESSION['loginStatus'] == '1')
                        {   /*Only adminsitrator can add*/
                            if($_SESSION['AccType'] == "SYSTEM ADMINISTRATOR")
                            {
                                if ($_POST['btnUpdate']) {
                                    
                                            //Retrieve data from the form
                                            $id = strtoupper(trim($_POST["txtId"]));
                                            $name = strtoupper(trim($_POST["txtName"]));
                                            $contact = strtoupper(trim($_POST["txtContact"]));
                                            $phone = trim($_POST["txtPhone"]);
                                            $email = strtoupper(trim($_POST["txtEmail"]));
                                            $address = trim($_POST["txtAddress"]);
                                            $postcode = trim($_POST["txtPostcode"]);
                                            $city = strtoupper(trim($_POST["txtCity"]));
                                            $state = strtoupper(trim($_POST["txtState"]));
                                            $country = strtoupper(trim($_POST["txtCountry"]));
                                            
                                    $QuerySupp = "UPDATE supplier SET `name` = '$name',
                                        `pointOfContact` = '$contact' WHERE `id` = '$id'";
                                        $result_supp = $con->query($QuerySupp);
                                        // echo $QuerySupp;

                                        $QueryContact = "UPDATE contact SET `phoneNo` = '$phone', 
                                        `email` = '$email',
                                        `address` = '$address',
                                        `postcode` = '$postcode',
                                        `city` = '$city',
                                        `state` = '$state',
                                        `country` = '$country' WHERE `id` = '$id' ";
                                        $result_Contact = $con->query($QueryContact);
                                        

                                        if($result_supp && $result_Contact)
                                            echo "<script>alert('Record updated');</script>";

                                }
                                if ($_POST['btnSubmit']) {
                                    if($_POST["txtId"]!="" && $_POST["txtName"]!="" && $_POST["txtContact"]!="" && $_POST["txtPhone"]!="" && $_POST["txtEmail"]!="" && $_POST["txtAddress"]!="" && $_POST["txtPostcode"]!="" && $_POST["txtCity"]!="" && 
                                           $_POST["txtState"]!="" && $_POST["txtCountry"]!="")
                                           {
                                            //Retrieve data from the form
                                            $id = strtoupper(trim($_POST["txtId"]));
                                            $name = strtoupper(trim($_POST["txtName"]));
                                            $contact = strtoupper(trim($_POST["txtContact"]));
                                            $phone = trim($_POST["txtPhone"]);
                                            $email = strtoupper(trim($_POST["txtEmail"]));
                                            $address = trim($_POST["txtAddress"]);
                                            $postcode = trim($_POST["txtPostcode"]);
                                            $city = strtoupper(trim($_POST["txtCity"]));
                                            $state = strtoupper(trim($_POST["txtState"]));
                                            $country = strtoupper(trim($_POST["txtCountry"]));
                                    
                                            // You can perform actions with the data here, such as saving it to a database
                                            // or displaying it as needed.
                                            echo "<h2>Submitted Data:</h2>";
                                            echo "<p>Id: $id</p>";
                                            echo "<p>Name: $name</p>";
                                            echo "<p>Point of Contact: $contact</p>";
                                            echo "<p>Phone Number: $phone</p>";
                                            echo "<p>Email: $email</p>";
                                            echo "<p>Address: $address</p>";
                                            echo "<p>Postcode: $postcode</p>";
                                            echo "<p>City: $city</p>";
                                            echo "<p>State: $state</p>";
                                            echo "<p>Country: $country</p>";

                                            $addSupplierQuery = "INSERT INTO supplier (id, `name`, pointOfContact) VALUES
                                                            ('".strtoupper(trim($_POST["txtId"]))."',
                                                                '".strtoupper(trim($_POST["txtName"]))."',
                                                            '".strtoupper(trim($_POST["txtContact"]))."')";
                                            $addSupplierResult = $con->query($addSupplierQuery);
                                            
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
                                            
                                            if ($addSupplierResult && $addContactResult) {
                                                echo "<script>alert('New Supplier Info Added');</script>";
                                            }
                                        }else{
                                            echo "<script>alert('Enter all fields please!!');</script>";
                                        }
                                }
                            

                            if(trim($_GET['id']) != "")
                                {
                                    $Query = "SELECT * FROM supplier, contact WHERE supplier.id = contact.id AND contact.id = '".strtoupper(trim($_GET['id']))."'";
                                    $Result = $con->query($Query);
                                    if($Result->num_rows > 0)
                                        $Row = $Result->fetch_array(MYSQLI_ASSOC);
                                }
                            ?>
                        <div class="form-main">
                            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <fieldset id="info">
                                    <legend><h1>Add Supplier</h1></legend><br>
                                    <div class="form-margin">

                                        <label for="txtId">Id:</label>
                                        <input type="text" id="txtId" name="txtId" value="<?php echo $Row['id']; ?>" <?php if(trim($_GET['id']) != "") echo "readonly";?>><br><br>

                                        <label for="txtName">Name:</label>
                                        <input type="text" id="txtName" name="txtName" value="<?php echo $Row['name'] ?>"><br><br>
                                
                                        <label for="txtContact">Point of Contact:</label>
                                        <input type="text" id="txtContact" name="txtContact" value="<?php echo $Row['pointOfContact'] ?>"><br><br>

                                        <label for="txtPhone">Phone Number:</label>
                                        <input type="text" id="txtPhone" name="txtPhone" value="<?php echo $Row['phoneNo'] ?>"><br><br>
                                
                                        <label for="txtEmail">Email:</label>
                                        <input type="text" id="txtEmail" name="txtEmail" value="<?php echo $Row['email'] ?>"><br><br>
                                
                                        <label class="label-top" for="txtAddress">Address:</label>
                                        <textarea name="txtAddress" id="txtAddress" cols="30" rows="4"><?php echo $Row['address'] ?></textarea><br><br>
                                
                                        <label for="txtPostcode">Postcode:</label>
                                        <input type="text" id="txtPostcode" name="txtPostcode" value="<?php echo $Row['postcode'] ?>"><br><br>
                                
                                        <label for="txtCity">City:</label>
                                        <input type="text" id="txtCity" name="txtCity" value="<?php echo $Row['city'] ?>"><br><br>
                                
                                        <label for="txtState">State:</label>
                                        <input type="text" id="txtState" name="txtState" value="<?php echo $Row['state'] ?>"><br><br>
                                
                                        <label for="txtCountry">Country:</label>
                                        <input type="text" id="txtCountry" name="txtCountry" value="<?php echo $Row['country'] ?>"><br><br>
                                    
                                    </div>
                                    <div id="buttons">
                                        <div class="form-margin">
                                            <input type="submit" value="<?php if(trim($_GET['id'] != "")) echo "Update"; else echo "Submit"; ?>" name="<?php if(trim($_GET['id'] != "")) echo "btnUpdate"; else echo "btnSubmit"; ?>" 
                                                    id="<?php if(trim($_GET['id'] != "")) echo "btnUpdate"; else echo "btnSubmit"; ?>">
                                            <input type="reset" value="Reset">
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