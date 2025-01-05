const password1 = document.querySelector(".password-first")
const password2 = document.querySelector(".password-second")
const paragraphText = document.querySelector(".result-text")

password1.addEventListener("input", (e) => {
    e.preventDefault()
    const password1Value = password1.value
    const password2Value = password2.value

    if (password1Value && password2Value) {
        if (password1Value === password2Value) {
            paragraphText.textContent = "Hesla se shodují"
            paragraphText.classList.add("valid")
            paragraphText.classList.remove("invalid")
        } else {
            paragraphText.textContent = "Hesla se neshodují"
            paragraphText.classList.add("invalid")
            paragraphText.classList.remove("valid")
        }
    } else {
        paragraphText.textContent = ""
    }   
})

password2.addEventListener("input", (e) => {
    e.preventDefault()
    const password1Value = password1.value
    const password2Value = password2.value

    if (password1Value && password2Value) {
        if (password1Value === password2Value) {
            paragraphText.textContent = "Hesla se shodují"
            paragraphText.classList.add("valid")
            paragraphText.classList.remove("invalid")
        } else {
            paragraphText.textContent = "Hesla se neshodují"
            paragraphText.classList.add("invalid")
            paragraphText.classList.remove("valid")
        }
    } else {
        paragraphText.textContent = ""
    }   
})
