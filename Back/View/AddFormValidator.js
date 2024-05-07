var formElement = document.getElementById("AddForm");
var nameElement = document.getElementById("NameEv");
var orgElement = document.getElementById("OrgEv");
var themeElement = document.getElementById("ThemeEv");
var dateElement = document.getElementById("DateEv");
var lieuElement = document.getElementById("LieuEv");
var NbPartEvElement = document.getElementById("NbPartEv");

formElement.addEventListener("submit", function(event){
    // Validate the form
    var isValid = validateForm();

    // If the form is valid, submit it
    if(isValid) {
        return true;
    } else {
        // Prevent default form submission if validation fails
        event.preventDefault();
        return false;
    }
});

function validateForm(){
    var nameValue = nameElement.value;
    var orgValue = orgElement.value;
    var themeValue = themeElement.value;
    var dateValue = dateElement.value; 
    var lieuValue = lieuElement.value;
    var NbPartEvValue = NbPartEvElement.value;
    
    var nameError = document.getElementById("nameError");
    var orgError = document.getElementById("orgError");
    var themeError = document.getElementById("themeError");
    var dateError = document.getElementById("dateError");
    var lieuError = document.getElementById("lieuError");
    var NbPartEvError = document.getElementById("PartError");

    var patternName = /^[a-zA-Z]+$/;
    var patternOrg = /^[a-zA-Z]+$/;
    var patternTheme = /^[a-zA-Z]+$/;
    var patternLieu = /^[a-zA-Z]+$/;
    var patternNbPartEv = /^[1-9]\d*$/;

    var isValid = true; 

    if(!nameValue.match(patternName)){
        nameError.innerHTML = "Name incorrect";
        nameElement.style.borderColor = "red";
        isValid = false; 
    } else {
        nameError.innerHTML = "";
        nameElement.style.borderColor = "green"; 
    }

    if(!orgValue.match(patternOrg)){
        orgError.innerHTML = "Organisateur incorrect";
        orgElement.style.borderColor = "red";
        isValid = false;
    } else {
        orgError.innerHTML = "";
        orgElement.style.borderColor = "green"; 
    }

    if(!themeValue.match(patternTheme)){
        themeError.innerHTML = "Theme incorrect";
        themeElement.style.borderColor = "red";
        isValid = false;
    } else {
        themeError.innerHTML = "";
        themeElement.style.borderColor = "green"; 
    }

    if(dateValue === ""){
        dateError.innerHTML = "Please select a date";
        dateElement.style.borderColor = "red";
        isValid = false;
    } else {
        dateError.innerHTML = "";
        dateElement.style.borderColor = "green"; 
    }

    if(!lieuValue.match(patternLieu)){
        lieuError.innerHTML = "Lieu incorrect";
        lieuElement.style.borderColor = "red";
        isValid = false;
    } else {
        lieuError.innerHTML = "";
        lieuElement.style.borderColor = "green"; 
    }

    if(!NbPartEvValue.match(patternNbPartEv)){
        NbPartEvError.innerHTML = "Number of max participants must be a positive number";
        NbPartEvElement.style.borderColor = "red";
        isValid = false;
    } else {
        NbPartEvError.innerHTML = "";
        NbPartEvElement.style.borderColor = "green"; 
    }

    return isValid; 
}
