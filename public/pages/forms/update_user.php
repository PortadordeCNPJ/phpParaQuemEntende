<?php


require "../../../bootstrap.php";


$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

//Caso retornar o valor vazio dentro dos campos, cria uma flash message.
if(isEmpty()){
    flash('message','Preencha todos os campos');

   return redirect("edit_user&id=". $id);
}


$validate = validate([
    'name' => 's',
    'lastname' => 's',
    'email' => 'e',
]);


$atualizado = update('users', $validate,['id',$id]);


if($atualizado){
    flash('message','Atualizado com sucesso', 'success');

    return redirect("edit_user&id=". $id);
}

flash('messafe','Erro ao atualizar o usuário');

    redirect("edit_user&id=". $id);