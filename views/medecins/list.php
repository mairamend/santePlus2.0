<?php
include __DIR__ . '/../layout/header.php';

?>

<div class="main-content">

    <div class="row">
        <?php include __DIR__ . '/../layout/_alerts.php';?>
        <h4 class="mb-3 fw-bold ">Listes des medecins</h4>
        <!-- LISTE DES MEDECINS -->
        <div class="col-md-8">
            <div class="d-flex align-items-center justify-content-between flex-grow-1 w-100 mb-4">
                <form action="/medecins" method="GET" class="d-flex gap-3 mb-0 ">
                    <input type="hidden" name="page" value="medecins">
                    <label for="specialite" style="font-weight:600;">Filtrer par spécialité :</label>
                    <div class="">

                        <select class="form-select form-select-sm" name="specialite" id="specialite">
                            <option value="">Toutes les spécialités</option>
                            <?php
                            foreach ($specialites as $specialite): ?>
                                <option value="<?= $specialite ?>"
                                    <?php if (isset($_GET['specialite']) && $_GET['specialite'] == $specialite)
                                        echo 'selected';
                                    ?>>
                                    <?= $specialite ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button class="btn-edit" type="submit">Filtrer</button>

                </form>
            </div>

            <div class="grid">
                <?php

                if (count($medecins) > 0):

                    foreach ($medecins as $medecin): ?>

                        <div class="staff-card">

                            <div class="rdv-medecin-avatar">Dr</div>

                            <div class="card-content">
                                <div class="card-top">
                                    <div class="card-specialty"><?= $medecin['specialite'] ?></div>

                                </div>

                                <div class="card-name"> <?= $medecin['nom'] ?></div>

                                <div class="card-footer">
                                    <div class="contact-info">
                                        <span><?= $medecin['email'] ?></span>
                                    </div>
                                    <div class="contact-info">
                                        <span><?= $medecin['telephone'] ?></span>
                                    </div>

                                    
                                </div>
                                <div class="d-flex gap-3">
                                        <!-- boutons modifier -->
                                        <button class="btn-action btn-modifier modifier" data-id="<?= $medecin['id'] ?>">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <!-- bouton supprimer -->
                                        <form action="/medecins/supprimer" method="POST"
                                            onsubmit="return confirm('Voulez-vous vraiment supprimer ce patient ?');"
                                            style="display:inline;">
                                            <input type="hidden" name="id" value="<?= $medecin['id'] ?>">
                                            <button type="submit" class="btn-action btn-supprimer">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                            </div>
                        </div>
                <?php endforeach; ?>
            </div>
        
        <div class="pagination">
            <?php for ($i = 1; $i <= $nb_pages; $i++): ?>
                <a href="/medecins?p=<?= $i ?>&specialite=<?= urlencode($filter) ?>"
                    class="filtre-btn <?= $i == $page_courante ? 'active' : '' ?>"><?= $i ?></a>
            <?php endfor; ?>
        </div>
    <?php else: ?>

        <div class="empty-state">
            <i class="bi bi-calendar-x"></i>
            <p>Aucun Medecin</p>
        </div>

        <?php endif; ?>
        </div>
        <div class="col-md-4">
            <?php include __DIR__ . '/_form.php'; ?>
        </div>



    </div>


    <script>
        document.querySelectorAll(".btn-modifier").forEach(btn => {
            btn.addEventListener("click", function() {
                let id = this.dataset.id;

                // Appel AJAX vers PHP pour récupérer les infos du médecin
                fetch("medecins/getMedecin.php?id=" + id)
                    .then(response => response.json())
                    .then(data => {
                        // Remplir les champs du modal
                        document.getElementById("medecin_id").value = data.id;
                        document.querySelector("#modifierMedecin input[name='nom']").value = data.nom;
                        document.querySelector("#modifierMedecin input[name='specialite']").value = data.specialite;
                        document.querySelector("#modifierMedecin input[name='email']").value = data.email;
                        document.querySelector("#modifierMedecin input[name='telephone']").value = data.telephone;
                        document.querySelector("#modifierMedecin input[name='user_id']").value = data.user_id;

                        // Ouvrir le modal (au cas où)
                        new bootstrap.Modal(document.getElementById('modifierMedecin')).show();
                    });
            });
        });
        setTimeout(() => {
            document.querySelectorAll('.alert-sante').forEach(el => el.remove());
        }, 3000);
    </script>
    <?php include __DIR__ . '/../layout/footer.php'; ?>