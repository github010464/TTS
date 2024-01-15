<?php      
    if (!isset($_SESSION['authenticated_user']))
    { 
        echo "
        <div class='text-center py-4'>
        <h1 class='text-danger'>Unathorized Access !<h1>
        <h6>Please contact administrator for proper authentication.</h6>        
        </div>
        ";
        exit();
    }
?>



<!-- <script type="text/javascript">
  function JavaBlink() {
     var blinks = document.getElementsByTagName('JavaBlink');
     for (var i = blinks.length - 1; i >= 0; i--) {
        var s = blinks[i];
        s.style.visibility = (s.style.visibility === 'visible') ? 'hidden' : 'visible';
     }
     window.setTimeout(JavaBlink, 1000);
  }
  if (document.addEventListener) document.addEventListener("DOMContentLoaded", JavaBlink, false);
  else if (window.addEventListener) window.addEventListener("load", JavaBlink, false);
  else if (window.attachEvent) window.attachEvent("onload", JavaBlink);
  else window.onload = JavaBlink;
</script> -->


