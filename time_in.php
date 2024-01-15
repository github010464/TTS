<?php
    session_start();
    $page_title = 'Time Tracker';
    include 'includes/header.php';
    include 'includes/navbar.php';
    include 'includes/dbcon.php';
    $session_user = $_SESSION['user_id'];    
?>

<?php
    if(isset($_POST['time_in_submit'])){

        date_default_timezone_set("Asia/Manila");
        $currentDateTime = new DateTime('now');
        $login_Date = $currentDateTime->format('Y-m-d');
        $login_Time = date('h:i:s A');  
        
        $select = "SELECT * FROM dtr WHERE user_id=$session_user ORDER BY id DESC LIMIT 1";
        $stmt = $pdo->query($select);
        $stmt->execute();
        $row = $stmt->fetch();
      
        $update = "UPDATE dtr SET login_date=:login_date,login_time=:login_time WHERE id=$row->id";
        $stmt = $pdo->prepare($update);
        $stmt->execute(['login_date'=>$login_Date,'login_time'=>$login_Time]);
        
        header('location:users_account.php');
    }
?>

