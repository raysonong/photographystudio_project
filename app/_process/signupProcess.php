<?php
    // Store the user inputs
    $firstName = isset($_POST["firstName"]) ? $_POST["firstName"] : "";
    $lastName = isset($_POST["lastName"]) ? $_POST["lastName"] : "";
    $gender = isset($_POST["gender"]) ? $_POST["gender"] : "";
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $contactNo = isset($_POST["contactNo"]) ? $_POST["contactNo"] : "";
    $password = isset($_POST["password"]) ? $_POST["password"] : "";
    
    // Store the user profile icon
    $profileIcon = $_FILES["profileIcon"];
    if ($profileIcon["name"] != "") {
        $profileIconName = $profileIcon["name"];
    }

    if ($firstName != "" && $lastName != "" && $gender != "" && $email != "" && $contactNo != "" && $password != "") {
        // Connect the database
        require("../_connect/database.php");
        
        // Prepare the query and bind the values inside
        $sql = "SELECT email FROM members WHERE email = '$email'";
        // Execute the query
        $queryResult = mysqli_query($conn, $sql);
        
        // Get the number of rows
        $numOfRows = mysqli_num_rows($queryResult);
        
        // Close the database connection
        mysqli_close($conn);

        session_start();
        if ($numOfRows > 0) {
            // Display the form message
            $_SESSION["emailmessage"] = "The email you choosed has been taken!";
            // Redirect the user to the sign in page
            header("Location: ../signup.php");
        }
        else {
            // Check if user upload a profile icon
            $filterIconColumn = "";
            $filterIconValue = "";
            if ($profileIcon["name"] != "") {
                $dir = "../_images/profileicons/";
                
                // Create directory for the user
                if (!file_exists($dir . $email)) {
                    mkdir($dir . $email, 0777, true);
                }
                // Path where the image will be placed
                $target = $dir . $email . "/" . $profileIconName;
                
                // Send the image into the folder
                $result = move_uploaded_file($profileIcon["tmp_name"], $target);
                
                if (!$result) {
                    // Display the form message
                    $_SESSION["message"] = "<p class='forminfo formerror'>Could not upload your profile icon.</p>";
                    // Redirect the user back
                    header("Location: ../signup.php");
                    
                    // Prevent further execution
                    exit;
                }
                
                $filterIconColumn = ", profileIcon";
                $filterIconValue = ", '$profileIconName'";
            }
            
            // Connect the database
            require("../_connect/database.php");
            
            // To hash the password
            $hashPassword = password_hash($password, PASSWORD_DEFAULT);
            
            // Create the SQL statement
            $sql = "INSERT INTO members(firstName, lastName, gender, email, contactNo, password" . $filterIconColumn . ") VALUES('$firstName', '$lastName', '$gender', '$email', $contactNo, '$hashPassword'" . $filterIconValue . ")";
            // Execute the query
            $queryResult = mysqli_query($conn, $sql);
            
            // Display the form message
            if ($queryResult) {
                // Redirect the user to the sign in page
                header("Location: ../signin.php");
            }
            else {
                $_SESSION["message"] = "<p class='forminfo formerror'>An error occurred while registering.</p>";
                
                // Redirect the user back
                header("Location: ../signup.php");
            }
            
            // Close the database connection
            mysqli_close($conn);
        }
    }
    else {
        // Redirect the user back
        header("Location: ../signup.php");
    }
?>