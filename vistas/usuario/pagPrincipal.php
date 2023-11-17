    <h1>Mis Exámenes</h1>
    <h2>Exámenes Pendientes</h2>
    <table>
        <tbody>
            <tr>
                <td>Nombre del examen</td>
                <td><div class="botabla"><button>Comenzar</button></div></td>
            </tr>
        </tbody>
    </table>

    <h2>Exámenes Realizados</h2>
    <table>
        <tbody>
            <tr>
                <td>Fecha del examen</td>
                <td>Nota del examen</td>
                <td>Dificultad del examen</td>
                <td>
                    <div class="botabla">
                        <button>Reintentar</button>
                        <button>Revisión</button>
                    </div>
                    
                </td>
            </tr>
        </tbody>
    </table>

<p class='text-center'><a href='?menu=cerrarsesion'>Cerrar sesión</a></p>
<?php
$val = new Validacion;
if (isset($_SESSION['usuario'])) {

    if (!isset($_SESSION['rol'])) {
        $val->requerido('rol');
        header('Location: ?menu=login');
    } else{
        echo $_SESSION['usuario']." - ";
        echo $_SESSION['rol'];
    }
} else {
    header('Location: ?menu=login');
    echo "La sesión de usuario no está establecida.";
}