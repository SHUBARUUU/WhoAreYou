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
