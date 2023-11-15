window.addEventListener("load", function () {
    refrescaPreguntas();
    refrescaCategorias();
    refrescaDificultades();
    rellenaPregunta();
    btnGuardar=document.getElementById("btnGuardar");
    btnGuardar.addEventListener("click", guardaPregunta);
    btnLimpiar=document.getElementById("btnLimpiar");
    btnLimpiar.addEventListener("click", limpiaPregunta)
    btnBorrar = document.getElementById("btnBorrar");
    btnBorrar.addEventListener("click", borraPregunta);

})