<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'CyberSafe Monopoly'; ?></title>
    <link rel="stylesheet" href="template/styles.css?v=<?php echo time(); ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <?php if (isset($additional_css)): ?>
        <?php foreach ($additional_css as $css_file): ?>
            <link rel="stylesheet" href="<?php echo $css_file; ?>">
        <?php endforeach; ?>
    <?php endif; ?>
</head>
<body>
    <?php if (isset($page_header) && $page_header): ?>
        <header class="game-header">
            <h1><i class="fas fa-shield-alt"></i> <?php echo isset($title) ? $title : 'CyberSafe Monopoly'; ?></h1>
            <?php if (isset($subtitle)): ?>
                <p class="subtitle"><?php echo $subtitle; ?></p>
            <?php endif; ?>
        </header>
    <?php endif; ?>

    <?php 
    // Inclusion du contenu principal de la page
    if (isset($content_file) && file_exists($content_file)) {
        include $content_file;
    } elseif (isset($contenu)) {
        echo $contenu;
    } else {
        echo '<p>Contenu non trouvé.</p>';
    }
    ?>

    <?php if (isset($modals) && $modals): ?>
        <!-- Modals -->
        <div class="modal" id="systemModal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h3 id="modalTitle">Informations Système</h3>
                <div id="modalBody">
                </div>
                <div class="modal-actions">
                    <button class="btn btn-primary" id="modalBuyBtn">Acheter</button>
                    <button class="btn btn-secondary" id="modalUpgradeBtn">Améliorer</button>
                </div>
            </div>
        </div>

        <div class="modal" id="incidentModal">
            <div class="modal-content incident-modal">
                <div class="incident-header">
                    <i class="fas fa-exclamation-triangle"></i>
                    <h3>Incident de Sécurité!</h3>
                </div>
                <div id="incidentBody">
                </div>
                <div class="modal-actions">
                    <button class="btn btn-primary" id="incidentOkBtn">Compris</button>
                </div>
            </div>
        </div>

        <div class="modal" id="practiceModal">
            <div class="modal-content practice-modal">
                <div class="practice-header">
                    <i class="fas fa-lightbulb"></i>
                    <h3>Bonne Pratique!</h3>
                </div>
                <div id="practiceBody">
                </div>
                <div class="modal-actions">
                    <button class="btn btn-primary" id="practiceOkBtn">Appliquer</button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if (isset($javascript_files)): ?>
        <?php foreach ($javascript_files as $js_file): ?>
            <script src="<?php echo $js_file; ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
    
    <?php if (isset($inline_javascript)): ?>
        <script>
            <?php echo $inline_javascript; ?>
        </script>
    <?php endif; ?>
</body>
</html>
