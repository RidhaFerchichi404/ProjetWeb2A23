var formElement = document.getElementById("participationForm");
var nameElement = document.getElementById("nomPart");
var ageElement = document.getElementById("agePart");
var emailElement = document.getElementById("emailPart");

formElement.addEventListener("submit", function(event){

    var isValid = validateForm();

    if(isValid) {
        return true;
    } else {
        event.preventDefault();
        return false;
    }
});

function validateForm(){
    var nameValue = nameElement.value;
    var ageValue = ageElement.value;
    var emailValue = emailElement.value;

    var nameError = document.getElementById("nameError");
    var ageError = document.getElementById("ageError");
    var emailError = document.getElementById("emailError");

    var nameRegex = /^[a-zA-Z]+$/;
    var ageRegex = /^[0-9]+$/;

    var isValid = true;

    if(!nameRegex.test(nameValue)){
        nameError.innerHTML = "Please enter a valid name with only characters.";
        nameElement.style.borderColor = "red";
        isValid = false;
    } else {
        nameError.innerHTML = "";
        nameElement.style.borderColor = "green";
    }

    if(!ageRegex.test(ageValue)){
        ageError.innerHTML = "Please enter a valid age with only numbers.";
        ageElement.style.borderColor = "red";
        isValid = false;
    } else {
        ageError.innerHTML = "";
        ageElement.style.borderColor = "green";
    }

    if(emailValue === '' || !emailValue.includes('@') || !emailValue.includes('.')){
        emailError.innerHTML = "Please enter a valid email address.";
        emailElement.style.borderColor = "red";
        isValid = false;
    } else {
        emailError.innerHTML = "";
        emailElement.style.borderColor = "green";
    }

    return isValid;
}
