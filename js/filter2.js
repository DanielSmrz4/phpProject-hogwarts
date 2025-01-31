const input = document.querySelector(".filter-input")
const students = document.querySelectorAll(".one-student")
const studentsArray = Array.from(students)
const allStudentsList = document.querySelector(".all-students")



const studentsObjects = studentsArray.map((oneStudent, index) => {
    return {
        id: index,
        studentName: oneStudent.querySelector("h2").textContent,
        studentLink: oneStudent.querySelector("a")
    }
})

input.addEventListener("input", (e) => {
    const inputLower = input.value.toLowerCase()

    allStudentsList.innerHTML = ""
    
    studentsObjects.filter((oneStudent) => {
        if (oneStudent["studentName"].toLowerCase().includes(inputLower)) {
            
            const newH2 = document.createElement("h2")
            newH2.textContent = oneStudent["studentName"]

            const newDiv = document.createElement("div")
            newDiv.classList.add("one-student")
            newDiv.append(newH2)
            newDiv.append(oneStudent["studentLink"])
            
            allStudentsList.append(newDiv)
        }
    })
    console.log(allStudentsList);
    
})
