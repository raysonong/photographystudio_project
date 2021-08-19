<?php
    // Store the user inputs
    $bookingId = isset($_POST["bookingId"]) ? $_POST["bookingId"] : "";

    if ($bookingId != "") {
        session_start();
        
        // Start the database connection
        require("../_connect/database.php");
        
        $filter = " WHERE bookingId = $bookingId AND memberId = " . $_SESSION["memberId"];

        // Create the SQL statement
        $sql = "INSERT bookinghistory (bookingId, memberId, event, canvas, photoBook, photoEdit, dateBooked, dateSlot, timeStart, timeEnd, price) SELECT bookingId, memberId, event, canvas, photoBook, photoEdit, dateBooked, dateSlot, timeStart, timeEnd, price FROM bookings" . $filter;
        // Execute the query
        $queryResult = mysqli_query($conn, $sql);

        // Display the form message
        if ($queryResult) {
            // Create the SQL statement
            $sql = "UPDATE bookinghistory SET status = 'Cancelled'" . $filter;
            // Execute the query
            $result = mysqli_query($conn, $sql);
            
            // Create the SQL statement
            $sql = "DELETE FROM bookings" . $filter;
            // Execute the query
            $result = mysqli_query($conn, $sql);
            
            $_SESSION["message"] = "<p class='forminfo formsuccess'>You have successfully cancelled a slot.</p>";
        }
        else {
            $_SESSION["message"] = "<p class='forminfo formerror'>An error occured while cancelling a slot.</p>";
        }
        
        // Close the database connection
        mysqli_close($conn);
    }
    
    // Redirect the user back
    header("Location: ../currentbooking.php");
?>