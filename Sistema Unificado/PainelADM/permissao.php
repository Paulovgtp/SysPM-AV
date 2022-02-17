<?php
session_start();

//verifando se foi criando a sessão
if (!isset($_SESSION['adm'])) {

  //redirecionando para login
  header("location:login.php");
}


//adcionando um novo usuário


?>




<!DOCTYPE html>

<html lang="pt-br">

<head>

  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <meta name="description" content="">

  <meta name="author" content="">

  <?php include('title_favicon.html')?>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  <link rel="stylesheet" href="style.css">

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">

<!--Jquery-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

<!--Tabelas-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>

<!--JQUERY-->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

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

<body>

  <?php include('nav_sup.html') ?>

  <div class="container-fluid" style="margin-top: 3vh;">

    <div class="row">

      <?php include('nav_lateral.html') ?>

      <!--Tabela pra consulta-->
      <div class="corpo-painel col-md-10" style="background-image: url(img/fundo.png);background-size: cover;height: 97vh;">
      
      <div class="col-md-12 table-responsive pt-3" style="min-width: 480px;">
      
        <h2 style="text-align: center;"><u>Permissões</u></h2>

        <br>
        <?php
          if(isset($_SESSION['adcionado'])){
        ?>
          <div class="alert alert-success" role="alert" id="alertsucesso">
             Cadastro Realizado com Sucesso !!!
          </div>
          <script>
            
            setTimeout(function(){ 
              document.getElementById("alertsucesso").style.display="none"
             }, 2000);
          </script>
        <?php
          }
          unset($_SESSION['adcionado']);
        ?>

          <?php
             if(isset($_SESSION['excluido'])){
          ?>
           <div class="alert alert-success" role="alert" id="alertsucesso01">
             Excluido com Sucesso !!!
          </div>
          <script>
            
            setTimeout(function(){ 
              document.getElementById("alertsucesso01").style.display="none"
             }, 2000);
          </script>

          <?php
             }
             unset($_SESSION['excluido']);

          ?>




        <div class="col-md-12" style="display: flex;margin: 0 0 5px;justify-content: space-around;">
          <p style="width: 174px;margin-top:7px;">Faça sua consulta:</p>
          <input style="box-shadow: 1,5px 1,5px 1,5px 1,5px black;" class="form-control" id="myInput" type="text" placeholder="Buscar...">
          <button class="btn btn-success" onclick="openModal()" style="box-shadow: 2px 2px 2px black;margin-left: 10px;height: 37px;"><i class="bi bi-person-check-fill"></i> Add Usuário</button>
        </div>

        



        <!--Modal para Add user-->
        <div class="modal fade" id="adduser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Adicionar Usuário</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <form action="permissoes_edit.php" method="post">
                    <div class="container">
                      <div class="row">
                        <div class="col -5">
                          <label for="">Usuário</label>
                          <input type="text" class="form-control" id="novouser" name="novouser" required>
                        </div>
                        <div class="col -5">
                          <label for="">Senha:</label>
                          <input type="text" class="form-control" id="novouser" name="newsenha" required>
                        </div>
                      </div>
                      <br>
                      <div class="row">
                        <label for="">Tipo usuário:</label>
                          <select name="novotipouser" id="" style="text-align: center;">
                            <option value="adm">Adm</option>
                            <option value="arm">Armeiro</option>
                          </select>
                      </div>
                    </div>
                  
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary ">Salvar Usuário</button>
              </div>
              </form>
            </div>
          </div>
        </div>


          <!--Exibindo modal para add usuário -->
          <script>
            function openModal(){
              //abrindo modal para adickonar user
              $('#adduser').modal('show')
            }
          </script>

          <table class="table table-bordered table-striped">

            <thead>
              <style>
                th,
                td {
                  text-align: center;
                }
              </style>

              <tr>
                <th>#</th>
                <th>Usuário</th>
                <th>Senha</th>
                <th>Permissão</th>
                <th>Ação</th>
              </tr>
            </thead>

            <!--asdf-->


            <!--PHP PARA LISTA OS LISTA DE ESPERA-->

            <!--Linhas da Tabela-->
            <?php
            //incluindo conexão com banco
            include('conexao.php');

            //query para execução dos dados
            $query = "SELECT * FROM `usuario`";


            //executando query
            $result = mysqli_query($conexao, $query);

            //variável auxiliar
            $x = 1;

            //colocando resultados da linha em array
            while ($linhas = $result->fetch_assoc()) {

            ?>

              <tbody id="myTable">
                <tr>
                  <td><?= $x?></td>
                  <td><?= $linhas['email']?></td>
                  <td><?= $linhas['senha']?></td>
                  <td><?= $linhas['tipo_user']?></td>

                  <td>

                  <form action="excluir.php" method="post">
                        <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever1="<?= $linhas['senha']?>"  data-bs-whatever2="<?= $linhas['email']?>" data-bs-whatever3="adm" data-bs-whatever4="<?= $linhas['id_usuario']?>">
                          Editar
                        </button>

                        <input type="hidden" name="idexcluir" value="<?=$linhas['id_usuario']?>">
                            <button type="submit"  id="<?=$linhas['id_usuario']?>" class="btn btn-outline-danger excluir">
                          Excluir
                        </button>
                    </form>
                  </td>
                </tr>

                <!--Linhas da Tabela-->
              </tbody>
            <?php

              //incrementando contador
              $x++;
              //finalizando o laço
            }
            ?>

          </table>
        </div>
      </div>
    </div>
  </div>



  <!-- Salvar dados dos editados no banco -->
  <script>
  $(document).ready(function() {
      $(document).on('click', '.add', function() {
         alert("Flamengo"); 



      });
    });
  </script>

<!--Excluir-->
<script>
   //monstar obs
   $(document).ready(function() {
      $(document).on('click', '.excluir', function() {
        var resultado = confirm("Deseja realmente excluir o Usuário");
        if (resultado == true) {
            return true; 
        }
        else{
            return false;
        }

      });
    });
</script>


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
          alert("Munição sem Observação!!!")
        }



      });
    });
  </script>



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
          <h5 class="modal-title" id="exampleModalLabel">Editar Usuário</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="permissoes_edit.php" method="POST" onsubmit="return  verificar()">



            <div class="container">
              <div class="row">
                <div class="col -3">
                  <label for="message-text" class="col-form-label">Usuário:</label>
                  <input type="text" class="form-control" id="marca" name="user" required>
                </div>
                <div class="col -3">
                  <label for="recipient-name" class="col-form-label">Senha:</label>
                  <input type="text" class="form-control" id="modelo" name="senha" required>
                </div>

              </div>
              <br>
              <div class="row" style=" margin: auto;">
                <label for="recipient-name" class="col-form-label">Acesso: </label>
                <select name="acesso" required style="text-align: center;">
                  <option value="">Selecione o tipo de Acesso</option>
                  <option value="adm">Adm</option>
                  <option value="arm">Armeiro</option>
                </select>
              </div>
            </div>
            <input type="hidden" class="form-control" name="id" id="modelo1" required>

            <br>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
              <button type="submit" onclick="verificar()" class="btn btn-primary ">Salvar Alterações</button>
            </div>

        </div>




      </div>

      </form>
    </div>
  </div>
  </div>



  <!-- carregando dados de edição -->
  <script>
    //carregar dados para os campos

    var exampleModal = document.getElementById('exampleModal')
    exampleModal.addEventListener('show.bs.modal', function(event) {

      // Button that triggered the modal

      var button = event.relatedTarget

      // Extract info from data-bs-* attributes
      var recipient1 = button.getAttribute('data-bs-whatever1')
      var recipient2 = button.getAttribute('data-bs-whatever2')
      var id = button.getAttribute('data-bs-whatever4')



      var modalBodyInput = exampleModal.querySelector('#modelo')
      modalBodyInput.value = recipient1
      var modalBodyInput = exampleModal.querySelector('#marca')
      modalBodyInput.value = recipient2
      var modalBodyInput = exampleModal.querySelector('#modelo1')
      modalBodyInput.value = id





    })
  </script>

  </div>
  </div>

  <!-- jQuery , Popper.js , Bootstrap JS -->

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

  <script src="https://cdn.datatables.net/1.11.0/css/jquery.dataTables.min.css"></script>

  <script>
    $(document).ready(function() {

      $('#myTable').DataTable();

    });
  </script>


  <!-- Icons -->


  <div at-magnifier-wrapper="">

    <div class="at-theme-light">

      <div class="at-base notranslate" translate="no">

        <div class="Z1-AJ" style="top: 0px; left: 0px;"></div>

      </div>

    </div>

  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-modal/2.2.6/js/bootstrap-modalmanager.min.js" integrity="sha512-/HL24m2nmyI2+ccX+dSHphAHqLw60Oj5sK8jf59VWtFWZi9vx7jzoxbZmcBeeTeCUc7z1mTs3LfyXGuBU32t+w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


  
    <!--Scrips modal e bootstrap-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-modal/2.2.6/js/bootstrap-modalmanager.min.js" integrity="sha512-/HL24m2nmyI2+ccX+dSHphAHqLw60Oj5sK8jf59VWtFWZi9vx7jzoxbZmcBeeTeCUc7z1mTs3LfyXGuBU32t+w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.11.2/jquery.mask.js" integrity="sha512-bwanfE29Vxh7VGuxx44U2WkSG9944fjpYRTC3GDUjh0UJ5FOdCQxMJgKWBnlxP5hHKpFJKmawufWEyr5pvwYVA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!--Formatanto pra money-->
<script src="js/formart.js"> </script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.11.2/jquery.mask.min.js" integrity="sha512-Y/GIYsd+LaQm6bGysIClyez2HGCIN1yrs94wUrHoRAD5RSURkqqVQEU6mM51O90hqS80ABFTGtiDpSXd2O05nw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!--Um script atoa-->
<script src="js/script.js"></script>

</body>

</html>