<h3>Редактирование статей</h3>
<hr>
<?php
foreach ($list as $list_one){ ?>
    <a href="edit.php?fname=<?= $list_one['title']?>"><?=$list_one['title']?></a><br>
<?php } ?>