<?php

$qwe = [
    ['backend', 'main', 'login', 'user', 'menu', 'footer'],
    ['backend', 'main'],
    ['backend', 'main', 'menu'],
    ['backend', 'main', 'footer'],
    ['backend', 'content', 'user'],
    ['backend', 'content', 'help'],
    ['backend', 'right', 'bar'],
    ['backend', 'snackbar'],
    ['frontend', 'panel'],
    ['frontend', 'panel', 'clear'],
    ['frontend', 'panel'],
    ['backend', 'main'],
];

function getar(&$res, $list, $i)
{
    $name = $list[$i];
    if ($i == (count($list) - 1)) {
        if (!isset($res[$name])) {
            $res[$name] = [];
        }

        return true;
    } else {
        if (!isset($res[$name])) {
            $res[$name] = [];
        }

        return getar($res[$name], $list, $i + 1);
    }
}

$asd = [];
foreach ($qwe as $key => $value) {
    getar($asd, $value, 0);
    // var_dump($asd);
}
var_dump($asd);
