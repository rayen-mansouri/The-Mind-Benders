        // Fonction de validation et d'affichage de la section de réclamation
        function validerEtAfficherReclamation() {
            // Valider chaque champ du formulaire
            const nom = document.getElementById("name").value.trim();
            const email = document.getElementById("email").value.trim();
            const phone = document.getElementById("phone").value.trim();
            const adresse = document.getElementById("address").value.trim();

            // Vérifier si tous les champs sont remplis correctement
            if (nom === "" || email === "" || phone === "" || adresse === "") {
                alert("Veuillez remplir tous les champs.");
                return false; // Empêche l'envoi du formulaire
            }

            // Regex pour valider l'email
            const regexEmail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            if (!regexEmail.test(email)) {
                alert("Veuillez entrer un email valide.");
                return false;
            }

            // Regex pour valider le numéro de téléphone (10 chiffres)
            const regexPhone = /^[0-9]{8}$/;
            if (!regexPhone.test(phone)) {
                alert("Veuillez entrer un numéro de téléphone valide (8 chiffres).");
                return false;
            }

            // Masquer le formulaire et afficher la section de réclamation
            document.getElementById("formulaire").style.display = "none";
            document.getElementById("reclamationSection").style.display = "block";

            //alert("Données enregistrées avec succès.");
            return false; // Empêche l'envoi par défaut pour rester sur la page
        }

        // Fonction pour envoyer la réclamation
        function envoyerReclamation() {
            const reclamation = document.getElementById("reclamation").value.trim();
            if (reclamation === "") {
                alert("Veuillez écrire votre réclamation.");
            } else {
                alert("Réclamation envoyée !");
                document.getElementById("reclamation").value = ""; // Réinitialise le champ de texte
            }
        }

        // Fonction pour afficher la date et l'heure actuelles
        function afficherDateHeure() {
            const maintenant = new Date();
            const optionsDate = { year: 'numeric', month: 'long', day: 'numeric' };
            const dateFormat = maintenant.toLocaleDateString('fr-FR', optionsDate);
            const heureFormat = maintenant.toLocaleTimeString('fr-FR', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
            document.getElementById('dateHeure').textContent = `Date actuelle : ${dateFormat}, Heure actuelle : ${heureFormat}`;
        }
        function validerEtAfficherReclamation() {
            // Validation et affichage de la section réclamation (si nécessaire)
            document.getElementById('reclamationSection').style.display = 'block';
            return true; // Permet la soumission du formulaire
        }
        
        function envoyerReclamation() {
            alert("Réclamation envoyée !");
            document.getElementById('dateHeure').innerText = new Date().toLocaleString();
        }
        

        // Appeler la fonction pour afficher la date et l'heure au chargement de la page
        afficherDateHeure();
        


