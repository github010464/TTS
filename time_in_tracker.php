<?php
    session_start();
    $page_title = 'Time Tracker';
    include 'includes/header_onload.php';
    include 'includes/navbar.php';
    include 'includes/dbcon.php';
?>

<div class="container d-flex justify-content-center py-5">
    <div class="col-md-4 py-5">
        <form action="time_in.php" class="border border-2" method="POST">
            <div class="form-group text-center">
                <h1 class="bg-secondary text-light fs-3 py-1" style="font-family:Impact">Time In</h1>
                <?php        
                    date_default_timezone_set("Asia/Manila");
                    echo "<div class='pt-2'>";
                    echo date('l jS \of F Y');
                    echo "</div>";
                    echo "<h1 id='clock'>&nbsp;</h1>";
                ?>        
            </div>
            <div class="d-flex justify-content-center mb-3">
            <button type="submit" class="btn btn-success w-50" name="time_in_submit" >S U B M I T</button>
            </div>
        </form>
    </div>
</div>


<script type="text/javascript">

  function init ( )
  {
    timeDisplay = document.createTextNode ( "" );
    document.getElementById("clock").appendChild ( timeDisplay );
  }

  function updateClock ( )
  {
    var currentTime = new Date ( );

    var currentHours = currentTime.getHours ( );
    var currentMinutes = currentTime.getMinutes ( );
    var currentSeconds = currentTime.getSeconds ( );

    // Pad the minutes and seconds with leading zeros, if required
    currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
    currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;

    // Choose either "AM" or "PM" as appropriate
    var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";

    // Convert the hours component to 12-hour format if needed
    currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;

    // Convert an hours component of "0" to "12"
    currentHours = ( currentHours == 0 ) ? 12 : currentHours;

    // Compose the string for display
    var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;

    // Update the time display
    document.getElementById("clock").firstChild.nodeValue = currentTimeString;
  }
  
</script>

