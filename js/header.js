const menuIcon = document.querySelector(".menu-icon")
const icon = document.querySelector(".fa-solid")
const navigation = document.querySelector("nav")


menuIcon.addEventListener("click", (e) => {
    e.preventDefault()
    
    if (icon.classList[1] === "fa-bars") {
        icon.classList.remove("fa-bars")
        icon.classList.add("fa-xmark")
        navigation.style.display="block"
    } else {
        icon.classList.remove("fa-xmark")
        icon.classList.add("fa-bars")
        navigation.style.display="none"
    }
})