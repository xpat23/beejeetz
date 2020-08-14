<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Task manager</title>

    <!-- Bootstrap core CSS -->
    <link href="<?=str_replace("index.php","",$_SERVER['SCRIPT_NAME'])?>css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#">Task Manager</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Задачи <span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
    </nav>
</header>

<main role="main">
<br>
<br>
<br>
    <div class="row">
        <div class="col-md-12">
            <?php include $content ?>
        </div>
    </div>

    <!-- FOOTER -->
    <footer class="container">
    </footer>
</main>
</html>


