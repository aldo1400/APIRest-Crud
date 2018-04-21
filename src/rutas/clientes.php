<?php 
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app=new \Slim\App;

//Obtener todos los clientes

$app->get("/api/clientes",function(Request $request, Response $response){
    $consulta="SELECT * FROM clientes";
    try{
        //instar base de datos
        $db=new db();

        // conexion

        $db=$db->conectar();
        $ejecutar=$db->query($consulta);
        $clientes=$ejecutar->fetchAll(PDO::FETCH_OBJ);
        $DB=null;

        // Ejecutar y mostrar en JSON
        echo json_encode($clientes);

    }catch(PDOException $e){
        echo '{"error":{"text":'.$e->getMessage().'}';
    }
});

$app->get('/api/clientes/{id}',function(Request $request, Response $response){
//    Obtener el valor del id que ha sido enviado a traves de request  
    $id=$request->getAttribute('id');

    $consulta="SELECT * FROM clientes where id='$id'";
    try{
        //instar base de datos
        $db=new db();

        // conexion

        $db=$db->conectar();
        $ejecutar=$db->query($consulta);
        $clientes=$ejecutar->fetchAll(PDO::FETCH_OBJ);
        $DB=null;

        // Ejecutar y mostrar en JSON un solo cliente
        echo json_encode($clientes);

    }catch(PDOException $e){
        echo '{"error":{"text":'.$e->getMessage().'}';
    }
});

//Agregar un cliente
$app->post('/api/clientes/agregar',function(Request $request, Response $response){
    //    Obtener el valor del id que ha sido enviado a traves de request  
        
        $nombre=$request->getParam('nombre');
        $apellidos=$request->getParam('apellidos');
        $telefono=$request->getParam('telefono');
        $email=$request->getParam('email');
        $direccion=$request->getParam('direccion');
        $ciudad=$request->getParam('ciudad');
        $departamento=$request->getParam('departamento');
        
        $consulta="INSERT INTO clientes (nombre,apellidos,telefono,email,direccion,ciudad,departamento) VALUES (:nombre,:apellidos,:telefono,:email,:direccion,:ciudad,:departamento)";

        try{
            //instar base de datos
            $db=new db();
    
            // conexion
    
            $db=$db->conectar();
            $stmt=$db->prepare($consulta);
            $stmt->bindParam(':nombre',$nombre);
            $stmt->bindParam(':apellidos',$apellidos);
            $stmt->bindParam(':telefono',$telefono);
            $stmt->bindParam(':email',$email);
            $stmt->bindParam(':direccion',$direccion);
            $stmt->bindParam(':ciudad',$ciudad);
            $stmt->bindParam(':departamento',$departamento);
            $stmt->execute();
            echo '{"notice":{"text":"Cliente agregado"}';
            
        }catch(PDOException $e){
            echo '{"error":{"text":'.$e->getMessage().'}';
        }
    });

// Editar cliente
    $app->put('/api/clientes/actualizar/{id}',function(Request $request, Response $response){
        //    Obtener el valor del id que ha sido enviado a traves de request  
            $id=$request->getAttribute('id');

            $nombre=$request->getParam('nombre');
            $apellidos=$request->getParam('apellidos');
            $telefono=$request->getParam('telefono');
            $email=$request->getParam('email');
            $direccion=$request->getParam('direccion');
            $ciudad=$request->getParam('ciudad');
            $departamento=$request->getParam('departamento');
            
            $consulta="UPDATE clientes SET 
                nombre=:nombre,
                apellidos=:apellidos,
                telefono=:telefono,
                email=:email,
                direccion=:direccion,
                ciudad=:ciudad,
                departamento=:departamento
                WHERE id='$id'";
    
            try{
                //instar base de datos
                $db=new db();
        
                // conexion
        
                $db=$db->conectar();
                $stmt=$db->prepare($consulta);
                $stmt->bindParam(':nombre',$nombre);
                $stmt->bindParam(':apellidos',$apellidos);
                $stmt->bindParam(':telefono',$telefono);
                $stmt->bindParam(':email',$email);
                $stmt->bindParam(':direccion',$direccion);
                $stmt->bindParam(':ciudad',$ciudad);
                $stmt->bindParam(':departamento',$departamento);
                $stmt->execute();
                echo '{"notice":{"text":"actualizado"}';
                
            }catch(PDOException $e){
                echo '{"error":{"text":'.$e->getMessage().'}';
            }
        });

// Eliminar cliente

        $app->delete('/api/clientes/borrar/{id}',function(Request $request, Response $response){
            //    Obtener el valor del id que ha sido enviado a traves de request  
                $id=$request->getAttribute('id');
            
                $consulta="DELETE FROM clientes where id='$id'";
                try{
                    //instar base de datos
                    $db=new db();
            
                    // conexion
            
                    $db=$db->conectar();
                    $stmt=$db->prepare($consulta);
                    $stmt->execute();
                    $db=null;

                    echo '{"notice":{"text":"Cliente borrado"}';
                    
            
                }catch(PDOException $e){
                    echo '{"error":{"text":'.$e->getMessage().'}';
                }
            });   

?>