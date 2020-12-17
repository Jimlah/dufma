<?php

use App\Core\Http\Request;
use App\Core\Http\Session;

function get_notification()
{
    $data = Session::getAndRemove('msg') ?? '';
    return $data;
}




function dnd($data, $d = true)
{
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    if($d) die();
}




function get_alert(): ?string
{
    $data = Session::getAndRemove('msg');
    if (!$data) {
        return null;
    }

    [$message, $type] = $data;

    $classes = array(
        'alert',
        'alert-dismissible',
        'text-white',
        'border-0',
        'fade',
        'show'
    );

    $sub_classes = array(
        'error' => ['bg-danger', 'alert-danger'],
        'alert' => ['bg-success', 'alert-success']
    );

    $main_classes = $sub_classes[$type];
    $merged_classes = array_merge($classes, $main_classes);
    $classlist = implode(' ', $merged_classes);

    $span = h('span', ['aria-hidden' => 'true'], '&times;');

    $btn = h('button', [
        'class' => 'close',
        'data-dismiss' => 'alert',
        'aria-label' => 'close'
    ], $span);



    $par = '';
    if ($type == 'error') {
        foreach ($message as $key) {
            $par .= h('div', ['class' => $classlist], [$btn, $key[0]]);
        }
        echo $par;
        return '';
    }

    $parent = h('div', ['class' => $classlist], [$btn, $message]);
    echo $parent;
    return '';
}
