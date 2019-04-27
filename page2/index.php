<?php
session_start();

if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] == false) {
    header("Location: ../index.php");
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>JH · Billede album</title>
    <link rel="icon" href="images/favicon.ico">

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/album/">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="css/lightbox.css" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">


    <style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    .card-image{
        height: 130px;
        overflow: hidden;
        display: flex;
        align-items: center;
    }

    .btn-group{
        width: 100%;

    }
    .card-body{
        padding: 0px;
        overflow: hidden;
        float: left;
        width: 100%;
    }
    .btn.btn-primary.my-1{
        padding-top: 2px;
        padding-bottom: 2px;
        padding-left: 2px;
        padding-right: 0px;
    }
    .btn.btn-primary.my-2{
        padding-top: 4px;
        padding-bottom: 5px;
    }
    .left{
        text-align: center;
    }
    .btn.btn-sm.btn-outline-danger.confirm{
        margin-bottom: 8px;
    }

    .btn.btn-sm.btn-outline-secondary.downloadPictures{
        margin-bottom: 8px;
    }

    .navbar-nav {
        display: flex;
        align-items: center;
        flex-direction: row;
        justify-content: flex-end;
    }
    .navbar-nav li {
        color: white;
    }
    .navbar-nav li:not(:last-of-type) {
        margin-right: 15px;
    }

    .post-form .form-flex {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .post-form .form-flex input {
        flex: 0 1 auto;
        max-width: none;
        min-width: 0;
        width: auto;
    }
    .post-form .form-flex button {
        margin: 0 10px;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }
    </style>
    <!-- Custom styles for this template -->
</head>
<body>
    <header>
        <div class="navbar navbar-dark bg-dark shadow-sm">
            <div class="container d-flex justify-content-between">
                <a href="#" class="navbar-brand d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="mr-2" viewBox="0 0 24 24" focusable="false"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                    <strong>Album</strong>
                </a>
                <ul class="navbar-nav">
                    <li>Logged in as Jan</li>
                    <li class="nav-item text-nowrap">
                        <a class="nav-link sign-out" href="signOut.php">Sign out</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <main role="main">

        <section class="jumbotron text-center">
            <div class="container">
                <h1 class="jumbotron-heading"><code>JH.</code> Billede album</h1>
                <p class="lead text-muted">Tilføj nogle oplysninger om nedenstående album, forfatteren eller en anden baggrundsramme. Gør det et par sætninger længe, ​​så folk kan hente nogle informative godbidder. Link dem derefter til nogle sociale netværkssites eller kontaktoplysninger</p>
                <p>
                    <?php
                    $errors = array(
                        1 => "File(s) is not an image.",
                        2 => "Sorry, one or more files already exists.",
                        3 => "Sorry, one or more of your files are too large.",
                        4 => "Sorry, only JPG, JPEG, PNG, PDF & GIF files are allowed.",
                        5 => "Sorry, there was an error uploading your file(s).",
                    );

                    $error_id = isset($_GET['err']) ? $_GET['err'] : 0;

                    if ($error_id != 0 && array_key_exists($error_id, $errors)): ?>
                    <div class="alert alert-warning" role="alert">
                        <strong>Error!</strong>
                        <?php echo $errors[$error_id]; ?>

                    </div>
                <?php endif;
                ?>

                <!--<a href="#" class="btn btn-primary my-2">Upload billede</a>
                <a href="#" class="btn btn-secondary my-2">download alle billeder</a>-->

                <form method='post' action="uploadMultiple.php" enctype='multipart/form-data' class="post-form">
                    <div class="form-flex">
                        <input type="file" name="file[]" id="file" multiple class="btn btn-primary my-1">
                        <button type='submit' name='submit' class="btn btn-primary my-2">Upload</button>
                    </div>
                </form>
                <hr>
                <div class="left">
                    <p>Yderligere funktioner:
                    </div>
                    <a name="button" href="deleteMultiple.php" class="btn btn-sm btn-outline-danger confirm"><i class="fas fa-trash-alt"></i> Slet alle billeder</a>
                    <a name="button" href="downloadMultiple.php" class="btn btn-sm btn-outline-secondary downloadPictures"><i class="fas fa-download"></i> Download alle billeder</a></p>
                </p>

            </div>
        </section>

        <div class="album py-5 bg-light">
            <div class="container">


                <div class="row">
                    <?php

                    $dirname = "uploads/";
                    $images = glob($dirname . "*");

                    foreach($images as $image): ?>
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <div class="card-image">
                                <img src="<?php echo $image ?>" style="width: 100%" />
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="delete.php?file=<?php echo $image ?>" name="button" class="btn btn-sm btn-outline-secondary confirmDeleteOne"><i class="far fa-trash-alt"></i> Slet </a>

                                        <a name="button" href="download.php?file=<?php echo $image ?>" class="btn btn-sm btn-outline-secondary"><i class="fas fa-file-download"></i> Download </a>

                                        <a href="<?php echo $image ?>" name="button" data-lightbox="imageSet" class="btn btn-sm btn-outline-secondary"><i class="fas fa-eye"></i> View </a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach;

                ?>

            </div>


        </div>
    </div>
</div>
<script type="text/javascript" src="js/lightbox-plus-jquery.js"></script>


</main>

<footer class="text-muted">
    <div class="container">
        <p style="text-align: center; padding-top: 10px;">
            <a href="#"><i class="far fa-arrow-alt-circle-up"></i> Tilbage til top</a>
        </p>
    </div>
</footer>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/script>')</script><script src="js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
lightbox.option({
    'imageFadeDuration': 300,
    'fadeDuration': 300,
    'resizeDuration': 300,
})
</script>
<script>
$(function() {
    $('.confirm').click(function(e) {
        e.preventDefault();
        if (window.confirm("Dette sletter alle dine billeder!")) {
            location.href = this.href;
        }
    });
})
</script>
<script>
$(function() {
    $('.confirmDeleteOne').click(function(e) {
        e.preventDefault();
        if (window.confirm("Dette sletter dit billede!")) {
            location.href = this.href;
        }
    });
})
</script>
</body>
</html>
