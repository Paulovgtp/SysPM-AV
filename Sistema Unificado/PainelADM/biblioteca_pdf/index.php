<?php

session_start();

//apresentando
$data = date('d/m/Y');

//recendo valores para colocar na tabela
$cautela = $_POST['oficial'];
$tipo = $_POST['tipo'];
$quantidade = $_POST['quantidade'];
$operacao = $_POST['operacao'];
$observacao = $_POST['obs'];

$nomeassinatura = $_POST['nome']; // Nome do Soldado que ta recebendo a arma

//UPLOAD assinatura
$foto = $_FILES['assinatura']['name'];
$extensao = strtolower(pathinfo($foto, PATHINFO_EXTENSION));
$novo_nome = $$nomeassinatura . "." . $extensao;
$diretorio = "assinaturas/";

$caminho = $diretorio . $nomeassinatura ; // caminho da assinatura

move_uploaded_file($_FILES['assinatura']['tmp_name'], $diretorio . $novo_nome);


//importanto a blibioteca
require_once __DIR__ . '/vendor/autoload.php';

//modelo documeto
if (isset($_POST['oficial'])) {
  $documento = '

      <style>
        p {font-family:Arial;font-size:11.000000px;font-weight:bold;color:#000000;}
        table, td, th, tfoot {border:solid 1px #000; padding:5px;}
        th {width:100%;background-color:#999;}
        caption {font-size:x-large;}
        colgroup {background:#F60;}
        .coluna1 {background:#F66;}
        .coluna2  {background:#F33;}
        .coluna3  {background:#F99;}
      </style>

      <div class="container" style="width:100%;display:flex;flex-wrap: nowrap;justify-content: space-between;">
        <table>
          <tr>
            <td><img style="width:15%;" src="../img/brasao-pm-para.png"></td>
            <td style="width:70%;text-align:center;">
              <p>GOVERNO DO ESTADO DO PARÁ </p>
              <p>SECRETARIA DE ESTADO DE SEGURANÇA PÚBLICA</p>
              <p>E DEFESA SOCIAL</p>
              <p>POLÍCIA MILITAR DO PARÁ</p>
              <p>7º BATALHÃO DA PM</p>
              <hr>
              <p>DATA DE EMISSÃO</p>
              <p>' . $data . '</p>
            </td>
            <td><img style="width:15%;" src="../img/brasao-pm-pa2.png"></td>
          </tr>
        </table>
      </div>

      <div>
        <br>
        <h3 style="text-align:center;">DESCARGO DE MUNIÇÃO.</h3>
        <table style="width:100%;">     
          <tr>
          <td>Serviço:</td>
          <td style="text-align:center;">Descargo de Munição</td>
          </tr>
          <tr>
          <td>Tipo de Munição:</td>
          <td style="text-align:center;">' . $tipo . '</td>
          </tr>
          <tr>
          <td>Cautela:</td>
          <td style="text-align:center;">' . $cautela . '</td>
          </tr>
          <tr>
          <td>Quantidade:</td>
          <td style="text-align:center;">' . $quantidade . '</td>
          </tr>
          <tr>
          <td>Operação:</td>
          <td style="text-align:center;">' . $operacao . '</td>
          </tr>
          <tr>
          <td>Obs:</td>
          <td style="text-align:center;">' . $observacao . '</td>
          </tr>
        </table>
      </div>
      
      ';
  ######### João Pedro ###############

} elseif (isset($_POST['histórico'])) {

}


############  josué  ###############

elseif (isset($_POST['parte'])) {

  $documento = '
    <style>
      td {border:solid 1px #000; padding:5px;}
    </style>
   
    <div>
      <div class="container" style="width:100%;display:flex;flex-wrap: nowrap;justify-content: space-between;">
        <table>
          <tr>
            <td><img style="width:10%;" src="../img/brasao-pm-para.png"></td>
            <td style="width:80%;text-align:center;">
              <h2 style="text-align:center">COMPROVANTE DE CAUTELA EPI </h2>
              <p>ID: ' . md5(md5($data)) . '</p>
            </td>
            <td><img style="width:10%;" src="../img/brasao-pm-pa2.png"></td>
          </tr>
        </table>
      </div>

      <hr><br>

      <table>
        <tr>
          <td style="border: 0;padding:0;"><b>COMPROVANTE DE CAUTELA :</b></td>
          <td style="border: 0;padding:0;text-transform:uppercase;"> ' . $_POST['obj'] . '</td>
        </tr>
      </table>

      <hr>

      <table border="1" style="width:100%"> 
        <tr>            
          <th style="font-size: 15px; ">Parte:</th>
        </tr>
        <tr>
          <td style="text-align:justify; font-size: 12px; padding: 1em;">' . $_POST['parte'] . '</td>       
        </tr>
        <tr>
          <th style="font-size: 15px; ">Termo:</th>
        </tr>
        <tr>
          <td style="text-align:justify; font-size: 12px; padding: 1em;">' . $_POST['termo'] . '</td>       
        </tr>
        <tr>
          <th style="font-size: 15px; ">Declaração:</th>
        </tr>
        <tr>
          <td style="text-align:justify; font-size: 12px; padding: 1em;">' . $_POST['declaracao'] . '</td>       
        </tr>
      </table>
    </div>
   ';
}
######### Josué   ###############
//nome docoumento
$nomedoc = md5(date('d/m/Y \- H:i:s'));

//iniciando objeto da biblioteca
$mpdf = new \Mpdf\Mpdf();

//criando documento baseado no html
$mpdf->WriteHTML($documento);

//resolvendo B.o de acentos
$mpdf->charset_in = 'UTF-8';

//saindo do documento
$mpdf->Output('doc/' . $nomedoc . '.pdf', 'f'); // F para salvar doc no sistema

$_SESSION['caminho'] = "biblioteca_pdf/doc/" . $nomedoc . ".pdf";

if (isset($_POST['oficial'])) {
  header('Location: ../DescargoDeMunicao.php');
}elseif(isset($_POST['parte'])){
  header('Location: ../caterinha_epi.php');
}
