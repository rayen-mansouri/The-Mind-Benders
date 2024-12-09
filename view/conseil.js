function validateForm() {
    // Récupération des valeurs des champs
    let id_con = document.getElementById("id_con").value;
    let contenu = document.getElementById("contenu").value;
    let date_pub = document.getElementById("date_pub").value;

    // Vérification de l'ID (doit être un entier, positif ou nul)
    if (id_con !== "" && isNaN(id_con)) {
        alert("L'ID doit être un entier valide.");
        return false;
    }

    // Vérification du contenu (ne doit pas être vide)
    if (contenu.trim() === "") {
        alert("Le contenu ne peut pas être vide.");
        return false;
    }

    // Vérification de la date de publication (doit être une date valide)
    if (date_pub !== "" && isNaN(Date.parse(date_pub))) {
        alert("La date de publication doit être une date valide.");
        return false;
    }

    // Si toutes les validations sont réussies
    return true;
}

