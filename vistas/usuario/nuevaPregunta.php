<div id="nuevaPregunta">
    <form action="" method="post">
        <input type="text" id="idPreg" style="display: none;">
        <p>Enunciado</p>
        <textarea name="" id="enunciado" cols="90" rows="3" maxlength="200"></textarea>
        <p>Respuesta 1</p>
        <textarea name="" id="resp1" cols="90" rows="3" maxlength="200"></textarea>
        <p>Respuesta 2</p>
        <textarea name="" id="resp2" cols="90" rows="3" maxlength="200"></textarea>
        <p>Respuesta 3</p>
        <textarea name="" id="resp3" cols="90" rows="3" maxlength="200"></textarea>
        <select id="correcta">
            <option disabled selected>Selecciona la opción correcta</option>
            <option id="op1"></option>
            <option id="op2"></option>
            <option id="op3"></option>
        </select>
        <select id="categoria">
            <option disabled selected>Selecciona la categoría</option>
        </select>
        <select id="dificultad">
        <option disabled selected>Selecciona la dificultad</option>
        </select>
        <!-- <input type="radio" id="respuesta1" name="respuesta" value="resp1">
        <label for="resp1">Respuesta 1</label><br>
        <input type="radio" id="respuesta2" name="respuesta" value="resp2">
        <label for="resp2">Respuesta 2</label><br>
        <input type="radio" id="respuesta3" name="respuesta" value="resp3">
        <label for="resp3">Respuesta 3</label> -->
        <p>Ruta o URL del recurso multimedia</p>
        <input type="text" id="url">
        <select id="tipoUrl">
            <option disabled selected>Selecciona tipo de multimedia</option>
            <option value="img">Imagen</option>
            <option value="video">Video</option>
        </select>
    </form>
    <button id="btnLimpiar">Limpiar</button>
    <button id="btnBorrar">Borrar</button>
    <button id="btnGuardar">Guardar</button>
</div>
<div id="preguntas">

</div>