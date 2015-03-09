<?php
$cacheId = uniqid(); 
file_put_contents('cache/Reports-'. $cacheId .'.html', $_POST['page']);
echo $cacheId;
?>