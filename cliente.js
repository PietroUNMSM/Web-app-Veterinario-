/*Div de botones */
let botones = document.getElementById("botones");

let volver_boton_con = document.getElementById("volver_boton_con");
let consultar_boton = document.getElementById("consultar_boton");

let consultar_mascota = document.getElementById("consultar_mascota");

consultar_boton.addEventListener("click", function () {
    botones.style.display = "none";
    consultar_mascota.style.display = "table-cell";
    volver_boton_con.style.display = "table-row";
});

volver_boton_con.addEventListener("click", function () {
    consultar_mascota.style.display = "none";
    botones.style.display = "table-cell";
    volver_boton_con.style.display = "none";
    document.getElementById("success_request").innerHTML = "";
    $("#nombre_mascota").val("");
});

/*Formularios */
let form_cosulta = document.getElementById("form_request");

form_cosulta.addEventListener("submit", (event) => {
    event.preventDefault();
    consultar();
});

function consultar() {
    document.getElementById("success_request").innerHTML = "";
    let nombreMascota = document.getElementById("nombre_mascota").value;
    if (nombreMascota == "" || nombreMascota == null) {
        Swal.fire("Es necesario especificar un nombre");
    } else {
        $.ajax({
            url: "Consultar_perro.php",
            type: "post",
            dataType: "json",
            data: {
                nombre: nombreMascota,
                tipoConsulta: "specific",
            },
            success: function (data) {
                mostrarResultadoConsulta(data);
            },
        });
    }
}

function mostrarResultadoConsulta(data) {
    let count_result = 0;
    let table = `
    <table class="table" style="color: #fff; text-align:center;">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Raza</th>
            <th scope="col">Fecha Nac.</th>
            <th scope="col">Género</th>
            <th scope="col">Foto</th>
            </tr>
        </thead>
        <tbody>
    `;
    for (const pet of data.mascotas) {
        let genero_desc = "";
        switch (pet.genero) {
            case '0':
                genero_desc = "Hembra"
                break;
            case '1':
                genero_desc = "Macho"
                break;
        }
        table += `
                <tr>
                    <th scope="row">${++count_result}</th>
                    <td>${pet.nombre}</td>
                    <td>${pet.raza}</td>
                    <td>${pet.fechaNacimiento}</td>
                    <td>${genero_desc}</td>
                    <td><img src="${pet.foto}" alt="Girl in a jacket" width="200"></td>
                </tr>
                `;
    }
    table += `
            </tbody>
        </table>
    `;
    document.getElementById("success_request").innerHTML = table;
}

$("#all_boton_con").on("click", function (e) {
    e.preventDefault();
    $.ajax({
        url: "Consultar_perro.php",
        type: "post",
        data: {
            tipoConsulta: "all",
        },
        dataType: "json",
        success: function (data) {
            mostrarResultadoConsulta(data);
        },
    });
});

$("#logout_boton").on("click", function (e) {
    e.preventDefault();
    $.ajax({
        url: "Logout.php",
        type: "post",
        dataType: "json",
        complete: function () {
            window.location.replace("http://127.0.0.1/index.php");
        }
    });
});


/*TRIVIA CANINA - INICIO*/
let jugarTrivia_boton = document.getElementById("jugarTrivia_boton");

let div_jugar_trivia = document.getElementById("jugar_trivia");

let volver_boton_Trivia = document.getElementById("volver_boton_Trivia");

jugarTrivia_boton.addEventListener("click", function () {
    botones.style.display = "none";
    div_jugar_trivia.style.display = "block";
    volver_boton_Trivia.style.display = "table-row";
});

volver_boton_Trivia.addEventListener("click", function () {
    div_jugar_trivia.style.display = "none";
    botones.style.display = "table-cell";
    volver_boton_Trivia.style.display = "none";
});


var options = [
    {
      question: "¿Qué raza de perro tiene la lengua negra??",
      choice: ["Corgi", "Poodle", "Chow Chow", "Bulldog"],
      answer: 2,
      photo: "assets/images/chowchow.jpg"
    },
    {
      question: "Los perros tienen 3 párpados, ¿Verdadero o Falso?",
      choice: [
        "Falso",
        "Verdadero",
        "Tal vez...",
        "No sé, mano"
      ],
      answer: 1,
      photo: "assets/images/ojitoLomo.jpg"
    },
    {
      question: "¿De qué raza es Scooby Doo?",
      choice: ["Chihuahua", "Scooby", "Doberman", "Gran Danés"],
      answer: 3,
      photo: "assets/images/scooby.jpg"
    },
    {
      question: "Los perros no pueden ver en color, ¿Verdadero o Falso?",
      choice: ["Falso", "Verdadero", "Es relativo...", "No sé, mano"],
      answer: 0,
      photo: "assets/images/perroLentes.jpg"
    },
    {
      question:
        "¿Cuál de los sentidos del perro está más desarrollado?",
      choice: ["Sentido común", "Olfato", "Vista", "Todos"],
      answer: 1,
      photo: "assets/images/narizPerro.jpg"
    },
    {
      question: "¿Cómo se llama el perro de Batman?",
      choice: ["Renzo", "BatiCan", "Ace", "No tiene"],
      answer: 2,
      photo: "assets/images/Ace.jpg"
    },
    {
      question: "¿Hasta cuántas palabras puede identificar un perro?",
      choice: [
        "100 palabras",
        "300 palabras",
        "250 palabras",
        "50 palabras"
      ],
      answer: 2,
      photo: "assets/images/perroMusic.jpg"
    }
  ];

  var correctCount = 0;
  var wrongCount = 0;
  var unanswerCount = 0;
  var timer = 15;
  var intervalId;
  var userGuess = "";
  var running = false;
  var pick;
  var index = 0;

  $("#reset").hide();
  //start play
  $("#start").on("click", function() {
    $("#start").hide();
    displayQuestion();
    runTimer();
  });
  //timer start-check to make sure not running and set to running
  function runTimer() {
    if (!running) {
      intervalId = setInterval(decrement, 1000);
      running = true;
    }
  }
  //timer countdown
  function decrement() {
    $("#timecount").html("<h3>Tiempo restante: " + timer + "</h3>");
    timer--;

    //stop timer if reach 0
    if (timer === 0) {
      unanswerCount++;
      index++;
      stop();
      $("#answerbox").html(
        "<p>El Tiempo se agotó! </br>La respuesta correcta es: " +
          pick.choice[pick.answer] +
          "</p>"
      );
      hidepicture();
    }
  }

  //timer stop
  function stop() {
    running = false;
    clearInterval(intervalId);
  }

  //display question and loop though and display possible answers
  function displayQuestion() {
    pick = options[index];

    //loop through answer array and display
    $("#questionbox").html("<h2>" + pick.question + "</h2>");
    for (var i = 0; i < pick.choice.length; i++) {
      var userChoice = $("<div>");
      userChoice.addClass("answerchoice");
      userChoice.html(pick.choice[i]);
      //assign array position to it so can check answer
      userChoice.attr("data-guessvalue", i);
      $("#answerbox").append(userChoice);
    }

    //click function to select answer and outcomes
    $(".answerchoice").on("click", function() {
      userGuess = parseInt($(this).attr("data-guessvalue"));
      //increase index of question so that reads next question in array
      index++;
      //correct guess or wrong guess outcomes
      if (userGuess === pick.answer) {
        stop();
        correctCount++;
        userGuess = "";
        $("#answerbox").html("<p>Correcto!</p>");
        hidepicture();
      } else {
        stop();
        wrongCount++;
        userGuess = "";
        $("#answerbox").html(
          "<p>Incorrecto! La respuesta correcta es: " +
            pick.choice[pick.answer] +
            "</p>"
        );
        hidepicture();
      }
    });
  }

  function hidepicture() {
    $("#answerbox").append("<img src=" + pick.photo + ">");

    var hidepic = setTimeout(function() {
      $("#answerbox").empty();
      timer = 15;

      //run the score screen if all questions answered
      if (wrongCount + correctCount + unanswerCount === options.length) {
        $("#questionbox").empty();
        $("#questionbox").html("<h3>Juego Terminado!  Mira tu puntuación: </h3>");
        $("#answerbox").append("<h4> Correctas: " + correctCount + "</h4>");
        $("#answerbox").append("<h4> Incorrectas: " + wrongCount + "</h4>");
        $("#answerbox").append("<h4> Sin contestar: " + unanswerCount + "</h4>");
        $("#reset").show();
      } else {
        runTimer();
        displayQuestion();
      }
    }, 1500);
  }

  $("#reset").on("click", function() {
    $("#reset").hide();
    $("#answerbox").empty();
    $("#questionbox").empty();
    correctCount = 0;
    wrongCount = 0;
    unanswerCount = 0;
    index = 0;
    // for (var i = 0; i < holder.length; i++) {
    //   options.push(holder[i]);
    // }
    runTimer();
    displayQuestion();
  });



/*TRIVIA CANINA - FIN*/

/*PENDIENTE SCRIPT DE VER CONSULTA */

/* VER CONSULTAS - INICIO */
let verConsultas_boton = document.getElementById("verConsultas_boton");

let form_Verconsultas = document.getElementById("form_request_consultas");

let div_ver_consultas = document.getElementById("ver_consultas");

let volver_boton_VerCon = document.getElementById("volver_boton_VerCon");

verConsultas_boton.addEventListener("click", function () {
    botones.style.display = "none";
    div_ver_consultas.style.display = "table-cell";
    volver_boton_VerCon.style.display = "table-row";
});

volver_boton_VerCon.addEventListener("click", function () {
    div_ver_consultas.style.display = "none";
    botones.style.display = "table-cell";
    volver_boton_VerCon.style.display = "none";
    document.getElementById("success_request").innerHTML = "";
    $("#nombre_mascotaVerCon").val("");
});

$("#volver_boton_VerCon").on("click", function (e) {
    e.preventDefault();
    $("#botones").show();
    $("#success_request_VerConsulta").hide();
});

form_Verconsultas.addEventListener("submit", (event) => {
    event.preventDefault();
    verConsultas();
});

function verConsultas() {
    document.getElementById("success_request_VerConsulta").innerHTML = "";
    let dniPerro = document.getElementById("dni_mascotaVerCon").value;
    if (dniPerro == "" || dniPerro == null) {
        Swal.fire("Es necesario ingresar DNI de la mascota");
    } else {
        $.ajax({
            url: "Ver_consultas.php",
            type: "post",
            dataType: "json",
            data: {
                idPerro: dniPerro,
                tipoConsulta: "specific",
            },
            success: function (data) {
                mostrarResultado_VerConsulta(data);
            },
        });
    }
}

function mostrarResultado_VerConsulta(data) {
    let count_result = 0;
    let table = `
    <table class="table" style="color: #fff; text-align:center;">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">idPerro</th>
            <th scope="col">idVeterinario</th>
            <th scope="col">idCliente</th>
            <th scope="col">Sintomas</th>
            <th scope="col">Rayos-X</th>
            <th scope="col">Diagnóstico de Test Sanguíneo</th>
            <th scope="col">Medicina</th>
            <th scope="col">Costo</th>
            </tr>
        </thead>
        <tbody>
        `;
        for (const pet of data.mascotas) {
            
            table += `
                    <tr>
                        <th scope="row">${++count_result}</th>
                        <td>${pet.idPerro}</td>
                        <td>${pet.idVeterinario}</td>
                        <td>${pet.idCliente}</td>
                        <td>${pet.sintomas}</td>
                        <td><img src="${pet.x_ray}" alt="Rayos de X de lomito" width="200"></td>
                        <td>${pet.blood_test_diagnosis}</td>
                        <td>${pet.medicine}</td>
                        <td>${pet.cost}</td>
                    </tr>
                    `;
        }
        table += `
                </tbody>
            </table>
        `;
    document.getElementById("success_request_VerConsulta").innerHTML = table;
}

/* VER CONSULTAS - FIN */



