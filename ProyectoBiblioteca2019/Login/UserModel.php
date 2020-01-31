<?php

 class UserModel{
   
   public function verificar_user($username){

   	try{

   		$sql="SELECT * FROM usuarios WHERE username=?";
   		$stm=$this->pdo->prepare($sql);
   		$stm->execute(array($username));

   		$r=$stm->fetch(PDO::FETCH_OBJ);

   		if($r!=NULL) 
   			return 1;
   		else
   			return 0;
   	}
   	  catch (Exception $e){

   	  	die($e->getMessage());
   	  }
   }

   public function obtener_user($username,$password){

   	try{
   		$sql="SELECT * FROM usuarios WHERE username=? AND password=?";
   		$stm=$this->pdo->prepare($sql);
   		$stm->execute(array($username,$password));

   		$r=$stm->fetch(PDO::FETCH_OBJ);

   		$user= new usuarios();

   		$user->set_id($r->id);
   		$user->set_full_name($r->full_name);
   		$user->set_email($r->email);
   		$user->set_username($r->username);
   		$user->set_password($r->password);

   		return $user;
   	}
   	catch (Exception $e){
   		die ($e->getMessage());
   	}
   }

public function registrar_user(usuario $data){

	try{
		$sql="INSERT INTO usuarios (full_name,email,username,password) VALUES (?,?,?,?)";

		$this->pdo->prepare($sql)
		    ->execute(
		       array(
		          $data->get_full_name(),
		          $data->get_email(),
		          $data->get_username(),
		          $data->get_password()
		      )
		   );
	}
	 catch(Exception $e){
	 	die($e->getMessage());
	 }
}

 }

 ?>