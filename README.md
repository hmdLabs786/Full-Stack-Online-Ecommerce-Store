🛒 ZUFÉ — Full-Stack E-Commerce Web Application
<div align="center">








A production-style e-commerce platform developed using Core PHP & MySQL

📌 Overview
 • ✨ Features
 • 🛠 Setup
 • 🏗 Architecture

</div>
📖 Project Overview

ZUFÉ is a full-featured e-commerce system developed as a major internship project, focusing on real-world online shopping workflows, admin control, and scalable backend logic.

The project simulates how modern e-commerce platforms operate — from product discovery to checkout, order management, and administrative reporting — using Core PHP without frameworks, to demonstrate strong backend fundamentals.

🎯 Purpose

Practice real-world PHP & MySQL development

Build a complete shopping lifecycle

Implement admin & customer separation

Understand database-driven systems

Apply AJAX-based interactivity

✨ Features
🧑‍💻 Customer Experience

Responsive homepage with featured products

Category-based product browsing

Keyword-based product search

Product detail pages with variants (size/color)

Shopping cart with quantity controls

Wishlist functionality

User registration & login system

Order placement & tracking

Order history for registered users

Product rating & review system

Contact & FAQ support pages

🛠 Admin Dashboard

Secure admin authentication

Product CRUD (Add / Update / Remove)

Category management

Order processing & status tracking

Delivery area & charges configuration

User account management

Sales overview & order history

🎨 UI & Performance

Fully responsive (mobile, tablet, desktop)

Clean Bootstrap-based interface

Optimized asset loading

AJAX-powered actions (cart, wishlist, search)

Light & Dark UI support

🛠️ Installation
📌 Requirements

PHP 7.4 or higher

MySQL 5.7+

Apache / Nginx

XAMPP or WAMP (recommended for local use)

⚙️ Setup Steps

Clone Repository

git clone https://github.com/yourusername/zufe-ecommerce.git
cd zufe-ecommerce


Create Database

CREATE DATABASE adminpanel;


Configure Database Connection

// connection.php
$con = mysqli_connect("localhost", "root", "", "adminpanel");


Set Folder Permissions

chmod 755 adminpanel3/img/
chmod 755 images/


Run Project

Website: http://localhost/zufe-ecommerce/

Admin Panel: http://localhost/zufe-ecommerce/adminpanel3/

🏗️ Project Structure
zufe-ecommerce/
│
├── adminpanel3/        # Admin dashboard
│   ├── css/
│   ├── js/
│   ├── img/
│   └── index.php
│
├── css/                # Website styles
├── js/                 # Frontend scripts
├── images/             # UI assets
├── vendor/             # External libraries
│
├── index.php           # Homepage
├── product.php         # Product listing
├── shoping-cart.php    # Cart
├── wishlist-view.php   # Wishlist
├── your_orders.php     # Orders
├── login.php           # Authentication
├── register.php
├── contact.php
└── connection.php

💾 Database Design
Core Tables

users

products

categories

orders

cart

wishlist

product_ratings

delivery_settings

Relationships

One user → many orders

One category → many products

One product → many reviews

👥 User Roles
👤 Customer

Browse & search products

Manage cart & wishlist

Place orders

View order history

Submit reviews

🔐 Admin

Manage products & categories

Process orders

Configure delivery

Monitor sales

Manage users

🚀 Deployment Notes

Update database credentials for production

Enable HTTPS

Change default admin login

Regular database backups recommended

🧠 Learning Outcomes

Backend logic using Core PHP

MySQL schema design

Role-based access control

AJAX-based UI updates

Admin panel development

Real-world e-commerce workflows

👨‍💻 Author

Muhammad Habban Madani
Internship Major Project
Full-Stack Web Development (PHP & MySQL)

📄 License

This project is released under the MIT License.

<div align="center">

⭐ If this project helped you learn something, feel free to star it.

Developed with dedication by Muhammad Habban Madani

</div>