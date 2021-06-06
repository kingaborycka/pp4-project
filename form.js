var index = 1;

function showCategory(category) {
    //stworzenie diva z jedną kategorią
    var cat = document.createElement("div");
    var inp = document.createElement("INPUT");
    var lab = document.createElement("LABEL");
    
    inp.setAttribute("type", "checkbox");
    inp.setAttribute("id", category);
    inp.setAttribute("name", category);

    lab.setAttribute("for",category);
    lab.innerText = " "+category;

    cat.appendChild(inp);
    cat.appendChild(lab);
    document.getElementsByClassName("category-checkbox")[0].appendChild(cat);
}

function showUnit(unit) {
    //stworzenie opcji
    var o = document.createElement("OPTION");
    // var id = "units"+index;
    o.setAttribute("value", unit);
    o.innerText = unit;
    
    // document.getElementById(id).appendChild(o);
    document.getElementsByClassName("units")[0].appendChild(o);
}

const addInputButton = document.querySelector("#form-button")

function createInput(i) { 
    return `
<div class="input-wrapper">
    <input type="text" class="ingredient-text"><input type="number" class="ingredient-number">
        <select class="units" id="units`+i+`" name="units`+i+`"></select>
    <button class="delete-input-button" type="button">&#10008</button>
</div>
`
}

addInputButton.addEventListener("click", (event) =>{
    index += 1;
    var input = createInput(index)
    // var url = 'units.php';
    event.target.insertAdjacentHTML("beforebegin", input)
    
    const deleteInputButtons = document.querySelectorAll(".delete-input-button")
    deleteInputButtons.forEach(element => {
        element.addEventListener("click", (event) =>{
            event.target.parentElement.remove()
        })
    })
    
    // query = new Ajax.Request(url, {
    //     method: 'get',
    //     onSucces: getUnits()
    // })
    
})