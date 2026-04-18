
            <div class="card p-3 shadow-sm">
                <h5 class="mb-3 fw-bold">Ajouter un médecin</h5>

                <form action="medecins/ajouter" method="POST">
                    <label for="" class="form-label">Nom complet</label>
                    <input type="text" name="nom" placeholder="Nom complet" class="form-control mb-2" required>
                    <label for="" class="form-label">Spécialité</label>
                    <input type="text" name="specialite" placeholder="Spécialité" class="form-control mb-2" required>
                    <label for="" class="form-label">Email</label>
                    <input type="email" name="email" placeholder="Email" class="form-control mb-2" required>
                    <label for="" class="form-label">Téléphone</label>
                    <input type="text" name="telephone" placeholder="Téléphone" class="form-control mb-3" required>

                    <button type="submit" class=" btn-submit-ajouter w-100">Ajouter</button>
                </form>
            </div>
        
