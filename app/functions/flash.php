<?php

function flash($key, $message, $type = 'danger')
{
    if(!isset($_SESSION['flash'][$key])){
        $_SESSION['flash'][$key] = '<span class="alert alert-'. $type .'">' . $message . '</span>';
    }
}

function get($key)
{
    //Quando retornar vazio o get vai entrar dentro do if, vai criar uma seção dentro da váriavel $message
    //Assim que criada a seção e posta na tela, a seção vai ser quebrada antes de dar refresh na página
    if(isset($_SESSION['flash'][$key])){
        $message = $_SESSION['flash'][$key];

        unset($_SESSION['flash'][$key]);

        return $message ?? '';
    }
}