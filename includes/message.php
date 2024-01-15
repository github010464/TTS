<div class="alert text-center">
        <?php
            if(isset($_SESSION['message']))
            {
                echo "<h2 style='color: red'>".$_SESSION['message']."</h2>";
                unset($_SESSION['message']);
                exit(0);
            }
        ?>
</div>