// ===== LANCEMENT DE DÉ AVEC BASE DE DONNÉES =====

// Variables de jeu 
let positionJoueur = 0;

// Place le pion du joueur sur une case spécifique
function placerPionSurCase(position) {
    const pion = document.getElementById('playerToken');
    const caseElement = document.querySelector(`[data-position="${position}"]`);
    
    if (pion && caseElement) {
        // Calculer la position relative de la case
        const rect = caseElement.getBoundingClientRect();
        const boardRect = document.querySelector('.board').getBoundingClientRect();
        
        // Positionner le pion au centre de la case
        pion.style.position = 'absolute';
        pion.style.left = (rect.left - boardRect.left + rect.width/2 - 15) + 'px';
        pion.style.top = (rect.top - boardRect.top + rect.height/2 - 15) + 'px';
        pion.style.zIndex = '1000';
        
        console.log(`Pion placé sur la case ${position}`);
    }
}

// Affiche des informations sur la case actuelle
function afficherInfoCase(position) {
    const caseElement = document.querySelector(`[data-position="${position}"]`);
    if (caseElement) {
        const nomCase = caseElement.querySelector('.property-name, .corner-text, .card-text');
        const coutCase = caseElement.querySelector('.property-cost');
        
        if (nomCase) {
            let message = `📍 Case ${position}: ${nomCase.textContent}`;
            if (coutCase) {
                message += ` (${coutCase.textContent})`;
            }
            console.log(message);
        }
    }
}

// Initialisation au chargement de la page
document.addEventListener('DOMContentLoaded', function() {
    // Récupérer la position depuis l'attribut du pion
    const pion = document.getElementById('playerToken');
    if (pion) {
        positionJoueur = parseInt(pion.getAttribute('data-position')) || 0;
        // Placer le pion à la bonne position
        placerPionSurCase(positionJoueur);
        // Afficher les infos de la case
        afficherInfoCase(positionJoueur);
    }
    
    console.log(`🎮 Jeu chargé - Pion sur la case ${positionJoueur}`);
});
