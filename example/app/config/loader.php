<?php

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerDirs(
    [
        $config->application->controllersDir,
        $config->application->modelsDir
    ]
)->register();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerNamespaces([
    'Prepare\Models'      => $config->application->modelsDir,
    'Prepare\Controllers' => $config->application->controllersDir,
    'Prepare\Forms'       => $config->application->formsDir,
    'Prepare\Roles'       => $config->application->formsDir,
    'Prepare'             => $config->application->libraryDir
]);
$loader->register();


if (!function_exists('print_arr')) {
    function print_arr($var, $return = false, $special = true)
    {
        $type = gettype($var);

        $out = print_r($var, true);
        if ($special) {
            $out = htmlspecialchars($out);
        }
        $out = str_replace(' ', '&nbsp;', $out);
        if ($type == 'boolean') {
            $content = $var ? 'true' : 'false';
        } else {
            $content = nl2br($out);
        }


        $count = '';
        if ($type == 'array') {
            $count = ' (' . count($var) . ' items)';
        }

        $out = '<div style="
     border:2px inset #666;
     background:black;
     font-family:monospace;
     font-size:12px;
     color:#6F6;
     text-align:left;
     margin:20px;
     word-break: break-word;
     padding:16px">
       <span style="color: #F66">(' . $type . ')</span>' . $count . ' ' . $content . '</div><br /><br />';

        if (!$return)
            echo $out;
        else
            return $out;
    }
}

function print_die($var, $return = false, $special = true)
{
    print_arr($var, $return, $special);
    $info = debug_backtrace();
    print_arr("File: {$info[0]['file']} Line: {$info[0]['line']}");
    die ();

}