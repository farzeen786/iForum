<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

        
    <title>Welcome to iForums</title>
</head>

<body>
    <?php  include 'partials/_dbconnect.php';    ?>

    <?php  include 'partials/_header.php';    ?>

    <div class="jumbotron" style="background-color:#c6c9cf" >
        <h1 class="display-4 text-center" >Contact Us</h1>
      

    </div>
    <div class="container" style="margin-bottom: 28vh;">
    <form action="/FORUM/contact.php" method="POST">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Message</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" name="message" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-success" value="submit" name="form_submit">Submit</button>
        </form>
    </div>


<?php
$showAlert =false;
  if(isset($_POST["form_submit"]))
  {
    
    $row = ['email'];
    $row = ['message'];
    extract($_POST);
    $sql = "INSERT INTO `contacts` (`email`, `message`) VALUES ('$email', '$message')";
    $result = mysqli_query($con, $sql);
    if($result)
    {
      echo "";
    }
    else{
      echo "no";
    }

  }
?>
    <?php  include 'partials/_footer.php';    ?>
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
    </script>
</body>

</html>