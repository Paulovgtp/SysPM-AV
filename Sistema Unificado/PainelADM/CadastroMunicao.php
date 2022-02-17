<?php
session_start();

//verifando se foi criando a sessão
if (!isset($_SESSION['adm'])) {

    header("location:login.php");
}

?>

<?php
//verificando se tever submit
if (isset($_POST['modelo'])) {

    //inclundo Conexao do Banco de Dados
    include('conexao.php');

    //Recebendo Valores do Formulário (Para Edição)
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $validade = $_POST['validade'];
    $quantidade = $_POST['quantidade'];
    $observacao = $_POST['obs'];
    $tipominu = $_POST['tipo'];

    //verificando o tipo de cadastro 
    if ($_POST['cadastro'] == 'gto') {
        //SQl para execultar no Banco (GTO)
        $query = "INSERT INTO municao_gto (id, marca, modelo, validade, quantidade, obs,tipo) VALUES (NULL, '$marca','$modelo','$validade','$quantidade','$observacao',' $tipominu')";
    } else {
        //SQl para execultar no Banco Ordinário()
        $query = "INSERT INTO municao_ord (id, marca, modelo, validade, quantidade, obs,tipo) VALUES (NULL,'$marca','$modelo','$validade','$quantidade','$observacao', ' $tipominu')";
    }
    $cadastrado = "show";
    //execultando $query
    $result = mysqli_query($conexao, $query);


    //vericando se trouxe houve algum cadastro
    if ($result > 0) {
        $_SESSION['sucesso'] = $cadastrado;
    } else {
        echo "<script>alert('Erro ao Realizar Cadastro')</script>";
    }
}

?>

<!DOCTYPE html>

<html lang="pt-br">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="">

    <meta name="author" content="">

    <?php include('title_favicon.html') ?>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">

<body>

    <?php include('nav_sup.html') ?>

    <div class="container-fluid" style="margin-top: 3vh;">

        <div class="row">

            <?php include('nav_lateral.html') ?>

            <div class="corpo-painel col-md-10" style="background-image: url(img/fundo.png);background-size: cover;height: 97vh;">
                <div class="col-md-12 table-responsive pt-3" style="min-width: 480px;">
                    <!--Div do meio-->
                    <main role="main" class="col-md-12 col-lg-12 pt-3 px-4" style="box-shadow: 1px 1px 1px 1.5px rgba(0, 0, 0, 0.589);">

                        <h3 class="page-header" id="titulo" style="text-align: center;">Cadastro de Munições</h3>
                        <hr>
                        <div id="main" class="container-fluid">
                            <?php

                            if (isset($_SESSION['sucesso'])) {
                            ?>

                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Cadastro Realizado com Sucesso!</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>


                            <?php
                            }
                            unset($_SESSION['sucesso'])
                            ?>

                            <form action="#" method="POST">
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label for="exampleInputEmail1">MARCA</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="marca" placeholder="Digite aqui..." required>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="exampleInputEmail1">MODELO</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="modelo" placeholder="Digite aqui..." required>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="exampleInputEmail1">QUANTIDADE</label>
                                        <input type="number" class="form-control" id="quantidade" name="quantidade" placeholder="Digite aqui..." required>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="exampleInputEmail1">VALIDADE</label>
                                        <input type="date" class="form-control" id="validade" name="validade" placeholder="Digite aqui..." required>
                                    </div>

                                    <div class="form-group col-md-3" style="text-align: center;  border-radius: 10px; height: 20px;">
                                        <br>
                                        <h6>Tipo de Cadastro</h6>
                                        <div class="form-check">
                                            <label>
                                                <input value="gto" type="radio" name="cadastro" required>
                                                GTO
                                            </label>


                                            <label>
                                                <input value="ordi" type="radio" style=" margin-left: 10px;" name="cadastro" required>
                                                ORDINÁRIO
                                            </label>
                                        </div>

                                    </div>
                                    

                                </div>
                                <br>
                                        <h6>Tipo de Munição</h6>
                                        <div class="form-check">
                                            <label>
                                                <input value="Química" type="radio" name="tipo" required>
                                                Química
                                            </label>


                                            <label>
                                                <input value="not quimica" type="radio" style=" margin-left: 10px;" name="tipo" required>
                                                Não quimica
                                            </label>
                                        </div>


                                <br>
                                <br>
                                <div class="row">

                                    <label for="exampleInputEmail1">OBSERVAÇÃO </label>


                                    <textarea class="form-control" name="obs" id="observacao" cols="30" rows="5" placeholder="Digite aqui..."></textarea>
                                </div>

                                <hr />

                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" id="salvar" class="btn btn-primary" style="box-shadow: 1px 1px 1px 1.5px rgba(0, 0, 0, 0.589);">Salvar</button>

                                        <a href="home.php"> <button style="box-shadow: 1px 1px 1px 1.5px rgba(0, 0, 0, 0.589); margin-left: 10px;" class="btn btn-danger"> Cancelar</button> </a>


                                    </div>
                                    <br>
                                    <br>
                                    <br>
                                </div>
                            </form>


                        </div>

                    </main>

                </div>
            </div>
        </div>

    </div>


    <!-- jQuery , Popper.js , Bootstrap JS -->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>

    <script>
        $(document).ready(function() {

            $('#myTable').DataTable();

        });
    </script>

    <script src="js/script.js"></script>


    <!-- Icons -->

    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>

    <script>
        feather.replace()
    </script>


    <div at-magnifier-wrapper="">

        <div class="at-theme-light">

            <div class="at-base notranslate" translate="no">

                <div class="Z1-AJ" style="top: 0px; left: 0px;">

                </div>

            </div>

        </div>

    </div>

</body>

</html>