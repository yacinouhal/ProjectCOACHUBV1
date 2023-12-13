// Question 1
function validerDateReservation() {
  var dateMatchInput = document.getElementById("date_reservation");
  var dateMatchValeur = dateMatchInput.value;
  var minDate = "2023-09-01";
  var maxDate = "2023-12-30";

  if (dateMatchValeur < minDate || dateMatchValeur > maxDate) {
    alert(
      "La date du match doit être comprise entre le 1er septembre 2023 et le 30 décembre 2023."
    );
    return false;
  } else {
    return true;
  }
}

// Question 2
const form = document.getElementById("form");

const nomInput = document.getElementById("nom");
const prenomInput = document.getElementById("prenom");
const telephoneInput = document.getElementById("telephone");
const dateMatchInput = document.getElementById("date_reservation");

form.addEventListener("submit", function (event) {
  if (
    validerNom() &&
    validerPrenom() &&
    validerTelephone() &&
    validerDateReservation()
  ) {
    // All validation passed, allow the form to be submitted
    return true;
  } else {
    // Prevent the form submission
    event.preventDefault();
    return false;
  }
});

function validerNom() {
  const nomValeur = nomInput.value;
  const nomRegex = /^[A-Za-z]+$/;
  const erreurNom = document.getElementById("erreurNom");

  if (!nomValeur.match(nomRegex)) {
    erreurNom.innerHTML = "Veuillez entrer un nom valide (lettres uniquement)";
    return false;
  } else {
    return true;
  }
}

function validerPrenom() {
  const prenomValeur = prenomInput.value;
  const prenomRegex = /^[A-Za-z]+$/;
  const erreurPrenom = document.getElementById("erreurPrenom");

  if (!prenomValeur.match(prenomRegex)) {
    erreurPrenom.innerHTML =
      "Veuillez entrer un prénom valide (lettres uniquement)";
    return false;
  } else {
    return true;
  }
}

function validerTelephone() {
  const telephoneValeur = telephoneInput.value;
  const telephoneRegex = /^[0-9]{8}$/;
  const erreurTelephone = document.getElementById("erreurTelephone");

  if (!telephoneValeur.match(telephoneRegex)) {
    erreurTelephone.innerHTML =
      "Veuillez entrer un numéro de téléphone valide (8 chiffres)";
    return false;
  } else {
    return true;
  }
}

// Ensure the form is submitted if all validations pass
form.addEventListener("submit", function (event) {
  if (
    validerNom() &&
    validerPrenom() &&
    validerTelephone() &&
    validerDateReservation()
  ) {
    // Allow the form to be submitted
    return true;
  } else {
    // Prevent the form submission
    event.preventDefault();
    return false;
  }
});

// Question
const emailInput = document.getElementById("email");
const erreurEmail = document.getElementById("erreurEmail");

emailInput.addEventListener("keyup", function () {
  validerEmail();
});

function validerEmail() {
  const emailValeur = emailInput.value.trim();
  const emailRegex = /^\S+@esprit.tn+$/;

  if (!emailValeur.match(emailRegex)) {
    erreurEmail.innerHTML = "Veuillez entrer une adresse email valide";
    return false;
  } else {
    return true;
  }
}
