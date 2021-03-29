<?php
$ch = curl_init();
require_once "simple_html_dom.php";
require_once "url_to_absolute.php";
?>
<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style type="text/css">
        img {
            width: 270px;
            height: 200px;
            padding: 15px;
            ;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Find Image</a>
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="my-3 mx-auto w-50">
            <div class="card text-left">
                <div class="card-header">Find Top Image from Google Search</div>
                <div class="card-body">
                    <form action="index.php" method="POST">
                        <div class="form-group">
                            <label for="">Input Keyword</label>
                            <input type="text" name="keyword" id="" class="form-control" placeholder="" aria-describedby="helpId">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <?php

    ?>

    <div class="container">
        <?php

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $keyword = htmlspecialchars($_POST['keyword']);
            $keyword = str_replace(" ", "+", $keyword);
            $url = "https://www.google.com/search?q=" . $keyword . "&hl=EN&source=lnms&tbm=isch";
            // echo $url;
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // set optional params
            curl_setopt($ch, CURLOPT_HEADER, false);

            $result = curl_exec($ch);

            curl_close($ch);
            $html = new simple_html_dom();
            $html->load($result);

            $isFirst = true;
            foreach ($html->find('img') as $element) {
                if ($isFirst) {
                    $isFirst = false;
                    continue;
                }
                echo "<img src=" . $element->src . ">";
            }
        }


        ?>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>