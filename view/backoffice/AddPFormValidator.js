var formElement = document.getElementById("AddPForm");
var nameElement = document.getElementById("NameP");
var ageElement = document.getElementById("AgeP");
var emailElement = document.getElementById("EmailP");
var eventIdElement = document.getElementById("idEP");

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
    var nameValue = nameElement.value.trim();
    var ageValue = ageElement.value.trim();
    var emailValue = emailElement.value.trim();
    var eventIdValue = eventIdElement.value.trim();
    
    var nameError = document.getElementById("nameError");
    var ageError = document.getElementById("ageError");
    var emailError = document.getElementById("emailError");
    var eventIdError = document.getElementById("idEError");

    var patternName = /^[a-zA-Z]+$/;
    var patternAge = /^\d+$/;
    var patternEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    var isValid = true; 

    if(!nameValue.match(patternName)){
        nameError.innerHTML = "Name incorrect";
        nameElement.style.borderColor = "red";
        isValid = false; 
    } else {
        nameError.innerHTML = "";
        nameElement.style.borderColor = "green"; 
    }

    if(!ageValue.match(patternAge)){
        ageError.innerHTML = "Age should be a number";
        ageElement.style.borderColor = "red";
        isValid = false;
    } else {
        ageError.innerHTML = "";
        ageElement.style.borderColor = "green"; 
    }

    if(!emailValue.match(patternEmail)){
        emailError.innerHTML = "Invalid email format";
        emailElement.style.borderColor = "red";
        isValid = false;
    } else {
        emailError.innerHTML = "";
        emailElement.style.borderColor = "green"; 
    }

    if(eventIdValue === ""){
        eventIdError.innerHTML = "Please enter an event ID";
        eventIdElement.style.borderColor = "red";
        isValid = false;
    } else {
        eventIdError.innerHTML = "";
        eventIdElement.style.borderColor = "green"; 
    }

    return isValid; 
}
