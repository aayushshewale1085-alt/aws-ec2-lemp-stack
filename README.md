# 🌐 AWS Website Hosting using LEMP Stack (Linux, Nginx, MySQL, PHP)

A simple cloud project demonstrating how to deploy a dynamic website on an AWS EC2 Ubuntu instance using the **LEMP Stack (Linux, Nginx, MySQL, PHP)**. The project includes a responsive HTML contact form, PHP backend, MySQL database integration, and Nginx configuration.

---

# 📌 Project Overview

This project demonstrates how to host a dynamic website on AWS using:

- Amazon EC2
- Ubuntu Server
- Nginx Web Server
- PHP-FPM
- MySQL Database
- HTML & CSS Frontend
- PHP Backend

The contact form stores user details into a MySQL database hosted on the same EC2 instance.

---

# 🏗️ Architecture

```
                 Internet
                     │
                     ▼
          AWS EC2 (Ubuntu Server)
                     │
              Nginx Web Server
                     │
                 PHP-FPM
                     │
                 submit.php
                     │
                  db.php
                     │
                 MySQL Database
                     │
              Contact Table
```

---

# 🛠️ Technologies Used

- AWS EC2
- Ubuntu Linux
- Nginx
- PHP 8.5
- PHP-FPM
- MySQL
- HTML5
- CSS3
- Linux Commands

---

# 📂 Project Structure

```
project/

│── index.html
│── submit.php
│── db.php
```

---

# 🚀 Step 1: Launch EC2 Instance

Launch an Ubuntu EC2 instance.

Configuration:

- Ubuntu Server
- t2.micro
- Free Tier
- 8 GB Storage

---
---

### Security Group

| Type | Port |
|-------|------|
| SSH | 22 |
| HTTP | 80 |
| HTTPS | 443 |

---

### Screenshot
<p align="center">
  <img src="https://github.com/user-attachments/assets/9518edc4-af19-4e71-80b4-341630baea11"
       alt="Security Group"
       width="900">
</p>

<p align="center">
  <img src="https://github.com/user-attachments/assets/292755be-3290-4c42-adf2-821a14dfde72"
       alt="EC2 Instance"
       width="900">
</p>


---

# 🚀 Step 2: Connect to EC2

```bash
ssh -i your-key.pem ubuntu@Public-IP
```

---

### Screenshot

<p align="center">
  <img width="900" height="736" alt="Screenshot 2026-07-16 204835" src="https://github.com/user-attachments/assets/d4bc343b-4516-4374-bac5-d98d7635e176">
</p>

---

# 🚀 Step 3: Update Ubuntu

```bash
sudo apt update

sudo apt upgrade -y
```

---



---

# 🚀 Step 4: Install Nginx

```bash
sudo apt install nginx -y
```

Start Nginx

```bash
sudo systemctl start nginx

sudo systemctl enable nginx
```

Check Status

```bash
sudo systemctl status nginx
```

---

---

# 🚀 Step 5: Install MySQL

```bash
sudo apt install mysql-server -y
```

Check

```bash
sudo systemctl status mysql
```

---



---

# 🚀 Step 6: Create Database

Login

```bash
sudo mysql
```

Create Database

```sql
CREATE DATABASE portfolio;
```

---


---

# 🚀 Step 7: Create Database User

```sql
CREATE USER 'portfoliouser'@'localhost'
IDENTIFIED BY 'Password@123';

GRANT ALL PRIVILEGES ON portfolio.* TO
'portfoliouser'@'localhost';

FLUSH PRIVILEGES;
```

---


---

# 🚀 Step 8: Create Contact Table

```sql
USE portfolio;

CREATE TABLE contact(

id INT AUTO_INCREMENT PRIMARY KEY,

name VARCHAR(100),

email VARCHAR(100),

message TEXT,

created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

);
```

---


---

# 🚀 Step 9: Install PHP

```bash
sudo apt install php-fpm php-mysql -y
```

Check Version

```bash
php -v
```

---


---

# 🚀 Step 10: Create Project Directory

```bash
cd /var/www/html

sudo mkdir project

sudo chown -R $USER:$USER project

cd project
```

---


---

# 🚀 Step 11: Create Website Files

Create

```
index.html

submit.php

db.php
```

---


---

# 🚀 Step 12: Configure Database Connection

Edit

```
db.php
```

Update

- Host
- Username
- Password
- Database Name

---


---

# 🚀 Step 13: Configure Nginx

Open the default Nginx configuration file:

```bash
sudo nano /etc/nginx/sites-available/default
```

Modify the default server block to enable PHP processing.

Update the following configuration:

```nginx
server {

    listen 80 default_server;
    listen [::]:80 default_server;

    root /var/www/html;

    index index.php index.html index.htm;

    server_name _;

    location / {
        try_files $uri $uri/ =404;
    }

    location ~ \.php$ {

        include snippets/fastcgi-php.conf;

        fastcgi_pass unix:/run/php/php8.5-fpm.sock;

        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;

        include fastcgi_params;
    }

}
```

This configuration allows Nginx to process PHP files using PHP-FPM while serving the website from the `/var/www/html` directory.

---


---

# 🚀 Step 14: Test and Restart Nginx

After updating the configuration, verify that the syntax is correct.

```bash
sudo nginx -t
```

If the configuration test is successful, restart Nginx.

```bash
sudo systemctl restart nginx
```


# 🚀 Step 15: Set Project Permissions

Assign the correct ownership and permissions to the project directory.

```bash
sudo chown -R www-data:www-data /var/www/html/project

sudo chmod -R 755 /var/www/html/project
```

These permissions allow Nginx to read the website files while maintaining secure access.

---


# 🚀 Step 16: Test Website

Visit

```
http://YOUR_PUBLIC_IP/project/index.html
```

---



# 🚀 Step 17: Submit Contact Form

Fill

- Name

- Email

- Message

Click

```
Send Message
```

---

### Screenshot

<p align="center">
  <img width="900" height="600" alt="Screenshot 2026-07-16 192629" src="https://github.com/user-attachments/assets/b72cac1a-6aa0-42d8-8b3f-26b50125d181">
</p>



# 🚀 Step 18: Verify Database Entries

Login

```bash
mysql -u portfoliouser -p
```

Run

```sql
USE portfolio;

SELECT * FROM contact;
```

---

### Screenshot

<p align="center">
  <img width="900" height="645" alt="Screenshot 2026-07-16 193115" src="https://github.com/user-attachments/assets/851d659d-95f8-423b-a2e5-23349bc49599">
</p>

---

# 📷 Project Screenshots


## Contact Form

<p align="center">
  <img src="https://github.com/user-attachments/assets/2e265c3e-8ffb-4457-a662-cb91b156815d"
       alt="Screenshot 2026-07-16 192629"
       width="900">
</p>

---

## Success Page

<p align="center">
  <img src="https://github.com/user-attachments/assets/d1188019-a949-40f5-a7ca-cf015628b7cd"
       alt="EC2 Instance Configuration"
       width="900">
</p>

---

## MySQL Database

<p align="center">
  <img width="900" height="645" alt="Screenshot 2026-07-16 193115" src="https://github.com/user-attachments/assets/851d659d-95f8-423b-a2e5-23349bc49599">
</p>

---

# 🎯 Learning Outcomes

- Launching AWS EC2 instances
- Configuring Security Groups
- Installing and configuring the LEMP Stack
- Hosting a dynamic website with Nginx
- Connecting PHP with MySQL
- Creating and managing MySQL databases and users
- Using Linux commands for server administration
- Deploying a full-stack web application on AWS

---

# 👨‍💻 Author

Aayush Shewale

Cloud & DevOps Enthusiast

GitHub: https://github.com/aayushshewale1085-alt

LinkedIn: https://www.linkedin.com/in/aayush-shewale-4b194732b/


# ⭐ If you found this project useful

Give this repository a ⭐ on GitHub.
