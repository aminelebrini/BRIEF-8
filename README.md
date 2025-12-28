# MyLibrary - Gestion de Bibliothèque

## 📌 Contexte

Cette plateforme web permet de gérer :

- Les utilisateurs (Reader, Admin)
- Les livres
- Les emprunts de livres

---

## 📋 Fonctionnalités

### 👤 Gestion des Utilisateurs

- Inscription (sign-up)  
- Connexion / Déconnexion  

**Types d’utilisateurs :**

- ✅ Reader : peut emprunter et retourner des livres  
- ✅ Admin : gère les livres  

> L’authentification est gérée par un service séparé (`AuthService`).

---

### 📘 Gestion des Livres

Un livre possède :

- `id`, `title`, `author`, `year`, `status` (`available` / `unavailable`)  

> Un livre peut être emprunté plusieurs fois dans le temps, mais par un seul lecteur à la fois.

---

### 📚 Gestion des Emprunts

L’emprunt est modélisé par la classe `Borrow` :

- `id`, `readerId`, `bookId`, `borrowDate`, `returnDate` (null si non retourné)  

> Si `returnDate = null` → emprunt actif

---

## 🗄️ Schéma SQL

Les tables principales :

- **users**
- **books**
- **borrows**
---

## 📈 Diagrammes

- **UML Classes** : https://drive.google.com/file/d/1TCScEq6oenmGOsLsWpn1WufW_h83ITe4/view?usp=drive_link 
- **ERD (Base de données)** : https://drive.google.com/file/d/1DbpFrjoj9cvtnzH5Yn_yDD1vGpDKNe-8/view?usp=drive_link 

---

## 🧾 User Stories

### 🧑‍💻 Visiteur

- Inscription pour devenir Reader  
- Connexion à son compte  

### 📚 Reader

- Voir la liste des livres  
- Voir les détails d’un livre  
- Emprunter un livre disponible  
- Retourner un livre emprunté  
- Consulter ses emprunts  

### ⚙️ Admin

- Ajouter / modifier / supprimer un livre  
- Voir tous les lecteurs  
- Voir tous les emprunts  

---

## 🎁 Bonus (Optionnel)

- ✅ Page 404 personnalisée  
- ✅ Confirmation par email pour l’inscription  
- ✅ Pagination des livres  

---

## 🛠️ Installation

1. Cloner le dépôt :  
```bash
git clone https://github.com/aminelebrini/BRIEF-8.git
