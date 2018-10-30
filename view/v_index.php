<div id="content">
    <?foreach($news as $new): ?>
        <a href="/post?fname=<?=$new['title'];?>"><?=$new['title']?></a><br>
    <?endforeach;?>
    <a href="/add">Добавить новость</a>
    <a href="/edit1">Редактировать</a>
    <?if($login):?>
        <a href="/logout">Выйти</a>
    <?elseif(isset($_COOKIE['name']) && isset($_COOKIE['password'])):?>
        <a href="/logout">Выйти</a>

    <?else:?>
        <a href="/login">Войти</a>
    <?endif?>
</div>