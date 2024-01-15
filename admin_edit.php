<?php
    include 'includes/header.php';
    include 'includes/navbar_admin.php';
    include 'includes/dbcon.php';
?>
<?php
    if(isset($_POST['edit_admin_modal'])){
        $id = $_POST['id'];
        $status = trim($_POST['status']);                

        $update ="UPDATE users SET status=:status WHERE id=:id";
        $stmt = $pdo->prepare($update);
        $stmt->execute(['id'=>$id,'status'=>$status]);

        echo '
            <script>
                Swal.fire({
                    title: "Done",
                    text: "Record updated",
                    icon: "success"
                }).then(function(){
                    window.location = "admin_panel.php";
                });
            </script>
            ';
            exit();
    }
?>

