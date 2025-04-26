# User Management System - React + PHP + MySQL

##  Project Description
This is a simple User Management System where users can be added, viewed, and deleted.  
Frontend is built using ReactJS, backend uses PHP (API), and MySQL database for storage.

---

##  Technologies Used
- ReactJS (Frontend)
- PHP (Backend/API)
- MySQL (Database)
- Git & GitHub (Version Control)

---

##  Setup Instructions

1. **Clone the Repository**  
```bash
git clone https://github.com/your-username/your-repository-name.git


## Backend Setup (PHP + MySQL)

Install XAMPP and start Apache and MySQL.

Create a database named userapi.

Create a table named users:

sql
Copy
Edit
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  dob DATE NOT NULL
);
Place PHP API files in C:\xampp\htdocs\User-api.

--------------








## Frontend Setup (React App)

bash
Copy
Edit
cd your-react-app-folder
npm install
npm start
Make sure the API URL is set to http://localhost/User-api/api.php inside your React app.

----------------------------------------------------------------------------

## How to Run the Project
Start XAMPP (Apache and MySQL).

Open your React project (npm start).

Open browser and navigate to http://localhost:3000.

You can add, view, and delete users.


-------------------------------------------------------------------------------------
## Decisions and Assumptions
Passwords are stored as plain text (for simplicity, but not recommended in real-world apps).

CORS is handled in PHP backend to allow API communication.

Only basic validations are applied on frontend forms.
