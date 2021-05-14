<?php 

require_once("vendor/autoload.php");
use \Slim\Slim;
use Hcode\Page;

$app = new Slim();

$app->config('debug', true);

$app->get('/', function() {  
	
	/**Depois que cria o  "new Page", ele aciona 
	 o construct e vai adicionar o header na tela */
	$page = new Page();

	/** Aqui vai adicionar o arquivo index da pasta view*/
	$page->setTpl("index");
	

});

$app->run();

 ?>