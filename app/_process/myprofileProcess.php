<?php
    // Store the user inputs
    $gender = isset($_POST["gender"]) ? $_POST["gender"] : "";
    $contactNo = isset($_POST["contactNo"]) ? $_POST["contactNo"] : "";

    // Store the user profile icon
    $profileIcon = $_FILES["profileIcon"];
    if ($profileIcon["name"] != "") {
        $profileIconName = $profileIcon["name"];
    }

    if ($gender != "" && $contactNo != "") {
        session_start();
        $email = $_SESSION["email"];
        
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
                header("Location: ../myprofile.php");
                    
                // Prevent further execution
                exit;
            }
            
            $_SESSION["profileIcon"] = "";
            if ($profileIcon["name"] != "") {
                $_SESSION["profileIcon"] = "$email/$profileIconName";
            }

            $filterIcon = ", profileIcon = '$profileIconName'";
        }
            
        // Connect the database
        require("../_connect/database.php");
        
        // Prepare the query and bind the values inside
        $sql = "UPDATE members SET gender = '$gender', contactNo = $contactNo" . $filterIcon . " WHERE memberId = '{$_SESSION["memberId"]}'";
        // Execute the query
        $queryResult = mysqli_query($conn, $sql);
            
        // Display the form message
        if ($queryResult) {
            $_SESSION["message"] = "<p class='forminfo formsuccess'>Profile successfully saved!</p>";
        }
        else {
            $_SESSION["message"] = "<p class='forminfo formerror'>An error occurred while saving.</p>";
        }
            
        // Close the database connection
        mysqli_close($conn);
    }

    // Redirect the user back
    header("Location: ../myprofile.php");
?>