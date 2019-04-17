<?php
    if(!empty($_GET['tid']) && !empty($_GET['product'])) {
        $GET = filter_var_array($_GET, FILTER_SANITIZE_STRING);

        $tid = $GET['tid'];
        $product = $GET['product'];
    } else {
        header('Location: index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h1>Thank you for purchsing<?php echo $product ?></h1>
        <hr>
        <p>Your transaction ID is <?php echo $tid ?></p>
        <p>Check your email for more information</p>
        <p><a href="index.php class="btn btn-light mt-2">Go back</a></p>
    </div>
    
</body>
</html>