<?
include 'config.php';
if($_SESSION['user']){
    url('index.php');
}
$connect = mysqli_connect('localhost','root','root','cardb');

if(isset($_POST['reg'])){
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = @$_SERVER['REMOTE_ADDR'];
    if(filter_var($client, FILTER_VALIDATE_IP)) $ip = $client;
    elseif(filter_var($forward, FILTER_VALIDATE_IP)) $ip = $forward;
    else $ip = $remote;
    $name = $_POST['Name'];
    $family = $_POST['Family'];
    $pass = $_POST['Pass'];
    $twopass = $_POST['TwoPass'];
    $login = $_POST['Login'];
    $city = $_POST['City'];
    $email = $_POST['Mail'];
    $phone = $_POST['Phone'];
    $regip = $ip;
    $lastip = $ip;

    if(empty($name)){
        $error = "Не введено имя";
    } 
    elseif(empty($family)){
        $error = "Не введена фамилия";
    }
    elseif(empty($login)){
        $error = "Не введен логин";
    }
    elseif(empty($email)){
        $error = "Не введена почта";
    }
    elseif(empty($phone)){
        $error = "Не введен телефон";
    }
    elseif(empty($city)){
        $error = "Не введен город";
    }
    elseif(empty($pass)){
        $error = "Не введен пароль";
    } elseif(empty($twopass)) {
        $error = "Не введено подтверждение пароля";
    } elseif($pass != $twopass){
        $error = "Пароли не совпадают";
    } else {
        $temp1 = mysqli_query($connect, "SELECT * FROM `account` WHERE `Login` = '$login'");
        $temp2 = mysqli_query($connect, "SELECT * FROM `account` WHERE `Email` = '$email'");
        $temp3 = mysqli_query($connect, "SELECT * FROM `account` WHERE `Phone` = '$phone'");
        if(mysqli_num_rows($temp1) === 0){
            if(mysqli_num_rows($temp2) === 0){
                if(mysqli_num_rows($temp3) === 0){
                    $password = md5(md5(trim($pass)));
                    $api_key = md5($login.$solt);
                    $error = "Пользователь зарегестрирован";
                    $n = mysqli_real_escape_string($connect, $name);
                    $f = mysqli_real_escape_string($connect, $family);
                    $l = mysqli_real_escape_string($connect, $login);
                    $p = mysqli_real_escape_string($connect, $password);
                    $ph = mysqli_real_escape_string($connect, $phone);
                    $em = mysqli_real_escape_string($connect, $email);
                    $c = mysqli_real_escape_string($connect, $city);
                    $ap = mysqli_real_escape_string($connect, $api_key);
                    $rip = mysqli_real_escape_string($connect, $regip);
                    $lip = mysqli_real_escape_string($connect, $lastip);
                    $_SESSION['user'] = $ap;
                    $_SESSION['lvl'] = 0;
                    if($us['LevelApi'] < 3) {
                        url('waitPage.php');
                    }
                    else {
                        url('index.php');
                    }
                    mysqli_query($connect, "INSERT INTO `account` (`id`, `Name`, `Family`, `Login`, `Password`, `Phone`, `Email`, `Type`, `City`, `Online`, `CountDrive`, `LevelApi`, `ApiKey`, `RegIP`, `LastIP`, `LastOnline`, `Warn`, `Ban`) 
                    VALUES (NULL, '$n', '$f', '$l', '$p', '$ph', '$em', 1, '$c', 0, 0, 0, '$ap', '$rip', '$lip', '0', 0, 0)");
                }
                else {
                    $error = "Пользователь с таким номером уже сущетсвует";
                }
            }
            else {
                $error = "Почта занята";
            }
        }
        else {
            $error = "Логин занят";
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
    <title>Регистрация</title>
</head>
<body>
    <div class="main-block">
        <div class="auth-block">
            <h1 style="margin-top: 10px;">Регистрация</h1>
            <form method="POST">
                <input type="text" id="login" placeholder="Имя" name="Name" style="padding-left: 10px;">
                <input type="text" id="password" placeholder="Фамилия" name="Family" style="padding-left: 10px;">
                <input type="text" id="password" placeholder="Логин" name="Login" style="padding-left: 10px;">
                <input type="password" id="password" placeholder="Пароль" name="Pass" style="padding-left: 10px;">
                <input type="password" id="password" placeholder="Повтор пароля" name="TwoPass" style="padding-left: 10px;">
                <input type="text" id="password" placeholder="Город" name="City" style="padding-left: 10px;">
                <input type="text" id="password" placeholder="Почта" name="Mail" style="padding-left: 10px;">
                <input type="text" id="password" placeholder="Телефон" name="Phone" style="padding-left: 10px;">
                <p class="m-a-warn" id="warn-text" style="margin-top: 10px; margin-bottom: 0px; margin-left: 0px;"><?echo $error;?></p>
                <button name="reg" style="margin-left: 5px;">Зарегистрироваться</button>
            </form>
        </div>
    </div>
</body>
</html>