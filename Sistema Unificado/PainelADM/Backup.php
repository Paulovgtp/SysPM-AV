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

    <?php include('title_favicon.html') ?>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">

    <style>
        .corpo-painel {
            height: 97vh;
            background: #043591 url(img/brasao-pm-centro.jpg) center center no-repeat;
            background-size: cover;
        }
        .corpo-painel img {
            width: 200px;
            top: 100%;
            left: 100%;
            transform: translate(-200px, -80px);
            position: relative;
        }

    </style>

<body style="background-color: #0a0a0a">

    <?php include('nav_sup.html') ?>

    <div class="container-fluid" style="margin-top: 3vh;">

        <div class="row">

            <?php include('nav_lateral.html') ?>

            <!--Div do meio-->
            <div class="corpo-painel col-md-10">
                <div style="margin-top:20px;" class="col-sm-5 alert alert-success alert-dismissible fade show" role="alert">
                <h4 class="alert-heading">Backup realizado com sucesso!</h4>
                <p>O arquivo de Backup está na pasta 'Downloads' do seu computador.</p>
                <hr>
                <p class="mb-0">Atenção!!! Se possível, faça uma cópia desse arquivo em outro local de armazenamento confiável, para que, em caso de problemas, não seja perdido toda a base de dados.</p>
                   <a href="home.php"> <button type="button" class="close" aria-label="Close">
                        <b><span aria-hidden="true">&times;</span></b>
                    </button> </a>
                </div>
            </div>

        </div>

    </div>


    <!-- jQuery , Popper.js , Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js">
    </script>

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
