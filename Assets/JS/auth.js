//* Client side verifation

//* ========== Log in page verifier ========== (Validates inputs)
const loginEmailInp = document.getElementById("emailL");
const errorEmailL = document.getElementById("email-errorL");

const loginPassInp = document.getElementById("passL");
const errorPassL = document.getElementById("pass-errorL");

// then just call it for each field
validateField(loginEmailInp, errorEmailL, "Email is required");

validateField(loginPassInp, errorPassL, "Password is required");

const login = document.getElementById("sbmtL");
if (login) {
  login.addEventListener("click", function (e) {
    const mailVal = loginEmailInp.value;
    const passVal = loginPassInp.value;

    if (!mailVal || !passVal) {
      e.preventDefault();
    }
  });
}

//* ========== Register page verifier ==========   (Validates inputs)

const registerUsernameInp = document.getElementById("usernameR");
const errorUsernameR = document.getElementById("username-errorR");

const registerEmailInp = document.getElementById("emailR");
const errorEmailR = document.getElementById("email-errorR");

const registerPassInp = document.getElementById("passR");
const errorPassR = document.getElementById("pass-errorR");

validateField(registerUsernameInp, errorUsernameR, "Username is required");

validateField(registerEmailInp, errorEmailR, "Email is required");

validateField(registerPassInp, errorPassR, "Password is required");

const register = document.getElementById("sbmtR");
if (register) {
  register.addEventListener("click", function (e) {
    const usernameVal = registerUsernameInp.value;
    const mailVal = registerEmailInp.value;
    const passVal = registerPassInp.value;
    const chckBxVal = document.getElementById("chckBx");

    const chckBxUnchecked = document.getElementById("chckBx-unchecked");

    if (!usernameVal || !mailVal || !passVal) {
      e.preventDefault();

      if (!usernameVal) showError(errorUsernameR, "Username is required.");

      if (!mailVal) showError(errorEmailR, "Email is required.");

      if (!passVal) showError(errorPassR, "Password is required.");
    }

    if (usernameVal.match("[^a-zA-Z0-9_]")) {
      showError(errorUsernameR, "Field cannot have invalid character.");
      e.preventDefault();
    }

    if (!mailVal.match(".*@.*") && mailVal) {
      showError(errorEmailR, "@ is missing.");
      e.preventDefault();
    }

    if (!chckBxVal.checked) {
      chckBxUnchecked.style.visibility = "visible";
      chckBxUnchecked.textContent = "Please Accept the terms.";
      e.preventDefault();
    } else {
      document.getElementById("chckBx-unchecked").style.visibility = "hidden";
    }
  });
}

function validateField(input, errorEl, message) {
  if (!input || !errorEl) return;

  input.addEventListener("blur", function () {
    if (!input.value) {
      showError(errorEl, message);
    } else {
      errorEl.style.visibility = "hidden";
    }
  });
}

function showError(errorEl, message) {
  if (!errorEl) return;
  errorEl.textContent = message;
  errorEl.style.visibility = "visible";
}
