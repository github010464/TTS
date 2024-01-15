<?php
    include 'includes/header.php';
    include 'includes/navbar_admin.php';
    include 'includes/dbcon.php';
?>
<?php
    if(isset($_GET['delete_id'])){
        $id = trim($_GET['delete_id']);

        $delete ="DELETE FROM users WHERE id=?";
        $stmt = $pdo->prepare($delete);
        $stmt->execute([$id]);

        echo '
            <script>
                Swal.fire({
                    title: "Done",
                    text: "Record has been deleted!",
                    icon: "success",
                    showCancelButton: false,
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "&nbsp;&nbsp;OK&nbsp;&nbsp;"
                }).then((result) => {
                    if (result.isConfirmed) {
                    location = "admin_panel.php"
                    }
                })
            </script>';
            exit();
    }
?>

