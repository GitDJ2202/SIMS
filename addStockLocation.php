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
                            if($_SESSION['loginStatus'] == '1')
                            {   /*Only adminsitrator can add*/
                                if($_SESSION['AccType'] == "SYSTEM ADMINISTRATOR")
                                {
                                    if($_POST['btnSubmit'])
                                    {
                                        if($_POST['txtLoc']!="")
                                            {
                                                $AddQuery = "INSERT INTO stockLocation (locationName, `status`) VALUES ('".strtoupper(trim($_POST['txtLoc']))."', 'ACTIVE')";
                                                $AddResult = $con->query($AddQuery);
                                                echo "<script>alert('Location added.')</script>";
                                            }else
                                            {
                                                echo "<script>alert('Enter all fields please!!');</script>";
                                            }
                                    }
                                
                        ?>
                                <div class="form-main">
                                <form method="post" action="">
                                        <fieldset id="info">
                                            <legend><h1>Add Stock Location Description</h1></legend><br>
                                            <div class="form-margin">
                                                <label for="txtLoc">Location:</label>
                                                <input type="text" id="txtLoc" name="txtLoc"><br><br>
                                            </div>
                                        
                                            <div id="buttons">
                                                <div class="form-margin">
                                                    <input type="submit" value="Submit" name="btnSubmit">
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
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