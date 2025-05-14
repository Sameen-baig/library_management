<!DOCTYPE html>
<html>
<head>…same as before…</head>
<body>
<?php
  $emailmsg=$_REQUEST['emailmsg']??'';
  $pasdmsg=$_REQUEST['pasdmsg']??'';
  $ademailmsg=$_REQUEST['ademailmsg']??'';
  $adpasdmsg=$_REQUEST['adpasdmsg']??'';
  $msg=$_REQUEST['msg']??'';
?>
<div class="container login-container">
  <div class="row"><h4><?=htmlspecialchars($msg)?></h4></div>
  <div class="row">
    <div class="col-md-6 login-form-3">
      <h3>Admin Login</h3>
      <form action="loginadmin_server_page.php" method="post">
        <input type="email" name="login_email" placeholder="Your Email *" required/>
        <label style="color:red;">*<?=htmlspecialchars($ademailmsg)?></label>
        <input type="password" name="login_pasword" placeholder="Your Password *" required/>
        <label style="color:red;">*<?=htmlspecialchars($adpasdmsg)?></label>
        <input type="submit" class="btnSubmit" value="Login"/>
      </form>
    </div>
    <div class="col-md-6 login-form-1">
      <h3>Student Login</h3>
      <form action="login_server_page.php" method="post">
        <input type="email" name="login_email" placeholder="Your Email *" required/>
        <label style="color:red;">*<?=htmlspecialchars($emailmsg)?></label>
        <input type="password" name="login_pasword" placeholder="Your Password *" required/>
        <label style="color:red;">*<?=htmlspecialchars($pasdmsg)?></label>
        <input type="submit" class="btnSubmit" value="Login"/>
      </form>
    </div>
  </div>
</div>
</body>
</html>
