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
                        
                                    $Query = "SELECT * FROM supplier, contact WHERE supplier.id = contact.id";
                                    $Query .= " ORDER BY name";
                                    $search_result = $con->query($Query);
                                    
                                        //echo $Query;
                                    
                                    if($search_result->num_rows > 0)
                                    {
                                        ?>
                                        <form>
                                        <table border='1' padding:20px; width:auto; text-align:center align="center" class="tableView" >
												<tr style="text-align:center">
													<td style="font-weight:bold;">No</td>
													<td style="font-weight:bold;">Name</td>
													<td style="font-weight:bold;">POC</td>
													<td style="font-weight:bold;">Phone No</td>
                                                    <td style="font-weight:bold;">Email</td>
                                                    <td style="font-weight:bold;">Address</td>
                                                    <td style="font-weight:bold;">Postcode</td>
                                                    <td style="font-weight:bold;">City</td>
                                                    <td style="font-weight:bold;">State</td>
                                                    <td style="font-weight:bold;">Country</td>
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

														<tr style="text-align:center">
                                                            <td><?php echo($i+1) ?></td>
															<td><?php echo $RecordRow['name'] ?></td>
															<td><?php echo $RecordRow['pointOfContact']?></td>
															<td><?php echo $RecordRow['phoneNo'] ?></td>
                                                            <td><?php echo $RecordRow['email'] ?></td>
                                                            <td><?php echo $RecordRow['address'] ?></td>
                                                            <td><?php echo $RecordRow['postcode'] ?></td>
                                                            <td><?php echo $RecordRow['city'] ?></td>
                                                            <td><?php echo $RecordRow['state'] ?></td>
                                                            <td><?php echo $RecordRow['country'] ?></td>
                                                            <?php if($_SESSION['AccType'] == "SYSTEM ADMINISTRATOR"){?>
                                                                    <td>
                                                                        <a href="./addSupplier.php?id=<?php echo  $RecordRow['id']?>" name="btnEdit"><input type="button" value="Edit"><i class=""></i></a>
                                                                        <a href="./deleteSupplier.php?id=<?php echo  $RecordRow['id']?>" name="btnRemove"><input type="button" value="Remove"><i class=""></i></a>
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