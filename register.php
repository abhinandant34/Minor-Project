<?php
$con = mysqli_connect("localhost", "root", "", "minor");
if(isset($_POST['submit'])){
    // Get input data
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if user already exists with the same email
    $check_query = "SELECT * FROM users WHERE username='$username'";
    $check_result = mysqli_query($con, $check_query);

    if(mysqli_num_rows($check_result)){
        echo "User already exists with the same Username!";
    }
    else{
        // Insert user data into database
        $insert_query = "INSERT INTO users VALUES ('$fullname', '$username', '$password')";
        if(mysqli_query($con, $insert_query)){
            echo "Signup successful!";
        }
        else{
            echo "Error: " . mysqli_error($con);
        }
    }

    // Close database connection
    mysqli_close($con);
}
?>
