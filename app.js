// Animating Placeholder
const inputEl = document.querySelectorAll(".input-wrap input, .input-wrap textarea")
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

// New Blog
const newBlogBtn = document.getElementById('newBlogBtn');
const newblog = document.getElementById('newblog');
newBlogBtn.addEventListener('click',()=>{
  newblog.classList.toggle('hide');
})

// prevent form submission message
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}