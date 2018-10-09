<?php
$info = [];
$info[] = date("Y-m-d H:i:s");
$info[] = $_SERVER['REMOTE_ADDR'];
$info[] = $_SERVER['REQUEST_URI'];
$info[] = $_SERVER['HTTP_REFERER'];
$str = implode('@-@', $info);
file_put_contents('log.php', $str . "\r\n", FILE_APPEND);
$data = file("log.php");
echo "<table>";
for ($i = 0; $i < count($data); $i++) {
    echo "<tr>";
    $add = explode('@-@',rtrim($data[$i]));
    foreach ($add as $elem){
        echo "<td>$elem</td>";
    }
    echo "</tr>";
}

?>
<style>
    table,td{
        border: 1px solid black;
        padding: 10px;
    }
</style>
