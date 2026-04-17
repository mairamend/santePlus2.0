<div class="modal fade" id="modifierPatient" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Modifier un Patient</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="/patients/modifier" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="id" id="patient_id">
                    
                    <label class="form-label">Nom</label>
                    <input type="text" name="nom" class="form-control mb-3" required>
                    
                    <label class="form-label">Prénom</label>
                    <input type="text" name="prenom" class="form-control mb-3" required />

                    <label class="form-label">Date de naissance</label>
                    <input class="form-control mb-3" name="date_naissance" type="date" required />

                    <label class="form-label">Téléphone</label>
                    <input class="form-control mb-3" type="tel" name="telephone" required />
                    
                    <label class="form-label">Adresse</label>
                    <input type="text" class="form-control mb-3" name="adresse" required>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn-primary-sante">Enregistrer les modifications</button>
                </div>
            </form>
        </div>
    </div>
</div>