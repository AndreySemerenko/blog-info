<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Список новостей</title>
</head>
<body>
шапка
<hr>
<?php
foreach ($news as $new){ ?>
    <a href="post.php?fname=<?= $new['title']; ?>"><?= $new['title']; ?></a><br>
<?php } ?>
<a href="add.php">Добавить новость</a>
<a href="edit1.php">Редактировать</a>
<?php
$login = mylog();
if($login){
    echo  "<a href=\"logout.php\">Выйти</a>";
}
elseif (isset($_COOKIE['name']) && isset($_COOKIE['password'])){
    echo  "<a href=\"logout.php\">Выйти</a>";
}
else{
    echo "<a href=\"login.php\">Войти</a>";
}
?>
<hr>
Подвал
</body>
</html>