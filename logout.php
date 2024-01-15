<div class="alert text-center">
<?php
    session_start();   
    if(isset($_SESSION['authenticated_user'])){
        unset($_SESSION['authenticated_user']);
        unset($_SESSION['auth_user']);
        unset($_SESSION['auth_admin']);
        header('Location: index.php');    
        // echo "<script>window.close();</script>"; 
    }
?>
</div>

