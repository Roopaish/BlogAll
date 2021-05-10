// Animating Placeholder
const inputEl = document.querySelectorAll(".input-wrap input")
const labelEl = document.querySelectorAll(".input-wrap label")

for (let i = 0; i < inputEl.length; i++) {
  
  inputEl[i].addEventListener("focus", () => {
    labelEl[i].classList.add("shift-place")
  })

  inputEl[i].addEventListener("blur", () => {
    if (
      inputEl[i].value == "" ||
      inputEl[i].value == null ||
      inputEl[i].value == undefined
    ) {
      labelEl[i].classList.remove("shift-place")
    }
  })

  //On page revisit
  if (
    !(
      inputEl[i].value == "" ||
      inputEl[i].value == null ||
      inputEl[i].value == undefined
    )
  ) {
    labelEl[i].classList.add("shift-place")
  }
}

//
