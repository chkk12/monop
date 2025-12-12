<div class="game-container">
    <header class="game-header">
        <h1><i class="fas fa-shield-alt"></i> CyberSafe Monopoly</h1>
        <p class="subtitle">Protégez votre entreprise des cybermenaces</p>
    </header>

    <div class="game-container">
    <div class="board">
        <div class="board-center">
            <div class="center-logo">
                <i class="fas fa-shield-alt"></i>
                <h2>CyberSafe</h2>
                <p>Centre de Sécurité</p>
            </div>
            <div class="dice-container">
                <div class="dice" id="dice1">
                    <div class="dice-face" style="<?php echo $resultat_de > 0 ? 'background: #4CAF50; color: white; font-weight: bold;' : ''; ?>">
                        <?php echo $resultat_de > 0 ? $resultat_de : '?'; ?>
                    </div>
                </div>
                <form method="post" style="display: inline;">
                    <button type="submit" name="lancer_de" class="roll-button" id="rollDice">
                        <i class="fas fa-dice"></i> Lancer le dé
                    </button>
                </form>
                <?php if($message_resultat): ?>
                    <div class="message-resultat"><?php echo $message_resultat; ?></div>
                <?php endif; ?>
            </div>
        </div>

        <div class="board-row bottom">
            <div class="corner start" data-position="0">
                <div class="corner-icon"><i class="fas fa-home"></i></div>
                <div class="corner-text">Centre de Sécurité</div>
                <div class="corner-subtext">+200€</div>
            </div>
            <div class="property server" data-position="1" data-cost="60">
                <div class="property-color-bar server-color"></div>
                <div class="property-name">Serveur Web</div>
                <div class="property-cost">60€</div>
            </div>
            <div class="special-card incident" data-position="2">
                <div class="card-icon"><i class="fas fa-exclamation-triangle"></i></div>
                <div class="card-text">Incident de Sécurité</div>
            </div>
            <div class="property database" data-position="3" data-cost="100">
                <div class="property-color-bar database-color"></div>
                <div class="property-name">Base de Données Clients</div>
                <div class="property-cost">100€</div>
            </div>
            <div class="special tax" data-position="4">
                <div class="card-icon"><i class="fas fa-credit-card"></i></div>
                <div class="card-text">Audit de Sécurité</div>
                <div class="card-cost">Payez 100€</div>
            </div>
            <div class="property network" data-position="5" data-cost="200">
                <div class="property-color-bar network-color"></div>
                <div class="property-name">Firewall Principal</div>
                <div class="property-cost">200€</div>
            </div>
            <div class="property server" data-position="6" data-cost="80">
                <div class="property-color-bar server-color"></div>
                <div class="property-name">Serveur Email</div>
                <div class="property-cost">80€</div>
            </div>
            <div class="special-card practice" data-position="7">
                <div class="card-icon"><i class="fas fa-lightbulb"></i></div>
                <div class="card-text">Bonne Pratique</div>
            </div>
            <div class="property server" data-position="8" data-cost="120">
                <div class="property-color-bar server-color"></div>
                <div class="property-name">Serveur de Fichiers</div>
                <div class="property-cost">120€</div>
            </div>
            <div class="property server" data-position="9" data-cost="140">
                <div class="property-color-bar server-color"></div>
                <div class="property-name">Serveur de Sauvegarde</div>
                <div class="property-cost">140€</div>
            </div>
        </div>

        <div class="board-column left">
            <div class="corner jail" data-position="10">
                <div class="corner-icon"><i class="fas fa-lock"></i></div>
                <div class="corner-text">Quarantaine</div>
                <div class="corner-subtext">Système Compromis</div>
            </div>
            <div class="property endpoint" data-position="11" data-cost="160">
                <div class="property-color-bar endpoint-color"></div>
                <div class="property-name">Poste PDG</div>
                <div class="property-cost">160€</div>
            </div>
            <div class="property cloud" data-position="12" data-cost="150">
                <div class="property-color-bar cloud-color"></div>
                <div class="property-name">Service Cloud</div>
                <div class="property-cost">150€</div>
            </div>
            <div class="property endpoint" data-position="13" data-cost="180">
                <div class="property-color-bar endpoint-color"></div>
                <div class="property-name">Poste RH</div>
                <div class="property-cost">180€</div>
            </div>
            <div class="property network" data-position="14" data-cost="200">
                <div class="property-color-bar network-color"></div>
                <div class="property-name">VPN d'Entreprise</div>
                <div class="property-cost">200€</div>
            </div>
            <div class="property endpoint" data-position="15" data-cost="200">
                <div class="property-color-bar endpoint-color"></div>
                <div class="property-name">Poste Comptabilité</div>
                <div class="property-cost">200€</div>
            </div>
            <div class="special-card incident" data-position="16">
                <div class="card-icon"><i class="fas fa-exclamation-triangle"></i></div>
                <div class="card-text">Incident de Sécurité</div>
            </div>
            <div class="property database" data-position="17" data-cost="220">
                <div class="property-color-bar database-color"></div>
                <div class="property-name">Base Financière</div>
                <div class="property-cost">220€</div>
            </div>
            <div class="special-card practice" data-position="18">
                <div class="card-icon"><i class="fas fa-lightbulb"></i></div>
                <div class="card-text">Bonne Pratique</div>
            </div>
            <div class="property database" data-position="19" data-cost="240">
                <div class="property-color-bar database-color"></div>
                <div class="property-name">Data Warehouse</div>
                <div class="property-cost">240€</div>
            </div>
        </div>

        <div class="board-row top">
            <div class="corner free-parking" data-position="20">
                <div class="corner-icon"><i class="fas fa-certificate"></i></div>
                <div class="corner-text">Certification</div>
                <div class="corner-subtext">ISO 27001</div>
            </div>
            <div class="property critical" data-position="21" data-cost="260">
                <div class="property-color-bar critical-color"></div>
                <div class="property-name">Serveur de Production</div>
                <div class="property-cost">260€</div>
            </div>
            <div class="special-card incident" data-position="22">
                <div class="card-icon"><i class="fas fa-exclamation-triangle"></i></div>
                <div class="card-text">Incident de Sécurité</div>
            </div>
            <div class="property critical" data-position="23" data-cost="280">
                <div class="property-color-bar critical-color"></div>
                <div class="property-name">Serveur de Paiement</div>
                <div class="property-cost">280€</div>
            </div>
            <div class="property network" data-position="24" data-cost="200">
                <div class="property-color-bar network-color"></div>
                <div class="property-name">Routeur Principal</div>
                <div class="property-cost">200€</div>
            </div>
            <div class="property critical" data-position="25" data-cost="300">
                <div class="property-color-bar critical-color"></div>
                <div class="property-name">Serveur Active Directory</div>
                <div class="property-cost">300€</div>
            </div>
            <div class="special-card practice" data-position="26">
                <div class="card-icon"><i class="fas fa-lightbulb"></i></div>
                <div class="card-text">Bonne Pratique</div>
            </div>
            <div class="property critical" data-position="27" data-cost="320">
                <div class="property-color-bar critical-color"></div>
                <div class="property-name">Centre de Données Principal</div>
                <div class="property-cost">320€</div>
            </div>
            <div class="property cloud" data-position="28" data-cost="150">
                <div class="property-color-bar cloud-color"></div>
                <div class="property-name">Backup Cloud</div>
                <div class="property-cost">150€</div>
            </div>
            <div class="property critical" data-position="29" data-cost="350">
                <div class="property-color-bar critical-color"></div>
                <div class="property-name">Serveur Core Banking</div>
                <div class="property-cost">350€</div>
            </div>
        </div>

        <div class="board-column right">
            <div class="corner go-to-jail" data-position="30">
                <div class="corner-icon"><i class="fas fa-bug"></i></div>
                <div class="corner-text">Ransomware</div>
                <div class="corner-subtext">Allez en quarantaine</div>
            </div>
            <div class="property mobile" data-position="31" data-cost="150">
                <div class="property-color-bar mobile-color"></div>
                <div class="property-name">App Mobile</div>
                <div class="property-cost">150€</div>
            </div>
            <div class="property mobile" data-position="32" data-cost="160">
                <div class="property-color-bar mobile-color"></div>
                <div class="property-name">API Gateway</div>
                <div class="property-cost">160€</div>
            </div>
            <div class="special-card practice" data-position="33">
                <div class="card-icon"><i class="fas fa-lightbulb"></i></div>
                <div class="card-text">Bonne Pratique</div>
            </div>
            <div class="property network" data-position="34" data-cost="200">
                <div class="property-color-bar network-color"></div>
                <div class="property-name">Switch Principal</div>
                <div class="property-cost">200€</div>
            </div>
            <div class="property mobile" data-position="35" data-cost="180">
                <div class="property-color-bar mobile-color"></div>
                <div class="property-name">Serveur API</div>
                <div class="property-cost">180€</div>
            </div>
            <div class="special-card incident" data-position="36">
                <div class="card-icon"><i class="fas fa-exclamation-triangle"></i></div>
                <div class="card-text">Incident de Sécurité</div>
            </div>
            <div class="property iot" data-position="37" data-cost="100">
                <div class="property-color-bar iot-color"></div>
                <div class="property-name">Capteurs IoT</div>
                <div class="property-cost">100€</div>
            </div>
            <div class="special tax" data-position="38">
                <div class="card-icon"><i class="fas fa-search"></i></div>
                <div class="card-text">Pentest</div>
                <div class="card-cost">Payez 75€</div>
            </div>
            <div class="property iot" data-position="39" data-cost="120">
                <div class="property-color-bar iot-color"></div>
                <div class="property-name">Caméras de Sécurité</div>
                <div class="property-cost">120€</div>
            </div>
        </div>

        <div class="player-token" id="playerToken" data-position="<?php echo $position_joueur; ?>">
            <i class="fas fa-user-shield"></i>
        </div>
    </div>
    
    <div class="player-interface">
        <div class="player-info">
            <div class="player-avatar">
                <i class="fas fa-user-shield"></i>
                <h3>Joueur 1</h3>
                <p class="player-status">En ligne</p>
            </div>
            
            <div class="player-stats">
                <div class="stat-item">
                    <i class="fas fa-coins"></i>
                    <div>
                        <span class="stat-label">Budget</span>
                        <span class="stat-value" id="playerMoney"><?php echo $argent_joueur; ?>€</span>
                    </div>
                </div>
                
                <div class="stat-item">
                    <i class="fas fa-building"></i>
                    <div>
                        <span class="stat-label">Propriétés</span>
                        <span class="stat-value" id="playerProperties">0</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="owned-properties">
            <h4><i class="fas fa-key"></i> Mes Systèmes</h4>
            <div class="properties-list" id="ownedPropertiesList">
                <div class="empty-properties">
                    <i class="fas fa-inbox"></i>
                    <p>Aucun système acheté</p>
                </div>
            </div>
        </div>
        
        <div class="quick-actions">
            <h4><i class="fas fa-bolt"></i> Actions</h4>
            <div class="action-buttons">
                <button class="action-btn" id="upgradeBtn" disabled>
                    <i class="fas fa-arrow-up"></i>
                    <span>Améliorer</span>
                </button>
                
                <button class="action-btn danger" id="mortgageBtn" disabled>
                    <i class="fas fa-ban"></i>
                    <span>Hypothéquer</span>
                </button>
            </div>
        </div>
        
        <div class="logout-section">
            <form method="post" class="logout-form">
                <button type="submit" name="logout" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Se déconnecter</span>
                </button>
            </form>
        </div>
    </div>
</div>
