const searchUndrafted = document.getElementById("searchUndrafted");
const searchDrafted = document.getElementById("searchDrafted");

const debounce = (callback, wait) => {
  let timeoutId = null;
  return (...args) => {
    window.clearTimeout(timeoutId);
    timeoutId = window.setTimeout(() => {
      callback.apply(null, args);
    }, wait);
  };
};

const search = debounce(() => {
  let path = "";
  let value = "";
  if (searchDrafted) {
    path = "searchDrafted";
    value = searchDrafted.value;
  }
  if (searchUndrafted) {
    path = "searchUndrafted";
    value = searchUndrafted.value;
  }
  fetch(path, {
    method: "POST",
    body: JSON.stringify({ searchTerm: value }),
  })
    .then((res) => res.text())
    .then((text) => {
      const table = document.getElementById("list-users");
      table.innerHTML =
        text + `<span class="hidden" id='searchResults'>search results</span>`;
    });
}, 500);

if (searchUndrafted) searchUndrafted.addEventListener("keyup", search);
if (searchDrafted) searchDrafted.addEventListener("keyup", search);
