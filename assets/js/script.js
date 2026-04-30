// Validation du formulaire d'ajout et de modification
document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");

    if (form) {
        form.addEventListener("submit", function (event) {
            const nom = document.getElementById("nom");
            const prenom = document.getElementById("prenom");
            let messageErreur = "";

            if (!nom.value.trim()) {
                messageErreur += "Le nom est obligatoire.\n";
            }

            if (!prenom.value.trim()) {
                messageErreur += "Le prénom est obligatoire.\n";
            }

            if (messageErreur) {
                event.preventDefault(); // Empêche l'envoi du formulaire
                alert(messageErreur);   // Affiche un message d'erreur
            }
        });
    }
});
