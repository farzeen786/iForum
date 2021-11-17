<?php
$showError ="false";
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    include '_dbconnect.php';
    $user_email = $_POST['signupEmail1'];
    $pass = $_POST['signupPassword'];
    $cpass = $_POST['signupcPassword'];

    // check whether this email exists
    $existSql = "SELECT * from `users` where user_email = '$user_email'";
    $result = mysqli_query($con,$existSql);
    $numRows = mysqli_num_rows($result);
    if($numRows>0)
    {
        $showError = "Username Is Already In Use";
    }
    else
    {
        if($pass == $cpass)
        {
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`user_email`, `user_pass`, `timestamp`) VALUES ('$user_email', '$hash', current_timestamp()) ";
            $result = mysqli_query($con, $sql);
            if($result)
            {
                $showALert = true;
                header("Location: /FORUM/index.php?signupsuccess=true");
                exit();
            }
        }
        else
        {
        $showError = "Passwords do not match";
        
        }
    }
  
    header("Location: /FORUM/index.php?signupsuccess=false&error=$showError");

}

?>
