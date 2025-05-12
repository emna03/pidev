# 🏙️ CiviSmart – Smart City Platform

## 📝 Overview

Ce projet a été développé dans le cadre du cours **PIDEV 3A** à **Esprit School of Engineering**.  
Il a pour objectif de proposer une plateforme intelligente pour la gestion urbaine en utilisant des technologies avancées telles que l’intelligence artificielle, la reconnaissance faciale, les statistiques interactives et un chatbot IA.  

Cette application illustre l'intégration entre **Symfony**, **Flask**, **Python**, **JavaScript**, et des outils modernes pour l'administration de villes intelligentes.

---

## ✨ Features

- 🔐 Authentification sécurisée (email + mot de passe)
- 🧠 Authentification par reconnaissance faciale (Face ID)
- 💬 ChatBot IA (via Ollama/Mistral) spécialisé en Smart City
- 📊 Statistiques interactives avec **ApexCharts**
- 👤 Dashboard Admin (utilisateurs, statistiques)
- 📧 Notifications par mail (activation, mot de passe oublié)
- 📱 Interface responsive et moderne (Twig + Bootstrap)
- 🧪 Tests unitaires Symfony avec PHPUnit

---

## 🧰 Tech Stack

### ⚙️ Backend

- Symfony 6.4+
- Doctrine ORM
- PHPUnit

### 🎨 Frontend

- Twig
- Bootstrap
- ApexCharts

### 🤖 IA & Reconnaissance Faciale

- Python 3.8+
- Flask
- InsightFace (ArcFace)
- DeepSeekChat via Ollama
- 

### 🧩 Autres outils

- Composer
- Symfony CLI
- Node.js & npm
- Git
- MySQL
- Ollama
- Virtualenv (Python)

---

## 📁 Directory Structure

```
├── src/                  # Code Symfony
├── templates/            # Fichiers Twig
├── public/               # JS, CSS, images accessibles
├── python-face-api/      # Scripts Python pour Face ID
├── migrations/           # Migrations Doctrine
├── .env                  # Config environnement local
├── composer.json         # Dépendances PHP
└── README.md
```

---

## 🚀 Getting Started

### 1. Cloner le projet

```bash
git clone https://github.com/emna03/pidev.git
cd pidev
```

### 2. Installer les dépendances PHP

```bash
composer install
```

### 3. Configuration de l’environnement

Copier le fichier `.env` vers `.env.local` et modifier les infos de la base :

```dotenv
DATABASE_URL="mysql://user:pass@127.0.0.1:3306/symfony"
```

### 4. Créer la base de données

```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

### 5. Lancer le serveur Symfony

```bash
symfony serve
```

---

## 👁️ Reconnaissance Faciale (Face ID)

### Configuration

```bash
cd python-face-api
python -m venv venv
source venv/bin/activate  # ou venv\Scripts\activate sur Windows
pip install -r requirements.txt
```

### Télécharger le modèle ArcFace

> Non inclus dans le dépôt – à télécharger manuellement :

[https://github.com/deepinsight/insightface](https://github.com/deepinsight/insightface)

Déposer dans :
```
ProjetPi/python-face-api/arcfaceresnet100-8.onnx
```

### Lancer le serveur Flask

```bash
python app.py
```

---

## 💬 ChatBot SmartCity (Mistral)

### 1. Télécharger Ollama

[https://ollama.com/download](https://ollama.com/download)

### 2. Lancer le modèle Mistral

```bash
ollama run mistral:7b-instruct
```

> Le modèle s’exécutera automatiquement via `/chat/send`.

---

## 📊 Statistiques

Disponible à l’adresse `/admin/statistiques`.  
Permet de visualiser :

- Répartition par rôles
- Utilisateurs actifs vs inactifs
- Nombre d’inscriptions par mois

> Rendu graphique dynamique via ApexCharts.

---

## 🧪 Tests

```bash
php bin/phpunit
```

---

## 🧠 Topics

Les **topics** GitHub à utiliser pour ce dépôt :

- `symfony`
- `python`
- `flask`
- `machine-learning`
- `web-development`
- `smart-city`
- `facial-recognition`
- `ai-chatbot`
- `data-visualization`
- `esprit-school-of-engineering`

---

## 🙌 Acknowledgments

Ce projet a été réalisé sous la supervision de l’équipe pédagogique de **Esprit School of Engineering**, dans le cadre du module PIDEV 3A.  
Un remerciement spécial à tous les enseignants qui nous ont accompagnés durant ce parcours.

---

## 👥 Équipe de développement

Développé par :
**Anas Souissi, Ismail Chaabane, Chemlali Ismail, Mourad Missaoui, Siwar Slimi, Emna Missaoui** 🚀