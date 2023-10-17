<?
if(isset($_POST['exit'])){
    session_destroy();
    url('authorization.php');
}
?>
<div class="menu-cont" id="menu">
            <div class="menu-header">
                <div class="profile">
                    <img src="files/images/icons/profile.png" alt="" style="width: 45px;">
                    <p id="NamesUser"></p>
                </div>
            </div>
            <div class="menu-item">
                <a href="index.php" class="item" id="btn1">
                    <div class=""><br></div>
                    <i class="fa-solid fa-circle-info fa-lg"></i>
                    Информация
                </a>
                <a href="drives.php" class="item" id="btn2">
                    <div class=""><br></div>
                    <i class="fa-solid fa-car fa-lg"></i>
                    Поездки
                </a>
                <a href="users.php" class="item">
                    <div class=""><br></div>
                    <i class="fa-solid fa-user fa-lg"></i>
                    Пользователи
                </a>
                <a href="support.php" class="item">
                    <div class=""><br></div>
                    <i class="fa-solid fa-headset fa-lg"></i>
                    Поддержка
                </a>
                <?
                if($_SESSION['lvl'] >= 4){
                    echo '
                    <p class="adm-menu-txt">СТАРШИЕ МЕНЕДЖЕРЫ</p>
                    <a href="logs.php" class="item">
                        <div class=""><br></div>
                        <i class="fa-solid fa-circle-info fa-lg"></i>
                        Логи пользователей
                    </a>
                    ';
                }
                ?>
                <?
                if($_SESSION['lvl'] >= 5){
                    echo '
                    <p class="adm-menu-txt">АДМИНИСТИРОВАНИЕ</p>
                    <a href="apiFunction.php" class="item">
                        <div class=""><br></div>
                        <i class="fa-solid fa-circle-info fa-lg"></i>
                        Функции API
                    </a>
                    <a href="UsersAdmin.php" class="item">
                        <div class=""><br></div>
                        <i class="fa-solid fa-circle-info fa-lg"></i>
                        Пользователи
                    </a>
                    ';
                }
                ?>
            </div>
            <div class="menu-footer">
                <form action="" method="POST" style="width: 90%;">
                    <button class="logaut" name="exit" style="border: none;">Выйти</button>
                </form>
            </div>
        </div>
<script>
    jQuery(() => {
    $(".menu-item [href]").each(function () {
        if (this.href == window.location.href) {
            $(this).addClass("active");
        }
    });
});
async function LoadInfo(){
            let url = '/api/<?echo $_SESSION['user']?>/GetOnUserInfo';
            let res = await fetch(url);
            let posts = await res.json();
            if(posts != null){
                document.getElementById('NamesUser').innerHTML = posts.Name;
            }
        }
LoadInfo();
</script>