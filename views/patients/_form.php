<div class="card-section form-section">
    <div class="section-header">
        <span class="section-title"><i class="bi bi-person-plus-fill"></i> Nouveau Patient</span>
    </div>
    
    <div class="form-body">
       

        <form action="/patients/ajouter" method="POST">
            <label class="form-label text-muted small">Nom</label>
            <input class="form-control mb-3" type="text" name="nom" 
                   placeholder="Nom de famille" required minlength="2" />
            <label class="form-label text-muted small">Prénom</label>
            <input class="form-control mb-3" type="text" name="prenom" 
                   placeholder="Prénom" required minlength="2" />

            <label class="form-label text-muted small">Date de naissance</label>
            <input class="form-control mb-3" name="date_naissance" type="date" required />
            <label class="form-label text-muted small">Téléphone</label>
            <input class="form-control mb-3" type="tel" name="telephone" 
                   placeholder="770000000" required 
                   pattern="^(77|78|70|76|75|71|72)[0-9]{7}$" 
                   title="Le numéro doit commencer par 77, 78, 70, 76 ou 75 et contenir 9 chiffres au total." />
            <label class="form-label text-muted small">Adresse</label>
            <input type="text" class="form-control mb-3" name="adresse" 
                   placeholder="Adresse (ex: Médina, Dakar)" required>

            <hr class="form-divider" />
            
            <button class="btn-submit" type="submit" style="width: 100%;">
                <i class="bi bi-plus-circle"></i> Ajouter le patient
            </button>
        </form>
    </div>
</div>