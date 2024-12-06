<?php require_once 'includes/head.php'; ?>
<?php require_once 'includes/navigation.php'; ?>
<?php require_once 'includes/header.php'; ?>


<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header">
                                <h3 class="text-center font-weight-light my-4">Créer votre compte</h3>
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