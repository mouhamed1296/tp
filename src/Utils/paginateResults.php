<?php

$numUsers = count($users);
$limit = 5;
$numPages = ceil($numUsers/$limit);
/*  var_dump($numPages);
exit; */
$page = 1;
if(isset($params['page'])) {
    $page = (int) $params['page'];
}
$start = ($page-1)*$limit;
$nextPage = (float) $page + 1;
$prevPage = (float) $page - 1;
/*  var_dump($nextPage);
var_dump($numPages);
exit; */