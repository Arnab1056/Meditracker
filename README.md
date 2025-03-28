# MediTracker

## Description
MediTracker is a real-time medicine availability platform that connects patients with nearby pharmacies. It allows users to search for medicines, check stock availability, and place orders for home delivery. The system also provides pharmacy management tools, inventory alerts, and secure payment options.

## Features
- **Real-Time Medicine Availability**: Search for medicines and check their availability in nearby pharmacies.
- **Pharmacy Management**: Manage pharmacy details, inventory, and medicine stock efficiently.
- **User Roles**: Supports multiple user roles such as Admin, Pharmacy, Medicine Maker, and End User.
- **Order and Delivery**: Place orders for medicines and opt for home delivery services.
- **Inventory Alerts**: Automated alerts for low stock and expired medicines.
- **Payment Integration**: Secure payment options for purchasing medicines.
- **Responsive Design**: Accessible on both web and mobile platforms.
- **Admin Dashboard**: Manage users, pharmacies, and medicines with ease.
- **User-Friendly Interface**: Simple and intuitive interface for all users.

## Requirements
- PHP >= 7.4
- Composer
- Laravel Framework
- MySQL or any supported database

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/your-repo/project.git
   cd project
   ```

2. Install dependencies:
   ```bash
   composer install
   ```

3. Copy the `.env.example` file to `.env` and configure your environment variables:
   ```bash
   cp .env.example .env
   ```

4. Generate the application key:
   ```bash
   php artisan key:generate
   ```

5. Run migrations and seed the database:
   ```bash
   php artisan migrate
   php artisan db:seed --class=UserSeeder
   ```

6. Start the development server:
   ```bash
   php artisan serve
   ```

## Usage
- Access the application in your browser at `http://localhost:8000`.
- Use the Admin Dashboard to manage users, pharmacies, and medicines.
- Search for medicines, check availability, and place orders.

