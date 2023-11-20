    <div class="main-container">
    <div class="table-container">
    <div class="title-table">Exámenes Pendientes</div>
    <table>
        <!-- <thead>
            <tr>
                <th>Examen</th>
                <th>Acción</th>
            </tr>
        </thead> -->
        <tbody>
            <tr>
                <td>Nombre del examen</td>
                <td><div class="botabla"><button>Comenzar</button></div></td>
            </tr>
            <!-- Añade más filas según sea necesario -->
        </tbody>
    </table>
    </div>
    <div class="table-container">
        <div class="title-table">Exámenes Realizados</div>
    <table>
        <!-- <thead>
            <tr>
                <th>Fecha</th>
                <th>Nota</th>
                <th>Dificultad</th>
                <th>Acciones</th>
            </tr>
        </thead> -->
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
    </div>
</div>
<p class='text-center'><a href='?menu=cerrarsesion'>Cerrar sesión</a></p>
<?php
// Session::iniciaSesion();
$val = new Validacion;
if (isset($_SESSION['usuario'])) {
    // echo 'holaa';
    // Login::guardaUsuario();
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