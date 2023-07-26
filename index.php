<!DOCTYPE html>
<html>
<head>
<title>SQL Injection Example</title>
<link rel="stylesheet" href="./style.css"> 
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
<?php
$con = mysqli_connect("localhost", "root", "", "minor");


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://localhost:3000/predict',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "input": "abhinandan"
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;

if(isset($_POST['submit'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $query = "SELECT * FROM users WHERE username='" . $username . "' AND password='" . $password . "';";
  $result = mysqli_query($con, $query);

  if(mysqli_num_rows($result)) {
    // Redirect to welcome.php
    echo $query;
    $query_string = http_build_query($username);
    header("Location: welcome.php?username=$query_string");
    exit();
  } else {
    echo $query;
    echo "Invalid username or password.";
  }
}
?>
<form method="post" action="welcome.php" class="login-form">
  <h1>LOGIN</h1>
  <input type="text" name="username" placeholder="Username" class="login-input username"><br>
  <input type="text" name="password" placeholder="Password" class="login-input password"><br>
  <input type="submit" name="submit" value="Submit" class="login-button">
  <p>New User?<a href="signup.php">Sign Up</a></p>
</form>
</body>
</html>

