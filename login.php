<?php
    session_start();    
    $page_title = 'Login';
    include 'includes/header.php';
    include 'includes/navbar.php';
    include 'includes/dbcon.php';
?>
<?php
    if(isset($_POST['login'])){

        $user_id = trim($_POST['user_id']);
        $password = md5($_POST['password']);        

        if($user_id == 'admin' && $password == md5('myP@ssw0rd')){

            $_SESSION['authenticated_user'] = TRUE;
            $_SESSION['auth_admin'] = 'admin';

            header('location:admin_panel.php');
            exit();
        }        
    
        $select = "SELECT * FROM users WHERE user_id=:user_id && password=:password";
        $stmt = $pdo->prepare($select);
        $stmt->execute(['user_id'=>$user_id,'password'=>$password]);
        $row = $stmt->fetch();

        $count = $stmt->rowCount();

        $_SESSION['authenticated_user'] = TRUE;
        $_SESSION['auth_user'] = $user_id;
        
        $_SESSION['user_id'] = $user_id;
        $session_user = $_SESSION['user_id'];
        
        if($count > 0){
        
            if($row->status == 'inactive'){
                echo '
                    <script>
                        Swal.fire({
                            title: "Account Inactive",
                            text: "Please send an email to admin@tts.com requesting account activation",
                            icon: "question"
                        }).then(function(){
                        window.location = "index.php";
                        });
                    </script>                
                ';            
                exit();                   
            }
                           
            date_default_timezone_set("Asia/Manila");

            $currentDateTime = new DateTime('now');
            $login_Date = $currentDateTime->format('Y-m-d');
            $login_Time = date('h:i:s A');
        
            $select = "SELECT * FROM dtr WHERE user_id=$row->user_id ORDER BY id DESC LIMIT 1";
            $stmt = $pdo->query($select);
            $stmt->execute();
            $row = $stmt->fetch();
            
            if($row->login_date == '' || $row->login_date == $login_Date){
                // do nothing                
            }
            else{            
                $insert = "INSERT INTO dtr (rid,user_id,fullname) VALUES (:rid,:user_id,:fullname)";
                $stmt = $pdo->prepare($insert);
                $stmt->execute(['rid'=>$row->rid,'user_id'=>$row->user_id,'fullname'=>$row->fullname]);
            }
            header('location:users_account.php');   
        }    
        else
        {
            echo '
            <script>
                Swal.fire({
                    title: "Invalid Entry",
                    text: "User ID or password incorrect",
                    icon: "info"
                }).then(function(){
                window.location = "index.php";
                });
                </script>
            ';
            exit();
        }   
    }
?>
