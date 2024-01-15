<?php
    $page_title = 'Time Tracker';
    include 'includes/header.php';
    include 'includes/navbar.php';
    include 'includes/dbcon.php';  
?>
<div class="container-fluid">
<h1 class="text-center my-4">Welcome to Time Tracking System</h1>

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
                    <input type="text" class="form-control" name="email" required />                    
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" id="rpassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters" required /><i class="fa-solid fa-eye-slash" id="show_reg_password"></i>                    
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" class="form-control" name="cpassword" id="cpassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters" required /><i class="fa-solid fa-eye-slash" id="confirm_password"></i>                    
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
                    <input type="password" class="form-control" name="password" id="password"/><i class="fa-solid fa-eye-slash" id="show_password"></i>                    
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

</div>

<script>
        // show password (login)
		const showPassword = document.querySelector("#show_password");
		const passwordField = document.querySelector("#password");

		showPassword.addEventListener("click", function(){
		this.classList.toggle("fa-eye");
		const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
		passwordField.setAttribute("type", type);
		});

        // show password (register)
		const registerPassword = document.querySelector("#show_reg_password");
		const rpasswordField = document.querySelector("#rpassword");

		registerPassword.addEventListener("click", function(){
		this.classList.toggle("fa-eye");
		const type = rpasswordField.getAttribute("type") === "password" ? "text" : "password";
		rpasswordField.setAttribute("type", type);
		});

        // show confirm password
        const confirmPassword = document.querySelector("#confirm_password");
		const cpasswordField = document.querySelector("#cpassword");

		confirmPassword.addEventListener("click", function(){
		this.classList.toggle("fa-eye");
		const type = cpasswordField.getAttribute("type") === "password" ? "text" : "password";
		cpasswordField.setAttribute("type", type);
		});	
</script>