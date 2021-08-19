<?php
    // Start the database connection
    require("../_connect/database.php");
    
    // Store the user inputs
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $password = isset($_POST["password"]) ? $_POST["password"] : "";
    $rememberMe = isset($_POST["rememberMe"]) ? $_POST["rememberMe"] : "";
    
    // Create the SQL statement
    $sql = "SELECT * FROM members WHERE email = '$email'";
    // Execute the query
    $queryResult = mysqli_query($conn, $sql);
    $userRecord = mysqli_fetch_assoc($queryResult);

    session_start();
    if (password_verify($password, $userRecord["password"])) {
        // Store the cookie if remember me is checked
        if ($rememberMe != "") {
            /*$time = time() + 3600 * 24 * 30;
            setcookie("memberId", $userRecord["memberId"], $time);
            
            if ($userRecord["profileIcon"] != "") {
                setcookie("profileIcon", "{$userRecord["email"]}/{$userRecord["profileIcon"]}", $time);
            }*/
        }
        
        // Store the member ID, email and profile icon in the session
        $_SESSION["memberId"] = $userRecord["memberId"];
        $_SESSION["email"] = $userRecord["email"];
        $_SESSION["profileIcon"] = "";
        if ($userRecord["profileIcon"] != "") {
            $_SESSION["profileIcon"] = "{$userRecord["email"]}/{$userRecord["profileIcon"]}";
        }
        
        // Redirect the user back
        header("Location: ../index.php");
    }
    else {
        $_SESSION["passwordMessage"] = "Incorrect email or password!";
        
        // Redirect the user back
        header("Location: ../signin.php");
    }
    
    // Close the database connection
    mysqli_close($conn);
?>