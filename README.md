---

# ClubHub: A Unified Platform for Campus Club & Society Management and Engagement

A PHP-based cmapus club and society management and engagement system that allows students to apply for clubs, while administrators and officers manage club records efficiently. Built using PHP, MySQL, HTML, CSS, JavaScript and Bootstrap.

---

## 📁 Features

- Student registration and club applications
- Admin and club officer dashboards
- Manage clubs, events, and users (CRUD)
- Login with role-based access
- Dashboard statistics and notifications

---

## 🛠️ Requirements

- PHP 7.4 or higher
- MySQL 
- XAMPP
- Modern web browser (Chrome, Firefox, etc.)

---

## ⚙️ Setup Instructions

### 1. Clone or Download the Repository

```bash
git clone https://github.com/your-username/clubhub.git
````

Or download the ZIP file and extract it into your local web server directory (e.g., `htdocs` for XAMPP users).

---

### 2. Set Up the Database

Follow these steps to set up the MySQL database:

#### a. Start Apache and MySQL

* Launch **XAMPP Control Panel**
* Start **Apache** and **MySQL**

#### b. Open phpMyAdmin

* In your browser, go to:

  ```
  http://localhost/phpmyadmin
  ```

#### c. Create the Database

* Click **New**
* Name the database:

  ```
  clubhub_db
  ```
* Click **Create**

#### d. Import the SQL File

* Select the newly created `clubhub_db`
* Go to the **Import** tab
* Click **Choose File** and select:

  ```
  db/clubhub_db.sql
  ```
* Click **Go** to import all tables and data

---

### 3. Configure the Database Connection

Edit the file `config/db.php` and make sure your credentials match your local MySQL setup:

```php
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'clubhub_db';
```

> If you set a password for your MySQL `root` user, update the `$pass` variable accordingly.

---

### 4. Enable GD Library (Optional but Recommended)

1. Open the `php.ini` file (usually found at `C:\xampp\php\php.ini`)
2. Search for:

   ```
   ;extension=gd
   ```
3. Remove the semicolon to enable:

   ```
   extension=gd
   ```
4. Save and restart Apache from the XAMPP Control Panel

---

### 5. Launch the Application

* Open your browser and navigate to:

  ```
  http://localhost/clubhub/
  ```

---

## 👤 Default Admin Login

```
Username: admin
Password: admin123
```

