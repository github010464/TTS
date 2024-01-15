<?php
    session_start();
    $page_title = 'Time Tracker';
    include 'includes/header.php';
    include 'includes/navbar.php';
    include 'includes/authentication.php';
    include 'includes/dbcon.php';
?>
<?php
    $auth_user = $_SESSION['auth_user'];    
?>
<div class="container-fluid">
    <h5 class="float-start mt-2 py-0">USER'S DAILY TIME RECORD</h5>    
    
    <!-- Button trigger Add modal -->
    <button type="button" class="btn btn-sm btn-primary float-end mx-1 mt-2" data-bs-toggle="modal" data-bs-target="#addModal">
    ADD 
    </button> 
    <!-- Button trigger Import modal -->
    <button type="button" class="btn btn-sm btn-dark float-end mx-1 mt-2 import_btn" data-bs-toggle="modal" data-bs-target="#importModal">
    IMPORT 
    </button>   
    <br/>
    <hr class="mt-4 mb-1 w-100">

    <table class="table table-striped table-sm pt-1" id="daTable" style="font-size:13px">
        <thead>
            <tr>
                <th>ID No.</th>
                <th>RID</th>
                <th>USER ID</th>
                <th>FULLNAME</th>
                <th>LOGIN DATE</th>
                <th>LOGIN TIME</th>
                <th>LOGOUT DATE</th>
                <th>LOGOUT TIME</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
            <?php

                //PDO query
                $stmt = $pdo->query("SELECT * FROM dtr WHERE user_id = $auth_user");
                // $stmt = $pdo->query("SELECT * FROM dtr WHERE user_id= $session_user");

                // Fetch style = object
                while($row = $stmt->fetch()){
            ?>    
            <tr>
                <td><?= $row->id; ?></td>
                <td><?= $row->rid; ?></td>
                <td><?= $row->user_id; ?></td>
                <td><?= $row->fullname; ?></td>
                <td><?= $row->login_date; ?></td>
                <td><?= $row->login_time; ?></td>
                <td><?= $row->logout_date; ?></td>
                <td><?= $row->logout_time; ?></td>
                <td>     
                    <?php
                        if($row->login_time != ''){
                            echo '                                
                                <a class="btn btn-success btn-sm py-0 disabled" href="time_in_tracker.php" id="time_in_link">Time in</a>
                            ';
                        }else{
                            echo '                                
                                <a class="btn btn-success btn-sm py-0 " href="time_in_tracker.php">Time in</a>
                        '; 
                        }

                        if($row->logout_time != ''){
                            echo '
                                <a class="btn btn-danger btn-sm py-0 disabled" href="time_out_tracker.php">Time out</a>
                            ';
                        }
                        else{
                            echo '
                                <a class="btn btn-danger btn-sm py-0 " href="time_out_tracker.php">Time out</a>
                            ';
                        }
                    ?>
            </tr>      
            <?php
                }
            ?>
        </tbody>
    </table> 
    
    
<!-- Register Modal -->
<div class="modal fade py-5" id="registerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog py-5">
    <div class="modal-content">
      <div class="modal-header py-2">
        <h1 class="modal-title fs-5" id="exampleModalLabel">User's Registration</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form action="register.php" method="POST">
            <div class="modal-body py-1">
                <div class="form-group">
                    <label>User ID</label>
                    <input type="text" class="form-control" name="user_id" pattern="[0-9].{8}" title="Numeric characters only, maximum of 9" required />                    
                </div>
                <div class="form-group">
                    <label>Fullname</label>
                    <input type="text" class="form-control" name="fullname" pattern="([a-zA-Z]+\s\ñ){1,}([a-zA-Z]+)" title="Sample format: Mark Cañete" required />                    
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" name="email"  required />                    
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="text" class="form-control" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters"  required />                    
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="text" class="form-control" name="cpassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters"  required />                    
                </div>
                <div class="form-group my-3 float-end">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" name="register">Submit</button>
                </div>
            </div>            
        </form>
    </div>
  </div>
</div>

<!-- Login Modal -->
<div class="modal fade py-5" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog py-5">
    <div class="modal-content">
      <div class="modal-header py-2">
        <h1 class="modal-title fs-5" id="exampleModalLabel">User's Login</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form action="login.php" method="POST">
            <div class="modal-body py-1">
                <div class="form-group">
                    <label>User ID</label>
                    <input type="text" class="form-control" name="user_id"/>                    
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="text" class="form-control" name="password"/>                    
                </div>
                <div class="form-group float-end my-3">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" name="login">Login</button>
                </div>
            </div>            
        </form>
    </div>
  </div>
</div>

<!-- DataTables -->
<script>    
    $(document).ready(function() {
        $('#daTable').DataTable({
            // responsive: true
            order: [[0, 'desc']]
        });
    } );    
</script>

</div>
