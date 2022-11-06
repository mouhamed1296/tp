const updatePasswordBtn = document.getElementById("update-password");
const updateProfilePhotoForm = document.getElementById("update-photo");
const password = document.getElementById("password");
const passwordError = document.getElementById("password-error");
const newPasswordError = document.getElementById("new-password-error");
const newPassword = document.getElementById("new-password");

const checkPassword = () => {
  if (password.value === "") {
    passwordError.innerHTML =
      "<span class='text-red-500 text-sm'>Ce champ est requis</span>";
    password.classList.add("border", "border-red-500");
    return false;
  }
  passwordError.innerHTML = "";
  password.classList.add("border", "border-emerald-500");
  return true;
};

const checkNewPassword = () => {
  if (newPassword.value === "") {
    newPasswordError.innerHTML =
      "<span class='text-red-500 text-sm'>Ce champ est requis</span>";
    newPassword.classList.add("border", "border-red-500");
    return false;
  }
  if (newPassword.value === password.value) {
    newPasswordError.innerHTML =
      "<span class='text-red-500 text-sm'>Les deux mots de passe sont identique</span>";
    newPassword.classList.add("border", "border-red-500");
    return false;
  }
  newPasswordError.innerHTML = "";
  newPassword.classList.add("border", "border-emerald-500");
  return true;
};

const makeUpdate = () => {
  if (checkPassword() && checkNewPassword()) {
    fetch("updatePassword", {
      method: "POST",
      body: JSON.stringify({
        password: password.value,
        "new-password": newPassword.value,
      }),
    })
      .then((res) => res.text())
      .then((text) => {
        const serverMessageContainer = document.getElementById(
          "up-pass-server-message"
        );
        const upPassCloseModal = document.getElementById("up-pass-close-modal");

        serverMessageContainer.innerHTML =
          text !== "success"
            ? `<span class="p-2 bg-red-100 text-red-500 text-sm font-bold rounded-md">
          ${text}
          </span>`
            : `<span class="p-2 bg-emerald-100 text-emerald-500 text-sm font-bold rounded-md">
          Mot de passe modifié avec succés
          </span>`;
        setTimeout(() => {
          if (text === "success") {
            upPassCloseModal.click();
            password.value = "";
            newPassword.value = "";
          }
          serverMessageContainer.innerHTML = "";
        }, 3000);
      });
  }
};

updatePasswordBtn.addEventListener("click", (e) => {
  e.preventDefault();
  makeUpdate();
});

//update profile photo
updateProfilePhotoForm.addEventListener("submit", (e) => {
  e.preventDefault();

  const file = document.querySelector("#file_input").files[0] ?? null;
  const formData = new FormData();

  formData.append("photo", file);

  fetch("updateProfilePhoto", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.text())
    .then((text) => {
      const serverMessageContainer = document.getElementById(
        "up-photo-server-message"
      );
      const upPhotoCloseModal = document.getElementById("up-photo-close-modal");
      serverMessageContainer.innerHTML = !text.startsWith("success")
        ? `<span class="p-2 bg-red-100 text-red-500 text-sm font-bold rounded-md">
          ${text}
          </span>`
        : `<span class="p-2 bg-emerald-100 text-emerald-500 text-sm font-bold rounded-md">
          Photo modifié avec succés
          </span>`;

      setTimeout(() => {
        let profieImage = document.getElementById("profileImage");
        let modalImage = document.getElementById("modalImage");
        if (text.startsWith("success")) {
          profieImage.setAttribute(
            "src",
            `data:image/jpeg;base64,${text.split("success")[1]}`
          );
          modalImage.setAttribute(
            "src",
            `data:image/jpeg;base64,${text.split("success")[1]}`
          );
          upPhotoCloseModal.click();
        }
        serverMessageContainer.innerHTML = "";
      }, 2000);
    });
});
