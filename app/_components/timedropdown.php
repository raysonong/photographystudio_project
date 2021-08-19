<?php
    function timeDropdown($s, $e) {
        $start = strtotime($s);
        $end = strtotime($e);
        $time = $start;

        // Display the time
        while($time <= $end) {
?>
<option value="<?php echo date("H:i",$time); ?>">
    <?php echo date("H:i",$time); ?>
</option>
<?php
            $time = strtotime('+1 hour',$time);
        }
    }
?>