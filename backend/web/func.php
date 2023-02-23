<?

function printr()
{
    $str = '';
    foreach (func_get_args() as $key => $value) {
        $str .= print_r($value, true);
    }
    echo "<pre>".$str."</pre>";
}

function vdump()
{
    echo "<pre>";
    foreach (func_get_args() as $key => $value) {
        var_dump($value);
    }
    echo "</pre>";
}

function dump($value, $depth = 10)
{
    \yii\helpers\VarDumper::dump($value, $depth = 10, $highlight = true);
}

function code($html)
{
    echo "<xmp>";
    echo $html;
    echo "</xmp>";
}
