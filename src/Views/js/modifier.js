const inscriptionBtn = document.getElementById("inscription");
inscriptionBtn.setAttribute("disabled", true);
inscriptionBtn.classList.add("opacity-50");

let nom = document.querySelector("#first-name");
let validNomText = document.querySelector("#nom-ok");
let invalidNomText = document.querySelector("#error-nom");

let prenom = document.querySelector("#last-name");
let validPrenomText = document.querySelector("#prenom-ok");
let invalidPrenomText = document.querySelector("#error-prenom");

let mail = document.querySelector("#email");
let mailExemple = document.querySelector("#mail-format");
let validMailText = document.querySelector("#email-ok");
let invalidEmailText = document.querySelector("#error-mail");
const mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

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
const resetMailValidation = () => {
  invalidEmailText.classList.add("hidden");
  invalidEmailText.classList.remove("flex");
  validMailText.classList.add("hidden");
  validMailText.classList.remove("flex");
};

const champRequis = (input, errorContainer) => {
  errorContainer.innerHTML = "Ce champ est requis veuillez le renseigner";
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
  validateField(nom, invalidPrenomText, validPrenomText);
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

const tooltip = document.getElementById("tooltip-animation");
const enableInscriptionBtn = () => {
  if (
    mail.getAttribute("data-valid") === "true" &&
    nom.getAttribute("data-valid") === "true" &&
    prenom.getAttribute("data-valid") === "true"
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
    prenom.getAttribute("data-valid") === "false"
  ) {
    inscriptionBtn.setAttribute("disabled", true);
    tooltip.classList.remove("hidden");
    tooltip.classList.add("flex");
    inscriptionBtn.classList.add("opacity-50");
  }
};

(() => {
  if (
    !mail.value.match(mailformat) ||
    mail.value === "" ||
    nom.value === "" ||
    prenom.value === ""
  ) {
    disableInscriptionBtn();
  } else {
    mail.setAttribute("data-valid", true);
    nom.setAttribute("data-valid", true);
    prenom.setAttribute("data-valid", true);
    champOk(mail, validMailText);
    champOk(nom, validNomText);
    champOk(prenom, validPrenomText);
    enableInscriptionBtn();
  }
})();

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
