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
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="files/style/style.css">
    <script src="https://kit.fontawesome.com/08e5fde617.js" crossorigin="crossorigin"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
    <title>Главная страница</title>
</head>
<body>
    <div class="main-cont">
        <?require('Modules/left-menu.php');?>
        <div class="content-cont">
            <div class="content" id="content"><div class="cont-block">
                    <div class="block-top">
                        <p class="block-name">Пользователи</p>
                        <div class="top-icon">
                            <i class="fa-solid fa-user fa-2xl"></i>
                        </div>
                    </div>
                    <h1 id="CountUser">0</h1>
                    <div class="block-info">

                    </div>
                </div>
                <div class="cont-block">
                    <div class="block-top">
                        <p class="block-name">Успешных вопросов</p>
                        <div class="top-icon" style="background-color: #FEF6EB;">
                            <i class="fa-solid fa-headset fa-2xl" style="color: #F1BB35;"></i>
                        </div>
                    </div>
                    <h1 id="CountGoodReport">0</h1>
                    <div class="block-info">

                    </div>
                </div>
                <div class="cont-block">
                    <div class="block-top">
                        <p class="block-name">Нерешенных вопросов</p>
                        <div class="top-icon" style="background-color: #FBE1E2;">
                            <i class="fa-solid fa-headset fa-2xl" style="color: #E23839;"></i>
                        </div>
                    </div>
                    <h1 id="CountBadReport">0</h1>
                    <div class="block-info">

                    </div>
                </div>
                <div class="cont-block">
                    <div class="block-top">
                        <p class="block-name">Поездок</p>
                        <div class="top-icon" style="background-color: #E4F6DE;">
                            <i class="fa-solid fa-car fa-2xl" style="color: #4CC122;"></i>
                        </div>
                    </div>
                    <h1 id="CountDrives">0</h1>
                    <div class="block-info">

                    </div>
                </div></div>
        </div>
        <script>
    window.onload = async function() {
        async function LoadUsers(){
            let url = '/api/<?echo $_SESSION['user']?>/GetCountUser';
            let res = await fetch(url);
            let posts = await res.json();
            if(posts != null){
                document.getElementById('CountUser').innerHTML = posts.UserCount;
            }
        }
        LoadUsers();
        async function LoadGoodReport(){
            let url = '/api/<?echo $_SESSION['user']?>/GetCountGoodReports';
            let res = await fetch(url);
            let posts = await res.json();
            console.log(posts);
            if(posts != null){
                document.getElementById('CountGoodReport').innerHTML = posts.GoodReportCount;
            }
        }
        LoadGoodReport();
        async function LoadBadReport(){
            let url = '/api/<?echo $_SESSION['user']?>/GetCountBadReports';
            let res = await fetch(url);
            let posts = await res.json();
            if(posts != null){
                document.getElementById('CountBadReport').innerHTML = posts.BadReport;
            }
        }
        LoadBadReport();
        async function LoadDrives(){
            let url = '/api/<?echo $_SESSION['user']?>/GetCountDrives';
            let res = await fetch(url);
            let posts = await res.json();
            if(posts != null){
                document.getElementById('CountDrives').innerHTML = posts.drivesCount;
            }
        }
        LoadDrives();
    }
    
</script>

</body>
</html>
