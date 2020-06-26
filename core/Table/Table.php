<?php

namespace Core\Table;

use Core\Database\Database;
use Core\Database\DatabaseInterface;

//use Core\Database\DatabaseInterface;

class Table
{


    /**
     * @var Table
     */
    protected $table;

    /**
     * @var DatabaseInterface
     */
    private $db;

    public function __construct(DatabaseInterface $db)
    { 
        $this->db = $db;
        if (is_null($this->table)) {
            $parts = explode('\\', get_class($this)); //permet d'avoir le nom de la classe fille
            $class_name = end($parts);
            $this->table = strtolower(str_replace('Table', '', $class_name)); //permet d'avoir le nom de la table
        }
    }

    public function query(string $statements,  $attributes = null, $one = false)
    {
        if ($attributes) {

           return $this->db->prepare($statements, $attributes, str_replace('Table', 'Entity', get_class($this)), $one);
        } else {

           return $this->db->query($statements, str_replace('Table', 'Entity', get_class($this)), $one);
        }
    }


    public function findAll()
    {

        return $this->db->query("SELECT * FROM $this->table", false);
    }
    public function getlist($key,$value){
        $records=$this->findAll();
        $returns=[];
        foreach ($records as $v) :
           $returns[$v->$key]=$v->$value;
        endforeach;
        return $returns;
    }

    public function find($id){
         return $this->db->prepare("SELECT * FROM $this->table
                                            WHERE id=?
                                             ", [$id],true);
    }
    public function update($id,array $fields=[]){
        $sql_parts=[];
        $attributes=[];
        foreach ($fields as $key => $value) {
            $sql_parts[]="$key=?";
            $attributes[]=$value;

           
        }
        $attributes[]=$id;
        $sql_part=implode(',',$sql_parts);
         return $this->query("UPDATE $this->table SET $sql_part
                                            WHERE id=?
                                             ", $attributes,true);
    }
    public function create(array $fields=[]){
        $sql_parts=[];
        $attributes=[];
        foreach ($fields as $key => $value) {
            $sql_parts[]="$key=?";
            $attributes[]=$value;

           
        }
        
        $sql_part=implode(',',$sql_parts);
         return $this->query("INSERT INTO $this->table SET $sql_part
                                             ", $attributes,true);
    }
    public function delete($id){
        $result=$this->query("DELETE FROM comment WHERE post_id=?",[$id],true );
        if ($result==null) {
             return $this->query("DELETE FROM {$this->table} WHERE id=?",[$id],true );
        }
       
    }
 

}
  
