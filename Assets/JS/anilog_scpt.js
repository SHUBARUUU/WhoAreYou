function showContainer(buttonId, containerId) {
  document.getElementById(buttonId).addEventListener("click", function (e) {
    const container = document.getElementById(containerId);

    // Check if it's already showing BEFORE hiding others
    const isShowing = container.style.display === "block";

    // Hide all containers
    document.querySelectorAll("[id$='Container']").forEach((c) => {
      c.style.display = "none";
    });

    // Toggle: if it was showing, keep it hidden. If it was hidden, show it
    if (!isShowing) {
      container.style.display = "block";
    }
  });
}

// Use it for each button
showContainer("addBtn", "addContainer");
showContainer("updateBtn", "updateContainer");
showContainer("deleteBtn", "deleteContainer");
showContainer("searchBtn", "searchContainer");

console.log("Hello");
