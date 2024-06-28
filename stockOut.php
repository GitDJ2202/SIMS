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
                include('partials/sidebar.php');
            ?>
            <div class="dashboard_contentContainer" id="dashboard_contentContainer">
                <?php
                    include('partials/topnav.php');
                ?>
                <div class="dashboard_content">
                    <div class="dashboard_contentMain">
                        <?php

                            if ($_POST['btnSubmit']) 
                            {

                                if($_POST["txtDescription"] != "" && $_POST["txtQuantity"] != "")
                                {
                                     //Retrieve data from the form
                                $id = $_POST["sId"];
                                $quantity = $_POST["txtQuantity"];
                                $userAcc = $_SESSION["userID"];
                                $date = date("Y-m-s H:i:s");
                                
                                 //Saving to database or displaying the data
                                 echo "<h2>Submitted Data:</h2>";
                                 echo "<p>ID: $id</p>";
                                 echo "<p>Quantity: $quantity</p>";
                                 echo "<p>User Id: $userAcc</p>";
                                 echo "<p>Date: $date</p>"; 

                                    $addStockOutQuery = "INSERT INTO stockOut (itemId, stockOutCatId, `description`, usedQuantity, usedBy, `date` ) VALUES
                                                         ('".trim($_POST["sId"])."', 
                                                          '".trim($_POST["sStockOutCat"])."',
                                                          '".strtoupper(trim($_POST["txtDescription"]))."',
                                                          '".trim($_POST["txtQuantity"])."',
                                                          '".trim($_SESSION["userID"])."',
                                                          '".date("Y-m-s H:i:s")."')";
                                    $addStockInResult = $con->query($addStockOutQuery);
                                    var_dump($addStockInResult);
                                    
                                    if ($addStockInResult) {
                                        echo "<script>alert('Stock Out successful');</script>";
                                    }

                                    
                                    $updateStockInQuery ="UPDATE masterStockRecord
                                                        SET `currentQuantity` = `currentQuantity` - '$quantity', `usedQuantity` = `usedQuantity` + '$quantity'
                                                        WHERE id = '$id'
                                                        ";
                                    $updateStockInResult = $con->query($updateStockInQuery);

                                    if($updateStockInResult)
                                    {
                                       echo "<script>alert('Stock Updated')</script>";
                                    }

                                }
                                else
                                {
                                    echo "<script>alert('Please insert data!!!');</script>";
                                   
                                }
                            }
                        ?>
                        <form method="post" action="">
                                        <fieldset id="info">
                                            <legend><h1>Stock Out</h1></legend><br>
                                            <div class="form-margin">
                                                <label for="sId">Item:</label>
                                                <select name="sId" id="sId">
                                                <?php
                                                    $Query = "SELECT * FROM masterStockRecord ORDER BY `name`";
                                                    $Result = $con->query($Query);
                                                    
                                                    if($Result->num_rows > 0)
                                                    {
                                                        for($i=0;$i<$Result->num_rows;$i++)
                                                        {
                                                            $Row = $Result->fetch_array(MYSQLI_ASSOC);
                                                            echo "<option value= \"".$Row['id']."\"";
                                                            if($UserRow['id'] == $Row['id'])
                                                                echo " selected";
                                                            echo
                                                            ">".$Row['name']."</option>";
                                                        }
                                                        
                                                    }
                                                ?>
                                                </select><br><br>

                                                <label for="sStockOutCat">Category:</label>
                                                <select name="sStockOutCat" id="sStockOutCat">
                                                <?php
                                                    $Query = "SELECT * FROM stockOutCat ORDER BY categoryDetail";
                                                    $Result = $con->query($Query);
                                                    
                                                    if($Result->num_rows > 0)
                                                    {
                                                        for($i=0;$i<$Result->num_rows;$i++)
                                                        {
                                                            $Row = $Result->fetch_array(MYSQLI_ASSOC);
                                                            echo "<option value= \"".$Row['id']."\"";
                                                            if($UserRow['id'] == $Row['id'])
                                                                echo " selected";
                                                            echo
                                                            ">".$Row['categoryDetail']."</option>";
                                                        }
                                                        
                                                    }
                                                ?>
                                                </select><br><br>

                                                <label class="label-top" for="txtDescription">Reason:</label>
                                                <textarea name="txtDescription" id="txtDescription" cols="30" rows="4"></textarea><br><br>

                                                <label for="txtQuantity">Quantity:</label>
                                                <input type="text" id="txtQuantity" name="txtQuantity"><br><br>
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