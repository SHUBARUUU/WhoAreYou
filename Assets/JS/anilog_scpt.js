function showContainer(buttonId, containerId, focusId) {
  document.getElementById(buttonId).addEventListener("click", function (e) {
    const container = document.getElementById(containerId);
    const focus = document.getElementById(focusId);

    // Hide all containers AND focus bg
    document
      .querySelectorAll("[id$='OuterContainer'], #focusContent")
      .forEach((c) => {
        c.style.display = "none";
      });

    // Show the clicked one
    container.style.display = "grid";
    focus.style.display = "block";
  });
}

// Setup Exit buttons
document.querySelectorAll("[name='sbmtExit']").forEach((btn) => {
  btn.addEventListener("click", function () {
    // Hide all containers AND focus bg
    document
      .querySelectorAll("[id$='OuterContainer'], #focusContent")
      .forEach((c) => {
        c.style.display = "none";
      });
  });
});

// Use it for each button
showContainer("addBtn", "addOuterContainer", "focusContent");
showContainer("updateBtn", "updateOuterContainer", "focusContent");
showContainer("deleteBtn", "deleteOuterContainer", "focusContent");
showContainer("searchBtn", "searchOuterContainer", "focusContent");

function rewatchToggle(rewatchToggle, tLabel) {
  rewatchToggle.addEventListener("change", () => {
    tLabel.textContent = rewatchToggle.checked ? "Yes" : "No";
  });
}

const addToggle = document.querySelector('input[name="addRewatch"]');
const addLbl = document.getElementById("addLbl");

const updateToggle = document.querySelector('input[name="updateRewatch"]');
const updateLbl = document.getElementById("updateLbl");

rewatchToggle(addToggle, addLbl);
rewatchToggle(updateToggle, updateLbl);

//* TOGGLE INCREMENT AND DECREMENT OF + or - SIGN
function addE(plusBtn, episodeInput) {
  plusBtn.addEventListener("click", () => {
    if (episodeInput.value < 50) episodeInput.value++;
  });
}

function subtractE(minusBtn, episodeInput) {
  minusBtn.addEventListener("click", () => {
    if (episodeInput.value > 1) episodeInput.value--;
  });
}

function addR(plusBtn, ratingInput) {
  plusBtn.addEventListener("click", () => {
    if (ratingInput.value < 10) ratingInput.value++;
  });
}

function subtractR(minusBtn, ratingInput) {
  minusBtn.addEventListener("click", () => {
    if (ratingInput.value > 1) ratingInput.value--;
  });
}

//* Add form
addE(
  document.getElementById("epPlus"),
  document.querySelector('input[name="addEpisode"]'),
);
subtractE(
  document.getElementById("epMinus"),
  document.querySelector('input[name="addEpisode"]'),
);
addR(
  document.getElementById("ratePlus"),
  document.querySelector('input[name="addRating"]'),
);
subtractR(
  document.getElementById("rateMinus"),
  document.querySelector('input[name="addRating"]'),
);

//* Update form
addE(
  document.getElementById("updateEpPlus"),
  document.querySelector('input[name="updateEpisode"]'),
);
subtractE(
  document.getElementById("updateEpMinus"),
  document.querySelector('input[name="updateEpisode"]'),
);
addR(
  document.getElementById("updateRatePlus"),
  document.querySelector('input[name="updateRating"]'),
);
subtractR(
  document.getElementById("updateRateMinus"),
  document.querySelector('input[name="updateRating"]'),
);

//* Validation Checker per Fields
//* Add field (container)
const addAnimeTitleInp = document.getElementById("addAnimeTitle");
const addErrorTitle = document.getElementById("addTitle-err");

const addAnimeVerdictInp = document.getElementById("addAnimeVerdict");
const addErrorVerdict = document.getElementById("addVerdict-err");

validateField(addAnimeTitleInp, addErrorTitle, "Anime Title is required.");
validateField(addAnimeVerdictInp, addErrorVerdict, "Verdict is required.");

//* Update field (container)
const updateAnimeTitleInp = document.getElementById("updateAnimeTitle");
const updateErrorTitle = document.getElementById("updateTitle-err");

const updateAnimeVerdictInp = document.getElementById("updateAnimeVerdict");
const updateErrorVerdict = document.getElementById("updateVerdict-err");

validateField(
  updateAnimeTitleInp,
  updateErrorTitle,
  "Anime Title is required.",
);
validateField(
  updateAnimeVerdictInp,
  updateErrorVerdict,
  "Verdict is required.",
);

//* Submits the form if all fields are validated (has value)
document.getElementById("sbmtAdd").addEventListener("click", (e) => {
  e.preventDefault();

  let canSubmit = isFieldsValid(
    addAnimeTitleInp,
    addAnimeVerdictInp,
    addErrorTitle,
    addErrorVerdict,
  );

  if (canSubmit) {
    document.getElementById("hiddenSbmtAdd").disabled = false;
    document.querySelector("form").submit();
  }
});

//* Checks the button for submit (Add container)
function isFieldsValid(inputTitle, inputVerdict, errorElT, errorElV) {
  if (!inputTitle.value || !inputVerdict.value) {
    if (!inputTitle.value) {
      showError(errorElT, "Anime Title is required.");
    }

    if (!inputVerdict.value) {
      showError(errorElV, "Anime Verdict is required.");
    }
    return false;
  }

  return true;
}

function showError(errorEl, message) {
  if (!errorEl) return;
  errorEl.textContent = message;
  errorEl.style.display = "block";
}

function validateField(input, errorEl, message) {
  if (!input || !errorEl) return;
  input.addEventListener("blur", function () {
    if (!input.value) {
      showError(errorEl, message);
    } else {
      errorEl.style.display = "none";
    }
  });
}

//* Helps with the checkboxes for every anime cards
document.querySelectorAll(".animeCard").forEach((card) => {
  card.addEventListener("click", () => {
    const cb = card.querySelector(".animeSelect");
    cb.checked = !cb.checked;
  });
});

//* Assists the design for anime cards -> detects the clicks to expand the card for long TITLES
document.querySelectorAll(".cardHeader h3").forEach((title) => {
  title.addEventListener("click", (e) => {
    e.stopPropagation(); // prevent card checkbox from toggling
    title.classList.toggle("expanded");
  });
});

document.querySelectorAll(".verdict").forEach((p) => {
  if (p.scrollHeight > p.clientHeight) {
    p.nextElementSibling.style.display = "block"; // show "read more" only if clamped
  }
  p.nextElementSibling.addEventListener("click", (e) => {
    e.stopPropagation();
    p.classList.toggle("expanded");
    e.target.textContent = p.classList.contains("expanded")
      ? "read less"
      : "read more";
  });
});
