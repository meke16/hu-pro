# HU PC Checkup System

A simple PHP + MySQL web app for managing **student PC checkup / assignment records** at Haramaya University.

![Project screenshot](sample-image/Screenshot%20from%202026-01-04%2021-39-45.png)

## Features

- Add student PC records (name, ID, department, campus, PC serial/model, contact, year)
- Upload an optional student photo (stored in `uploads/`)
- Search by student name or ID number
- View record details in a quick profile overlay
- Update and delete records
- Print-friendly records page

## Tech stack

- PHP (no framework)
- MySQL / MariaDB
- Bootstrap 5 + jQuery
- Optional: Python seeding script for inserting sample data

## Project structure

- `index.php` – entry page (root version)
- `display.php` – main CRUD page
- `update.php` – update form
- `connect.php` – MySQL connection
- `uploads/` – uploaded photos
- `insert_students_bulk.sql` – sample bulk insert for the `students` table
- `scripts/seed_students.py` – optional script to insert data from code / SQL
- `pc/` – alternate UI/router version (supports `/home` and `/display` routes)

## Prerequisites

- PHP 8.x (7.4+ may work, but 8.x recommended)
- MySQL or MariaDB

## Database setup

1) Create the database:

```sql
CREATE DATABASE hu;
```

2) Create the `students` table (minimal schema that matches the app code):

```sql
USE hu;

CREATE TABLE students (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  sex VARCHAR(10) NOT NULL,
  idNumber VARCHAR(50) NOT NULL,
  department VARCHAR(255) NOT NULL,
  campus VARCHAR(50) NOT NULL,
  pcSerialNumber VARCHAR(100) NOT NULL,
  pcModel VARCHAR(100) NULL,
  contact VARCHAR(100) NULL,
  photo VARCHAR(255) NULL,
  year INT NOT NULL,
  UNIQUE KEY uniq_idNumber (idNumber)
);
```

3) Configure DB credentials:

- Edit `connect.php` and update host/user/password/database to match your local MySQL setup.

## Run the app (root version)

From the repo root:

```bash
php -S localhost:8000
```

Open:

- http://localhost:8000/index.php

## Run the app (`pc/` version)

The `pc/` folder contains a router-style entry file that serves `/home` and `/display`.

```bash
cd pc
php -S localhost:8001
```

Open:

- http://localhost:8001/home
- http://localhost:8001/display

## Insert sample data

### Option A: Run the bulk SQL file

```bash
mysql -u root -p hu < insert_students_bulk.sql
```

### Option B: Insert from code (Python)

The script can:
- Execute `insert_students_bulk.sql`, or
- Insert a small list of rows defined inside the script (edit the list to add your own data)

Install Python deps (optional):

```bash
python -m venv .venv
. .venv/bin/activate
pip install -r requirements.txt
```

Run:

```bash
./.venv/bin/python scripts/seed_students.py --sql insert_students_bulk.sql
# or
./.venv/bin/python scripts/seed_students.py
```

## Notes

- Uploaded photos are stored in `uploads/` (make sure the folder is writable by PHP).
- If you deploy to Apache/Nginx, ensure file upload limits and permissions are configured correctly.
