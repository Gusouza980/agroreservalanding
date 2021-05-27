<?php
header('Content-Type: text/html; charset=iso-8859-1');

// CONECTANDO AO BANCO

// $user = 'root';
// $pass = '';
// $host = 'localhost';
// $dbname = 'agroreserva';


$host = '172.31.9.38';
$port = 8081;
$user = 'agro_reserva';
$pass = 'fHP4ywO89XvVUeh2yFrp';
$dbname = 'agro_reserva';

if(isset($_POST["nome"])){
    
    try{
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
        $stmt = $pdo->prepare('INSERT INTO pre_cadastro (nome, nome_negocio, email, whatsapp, interesse, segmento, raca) VALUES(:nome, :nome_negocio, :email, :whatsapp, :interesse, :segmento, :raca)');
        $stmt->execute(array(
            ':nome' => $_POST["nome"],
            ':nome_negocio' => $_POST["nome_negocio"],
            ':email' => $_POST["email"],
            ':whatsapp' => $_POST["whatsapp"],
            ':interesse' => implode (", ", $_POST["interesses"]),
            ':segmento' => implode (", ", $_POST["segmentos"]),
            ':raca' => implode (", ", $_POST["racas"]),
        ));
        if($stmt->rowCount()){
            echo 'Sucesso';
        }else{
            echo 'Erro';
        }
    }catch(PDOException $e) {
        echo $e->getMessage();
    }
    
};


?>