<?php
    session_start();
    $page_title = 'Time Tracker';
    include 'includes/header.php';
    include 'includes/navbar_admin.php';
    include 'includes/authentication.php';
    include 'includes/dbcon.php';
?>

<div class="container-fluid">
    <h5 class="float-start mt-2 py-0">USER'S DATABASE LISTING</h5>  
    
    <a href="backup.php"><button type="button" class="btn btn-sm btn-secondary float-end mx-1 mt-2">
    BACKUP DB
    </button></a>
    
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
    
    <table class="table table-dark table-striped table-sm pt-1" id="daTable" style="font-size:13px">
        <thead>
            <tr>
                <th>ID No.</th>
                <th>USER ID</th>
                <th>FULLNAME</th>
                <th>EMAIL</th>
                <th>PASSWORD</th>
                <th>ROLE</th>
                <th>STATUS</th>
                <th>DATE CREATED</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
            <?php
                //PDO query
                $stmt = $pdo->query("SELECT * FROM users");

                // Fetch style = object
                while($row = $stmt->fetch()){
            ?>    
            <tr>
                <td><?= $row->id; ?></td>
                <td><?= $row->user_id; ?></td>
                <td><?= $row->fullname; ?></td>
                <td><?= $row->email; ?></td>
                <td><?= $row->password; ?></td>
                <td><?= $row->role; ?></td>
                <td><?= $row->status; ?></td>
                <td><?= $row->date_created; ?></td>
                <td>         
                    <a class="btn btn-sm btn-success edit_btn my-1 py-0" data-bs-toggle="modal" data-bs-target="#editModal">Edit 
                    </a>                            
                
                    <a class="btn btn-danger btn-sm my-1 py-0" href="admin_delete.php?delete_id=<?php echo $row->id ?>">Delete</a>                 
                </td>    
            </tr>      
            <?php
                }
            ?>
        </tbody>
    </table>     
    
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

<!-- Edit Modal -->
<div class="modal fade py-5" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog py-5">
    <div class="modal-content">
      <div class="modal-header py-2">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form action="admin_edit.php" method="POST">
            <div class="modal-body py-1">
                <div class="form-group">
                    <input type="hidden" class="form-control" name="id" id="id" >                        
                </div>
                <div class="form-group">
                    <label>User ID</label>
                    <input type="text" class="form-control" name="user_id" id="user_id" disabled />                    
                </div>
                <div class="form-group">
                    <label>Fullname</label>
                    <input type="text" class="form-control" name="fullname" id="fullname" disabled />                    
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <input type="text" class="form-control" name="status" id="status"/>                    
                </div>
                <div class="form-group float-end my-3">                    
                <button type="submit" class="btn btn-primary" name="edit_admin_modal">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>            
        </form>
    </div>
  </div>
</div>

</div>

<!-- Edit jQuery -->
<script>
    $(document).ready(function(){
        $('.edit_btn').on('click', function(){
            $('#editModal').modal('show');

            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function(){
                return $(this).text();
            }).get();
            
            $('#id').val(data[0]); 
            $('#user_id').val(data[1]); 
            $('#fullname').val(data[2]); 
            $('#status').val(data[6]);
        });
    });
</script>

<!-- DataTables -->
<script>    
    $(document).ready(function() {
        $('#daTable').DataTable({
            order: [[0, 'desc']]
        });
    } );    
</script>