<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('Bienvenido');
    }
       
    public function prueba ()
    {
        echo 'Bienvenido al API REST ';
    }

  
public function api()
{ 

    echo 'Bienvenido al API REST de registro de usuarios en Facebook ';
    $usuarios = array(
        "id"=> "1",
        "Usuario" => "aflores",
        "Nombre" => "Adriana",
        "Apellido" => "Flores",
        "Correo" => "adriianaflores2002@gmail.com",
        "Telefono" => "+593990813877",
        "Fecha de Registro" => "02-01-2023"
    );

    $perfil = array(
        "Usuario" => "aflores",
        "Fecha de Nacimiento" => "03-08-2002",
        "Genero" => "Femenino",
        "Ciudad" => "Portoviejo"
    );
    $publicaciones = array(
        "idusurio" => "1",
        "Contenido" => ".....",
        "FechaPubli" => "09/7/2023"
    );
   
    $resultado = array($usuarios,  $perfil, $publicaciones);

    return $this->response->setJSON($resultado);
}
public function apirest()
{ 
   
$parametros=array(
    'message' => 'Aprendiendo a desarrollar aplicaciones en Facebook',
                  'name' => 'Adriana',
                  'caption' => 'Mi primer aplicacion en Facebook',
                  'description' => 'Es genial');
                
        $resultado = array($parametros);

                  return $this->response->setJSON($resultado);
  
}

    public function login(){

return view('login');
    
    }
    public function getUsers()
    {
        echo 'Bienvenido a la informacion sobre el registro de usuarios en Facebook ';
        $this->db=\Config\Database::connect();
        $query=$this->db->query("SELECT * FROM usuarios");
        $result=$query->getResult();
        return $this->response->setJSON($result);
    

    }
   
    public function getUser($usuario)
    {
        $this->db=\Config\Database::connect();
        $query=$this->db->query("SELECT * FROM usuarios where usuario='$usuario' ");
        $result=$query->getResult();
        return $this->response->setJSON($result);
    
    }


    public function deleteUser($id)
{
    $this->db = \Config\Database::connect();
    $this->db->transStart(); // Iniciar una transacción para asegurar consistencia de la base de datos
    
    // Verificar si el id existe antes de eliminarlo
    $query = $this->db->query("SELECT * FROM usuarios WHERE id = '$id'");
    $result = $query->getRow();
    
    if ($result) {
        // Si el id existe, proceder con la eliminación
        $this->db->query("DELETE FROM usuarios WHERE id = '$id'");
        $this->db->transComplete(); // Completar la transacción
        
        if ($this->db->transStatus() === false) {
            // Si ocurre algún error durante la transacción, se realiza un rollback
            $this->db->transRollback();
            return $this->response->setJSON(['Success' => False, 'Message' => 'Error al eliminar el usuario.']);
        } else {
            return $this->response->setJSON(['Success' => True, 'Message' => 'Usuario eliminado correctamente.']);
        }
    } else {
        return $this->response->setJSON(['Success' => False, 'Message' => 'El usuario no existe.']);
    }
}

    

    public function testbd($cedula)
    {
        $this->db=\Config\Database::connect();
        $query=$this->db->query("SELECT * FROM usuarios where cedula='$cedula' ");
        $result=$query->getResult();
        return $this->response->setJSON($result);
    
        
    }
}