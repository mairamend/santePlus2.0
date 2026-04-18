<?php 
include __DIR__ . '/../layout/header.php'; 
include __DIR__ . '/../layout/_alerts.php'?>
<div class="main-layout">
     
    <div class="card-section">
        <div class="section-header">
            <span class="section-title"><i class="bi bi-people-fill"></i> Liste des Patients</span>
            <span class="patient-count"><?= count($patients) ?> patients affichés</span>
        </div>
        <form action="/patients" method="GET" class="d-flex gap-2 mb-3">
            <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" class="form-control" placeholder="Rechercher...">
            <button type="submit" class="btn-action btn-voir"><i class="bi bi-search"></i></button>
        </form>
        <table class="patient-table">
            <thead>
                <tr>
                    <th>Patient</th>
                    <th>Âge</th>
                    <th>Téléphone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($patients as $patient):
                $initiales = strtoupper(substr($patient['prenom'], 0, 1) . substr($patient['nom'], 0, 1));
                $patient_age = (new DateTime())->diff(new DateTime($patient['date_naissance']))->y;
                ?>
                <tr>
                    <td>
                        <div class="patient-name-cell">
                            <div class="patient-avatar"><?= $initiales ?></div>
                            <div class="patient-name"><?= $patient['prenom'] ?> <?= $patient['nom'] ?></div>
                        </div>
                    </td>
                    <td><?= $patient_age ?> ans</td>
                    <td><?= $patient['telephone'] ?></td>
                    <td>
                        <div class="actions-cell">
                       
                            <a href="/patients/historique?id=<?= $patient['id'] ?>" 
                            class="btn-action" style="text-decoration: none;">
                                <i class="bi bi-clock-history"></i> Historique
                            </a>

                            <button class="btn-action btn-modifier modifier" data-id="<?= $patient['id'] ?>">
                                <i class="bi bi-pencil"></i>
                            </button>

                            <form action="/patients/supprimer" method="POST" 
                                onsubmit="return confirm('Voulez-vous vraiment supprimer ce patient ?');" 
                                style="display:inline;">
                                <input type="hidden" name="id" value="<?= $patient['id'] ?>">
                                <button type="submit" class="btn-action btn-supprimer">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>

                         
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>

        <div class="pagination">
            <?php for($i = 1; $i <= $nb_pages; $i++): ?>
                <a href="/patients?p=<?= $i ?>&search=<?= urlencode($search) ?>" 
                   class="filtre-btn <?= $i == $page_courante ? 'active' : '' ?>"><?= $i ?></a>
            <?php endfor; ?>
        </div>
    </div>
   
     <?php include __DIR__ . '/_form.php'; ?>
</div>
<?php include __DIR__ . '/_modal_modifier.php'; ?>
<script>
    document.querySelectorAll(".modifier").forEach(btn => {
    btn.addEventListener("click", function() {
        let id = this.dataset.id;

   
        fetch("/patients/get?id=" + id)
            .then(response => response.json())
            .then(data => {
            
                document.getElementById("patient_id").value = data.id;
                document.querySelector("#modifierPatient input[name='nom']").value = data.nom;
                document.querySelector("#modifierPatient input[name='prenom']").value = data.prenom;
                document.querySelector("#modifierPatient input[name='telephone']").value = data.telephone;
                document.querySelector("#modifierPatient input[name='date_naissance']").value = data.date_naissance;
                document.querySelector("#modifierPatient input[name='adresse']").value = data.adresse;

                new bootstrap.Modal(document.getElementById('modifierPatient')).show();
            });
    });
});
setTimeout(() => {
         document.querySelectorAll('.alert').forEach(el => el.remove());
     }, 3000);
</script>
<?php include __DIR__ . '/../layout/footer.php'; ?>
