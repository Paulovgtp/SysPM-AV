<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Documento sem título</title>
</head>

<body>
    <?php
    session_start();
    
    session_destroy();
    
    include('conexao.php');
    
    $timestamp = mktime(date("H")-3, date("i"), date("s"), 0);

    $hora_sa = date('H:i:s',$timestamp);

    $queryHis1 = "UPDATE historico_acesso SET HORA_SA = '$hora_sa' WHERE ID ORDER BY ID DESC LIMIT 1";

    $resultHis1 = mysqli_query($conexao, $queryHis1);
    
    header("Location:login.php");
    ?>
</body>

</html>