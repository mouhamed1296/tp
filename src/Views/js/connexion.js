let connexionBtn = document.getElementById("connexion");
connexionBtn.setAttribute("disabled", true);
connexionBtn.classList.add("opacity-50");
const credentials = {
  email: "",
  password: "",
};

let mail = document.querySelector("#mail");
let mailExemple = document.querySelector("#mail-format");
let validMailText = document.querySelector("#email-ok");
let invalidEmailText = document.querySelector("#error-mail");
const mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

let password = document.querySelector("#password");
let validPasswordText = document.querySelector("#password-ok");
let invalidPasswordText = document.querySelector("#error-password");

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
    disableConnexionBtn();
    return;
  }
  //format email non respecté
  if (!email.match(mailformat)) {
    invalidEmailText.innerHTML = "Veuillez entrez une adresse email correct";
    invalidEmailText.classList.remove("hidden");
    invalidEmailText.classList.add("flex");
    mail.classList.add("border-red-500");
    mail.setAttribute("data-valid", false);
    disableConnexionBtn();
    return;
  }

  //mail correct
  champOk(mail, validMailText);
  mail.setAttribute("data-valid", true);
  enableConnexionBtn();
});

//controle saisie password
password.addEventListener("keyup", () => {
  resetPasswordValidation();
  const pass = password.value;
  resetPasswordValidation();
  //champ nom vide
  if (pass === "") {
    champRequis(password, invalidPasswordText);
    password.setAttribute("data-valid", false);
    disableConnexionBtn();
    return;
  } else {
    champOk(password, validPasswordText);
    password.setAttribute("data-valid", true);
    enableConnexionBtn();
  }
});

//Utility functions
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

const champRequis = (input, errorContainer) => {
  errorContainer.innerHTML = "Ce champ est requis veuillez le renseigner";
  errorContainer.classList.remove("hidden");
  errorContainer.classList.add("flex");
  input.classList.add("border-red-500");
};

const champOk = (input, okContainer) => {
  input.classList.add("border-emerald-500");
  okContainer.classList.remove("hidden");
  okContainer.classList.add("flex");
};

const enableConnexionBtn = () => {
  if (
    mail.getAttribute("data-valid") === "true" &&
    password.getAttribute("data-valid") == "true"
  ) {
    connexionBtn.removeAttribute("disabled");
    connexionBtn.classList.remove("opacity-50");
  }
};

const disableConnexionBtn = () => {
  if (
    mail.getAttribute("data-valid") === "false" ||
    password.getAttribute("data-valid") === "false"
  ) {
    connexionBtn.setAttribute("disabled", true);
    connexionBtn.classList.add("opacity-50");
  }
};
