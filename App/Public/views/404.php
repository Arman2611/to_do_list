<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>To-Do List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.0/css/bootstrap.min.css" integrity="sha512-XWTTruHZEYJsxV3W/lSXG1n3Q39YIWOstqvmFsdNEEQfHoZ6vm6E9GK2OrF6DSJSpIbRbi+Nn0WDPID9O7xB2Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<header>
    <nav class="navbar navbar-dark bg-primary">
        <div class="container-md py-2 justify-content-spaced">
            <a class="navbar-brand" href="/">
                <?php
                    echo $GLOBALS['page-title'];
                ?>
            </a>
        </div>
    </nav>
</header>

<main>
    <div class="container-md py-5 px-2">
        <div class="alert alert-secondary text-center mb-5" role="alert">
            <?php
                echo $GLOBALS['page-not-found-message'];
            ?>
        </div>
    </div>
</main>

</body>
</html>