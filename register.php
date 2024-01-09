<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? OR number = ?");
   $select_user->execute([$email, $number]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $message[] = 'email or number already exists!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         $insert_user = $conn->prepare("INSERT INTO `users`(name, email, number, password) VALUES(?,?,?,?)");
         $insert_user->execute([$name, $email, $number, $cpass]);
         $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
         $select_user->execute([$email, $pass]);
         $row = $select_user->fetch(PDO::FETCH_ASSOC);
         if($select_user->rowCount() > 0){
            $_SESSION['user_id'] = $row['id'];
            header('location:index.php');
         }
      }
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
    <title>Tashni - Registration</title>
    <link rel="icon" type="images/x-icon" href="https://cdn4.iconfinder.com/data/icons/social-messaging-ui-color-and-shapes-1/177800/01-1024.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet"/>
 
</head>
<body style="background: url(images/loginphoto.jpg); background-size: cover;">
<?php include 'components/nav_forms.php'; ?>
    <div style="background-color:#0C2D48; color:white" class="container-fluid" id="containerm">
        <h1>SIGN UP</h1>
       
        <form class="row g-3 needs-validation" name="frmUserRegistration" method="post" autocomplete="off" action="#" onsubmit="return result()" >
            <div class="inputfeild mt-3 ">
                <label style="color:white" class="form-label mb-2">User Name:</label>
                <input type="text" class="form-control" name="name" id="txtName" placeholder="Enter Your Name" onkeyup="validateName()">
                <span id="Name_Error"></span>
            </div>

            <div class="inputfeild mt-3 ">
                <label style="color:white" class="form-label mb-2">User Email:</label>
                <input type="email" class="form-control" name="email" id="txtUSerEmail" placeholder="Enter Your UserEmail" onkeyup="validateUserEmail()">
                <span id="UserEmail_Error"></span>
            </div>
      
            <div class="inputfeild mt-3 ">
                <label style="color:white" class="form-label mb-2">Telephone No:</label>
                <input type="text" class="form-control" name="number" id="txtTelephoneNo" placeholder="Enter Your Telephone Number" onkeyup="validateTelephoneNo()">
                <span id="TelephoneNo_Error"></span>
            </div>

        
      
            <div class="inputfeild mt-3">
                <label style="color:white" class="form-label mb-2">Password:</label>
                <div class="input-group">
                    <input type="password" class="form-control" name="pass" id="txtPassword" placeholder="Enter Password" onkeyup="validatePassword()">
                    <button type="button" class="btn btn-outline-secondary" id="showPasswordBtn">
                        <i class="bx bx-hide show-hide"></i>
                    </button>
                </div>
                <span id="Password_Error"></span>
            </div>

            <div class="inputfeild mt-3">
                <label style="color:white" class="form-label mb-2">Confirm Password:</label>
                <div class="input-group">
                    <input type="password" class="form-control" name="cpass" id="txtConfirm_Password" placeholder="Please Confirm Password" onkeyup="validateConfirm_Password()">
                    <button type="button" class="btn btn-outline-secondary" id="showConfirmPasswordBtn">
                        <i class="bx bx-hide show-hide"></i>
                    </button>
                </div>
                <span id="Confirm_Password_Error"></span>
            </div>

            <!--Button-->
            <button style="color:white; font-weight:bold" type="submit" class="btn btn-outline-secondary btn-lg " id="btnSubmit" name="submit" >Register</button>
            <div class="inputfeild mt-3">
              <P class="form-label" style="font-size: 18px; padding-left:135px;">Already a  member ? <a href="login.php" style="color: white;">Login Here</a></P>
            </div>
        </form>
    </div>
    <?php include 'components/footer_Forms.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-rS5pF5siw5S5n5O0z5n5PvFg5F6F5g5l5i5o5f5f5" crossorigin="anonymous"></script>


   
    <!--validation user inputs-->
    <script type="text/javascript">
        var Name_Error=document.getElementById('Name_Error');
        var UserEmail_Error=document.getElementById('UserEmail_Error'); 
        //var UserRole_Error = document.getElementById('UserRole_Error');
        var TelephoneNo_Error=document.getElementById('TelephoneNo_Error'); 
        var Password_Error=document.getElementById('Password_Error');
        var Confirm_Password_Error=document.getElementById('Confirm_Password_Error');
    
    //validate user Name
    function validateName()
    {
    
    var Name=document.getElementById('txtName').value.replace(/^\s+|\s+$/g, "");
    if(Name.length == 0)
    {
        Name_Error.innerHTML='Name is required.';
        return false;
    }
    Name_Error.innerHTML = '<i class="fa-regular fa-circle-check"></i>';
    return true;
    }

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
    
    // //validate user Role
    // function validate_User_Role()
    // {
    // if(document.getElementById("User_Role").value == "S")
    // {
    //     UserRole_Error.innerHTML='User Role is required.';
    //     return false;
    // }
    //    UserRole_Error.innerHTML = '<i class="fa-regular fa-circle-check"></i>';
    //    return true;
    // }
      
    // document.getElementById("User_Role").addEventListener("click", function() {
    
    //   if (document.getElementById("User_Role").value != "S") {
    
    //     UserRole_Error.innerHTML = '<i class="fa-regular fa-circle-check"></i>';
    //   return true;
    // }
    // });

     //validate Telephone No
    function validateTelephoneNo()
    {
    var TelephoneNo=document.getElementById('txtTelephoneNo').value.replace(/^\s+|\s+$/g, "");

    if(TelephoneNo.length == 0)
    {
        TelephoneNo_Error.innerHTML='Telephone No is required.';
        return false;
    }
    else
    {
        var contactPattern = /^\d{10}$/;
    if (!TelephoneNo.match(contactPattern))
    {
        TelephoneNo_Error.innerHTML='Please Enter contact in correct format.';
        return false;
    }
    TelephoneNo_Error.innerHTML = '<i class="fa-regular fa-circle-check"></i>';
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
    
    //validate confirm password
    function validateConfirm_Password() {
      var Confirm_Password = document.getElementById('txtConfirm_Password').value.trim();
      var Passwordx = document.getElementById('txtPassword').value.trim();
    
      var Confirm_Password_Error = document.getElementById('Confirm_Password_Error');
    
      if (Confirm_Password.length === 0) {
        Confirm_Password_Error.innerHTML = 'Confirm Password is required.';
        return false;
      } else if (Confirm_Password !== Passwordx) {
        Confirm_Password_Error.innerHTML = 'Please Enter the correct password Again.';
        return false;
      } else {
        Confirm_Password_Error.innerHTML = '<i class="fa-regular fa-circle-check"></i>';
        return true;
      }
    }
    
    function result()
    {
      validateName();
      validateUserEmail();
      //validate_User_Role();
      validateTelephoneNo();
      validatePassword();
      validateConfirm_Password();
    
    if( (!validateName()) || (!validateUserEmail()) ||  (!validateTelephoneNo()) || (!validatePassword()) || (!validateConfirm_Password()))
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
