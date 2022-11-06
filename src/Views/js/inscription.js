const inscriptionBtn = document.getElementById("inscription");
inscriptionBtn.setAttribute("disabled", true);
inscriptionBtn.classList.add("opacity-50");

let nom = document.querySelector("#first-name");
let validNomText = document.querySelector("#nom-ok");
let invalidNomText = document.querySelector("#error-nom");

let prenom = document.querySelector("#last-name");
let validPrenomText = document.querySelector("#prenom-ok");
let invalidPrenomText = document.querySelector("#error-prenom");

let role = document.querySelector("#role");
let validRoleText = document.querySelector("#role-ok");
let invalidRoleText = document.querySelector("#error-role");

let mail = document.querySelector("#email");
let mailExemple = document.querySelector("#mail-format");
let validMailText = document.querySelector("#email-ok");
let invalidEmailText = document.querySelector("#error-mail");
const mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

let password = document.querySelector("#password");
let validPasswordText = document.querySelector("#password-ok");
let invalidPasswordText = document.querySelector("#error-password");

let confirmPassword = document.querySelector("#confirm-password");
let validConfirmPasswordText = document.querySelector("#confirm-password-ok");
let invalidConfirmPasswordText = document.querySelector(
  "#error-confirm-password"
);

nom.addEventListener("keyup", () => {
  resetNomValidation();
  validateField(nom, invalidNomText, validNomText);
  /* const name = nom.value;
  //champ vide
  if (name === "") {
    champRequis(nom, invalidNomText);
    nom.setAttribute("data-valid", false);
    disableInscriptionBtn();
    return;
  }
  champOk(nom, validNomText);
  nom.setAttribute("data-valid", true);
  enableInscriptionBtn(); */
});

const validateField = (field, errorText, successText) => {
  const fieldVal = field.value;
  //champ vide
  if (fieldVal === "") {
    champRequis(field, errorText);
    field.setAttribute("data-valid", false);
    disableInscriptionBtn();
    return;
  }
  champOk(field, successText);
  field.setAttribute("data-valid", true);
  enableInscriptionBtn();
};

prenom.addEventListener("keyup", () => {
  resetPrenomValidation();
  const firstname = prenom.value;

  //champ vide
  if (firstname === "") {
    champRequis(prenom, invalidPrenomText);
    prenom.setAttribute("data-valid", false);
    disableInscriptionBtn();
    return;
  }
  champOk(prenom, validPrenomText);
  prenom.setAttribute("data-valid", true);
  enableInscriptionBtn();
});

role.addEventListener("change", () => {
  resetRoleValidation();
  const status = role.value;

  //champ nom vide
  if (status === "") {
    champRequis(role, invalidRoleText);
    role.setAttribute("data-valid", false);
    disableInscriptionBtn();
    return;
  }
  champOk(role, validRoleText);
  role.setAttribute("data-valid", true);
  enableInscriptionBtn();
});

//controle saisie email
mail.addEventListener("focus", () => {
  resetMailValidation();
  mailExemple.classList.remove("hidden");
  mailExemple.classList.add("flex");
});
mail.addEventListener("blur", () => {
  mailExemple.classList.add("hidden");
  mailExemple.classList.remove("flex");
});
mail.addEventListener("keyup", () => {
  mailExemple.classList.add("hidden");
  mailExemple.classList.remove("flex");
  resetMailValidation();
  const email = mail.value.trim();
  //champ vide
  if (email === "") {
    champRequis(mail, invalidEmailText);
    mail.setAttribute("data-valid", false);
    disableInscriptionBtn();
    return;
  }
  //format email non respecté
  if (!email.match(mailformat)) {
    invalidEmailText.innerHTML = "Veuillez entrez une adresse email correct";
    invalidEmailText.classList.remove("hidden");
    invalidEmailText.classList.add("flex");
    mail.classList.add("border-red-500");
    mail.setAttribute("data-valid", false);
    disableInscriptionBtn();
    return;
  }

  //mail correct
  champOk(mail, validMailText);
  mail.setAttribute("data-valid", true);
  enableInscriptionBtn();
});

//controle saisie password
password.addEventListener("keyup", () => {
  resetPasswordValidation();
  const pass = password.value;
  //champ nom vide
  if (pass === "") {
    champRequis(password, invalidPasswordText);
    password.setAttribute("data-valid", false);
    disableInscriptionBtn();
    return;
  }
  champOk(password, validPasswordText);
  password.setAttribute("data-valid", true);
  enableInscriptionBtn();
});

confirmPassword.addEventListener("keyup", () => {
  resetConfirmPasswordValidation();
  const pass = confirmPassword.value;
  resetConfirmPasswordValidation();
  //champ nom vide
  if (pass === "") {
    champRequis(confirmPassword, invalidConfirmPasswordText);
    confirmPassword.setAttribute("data-valid", false);
    disableInscriptionBtn();
    return;
  }
  if (pass !== password.value) {
    NotMatchPassword(confirmPassword, invalidConfirmPasswordText);
    confirmPassword.setAttribute("data-valid", false);
    disableInscriptionBtn();
    return;
  }

  champOk(confirmPassword, validConfirmPasswordText);
  confirmPassword.setAttribute("data-valid", true);
  enableInscriptionBtn();
});

//Utility functions
const resetNomValidation = () => {
  invalidNomText.classList.add("hidden");
  invalidNomText.classList.remove("flex");
  validNomText.classList.add("hidden");
  validNomText.classList.remove("flex");
};
const resetPrenomValidation = () => {
  invalidPrenomText.classList.add("hidden");
  invalidPrenomText.classList.remove("flex");
  validPrenomText.classList.add("hidden");
  validPrenomText.classList.remove("flex");
};
const resetRoleValidation = () => {
  invalidRoleText.classList.add("hidden");
  invalidRoleText.classList.remove("flex");
  validRoleText.classList.add("hidden");
  validRoleText.classList.remove("flex");
};
const resetMailValidation = () => {
  invalidEmailText.classList.add("hidden");
  invalidEmailText.classList.remove("flex");
  validMailText.classList.add("hidden");
  validMailText.classList.remove("flex");
};
const resetPasswordValidation = () => {
  invalidPasswordText.classList.add("hidden");
  invalidPasswordText.classList.remove("flex");
  validPasswordText.classList.add("hidden");
  validPasswordText.classList.remove("flex");
};
const resetConfirmPasswordValidation = () => {
  invalidConfirmPasswordText.classList.add("hidden");
  invalidConfirmPasswordText.classList.remove("flex");
  validConfirmPasswordText.classList.add("hidden");
  validConfirmPasswordText.classList.remove("flex");
};

const champRequis = (input, errorContainer) => {
  errorContainer.innerHTML = "Ce champ est requis veuillez le renseigner";
  errorContainer.classList.remove("hidden");
  errorContainer.classList.add("flex");
  input.classList.add("border-red-500");
};

const NotMatchPassword = (input, errorContainer) => {
  errorContainer.innerHTML = "Les mots de passe ne correspondent pas";
  errorContainer.classList.remove("hidden");
  errorContainer.classList.add("flex");
  input.classList.add("border-red-500");
};

const champOk = (input, okContainer) => {
  input.classList.remove("border-red-500");
  input.classList.add("border-emerald-500");
  okContainer.classList.remove("hidden");
  okContainer.classList.add("flex");
};

const tooltip = document.getElementById("tooltip-animation");
const enableInscriptionBtn = () => {
  if (
    mail.getAttribute("data-valid") === "true" &&
    nom.getAttribute("data-valid") === "true" &&
    prenom.getAttribute("data-valid") === "true" &&
    role.getAttribute("data-valid") === "true" &&
    confirmPassword.getAttribute("data-valid") == "true"
  ) {
    inscriptionBtn.removeAttribute("disabled");
    tooltip.classList.remove("flex");
    tooltip.classList.add("hidden");
    inscriptionBtn.classList.remove("opacity-50");
  }
};

const disableInscriptionBtn = () => {
  if (
    mail.getAttribute("data-valid") === "false" ||
    nom.getAttribute("data-valid") === "false" ||
    prenom.getAttribute("data-valid") === "false" ||
    role.getAttribute("data-valid") === "false" ||
    confirmPassword.getAttribute("data-valid") === "false"
  ) {
    inscriptionBtn.setAttribute("disabled", true);
    tooltip.classList.remove("hidden");
    tooltip.classList.add("flex");
    inscriptionBtn.classList.add("opacity-50");
  }
};

const serverError = document.getElementById("server-error");
if (serverError) {
  if (
    !mail.value.match(mailformat) ||
    mail.value === "" ||
    nom.value === "" ||
    prenom.value === "" ||
    confirmPassword.value === "" ||
    password.value === "" ||
    password.value !== confirmPassword.value
  ) {
    disableInscriptionBtn();
  } else {
    mail.setAttribute("data-valid", true);
    nom.setAttribute("data-valid", true);
    prenom.setAttribute("data-valid", true);
    password.setAttribute("data-valid", true);
    confirmPassword.setAttribute("data-valid", true);
    champOk(mail, validMailText);
    champOk(nom, validNomText);
    champOk(prenom, validPrenomText);
    champOk(password, validPasswordText);
    champOk(confirmPassword, validConfirmPasswordText);
    enableInscriptionBtn();
  }
}

/* (() => {
  if (
    !mail.value.match(mailformat) ||
    mail.value === "" ||
    nom.value === "" ||
    prenom.value === "" ||
    confirmPassword.value === "" ||
    password.value === "" ||
    password.value !== confirmPassword.value
  ) {
    disableInscriptionBtn();
  } else {
    mail.setAttribute("data-valid", true);
    nom.setAttribute("data-valid", true);
    prenom.setAttribute("data-valid", true);
    password.setAttribute("data-valid", true);
    confirmPassword.setAttribute("data-valid", true);
    champOk(mail, validMailText);
    champOk(nom, validNomText);
    champOk(prenom, validPrenomText);
    champOk(password, validPasswordText);
    champOk(confirmPassword, validConfirmPasswordText);
    enableInscriptionBtn();
  }
})(); */

const passwordHandler = document.getElementById("password-handler");
passwordHandler.addEventListener("click", () => {
  resetPasswordValidation();
  const pass = password.value;
  resetPasswordValidation();
  //champ nom vide
  if (pass === "") {
    champRequis(password, invalidPasswordText);
    password.setAttribute("data-valid", false);
    disableInscriptionBtn();
    return;
  }
  if (passwordHandler.classList.contains("fa-eye")) {
    passwordHandler.classList.remove("fa-eye");
    passwordHandler.classList.add("fa-eye-slash");
    password.setAttribute("type", "text");
  } else {
    passwordHandler.classList.remove("fa-eye-slash");
    passwordHandler.classList.add("fa-eye");
    password.setAttribute("type", "password");
  }
});

const confirmPasswordHandler = document.getElementById(
  "confirm-password-handler"
);
confirmPasswordHandler.addEventListener("click", () => {
  resetConfirmPasswordValidation();
  const pass = confirmPassword.value;
  resetConfirmPasswordValidation();
  //champ nom vide
  if (pass === "") {
    champRequis(confirmPassword, invalidPasswordText);
    confirmPassword.setAttribute("data-valid", false);
    disableInscriptionBtn();
    return;
  }
  if (confirmPasswordHandler.classList.contains("fa-eye")) {
    confirmPasswordHandler.classList.remove("fa-eye");
    confirmPasswordHandler.classList.add("fa-eye-slash");
    confirmPassword.setAttribute("type", "text");
  } else {
    confirmPasswordHandler.classList.remove("fa-eye-slash");
    confirmPasswordHandler.classList.add("fa-eye");
    confirmPassword.setAttribute("type", "password");
  }
});

const successModal = document.getElementById("popup-modal");
if (successModal) {
  const showModal = document.getElementById("toggle-modal");
  showModal.click();
}

/* setTimeout(
  (function () {
    let reussie = document.getElementById("inscription_success");
    if (reussie) {
      window.location.replace("http://localhost/tp/");
    }
  })(),
  3000
); */
