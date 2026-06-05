<div align="center">

# ISTIKAMA

### Centralized Educational Management Platform

**Multi-school administration · Digital learning · Academic excellence**

[![Platform](https://img.shields.io/badge/platform-Moodle%205.1-orange)](https://moodle.org)
[![PHP](https://img.shields.io/badge/PHP-8.2-777bb4)](https://www.php.net)
[![Database](https://img.shields.io/badge/database-MySQL%208.4-4479a1)](https://www.mysql.com)
[![Deploy](https://img.shields.io/badge/deploy-Docker%20Compose-2496ed)](https://docs.docker.com/compose/)
[![i18n](https://img.shields.io/badge/i18n-AR%20%C2%B7%20EN%20%C2%B7%20FR-success)]()
[![Release](https://img.shields.io/badge/release-0.23.0-blue)]()

</div>

---

## Overview

**Istikama** is a centralized educational management platform that streamlines the
complete lifecycle of school operations — from organizational structure and user
enrollment to digital content delivery, academic assessment, attendance, and parent
engagement.

Purpose-built for **private school networks**, Istikama unifies administration,
pedagogy, and communication into a single platform with **role-based dashboards** for
every stakeholder. It is delivered as a tightly-integrated **Moodle 5.1** distribution
composed of a custom plugin and theme, deployed via Docker.

It scales to **500 schools**, **10,000 users**, and **5,000 digital content items** from
a single deployment, with first-class **Arabic (RTL)**, **English**, and **French**
localization.

---

## Key Features

| Domain | Capability |
| --- | --- |
| **Multi-tenant management** | Schools → levels → classes → subjects, managed from one console with per-institution data isolation and shared central resources. |
| **Role-based dashboards** | Seven tiers — Super Admin, Technical Professor (editor), School Manager, Teacher, Teacher-Creator, Student, Parent — each with a purpose-built view. |
| **Moderated digital library** | Documents, videos, H5P, books, quizzes & external links flow through a structured review/approval workflow before reaching students. |
| **Assessment engine** | Central question bank organized by level & subject; simplified quiz builder; moderation pipeline. |
| **Attendance & behavior** | Daily attendance (present / absent / late / excused) and behavioral notes, surfaced to managers and parents in real time. |
| **Reporting & analytics** | Four-tier reporting (system / school / teacher / student) with interactive charts and auto-generated insights. |
| **Seasons & promotion** | Academic seasons with bulk student/teacher promotion and full historical archiving. |
| **Parent portal** | Track grades, attendance and behavior across multiple children. |
| **Advertisements & support** | In-platform announcements, plus a built-in support-ticket center. |
| **Localization** | Native **Arabic (full RTL)**, **English**, **French**; fully responsive across phone / tablet / desktop. |

---

## Architecture

Istikama is a **Moodle distribution**: the Moodle core provides the LMS foundation, and
all product-specific behavior lives in a custom plugin and theme.

```
┌──────────────────────────────────────────────────────────────────┐
│  Browser (responsive — phone · tablet · desktop, LTR + RTL)        │
└───────────────────────────────┬──────────────────────────────────┘
                                 │ HTTP :8080
┌───────────────────────────────▼──────────────────────────────────┐
│  moodle_app  (moodlehq/moodle-php-apache:8.2)                      │
│  ┌──────────────────────────────────────────────────────────────┐ │
│  │  Moodle 5.1 core  (document root: /var/www/html/public)       │ │
│  │   ├── local/istikama_admin   ← business logic, pages, AJAX    │ │
│  │   └── theme/istikama         ← dashboard shell, layouts, CSS  │ │
│  └──────────────────────────────────────────────────────────────┘ │
└───────────────────────────────┬──────────────────────────────────┘
                                 │ mysqli
┌───────────────────────────────▼──────────────────────────────────┐
│  moodle_db  (mysql:8.4)   ·   moodledata (file storage, on host)  │
└──────────────────────────────────────────────────────────────────┘
```

### Components

| Component | Path | Description |
| --- | --- | --- |
| `local_istikama_admin` | `moodle-docker/moodle/public/local/istikama_admin` | Core plugin: 50+ pages, dashboards, AJAX endpoints, 31 custom DB tables, AR/EN/FR strings. |
| `theme_istikama` | `moodle-docker/moodle/public/theme/istikama` | Custom theme: sidebar dashboard shell, layouts, global responsive design system. |
| Docker setup | `docker-compose.yml` | Two-service stack (PHP/Apache + MySQL). |
| Moodle core | `moodle-docker/moodle` | Moodle 5.1.3+ (GPL v3, upstream). |

---

## Tech Stack

- **LMS core:** Moodle `5.1.3+` (build 20260320, branch 501)
- **Runtime:** PHP `8.2` (Apache), via `moodlehq/moodle-php-apache:8.2`
- **Database:** MySQL `8.4`
- **Front end:** Server-rendered PHP + Mustache templates, vanilla JS, Chart.js, custom CSS design system
- **Orchestration:** Docker Compose
- **Plugin:** `local_istikama_admin` v0.23.0 · **Theme:** `theme_istikama`

---

## Prerequisites

- [Docker](https://docs.docker.com/get-docker/) **20.10+**
- [Docker Compose](https://docs.docker.com/compose/) **v2+** (`docker compose`)
- ~4 GB free disk, ports **8080** (app) and **3306** (internal) available

---

## Quick Start

```bash
# 1. Clone
git clone https://github.com/Ayoub-Abdallah/Al-Istikama.git
cd Al-Istikama

# 2. Start the stack (PHP/Apache + MySQL)
docker compose up -d

# 3. Wait ~30s for MySQL to initialize, then install the Moodle database.
#    (config.php is already wired to the docker DB; this also installs the
#     istikama plugin + theme and creates all custom tables.)
docker exec -it istikama-moodle_app \
  php /var/www/html/public/admin/cli/install_database.php \
  --agree-license \
  --fullname="Istikama" \
  --shortname="istikama" \
  --adminuser=admin \
  --adminpass='ChangeMe!2026' \
  --adminemail=admin@example.com

# 4. Purge caches
docker exec -it istikama-moodle_app \
  php /var/www/html/public/admin/cli/purge_caches.php
```

Then open **http://localhost:8080** and sign in with the admin credentials from step 3.

> **First-run note:** the database lives in a Docker named volume (`db_data`) that is
> **not** part of this repository, so a fresh clone starts with an empty database — step 3
> provisions it. If you have an existing SQL dump, restore it instead of running
> `install_database.php`.

### Service configuration

Defined in [`docker-compose.yml`](docker-compose.yml):

| Service | Image | Port | Notes |
| --- | --- | --- | --- |
| `istikama-moodle_app` | `moodlehq/moodle-php-apache:8.2` | `8080:80` | Document root `/var/www/html/public`. Code bind-mounted from `./moodle-docker/moodle`. |
| `istikama-moodle_db` | `mysql:8.4` | internal | DB `moodle`, user `moodleuser`. Data in volume `db_data`. |

---

## Project Structure

```
.
├── docker-compose.yml                 # Two-service stack definition
├── README.md
├── ISTIKAMA_Technical_File.md         # Full technical specification
├── assets/                            # Landing pages, logos, design assets
└── moodle-docker/
    ├── moodle/                        # Moodle 5.1 core (document root: public/)
    │   └── public/
    │       ├── local/istikama_admin/  # ★ Custom plugin (business logic)
    │       │   ├── *.php               #   50+ pages & AJAX endpoints
    │       │   ├── classes/            #   form & service classes
    │       │   ├── templates/          #   Mustache templates
    │       │   ├── styles/             #   CSS design system + responsive layer
    │       │   ├── db/                 #   install.xml (31 tables), access, services
    │       │   └── lang/{ar,en,fr}/    #   localization
    │       └── theme/istikama/        # ★ Custom theme (dashboard shell)
    │           ├── templates/          #   dashboard_layout, frontpage
    │           └── style/              #   theme CSS
    └── moodledata/                    # Moodle file storage (runtime)
```

### Custom database tables

The plugin defines **31** tables (see `db/install.xml`), including:
`istikama_school_info`, `istikama_user_school`, `istikama_global_level`,
`istikama_class_subjects`, `istikama_content_bank`, `istikama_quiz_templates`,
`istikama_question_meta`, `istikama_attendance`, `istikama_assessments`,
`istikama_season`, `istikama_season_promotion`, `istikama_support_tickets`,
`istikama_parent_child`, `istikama_advertisement`, and more.

---

## Development

```bash
# Apply PHP / page changes — restart the app container (clears OPcache)
docker restart istikama-moodle_app

# Apply template / language / config changes — purge Moodle caches
docker exec istikama-moodle_app php /var/www/html/public/admin/cli/purge_caches.php

# Run any Moodle CLI (e.g. DB upgrade after a plugin version bump)
docker exec -it istikama-moodle_app php /var/www/html/public/admin/cli/upgrade.php
```

**Conventions**

- User-facing strings live in `lang/{ar,en,fr}/local_istikama_admin.php` and are read via
  `get_string('key', 'local_istikama_admin')` / `{{#str}}key, local_istikama_admin{{/str}}`.
- After editing a stylesheet referenced with a `?v=NN` cache-buster (e.g.
  `istikama_admin.css?v=NN` in `theme/istikama/templates/dashboard_layout.mustache`),
  bump `NN` and purge caches.
- The platform is fully responsive — a global responsive layer at the end of
  `local/istikama_admin/styles/istikama_admin.css` handles tables, grids, modals and
  layouts across all breakpoints (320 px → 1440 px), LTR and RTL.

---

## Security

> [!IMPORTANT]
> This repository is a **development environment** and intentionally contains the local
> `config.php`, `moodledata/`, and Docker default credentials for convenience. **Before
> any production or shared deployment:**
> - Rotate all credentials (`docker-compose.yml` DB passwords, the Moodle admin password).
> - Replace `moodle-docker/moodle/config.php` (`$CFG->dbpass`, `$CFG->passwordsaltmain`,
>   `$CFG->wwwroot`) with production values and keep it out of version control.
> - Do not commit `moodledata/` (runtime state, sessions, uploaded files) in production.
> - Serve over HTTPS behind a reverse proxy.

---

## License

- **Moodle core** is distributed under the **GNU GPL v3** — see `moodle-docker/moodle/COPYING.txt`.
- The `local_istikama_admin` plugin and `theme_istikama` theme are Moodle plugins and,
  as derivative works of Moodle, are likewise **GPL v3**.

---

<div align="center">
<sub>Istikama — Empowering schools with intelligent administration, digital learning & academic excellence.</sub>
</div>
