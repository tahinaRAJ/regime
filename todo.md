# Base
- [x] creation de la base
- [x] creation des tables
- [ ] insertion des donnees de test

# Backend
- [ ] login et inscription
  - [ ] creation de model
    - [x] User
    - [x] Caracteristique
    - [x] Portemonaie
  - [x] creation de AuthFilter
  - [x] creation de RoleFilter
  - [x] update Config/Filters.php
  - [ ] creation de model
    - [x] UserModel
    - [x] PaiementModel
    - [x] PorteMonaieModel
      - [x] getSolde()
      - [x] DeductSolde()
      - [x] addSoldeByCode()
      - [x] validerCode()
    - [x] RegimeModel
      - [ ] predictActivityNecessaire()
      - [ ] predictRegimeNecessaire()
  
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
      - [ ] exporter resultat en PDF
    - [ ] PorteMonaieController
      - [ ] recharger avec code
    - [ ] GoldController
      - [ ] paiement option gold (une seule fois)
      
# Frontend
- [x] trouver un template pour le login/sign up
- [ ] integrer le template dans les views
- [ ] affichage de l'imc dans le dashboard
- [ ] creer la view de selection d'option et affichage de regime + sport necessaire
- [ ] export PDF de la recommandation
- [ ] page rechargement porte monnaie avec code
- [ ] affichage prix normal vs prix gold (-15%)