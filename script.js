var search_input = document.getElementById("search-input");

search_input.addEventListener("change", function() {
    var pattern = search_input.value;
    console.log(pattern);
} )

function recentRecipes(i,name,photo) { 
    console.log(i,name, photo);
    document.getElementsByClassName("recipe")[i].style.backgroundImage = "url('photos/"+photo+"')";
    document.getElementsByClassName("recipe_name")[i].innerHTML = name;
    document.getElementsByClassName("recipe_name")[i].href = "recipe.php?name="+name;
}

function addRecipe(){
    window.location.replace("http://v-ie.uek.krakow.pl/~s214804/pp4-project/form.php");
}

function showCategory(category) {
    //stworzenie diva z jedną kategorią
    var cat = document.createElement("div");
    var inp = document.createElement("INPUT");
    var lab = document.createElement("LABEL");
    
    inp.setAttribute("type", "checkbox");
    inp.setAttribute("id", category);
    inp.setAttribute("name", category);

    lab.setAttribute("for",category);
    lab.innerText = category;

    cat.appendChild(inp);
    cat.appendChild(lab);
    document.getElementsByClassName("category-checkbox")[0].appendChild(cat);
}

function showUnit(unit) {
    //stworzenie opcji
    var o = document.createElement("OPTION");
    o.setAttribute("value", unit);
    o.innerText = unit;
    
    document.getElementById("units").appendChild(o);
}

const addInputButton = document.querySelector("#form-button")

const input = `
<div class="input-wrapper">
    <input type="text" class="ingredient-text"><input type="number" class="ingredient-number">
        <select id="units" name="units">
            <option value="pobierz">pobierz</option>
            <option value="wartosc">wartosc</option>
            <option value="z">z</option>
            <option value="bazy">bazy</option>
        </select>
    <button class="delete-input-button" type="button">&#10008</button>
</div>
`

addInputButton.addEventListener("click", (event) =>{
    event.target.insertAdjacentHTML("beforebegin", input)
    const deleteInputButtons = document.querySelectorAll(".delete-input-button")
    deleteInputButtons.forEach(element => {
        element.addEventListener("click", (event) =>{
            event.target.parentElement.remove()
        })
    })
})