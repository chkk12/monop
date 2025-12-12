<?php
function connexPDO()
{
    include_once("src/myParam.inc.php");
    try
    {
        $conn = new PDO('pgsql:host='.HOST.' dbname=monop', USER, PASS);
        return $conn;
    }
    catch(PDOException $except){
        echo "Échec de la connexion : ".$except->getMessage();
        return false;
        exit();
    }
}

$conn = connexPDO();
if (!$conn) {
    exit();
}

if(isset($_POST['user']) && !empty($_POST['user']) && !empty($_POST['mdp']) && !empty($_POST['confirm_mdp']) && !empty($_POST['email'])) {
    $user = $_POST['user'];
    $mdp = $_POST['mdp'];
    $confirm_mdp = $_POST['confirm_mdp'];
    $email = $_POST['email'];

    if(empty($user) || empty($mdp) || empty($confirm_mdp) || empty($email)) {
        echo "Tous les champs sont obligatoires.";
    }
    else if($mdp !== $confirm_mdp) {
        echo "Les mots de passe ne correspondent pas.";
    }
    else if(strlen($mdp) < 8) {
        echo "Le mot de passe doit contenir au moins 8 caractères.";
    } else {
        try {
            $sql1 = "INSERT INTO joueur (pseudo) VALUES ('$user')";
            $nb1 = $conn->exec($sql1);
            
            if($nb1 == 1) {
                $result = $conn->query("SELECT MAX(id_joueur) as dernier_id FROM joueur");
                $row = $result->fetch();
                $id_joueur = $row['dernier_id'];

                $mdp_hash = password_hash($mdp, PASSWORD_DEFAULT);
                $sql2 = "INSERT INTO compte (username, mdp, email, id_joueur) 
                         VALUES ('$user', '$mdp_hash', '$email', $id_joueur)";
                $nb2 = $conn->exec($sql2);
                
                if($nb2 == 1) {
                    $sql3 = "INSERT INTO parametre (id_joueur) VALUES ($id_joueur)";
                    $conn->exec($sql3);
                    
                    echo "Compte '$user' créé avec succès !";
                    header("Location: login.php");
                    exit();
                } else {
                    echo "Erreur lors de la création du compte.";
                }
            } else {
                echo "Erreur lors de la création du joueur.";
            }

        } catch(PDOException $except) {
            echo "Ce nom d'utilisateur ou email est déjà utilisé.";
        }
    }
    $_POST = [];
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CyberSafe Monopoly - Créer un compte</title>
    <link rel="stylesheet" href="template/login-styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="background-animation">
        <div class="floating-icons">
            <i class="fas fa-shield-alt"></i>
            <i class="fas fa-lock"></i>
            <i class="fas fa-server"></i>
            <i class="fas fa-database"></i>
            <i class="fas fa-wifi"></i>
            <i class="fas fa-cloud"></i>
            <i class="fas fa-bug"></i>
            <i class="fas fa-key"></i>
            <i class="fas fa-fingerprint"></i>
            <i class="fas fa-user-shield"></i>
        </div>
        <div class="gradient-overlay"></div>
    </div>

    <div class="login-container">
        <div class="main-section">
            <div class="form-container">
                <div class="logo-section">
                    <div class="logo-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h1>CyberSafe Monopoly</h1>
                    <p class="tagline">Maîtrisez la cybersécurité en jouant</p>
                </div>

                <div class="form-header">
                    <h2>Créer un compte</h2>
                    <p>Rejoignez la communauté des experts en cybersécurité</p>
                </div>

                <form class="login-form" id="registerForm" method="POST">
                    <div class="form-group">
                        <label for="username">
                            <i class="fas fa-id-card"></i>
                            Identifiant
                        </label>
                        <input 
                            type="text" 
                            id="username" 
                            name="user" 
                            placeholder="Votre identifiant de connexion"
                            required
                            autocomplete="username"
                        >
                        <span class="input-focus"></span>
                    </div>

                    <div class="form-group">
                        <label for="email">
                            <i class="fas fa-envelope"></i>
                            Adresse email
                        </label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            placeholder="votre.email@exemple.com"
                            required
                            autocomplete="email"
                        >
                        <span class="input-focus"></span>
                    </div>

                    <div class="form-group">
                        <label for="password">
                            <i class="fas fa-lock"></i>
                            Mot de passe
                        </label>
                        <div class="password-wrapper">
                            <input 
                                type="password" 
                                id="password" 
                                name="mdp" 
                                placeholder="••••••••"
                                required
                                autocomplete="new-password"
                                minlength="8"
                            >
                        </div>
                        <span class="input-focus"></span>
                        <small class="password-hint">Minimum 8 caractères</small>
                    </div>

                    <div class="form-group">
                        <label for="confirmPassword">
                            <i class="fas fa-lock"></i>
                            Confirmer le mot de passe
                        </label>
                        <div class="password-wrapper">
                            <input 
                                type="password" 
                                id="confirmPassword" 
                                name="confirm_mdp" 
                                placeholder="••••••••"
                                required
                                autocomplete="new-password"
                                minlength="8"
                            >
                        </div>
                        <span class="input-focus"></span>
                    </div>

                    <button type="submit" class="login-button">
                        <i class="fas fa-user-plus"></i>
                        Créer mon compte
                    </button>
                </form>

                <div class="form-footer">
                    <p>Vous avez déjà un compte ?</p>
                    <a href="login.php" class="signup-link">Se connecter</a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
