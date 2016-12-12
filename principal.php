<?php
include 'model.php';
include 'controller.php';
include 'routes.php';
// Definindo o nome do arquivo a ser criado.
$nome = $_POST['banco'];

gerarModel($nome);

echo "Model ".$nome." criado!";

gerarController($nome);

echo "<br>Controller ".$nome." criado!";

gerarRotas($nome);

echo "<br>Rotas do  ".$nome." criadas!";

?>