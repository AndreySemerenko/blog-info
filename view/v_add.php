<form method="post">
    Название: <br>
    <input type="text" name="title" value="<?php echo $title;?>"><br>
    Напишите текст статьи: <br>
    <textarea name="descr" cols="30" rows="10" ><?php echo $descr; ?></textarea><br>
    <input type="submit">
</form>

<?php echo $msg; ?>