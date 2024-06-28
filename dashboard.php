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
            <?php
                include('./partials/sidebar.php');
            ?>
            <div class="dashboard_contentContainer" id="dashboard_contentContainer">
                <?php
                    include('./partials/topnav.php');
                ?>
                <div class="dashboard_content">
                    <div class="dashboard_contentMain">
                            <div class="dashboard_data"><!--Three boxes of data-->
                                <div class="box_data">
                                    <h3>Total Users</h3>
                                    <p>
                                        <?php
                                            // SQL query to count the number of users
                                            $query = "SELECT COUNT(*) AS userCount FROM users";

                                            // Execute the query
                                            $result = $con->query($query);
                                            if ($result) {
                                                // Fetch the result as an associative array
                                                $row = $result->fetch_assoc();
                                                // Get the user count
                                                $userCount = $row['userCount'];
                                                // Output the user count
                                                echo $userCount;
                                            } else {
                                                // Handle the query error
                                                echo "Error: " . $con->error;
                                            }
                                        ?>
                                    </p> 
                                </div>
                                <div class="box_data">
                                    <h3>Total Suppliers</h3>
                                    <p>
                                        <?php
                                            $query = "SELECT COUNT(*) AS supplierCount FROM supplier";
                                            $result = $con->query($query);
                                            if ($result) {
                                                $row = $result->fetch_assoc();
                                                $supplierCount = $row['supplierCount'];
                                                echo $supplierCount;
                                            } else {
                                                echo "Error: " . $con->error;
                                            }
                                        ?>
                                    </p> 
                                </div>
                                <div class="box_data">
                                    <h3>Total Inventory Items</h3>
                                    <p>
                                        <?php
                                            $query = "SELECT COUNT(*) AS itemCount FROM masterStockRecord";
                                            $result = $con->query($query);
                                            if ($result) {
                                                $row = $result->fetch_assoc();
                                                $itemCount = $row['itemCount'];
                                                echo $itemCount;
                                            } else {
                                                echo "Error: " . $con->error;
                                            }
                                            
                                        ?>
                                    </p> 
                                </div>
                            </div>
                            <div class="warning-bar">
                                <?php
                                    $query = "SELECT * FROM masterStockRecord";
                                    $result = $con->query($query);
                                    for($i=0; $i<$result->num_rows; $i++) 
									{ 
                                        $row = $result->fetch_array(MYSQLI_ASSOC);
                                        // Check if the currentQuantity is less than 20
                                        if ($row['currentQuantity'] < 20) {
                                            // Display the warning bar with item details
                                            echo '<div style="background-color: #aca445; text-align: center; color: white;">';
                                            echo 'Warning: Inventory quantity is low (Item ID ' . $row['id'] . ' - Item Name: ' . $row['name'] . ')';
                                            echo '</div>';
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