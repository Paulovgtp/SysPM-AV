<?php

session_start();
    include("conexao.php");

   
//recebendo valores via metodo post
  $user=  $_POST['user'];
  $senha = $_POST['senha'];
  $acesso=  $_POST['acesso'];
  $id=$_POST['id'];
 




if(isset($_POST['novouser'])){
    //recebendo valores
      $usuarios=$_POST['novouser'];
      $senha=$_POST['newsenha'] ;
      $tipouser=$_POST['novotipouser'];

      $sql="INSERT INTO `usuario`(`id_usuario`, `email`, `senha`, `tipo_user`) VALUES (null,'$usuarios','$senha','$tipouser')";

      //execultando query
      $result = mysqli_query($conexao, $sql);

      if($result==1){
          $_SESSION['adcionado']=true;
          header('Location: permissao.php'); 

      }

}
 

if(isset($user)){
  //queyr
  $query="UPDATE `usuario` SET  `email`= '$user',`senha`='$senha',`tipo_user`='$acesso' WHERE id_usuario='$id'";
      echo $query;
  $result = mysqli_query($conexao, $query);

  
  if($result==1){
        //criando sessão caso tenha cadastrato com sucesso
        $_SESSION['edit_permissao']=true;
      header('Location: permissao.php'); 
  } 
  else{
    //se der errado criando uma sessão
    $_SESSION['nao_editado']=true;
  }
}

?>