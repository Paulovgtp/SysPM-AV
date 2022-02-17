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

    <meta name="description" content="">

    <meta name="author" content="">

    <?php include('title_favicon.html')?>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">



    <!--Jquery-->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
    <script src="jquery.maskMoney.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1..js"> </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>





    </script>

    <?php
  if (isset($_SESSION['cadastrato'])) {
  ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert" style="width: 50%;">
        Edição Realizada Com Sucesso!!!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <?php
    unset($_SESSION['cadastrato']);
  }
  if (isset($_SESSION['nao_cadastrato'])) {
  ?>

    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="width: 50%;">
        Erro ao realizar edição tente novamente....
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php
    unset($_SESSION['nao_cadastrato']);
  }

  ?>


<body style="background-color: #0a0a0a">

    <?php include('nav_sup.html') ?>

    <div class="container-fluid" style="margin-top: 3vh;">

        <div class="row">

            <?php include('nav_lateral.html')?>

            <div class="corpo-painel col-md-10"
                style="background-image: url(img/fundo.png);background-size: cover;height: 97vh;">
                <!-- TABELA PARA CONSULTA -->
                <div class="table-responsive pt-3" style="min-width: 480px;">

                    <h2 style="text-align: center;"><u>Consutar Equipamentos - GTO</u></h2>

                    <br>

                    <div class="col-md-12" style="display: flex;width: 100%;margin: 0 0 5px;padding-left: 9%;">
                        <p style="margin-right: 10px; margin-top:7px;">Faça sua consulta: </p>
                        <input style="width: 80%; box-shadow: 1,5px 1,5px 1,5px 1,5px black;" class="form-control"
                            id="myInput" type="text" placeholder="Buscar...">
                    </div>

                    <table class="table table-bordered table-striped">

                        <thead>
                            <style>
                            th,
                            td {
                                text-align: center;
                            }
                            </style>
                            <th> # </th>
                            <th>TIPO</th>
                            <th>MARCA</th>
                            <th>MODELO</th>
                            <th>Nº SÉRIE</th>
                            <th>PRATIMÔNIO</th>
                            <th>LOCALIZAÇÃO</th>
                            <th>SITUAÇÃO</th>
                            <th>CAUTELA</th>
                            <th>VALIDADE</th>
                            <th>NÍVEL</th>
                            <th>TAMANHO</th>
                            <th>FABRICAÇÃO</th>
                            <th>OBS</th>
                            <th>AÇÃO</th>

                        </thead>




                        <!--PHP PARA LISTA OS LISTA DE ESPERA-->
                        <?php
          //incluindo conexão com banco
          include('conexao.php');

          //query para execução dos dados
          $query = "SELECT  * FROM  epi_gto";


          //executando query
          $result = mysqli_query($conexao, $query);

          //variável auxiliar
          $x = 1;

          //colocando resultados da linha em array
          while ($linhas = $result->fetch_assoc()) {

          ?>

                        <!--Linhas da Tabela-->
                        <tbody id="myTable">
                            <tr>
                                <td><?= $x ?></td>
                                <td><?php echo $linhas['tipo'] ?></td>
                                <td><?php echo $linhas['marca'] ?></td>
                                <td><?php echo $linhas['modelo'] ?></td>
                                <td><?php echo $linhas['n_serie'] ?></td>
                                <td><?php echo $linhas['patrimonio'] ?></td>
                                <td><?php echo $linhas['localizacao'] ?></td>
                                <td><?php echo $linhas['situacao'] ?></td>
                                <td><?php echo $linhas['cautela'] ?></td>
                                <td><?php  $dat01 = date("d/m/Y", strtotime($linhas['validade']));
                          echo  $dat01; ?></td>
                                <td><?php echo $linhas['nivel'] ?></td>
                                <td><?php echo $linhas['tamanho'] ?></td>
                                <td><?php  $date02 = date("d/m/Y", strtotime($linhas['fabricacao']));
                       echo  $date02;?></td>

                                <td><Button class="btn btn-outline-danger obs" id="<?= $linhas['obs'] ?>">OBS</Button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-outline-info" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal" data-bs-whatever="<?= $linhas['tipo'] ?>"
                                        data-bs-whatever2="<?= $linhas['modelo'] ?>"
                                        data-bs-whatever3="<?= $linhas['marca'] ?>"
                                        data-bs-whatever4="<?= $linhas['n_serie'] ?>"
                                        data-bs-whatever5="<?= $linhas['patrimonio'] ?>"
                                        data-bs-whatever6="<?= $linhas['localizacao'] ?>"
                                        data-bs-whatever7="<?= $linhas['situacao'] ?>"
                                        data-bs-whatever8="<?= $linhas['cautela'] ?>" data-bs-whatever9="<?php 
                          $date1 = date("d-m-Y", strtotime($linhas['validade']));
                          echo  $date1;
                       ?> " data-bs-whatever10="<?php
                       //convertento data para formato brasileiro
                       $date2 = date("d-m-Y", strtotime($linhas['fabricacao']));
                       echo  $date2;
                        ?> " data-bs-whatever11="<?= $linhas['nivel'] ?> "
                                        data-bs-whatever12="<?= $linhas['tamanho'] ?> "
                                        data-bs-whatever13="<?= $linhas['obs'] ?> "
                                        data-bs-whatever14="<?= $linhas['N'] ?> ">Editar</button>
                                </td>


                            </tr>

                            <?php


            //incrementando contador
            $x++;
            //finalizando o laço
          }
            ?>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>

    <!-- Salvar dados dos editados no banco -->


    <!-- alert de obervações-->
    <script>
    //monstar obs
    $(document).ready(function() {
        $(document).on('click', '.obs', function() {
            var user_id = $(this).attr("id");
            //verificar sem valor na 


            if (user_id != "") {
                alert(user_id);

            } else {
                alert("Armamento sem Observação!!!")
            }



        });
    });
    </script>

    <!-- Modal para Obervações -->
    <div class="modal fade" id="obs" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Obervações</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span id="conteudo"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>

                </div>
            </div>
        </div>
    </div>

    <script>
    //jquery para fazer buscar na tabela
    $(document).ready(function() {
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
    </script>








    <!--Modal editar dados-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLabel">Editar Dados</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="edit_epi.php" method="POST" onsubmit="return  verificar()">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">TIPO:</label>
                            <input type="text" class="form-control" id="material" name="material">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Modelo:</label>
                            <input type="text" class="form-control" id="modelo" name="modelo">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Marca:</label>
                            <input type="text" class="form-control" id="marca" name="marca">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Nº Série:</label>
                            <input type="text" class="form-control" id="serie" name="serie">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">PRATIMÔNIO:</label>
                            <input type="text" class="form-control" id="patrimonio" name="patrimonio">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">LOCALIZAÇÃO:</label>
                            <input type="text" class="form-control" id="localizacao" name="localizacao">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">SITUAÇÃO:</label>
                            <input type="text" class="form-control" id="situacao" name="situacao">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">CAUTELA:</label>
                            <input type="text" class="form-control" id="cautela" name="cautela">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">VALIDADE:</label>
                            <input type="text" class="form-control" id="validade" name="validade">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">FABRICAÇÃO:</label>
                            <input type="text" class="form-control" id="fabricacao" name="fabricacao">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label"> NÍVEL:</label>
                            <input type="text" class="form-control" id="nivel" name="nivel">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label"> TAMANHO:</label>
                            <input type="text" class="form-control" id="tamanho" name="tamanho">
                        </div>
                        <div>
                            <label for="message-text" class="col-form-label">OBERVAÇÕES:</label><br>
                            <textarea id="obs" name="obs" cols="55" rows="4"> </textarea>
                        </div>

                        <input type="hidden" name="id" id="id" value="">
                        <input type="hidden" name="tipo" id="tipo" value="gto">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" onclick="verificar()" class="btn btn-primary ">Salvar Alterações</button>
                </div>
                </form>
            </div>
        </div>
    </div>



    <script>
    function verificar() {
        //pegando valores para salvar no banco
        var tipo = document.getElementById('material')

        var modelo = document.getElementById('modelo')

        var marca = document.getElementById('marca')

        var serie = document.getElementById('serie')

        var patrimonio = document.getElementById('patrimonio')

        var localizacao = document.getElementById('localizacao')

        var situacao = document.getElementById('situacao')

        var cautela = document.getElementById('cautela')

        var validade = document.getElementById('validade')

        var fabricacao = document.getElementById('fabricacao')

        var nivel = document.getElementById('nivel')

        var tamanho = document.getElementById('tamanho')

        var obs = exampleModal.querySelector('obs')


        //verificando se  existi alguma variável vazia 
        if (modelo.value == "" || marca.value == "" || serie.value == "" || patrimonio.value == "" ||
            localizacao.value == "" || situacao.value == "" || cautela.value == "" || validade.value == "" || fabricacao
            .value == "" || nivel.value == "" || tamanho.value == ""
        ) {

            alert("Campo/os em Branco, preencha todos os campos para realiza edição dos dados")
            return false
        } else {
            return true
        }

    }
    </script> -->

    <!-- carregando dados de edição -->
    <script>
    //carregar dados para os campos

    var exampleModal = document.getElementById('exampleModal')
    exampleModal.addEventListener('show.bs.modal', function(event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        // Extract info from data-bs-* attributes
        var recipient = button.getAttribute('data-bs-whatever')
        var recipient1 = button.getAttribute('data-bs-whatever2')
        var recipient2 = button.getAttribute('data-bs-whatever3')
        var recipient3 = button.getAttribute('data-bs-whatever4')
        var recipient4 = button.getAttribute('data-bs-whatever5')
        var recipient5 = button.getAttribute('data-bs-whatever6')
        var recipient7 = button.getAttribute('data-bs-whatever7')
        var recipient8 = button.getAttribute('data-bs-whatever8')
        var recipient9 = button.getAttribute('data-bs-whatever9')
        var recipient10 = button.getAttribute('data-bs-whatever10')
        var recipient11 = button.getAttribute('data-bs-whatever11')
        var recipient12 = button.getAttribute('data-bs-whatever12')
        var recipient13 = button.getAttribute('data-bs-whatever13')
        var recipient14 = button.getAttribute('data-bs-whatever14')


        // If necessary, you could initiate an AJAX request here
        // and then do the updating in a callback.
        //
        // Update the modal's content.

        var modalBodyInput = exampleModal.querySelector('#material')
        modalBodyInput.value = recipient
        var modalBodyInput = exampleModal.querySelector('#modelo')
        modalBodyInput.value = recipient1
        var modalBodyInput = exampleModal.querySelector('#marca')
        modalBodyInput.value = recipient2
        var modalBodyInput = exampleModal.querySelector('#serie')
        modalBodyInput.value = recipient3
        var modalBodyInput = exampleModal.querySelector('#patrimonio')
        modalBodyInput.value = recipient4
        var modalBodyInput = exampleModal.querySelector('#localizacao')
        modalBodyInput.value = recipient5
        var modalBodyInput = exampleModal.querySelector('#situacao')
        modalBodyInput.value = recipient7
        var modalBodyInput = exampleModal.querySelector('#cautela')
        modalBodyInput.value = recipient8
        var modalBodyInput = exampleModal.querySelector('#validade')
        modalBodyInput.value = recipient9
        var modalBodyInput = exampleModal.querySelector('#fabricacao')
        modalBodyInput.value = recipient10
        var modalBodyInput = exampleModal.querySelector('#nivel')
        modalBodyInput.value = recipient11
        var modalBodyInput = exampleModal.querySelector('#tamanho')
        modalBodyInput.value = recipient12
        var modalBodyInput = exampleModal.querySelector('#obs')
        modalBodyInput.value = recipient13
        var modalBodyInput = exampleModal.querySelector('#id')
        modalBodyInput.value = recipient14



    })
    </script>




    </div>
    </div>

    <!-- jQuery , Popper.js , Bootstrap JS -->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>

    <script src="https://cdn.datatables.net/1.11.0/css/jquery.dataTables.min.css"></script>

    <script>
    $(document).ready(function() {

        $('#myTable').DataTable();

    });
    </script>

    <script src="js/script.js"></script>


    <!-- Icons -->


    <div at-magnifier-wrapper="">

        <div class="at-theme-light">

            <div class="at-base notranslate" translate="no">

                <div class="Z1-AJ" style="top: 0px; left: 0px;"></div>

            </div>

        </div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-modal/2.2.6/js/bootstrap-modalmanager.min.js"
        integrity="sha512-/HL24m2nmyI2+ccX+dSHphAHqLw60Oj5sK8jf59VWtFWZi9vx7jzoxbZmcBeeTeCUc7z1mTs3LfyXGuBU32t+w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>


</body>

</html>