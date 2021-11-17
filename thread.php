<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <style>
    #ques {
        min-height: 433px;
    }
    </style>
    <title>Welcome to iForums</title>
</head>

<body>
    <?php  include 'partials/_dbconnect.php';    ?>
    <?php  include 'partials/_header.php';    ?>

    <?php 
    $id = $_GET['threadid'];
          $sql = "SELECT * FROM `threads` WHERE thread_id = $id";   
          $result = mysqli_query($con,$sql);
          while($row = mysqli_fetch_assoc($result))
          {
              $title = $row['thread_title'];
              $desc = $row['thread_desc'];
              $thread_user_id = $row['thread_user_id'];
              //query the users table to find out the name of original poster
              $sql2 = "SELECT user_email FROM `users` WHERE sno = '$thread_user_id'";
              $result2 = mysqli_query($con,$sql2);
              $row2 = mysqli_fetch_assoc($result2);
              $posted_by = $row2['user_email'];

          }
    ?>

    <?php
                $showAlert = false;
                $method = $_SERVER['REQUEST_METHOD'];
                if($method=='POST')
                {
                    //Insert Into Comment DB
                    $comment = $_POST['comment'];
                    $comment = str_replace("<" ,"&lt;",$comment);
                    $comment = str_replace(">" , "&gt;",$comment);
                    $sno = $_POST['sno'];
                    $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment', '$id', '$sno', current_timestamp())";   
                    $result = mysqli_query($con,$sql);
                    $showAlert = true;
                    if($showAlert)
                    {
                        echo '
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>SUCCESS! </strong> Your Comment has been added!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>';
                    }
                }
         ?>


    <!-- Category container atarts here  -->
    <div class="container my-3">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo $title;   ?></h1>
            <p class="lead"> <?php echo $desc;   ?> </p>
            <hr class="my-4">
            <p>This is a peer-to-peer forum where people can share their knowledge. Spam, advertising, and self-promotion are not permitted on the forums. Copyright-infringing material should not be posted. Posting "offensive" posts, links, or photos is prohibited. Do not ask the same question twice. At all times, be respectful of other members. </p>
            <p>Posted By: <b><em><?php echo $posted_by; ?></em></b></p>
        </div>
    </div>

    <?php  
      if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
        {
         echo '<div class="container">
         <h1 class="py-2">Post a Comment</h1>
         <form action="'.$_SERVER["REQUEST_URI"]. '" method="POST">
             <div class="form-group">
                 <label for="exampleFormControlTextarea1">Type Your Comment</label>
                 <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                 <input type="hidden" name="sno" value="'. $_SESSION["sno"].'">
             </div>
             <button type="submit" class="btn btn-success">Post Comment</button>
         </form>
     </div>';
        }
            else   
            {
                echo ' <div class="container">
                <h1 class="py-2">Post a Comment</h1>
                <p class="lead">You are not currently logged in. To leave a comment, you must first log in.</p>
            </div>';
            }
    ?>
    <div class="container" id="ques">
        <h1 class="py-2">Discussions</h1>
        <?php 
          $id = $_GET['threadid'];
          $sql = "SELECT * FROM `comments` WHERE thread_id = $id";   
          $result = mysqli_query($con,$sql);
          $noresult = true;
          while($row = mysqli_fetch_assoc($result))
          {
            $noresult = false;
            $id = $row['comment_id'];
            $content = $row['comment_content'];
            $comment_time = $row['comment_time'];
            $thread_user_id = $row['comment_by'];

            $sql2 = "SELECT user_email FROM `users` WHERE sno = '$thread_user_id'";
            $result2 = mysqli_query($con,$sql2);
            $row2 = mysqli_fetch_assoc($result2);


         echo ' <div class="media my-3">
            <img src="img/user.png" width="44px" class="mr-3" alt="...">
            <div class="media-body">
            <p class="font-weight-bold my-0">'. $row2['user_email'] .' at '. $comment_time .' </p>
                '. $content .'
            </div>
        </div>  ';

    }
    if($noresult)
    {
        echo '<div class="jumbotron jumbotron-fluid">
        <div class="container">
          <p class="display-4">No Comments Found</p>
          <p class="lead">Be the first person to comment.</p>
        </div>
      </div>';
    }
    ?>
    </div>
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