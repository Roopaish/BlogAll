// Animating Placeholder
const inputEl = document.querySelector(".input-wrap input")
const labelEl = document.querySelector(".input-wrap label")

inputEl.addEventListener("focus", () => {
  labelEl.classList.add("shift-place")
})
inputEl.addEventListener("blur", () => {
  if (
    (inputEl.value == "" ||
    inputEl.value == null ||
    inputEl.value == undefined) 
  ) {
    labelEl.classList.remove("shift-place")
  }
})
