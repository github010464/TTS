<?php
    include 'includes/header.php';
    include 'includes/navbar.php';
    include 'includes/dbcon.php';
?>
<?php
    // Check if file exist using file_exists
    $filepath = 'C:\DB_Backup';
    if(!file_exists($filepath)){
       
        // echo 'make directory';
        mkdir($filepath, 0777, true); 
    }
    // Backup database using mysqldump
    echo exec('cd\xampp\mysql\bin');
    echo exec('mysqldump --user=root --password="" tt_modal > c:\DB_Backup\tt_modal.sql');
    
    // Rename the file appending date today
    $date = new DateTime();
    rename('c:\DB_Backup\tt_modal.sql','c:\DB_Backup\tt_modal-' . $date->format("Ymd") . '.sql');
    // header('location:admin_panel.php');
    echo '
        <script>
            Swal.fire({
                title: "Done",
                text: "Backup completed",
                icon: "success"
            }).then(function(){
                window.location = "admin_panel.php";
            });
        </script>
        ';
        exit();
?>