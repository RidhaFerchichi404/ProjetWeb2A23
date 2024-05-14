function validateForm() {
    var idUser = document.getElementById('id_user').value.trim();
    var titre = document.getElementById('titre').value.trim();
    var contenu = document.getElementById('contenue').value.trim();

    // Vérifier si les champs requis sont vides
    if (idUser === '' || titre === '' || contenu === '') {
        alert('Veuillez remplir tous les champs.');
        return false; // Empêcher l'envoi du formulaire
    }

    // Validation de l'ID utilisateur (doit contenir uniquement des chiffres)
    if (!/^[0-9]+$/.test(idUser)) {
        alert('L\'ID utilisateur ne doit contenir que des chiffres.');
        return false; // Empêcher l'envoi du formulaire
    }

    // Validation du titre (doit commencer par une majuscule)
    if (titre.charAt(0) !== titre.charAt(0).toUpperCase()) {
        alert('Le titre doit commencer par une majuscule.');
        return false; // Empêcher l'envoi du formulaire
    }

    // Autres validations selon vos besoins

    // Si la validation réussit, retourner true pour soumettre le formulaire
    return true;
}
