<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="PT-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../node_modules/bulma/css/bulma.min.css">
    <link rel="stylesheet" href="../font awesome/css/all.min.css">
    <link rel="stylesheet" href="../style.css">
    <title><?php echo ucfirst($_SESSION['admin']); ?></title>
</head>
<body>
<?php
    include "../navbar.php";
    nav();

?>

<div class="app">
    

</div>

<?php
    include "../footer.php";
    rodape();
?>
</body>
</html>