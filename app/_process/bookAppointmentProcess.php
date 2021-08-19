<?php
    // Store the user inputs
    $event = isset($_POST["event"]) ? $_POST["event"] : "";
    $print = isset($_POST["print"]) ? $_POST["print"] : "";
    $date = isset($_POST["date"]) ? $_POST["date"] : "";
    $timeStart = isset($_POST["timestart"]) ? $_POST["timestart"] : "";
    $timeEnd = isset($_POST["timeend"]) ? $_POST["timeend"] : "";
    $price = isset($_POST["price"]) ? $_POST["price"] : "";

    if ($event != "" && $date != "" && $timeStart != "" && $timeEnd != "" && $price != "") {
        session_start();
        
        $date = date('Y-m-d', strtotime($date));
        $timeStart = date('H:i:s', strtotime($timeStart));
        $timeEnd = date('H:i:s', strtotime($timeEnd));
        $printCol = "";
        $printVal = "";
        // Check if user select any checkboxes in the print
        if ($print != "") {
            // Assign all the values to store in database the user inputted in print
            for ($i = 0 ; $i < count($print); $i++) {
                switch ($print[$i]) {
                    case "CNV":
                        $printCol .= ", canvas";
                        break;
                    case "PBK":
                        $printCol .= ", photoBook";
                        break;
                    case "PHE":
                        $printCol .= ", photoEdit";
                        break;
                }
                
                // Check if this field is selected
                if ($print[$i]) {
                    $printVal .= ", 'Yes'";
                }
            }
        }

        // Start the database connection
        require("../_connect/database.php");
        
        // Create the SQL statement
        $sql = "INSERT INTO bookings(memberId, event, dateSlot, timeStart, timeEnd, price" . $printCol . ") VALUES(" . $_SESSION["memberId"] . ", '$event', '$date', '$timeStart', '$timeEnd', $price" . $printVal . ")";
        // Execute the query
        $queryResult = mysqli_query($conn, $sql);
        
        // Display the form message
        if ($queryResult) {
            $_SESSION["message"] = "<p class='forminfo formsuccess'>You have successfully booked a slot.</p>";
            header("Location: ../currentbooking.php");
            exit;
        }
        else {
            $_SESSION["message"] = "<p class='forminfo formerror'>An error occured while booking a slot.</p>";
        }
        
        // Close the database connection
        mysqli_close($conn);
    }

    // Redirect the user back
    header("Location: ../bookappointment.php");
?>