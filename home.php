<?php
    require('functions.php');
    
    $user = is_auth();
    
    if(isset($_POST['logout'])){
        logout();
    }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
  <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="css/style.css"> 
</head>

<body>
  <div class="form">
      <div class="">
        <div id="signup">   
          <h1>Welcome <?php echo $user['name'] ?> </h1>
          
          <form method="post">
            <button type="submit" name="logout" class="button button-block" />Logout</button>
          </form>

        </div>
        
      </div>
</div> <!-- /form -->
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script  src="js/index.js"></script>

</body>
</html>
