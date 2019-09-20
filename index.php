<?php
    require('functions.php');
?>
<!DOCTYPE html>
<html>
<head>
  <title>Sign-Up/Login Form</title>
  <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="css/style.css"> 
</head>

<body>
  <div class="form">
    <img src="./img/Kennedy.jpg" alt="Workstation Inc.">
      <ul class="tab-group">
        <li class="tab active"><a href="#signup">Sign Up</a></li>
        <li class="tab"><a href="#login">Log In</a></li>
      </ul>
      
      <div class="tab-content">
        <div id="signup">   
          <h1>SIGN UP</h1>
          
          <form method="post">
          
            <?php 
                if(isset($register)){
                    if($register['success']){
                        echo "
                        <div class='top-row'>
                          <p class='' style='margin-bottom: 20px; text-align: center; font-weight: bold; color: green !important;'> Registeration Successfull</p>
                        </div>
                        ";
                    }
                }
                if(isset($register)){
                    if(count($register['errors']) > 0){
                        foreach($register['errors'] as $error) 
                        echo "
                        <div class='top-row'>
                          <p class='error' style='text-align: center; color: red !important;'> {$error}</p>
                        </div>";
                    }
                }
                if(isset($login)){
                    if(count($login['errors']) > 0){
                        foreach($login['errors'] as $error) 
                        echo "
                          <div class='top-row'>
                            <p class='error' style='text-align: center; color: red !important;'> {$error}</p>
                          </div>";
                    }
                }
            ?>
          <div class="top-row">
          
            <div class="field-wrap">
              <label>
                First Name<span class="req">*</span>
              </label>
              <input type="text" name="fname" required autocomplete="off" style="color:black;" />
            </div>
        
            <div class="field-wrap">
              <label>
                Last Name<span class="req">*</span>
              </label>
              <input type="text"required autocomplete="off" name="lname"  style="color:black;"/>
            </div>
          </div>

          <div class="field-wrap">
            <label>
              Email Address<span class="req">*</span>
            </label>
            <input type="email"required autocomplete="on" name="email"  style="color:black;"/>
          </div>

          <div class="field-wrap">
            <label>
              Phone Number<span class="req">*</span>
            </label>
            <input type="tel"required autocomplete="off" name="phone"  style="color:black;"/>
          </div>
          
          <div class="field-wrap">
            <label>
              Username<span class="req">*</span>
            </label>
            <input type="text"required autocomplete="off" name="username"  style="color:black;"/>
          </div>

          <div class="top-row">
            <div class="field-wrap">
              <label>
                Password<span class="req">*</span>
              </label>
              <input type="password" required autocomplete="off" name="password"  style="color:black;"/>
            </div>
        
            <div class="field-wrap">
              <label>
                Confirm Password<span class="req">*</span>
              </label>
              <input type="password"required autocomplete="off" name="confirm_password"  style="color:black;"/>
            </div>
          </div>
          
          <button type="submit" name="register" class="button button-block"/>Get Started</button>
          
          </form>

        </div>
        
        <div id="login">   
          <h1>Welcome Back!</h1>
          
          <form method="post">
          
           <div class="field-wrap">
            <label>
              Email Address<span class="req">*</span>
            </label>
            <input type="email"required autocomplete="on" name="email"  style="color:black;"/>
           </div>
          
          <div class="field-wrap">
            <label>
              Password<span class="req">*</span>
            </label>
            <input type="password"required autocomplete="off" name="password" style="color:black;"/>
          </div>
          
          <p class="forgot"><a href="#">Forgot Password?</a></p>
          <?php 
              if(isset($login)){
                  if(count($login['errors']) > 0){
                      foreach($login['errors'] as $error) 
                      echo "<p class='error' style='text-align: center; color: red !important;'> {$error}</p>";
                  }
              }
          ?>
          <button type="submit" name="login" class="button button-block"/>Log In</button>
          
          </form>

        </div>
        
      </div><!-- tab-content -->
      
</div> <!-- /form -->
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script  src="js/index.js"></script>

</body>
</html>
