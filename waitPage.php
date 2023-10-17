<?
include 'config.php';

if(isset($_POST['exit'])){
    session_destroy();
    url('authorization.php');
}

if($_SESSION['user'] == false){
    url('authorization.php');
}

if($_SESSION['lvl'] >= 3){
    url('index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="files/style/style.css">
    <script src="https://kit.fontawesome.com/08e5fde617.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
    <title>Главная страница</title>
</head>
<body>
    <div class="cont" style="    width: 100%; height: 700px; display: flex; justify-content: center; align-items: center; flex-direction: column;">
        <h1>Страница ожидания получения доступа</h1>
        <form action="" method="POST">
            <button name="exit">Выйти</button>
        </form>
    </div>
</body>
</html>
