<?php
include_once("db_connection.php");
$err_message="";
if(isset($_POST['submit'])){
    $username = $_POST['txtloginid'];
	$password = $_POST['txtpassword'];
    $user_id = 0;
    $status = "";

    $stmt = $con->prepare("SELECT user_id, username, password,role, status FROM tbl_login WHERE username=? AND password=? LIMIT 1");
    $stmt->bind_param('ss', $username, $password);
    $stmt->execute();
    $stmt->bind_result($user_id, $username, $password,$role, $status);
    $stmt->store_result();
    if($stmt->num_rows == 1)  //To check if the row exists
        {
            if($stmt->fetch()) //fetching the contents of the row
            {
               if ($status == 'D') {
				$err_message= "YOUR account has been DEACTIVATED.";
                   
               } else {
				   session_start();
				   $_SESSION['user_id'] = $user_id;
				   $_SESSION['user_name'] = $username;
                   $_SESSION['role'] = $role;
                   
                   $err_message= 'Success!';
                   header("location:./product.php");
               }
           }

    }
    else {
        $err_message= "INVALID USERNAME/PASSWORD !";
    }
    $stmt->close();
}

$con->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Donsmagic Login</title>
    <?php require_once("admin_links.php")?>
</head>
<body>
<section class="vh-100" style="background-color: #508bfc;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <h3 class="mb-5">Login</h3>            
            <form action="" method="post">
                <div class="form-outline mb-4">
                <input type="text" id="txtloginid" name="txtloginid" class="form-control form-control-lg" />
                <label class="form-label" for="txtloginid-2">Login Id</label>
                </div>

                <div class="form-outline mb-4">
                <input type="password" id="txtpassword" name="txtpassword" class="form-control form-control-lg" />
                <label class="form-label" for="txtpassword">Password</label>
                <h6 style="color:red;"><?php echo $err_message; ?></h6>
                </div>

                <!-- Checkbox -->
                <div class="form-check d-flex justify-content-start mb-4">
                <input class="form-check-input" type="checkbox" value="" id="chkremember" name="chkremember" />
                <label class="form-check-label" for="chkremember"> Remember password </label>
                </div>
                <button class="btn btn-primary btn-lg btn-block" id="submit" name="submit" type="submit">Login</button>
            </form>
            <hr class="my-4">
           
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>