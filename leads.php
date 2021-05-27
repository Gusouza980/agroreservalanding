<?php

if(isset($_POST["login"]) && isset($_POST["senha"])){
    
    if($_POST["login"] == "agroleads" && $_POST["senha"] == "AdminAgroLeads123@"){
        $user = 'root';
        $pass = '';
        $host = 'localhost';
        $dbname = 'agroreserva';

            
        try{
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
            $query = 'SELECT * FROM pre_cadastro';

            $items = array();
            // $result = $pdo->query($query);

            foreach($pdo->query($query, PDO::FETCH_ASSOC) as $row){
                $items[] = $row;
            }

            //Define the filename with current date
            $fileName = "leads-".date('d-m-Y-H-i-s').".xls";

            //Set header information to export data in excel format
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment; filename='.$fileName);

            //Set variable to false for heading
            $heading = false;

            
            //Add the MySQL table data to excel file
            if(!empty($items)) {
                foreach($items as $item) {
                    if(!$heading) {
                        echo implode("\t", array_keys($item)) . "\n";
                        $heading = true;
                    }
                    echo implode("\t", array_values($item)) . "\n";
                }
            }
            exit();

        }catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
}

?>


<!doctype html>
<html lang="en">
  <head>
    <title>Agroreserva - Leads</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <div class="container-fluid" style="background-color:black;">
        <div class="row align-items-center justify-content-center" style="height: 100vh;">
            <div class="col-10 col-md-8 col-lg-3 px-5 py-5" style="background-color: white; border-radius: 15px;">
                <h4>Insira as credenciais</h4>
                <hr>
                <form action="#" method="post">
                    <div class="form-group">
                        <label for="login">Login</label>
                        <input type="text" class="form-control" name="login" id="login" aria-describedby="helpId" required>
                    </div>
                    <div class="form-group">
                        <label for="senha">Senha</label>
                        <input type="password" class="form-control" name="senha" id="senha" aria-describedby="helpId" required>
                    </div>
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-primary">Baixar</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>