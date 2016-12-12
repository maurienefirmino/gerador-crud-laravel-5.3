<?php
function gerarController($tabelaNome){
	
	$tabelaNome1 = strtolower($tabelaNome);
	$tabelaNome2 = ucwords($tabelaNome1);

	$filename = $tabelaNome2."Controller.php";

	$model = "\\\\".$tabelaNome2;

	$codigoPHP = '<?php
	namespace App\\\Http\\\Controllers;

	use Illuminate\\\Http\\\Request;
	use App'.$model.' as Model;

	class '.$tabelaNome2.'Controller extends Controller
	{
		//Página inicial da tabela
		public function index(){
			$dados = Model::all();
		}

		//Salva dados
		public function salva(Request $request){
			if(Model::create($request->all())){
				//Faz algo depois que salva
			}
		}

		//Edita dados
		public function editar(Request $request){
			if(Model::find($request->id)->update($request->all())){
				//Faz algo depois que atualiza
			}
		}

		//Exclui dados 
		public function deleta($id){
			if(Model::find($id)->delete()){
				//Faz algo depois que exclui
			}
		}

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
	$ArqOrig = $tabelaNome2."Controller.php";
	$ArqDest = "../app/Http/Controllers/".$tabelaNome2."Controller.php";

	copy($ArqOrig, $ArqDest);
	unlink($ArqOrig);
}

