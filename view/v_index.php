<div class="content">
    <?foreach($news as $new): ?>
        <a href="post.php?fname=<?=$new['title'];?>"><?=$new['title']?></a><br>
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
</div>