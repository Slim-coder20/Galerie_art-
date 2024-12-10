<?php require_once 'includes/head.php'; ?>
<?php require_once 'includes/navigation.php'; ?>
<?php require_once 'includes/header.php'; ?>

<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * session_start() en PHP est une fonction utilisée pour démarrer une session ou reprendre une session existante. Dans un contexte orienté objet, son rôle reste le même, mais elle est souvent utilisée dans des classes ou des architectures où les sessions jouent un rôle structuré dans la gestion de l'état des utilisateurs.
 */


require_once './DB/config.php'; 
require_once './Users.php'; 

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = $_POST['email']; 
    $password = $_POST['password']; 

    $user = new Users(); 
    $userId = $user->login($email, $password); 

    if($userId){
        $_SESSION['id_artiste'] = $userId; 
        header('location:index.php'); 
        exit(); 
    }else{
        $message = 'identifiant de connexion invalide'; 
    }
}





?>










<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header">
                                <?php  if( isset($message)) echo $message;?>
                                <h3 class="text-center font-weight-light my-4">Connexion</h3>
                            </div>
                            <div class="card-body">
                                <form method="post" action="<?php echo $_SERVER['PHP_SELF']  ?>">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="inputEmail" type="email" name="email" required />
                                        <label for="inputEmail">Adresse email</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="inputPassword" type="password" name="password" required />
                                        <label for="inputPassword">Mot de passe</label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" name="sesouvenir" />
                                        <label class="form-check-label" for="inputRememberPassword">Se souvenir de moi</label>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <a class="small" href="password.php">Mot de passe oublié?</a>
                                        <input type="submit" name="connexion" class="btn btn-primary">
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center py-3">
                                <div class="small"><a href="register.php">Avez-vous besoin d'un compte ? Inscrivez-vous</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

</div>
<?php require_once 'includes/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
</body>

</html>