function representRecipe(title,description,portions,nick) {
    const recipeTitle = document.querySelector(".recipe-title")
    recipeTitle.innerText = title
    const recipeDescription = document.querySelector(".recipe-description")
    recipeDescription.innerText = description
    const recipePortions = document.querySelector(".recipe-portions")
    recipePortions.innerText = "/ "+portions+" porcje"
    const recipeNick = document.querySelector(".recipe-nick")
    recipeNick.innerText = nick
}
function renderCategory(category) {
    const categoriesContainer = document.querySelector(".categories-container")
    const categoryPara = document.createElement("p")
    categoryPara.classList.add("category")
    categoryPara.innerText = category.toUpperCase()
    categoriesContainer.appendChild(categoryPara)
}
function renderIngredient(ingredient, volume, unit) {
    const ingredientsContainer = document.querySelector(".ingredients-list")
    var ingredientEl = document.createElement("li")
    if (unit.endsWith("/i")){
        unit = unit.slice(0, -2)
    }
    ingredientEl.classList.add("ingredient")
    ingredientEl.textContent = ingredient +" - "+ volume +" "+ unit
    ingredientsContainer.appendChild(ingredientEl)
}