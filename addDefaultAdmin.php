<?php
include("db.php");

    if (isset($_POST['btnSubmit']))
    {
        if (trim($_POST['txtSysUser']) !== "" && trim($_POST['txtSysPass']) !== "")
        {
            $AddSysUser = "INSERT INTO userLogin (id, pword, userRole, status) 
                            VALUES('". strtoupper(trim($_POST['txtSysUser'])) . "', '" . md5(trim($_POST['txtSysPass'])). "', 'SYSTEM ADMINISTRATOR', 'ACTIVE')";

            $AddResult = $con->query($AddSysUser);

            if ($AddResult) 
            {
                echo "<script>location='index.php'; alert('Admin successfully created!!!');</script>";
            }
        }
    }
?>

<form id="form1" name="form1" method="post">
    <table width="637" height="97" border="0" align="center" cellpadding="1" cellspacing="4">
        <tbody>
            <tr>
                <td>Add System Admin ID</td>
                <td><input placeholder="User ID" type="text" name="txtSysUser" id="txtSysUser"></td>
            </tr>
            <tr>
                <td>System Password</td>
                <td><input placeholder="Password" type="password" name="txtSysPass" id="txtSysPass"></td> 
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" name="btnSubmit" id="btnSubmit" value="Submit"></td>
            </tr>
        </tbody>
    </table>
</form>

