// 年を自動表示
document.getElementById("year").textContent = new Date().getFullYear().toString();

// ダークモード切替
const btn = document.getElementById("themeToggle");
btn.addEventListener("click", () => {
  const pressed = btn.getAttribute("aria-pressed") === "true";
  btn.setAttribute("aria-pressed", String(!pressed));
  document.body.classList.toggle("dark");
});