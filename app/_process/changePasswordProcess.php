<?php
    session_start();

    // Start the database connection
    require("../_connect/database.php");

    // Store the user inputs
    $currentPassword = isset($_POST["currentPassword"]) ? $_POST["currentPassword"] : "";
    $password = isset($_POST["password"]) ? $_POST["password"] : "";
    $cfmPassword = isset($_POST["cfmPassword"]) ? $_POST["cfmPassword"] : "";
    
    // Declare an sql statement
    $sql = "SELECT password FROM members WHERE email = '" . $_SESSION["email"] . "'";
    // Execute the query
    $queryResult = mysqli_query($conn, $sql);
    $userRecord = mysqli_fetch_assoc($queryResult);

    // Check if the user key in the current password correctly
    if (password_verify($currentPassword, $userRecord["password"])) {
        // To hash the password
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        
        // Create the SQL statement
        $sql = "UPDATE members SET password = '$hashPassword' WHERE memberId = " . $_SESSION["memberId"];
        // Execute the query
        $queryResult = mysqli_query($conn, $sql);
        
        // Display the form message
        if ($queryResult) {
            $_SESSION["message"] = "<p class='forminfo formsuccess'>Your new password has been updated!</p>";
        }
        else {
            $_SESSION["message"] = "<p class='forminfo formerror'>An error occured while trying to change your password.</p>";
        }
    }
    else {
        // Display the form message
        $_SESSION["message"] = "<p class='forminfo formerror'>Current password is incorrect!</p>";
    }

    // Redirect the user back
    header("Location: ../changepassword.php");
?>