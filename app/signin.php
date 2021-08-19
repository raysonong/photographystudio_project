<?php
    // Start the session
    session_start();

    // Check if the user is a registered user
    require_once("_components/verifyuser.php");
    verifyUser('');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" type="text/css" href="_css/common.css">
        <link rel="stylesheet" type="text/css" href="_css/signin.css">
        <script src="_js/global.js"></script>
        <script src="_js/signin.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <title>Creative Studio - Sign In</title>
    </head>
    <body>
        <!-- Header -->
        <?php
            require_once("_components/header.php");
        ?>
        <!-- Content -->
        <section id="content">
            <form id="content-signin" action="_process/signinProcess.php" method="post" onsubmit="return validateSignIn();" name="signin">
                <h2>Sign In</h2>
                <section id="signin-email">
                    <input type="email" id="input-email" name="email" placeholder="Email">
                    <p class="inputerror"></p>
                </section>
                <section id="signin-password">
                    <input type="password" id="input-password" name="password" placeholder="Password">
                    <p class="inputerror">
                        <?php
                            if (isset($_SESSION["passwordMessage"])) {
                                // Show the display message
                                echo $_SESSION["passwordMessage"];
                                // Remove the session after the message was display
                                unset($_SESSION["passwordMessage"]);
                            }
                        ?>
                    </p>
                </section>
                <label for="input-rememberMe">
                    <input type="checkbox" id="input-rememberMe" name="rememberMe">
                    Remember Me
                </label>
                <section>
                    <input type="submit" id="btn-signin" class="btn orangebtn" value="Sign in">
                </section>
                <p id="content-notmember">Not a member yet? - <a href="signup.php">Sign Up</a></p>
            </form>
        </section>
        <!-- Footer -->
        <?php
            include_once("_components/footer.php");
        ?>
    </body>
</html>