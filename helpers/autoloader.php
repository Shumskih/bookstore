<?php
function autoLoader($name) {
    require_once $name.'.php';
}

spl_autoload_register('autoLoader');