<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SantéPlus - Gestion Clinique</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=Playfair+Display:wght@600&display=swap" rel="stylesheet"/>

    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <header class="navbar navbar-expand-lg bg-white border-bottom sticky-top px-4" style="height: 56px;">
        <div class=" topbar" >
            
                <img src="/images/snpluslogo.png" alt="Logo" height="120" class="me-2">
            
        </div>

        <div class="sidebar">
            <nav class="sidebar-nav">
                <a href="/" class="nav-item <?= $page == 'accueil' ? 'active bg-principal text-white rounded' : ''?>">
                   <i class="bi bi-grid-fill"></i>
                   <span>Tableau de bord</span>
                </a>
                
                <a href="/rendezvous" class="nav-item <?= $page == 'rendezvous' ? 'active bg-principal text-white rounded' : ''?>">
                    <i class="bi bi-calendar2-check-fill"></i>
                    <span>Rendez-vous</span>
                </a>
                
                <a href="/patients" class="nav-item <?= $page == 'patients' ? 'active bg-principal text-white rounded' : ''?>">
                    <i class="bi bi-people-fill"></i>    
                    <span>Patients</span>
                </a>
                
                <a href="/medecins" class="nav-item <?= $page == 'medecins' ? 'active bg-principal text-white rounded' : ''?>">
                    <i class="bi bi-person-badge-fill"></i>
                    <span>Médecins</span>
                </a>
                
                <hr style="border-color: var(--bordure); margin: 0.5rem 1rem;">
                
                <a href="/logout" class="nav-item danger">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Déconnexion</span>
                </a>
            </nav>
        </div>
    </header>

    <div class="main-content">