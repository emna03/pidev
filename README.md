# 🏙️ CiviSmart - Smart City Platform

CiviSmart est une application Symfony moderne conçue pour améliorer la gestion urbaine grâce à l'intelligence artificielle, la reconnaissance faciale, les statistiques et une interface d’administration intuitive.

---

## 📦 Installation

### Prérequis

- PHP 8.1+
- Composer
- Symfony CLI (recommandé)
- Node.js & npm
- Python 3.8+
- Git
- MySQL ou autre base compatible Doctrine

### Cloner le projet

```bash
git clone https://github.com/emna03/pidev.git
cd pidev
```

---

## ⚙️ Backend Symfony

### 1. Installer les dépendances PHP

```bash
composer install
```

### 2. Configurer `.env`

Copier `.env` → `.env.local` et mettre à jour votre connexion base de données :

```dotenv
DATABASE_URL="mysql://user:pass@127.0.0.1:3306/civismart"
```

### 3. Créer la base & migrations

```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

### 4. Lancer le serveur Symfony

```bash
symfony serve
```

---

## 🎥 Reconnaissance Faciale (Face ID)

### 1. Aller dans le dossier Python

```bash
cd python-face-api
```

### 2. Créer l'environnement virtuel

```bash
python -m venv venv
venv\Scripts\activate   # Sur Windows
source venv/bin/activate  # Sur Mac/Linux
```

### 3. Installer les dépendances Python

```bash
pip install -r requirements.txt
```

### 4. Télécharger le modèle ArcFace

> Le fichier n’est pas inclus dans ce dépôt.

- Télécharger le modèle depuis :  
  [Télécharger arcfaceresnet100-8.onnx](https://github.com/deepinsight/insightface)

- Placer dans :
  ```
  ProjetPi/python-face-api/arcfaceresnet100-8.onnx
  ```

### 5. Lancer le service Flask

```bash
python app.py
```

---

## 🤖 ChatBot SmartCity (Mistral via Ollama)

### 1. Installer Ollama

[https://ollama.com/download](https://ollama.com/download)

### 2. Lancer le modèle :

```bash
ollama run mistral:7b-instruct
```

> Il se lancera automatiquement si vous utilisez la route `/chat/send`.

---

## 📊 Statistiques utilisateurs

Accessible depuis `/admin/statistiques`, l’admin peut voir :

- Répartition par rôles
- Utilisateurs actifs vs inactifs
- Inscriptions par mois

Utilise **ApexCharts** pour un rendu interactif et moderne.

---

## 🧪 Tests

```bash
php bin/phpunit
```

---

## 🧠 Fonctionnalités principales

- Authentification Symfony (email + mot de passe)
- Authentification par reconnaissance faciale (Face ID)
- ChatBot IA spécialisé Smart City
- Panneau Admin (users, statistiques)
- Notifications mail (activation, mot de passe oublié)
- UI responsive et moderne

---

## 📁 Structure principale

```
├── src/                  # Code Symfony
├── templates/            # Fichiers Twig
├── public/               # Fichiers accessibles (JS, CSS, img)
├── python-face-api/      # Scripts Python (face ID)
├── migrations/           # Migrations Doctrine
├── .env                  # Config env
├── composer.json         # Dépendances PHP
└── README.md
```

---

## 🧑‍💻 Auteur

**CiviSmart - Projet PIDEV**

> Développé par [Chemlali Ismail & équipe] 🚀