//* ==================== CONTAINER TOGGLE FUNCTIONS ====================

//* SHOW CONTAINER - displays the clicked container and hides others
function showContainer(buttonId, containerId, focusId) {
  document.getElementById(buttonId).addEventListener("click", function (e) {
    const container = document.getElementById(containerId);
    const focus = document.getElementById(focusId);

    //* Hide all containers and focus background
    document
      .querySelectorAll("[id$='OuterContainer'], #focusContent")
      .forEach((c) => {
        c.style.display = "none";
      });

    //* Show only the clicked container
    container.style.display = "grid";
    focus.style.display = "block";
  });
}

//* HIDE ALL CONTAINERS - reusable function to hide all open containers
function hideAllContainers() {
  document
    .querySelectorAll("[id$='OuterContainer'], #focusContent")
    .forEach((c) => {
      c.style.display = "none";
    });
}

//* Setup all main buttons (Add, Delete, Search)
showContainer("addBtn", "addOuterContainer", "focusContent");
showContainer("searchBtn", "searchOuterContainer", "focusContent");

//* Setup Exit buttons - closes all containers when clicked
document.querySelectorAll("[name='sbmtExit']").forEach((btn) => {
  btn.addEventListener("click", hideAllContainers);
});

//* ==================== UPDATE BUTTON LOGIC ====================

//* UPDATE BUTTON - detects which checkboxes are checked
document.getElementById("updateBtn").addEventListener("click", () => {
  detectCheckedCheckboxes("update");
});

//* DELETE BUTTON - detects which checkboxes are checked
document.getElementById("deleteBtn").addEventListener("click", () => {
  detectCheckedCheckboxes("delete");
});

//* DETECT CHECKED CHECKBOXES - validates and shows update container if exactly 1 is checked
function detectCheckedCheckboxes(clickedBtn) {
  const checkedBoxes = document.querySelectorAll(
    "input[type='checkbox'][data-list-id]:checked",
  );

  if (checkedBoxes.length === 0) {
    return;
  }

  if (checkedBoxes.length === 1 && clickedBtn === "update") {
    //* Show the update container only if 1 checkbox is selected
    hideAllContainers();
    document.getElementById("updateOuterContainer").style.display = "grid";
    document.getElementById("focusContent").style.display = "block";

    //* Get and log the selected anime ID
    checkedBoxes.forEach((checkbox) => {
      submitUpdate(checkbox.dataset.listId);
    });

    return;
  } else if (checkedBoxes.length === 1 && clickedBtn === "delete") {
    //* Show the update container only if 1 checkbox is selected
    hideAllContainers();
    document.getElementById("deleteOuterContainer").style.display = "grid";
    document.getElementById("focusContent").style.display = "block";

    checkedBoxes.forEach((checkbox) => {
      submitRemove(checkbox.dataset.listId);
    });
    return;
  }

  //* Alert if more than 1 checkbox is selected
  window.alert("Select one anime at a time..");
}

//* ==================== REWATCH TOGGLE ====================

//* REWATCH TOGGLE FUNCTION - updates label text based on checkbox state
function rewatchToggle(rewatchToggle, tLabel) {
  rewatchToggle.addEventListener("change", () => {
    tLabel.textContent = rewatchToggle.checked ? "Yes" : "No";
  });
}

//* Setup rewatch toggle for Add form
const addToggle = document.querySelector('input[name="addRewatch"]');
const addLbl = document.getElementById("addLbl");

//* Setup rewatch toggle for Update form
const updateToggle = document.querySelector('input[name="updateRewatch"]');
const updateLbl = document.getElementById("updateLbl");

rewatchToggle(addToggle, addLbl);
rewatchToggle(updateToggle, updateLbl);

//* ==================== EPISODE AND RAING INCREMENT/DECREMENT ====================

//* INCREMENT EPISODE BUTTON - increases episode count up to 50
function addE(plusBtn, episodeInput) {
  plusBtn.addEventListener("click", () => {
    if (episodeInput.value < 50) episodeInput.value++;
  });
}

//* DECREMENT EPISODE BUTTON - decreases episode count down to 1
function subtractE(minusBtn, episodeInput) {
  minusBtn.addEventListener("click", () => {
    if (episodeInput.value > 1) episodeInput.value--;
  });
}

//* INCREMENT RATING BUTTON - increases rating up to 10
function addR(plusBtn, ratingInput) {
  plusBtn.addEventListener("click", () => {
    if (ratingInput.value < 10) ratingInput.value++;
  });
}

//* DECREMENT RATING BUTTON - decreases rating down to 1
function subtractR(minusBtn, ratingInput) {
  minusBtn.addEventListener("click", () => {
    if (ratingInput.value > 1) ratingInput.value--;
  });
}

//* Add form - setup episode and rating buttons
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

//* Update form - setup episode and rating buttons
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

//* ==================== EPISODE AND RATING INPUT FIELD VALIDATION ====================

//* Checks the counter fields (episode and rating) if they are within the bounds
function isWithinBounds(errElEp, errElRate, epField, rateField) {
  const condition1 = epField.value <= 500 && epField.value >= 1 ? true : false;
  const condition2 =
    rateField.value <= 10 && rateField.value >= 1 ? true : false;

  if (condition1 && condition2) return true;

  if (!condition1) showError(errElEp, "Episode is out of bounds. (1-500)");
  else errElEp.style.display = "none";

  if (!condition2) showError(errElRate, "Rate is out of bounds. (1-10)");
  else errElRate.style.display = "none";

  return false;
}

//* ==================== VALIDATION ====================

//* VALIDATE FIELD - checks if input has value on blur event
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

//* SHOW ERROR - displays error message below input field
function showError(errorEl, message) {
  if (!errorEl) return;
  errorEl.textContent = message;
  errorEl.style.display = "block";
}

//* CHECK FIELDS VALID - validates all required fields before submission
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

//* Add form validation fields
const addAnimeTitleInp = document.getElementById("addAnimeTitle");
const addErrorTitle = document.getElementById("addTitle-err");
const addAnimeVerdictInp = document.getElementById("addAnimeVerdict");
const addErrorVerdict = document.getElementById("addVerdict-err");

//* Added fields to check if out of bounds
const addEpisodeField = document.getElementById("addEpisode");
const addRatingField = document.getElementById("addRating");

validateField(addAnimeTitleInp, addErrorTitle, "Anime Title is required.");
validateField(addAnimeVerdictInp, addErrorVerdict, "Verdict is required.");

//* Update form validation fields
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

//* ADD SUBMIT BUTTON - validates form before submission (ADD Container)
document.getElementById("sbmtAdd").addEventListener("click", (e) => {
  e.preventDefault();

  let canSubmit = isFieldsValid(
    addAnimeTitleInp,
    addAnimeVerdictInp,
    addErrorTitle,
    addErrorVerdict,
  );
  //* Gets the span tags that produces the error message
  const errElEp = document.getElementById("addEp-err");
  const errElRate = document.getElementById("addRate-err");

  //* Checks if they are within the bounds
  let canSubmit2 = isWithinBounds(
    errElEp,
    errElRate,
    addEpisodeField,
    addRatingField,
  );

  if (canSubmit && canSubmit2) {
    document.getElementById("hiddenSbmtAdd").disabled = false;
    document.querySelector("form").submit();
  }
});

//* UPDATE SUBMIT BUTTON - validates form before submission (UPDATE CONTAINER)
function submitUpdate(dataListId) {
  document.getElementById("sbmtUpdate").addEventListener("click", (e) => {
    e.preventDefault();

    let canSubmit = isFieldsValid(
      updateAnimeTitleInp,
      updateAnimeVerdictInp,
      updateErrorTitle,
      updateErrorVerdict,
    );

    //* Gets the span tags that produces the error message
    const errElEp = document.getElementById("addEp-err");
    const errElRate = document.getElementById("addRate-err");

    //* Checks if they are within the bounds
    let canSubmit2 = isWithinBounds(
      errElEp,
      errElRate,
      addEpisodeField,
      addRatingField,
    );

    if (canSubmit && canSubmit2) {
      document.getElementById("hiddenSbmtUpdate").disabled = false;
      document.getElementById("updateListId").value = dataListId;
      document.querySelector("form").submit();
    }
  });
}

//* REMOVE SUBMIT BUTTON - instantly removes the data equal to the passed value (REMOVE CONTAINER)
function submitRemove(dataListId) {
  document.getElementById("sbmtDelete").addEventListener("click", (e) => {
    e.preventDefault();

    document.getElementById("hiddenSbmtRemove").disabled = false;
    document.getElementById("removeListId").value = dataListId;
    document.querySelector("form").submit();
  });
}

//* SEARCH BUTTON - filters anime cards in real time based on title input (SEARCH CONTAINER)
//? Adds the event listener to the searchValue (input tag) -> uses "input" to detect an event (Listens for every keystroke in the search input)
document.getElementById("searchValue").addEventListener("input", (e) => {
  const term = e.target.value.toLowerCase(); //? Makes the input's value lowercased

  //? Gets the query (anime cards) and iterates each to get the h3 (title)
  document.querySelectorAll(".animeCard").forEach((card) => {
    const title = card.querySelector("h3").textContent.toLowerCase();
    card.style.display = title.includes(term) ? "" : "none";
    //? Compares the title of the card to the input value (lowercased), If found will do nothing (already showing to begin with), if not (will be hidden)
  });
});

//* ==================== ANIME CARD INTERACTIONS ====================

//* ANIME CARD CHECKBOX - toggles checkbox when card is clicked
document.querySelectorAll(".animeCard").forEach((card) => {
  card.addEventListener("click", () => {
    const cb = card.querySelector(".animeSelect");
    cb.checked = !cb.checked;
  });
});

//* CARD TITLE EXPAND - expands title text when clicked
document.querySelectorAll(".cardHeader h3").forEach((title) => {
  title.addEventListener("click", (e) => {
    e.stopPropagation();
    title.classList.toggle("expanded");
  });
});

//* VERDICT READ MORE - shows read more button if verdict text is clamped
document.querySelectorAll(".verdict").forEach((p) => {
  if (p.scrollHeight > p.clientHeight) {
    p.nextElementSibling.style.display = "block";
  }
  //* VERDICT EXPAND - toggles verdict expansion and button text
  p.nextElementSibling.addEventListener("click", (e) => {
    e.stopPropagation();
    p.classList.toggle("expanded");
    e.target.textContent = p.classList.contains("expanded")
      ? "read less"
      : "read more";
  });
});
