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

    <?php 
    $id = $_GET['catid'];
          $sql = "SELECT * FROM `categories` WHERE category_id = $id";   
          $result = mysqli_query($con,$sql);
          while($row = mysqli_fetch_assoc($result))
          {
              $catname = $row['category_name'];
              $catdesc = $row['category_description'];

          }
    ?>

          <?php
                $showAlert = false;
                $method = $_SERVER['REQUEST_METHOD'];
                if($method=='POST')
                {
                    //Insert Into Thread DB
                    $th_title = $_POST['title'];
                    $th_desc = $_POST['desc'];

                    $th_title = str_replace("<" ,"&lt;",$th_title);
                    $th_title = str_replace(">" , "&gt;",$th_title);

                    $th_desc = str_replace("<" ,"&lt;",$th_desc);
                    $th_desc = str_replace(">" , "&gt;",$th_desc);

                    $sno = $_POST['sno'];
                    $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', '$id', '$sno', current_timestamp())";   
                    $result = mysqli_query($con,$sql);
                    $showAlert = true;
                    if($showAlert)
                    {
                        echo '
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>SUCCESS! </strong> Your thread has been added to the list! Please wait for a response from the community.
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
            <h1 class="display-4">Welcome to <?php echo $catname;   ?></h1>
            <p class="lead"> <?php echo $catdesc;   ?> </p>
            <hr class="my-4">
            <p>This is a peer-to-peer forum where people can share their knowledge. Spam, advertising, and self-promotion are not permitted on the forums. Copyright-infringing material should not be posted. Posting "offensive" posts, links, or photos is prohibited. Do not ask the same question twice. At all times, be respectful of other members.</p>
            <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
        </div>
    </div>

    <?php  
      if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
        {
         echo   '<div class="container">
                <h1 class="py-2">Start a Discussion</h1>

                <form action="'.$_SERVER["REQUEST_URI"].'" method="POST">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Problem Title</label>
                        <input type="text" class="form-control" id="title" name="title" aria-describedby="titleHelp">
                        <small id="emailHelp" class="form-text text-muted">Keep your title as short and crisp as
                            possible.</small>
                    </div>
                 <input type="hidden" name="sno" value="'. $_SESSION["sno"].'">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Elaborate Your Problem</label>
                        <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>';
        }
            else   
            {
                echo ' <div class="container">
                <h1 class="py-2">Start a Conversation</h1>
                <p class="lead">You are not currently logged in. To start a discussion, you must first log in.</p>
            </div>';
            }
    ?>
    <div class="container" id="ques">
        <h1 class="py-2">Browse Questions</h1>
        <?php 
    $id = $_GET['catid'];
          $sql = "SELECT * FROM `threads` WHERE thread_cat_id = $id";   
          $result = mysqli_query($con,$sql);
          $noresult = true;  //for if no question is available for this forum
          while($row = mysqli_fetch_assoc($result))
          {
            $noresult = false;
            $id = $row['thread_id'];
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $thread_time = $row['timestamp'];
            $thread_user_id = $row['thread_user_id'];
            $sql2 = "SELECT user_email FROM `users` WHERE sno = '$thread_user_id'";
            $result2 = mysqli_query($con,$sql2);
            $row2 = mysqli_fetch_assoc($result2);
            


         echo ' <div class="media my-3">
            <img src="img/user.png" width="44px" class="mr-3" alt="...">
            <div class="media-body">
                <p class="font-weight-bold my-0" style="color: #212529";> Asked By: '. $row2['user_email'] .' at '. $thread_time .' </p>
                <h5 class="mt-0"> <a style="color: #1e7e34" href="thread.php?threadid='. $id .'">'. $title  .'</a></h5>
                '. $desc .'
            </div>
        </div>  ';
    }
            if($noresult)
            {
                echo '<div class="jumbotron jumbotron-fluid">
                <div class="container">
                  <p class="display-4">No Threads Found</p>
                  <p class="lead">Be the first person to ask a question.</p>
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