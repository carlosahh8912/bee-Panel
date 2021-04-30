<?php
    $uri = explode('/',$_SERVER['HTTP_REFERER']);

    $slug = $uri[3] != '' ? $uri[3] : 'home' ;

    echo create_menu($data, $slug);