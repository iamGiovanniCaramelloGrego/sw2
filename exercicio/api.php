<?php
    header('Content-Type:application/json');
    include 'conexao.php';

    $metodo = $_SERVER['REQUEST_METHOD'];

    echo json_encode($metodo);

    $url = $_SERVER['REQUEST_URI'];

    //echo json_encode($url)


    $path = parse_url($url, PHP_URL_PATH);
    $path = trim($path, '/');

    //echo json_encode($path)

    $pathparts = explode('/', $path);

    echo json_encode($pathparts[1]);

    //criando as variaveis para cada parte de url

    $primeira = isset($pathparts[0]) ? $pathparts[0] : '';
    $segunda = isset($pathparts[1]) ? $pathparts[1] : '';
    $terceira = isset($pathparts[2]) ? $pathparts[2] : '';
    $quarta = isset($pathparts[3]) ? $pathparts[3] : '';


    //montando a respostas da api em jspm

    $response = [
        'metodo' => $metodo,
        'primeiraParte' => $primeira,
        'segundaParte' => $segunda,
        'terceiraParte' => $terceira,
        'quartaParte' => $quarta,
    ];

    //mostrando a reposta
    //echo json_encode($response);

    //seleção do metodo

    switch($metodo){
        case 'GET':
            //LOGICA PRA GET
            break;
            case 'POST':
                //LOGICA POST
                break;
                case 'PUT':
                    //LOGICA PRA PUT
                    break;
                    case 'DELETE':
                        //LOGICA DELETE
                        break;
                    default:
                        echo json_encode(
                            [
                                'mensagem' => 'métodp não permitido'
                            ]
                            );
                
        
    }
?>  