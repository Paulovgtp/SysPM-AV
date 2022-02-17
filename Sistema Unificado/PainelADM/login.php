<?php

session_start();

//Verificando se houver POST
if (isset($_POST['usuario'])) {

  //conexao com banco
  include('conexao.php');

  //receber dados do login
  $user = $_POST['usuario'];
  $senha = $_POST['senha'];
  $tipo = $_POST['tipo'];
  
  //dados para historico
  $timestamp = mktime(date("H")-3, date("i"), date("s"), 0);
  $data_en = date('d/m/Y');
  $hora_en = date('H:i:s',$timestamp);

  //comando sql para o banco
  $query = "SELECT * FROM `usuario` WHERE `email` = '$user' AND `senha` = '$senha' AND `tipo_user` LIKE '$tipo'";

  //execultando $query
  $result = mysqli_query($conexao, $query);

  //inserindo dados no histórico
  $queryHis = "INSERT INTO historico_acesso (ID, USERNAME, TIPO_USER, DATA_EN, HORA_EN, HORA_SA) VALUES (null,'$user','$tipo','$data_en','$hora_en','$hora_sa')";

  //execultando $query
  $resultHis = mysqli_query($conexao, $queryHis);
  
  //pegando a quantidade de linhas
  $row = mysqli_num_rows($result);

  // Verificando se acho algo
  if ($row > 0) {

    //verificando o tipo de usuário
    if ($_POST['tipo'] == "adm") {
      
      //criando sesão com     
      $_SESSION['adm'] = true;

      //redirecionado user
      header("location:home.php");
      
    }
    
  } else {

    echo "<script>alert('Usuário ou Senha inválidos')</script>";
  }
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <!-- Meta tags -->
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Alterar Favicon e Título do Site -->
    <?php include('title_favicon.html') ?>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" href="css/Login.css">

    <style>
    body {
        height: 100vh;
        background: #043591 url(img/fundo2.png) center center no-repeat;
        background-size: cover;
    }

    .estilizacao {
        max-width: 350px;
        background-color: #fff;
        border-radius: 10px;
        margin-top: 50px;
        opacity: 0.99;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -60%);
    }
    </style>

</head>

<body class="text-center vsc-initialized">

    <div class="col-6 pb-2 estilizacao">
        <br>
        <form method="POST" action="" class="form-signin">
            <img class="mb-3" src="img/brasao-pm-pa.png" id="logologin" alt="" width="150" height="150">
            <br>

            <div>
                <label class="mb-1"><b> Tipo de Login </b></label>
            </div>

            <label><input type="radio" name="tipo" value="armeiro" required=""> Armeiro </label>
            <label> </label>
            <label><input type="radio" name="tipo" value="adm"> Administrador </label>

            <br>
            <input type="text" name="usuario" class="form-control" id="inputUser" placeholder="Usuario" required="">

            <div class="invalid-feedback">
                É obrigatório inserir um e-mail válido.
            </div>

            <input type="password" name="senha" id="inputPassword" class="form-control" style="margin-top: 5px;"
                placeholder="Senha" required="">
            <button class="btn btn-lg btn-primary btn-block btn-outline-danger" id="btnlogin" type="submit"
                value="Enviar" name="enviar">Login</button>
        </form>

        <hr>

        <div class="col-md-12">
            <p class="mt-4 mb-3 text-muted">by ©TADS-2019</p>
        </div>
    </div>

</body>

</html>