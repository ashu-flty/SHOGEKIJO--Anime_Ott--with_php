<?php
// DATABSE CONNECTION
$ser_name = "localhost";
$ser_username = "root";
$ser_pass = "";
$Db_name = "shogekijo_signup";
$con = mysqli_connect($ser_name, $ser_username, $ser_pass, $Db_name);
if (!$con) {
    die('Could not connect: ' . mysqli_connect_error());
    header("location:signup.html");
}

// GETTING VALUES FROM HTML FILE
// $mail=mysqli_real_escape_string( $_POST["Email"]); ask about the function
$name = $_POST["uname"];
$mail = $_POST["Email"];
$password = $_POST["pwd"];

$pass = password_hash($password, PASSWORD_BCRYPT);

$emailquery = "select * from registration where email = '$mail'";
$query =  mysqli_query($con, $emailquery);
$emailcount = mysqli_num_rows($query);

if ($emailcount > 0) {
    ?>
        <script>
            alert("Email-id already exists");
            location.href="signup.html";
        </script>
    <?php
    
} else {
    $insertquery = "INSERT INTO registration(username, email, passcode) VALUES('$name','$mail','$pass')";
    $iquery = mysqli_query($con, $insertquery);
    if ($iquery) {
?>
        <script>
            alert("Signup sucessfully");
            location.href="../main.html";
        </script>
    <?php
        header("location:../main.html");
    } else {
    ?>
        <script>
            alert("Failed to signup ");
            location.href="signup.html";
        </script>
<?php
    }
}
?>