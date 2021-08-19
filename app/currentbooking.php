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
            $currentPage = "Current Booking";
        
            // Connect the database
            require("_connect/database.php");
        
            // Create the SQL statement
            $sql = "SELECT bookingId, event, dateSlot, timeStart, timeEnd, price FROM bookings WHERE memberId = '{$_SESSION["memberId"]}' ORDER BY dateBooked DESC";
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
        <title>Current Booking</title>
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
                <h2>Current Booking</h2>
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
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            // Check if user booked any slots
                            if ($queryResult) {
                                $total = 0;
                                // Display the list of booked slots
                                while ($oneBooking = mysqli_fetch_assoc($queryResult)) {
                                    // Add the booked price to the total
                                    $total += $oneBooking["price"];
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
                                <a href="edit.php?bookingId=<?php echo $oneBooking["bookingId"]; ?>" class="btn editbtn" title="Edit">Edit</a>
                                <form action="_process/deleteProcess.php" method="post">
                                    <input type="hidden" name="bookingId" value="<?php echo $oneBooking["bookingId"]; ?>">
                                    <input type="submit" id="btn-cancelbooking" value="Cancel Booking" class="btn deletebtn" title="Cancel Booking">
                                </form>
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
                <p id="editbooking-totalprice">Total Price: <strong>$<?php echo number_format($total, 2, '.', ''); ?></strong></p>
                <form action="_process/checkoutProcess.php" id="currentbooking-checkout" method="post">
                    <input type="hidden" name="bookingId" value="<?php echo $oneBooking["bookingId"]; ?>">
                    <input type="submit" value="Checkout" class="btn orangebtn">
                </form>
            </section>
        </section>
        <!-- Footer -->
        <?php
            include_once("_components/footer.php");
        ?>
    </body>
</html>