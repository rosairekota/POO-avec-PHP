<?php
namespace Core\HTML;

/**
 *La classe formulaire
 * Permet de Generer un formiliare rapidement et simplement
 */
class Form
{

    /**
     * @var array|object Donnees utilisees pour generer un formulaire
     */
    protected $datas=[];

    /**
     * @var string tg utiliée pour entourer les champs
     */
    protected string $tag='p';
    /**
     * Cette fonction permet de generer un tag
     * @param string $html
     * @return string
     **/

    public function __construct($datas=[])
    {
        $this->datas=$datas;
    }
    protected function serround($html)
    {
       return "<{$this->tag}>".$html."</{$this->tag}>";
    }
    protected function getValue($index){
        if (is_object($this->datas)) {
          return isset($this->datas->$index)?$this->datas->$index:null;  
        }
        return isset($this->datas[$index])?$this->datas[$index]:null;
    }
    /**
     * @param string $name 
     * @param string|null $label :Le label
     * @param array|null $options
     * @return string serround()
     */
    public function input(string $name, ?string $label=null,?array $options=[]){
        $type=isset($options['type'])?$options['type']:'text';
        $id=isset($options['label'])?$options['label']:'.$name.';
        $label=isset($label)? $label:'.$name.';
        echo "<label for='.$id.'>".$label."</label";
        return $this->serround('<input type="'.$type.'" name="'.$name.'" id="'.$id.'" value="'.$this->getValue().'">');
    }

    public function submit($value){
        echo" <button class='btn btn-primary mb-5' name='submit'>$value</button>";
    }
    
}
