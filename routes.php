<?php
function gerarRotas($tabelaNome){

	$tabelaNome1 = strtolower($tabelaNome);
	$tabelaNome2 = ucwords($tabelaNome1);

	$filename = "../routes/web.php";

	$controller = $tabelaNome2."Controller";

	$script = "";

	$codigoPHP = '
	//Rotas para a tabela '.$tabelaNome2.'
	Route::group(["prefix"=>"'.$tabelaNome1.'"],function(){

		Route::get("/","'.$controller.'@index");
		Route::post("/","'.$controller.'@salva");
		Route::post("/edita","'.$controller.'@editar");
		Route::get("/deleta/{id}","'.$controller.'@deleta");

	});
	';

	if(file_exists($filename)){
		$script = file_get_contents($filename);
	} else {
		$script = "";
	}

	$script = $script.$codigoPHP;

	$file = @fopen($filename, "w+");
	@fwrite($file, stripslashes($script));
	@fclose($file);

}