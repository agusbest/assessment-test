# Airline Voucher Seat Assignment

A full-stack web application built with **Laravel 12** and **React + Vite** for randomly generating **3 unique voucher-winning seats** for an airline promotional campaign.

The application prevents duplicate voucher generation for the same flight number and flight date while providing a clean and responsive user interface.

---

# Features

- Generate exactly **3 unique random seats**
- Support multiple aircraft layouts
- Prevent duplicate voucher generation for the same flight and date
- Crew information recording
- Responsive React UI
- Laravel REST API
- Form Request Validation
- Composite Unique Constraint (flight_number + flight_date)
- Feature Tests using Laravel Testing

---

# Tech Stack

## Backend

- PHP 8.2+
- Laravel 12
- SQLite
- Eloquent ORM

## Frontend

- React
- Vite
- Axios
- Tailwind CSS

---

# Project Structure

```
assessment-test/
├── backend/
│   ├── app/
│   │   ├── Http/
│   │   │   ├── Controllers/
│   │   │   ├── Requests/
│   │   │   └── Resources/
│   │   ├── Models/
│   │   └── Services/
│   ├── database/
│   ├── routes/
│   └── tests/
│
├── frontend/
│   ├── src/
│   │   ├── assets/
│   │   ├── components/
│   │   ├── pages/
│   │   ├── services/
│   │   ├── App.jsx
│   │   └── main.jsx
│   └── package.json
│
└── README.md
```

---

# Prerequisites

Make sure the following software is installed:

- PHP 8.2 or newer
- Composer
- Node.js 20+
- npm
- Git

---

# Installation

## 1. Clone Repository

```bash
git clone <repository-url>
```

---

## 2. Backend Installation

Go to backend folder.

```bash
cd backend
```

Install PHP dependencies.

```bash
composer install
```

---

## 3. Configure Environment

Copy environment file.

```bash
cp .env.example .env
```

or on Windows

```bash
copy .env.example .env
```

Generate application key.

```bash
php artisan key:generate
```

---

## 4. Configure Database

This project uses SQLite.

Create database file.

```
database/database.sqlite
```

Update `.env`

```env
DB_CONNECTION=sqlite
```

---

## 5. Run Migration

```bash
php artisan migrate
```

---

## 6. Start Backend Server

```bash
php artisan serve
```

Backend runs at

```
http://127.0.0.1:8000
```

---

# Frontend Installation

Open another terminal.

```bash
cd frontend
```

Install dependencies.

```bash
npm install
```

---

## Start Frontend

```bash
npm run dev
```

Frontend runs at

```
http://localhost:5173
```

---

# API Endpoints

## Check Existing Voucher

**POST**

```
/api/check
```

Request

```json
{
    "flightNumber": "GA101",
    "date": "2026-07-19"
}
```

---

## Generate Voucher

**POST**

```
/api/generate
```

Request

```json
{
    "name": "Robin",
    "id": "123",
    "flightNumber": "GA101",
    "date": "2026-07-19",
    "aircraft": "ATR"
}
```

Example Response

```json
{
    "data": {
        "success": true,
        "crew": {
            "name": "Robin",
            "id": "123"
        },
        "flight": {
            "number": "GA101",
            "date": "2026-07-19",
            "aircraft": "ATR"
        },
        "seats": [
            "3B",
            "7C",
            "14D"
        ]
    }
}
```

---

# Validation

Laravel Form Request is used to validate all incoming requests.

Validation includes:

- Crew Name
- Crew ID
- Flight Number
- Flight Date
- Aircraft Type

Custom validation messages are provided for user-friendly error handling.

---

# Database Constraint

To prevent duplicate voucher generation, a composite unique constraint is implemented on:

```
flight_number
flight_date
```

Only one voucher generation is allowed per flight on the same date.

---

# Testing

Run Feature Tests

```bash
php artisan test
```

---

# Screenshots

## Voucher Form

![alt text](form.png)

```
image/form.png
```

---

## Generated Voucher

![alt text](result.png)

```
image/result.png
```

---

# Notes

The application generates **three unique winning seat numbers** for each flight.

These seats represent **voucher-winning seats** during the promotional campaign, not multiple seats assigned to a single passenger.

Only one voucher generation is allowed for each flight number and flight date combination.

---

# Author

Agus Nugraha

Full Stack Developer

Laravel • React • Next.js • Node.js