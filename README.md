Sure! Here's the updated `README.md` content where I've added a clear note under the installation section, asking users to set up their own `.env` file **and** generate their own `JWT_SECRET` using the proper Artisan command:

---

```markdown
# ✈️ Flight Search and Booking System

A Laravel-based RESTful API for searching and booking flights, secured with JWT authentication.

---

## 🚀 Features

- ✅ User registration and authentication (JWT)
- 🔎 Flight search with filters:
  - Origin airport
  - Destination airport
  - Departure date
  - Number of passengers
- 📘 Flight booking functionality
- 🛠 RESTful API endpoints

---

## 🧰 System Requirements

- PHP 8.0+
- Composer
- MySQL 5.7+
- Laravel 9.x

---

## ⚙️ Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/delmashajan/Flight-Booking-System.git
   cd Flight-Booking-System
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Copy `.env` file and configure environment**
   ```bash
   cp .env.example .env
   ```
   - Update the `.env` file with your **database credentials** and other configuration values.
   - ⚠️ **Do not add the JWT secret manually.** Run the next step to generate it securely.

4. **Generate application key**
   ```bash
   php artisan key:generate
   ```

5. **Set up JWT secret**
   ```bash
   php artisan jwt:secret
   ```

6. **Run migrations and seed sample data**
   ```bash
   php artisan migrate --seed
   ```

---

## 📡 API Endpoints

### 🔐 Authentication

| Method | Endpoint       | Description           |
|--------|----------------|-----------------------|
| POST   | `/api/register` | Register new user     |
| POST   | `/api/login`    | Login user            |
| POST   | `/api/logout`   | Logout user           |
| POST   | `/api/refresh`  | Refresh JWT token     |
| GET    | `/api/me`       | Get current user info |

### ✈️ Flights

| Method | Endpoint            | Description              |
|--------|---------------------|--------------------------|
| GET    | `/api/flights/search` | Search flights with filters |

### 📑 Bookings

| Method | Endpoint              | Description            |
|--------|-----------------------|------------------------|
| GET    | `/api/bookings`       | List user bookings     |
| GET    | `/api/bookings/{id}`  | Get booking details    |
| POST   | `/api/bookings`       | Create new booking     |

---

## 💻 Frontend Usage

- Access the frontend at: [http://localhost:8000](http://localhost:8000)
- Register or login
- Search for flights using the form
- Book available flights

---

## 🗃 Data Structure

### Flights Table

| Column           | Type     | Description                  |
|------------------|----------|------------------------------|
| airline          | string   | Airline name                 |
| airline_code     | string   | Airline code                 |
| flight_number    | integer  | Flight number                |
| origin           | string   | 3-character airport code     |
| destination      | string   | 3-character airport code     |
| available_seats  | integer  | Number of seats available    |
| price            | decimal  | Price per seat               |
| departure        | datetime | Departure datetime (UTC)     |
| arrival          | datetime | Arrival datetime (UTC)       |
| duration         | string   | Flight duration              |
| operational_days | json     | Days of week (0=Sun to 6=Sat)|

### Bookings Table

| Column            | Type     | Description                              |
|-------------------|----------|------------------------------------------|
| user_id           | FK       | Linked user ID                           |
| flight_id         | FK       | Linked flight ID                         |
| passenger_count   | integer  | Number of passengers                     |
| total_price       | decimal  | Total booking price                      |
| status            | string   | Booking status                           |
| passenger_details | json     | JSON of passenger information(Name & Age)|

---

## 🔒 Notes

- All API endpoints **except** `/api/register` and `/api/login` require JWT authentication.
- Sample flight data is seeded automatically during migrations.
- All datetime values use **UTC** timezone.

---
