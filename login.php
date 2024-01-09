<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
};

if(isset($_POST['submit'])) {
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_EMAIL);

   if (filter_var($email, FILTER_VALIDATE_EMAIL)) 
   {
       $pass = sha1($_POST['pass']);
       $pass = filter_var($pass, FILTER_SANITIZE_STRING);

       $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
       $select_user->execute([$email, $pass]);
       $row = $select_user->fetch(PDO::FETCH_ASSOC);

       if($select_user->rowCount() > 0)
       {
            $_SESSION['user_id'] = $row['id'];
            header('location:index.php');
       } 
       else
       {
           $message[] = 'Incorrect username or password!';
           header('location:login.php');
       }
   } 
   else 
   {
       $message[] = 'Invalid email address!';
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/forms.css">
    <title>Log In</title>
    <link rel="icon" type="images/x-icon" href="https://cdn4.iconfinder.com/data/icons/social-messaging-ui-color-and-shapes-1/177800/01-1024.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet"/>
 
</head>
<body style="background: url(images/loginphoto.jpg); background-size: cover;">
<?php include 'components/nav_forms.php'; ?>
    <div style="background-color:#0C2D48; color:white" class="container-fluid" id="containerm">
        <h1>SIGN IN</h1>
       
        <form class="row g-3 needs-validation" name="frmUserlogin" method="post" autocomplete="off" action="#" onsubmit="return result()" >
            <div class="inputfeild mt-4 ">
                <label style="color:white" class="form-label mb-2">UserEmail:</label>
                <input type="email" class="form-control" name="email" id="txtUSerEmail" placeholder="Enter Your UserEmail" onkeyup="validateUserEmail()">
                <span id="UserEmail_Error"></span>
            </div>
      
            <div class="inputfeild mt-4">
                <label style="color:white" class="form-label mb-2">Password:</label>
                <div class="input-group">
                    <input type="password" class="form-control" name="pass" id="txtPassword" placeholder="Enter Password" onkeyup="validatePassword()">
                    <button type="button" class="btn btn-outline-secondary" id="showPasswordBtn">
                        <i class="bx bx-hide show-hide"></i>
                    </button>
                </div>
                <span id="Password_Error"></span>
            </div>

            <!--Button-->
            <button style="color:white; font-weight: bold;" type="submit" class="btn btn-outline-secondary btn-lg " id="btnSubmit" name="submit" >Log In</button>
            <div class="inputfeild mt-4">
              <P class="form-label" style="font-size: 18px; padding-left:135px">Not a  member ? <a href="register.php" style="color: white;">Register Here</a></P>
            </div>
        </form>
    </div>
    <?php include 'components/footer_Forms.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-rS5pF5siw5S5n5O0z5n5PvFg5F6F5g5l5i5o5f5f5" crossorigin="anonymous"></script>


    <!--validation user inputs-->
    <script type="text/javascript">
        var UserEmail_Error=document.getElementById('UserEmail_Error'); 
        var Password_Error=document.getElementById('Password_Error');
    
    //validate user Email
    function validateUserEmail()
    {
      var Email = document.getElementById('txtUSerEmail').value.replace(/^\s+|\s+$/g, "");
      if (Email.length == 0) 
      {
        UserEmail_Error.innerHTML='User Email is required.';
        return false;
      }
      else
      {
        var emaiPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
       if (!Email.match(emaiPattern))
       {
        UserEmail_Error.innerHTML='Please Enter UserEmail in correct format.';
        return false;
       }
       UserEmail_Error.innerHTML = '<i class="fa-regular fa-circle-check"></i> ';
      return true;
      }  
    }
    
    
    //validate user Password
    function validatePassword()
    {
      var Password=document.getElementById('txtPassword').value.replace(/^\s+|\s+$/g, "");
    
      if (Password.length == 0) 
      {
        Password_Error.innerHTML='Password is required.';
        return false;
      }
      else
      {
        const PasswordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
       if (!Password.match(PasswordPattern))
       {
        Password_Error.innerHTML='Please Enter Password with Numbers,symbols,upper and lower case (minimum 8 characters)';
        return false;
       }
       Password_Error.innerHTML = '<i class="fa-regular fa-circle-check"></i>';
      return true;
      }  
    }
    
    
    function result()
    {
      validateUserEmail();
      validatePassword();

    if((!validateUserEmail()) ||  (!validatePassword()))
    {
       return false;
    }
    }
    </script>

  <script>
      // Function to toggle password visibility
      function togglePasswordVisibility(inputId, buttonId) {
          const passwordInput = document.getElementById(inputId);
          const showHideButton = document.getElementById(buttonId);

          if (passwordInput.type === "password") {
              passwordInput.type = "text";
              showHideButton.innerHTML = '<i class="bx bx-show show-hide"></i>';
          } else {
              passwordInput.type = "password";
              showHideButton.innerHTML = '<i class="bx bx-hide show-hide"></i>';
          }
      }

      // Event listeners for the show/hide buttons
      document.getElementById("showPasswordBtn").addEventListener("click", function () {
          togglePasswordVisibility("txtPassword", "showPasswordBtn");
      });

      document.getElementById("showConfirmPasswordBtn").addEventListener("click", function () {
          togglePasswordVisibility("txtConfirm_Password", "showConfirmPasswordBtn");
      });
  </script>


</body>
</html>
