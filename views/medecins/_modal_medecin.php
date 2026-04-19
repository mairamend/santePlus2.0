<div class="modal fade" id="modifierMedecin" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h1 class="modal-title fs-5">Modifier un médecin</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="medecins/modifier" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="id" id="medecin_id">
                    <input type="text" name="nom" class="form-control mb-2" required>
                    <input type="text" name="specialite"class="form-control mb-2" required>
                    <input type="email" name="email"class="form-control mb-2" required>
                    <input type="text" name="telephone" class="form-control mb-3" required>
                    <input type="hidden" name="user_id" id="user_id">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn-primary-sante">Enregistrer</button>
                </div>
            </form>

        </div>
    </div>
</div>