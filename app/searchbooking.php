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
            $currentPage = "Search Booking";
        
            // Connect the database
            require("_connect/database.php");
        
            // Create the SQL statement
            $sql = "SELECT bookingId, event, dateSlot, timeStart, timeEnd, price, status FROM bookinghistory WHERE memberId = '{$_SESSION["memberId"]}' ORDER BY dateBooked DESC LIMIT 10";
            // Execute the query
            $queryResult = mysqli_query($conn, $sql);
        
            // Close the database connection
            mysqli_close($conn);
        ?>
        <link rel="stylesheet" type="text/css" href="_css/common.css">
        <link rel="stylesheet" type="text/css" href="_css/currentbooking.css">
        <script src="_js/global.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <title>Search Booking</title>
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
            <section id="content-editbooking">
                <h2>Search Booking</h2>
                <?php
                    if (isset($_SESSION["message"])) {
                        // Show the display message
                        echo $_SESSION["message"];
                        // Remove the session after the message was display
                        unset($_SESSION["message"]);
                    }
                ?>
                <table id="editbooking-list">
                    <thead>
                        <tr id="editbooking-header">
                            <th>Service</th>
                            <th>Date Available</th>
                            <th>Time Slot</th>
                            <th>Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            // Check if user booked any slots
                            if ($queryResult) {
                                // Display the list of booked slots
                                while ($oneBooking = mysqli_fetch_assoc($queryResult)) {
                                    // Add the booked price to the total
                        ?>
                        <tr>
                            <td>
                                <?php echo $oneBooking["event"]; ?>
                            </td>
                            <td>
                                <?php echo date("d/m/Y", strtotime($oneBooking["dateSlot"])); ?>
                            </td>
                            <td>
                                <?php echo date("H:i", strtotime($oneBooking["timeStart"])) . " - " . date("H:i", strtotime($oneBooking["timeEnd"])); ?>
                            </td>
                            <td>
                                <?php echo "$" . $oneBooking["price"]; ?>
                            </td>
                            <td class="action">
                                <?php echo $oneBooking["status"]; ?>
                            </td>
                        </tr>
                        <?php
                                }
                            }
                            else {
                        ?>
                        <tr>
                            <td colspan="5">
                                You do not have any current bookings.
                            </td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </section>
        </section>
        <!-- Footer -->
        <?php
            include_once("_components/footer.php");
        ?>
    </body>
</html>