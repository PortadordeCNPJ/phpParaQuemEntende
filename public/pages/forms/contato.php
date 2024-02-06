<?php
require "../../../bootstrap.php";

$validate = validate([
    'name' => 's',
    'email' => 'e',
]);


dd($validate->name);
