// js/script.js

document.addEventListener("DOMContentLoaded", () => {
  const form = document.querySelector("form");

  if (form) {
    form.addEventListener("submit", (e) => {
      const inputs = form.querySelectorAll("input[required]");
      let valid = true;

      inputs.forEach((input) => {
        if (!input.value.trim()) {
          valid = false;
          input.style.border = "2px solid red";
        } else {
          input.style.border = "none";
        }
      });

      if (!valid) {
        e.preventDefault();
        alert("Please fill all the fields.");
      }
    });
  }
});
