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
        <link rel="stylesheet" type="text/css" href="css/pdf.css">
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
                    <fieldset id="info">
                        <legend><h1>Generate File PDF</h1></legend><br>
                            <div class="form-margin">
                            <a href="./generateUserFile.php" class="custom-button" target="_blank">User File</a>
                            <a href="./generateSupplierFile.php" class="custom-button" target="_blank">Supplier File</a>
                            <a href="./generateInventoryFile.php" class="custom-button" target="_blank">Inventory File</a>
                            <a href="./generateStockOutFile.php" class="custom-button" target="_blank">Stock Out File</a>
                            <a href="./generateStockInFile.php" class="custom-button" target="_blank">Stock In File</a>
                            </div>
                            <br>
                    </fieldset>
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