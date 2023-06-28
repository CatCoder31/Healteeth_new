<!-- reset_password.php -->
<?php
echo $_GET['email'];
?>
<form action="update_password.php" method="POST">
  <input type="hidden" name="email" id="email" value="<?php echo $_GET['email']; ?>">
  <label for="new_password">New Password:</label>
  <input type="password" id="new_password" name="new_password" required>
  <input type="submit" value="Reset Password">
</form>
