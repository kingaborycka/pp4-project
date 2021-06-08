function populateRecipes(i, name) {
    console.log(i)
    const extensibleContainer = document.querySelector(".recent-recipes-container")
    const container = document.createElement("div")
    container.classList.add("recipe")
    container.style.backgroundImage = "url('photos/" + `${i}.jpg` + "')"
    
    const description = document.createElement("a")
    description.classList.add("recipe-name")
    description.innerText = name
    description.href = "recipe.php?pk=" + i

    container.appendChild(description)
    extensibleContainer.appendChild(container)
}