<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Download/View Files</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="" name="Boom Solutions - Payment" />
    <meta content="" name="Ing. Luis Campos - campos.luis19@gmail.com" />

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

    <link rel="icon" type="image/x-icon" href="/src/admin/icon/favicon.png'">
</head>
<body>
    <?php 
        switch ($_GET['type']) {
            case '1':   $src = "/files/zelle";          break;
            case '2':   $src = "/files/paypal";         break;
            case '3':   $src = "/files/transference";   break;
            case '4':   $src = "/files/movil";          break;
            default:    $src = "/files/zelle";          break;
        }
    ?>
    <img src="<?php echo $src; ?>/<?php echo $_GET['img']; ?>">   
</body>
</html>