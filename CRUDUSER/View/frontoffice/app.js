const form = document.querySelector("#create-account-form");
const usernameInput = document.querySelector("#nom");
const userprenameInput = document.querySelector("#prenom");
const countryInput = document.querySelector("#pays");
const emailInput = document.querySelector("#email");
const passwordInput = document.querySelector("#mdp");
const confirmPasswordInput = document.querySelector("#cmdp");
const genderSelect = document.querySelector("#sexe");
const userTypeSelect = document.querySelector("#type");
const birthDateInput = document.querySelector("#ddn"); // Add this line

form.addEventListener("submit", (event) => {
  validateForm();
  console.log(isFormValid());
  if (isFormValid() == true) {
    form.submit();
  } else {
    event.preventDefault();
  }
});

function isFormValid() {
  const inputContainers = form.querySelectorAll(".input-group");
  let result = true;
  inputContainers.forEach((container) => {
    if (container.classList.contains("error")) {
      result = false;
    }
  });
  return result;
}

function validateForm() {
  //USERNAME
  if (usernameInput.value.trim() == "") {
    setError(usernameInput, "Name can not be empty");
  } else if (
    usernameInput.value.trim().length < 5 ||
    usernameInput.value.trim().length > 15
  ) {
    setError(usernameInput, "Name must be min 5 and max 15 charecters");
  } else {
    setSuccess(usernameInput);
  }

  //USERprename
  if (userprenameInput.value.trim() == "") {
    setError(userprenameInput, "Name can not be empty");
  } else if (
    userprenameInput.value.trim().length < 5 ||
    userprenameInput.value.trim().length > 15
  ) {
    setError(userprenameInput, "Prename must be min 5 and max 15 charecters");
  } else {
    setSuccess(userprenameInput);
  }

  //COUNTRY
  if (countryInput.value.trim() == "") {
    setError(countryInput, "Country can not be empty");
  } else {
    setSuccess(countryInput);
  }

  //EMAIL
  if (emailInput.value.trim() == "") {
    setError(emailInput, "Provide email address");
  } else if (isEmailValid(emailInput.value)) {
    setSuccess(emailInput);
  } else {
    setError(emailInput, "Provide valid email address");
  }

  //PASSWORD
  if (passwordInput.value.trim() == "") {
    setError(passwordInput, "Password can not be empty");
  } else if (
    passwordInput.value.trim().length < 6 ||
    passwordInput.value.trim().length > 20
  ) {
    setError(passwordInput, "Password min 6 max 20 charecters");
  } else {
    setSuccess(passwordInput);
  }
  //CONFIRM PASSWORD
  if (confirmPasswordInput.value.trim() == "") {
    setError(confirmPasswordInput, "Password can not be empty");
  } else if (confirmPasswordInput.value !== passwordInput.value) {
    setError(confirmPasswordInput, "Password does not match");
  } else {
    setSuccess(confirmPasswordInput);
  }

  //GENDER
  if (genderSelect.value === "") {
    setError(genderSelect, "Please select a gender");
  } else {
    setSuccess(genderSelect);
  }

  //TYPE
  if (userTypeSelect.value === "") {
    setError(userTypeSelect, "Please select a user type");
  } else {
    setSuccess(userTypeSelect);
  }

  // DATE DE NAISSANCE
  if (birthDateInput.value.trim() == "") {
    setError(birthDateInput, "La date de naissance ne peut pas être vide");
  } else {
    const birthDate = new Date(birthDateInput.value);
    const currentDate = new Date();

    if (birthDate > currentDate) {
      setError(
        birthDateInput,
        "La date de naissance doit être antérieure à la date actuelle"
      );
    } else if (birthDate.getFullYear() < 2008) {
      setError(
        birthDateInput,
        "La date de naissance doit être en 2008 ou ultérieure"
      );
    } else {
      setSuccess(birthDateInput);
    }
  }
}

function setError(element, errorMessage) {
  const parent = element.parentElement;
  if (parent.classList.contains("success")) {
    parent.classList.remove("success");
  }
  parent.classList.add("error");
  const paragraph = parent.querySelector("p");
  paragraph.textContent = errorMessage;
}

function setSuccess(element) {
  const parent = element.parentElement;
  if (parent.classList.contains("error")) {
    parent.classList.remove("error");
  }
  parent.classList.add("success");
}

function isEmailValid(email) {
  const reg =
    /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;

  return reg.test(email);
}
