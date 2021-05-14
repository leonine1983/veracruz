<?

namespace Hcode;
use Rain\Tpl;

class Page {

    private $options;

    /*Para termos acesso ao objeto Tpl da classe Rain\Tpl nos outros métodos dessa classe, 
    definimos ele como atributo da classe page.*/    
    private $tpl;   

    /*Opções padrão a ser utilizado na classe caso não seja enviado
    nenhuma váriavel pelo usuário, a classe utilizará valores padrão*/
    private $defaults = [
        "data"=>[]
    ];

     /** Para evitarmos usar o foreach várias vezes nessa classe, criamo um método exclusivo para isso e c
     * vamos chamar de setData 
     */
    private function setData ($data = array()){
        foreach ($data as key => $value){
            $this->tpl->assing($key, $value);
        }
    }

    /*As variáveis virão de acordo com a rota, depedendo da rota que estiver sendo 
    chamada no SLIM é que os dados serão passados para a classe Page; para isso, 
    é necessário o método construtor receber algumas opções*/
    public function __construct($opts = array()){
        /*Como queremos que o valor enviado pelo usurários através de um rota sobrescreva
        os valores atribuídos como padrão, usamos o ARRAY_MERGE. O array_merge irá mesclá os dois valores (defaults, e o 
        valor enviado pela rota) no atributo $opitions, dando preferência ao valor enviado pela rota conforme configurado
        nos parâmetros do array_merge(). Nos parâmetros, o último sobrepôe o primeiro*/ 
        $this->options = array_merge($this->defaults, $opts);

        $config = array(
            //Pasta onde Rain\Tpl irá buscar os arquivos de HTML
            "tpl_dir"   => $_SERVER["DOCUMENT_ROOT"]."/views/",
             //Pasta de cache onde o Rain\Tpl irá armezar esses arquivos momentaneamente
            "cache_dir" => $_SERVER["DOCUMENT_ROOT"]."/views-cache/",
            "debug"     => false
        );

        Tpl::configure($config);

        //Aqui chamamos o atributo Tpl por meio de This
        $This->tpl = new Tpl;

        /*Os dados estão na chave data de options. Para isso, será  feito
        um foreach da chave data*/
        $this->setData($this->options["data"]);   
        

        //Por fim, chamamos o método DRAW para desenha o template na tela
        $this->tpl->draw("header");                        

    }   

    /** Método usado para o conteúdo do site */
    public function setTpl($name, $data = array(), $returnHTML = false){
       
        $this->setData($data);
        /**Além de fazer o setData, passar os dados ali pelo template; vamos 
        desenhar o template na tela, que é o que vai passar pela variável $name*/
        return $this->tpl->draw($name, $returnHTML);


    }


    public function __destruct(){
        
    }
}


?>