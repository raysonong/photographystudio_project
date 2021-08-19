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
        <link rel="stylesheet" type="text/css" href="_css/signup.css">
        <script src="_js/global.js"></script>
        <script src="_js/signup.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <title>Creative Studio - Sign Up</title>
    </head>
    <body>
        <!-- Header -->
        <?php
            require_once("_components/header.php");
        ?>
        <!-- Content -->
        <section id="content">
            <form id="content-signup" action="_process/signupProcess.php" method="post" enctype="multipart/form-data" onsubmit="return validateSignUp();" name="signup">
                <h2>Register an Account</h2>
                <section id="signup-profileicon">
                    <section>
                        <section id="image-profileicon"></section>
                        <label for="btn-profileicon" class="btn orangebtn">
                            Profile Icon:
                            <input type="file" id="btn-profileicon" name="profileIcon">
                        </label>
                    </section>
                    <p class="inputerror"></p>
                </section>
                <section id="signup-name">
                    <section>
                        <input type="text" id="input-firstname" name="firstName" placeholder="First Name">
                        <input type="text" id="input-lastname" name="lastName" placeholder="Last Name">
                    </section>
                    <p class="inputerror"></p>
                </section>
                <section id="signup-gender">
                    <label>Gender:</label>
                    <label for="input-gendermale">
                        <input type="radio" id="input-gendermale" name="gender" value="M">
                        Male
                    </label>
                    <label for="input-genderfemale">
                        <input type="radio" id="input-genderfemale" name="gender" value="F">
                        Female
                    </label>
                    <p class="inputerror"></p>
                </section>
                <section id="signup-email">
                    <input type="email" id="input-email" name="email" placeholder="Your Email">
                    <p class="inputerror">
                        <?php
                            if (isset($_SESSION["emailmessage"])) {
                                // Show the display message
                                echo $_SESSION["emailmessage"];
                                // Remove the session after the message was display
                                unset($_SESSION["emailmessage"]);
                            }
                        ?>
                    </p>
                </section>
                <section id="signup-contactno">
                    <input type="text" id="input-contactno" name="contactNo" placeholder="Your Contact No.">
                    <p class="inputerror"></p>
                </section>
                <section id="signup-password">
                    <input type="password" id="input-password" name="password" placeholder="Password">
                    <p class="inputerror"></p>
                </section>
                <section id="signup-cfmpassword">
                    <input type="password" id="input-cfmpassword" name="cfmPassword" placeholder="Confirm Password">
                    <p class="inputerror"></p>
                </section>
                <section>
                    <input type="submit" id="btn-signup" class="btn orangebtn" value="Sign up">
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