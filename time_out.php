<?php
    session_start();
    $page_title = 'Time Tracker';
    include 'includes/header.php';
    include 'includes/navbar.php';
    include 'includes/dbcon.php';
    $session_user = $_SESSION['user_id'];
?>
<?php

    if(isset($_POST['time_out_submit'])){

        date_default_timezone_set("Asia/Manila");

        $currentDateTime = new DateTime('now');
        $login_Date = $currentDateTime->format('Y-m-d');
        $login_Time = date('h:i:s A');  
        
        $select = "SELECT * FROM dtr WHERE user_id=$session_user ORDER BY id DESC LIMIT 1";

        $stmt = $pdo->query($select);
        $stmt->execute();
        $row = $stmt->fetch();

        if($row->login_date == '' && $row->login_time == ''){
            echo '
                <script>
                    Swal.fire({
                        title: "Warning",
                        text: "Time out is not allowed. Please perform time in before doing time out",
                        icon: "warning"
                    }).then(function(){
                    window.location = "users_account.php";
                    });
                </script>
            ';
            exit();
        }       
        $update = "UPDATE dtr SET logout_date=:logout_date,logout_time=:logout_time WHERE id=$row->id";
        $stmt = $pdo->prepare($update);
        $stmt->execute(['logout_date'=>$login_Date,'logout_time'=>$login_Time]);
        
        header('location:users_account.php');
    }
?>

