<section class="container mt-5">
    <div class="d-flex flex-column align-items-center justify-content-center">
        <form method="POST">
            <input type="submit" name="ajouterEmploye" value="Ajouter un employé" class="btn btn-primary mb-3">
        </form>
        <?php if (isset($_POST['ajouterEmploye'])) { ?>
            <div class="alert alert-info mb-2 py-1 px-2" role="alert" style="font-size: 0.9rem;">
                <small>Veuillez remplir le formulaire suivant</small>
            </div>
            <form action="traitements/traitement-employe.php" method="POST" class="w-50">
                <div class="mb-3">
                    <label for="lastName" class="form-label">Nom</label>
                    <input type="text" id="lastName" name="lastName" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="firstName" class="form-label">Prénom</label>
                    <input type="text" id="firstName" name="firstName" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="birthDate" class="form-label">Date de naissance</label>
                    <input type="date" id="birthDate" name="birthDate" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="sex" class="form-label">Sexe</label>
                    <select id="sex" name="sex" class="form-control" required>
                        <option value="" disabled selected>Choisir le sexe</option>
                        <option value="Homme">Homme</option>
                        <option value="Femme">Femme</option>
                        <option value="Autre">Autre</option>
                    </select>
                </div>
                <button type="submit" name="submitEmploye" class="btn btn-success">Ajouter l'employé</button>
                <a href="modele.php?page=ajouter" class="btn btn-danger">Annuler</a>
            </form>
        <?php } ?>

        <form method="POST">
            <input type="submit" name="ajouterDepartement" value="Ajouter un département" class="btn btn-primary mt-3 mb-3">
        </form>
        <?php if (isset($_POST['ajouterDepartement'])) { ?>
            <div class="alert alert-info mb-2 py-1 px-2" role="alert" style="font-size: 0.9rem;">
                <small>Veuillez remplir le formulaire suivant</small>
            </div>
        <?php } ?>
    </div>
</section>