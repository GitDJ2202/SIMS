<div class="dashboard_sidebar" id="dashboard_sidebar">
    <h3 class="dashboard_logo" id="dashboard_logo">SIMS</h3>
        <div class="dashboard_sidebar_User">
            <img src="image/UserImage.jpg" alt="User Image" id="userImage"/><!--add un user image-->
            <span id="usernameText">
                <?php
                    if($_SESSION['AccType'] == "SYSTEM ADMINISTRATOR")
                    {
                        echo "ADMIN";
                    }
                    else /* add condition if require error checking */
                    {
                        echo $_SESSION['userID'];
                    }
                ?>
            </span>
        </div>
    <div class="dashboard_Menu">
        <ul class="dashboard_Menuitems">
            <!-- <li class="menuActive"> -->
            <li class="liMainMenu">
                <a href="dashboard.php"><i class="fa-solid fa-chart-line"></i> <span class="menuText">Dashboard</span></a>
            </li>
            <li class="liMainMenu">
                <a href="#"><i class="fa-solid fa-person"></i> <span class="menuText">User</span></a>
                <ul class ="subMenus">
                    <li><a class="subMenuLink" href="./addUser.php"><i class="fa-solid fa-person"></i> <span>Add User</span></a></li>
                    <li><a class="subMenuLink" href="./viewUser.php"><i class="fa-solid fa-person"></i> <span>View User</span></a></li>
                </ul>
            </li>
            <li class="liMainMenu">
                <a href="#"><i class="fa-solid fa-truck-moving"></i> <span class="menuText">Supplier</span></a>
                <ul class ="subMenus">
                    <li><a class="subMenuLink" href="./addSupplier.php"><i class="fa-solid fa-warehouse"></i> <span>Add Supplier</span></a></li>
                    <li><a class="subMenuLink" href="./viewSupplier.php"><i class="fa-solid fa-warehouse"></i> <span>View Supplier</span></a></li>
                </ul>
            </li>
            <li class="liMainMenu">
                <a href="#"><i class="fa-solid fa-warehouse"></i> <span class="menuText">Inventory</span></a>
                <ul class ="subMenus">
                    <li><a class="subMenuLink" href="./addStock.php"><i class="fa-solid fa-warehouse"></i> <span>Add New Inventory</span></a></li>
                    <li><a class="subMenuLink" href="./viewStock.php"><i class="fa-solid fa-warehouse"></i> <span>View Inventory</span></a></li>
                </ul>
            </li>
            <li class="liMainMenu">
                <a href="#"><i class="fa-regular fa-envelope"></i> <span class="menuText">Stock-In</span></a>
                <ul class ="subMenus">
                    <li><a class="subMenuLink" href="./stockIn.php"><i class="fa-solid fa-warehouse"></i> <span>Stock In</span></a></li>
                    <li><a class="subMenuLink" href="./stockOut.php"><i class="fa-solid fa-warehouse"></i> <span>Stock out</span></a></li>
                </ul>
            </li>
            <li class="liMainMenu">
                <a href="#"><i class="fa-regular fa-envelope"></i> <span class="menuText">Category</span></a>
                <ul class ="subMenus">
                    <li><a class="subMenuLink" href="./addStockOutCat.php"><i class="fa-solid fa-person"></i> <span>Stock Out</span></a></li>
                    <li><a class="subMenuLink" href="./addItemCat.php"><i class="fa-solid fa-person"></i> <span>Item</span></a></li>
                    <li><a class="subMenuLink" href="./addStockLocation.php"><i class="fa-solid fa-person"></i> <span>Location</span></a></li>
                </ul>
            </li>
            <li class="liMainMenu">
                <a href="./generatePDF.php"><i class="fa-regular fa-file"></i> <span class="menuText">Report</span></a>
            </li>
        </ul>
    </div>
 </div>

 
