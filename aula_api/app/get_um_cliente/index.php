<?php
 //Este endpoint vai trazer todos os dados do arquivo data.php

 require_once __DIR__ . '/../../api/config.php';
 require_once __DIR__ . '/../../api/response.php';

 $data = require_once __DIR__ . '/../../api/data.php';


 echo Response::resposta(200,'success',['total_registros' => count($data)]);


 // verificar se na url veio alguma identificação do cliente

 if(isset($_GET['id'])){
    $id = $_GET['id'];


 } else{
    echo Response::resposta(400,'error','Necessário informar o id');
    exit;
 }

 if($id < 0 || $id > count($data) - 1){
    echo Response::resposta(400,'error','Cliente não encontrado');
    exit;
 } 
 
 echo Response::resposta(200,'success',$data[$id]);