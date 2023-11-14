<?php
//require_once '../helpers/autocargar.php';
// require_once '../helpers/login.php';
// require_once '../helpers/session.php';
// require_once '../repositorios/usuarioRepo.php';
// require_once '../entidades/usuario.php';
// require_once $_SERVER['DOCUMENT_ROOT']."/DEWESE/examinator/helpers/utocargar.php";

class ApiUsuario{

    static function loginUsuario($repo, $action) {
        if (!(Login::estaLogeado())) {
            $repo= new UsuarioRepo();
            $action=$_POST['action'];
            if ($action=='login'){
                $nombreUsu=$_POST['nombre'];
                $password=$_POST['password'];
                $usuario=$repo->findByName($nombreUsu);
                if ($usuario->getNombre()==$nombreUsu && $usuario->getPassword()==$password) {
                    Login::login();
                    echo json_encode(['status' => '200']);
                } else{
                    echo json_encode(['status' => 'error', 'message' => 'Usuario o contraseña incorrectos']);
                }
            }

        } else{
            header("Location: http://localhost/dewese/examinator/vistas/Inicio.php");
        }

    }

    static function registroUsuario($repo, $action) {
        if (!(Login::estaLogeado())) {
            $repo= new UsuarioRepo;
            $action=$_POST['action'];
            if ($action=='registro'){
                $nombreUsu=$_POST['nombre'];
                $password=$_POST['password'];
                $usuario=$repo->findByName($nombreUsu);
                if ($usuario) {
                    echo json_encode(['status' => 'error', 'message' => 'El nombre de usuario ya está en uso']);
                } else{
                    $nuevoUsuario = new Usuario;
                    $nuevoUsuario->setNombre($nombreUsu);
                    $nuevoUsuario->setPassword($password);
                    $repo->save($nuevoUsuario);
                    echo json_encode(['status' => '200']);
                    //Login::login(); Si quiero que inicie sesión directamente.
                }
            }
        }else{
            header("Location: http://localhost/dewese/examinator/vistas/index.php");
        }
    }

    static function apiLog(){
        $repo=new UsuarioRepo();
        $nombreUsu = $_POST['usuario'];
        $password = $_POST['password'];
        $usuario = $repo->findByName($nombreUsu);
        if ($usuario && $usuario->getPassword() == $password) {
            //Session::iniciaSesion();
            Login::login();
            $_SESSION['usuario'] = $usuario->getNombre();
            echo json_encode(['status' => '200', 'message' => 'Inicio de sesión exitoso']);
            return true;
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Usuario o contraseña incorrectos']);
            return false;
        }
    }

    static function apiReg(){

    }

    static function apiBorraUsu(){

    }

    static function apiActualizaUsu(){

    }

    static function apiUsuario(){
        if (!(Login::estaLogeado())) {
            $method=$_SERVER['REQUEST_METHOD'];
            if ($method=='GET') {
                
            }elseif ($method=='POST') {
                
            }elseif ($method=='DELETE') {
                
            }elseif ($method=='PUT') {
                
            }
        }
    }

}


// if (!(Login::estaLogeado())) {
//     $method=$_SERVER['REQUEST_METHOD'];
//     $action=$_POST['action'];
//     $repo= new UsuarioRepo;
//     if ($method=='POST'){
        
//     }elseif ($method=='GET'){

//     }elseif ($method=='DELETE'){

//     }elseif ($method=='PUT'){
    
//     }
// } else{
//     header("Location: http://localhost/dewese/examinator/vistas/inicio.html");
// }



// function registroUsuario() {
//     if (!(Login::estaLogeado())) {
//         $repo= new UsuarioRepo;
//         $method=$_SERVER['REQUEST_METHOD'];
//         $action=$_POST['action'];
//         if ($method=='POST' && $action=='registro'){
//             $nombreUsu=$_POST['nombre'];
//             $password=$_POST['password'];
//             $usuario=$repo->findByName($nombreUsu);
//             if ($usuario) {
//                 echo json_encode(['status' => 'error', 'message' => 'El nombre de usuario ya está en uso']);
//             } else{
//                 $nuevoUsuario = new Usuario;
//                 $nuevoUsuario->setNombre($nombreUsu);
//                 $nuevoUsuario->setPassword($password);
//                 $repo->save($nuevoUsuario);
//                 echo json_encode(['status' => '200']);
//                 //Login::login(); Si quiero que inicie sesión directamente.
//             }
//         }
//     }else{
//         header("Location: http://localhost/dewese/examinator/vistas/index.php");
//     }
// }



// // Comprobación para ver si el usuario está logueado
// if (!(Login::estaLogeado())) {
//     // Si el usuario no está logueado, devuelve un error y termina la ejecución
//     $repo= new UsuarioRepo;
//     $method=$_SERVER['REQUEST_METHOD'];
//     header('HTTP/1.0 403 Forbidden');
//     if ($method=='POST'){
//         $action=$_POST['action'];
//         if ($action=='login') {
//             $nombreUsu=$_POST['nombre'];
//             $password=$_POST['password'];
//             $usuario=$repo->findByName($nombreUsu);

//             if ($usuario->getNombre()==$nombreUsu && $usuario->getPassword()==$password) {
//                 Login::login();
//                 echo json_encode(['status' => '200']);
//             } else{
//                 echo json_encode(['status' => 'error', 'message' => 'Usuario o contraseña incorrectos']);
//             }
//         } elseif($action=='registro') {
//             $nombreUsu=$_POST['nombre'];
//             $password=$_POST['password'];
//             // $password=$_POST['password1'];
//             // $password=$_POST['password2'];

//             $usuario = $repo->findByName($nombreUsu);

//             if ($usuario) {
//                 echo json_encode(['status' => 'error', 'message' => 'El nombre de usuario ya está en uso']);
//             } else{
//                 $nuevoUsuario = new Usuario;
//                 $nuevoUsuario->setNombre($nombreUsu);
//                 $nuevoUsuario->setPassword($password);
//                 $repo->save($nuevoUsuario);
//                 echo json_encode(['status' => '200']);
//                 //Login::login(); Si quiero que inicie sesión directamente.
//             }
//         }
        
//     }elseif ($_SERVER['REQUEST_METHOD']=='GET'){

//     }elseif ($_SERVER['REQUEST_METHOD']=='DELETE'){

//     }elseif ($_SERVER['REQUEST_METHOD']=='PUT'){
        
//     }
//     echo 'No estás autorizado para acceder a esta API.';
//     exit;
// }