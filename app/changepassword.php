<?php
    // Start the session
    session_start();
    
    // Check if the user is a registered user
    require_once("_components/verifyuser.php");
    verifyUser('M');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            // Set the active link on the navigation
            $currentPage = "Change Password";
        ?>
        <link rel="stylesheet" type="text/css" href="_css/common.css">
        <link rel="stylesheet" type="text/css" href="_css/changepassword.css">
        <script src="_js/global.js"></script>
        <script src="_js/changepassword.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <title>Change Password</title>
    </head>
    <body>
        <!-- Header -->
        <?php
            require_once("_components/header.php");
        ?>
        <!-- Content -->
        <section id="content">
            <?php
                include_once("_components/sidenav.php");
            ?>
            <form id="content-changepw" action="_process/changePasswordProcess.php" method="post" onsubmit="return validateChangePassword();" name="changePassword">
                <h2>Change Password</h2>
                <section id="changepw-currentpassword">
                    <input type="password" id="input-currentpassword" name="currentPassword" placeholder="Current Password">
                    <p class="inputerror"></p>
                </section>
                <section id="changepw-password">
                    <input type="password" id="input-password" name="password" placeholder="New Password">
                    <p class="inputerror"></p>
                </section>
                <section id="changepw-cfmpassword">
                    <input type="password" id="input-cfmpassword" name="cfmPassword" placeholder="Confirm New Password">
                    <p class="inputerror"></p>
                </section>
                <section>
                    <input type="submit" id="btn-changepw" class="btn orangebtn" value="Change Password">
                    <?php
                        if (isset($_SESSION["message"])) {
                            // Show the display message
                            echo $_SESSION["message"];
                            // Remove the session after the message was display
                            unset($_SESSION["message"]);
                        }
                    ?>
                </section>
            </form>
        </section>
        <!-- Footer -->
        <?php
            include_once("_components/footer.php");
        ?>
    </body>
</html>