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
            $currentPage = "My Profile";
        
            // Connect the database
            require("_connect/database.php");
        
            // Create the SQL statement
            $sql = "SELECT * FROM members WHERE memberId = '{$_SESSION["memberId"]}'";
            // Execute the query
            $queryResult = mysqli_query($conn, $sql);
            $userRecord = mysqli_fetch_assoc($queryResult);
            
            // Store the member information
            $firstName = $userRecord["firstName"];
            $lastName = $userRecord["lastName"];
            $gender = $userRecord["gender"];
            $email = $userRecord["email"];
            $contactNo = $userRecord["contactNo"];
            $profileIcon = $userRecord["profileIcon"];
        
            // Close the database connection
            mysqli_close($conn);
        ?>
        <link rel="stylesheet" type="text/css" href="_css/common.css">
        <link rel="stylesheet" type="text/css" href="_css/myprofile.css">
        <script src="_js/global.js"></script>
        <script src="_js/myprofile.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <title>My Profile</title>
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
            <form id="content-editprofile" action="_process/myprofileProcess.php" method="post" enctype="multipart/form-data" onsubmit="return validateMyProfile();" name="myProfile">
                <h2>My Profile</h2>
                <section id="editprofile-info">
                    <section id="editprofile-profileicon">
                        <section id="image-profileicon"
                            <?php
                                if ($_SESSION["profileIcon"] != "") {
                                    echo "style='background-image: url(_images/profileicons/{$_SESSION["profileIcon"]});'";
                                }
                            ?>
                        ></section>
                        <label for="btn-profileicon" class="btn orangebtn">
                            Profile Icon:
                            <input type="file" id="btn-profileicon" name="profileIcon">
                        </label>
                    </section>
                    <section id="editprofile-identity">
                        <p id="editprofile-identity-name"><?php echo "$firstName $lastName"; ?></p>
                        <p id="editprofile-identity-gender">
                            <?php
                                if ($gender == 'M') {
                                    echo "Male";
                                }
                                else {
                                    echo "Female";
                                }
                            ?>
                        </p>
                    </section>
                    <p class="inputerror"></p>
                </section>
                <section id="editprofile-editform">
                    <section id="editprofile-name">
                        <section>
                            <input type="text" id="input-firstname" name="firstName" placeholder="First Name" value="<?php echo $firstName; ?>" disabled>
                            <input type="text" id="input-lastname" name="lastName" placeholder="Last Name" value="<?php echo $lastName; ?>" disabled>
                        </section>
                        <p class="inputerror"></p>
                    </section>
                    <section id="editprofile-gender">
                        <label>Gender:</label>
                        <label for="input-gendermale">
                            <input type="radio" id="input-gendermale" name="gender" value="M" <?php if ($gender == 'M') echo "checked"; ?>>
                            Male
                        </label>
                        <label for="input-genderfemale">
                            <input type="radio" id="input-genderfemale" name="gender" value="F" <?php if ($gender == 'F') echo "checked"; ?>>
                            Female
                        </label>
                        <p class="inputerror"></p>
                    </section>
                    <section id="editprofile-email">
                        <input type="email" id="input-email" name="email" placeholder="Your Email" value="<?php echo $email; ?>" disabled>
                        <p class="inputerror"></p>
                    </section>
                    <section id="editprofile-contactno">
                        <input type="text" id="input-contactno" name="contactNo" placeholder="Your Contact No." value="<?php echo $contactNo; ?>">
                        <p class="inputerror"></p>
                    </section>
                    <section>
                        <input type="submit" id="btn-save" class="btn orangebtn" value="Save">
                        <?php
                            if (isset($_SESSION["message"])) {
                                // Show the display message
                                echo $_SESSION["message"];
                                // Remove the session after the message was display
                                unset($_SESSION["message"]);
                            }
                        ?>
                    </section>
                </section>
            </form>
        </section>
        <!-- Footer -->
        <?php
            include_once("_components/footer.php");
        ?>
    </body>
</html>