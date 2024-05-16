var formElement = document.getElementById("UpdatePForm");
var idPartElement = document.getElementById("idPart2");
var nomPartElement = document.getElementById("nomPart2");
var agePartElement = document.getElementById("agePart2");
var emailPartElement = document.getElementById("emailPart2");
var idEventPartElement = document.getElementById("idEventPart2");

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
    var idPartValue = idPartElement.value;
    var nomPartValue = nomPartElement.value;
    var agePartValue = agePartElement.value;
    var emailPartValue = emailPartElement.value; 
    var idEventPartValue = idEventPartElement.value;
    
    var idPError = document.getElementById("idPError");
    var nameError = document.getElementById("nameError");
    var ageError = document.getElementById("ageError");
    var emailError = document.getElementById("emailError");
    var idEError = document.getElementById("idEError");

    var isValid = true; 

    // Validate Participant ID
    if(idPartValue === ""){
        idPError.innerHTML = "Participant ID is required";
        idPartElement.style.borderColor = "red";
        isValid = false; 
    } else {
        idPError.innerHTML = "";
        idPartElement.style.borderColor = "green"; 
    }

    if(idEventPartValue === ""){
        idEError.innerHTML = "Event ID is required";
        idEventPartElement.style.borderColor = "red";
        isValid = false; 
    } else {
        dEError.innerHTML = "";
        idEventPartElement.style.borderColor = "green"; 
    }

    // Validate Participant Name
    var namePattern = /^[a-zA-Z\s]+$/;
    if(!nomPartValue.match(namePattern)){
        nameError.innerHTML = "Name must contain only letters and spaces";
        nomPartElement.style.borderColor = "red";
        isValid = false;
    } else {
        nameError.innerHTML = "";
        nomPartElement.style.borderColor = "green"; 
    }

    // Validate Age (only numbers)
    var agePattern = /^\d+$/;
    if(!agePartValue.match(agePattern)){
        ageError.innerHTML = "Age must contain only numbers";
        agePartElement.style.borderColor = "red";
        isValid = false;
    } else {
        ageError.innerHTML = "";
        agePartElement.style.borderColor = "green"; 
    }

    // Validate Email
    var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if(!emailPartValue.match(emailPattern)){
        emailError.innerHTML = "Invalid email format";
        emailPartElement.style.borderColor = "red";
        isValid = false;
    } else {
        emailError.innerHTML = "";
        emailPartElement.style.borderColor = "green"; 
    }



    return isValid; 
}

