<form method="post" action="">
    <label for="usuario">Usuario:</label><br>
    <input type="text" id="usuario" name="usuario"><br>
    <label for="password">Contraseña:</label><br>
    <input type="password" id="password" name="password"><br>
    <input type="submit" name="submit" value="Iniciar sesión">
</form>
<p class='text-center'><a href='?menu=registro'>Crear una Cuenta</a></p>
<?php
    session_unset();
    Session::cierraSesion();
    $valida=new Validacion();
    $repo=new UsuarioRepo();
    if(isset($_POST['submit']))
    {
        $nomUsu=$_POST['usuario'];
        $passUsu=$_POST['password'];
        // $valida->Requerido($nomUsu); //puede generar error
        // $valida->Requerido($passUsu); //puede generar error
        echo $nomUsu;
        //Comprobamos validacion
        if($valida->ValidacionPasada())
        {
            // $usuario=null;
            $usuario=$repo->findByNamePass($nomUsu, $passUsu);
            // $repo->u($nomUsu);
            if($usuario!=null)
            {
                //echo $_SESSION['usuario'];
                Login::login($nomUsu);
                echo $nomUsu;
                echo $_SESSION['usuario'];
                $_SESSION['rol']=$usuario->getRol();

                header("location: ?menu=inicio");
                
            } else{
                echo json_encode(['error'=>'No se ha podido iniciar sesión']);
                echo $nomUsu;
            }
        }
    }
?>

<!-- <div class='w-50 p-3 container'>
    <div class='login-form'>
        <form action='' method='post' novalidate>
            <h2 class='text-center'>Identificate</h2>
            <div class='form-group'>
                <input type='text' class='form-control' name='usuario' placeholder='Usuario' required='required'>
                <= $valida->ImprimirError('usuario') ?>
            </div>
            <div class='form-group'>
                <input type='password' class='form-control' name='contrasena' placeholder='Contraseña'
                    required='required'>
                <= $valida->ImprimirError('contrasena') ?>
            </div>
            <div class='form-group'>
                <button type='submit' name='submit' class='btn btn-primary btn-block'>Logueate</button>
            </div>
            <div class='clearfix'>
                <label class='pull-left checkbox-inline'>
                    <input type='checkbox' name='recuerdame'> Recuerdame</label>
            </div>
        </form>
        <p class='text-center'><a href='?menu=registro'>Crear una Cuenta</a></p>
    </div>
</div> -->