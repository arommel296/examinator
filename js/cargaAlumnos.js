window.addEventListener("load", function () {
    //var preguntas = document.getElementById("preguntas");
    var alumnos = document.getElementById("alumnos");
    // this.document.appendChild(alumnos);


    async function refrescaAlumnos() {
        while (alumnos.firstChild) {
            alumnos.removeChild(alumnos.firstChild);
        }

        fetch("http://localhost/DEWESE/examinator/plantillas/alumno.html")
            .then(x => x.text())
            .then(async y => {
                var contenedor = document.createElement("div");
                contenedor.innerHTML = y;
                var alumno = contenedor.firstChild;

                // fetch("http://localhost/DEWESE/examinator/api/apiAlumno.php?menu=examinar")
                //     .then(x => console.log(x.json())) // Parsea la respuesta como JSON
                //     .then(y => {
                //         console.log(y)
                //         for (let i = 0; i < y.length; i++) {
                //             var nuevoAlumno = alumno.cloneNode(true);
                //             nuevoAlumno.querySelector(".usuario").innerHTML = y.nombre;
                //             alumnos.appendChild(nuevoAlumno);
                //         };
                //     })
                //     .catch(error => {
                //         console.error('Error al obtener datos de alumnos:', error);
                //     });

                const d=await fetch("http://localhost/DEWESE/examinator/api/apiAlumno.php?menu=examinar")
                    const a=await d.json()
                    for (let i = 0; i < a.length; i++) {
                        console.log(a[i].nombre);
                                    var nuevoAlumno = alumno.cloneNode(true);
                                    nuevoAlumno.querySelector(".usuario").innerHTML = a[i].nombre;
                                    alumnos.appendChild(nuevoAlumno);
                                };

            })
            .catch(error => {
                console.error('Error al obtener plantilla de alumno:', error);
            });
    }

    refrescaAlumnos();
});


// window.addEventListener("load", function () {
//     var preguntas = document.getElementById("preguntas");
//     var alumnos = document.getElementById("alumnos");

//     function refrescaAlumnos() {
//         while (alumnos.firstChild) {
//             alumnos.removeChild(alumnos.firstChild);
//         }
//         fetch("./plantillas/alumno.html")
//             .then(x => x.text())
//             .then(y => {
//                 console.log(y);
//                 var contenedor = document.createElement("div");
//                 contenedor.innerHTML = y;
//                 var alumno = contenedor.firstChild;

//                 fetch("./api/apiAlumno.php")
//                     .then(x => x.text())
//                     .then(y => {
//                         i=0;
//                         var alumAux = alumno.cloneNode(true);
//                         alumAux.getElementsByClassName("usuario").innerHTML = y.nombre;
//                         // datos.forEach(alu => {
//                         //     var alumAux = alumno.cloneNode(true);
//                         //     alumAux.getElementsByClassName("usuario").innerHTML = datos[i].nombre;
//                         //     i++;
//                         // });
//                     });
//             });
//     }

//     refrescaAlumnos();
// });



// window.addEventListener("load", function () {
//     var preguntas=document.getElementById("preguntas");
//     var alumnos=document.getElementById("alumnos");

//     function refrescaAlumnos() {
//         while (alumnos.firstChild) {
//             alumnos.removeChild(alumnos.firstChild);
//         }
//         fetch("htttp://localhost/dewese/examinator/plantillas/alumno.html")
//             .then(x=>x.text())
//             .then(y=>{
//                 while (alumnos.nextElementSibling) {
//                     alumnos.parentNode.insertBefore(alumnos.nextElementSibling, alumnos);
//                 }
//                 fetch("htttp://localhost/plantillas/alumno.html")
//                 .then(x=x.json())
//                 .then(y=>{
//                     var aluAux = alumnos.cloneNode(true);
//                 })

//             })
//     }
// })