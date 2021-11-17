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
            #ques{
                min-height: 433px;
            }
        </style>
    <title>Welcome to iForums</title>
</head>

<body>
    <?php  include 'partials/_dbconnect.php';    ?>
    <?php  include 'partials/_header.php';    ?>

    <!--Carousel code From Bootstrap-->
    <!-- slider  -->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://source.unsplash.com/2400x700/?apple,code" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/2400x700/?programmers,microsoft" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/2400x700/?coding,programmers" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-target="#carouselExampleIndicators" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-target="#carouselExampleIndicators" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </button>
    </div>

    <!-- Category container atarts here  -->

    <div class="container my-3" id="ques">
        <h2 class="text-center my-3">iForums - Browse Categories</h2>
        <div class="row">

            <!-- Fetch all the categories  -->
             <!-- Use The Loop to iterate throgh categories  -->
            <?php  
            $sql = "SELECT * FROM `categories`";   
            $result = mysqli_query($con,$sql);
            while($row = mysqli_fetch_assoc($result))
            {
                // echo $row['category_id'];
                // echo $row['category_name'];
                $id = $row['category_id'];
                $cat = $row['category_name'];
                $desc = $row['category_description'];

                echo '  <div class="col-md-4 my-2">
                <div class="card" style="width: 18rem;">
                    <img src="https://source.unsplash.com/500x400/?' .$cat. ',coding" class="card-img-top" alt="Image for this Category">
                    <div class="card-body">
                        <h5 class="card-title"><a style="color:#343a40" href="threadlist.php?catid='. $id. '">' .$cat. '</a></h5>
                        <p class="card-text">' .substr($desc,0,90). '...</p>
                        <a href="threadlist.php?catid='. $id. '" class="btn btn-success">View Threads</a>
                    </div>
                </div>
            </div>';    
            }
        ?>
    

        </div>
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