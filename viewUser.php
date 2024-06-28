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

                                if($_POST['btnSubmit'])
                                {
                                    $Query = "SELECT * FROM contact, userLogin, users WHERE contact.id = userLogin.id AND userLogin.id = users.id";
                                    
                                    if(trim($_POST['txtId']) != "")
                                        $Query .= " AND users.id LIKE '%".strtoupper(trim($_POST['txtId']))."%'";

                                    if(trim($_POST['txtFName']) != "")
                                        $Query .= " AND users.Fname LIKE '%".strtoupper(trim($_POST['txtFName']))."%'";

                                    if(trim($_POST['txtLName']) != "")
                                        $Query .= " AND users.Lname LIKE '%".strtoupper(trim($_POST['txtLName']))."%'";

                                        $Query .= " ORDER BY Fname";
                                        $search_result = $con->query($Query);
                                    
                                        //echo $Query;
                                    
                                        if($search_result->num_rows > 0)
                                        {
                                            ?>
                                            <form method="post" action="">
                                            <table padding:20px; width:auto; class="tableView">
                                                    <tr>
                                                        <td style="font-weight:bold;">No</td>
                                                        <td style="font-weight:bold;">User Id</td>
                                                        <td style="font-weight:bold;">First Name</td>
                                                        <td style="font-weight:bold;">Last Name</td>
                                                        <td style="font-weight:bold;">DOB</td>
                                                        <td style="font-weight:bold;">Gender</td>
                                                        <td style="font-weight:bold;">Phone</td>
                                                        <td style="font-weight:bold;">Email</td>
                                                        <td style="font-weight:bold;">Address</td>
                                                        <td style="font-weight:bold;">Postcode</td>
                                                        <td style="font-weight:bold;">City</td>
                                                        <td style="font-weight:bold;">Status</td>
                                                        <?php if($_SESSION['AccType'] == "SYSTEM ADMINISTRATOR"){?>
                                                        <td style="font-weight:bold;">Actions</td>
                                                        <?php
                                                        }?>
                                                    </tr>
                                                    <?php 
                                                        for($i=0; $i<$search_result->num_rows; $i++) 
                                                        { 
                                                            $RecordRow = $search_result->fetch_array(MYSQLI_ASSOC);
                                                            //echo $RecordRow;
                                                            ?>
    
                                                            <tr>
                                                                <td><?php echo($i+1) ?></td>
                                                                <td><?php echo $RecordRow['id']  ?></td>
                                                                <td><?php echo $RecordRow['Fname']?></td>
                                                                <td><?php echo $RecordRow['Lname'] ?></td>
                                                                <td><?php echo $RecordRow['DOB'] ?></td>
                                                                <td><?php echo $RecordRow['gender'] ?></td>
                                                                <td><?php echo $RecordRow['phoneNo'] ?></td>
                                                                <td><?php echo $RecordRow['email'] ?></td>
                                                                <td><?php echo $RecordRow['address'] ?></td>
                                                                <td><?php echo $RecordRow['postcode'] ?></td>
                                                                <td><?php echo $RecordRow['city'] ?></td>
                                                                <td><?php echo $RecordRow['status'] ?></td>
                                                                <?php if($_SESSION['AccType'] == "SYSTEM ADMINISTRATOR"){?>
                                                                    <td>
                                                                        <a href="./addUser.php?id=<?php echo  $RecordRow['id']?>" name="btnEdit"><input type="button" value="Edit"><i class=""></i></a>
                                                                        <a href="./deleteUser.php?id=<?php echo  $RecordRow['id']?>" name="btnRemove"><input type="button" value="Remove"><i class=""></i></a>
                                                                    </td>
                                                                    <?php
                                                                        }?>
                                                            </tr>
                                                            
                                                            <?php
                                                        } 
                                                    ?>
                                            </table>
                                            </form>
                                            <?php
                                        }
                                
                                }  
                                else
                                {
                                    ?>
                                    <div class="form-main">
                                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                            <fieldset id="info">
                                                <legend><h1>Search User</h1></legend><br>
                                                <div class="form-margin">
                                                    <label for="txtid">User id:</label>
                                                    <input type="text" id="txtId" name="txtId"><br><br>

                                                    <label for="txtFName">First Name:</label>
                                                    <input type="text" id="txtFName" name="txtFName"><br><br>

                                                    <label for="txtLName">Last Name:</label>
                                                    <input type="text" id="txtLName" name="txtLName"><br><br>

                                                    <label>Submit empty brackets to see all*</label><br><br>
                                                </div>
                                            
                                                <div id="buttons">
                                                    <div class="form-margin">
                                                        <input type="submit" value="Submit" name="btnSubmit">
                                                        
                                                        <input type="reset" value="Reset" name="btnReset">
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </form>
                                    </div>
                                
                                    <?php
                                }//else option
                            
                        ?>
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