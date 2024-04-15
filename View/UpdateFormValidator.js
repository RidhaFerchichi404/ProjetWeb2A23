var formElement = document.getElementById("UpdateForm");
var nameElement = document.getElementById("nomEvent");
var orgElement = document.getElementById("orgEvent");
var themeElement = document.getElementById("themeEvent");
var dateElement = document.getElementById("dateEvent");
var lieuElement = document.getElementById("lieuEvent");

formElement.addEventListener("submit", function(event){
    event.preventDefault();
    validateForm();
});

function validateForm(){
    var nameValue = nameElement.value;
    var orgValue = orgElement.value;
    var themeValue = themeElement.value;
    var dateValue = dateElement.value; 
    var lieuValue = lieuElement.value;
    
    var nameError = document.getElementById("nameError");
    var orgError = document.getElementById("orgError");
    var themeError = document.getElementById("themeError");
    var dateError = document.getElementById("dateError");
    var lieuError = document.getElementById("lieuError");

    var patternName = /^[a-zA-Z]+$/;
    var patternOrg = /^[a-zA-Z]+$/;
    var patternTheme = /^[a-zA-Z]+$/;
    var patternLieu = /^[a-zA-Z]+$/;

    if(!nameValue.match(patternName)){
        nameError.innerHTML = "Name incorrect";
        nameElement.style.borderColor = "red";
    } else {
        nameError.innerHTML = "";
        nameElement.style.borderColor = "green"; 
    }

    if(!orgValue.match(patternOrg)){
        orgError.innerHTML = "Organisateur incorrect";
        orgElement.style.borderColor = "red";
    } else {
        orgError.innerHTML = "";
        orgElement.style.borderColor = "green"; 
    }

    if(!themeValue.match(patternTheme)){
        themeError.innerHTML = "Theme incorrect";
        themeElement.style.borderColor = "red";
    } else {
        themeError.innerHTML = "";
        themeElement.style.borderColor = "green"; 
    }

    if(!lieuValue.match(patternLieu)){
        lieuError.innerHTML = "Lieu incorrect";
        lieuElement.style.borderColor = "red";
    } else {
        lieuError.innerHTML = "";
        lieuElement.style.borderColor = "green"; 
    }
}