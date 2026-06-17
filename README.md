<h1>TutorPSO – Online Tutoring & Scheduling Platform</h1>
<img src="https://raw.githubusercontent.com/adljna/Tutor/master/public/USER STUDIES TUTOR - KELOMPOK 2.png" width="100%" alt="Tutor Banner"/>

<h3>A Laravel-based platform designed to simplify booking, managing, and conducting tutoring sessions.</h3>
<p>The platform connects students with qualified tutors through an integrated scheduling system, tutor profiles, booking management, and digital learning history. In a world where flexible and accessible learning is essential, TutorPSO provides a modern solution that helps students learn more efficiently while enabling tutors to manage sessions with ease.</p>

<p>
  <img src="https://img.shields.io/badge/Laravel-10.x-red" />
  <img src="https://img.shields.io/badge/PHP-8.2-blue" />
  <img src="https://img.shields.io/badge/Database-PostgreSQL-336791?logo=postgresql&logoColor=white" />
  <img src="https://img.shields.io/badge/Deployed%20on-Azure-0078D4?logo=microsoft-azure&logoColor=white" />
  <img src="https://img.shields.io/badge/Status-Active-success" />
</p>

---

## 🎯 Objective

TutorPSO aims to deliver a streamlined and effective learning experience through:

- **A fast and intuitive tutoring session booking system**
- **Flexible schedule and booking management**
- **Complete tutor and student profiles**
- **A clean, modern, and user-friendly interface**

This platform supports interactive learning while improving accessibility for both students and tutors.

---

## ✨ Features

- User authentication (login & register)
- Tutor search with category filters
- Booking system with schedule selection
- Session management (upcoming & past)
- Free trial session workflow
- Refund request process
- Tutor profile with rating & experience

---

## 🛠️ Tech Stack

| Layer | Technology |
|---|---|
| Backend | Laravel 10, PHP 8.2 |
| Frontend | Blade Templates, Vite |
| Database | PostgreSQL (Supabase) |
| Containerization | Docker |
| CI/CD | GitHub Actions |
| Cloud | Azure App Service |

---

## 🚀 Currently in Development

This project is actively being developed and improved. Recent and ongoing work includes:

-  **Bug fixes** — Resolved duplicate booking prevention, dynamic session billing, and refund guard logic
-  **Database migration** — Moved from local MySQL to Supabase PostgreSQL
-  **Containerization** — Dockerized with multi-stage build (Node 18 + PHP 8.2 Apache)
-  **Cloud deployment** — Deployed to Azure App Service via Azure Container Registry
-  **CI/CD pipeline** — GitHub Actions workflow with automated testing (PHPUnit) and linting before every deployment
-  **Automated testing** — Feature & unit tests covering booking, refund, review, login, and more

---

## ⚙️ Local Setup

```bash
# Clone the repository
git clone https://github.com/adljna/Tutor.git
cd Tutor

# Install dependencies
composer install
npm install

# Configure environment
cp .env.example .env
php artisan key:generate

# Run migrations
php artisan migrate

# Build frontend & serve
npm run dev
php artisan serve
```

---

## 👥 Contributors

This project is collaboratively developed by:

| Name | GitHub | NRP |
|---|---|---|
| Realasa Femmi Novelika | [@realasa23](https://github.com/realasa23) | 5026231113 |
| Harya Raditya Handoyo | [@haryaa123](https://github.com/haryaa123) | 5026231176 |
| Haliza Putri Amelliani | [@lizamelliani](https://github.com/lizamelliani) | 5026231213 |
| Michelle Lea Amanda | [@MichelleLea26](https://github.com/MichelleLea26) | 5026231214 |
