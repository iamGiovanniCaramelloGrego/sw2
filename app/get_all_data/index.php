<?php
 //Este endpoint vai trazer todos os dados do arquivo data.php

 require_once __DIR__ . '/../../api/config.php';
 require_once __DIR__ . '/../../api/response.php';

 $data = require_once __DIR__ . '/../../api/data.php';


 echo Response::resposta(200,'sucsess',$data);