<?php
    header('Content-Type:application/json');
    include 'conexao.php';

    $metodo = $_SERVER['REQUEST_METHOD'];
    $url = $_SERVER['REQUEST_URI'];

    $path = parse_url($url, PHP_URL_PATH);
    $path = trim($path,'/');
    $pathparts = explode('/',$path);

    //CRIANDO AS VARIAVEIS PARA CADA PARTE DA URL

    $primeira = isset($pathparts[0]) ? $pathparts[0] : ''; 
    $segunda = isset($pathparts[1]) ? $pathparts[1] : '';
    $terceira = isset($pathparts[2]) ? $pathparts[2] : '';
    $quarta = isset($pathparts[3]) ? $pathparts[3] : '';

    //MONTANDO A RESPOSTA DA API EM JSON

    $response = [
        'metodo' => $metodo,
        'primeiraParte' => $primeiraParte,
        'segundaParte' => $segundaParte,
        'terceiraParte' => $terceiraParte,
        'quartaParte' => $quartaParte,
    ];

    //SELEÇÃO DO MÉTODO

    switch($metodo){
        case 'GET':
            // lógica para GET
            if($terceiraParte == 'alunos' && $quartaParte ==''){
                lista_alunos();
            }
            elseif($terceiraParte == 'alunos' && $quartaParte !=''){
                lista_um_aluno($quartaParte);
            }
            elseif($terceiraParte == 'cursos' && $quartaParte == ''){
                lista_cursos();
                // echo json_encode(
                //     [
                //         'mensagem' => 'LISTA TODOS OS CURSOS!'
                //     ]
                // );
            }
            elseif($terceiraParte == 'cursos' && $quartaParte !=''){
                lista_um_curso($quartaParte);
                // echo json_encode(
                //     [
                //         'mensagem' => 'LISTA DE UM CURSO!',
                //         'id_curso' => $quarta
                //     ]
                // );
            }
            
            break;
        case 'POST':
            if ($terceiraParte == 'alunos'){
                insere_aluno();
            }
            elseif ($terceiraParte == 'cursos'){
                insere_curso();
            }
            //lógica para POST
            break;
        case 'PUT':
            if($terceiraParte == 'alunos'){
                atualiza_aluno();
            }
            elseif($terceiraParte == 'cursos'){
                atualiza_curso();
            }
    
            //lógica para PUT
            break;
        case 'DELETE':
            if($terceiraParte == 'alunos'){
                remove_aluno();
            }
            elseif($terceiraParte == 'cursos'){
                remove_cursos();
            }
            //lógica para o DELETE
            break;
        default:
            echo json_encode(
                [
                    'mensagem' => 'Método não permitido!'
                ]
            );
            break;
    }



    function lista_alunos(){
        global $conexao;
        $resultado = $conexao->query("SELECT * FROM alunos");
        $alunos = $resultado->fetch_all(MYSQLI_ASSOC);
        echo json_encode(
            [
                'mensagem' => 'LISTA TODOS OS ALUNOS!',
                'dados' => $alunos
            ]
        );
    }

    function lista_um_aluno($quartaParte){
        global $conexao;
        $stmt = $conexao->prepare("SELECT * FROM alunos WHERE id = ?");
        $stmt->bind_param('i',$quartaParte);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $aluno = $resultado->fetch_assoc();

        if($aluno == ''){
            echo json_encode(
                [
                    'mensagem' => 'NÃO FOI ENCONTRADO O ALUNO ACIMA!'
                ]
            );
        }else{
            echo json_encode(
                [
                    'mensagem' => 'LISTA DE UM ALUNO!',
                    'dados_aluno' => $aluno
                ]
            );
        }

        
    }

    function lista_cursos(){
        global $conexao;
        $resultado = $conexao->query("SELECT * FROM cursos");
        $cursos = $resultado->fetch_all(MYSQLI_ASSOC);
        echo json_encode(
            [
                'mensagem' => 'LISTA TODOS OS CURSOS!',
                'dados' => $cursos
            ]
        );
    }

    function lista_um_curso($quartaParte){
        global $conexao;
        $stmt = $conexao->prepare("SELECT * FROM cursos WHERE id_curso = ?");
        $stmt->bind_param('i',$quartaParte);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $curso = $resultado->fetch_assoc();

        if($curso == ''){
            echo json_encode(
                [
                    'mensagem' => 'NÃO FOI ENCONTRADO O CURSO ACIMA!'
                ]
            );
        }else{
            echo json_encode(
                [
                    'mensagem' => 'LISTA DE UM CURSO!',
                    'dados_curso' => $curso
                ]
            );
        }

        
    }
    function insere_curso(){
        global $conexao;
        $input = json_decode(file_get_contents('php://input'), true);
        $nome_curso = $input['nome_curso'];
    }


?>