<?php
function gerarModel($tabelaNome){

	$tabelaNome1 = strtolower($tabelaNome);
	$tabelaNome2 = ucwords($tabelaNome1);

	$filename = $tabelaNome2.".php";


	$codigoPHP = '<?php

	namespace App;

	use Illuminate\\\Database\\\Eloquent\\\Model;

	class '.$tabelaNome2.' extends Model
	{
		protected $table = "'.$tabelaNome1.'";
		protected $guarded = [];
	}

	';

	if(file_exists($filename)){
		$script = file_get_contents($filename);
	} else {
		$script = "";
	}

	$script = $codigoPHP;

	$file = @fopen($filename, "w+");
	@fwrite($file, stripslashes($script));
	@fclose($file);

	//Copiando para o lugar certo
	$ArqOrig = $tabelaNome2.".php";
	$ArqDest = "../app/".$tabelaNome2.".php";

	copy($ArqOrig, $ArqDest);
	unlink($ArqOrig);


}