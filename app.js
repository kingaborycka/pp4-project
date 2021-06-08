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