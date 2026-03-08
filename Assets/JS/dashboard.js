const btn = document.getElementById("quackBtn");

btn.onclick = function () {
  new Audio("../Assets/Sounds/duck-quack.mp3").play();
};
