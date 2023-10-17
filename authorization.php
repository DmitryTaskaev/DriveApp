<?
include 'config.php';
if($_SESSION['user']){
    url('index.php');
}
$connect = mysqli_connect('localhost','root','root','cardb');

if(isset($_POST['Auth'])){
    $login = $_POST['login'];
    $password = $_POST['pass'];
    if(empty($login)){
        $error = "Не ввели логин";
    } elseif (empty($password)){
        $error = "Не ввели пароль";
    } else {
        $post = mysqli_query($connect, "SELECT * FROM `account` WHERE `Login` = '$login'");
        if(mysqli_num_rows($post) != 0){
            $us = mysqli_fetch_assoc($post);
            if(md5(md5($password)) === $us['Password']){
                $_SESSION['user'] = $us['ApiKey'];
                $_SESSION['lvl'] = $us['LevelApi'];
                if($us['LevelApi'] < 3) {
                    url('waitPage.php');
                }
                else {
                    url('index.php');
                }
            } else {
                $error = "Неверный пароль";
            }
        }
        else {
            $error = "Пользователь не найден";
        }
    
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="files/style/style.css">
    <script src="https://kit.fontawesome.com/08e5fde617.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
    <title>Авторизация</title>
</head>
<body>
    <div class="main-block">
        <div class="auth-block">
            <h1 style="margin-top: 10px;">Авторизация</h1>
            <form method="POST">
                <input type="text" id="login" placeholder="Логин" style="padding-left: 10px;" name="login">
                <input type="password" id="password" placeholder="Пароль" style="padding-left: 10px;" name="pass">
                <p class="m-a-warn" id="warn-text" style="margin-top: 10px; margin-bottom: 0px; margin-left: 0px; justify-content: center; align-items: center;"><? echo $error;?></p>
                <button name="Auth" style="margin-left: 5px;">Авторизоваться</button>
            </form>
            <a href="registration.php" style="margin-top: 0px;">Зарегистрироваться</a>
        </div>
    </div>
</body>
</html>