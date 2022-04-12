import Frame from "./formulario.js";

const frm = document.querySelector("#frm");
const campos = document.querySelectorAll(".campo");
const radios = document.querySelectorAll('input[type="radio"]');

let datos = {};

//Events
function listener() {
  frm.addEventListener("submit", (e) => {
    e.preventDefault();

    //Validte the fields
    let validationText = validateText();

    if (!datos.hasOwnProperty("typeClean") || validationText) {
      alert("All fields are requered");
      return;
    } else {
      const frame = new Frame(datos);
      frame.send();
    }
  });

  //when the user change the inputs
  campos.forEach((campo) => {
    campo.addEventListener("change", onChange);
  });

  //When the user select outside of the input
  campos.forEach((input) => {
    input.addEventListener("blur", required);
  });

  //when the user change the radios
  radios.forEach((radio) => {
    radio.addEventListener("change", onChangeRadio);
  });
}

//when a input is changed
function onChange(e) {
  datos = {
    ...datos,
    [e.target.name]: e.target.value,
  };
}

function onChangeRadio(e) {
  if (e.target.checked) {
    datos = {
      ...datos,
      typeClean: e.target.value,
    };
  }
}

// put a border in the inputs
function required(e) {
  let element = e.target;

  if (element.value === "") {
    element.classList.remove("exit");
    element.classList.add("error");
  } else {
    element.classList.remove("error");
    element.classList.add("exit");
  }
}

// only a checkbox can be selected
function onlyOne() {
  let standar = document.querySelector("#standar");
  let desinfection = document.querySelector("#desinfection");

  standar.addEventListener("change", () => {
    if (desinfection.checked) {
      desinfection.checked = false;
      datos.typeClean = desinfection.value;
    }
  });
  desinfection.addEventListener("change", () => {
    if (standar.checked) {
      standar.checked = false;
      datos.typeClean = standar.value;
    }
  });
}

//function to validate the fields
function validateText() {
  let error = false;
  campos.forEach((campo) => {
    if (campo.value.trim() === "") {
      error = true;
    }
  });

  return error;
}


//execute functions
onlyOne();
listener();
