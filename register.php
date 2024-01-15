<?php
    $page_title = 'Time Tracker';
    include 'includes/header.php';
    include 'includes/navbar.php';
    include 'includes/dbcon.php';
?>

<?php
    if(isset($_POST['register'])){
        $user_id = trim($_POST['user_id']);
        $fullname = ucwords(trim($_POST['fullname']));
        $email = trim($_POST['email']);
        $password = md5($_POST['password']);
        $cpassword = md5($_POST['cpassword']);
       
        if($password != $cpassword){            
            echo '
                <script>
                    Swal.fire({
                        title: "Invalid Entry",
                        text: "Password does not match",
                        icon: "error"
                    }).then(function(){
                    window.location = "index.php";
                });
                </script>
                ';
                exit();
        }

        $select = "SELECT * FROM users WHERE user_id=:user_id || email=:email || fullname=:fullname";
        $stmt = $pdo->prepare($select);
        $stmt->execute(['user_id'=>$user_id,'fullname'=>$fullname,'email'=>$email]);
        $row = $stmt->fetch();
        
        $count = $stmt->rowCount();

        if($count > 0){              
            echo '
                <script>
                    Swal.fire({
                        title: "Warning",
                        text: "User account already exist in database",
                        icon: "warning"
                    }).then(function(){
                    window.location = "index.php";
                });
                </script>
                '; 
                exit();
        }else{            
            $users_insert = "INSERT INTO users (user_id,fullname,email,password) VALUES (:user_id,:fullname,:email,:password)";
            $users_stmt = $pdo->prepare($users_insert);
            $users_stmt->execute(['user_id'=>$user_id,'fullname'=>$fullname,'email'=>$email,'password'=>$password]);

            $insert = "INSERT INTO dtr (rid,user_id,fullname) VALUES (:rid,:user_id,:fullname)";
            $stmt = $pdo->prepare($insert);
            $rid = $pdo->lastInsertId();
            $stmt->execute(['rid'=>$rid,'user_id'=>$user_id,'fullname'=>$fullname]);

            echo '
                <script>
                    Swal.fire({
                        title: "Congratulation",
                        text: "User account successfully created",
                        icon: "success"
                    }).then(function(){
                        window.location = "index.php";
                    });                
                    </script>                
                ';
                exit();
        }
    }
?>
