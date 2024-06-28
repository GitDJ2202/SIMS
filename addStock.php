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
                                if(trim($_GET['id']) != "")
                                {
                                    $Query = "SELECT * FROM masterStockRecord WHERE id = '".strtoupper(trim($_GET['id']))."'";
                                    $Result = $con->query($Query);
                                    if($Result->num_rows > 0)
                                        $R = $Result->fetch_array(MYSQLI_ASSOC);
                                }

                                    //when update button pressed
                                    if($_POST['btnUpdate'])
                                    {
                                        
                                            // Retrieve data from the form
                                            $name = $_POST["txtName"];
                                            $categoryId = $_POST["sCategoryId"];
                                            $totalQuantity = $_POST["txtTotalQuantity"];
                                            $UsedQuantity = $R['usedQuantity'];
                                            $locationId = $_POST["sLocation"];
                                            $suppliedBy = $_POST["sSupplier"];
                                        
                                        $QueryInv = "UPDATE masterstockrecord SET `name` = '$name', 
                                        `categoryId` = '$categoryId',
                                        `totalQuantity` = '$totalQuantity',
                                        `usedQuantity` = '$UsedQuantity',
                                        `currentQuantity` = '$totalQuantity'-'$UsedQuantity',
                                        `locationId` = '$locationId',
                                        `supplierName` = '$suppliedBy' WHERE `id` = '".trim($_GET['id'])."' ";
                                        $result_Inv = $con->query($QueryInv);

                                        if($result_Inv)
                                            echo "<script>alert('Record updated');</script>";
                                    }
                                    //when press button submit
                                    if($_POST["btnSubmit"]) 
                                    {
                                        if($_POST["txtName"]!="" && $_POST["txtTotalQuantity"]!="")
                                           {
                                            // Retrieve data from the form
                                            $name = $_POST["txtName"];
                                            $categoryId = $_POST["sCategoryId"];
                                            $totalQuantity = $_POST["txtTotalQuantity"];
                                            $UsedQuantity = $R['usedQuantity'];
                                            $locationId = $_POST["sLocation"];
                                            $suppliedBy = $_POST["sSupplier"];
                                            
                                            echo "<h2>Submitted Data:</h2>";
                                            echo "<p>Id: $id </p>";
                                            echo "<p>Name: $name</p>";
                                            echo "<p>Category ID: $categoryId</p>";
                                            echo "<p>Total Quantity: $totalQuantity</p>";
                                            echo "<p>Location ID: $locationId</p>";
                                            echo "<p>Supplied By: $suppliedBy</p>";

                                            $addStockQuery = "INSERT INTO masterstockrecord (`name`, categoryId, totalQuantity, usedQuantity, currentQuantity, locationId, supplierName) VALUES
                                                                ('".trim($_POST["txtName"])."',
                                                                '".strtoupper(trim($_POST["sCategoryId"]))."',
                                                                '".trim($_POST["txtTotalQuantity"])."',
                                                                '0',
                                                                '".trim($_POST["txtTotalQuantity"])."',
                                                                '".strtoupper(trim($_POST["sLocation"]))."',
                                                                '".strtoupper(trim($_POST["sSupplier"]))."')";
                                            $addStockResult = $con->query($addStockQuery);
                                            //var_dump($addContactResult);

                                            if ($addStockResult){
                                                echo "<script>alert('New item Info Added');</script>";
                                            }
                                                
                                        
                                            }else{
                                                echo "<script>alert('Enter all fields please!!');</script>";
                                            }
                                }

                                
                                ?>
                                <form method="post" class="form-main" action="">
                                    <fieldset id="info">
                                    <legend><h1>Inventory Information Form</h1></legend><br>
                                        <div class="form-margin">
                                    
                                            <label for="txtName">Item Name:</label>
                                            <input type="text" id="txtName" name="txtName" value="<?php echo $R['name'] ?>"><br><br>
                                    
                                            <label for="sCategoryId">Category:</label>
                                            <select name="sCategoryId" id="sCategoryId">
                                                <?php
                                                    $Query = "SELECT * FROM itemCat ORDER BY categoryDetail";
                                                    $Result = $con->query($Query);
                                                    
                                                    if($Result->num_rows > 0)
                                                    {
                                                        for($i=0;$i<$Result->num_rows;$i++)
                                                        {
                                                            $Row = $Result->fetch_array(MYSQLI_ASSOC);
                                                            echo "<option value= \"".$Row['id']."\"";
                                                            if($R['categoryid'] == $Row['id'])
                                                                echo " selected";
                                                            echo
                                                            ">".$Row['categoryDetail']."</option>";
                                                        }
                                                        
                                                    }
                                                ?>
                                            </select><br><br>
                                    
                                            <label for="txtTotalQuantity">Total Quantity:</label>
                                            <input type="text" id="txtTotalQuantity" name="txtTotalQuantity" value="<?php echo $R['totalQuantity'] ?>"><br><br>
                                    
                                            <label for="sLocation">Location ID:</label>
                                            <select name="sLocation" id="sLocation">
                                                <?php
                                                    $Query = "SELECT * FROM stockLocation ORDER BY locationName";
                                                    $Result = $con->query($Query);
                                                    
                                                    if($Result->num_rows > 0)
                                                    {
                                                        for($i=0;$i<$Result->num_rows;$i++)
                                                        {
                                                            $Row = $Result->fetch_array(MYSQLI_ASSOC);
                                                            echo "<option value= \"".$Row['id']."\"";
                                                            if($R['locationId'] == $Row['id'])
                                                                echo " selected";
                                                            echo
                                                            ">".$Row['locationName']."</option>";
                                                        }
                                                        
                                                    }
                                                ?>
                                            </select><br><br>
                                    
                                            <label for="sSupplier">Supplied By:</label>
                                            <select name="sSupplier" id="sSupplier" ">
                                                <?php
                                                    $Query = "SELECT * FROM supplier ORDER BY `name`";
                                                    $Result = $con->query($Query);
                                                    
                                                    if($Result->num_rows > 0)
                                                    {
                                                        for($i=0;$i<$Result->num_rows;$i++)
                                                        {
                                                            $Row = $Result->fetch_array(MYSQLI_ASSOC);
                                                            echo "<option value= \"".$Row['name']."\"";
                                                            if($R['supplierName'] == $Row['name'])
                                                                echo" selected";
                                                            echo
                                                            ">".$Row['name']."</option>";
                                                        }
                                                        
                                                    }
                                                ?>
                                            </select><br><br>
                                    
                                            <div id="buttons">
                                                <div class="form-margin">
                                                <input type="submit" value="<?php if(trim($_GET['id'] != "")) echo "Update"; else echo "Submit"; ?>" name="<?php if(trim($_GET['id'] != "")) echo "btnUpdate"; else echo "btnSubmit"; ?>" 
                                                    id="<?php if(trim($_GET['id'] != "")) echo "btnUpdate"; else echo "btnSubmit"; ?>">
                                                <input type="reset" value="Reset">
                                                </div>
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