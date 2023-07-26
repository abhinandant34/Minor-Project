
<!DOCTYPE html>
<html>
<head>
	<title>Signup Page</title>
    <link rel="stylesheet" href="./signup.css"> 
</head>
<body>	
	<form method="post" action="register.php" class="login-form">
		<h1>SIGN UP</h1>
		<input type="text" name="fullname" placeholder="Fullname" class="login-input name" required>
		<input type="text" name="username" placeholder="Username" class="login-input username" required>
		<input type="password" name="password" placeholder="Password" class="login-input password" required>

		<input type="submit" name="submit" value="Signup" class="signup-button">
        <p>Already have an account.<a href="index.php">Sign In</a></p>
	</form>
</body>
</html>