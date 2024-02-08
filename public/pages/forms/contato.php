<?php

require "../../../bootstrap.php";

//Caso retornar o valor vazio dentro dos campos, cria uma flash message.
if(isEmpty()){
    flash('message','Preencha todos os campos');

   return redirect("contato");
}


$validate = validate([
    'name' => 's',
    'email' => 'e',
    'subject' => 's',
    'message' => 's',
]);



$data = [
    'quem' => $validade->email,
    'para' => 'guilhermestarfs@gmail.com',
    'mensagem' => $validate->message,
    'assunto' => $validate->subject,
];

if (send($data)){

    flash('message', 'Email Enviado com sucesso','success');

    return redirect("contato");
}