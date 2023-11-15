// window.addEventListener("load", function () {
//     var categorias = document.getElementById("categoria");

//     async function refrescaCategorias() {
//         const d=await fetch("http://localhost/DEWESE/examinator/api/apiCategoria.php?menu=examinar")
//             const a=await d.json()
//                 for (let i = 0; i < a.length; i++) {
//                     var option = document.createElement("option");
//                     console.log(a[i]);
//                     option.value = a[i].id;  
//                     option.text = a[i].nombreCat;
//                     categorias.add(option);
//                 };
//     }

//     refrescaCategorias();
// });
