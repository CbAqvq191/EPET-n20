<?php
class Persona{
 
   protected $id;
   protected $full_name;
   protected $email;

   public function set_id($valor){
        $this->id=$valor;
   }
   public function set_full_name($valor){
        $this->full_name=$valor;
   }
   public function set_email($valor){
        $this->email=$valor;
   }

   public function get_id(){
        return $this->id;
   }
   public function get_full_name(){
        return $this->full_name;
   }
   public function get_email(){
        return $this->email;
   }


}
?>