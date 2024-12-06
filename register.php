<?php
require_once 'includes/head.php';
require_once 'includes/navigation.php';
require_once 'DB/config.php';
require_once 'Users.php';

if (isset($_POST['inscription'])) {
    // Initialiser les variables
    $nom = '';
    $prenom = '';
    $email = '';
    $password = '';
    $biographie = '';
    $photo_profile = 'avatar_defaut.png';

    // Validation des champs
    if (empty($_POST['prenom']) || !ctype_alpha($_POST['prenom'])) {
        $message = "Votre prenom doit être une chaine de caractère alphabetique";
    } elseif (empty($_POST['nom']) || !ctype_alpha($_POST['nom'])) {
        $message = "Votre nom doit être une chaine de caractère alphabetique";
    } elseif (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $message = "Merci de saisir une adresse mail valide !";
    } elseif (empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']) {
        $message = "Merci de saisir un mot de passe valide";
    } else {
        // Affectation des valeurs aux variables si validation OK
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $biographie = $_POST['biographie'];

        // Vérification et téléchargement de la photo de profil
        if (isset($_FILES['photo_profil']) && $_FILES['photo_profil']['error'] == UPLOAD_ERR_OK) {
            $photo_profile = $_FILES['photo_profil']['name'];
            move_uploaded_file($_FILES['photo_profil']['tmp_name'], 'uploads/' . $photo_profile);
        }

        // Instancier l'objet Users et enregistrer
        $user = new Users();
        $result = $user->register($nom, $prenom, $email, $password, $biographie, $photo_profile);

        if ($result) {
            header('location: index.php');
            exit();
        } else {
            $message = "Erreur lors de l'inscription";
        }
    }
}
?>

<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header">

                                <?php if (isset($message)) echo $message; ?>
                                <h3 class="text-center font-weight-light my-4">Nouveau compte</h3>
                            </div>
                            <div class="card-body">
                                <!--l'attribut enctype nous permet d'introduire des fichier de type : photos, vidéos etc-->
                                <form action="register.php" method="post" enctype="multipart/form-data">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 mb-md-0">
                                                <input class="form-control" id="inputFirstName" type="text" placeholder="Veuillez entrer votre prénom" name="prenom" />
                                                <label for="inputFirstName">Prénom</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input class="form-control" id="inputLastName" type="text" placeholder="Veuillez entrer votre nom " name="nom" />
                                                <label for="inputLastName">Nom</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="inputEmail" type="email" placeholder="name@example.com" name="email" />
                                        <label for="inputEmail">Adresse email</label>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 mb-md-0">
                                                <input class="form-control" id="inputPassword" type="password" placeholder="Mot de passe " name="password" />
                                                <label for="inputPassword">Mot de passe</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 mb-md-0">
                                                <input class="form-control" id="inputPasswordConfirm" type="password" placeholder="Confirmation du mot de passe" name="password_confirm" />
                                                <label for="inputPasswordConfirm">Confirmer mot de passe</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <textarea class="form-control" id="biographie" type="text" placeholder="courte biograhie" name="biographie"></textarea>
                                        <label for="biographie">Biographie</label>
                                    </div>
                                    <div>
                                        <label for="photo_profil">Photo de Profile</label>
                                        <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
                                        <input type="file" name="photo_profil" id="photo_profil">
                                    </div>




                                    <div class="mt-4 mb-0">
                                        <div class="d-grid">
                                            <input type="submit" name="inscription" value="inscription" class="btn btn-primary">
                                        </div>
                                </form>
                            </div>
                            <div class="card-footer text-center py-3">
                                <div class="small"><a href="login.php">Avez vous déjà un compte ? Connectez-vous</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div id="layoutAuthentication_footer">

    </div>
</div>
<?php require_once 'includes/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
</body>

</html>