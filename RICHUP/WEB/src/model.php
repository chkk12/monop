<?php
/**
 * Modèle pour le jeu CyberSafe Monopoly
 * Contient toute la logique métier et les interactions avec la base de données
 */

class GameModel {
    private $conn;

    public function __construct() {
        $this->conn = $this->connexPDO();
    }

    /**
     * Fonction de connexion à la base de données
     */
    private function connexPDO() {
        require_once(__DIR__ . '/myParam.inc.php');
        try {
            $conn = new PDO('pgsql:host='.HOST.' dbname=monop', USER, PASS);
            return $conn;
        } catch(PDOException $except) {
            echo "Échec de la connexion : ".$except->getMessage();
            return false;
        }
    }

    /**
     * Récupère l'ID d'un joueur par son pseudo
     */
    public function getJoueurIdByPseudo($pseudo) {
        if (!$this->conn || empty($pseudo)) {
            return false;
        }

        try {
            $sql = "SELECT j.id_joueur FROM joueur j WHERE j.pseudo = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$pseudo]);
            $joueur = $stmt->fetch();
            
            return $joueur ? $joueur['id_joueur'] : false;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Récupère les informations de la partie en cours pour un joueur
     */
    public function getPartieEnCours($joueur_id) {
        if (!$this->conn) {
            return false;
        }

        try {
            $sql = "SELECT * FROM parties_en_cours WHERE joueur_id = ? AND partie_active = true";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$joueur_id]);
            return $stmt->fetch();
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Crée une nouvelle partie pour un joueur
     */
    public function creerNouvellePartie($joueur_id, $resultat_de) {
        if (!$this->conn) {
            return false;
        }

        try {
            $position_actuelle = 0;
            $argent = 1500;
            
            $sql = "INSERT INTO parties_en_cours (joueur_id, position_actuelle, argent, dernier_lancer, partie_active) 
                    VALUES (?, ?, ?, ?, true)";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([$joueur_id, $position_actuelle, $argent, $resultat_de]);
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Met à jour la partie avec la nouvelle position et les nouveaux paramètres
     */
    public function mettreAJourPartie($joueur_id, $nouvelle_position, $argent, $resultat_de) {
        if (!$this->conn) {
            return false;
        }

        try {
            $sql = "UPDATE parties_en_cours 
                    SET position_actuelle = ?, argent = ?, dernier_lancer = ?, date_derniere_action = NOW() 
                    WHERE joueur_id = ? AND partie_active = true";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([$nouvelle_position, $argent, $resultat_de, $joueur_id]);
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Lance un dé et traite toute la logique du jeu
     */
    public function lancerDe($pseudo) {
        $joueur_id = $this->getJoueurIdByPseudo($pseudo);
        if (!$joueur_id) {
            return ['success' => false, 'message' => 'Joueur introuvable'];
        }

        // Générer le résultat du dé
        $resultat_de = rand(1, 6);
        
        // Récupérer ou créer la partie en cours
        $partie = $this->getPartieEnCours($joueur_id);
        
        if (!$partie) {
            // Créer une nouvelle partie
            if (!$this->creerNouvellePartie($joueur_id, $resultat_de)) {
                return ['success' => false, 'message' => 'Erreur création partie'];
            }
            $position_actuelle = 0;
            $argent = 1500;
        } else {
            $position_actuelle = $partie['position_actuelle'];
            $argent = $partie['argent'];
        }
        
        // Calculer nouvelle position
        $ancienne_position = $position_actuelle;
        $nouvelle_position = ($position_actuelle + $resultat_de) % 40;
        
        // Vérifier passage par la case départ
        $message_resultat = '';
        if ($ancienne_position + $resultat_de >= 40) {
            $argent += 200;
            $message_resultat = "🎉 Passage par la case départ ! +200€";
        }
        
        // Mettre à jour la partie
        if (!$this->mettreAJourPartie($joueur_id, $nouvelle_position, $argent, $resultat_de)) {
            return ['success' => false, 'message' => 'Erreur mise à jour partie'];
        }
        
        return [
            'success' => true,
            'resultat_de' => $resultat_de,
            'nouvelle_position' => $nouvelle_position,
            'argent' => $argent,
            'message' => $message_resultat
        ];
    }

    /**
     * Récupère l'état actuel du jeu pour un joueur
     */
    public function getEtatJeu($pseudo) {
        $etat_defaut = [
            'position_joueur' => 0,
            'argent_joueur' => 1500,
            'resultat_de' => 0,
            'message_resultat' => ''
        ];

        $joueur_id = $this->getJoueurIdByPseudo($pseudo);
        if (!$joueur_id) {
            return $etat_defaut;
        }

        $partie = $this->getPartieEnCours($joueur_id);
        if (!$partie) {
            return $etat_defaut;
        }

        $etat = [
            'position_joueur' => $partie['position_actuelle'],
            'argent_joueur' => $partie['argent'],
            'resultat_de' => $partie['dernier_lancer'],
            'message_resultat' => ''
        ];

        // Vérifier si c'est un lancement récent (moins de 5 secondes)
        $derniere_action = strtotime($partie['date_derniere_action']);
        if ($derniere_action && (time() - $derniere_action) < 5) {
            // Calculer la position précédente
            $position_precedente = ($etat['position_joueur'] - $etat['resultat_de'] + 40) % 40;
            
            // Vérifier si passage par case départ
            if ($position_precedente + $etat['resultat_de'] >= 40) {
                $etat['message_resultat'] = "🎉 Passage par la case départ ! +200€";
            }
        }

        return $etat;
    }

    /**
     * Gère la déconnexion du joueur
     */
    public function logout() {
        $_SESSION = [];
        session_destroy();
        return true;
    }

    /**
     * Vérifie si l'utilisateur est connecté
     */
    public function estConnecte() {
        return isset($_SESSION['connecte']) && $_SESSION['connecte'] === true;
    }

    /**
     * Récupère le pseudo de l'utilisateur connecté
     */
    public function getPseudoUtilisateur() {
        return $_SESSION['pseudo'] ?? '';
    }
}

/**
 * Fonction principale de traitement du jeu
 * Gère toute la logique de connexion, déconnexion et jeu
 */
function traiterJeu(&$position_joueur, &$argent_joueur, &$resultat_de, &$message_resultat) {
    $gameModel = new GameModel();

    // Vérification de la connexion
    if (!$gameModel->estConnecte()) {
        header("Location: pageLogin.php");
        exit();
    }

    // Gestion de la déconnexion
    if (isset($_POST['logout'])) {
        $gameModel->logout();
        header("Location: pageLogin.php");
        exit();
    }

    // Gestion du lancer de dé
    if (isset($_POST['lancer_de'])) {
        $pseudo = $gameModel->getPseudoUtilisateur();
        $resultat = $gameModel->lancerDe($pseudo);
        
        // Redirection après POST pour éviter le re-lancement au rechargement
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    // Récupération de l'état actuel du jeu
    $pseudo = $gameModel->getPseudoUtilisateur();
    $etat_jeu = $gameModel->getEtatJeu($pseudo);

    // Mise à jour des variables passées par référence
    $position_joueur = $etat_jeu['position_joueur'];
    $argent_joueur = $etat_jeu['argent_joueur'];
    $resultat_de = $etat_jeu['resultat_de'];
    $message_resultat = $etat_jeu['message_resultat'];
}
