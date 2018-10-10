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
<?foreach($news as $new): ?>
    <a href="post.php?fname=<?=$new['title']?>"><?=$new['title']?></a><br>
<?endforeach;?>
<a href="add.php">Добавить новость</a>
<a href="edit1.php">Редактировать</a>
<?if($login):?>
    <a href="logout.php">Выйти</a>
<?elseif(isset($_COOKIE['name']) && isset($_COOKIE['password'])):?>
    <a href="logout.php">Выйти</a>

<?else:?>
    <a href="login.php">Войти</a>
<?endif?>
<hr>
Подвал
</body>
</html>