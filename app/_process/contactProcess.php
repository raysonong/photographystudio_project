<?php
    // Store the user inputs
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $contactNo = isset($_POST["contactNo"]) ? $_POST["contactNo"] : "";
    $subject = isset($_POST["subject"]) ? $_POST["subject"] : "";
    $message = isset($_POST["message"]) ? $_POST["message"] : "";

    if ($email != "" && $contactNo != "" && $subject != "" && $message != "") {
        // Connect the database
        require("../_connect/database.php");
        
        // Create the SQL statement
        $sql = "INSERT INTO contactmessage(email, contactNo, subject, message) VALUES('$email', $contactNo, '$subject', '$message')";
        // Execute the query
        $queryResult = mysqli_query($conn, $sql);
        
        // Display the form message
        session_start();
        if ($queryResult) {
            $_SESSION["message"] = "<p class='forminfo formsuccess'>Your response has been submitted. Thank you!</p>";
        }
        else {
            $_SESSION["message"] = "<p class='forminfo formerror'>An error occurred while submitting the form.</p>";
        }
        
        // Close the database connection and the sql query
        mysqli_close($conn);
    }

    // Redirect the user back
    header("Location: ../contact.php");
?>