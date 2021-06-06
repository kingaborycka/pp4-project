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

