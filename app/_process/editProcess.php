<?php
    // Store the user inputs
    $bookingId = isset($_POST["bookingId"]) ? $_POST["bookingId"] : "";
    $event = isset($_POST["event"]) ? $_POST["event"] : "";
    $print = isset($_POST["print"]) ? $_POST["print"] : "";
    $date = isset($_POST["date"]) ? $_POST["date"] : "";
    $timeStart = isset($_POST["timestart"]) ? $_POST["timestart"] : "";
    $timeEnd = isset($_POST["timeend"]) ? $_POST["timeend"] : "";
    $price = isset($_POST["price"]) ? $_POST["price"] : "";

    if ($bookingId != "" && $event != "" && $date != "" && $timeStart != "" && $timeEnd != "" && $price != "") {
        session_start();
        
        $date = date('Y-m-d', strtotime($date));
        $timeStart = date('H:i:s', strtotime($timeStart));
        $timeEnd = date('H:i:s', strtotime($timeEnd));
        $printVal = "";
        // Check if user select any checkboxes in the print
        if ($print != "") {
            for ($i = 0 ; $i < count($print); $i++) {
                switch ($print[$i]) {
                    case "CNV":
                        $printVal .= ", canvas";
                        break;
                    case "PBK":
                        $printVal .= ", photoBook";
                        break;
                    case "PHE":
                        $printVal .= ", photoEdit";
                        break;
                }
                
                // Check if this field is selected
                if ($print[$i]) {
                    $printVal .= "= 'Yes'";
                }
                else {
                    $printVal .= "= 'No'";
                }
            }
        }
        else {
            $printVal .= ", canvas = 'No', photoBook = 'No', photoEdit = 'No'";
        }

        // Start the database connection
        require("../_connect/database.php");
        
        // Create the SQL statement
        $sql = "UPDATE bookings SET event = '$event', dateSlot = '$date', timeStart = '$timeStart', timeEnd = '$timeEnd', price = $price" . $printVal . " WHERE memberId = " . $_SESSION["memberId"] . " AND bookingId = " . $bookingId;
        // Execute the query
        $queryResult = mysqli_query($conn, $sql);
        
        // Display the form message
        if ($queryResult) {
            $_SESSION["message"] = "<p class='forminfo formsuccess'>Booking successfully saved.</p>";
        }
        else {
            $_SESSION["message"] = "<p class='forminfo formerror'>An error occured while saving.</p>";
        }
        
        // Close the database connection
        mysqli_close($conn);
    }

    // Redirect the user back
    header("Location: ../edit.php?bookingId=$bookingId");
?>