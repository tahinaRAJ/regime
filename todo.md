# Base
- [x] creation de la base
- [x] creation des tables
- [ ] insertion des donnees de test

# Backend
- [ ] login et inscription
  - [ ] creation de model
    - [x] User
    - [ ] Caracteristique
    - [ ] Portemonaie
  - [x] creation de AuthFilter
  - [x] creation de RoleFilter
  - [x] update Config/Filters.php
  - [ ] creation de model
    - [x] UserModel
    - [ ] PaiementModel
    - [ ] PorteMonaieModel
      - [ ] getSolde()
      - [ ] DeductSolde()
    - [ ] RegimeModel
      - [ ] predictActivityNecessaire()
      - [ ] predictRegimeNecessaire()
      - [ ] 
  - [ ] creation de controller
    - [ ] AuthController
      - [x] showLoginForm
      - [x] login
      - [x] logout
      - [ ] createAccount
    - [ ] UserController
      - [ ] showProfil (choix et info perso)
    - [ ] RegimeController
      - [ ] predictRegime()
        - [ ] prends les informations de l'user en session
        - [ ] appelle de predictActivityNecessaire() et predictRegimeNecessaire()
        - [ ] return en json pour l'ajax
      
# Frontend
- [ ] trouver un template pour le login/sign up
- [ ] integrer le template dans les views
- [ ] creer la view de selection d'option et affichage de regime + sport necessaire