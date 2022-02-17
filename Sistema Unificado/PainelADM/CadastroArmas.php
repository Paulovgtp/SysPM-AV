<?php
session_start();

//verifando se foi criando a sessão
if (!isset($_SESSION['adm'])) {

  header("location:login.php");
}

?>

<?php
//VERIFICANDO SE FOI ENVIADO ALGO
if (isset($_POST['modelo'])) {

  //INCLUINDO CONEXÃO COM O BANCO DE DADOS
  include('conexao.php');

  //RECEBENDO VALORES DO FORMULÁRIO
  $marca = $_POST['marca'];
  $modelo = $_POST['modelo'];
  $n_serie = $_POST['n_serie'];
  $patrimonio = $_POST['patrimonio'];
  $localizacao = $_POST['localizacao'];
  $situacao = $_POST['situacao'];
  $cautela = $_POST['cautela'];
  $observacao = $_POST['observacao'];
  $data_inspecao = $_POST['data_inpescao'];
  //UPLOAD FOTO
  $foto = $_FILES['foto']['name'];
  $extensao = strtolower(pathinfo($foto, PATHINFO_EXTENSION));
  $novo_nome = md5(time()) . "." . $extensao;
  $diretorio = "fotos_armas/";
  move_uploaded_file($_FILES['foto']['tmp_name'], $diretorio . $novo_nome);

  //VERIFICANDO TIPO DE CADASTRO
  if ($_POST['cadastro'] == 'gto') {
    //ENVIA DADOS PARA BANCO DE ARMAS DO GTO
    $tipo='gto';
    $data_atual = date('d/m/Y');
    $query = "INSERT INTO armas_gto (id, foto, MARCA, MODELO, n_serie, patr, localizacao, situacao, CAUTELA,data_inspecao, OBS) VALUES (null,'$novo_nome','$marca','$modelo','$n_serie','$patrimonio','$localizacao','$situacao','$cautela','$data_inspecao','$observacao')";

    $query1 = "INSERT INTO historico_armas (tipo, modelo, n_serie, localizacao, cautela, data_inspecao, data_atual) VALUES ('$tipo','$modelo','$n_serie','$localizacao','$cautela','$data_inspecao','$data_atual')";

  } else {
    $tipo='ordinario';
    $data_atual = date('d/m/Y');
    //ENVIA DADOS PARA BANCO DE ARMAS DO ORDINÁRIO
    $query = "INSERT INTO armas_ordinario (id, foto, MARCA, MODELO, n_serie, PATR, LOCALIZAÇÃO, SITUAÇÃO, CAUTELA,data_inspecao, OBS) VALUES (null,'$novo_nome','$marca','$modelo','$n_serie','$patrimonio','$localizacao','$situacao','$cautela','$data_inspecao','$observacao')";

    $query1 = "INSERT INTO historico_armas (tipo, modelo, n_serie, localizacao, cautela, data_inspecao, data_atual) VALUES ('$tipo','$modelo','$n_serie','$localizacao','$cautela','$data_inspecao','$data_atual')";

  }
  $cadastrado = "show";
  //EXECUTANDO QUERY
  $result = mysqli_query($conexao, $query);
  $result = mysqli_query($conexao, $query1);

  //VERIFICANDO SE OCORREU O CADASTRO
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

  <?php include('title_favicon.html')?>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">

  <style>
    input[type=number] {
      -moz-appearance: textfield;
      appearance: textfield;
    }

    input[type=number]::-webkit-inner-spin-button {
      -webkit-appearance: none;
    }
  </style>

<body>

  <?php include('nav_sup.html') ?>

  <div class="container-fluid" style="margin-top: 3vh;">

    <div class="row">

      <?php include('nav_lateral.html') ?>
      
      <div class="corpo-painel col-md-10" style="background-image: url(img/fundo.png);background-size: cover;height: 97vh;">
      <div class="col-md-12 table-responsive pt-3" style="min-width: 480px;">

      <main role="main" class="col-md-12 col-lg-12 pt-3 px-4" style="box-shadow: 1px 1px 1px 1.5px rgba(0, 0, 0, 0.589);">

        <h2 class="page-header" id="titulo" style="text-align: center;">Cadastro de Armas</h2>
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

          <form action="CadastroArmas.php" method="POST" enctype="multipart/form-data">
            <div class="row">
              <div class="form-group col-md-3">
                <label for="exampleInputEmail1">MARCA</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="marca" placeholder="Digite aqui..." required>
              </div>
              <div class="form-group col-md-3">
                <label for="exampleInputEmail1">MODELO</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="modelo" placeholder="Digite aqui..." required>
              </div>
              <div class="form-group col-md-3">
                <label for="exampleInputEmail1">Nº SÉRIE</label>
                <input type="number" class="form-control" id="exampleInputEmail1" name="n_serie" placeholder="Digite aqui..." required>
              </div>

              <div class="form-group col-md-3" style="text-align: center;  border-radius: 10px; height: 20px;">
                <br>
                <h6>Tipo de Cadastro</h6>
                <div class="form-check">
                  <label><input value="gto" type="radio" name="cadastro" required> GTO</label>
                  <label><input value="ordi" type="radio" style=" margin-left: 10px;" name="cadastro" required> ORDINÁRIO</label>
                </div>

              </div>

            </div>

            <div class="row">
              <div class="form-group col-md-3">
                <label for="exampleInputEmail1">PATRIMÔNIO</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="patrimonio" placeholder="Digite aqui..." required>
              </div>
              <div class="form-group col-md-3">
                <label for="exampleInputEmail1">LOCALIZAÇÃO</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="localizacao" placeholder="Digite aqui..." required>
              </div>
              <div class="form-group col-md-3">
                <label for="exampleInputEmail1">SITUAÇÃO</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="situacao" placeholder="Digite aqui..." required>
              </div>
              <div class="form-group col-md-3">
                <label for="exampleInputEmail1">CAUTELA</label>
                <input type="text" class="form-control" id="cautela" name="cautela" placeholder="Digite aqui..." required>
              </div>
            </div>
            <div class="form-group col-md-3" style="margin-left: -10PX;">
                <label for="exampleInputEmail1">DATA ÙLT. INSPEÇÃO</label>
                <input type="date" class="form-control" id="exampleInputEmail1" name="data_inpescao"   required>
              </div>
            <br>
            <div class="row">
              <label for="imagem">ADICIONAR FOTO: </label>
              <input type="file" name="foto" accept="image/*">
            </div>

            <br>

            <div class="row">

              <label for="exampleInputEmail1">OBSERVAÇÃO </label>

              <textarea class="form-control" name="observacao" id="" cols="30" rows="5" placeholder="Digite aqui..."></textarea>
            </div>

            <hr />

            <div class="row">
              <div class="col-md-12">
                <button type="submit" id="salvar" class="btn btn-primary" style="box-shadow: 1px 1px 1px 1.5px rgba(0, 0, 0, 0.589);" name=btnSubmit>Salvar</button>

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


  <!-- Icons -->

  <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>

  <script>
    feather.replace()
  </script>

  <!-- Graphs -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>

  <script>
    var ctx = document.getElementById("myChart");

    var myChart = new Chart(ctx, {

      type: 'line',

      data: {

        labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],

        datasets: [{

          data: [15339, 21345, 18483, 24003, 23489, 24092, 12034],

          lineTension: 0,

          backgroundColor: 'transparent',

          borderColor: '#007bff',

          borderWidth: 4,

          pointBackgroundColor: '#007bff'

        }]

      },

      options: {

        scales: {

          yAxes: [{

            ticks: {

              beginAtZero: false

            }

          }]

        },

        legend: {

          display: false,

        }

      }

    });
  </script>

  <script src="js/script.js"></script>

  <div at-magnifier-wrapper="">

    <div class="at-theme-light">

      <div class="at-base notranslate" translate="no">

        <div class="Z1-AJ" style="top: 0px; left: 0px;"></div>

      </div>

    </div>

  </div>

</body>

</html>