const emailInput = document.getElementById("email");
const emailInput1 = document.getElementById("email_");
const listUsers = document.getElementById("list-users");
const c = document.getElementById("cancel");
const up = document.getElementById("up");

listUsers.addEventListener("click", (e) => {
  const searchResults = document.getElementById("searchResults");
  console.log(searchResults);
  console.log(e.target.closest(".update"));
  if (
    e.target &&
    (e.target.classList.contains("archive") || e.target.id == "archiveIcon")
  ) {
    const email = e.target.closest(".archive").dataset.email;
    emailInput.setAttribute("value", email);
    if (searchResults) c.click();
  }
  if (
    e.target &&
    (e.target.classList.contains("update") || e.target.id == "updateIcon")
  ) {
    const email = e.target.closest(".update").dataset.email;
    console.log(emailInput1);
    emailInput1.setAttribute("value", email);
    if (searchResults) up.click();
  }
});
