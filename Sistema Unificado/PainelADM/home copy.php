<?php
session_start();

//verifando se foi criando a sessão
if (!isset($_SESSION['adm'])) {

  //redirecionando para login
  header("location:login.php");
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php include('title_favicon.html') ?>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">

<body style="background-color: #0a0a0a">

    <?php include('nav_sup.html') ?>

    <div class="container-fluid" style="margin-top: 3vh;">

        <div class="row">

            <?php include('nav_lateral.html') ?>

            <!--Div do meio INÍCIO -->            
            <div class="corpo-painel col-md-10"
                style="background-image: url(img/fundo.png);background-size: cover;height: 97vh;">
                <!-- TABELA PARA CONSULTA -->
                <div class="table-responsive pt-5" style="min-width: 480px;">
                    <h2 style="text-align: center;">HISTÓRICO DE ACESSO</h2>
                    <br>

                    <div class="col-md-12" style="display: flex;width: 80%;margin: auto;">                        
                        <input class="form-control" id="myInput" type="text" placeholder="Buscar...">
                    </div>
                    <br>

                    <table class="table table-bordered table-striped">
                        <thead>
                            <style>
                            th, td { text-align: center; }
                            </style>

                            <th> # </th>
                            <th>NOME DE USUÁRIO</th>
                            <th>TIPO DE PERMISSÃO</th>
                            <th>DATA DE ACESSO</th>
                            <th>HORÁRIO DE ENTRADA</th>
                            <th>HORÁRIO DE SAÍDA</th>
                        </thead>

                        <!-- PHP PARA LISTA -->
                        <?php
                        include('conexao.php'); //INCLUINDO CONEXÃO COM O BANCO
                        $query = "SELECT  * FROM historico_acesso"; //QUERY PARA EXECUÇÃO 
                        $result = mysqli_query($conexao, $query);
                        $x = 1;                        
                        while ($linhas = $result->fetch_assoc()) { //COLOCANDO RESULTADOS NO ARRAY
                        ?>

                        <!-- LINHAS DA TABELA -->
                        <tbody id="myTable">
                            <tr>
                                <td><?= $x ?></td>
                                <td><?php echo $linhas['USERNAME'] ?></td>
                                <td><?php echo $linhas['TIPO_USER'] ?></td>
                                <td><?php echo $linhas['DATA_EN'] ?></td>
                                <td><?php echo $linhas['HORA_EN'] ?></td>
                                <td><?php echo $linhas['HORA_SA'] ?></td>
                            </tr>
                        <?php
                        $x++;
                        } //FINALIZANDO LAÇO
                        ?>

                        </tbody>
                    </table>
                </div>
            </div> <!--Div do meio FIM -->            

            <!-- BUSCA DA TABELA -->
            <script>
            $(document).ready(function() {

                $("#myInput").on("keyup", function() {

                    var value = $(this).val().toLowerCase();

                    $("#myTable tr").filter(function() {

                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)

                    });

                });

            });
            </script>

        </div>

    </div>

    <!-- jQuery , Popper.js , Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js">
    </script>

</body>

</html>