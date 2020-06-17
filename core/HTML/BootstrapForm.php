<?php
namespace Core\HTML;

use Core\HTML\Form;


/**
 * La classe bootstrapForm 
 */
class BootstrapForm extends Form
{
    protected string $tag='div';

    protected function serround($html)
    {
       return "<{$this->tag} class='form-group'>".$html."</{$this->tag}>";
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
        $monLabel= "<label for='.$id.'>".$label."</label>";
        if ($type==='textarea') {
            $monInput='<textarea name="'.$name.'" rows="8" class="form-control">'.$this->getValue($name).'</textarea>';
        }
        else{
            $monInput='<input type="'.$type.'" name="'.$name.'" id="'.$id.'" class="form-control" value="'.$this->getValue($name).'">';
        }
        return $this->serround($monLabel.$monInput);
    }

    /**
     * fonction permettant d'utliser les selects
     *
     * @param string $name
     * @param string|null $label
     * @param  $id
     * @param array|object|null $options
     **/
    public function select($name,$label,$id=null,$options=[])
    {
         $monLabel= "<label for='.$id.'>".$label."</label>";
         $input='<select name="'.$name.'" class="form-control"';
         foreach ($options as $k=>$v) :
          $attributes='';
          if($attributes==$this->getValue($name)):
          $attributes='selected';
          endif;
         $input .='<option value="'.$k.'""'.$attributes.'">"'.$v.'"</option>';
         endforeach;
         $input .='</select>';
         return $this->serround($monLabel.$input);
    }
    
}


