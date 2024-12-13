const toggleButton = document.getElementById("darkModeToggle");
const githubIcon = document.getElementById("github-icon");
const body = document.body;

if (localStorage.getItem("dark-mode") === "enabled") {
  body.classList.add("dark-mode");
  toggleButton.textContent = "☀️ Modo Claro";
  if(githubIcon) {
    githubIcon.src = "./images/github-mark-white.png"
  }
}

toggleButton.addEventListener("click", () => {
  body.classList.toggle("dark-mode");

  if (body.classList.contains("dark-mode")) {
    toggleButton.textContent = "☀️ Modo Claro";
    localStorage.setItem("dark-mode", "enabled");
    if(githubIcon) {
      githubIcon.src = "./images/github-mark-white.png"
    } 
  } else {
    toggleButton.textContent = "🌙 Modo Escuro";
    localStorage.setItem("dark-mode", "disabled"); 
    if(githubIcon) {
      githubIcon.src = "./images/github-mark.png"
    }
  }
});
