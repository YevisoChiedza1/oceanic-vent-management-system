# Hydrothermal Vent & Fauna Explorer 

A full-stack web application designed to catalog and manage data regarding deep-sea hydrothermal vents and the unique biological ecosystems (fauna) they support. 

This project was developed to demonstrate core competencies in **Relational Database Management (RDBMS)**, **Server-Side Logic**, and **Responsive Front-End Design**.

## Features

* **Dynamic Vent Catalog:** Pulls real-time data from a MySQL database to display vent locations and geological types.
* **Fauna Integration:** Relational database queries to display specific species associated with each vent field.
* **Search & Filtering:** (In Progress) Advanced SQL filtering to find vents by depth, location, or type.
* **Secure Data Handling:** Implementation of PHP PDO prepared statements to protect against SQL Injection.
* **Responsive UI:** A mobile-friendly interface built with custom CSS (Flexbox/Grid).

## Tech Stack

* **Frontend:** HTML5, CSS3, JavaScript 
* **Backend:** PHP 8.x
* **Database:** MySQL / MariaDB
* **Server Environment:** WAMP/Apache
* **Version Control:** Git & GitHub

## Project Structure

```text
├── css/            # Custom stylesheets (Mobile-first design)
├── js/             # Client-side validation and interactive maps
├── includes/       # Reusable PHP components (DB connection, Header, Footer)
├── database/       # SQL schema and data exports
├── index.php       # Main vent listing page
└── vent.php        # Detailed view for individual vents and associated fauna
