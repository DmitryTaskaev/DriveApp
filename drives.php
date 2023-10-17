<?
include 'config.php';

if($_SESSION['user'] == false){
    url('authorization.php');
}
if($_SESSION['lvl'] < 3){
    url('index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Поездки</title>
    <link rel="stylesheet" href="files/style/style.css">
    <script src="https://kit.fontawesome.com/08e5fde617.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
</head>
<body>
    <div class="main-cont">
        <?include('Modules/left-menu.php');?>
        <div class="content-cont">
            <div class="drives-content" id="content" style="flex-direction: column;">
                <div class="cont-drives">
                    <div class="cont-drives-header">
                        <h1 style="margin-left: 20px; margin-top: 20px;">Поездки</h1>
                    </div>
                    <div class="blocks-drives">

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<script type="text/javascript">
    async function GetDrives() {
        let url = '/api/<?echo $_SESSION['user']?>/GetAllDrives';
        let res = await fetch(url);
        let posts = await res.json();
        posts.forEach((post) => {
            document.querySelector('.blocks-drives').innerHTML +=`
            <div class="drive-block">
                <div class="drive-block-top">
                    <p class="block-drive-name">${post.NameDriver}</p>
                </div>
                <h1>${post.City} - ${post.City1}</h1>
                <div class="drive-info">
                    <p style=" font-size: 18px;">${post.Price} р.</p>
                    <p style="color: #BCC3CB; font-size: 18px; margin-left: 5px;">${post.Date} ${post.Time}</p>
                    <a href="" onclick="" style="margin-left: 10px;"><i class="fa-solid fa-pen"></i></a>
                </div>
            </div>
            `
        });
    }
    GetDrives();
    async function OpenModal(user){
        let url = '/api/3295c76acbf4caaed33c36b1b5fc2cb1/GetOnUserInfoByLogin/' + user;
        let res = await fetch(url);
        let posts = await res.json();
        let types;
        if(document.getElementById("myModal") != null){
            document.getElementById("myModal").remove();
        }
        if(posts.Type == 1){
            types = 'Пассажир';
        }
        if(posts.Type == 2){
            types = 'Водитель';
        }
        document.body.innerHTML += `
        <div id="myModal" class="modal">
            <div class="modal-content">
                <div class="m-header">
                    <div class="m-header-left">
                        <span class="close"><i class="fa-solid fa-arrow-left fa-xs"></i></span>
                        <p>${posts.Login}</p>
                    </div>
                    <div class="m-header-right">
                        <a href="">Заблокировать</a>
                    </div>
                </div>
                <div class="m-cont">
                    <div class="m-cont-top">
                    <div class="m-cont-top-left">
                        <p class="title-client-detail">Тип пользователя</p>
                        <h1 class="m-c-t-l-t">${types}</h1>
                    </div>
                </div>
                    <div class="m-cont-info">
                        <div class="m-client-detail">
                            <p class="title-client-detail">Детали клиента</p>
                            <table class="m-tables">
                                <tr>
                                    <td class="m-t-name"><p>Имя</p></td>
                                    <td><p>${posts.Name} ${posts.Famile}</p></td>
                                </tr>
                                <tr>
                                    <td class="m-t-name"><p>Почта</p></td>
                                    <td><p>${posts.Email}</p></td>
                                </tr>
                                <tr>
                                    <td class="m-t-name"><p>Телефон</p></td>
                                    <td><p>${posts.Phone}</p></td>
                                </tr>
                                <tr>
                                    <td class="m-t-name"><p>Поездки</p></td>
                                    <td><p>${posts.CountDrive}</p></td>
                                </tr>
                            </table>
                        </div>
                        <div class="m-client-detail">
                            <p class="title-client-detail">Детали безопасности</p>
                            <table class="m-tables">
                                <tr>
                                    <td class="m-t-name"><p>Reg-ip</p></td>
                                    <td><p>${posts. RegIP}</p></td>
                                </tr>
                                <tr>
                                    <td class="m-t-name"><p>Last-ip</p></td>
                                    <td><p>${posts.LastIP}</p></td>
                                </tr>
                                <tr>
                                    <td class="m-t-name"><p>Наказаний</p></td>
                                    <td><p>${posts.Warn}</p></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="m-footer">
                    <a href="">Посмотреть действия</a>
                </div>
            </div>
        </div>
        `
        var modal = document.getElementById('myModal');
        var btn = document.getElementById("myBtn");
        var span = document.getElementsByClassName("close")[0];
        modal.style.display = "block";

        span.onclick = function() {
            modal.style.display = "none";
        }
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
        posts = null;
    }
</script>
