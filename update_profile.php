<?php
require_once 'includes/head.php';
require_once 'includes/navigation.php';
require_once 'DB/config.php';
require_once 'Users.php';
?>

<?php
require_once 'DB/config.php';
require_once 'Users.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// On va créer une condition qui conditionne l'exécution de ce code uniquement lorsque l'utilisateur est connecté
if (isset($_SESSION['id_artiste'])) {
    $id_artiste = $_SESSION['id_artiste'];
    $user = new Users();
    $artiste = $user->getUserById($id_artiste);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Initialiser les variables
        $nom = '';
        $prenom = '';
        $email = '';
        $password = '';
        $biographie = '';
        $photo_profile = 'avatar_defaut.png';

        // Validation des champs
        if (empty($_POST['prenom']) || !preg_match("/^[\p{L} '-]+$/u", $_POST['prenom'])) {
            $message = "Votre prénom doit être une chaîne de caractères alphabétiques (accents et espaces autorisés)";
        } elseif (empty($_POST['nom']) || !preg_match("/^[\p{L} '-]+$/u", $_POST['nom'])) {
            $message = "Votre nom doit être une chaîne de caractères alphabétiques (accents et espaces autorisés)";
        } elseif (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $message = "Merci de saisir une adresse mail valide !";
        } else {
            // Affectation des valeurs aux variables si validation OK
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $biographie = $_POST['biographie'];

            // Vérification et téléchargement de la photo de profil
            if (empty($_FILES['photo_profil']['name'])) {
                $photo_profile = 'avatar_defaut.png';
            } else {
                $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                if (in_array($_FILES['photo_profil']['type'], $allowedTypes)) {
                    $photo_profile = basename($_FILES['photo_profil']['name']);
                    $path = "img/photos-profile/";
                    move_uploaded_file($_FILES['photo_profil']['tmp_name'], $path . $photo_profile);
                } else {
                    $message = "La photo de profil doit être de type : jpg, png ou jpeg !";
                }
            }

            // Instancier l'objet Users et enregistrer
            $user = new Users();
            $existingUser = $user->getUserByEmailId($id_artiste, $email);

            if ($existingUser) {
                $message = "Cette adresse email est déjà utilliser";
            } else {
                $result = $user->updateProfile($id_artiste, $prenom, $nom, $email, $biographie, $photo_profile);
                if ($result) {
                    header('location: index.php');
                    exit();
                } else {
                    $message = "Erreur lors de la mise à jour";
                }
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
                                    <h3 class="text-center font-weight-light my-4">Mise à jour du profile</h3>
                                </div>
                                <div class="card-body">
                                    <!-- L'attribut enctype nous permet d'introduire des fichiers de type : photos, vidéos etc -->
                                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="inputFirstName" type="text" name="prenom" value="<?= htmlspecialchars($artiste['prenom']) ?>" />
                                                    <label for="inputFirstName">Prénom</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input class="form-control" id="inputLastName" type="text" name="nom" value="<?= htmlspecialchars($artiste['nom']) ?>" />
                                                    <label for="inputLastName">Nom</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputEmail" type="email" name="email" value="<?= htmlspecialchars($artiste['email']) ?>" />
                                            <label for="inputEmail">Adresse email</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <textarea class="form-control" id="biographie" placeholder="Courte biographie" name="biographie"><?= htmlspecialchars($artiste['biographie']) ?></textarea>
                                            <label for="biographie">Biographie</label>
                                        </div>
                                        <div>
                                            <label for="photo_profil">Photo de profil</label>
                                            <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
                                            <input type="file" name="photo_profil" id="photo_profil">
                                        </div>
                                        <div class="mt-4 mb-0">
                                            <div class="d-grid">
                                                <input type="submit" name="update_profil" value="Mettre à jour mon profil" class="btn btn-primary">
                                            </div>
                                        </div>
                                    </form>
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
<?php
} else {
    header('location: login.php');
}
?>
<?php require_once 'includes/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
</body>

</html>