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

                    <!-- Search Results -->

                    <!-- alter table threads add FULLTEXT(`thread_title`, `thread_desc`);  this query is taken from phpmyadmin to alter our table  -->

            <div class="container my-3">
                <h1 class="py-2">Search results for <em>"<?php echo $_GET['search']?>"</em></h1>

                <?php
                $noresults = true;
                $query = $_GET["search"];
                $sql = "SELECT * FROM threads WHERE match (thread_title, thread_desc) against ('$query')";
                $result = mysqli_query($con, $sql);
                while($row = mysqli_fetch_assoc($result))
                {
                    $title = $row['thread_title'];
                    $desc = $row['thread_desc'];
                    $thread_id = $row['thread_id'];
                    $url = "thread.php?threadid=". $thread_id;
                    $noresults = false;
                    echo '   <div class="result">
                             <h3><a href="'. $url .'" class="text-dark">'. $title .'</a></h3>
                            <p>'. $desc .'</p>
                            </div>';
                }

                if($noresults)
                {
                    echo '<div class="jumbotron jumbotron-fluid">
                                <div class="container">
                                <p class="display-4">No Results Found</p>
                                <p class="lead">Suggestions:</br>
                                <ul><li>Make sure that all of the words are spelled correctly.</li>
                                <li>Experiment with different keywords.</li>
                                <li>Try using more general terms.</li><ul></p>
                                </div>
                        </div>';
                }
            ?>
            </div>
            <?php  include 'partials/_footer.php';    ?>



            <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
            <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
                integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
                crossorigin="anonymous">
            </script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF"
                crossorigin="anonymous">
            </script>
</body>

</html>