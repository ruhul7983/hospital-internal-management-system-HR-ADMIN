# Hospital Internal Management System (HIMS) - MVP

**A web-based internal management system for hospitals to handle staff scheduling, attendance, leave, and payroll.**

---

## Short Description

The **Hospital Internal Management System (HIMS)** is a Laravel-based web application designed to streamline hospital staff management. This MVP version supports:

- Role-based user management (Admin, Doctor, Nurse, Staff)
- Shift scheduling & roster creation
- Web-based clock-in/clock-out attendance tracking
- Leave application & approval workflow
- Automated payroll calculation (hourly & monthly)
- Payslip generation (PDF) and report exports (CSV/PDF)

Built for **academic demonstration**, it serves as a scalable foundation for future production deployment with biometric integration.

---
output:
The Hospital Internal Management System (HIMS) MVP is a Laravel-based web application designed to streamline hospital staff management by providing role-based access for Admins, Doctors, Nurses, and other staff. It outputs a fully functional system where admins can manage users, assign shifts via a calendar-based roster, track attendance with web-based clock-in/out, and handle leave requests with approval workflows. Payroll is automatically calculated based on base salary, overtime, and deductions, and generates downloadable PDF payslips along with summary reports that can be exported as CSV or PDF. Staff members can view their schedules, submit leave, clock in/out, and access their individual payslips. The frontend presents clean, responsive dashboards, tables, and interactive pages, providing a complete MVP experience for demonstrating hospital internal management operations.

## Task Distribution & SRS Link

### Task Distribution

| Name                  | ID                  | Tasks                  |
|-----------------------|---------------------|------------------------|
| Md Ruhul Amin         | 242220005101245     | FR1, FR3, FR10, FR08   |
| Md Al Fuyad           | 242220005101002     | FR6, FR7               |
| Md Kamrul Islam       | 242220005101155     | FR4, FR5               |
| Prokash Bonik         | 242220005101242     | FR2, FR12              |
| Sudipta Paul          | 242220005101167     | FR09, FR11             |

**SRS Document & Task Sheet**:  
[Google Sheet - Task Distribution](https://docs.google.com/spreadsheets/d/1TGAcRtqZW-nhRRO0vGzKdbSXwM2B_uw4DRUJ8t-5YWo/edit?usp=sharing)

---

## Feature List

| Feature ID | Feature Name               | Description |
|-----------|----------------------------|-----------|
| FR1       | Login                      | Secure user authentication |
| FR2       | Role-Based Access          | Restricts features by user role |
| FR3       | Shift Assignment           | Admin assigns daily/monthly shifts |
| FR4       | Clock In                   | Record work start time |
| FR5       | Clock Out                  | Record work end time |
| FR6       | Attendance Record          | Auto-calculate daily worked hours |
| FR7       | Leave Application          | Submit leave requests |
| FR8       | Leave Approval             | Admin approves/rejects leaves |
| FR9       | Payroll Calculation        | Auto-compute salary (hourly/monthly) |
| FR10      | Payslip Generation         | Generate downloadable PDF payslips |
| FR11      | Leave Management Admin     | Admin Leave Request Managment System |
| FR12      | Setup                      | Configure shifts, departments, overtime |

---

## Installation Guide (Laravel)

### Prerequisites
- PHP >= 8.1
- Composer
- MySQL or MariaDB
- Node.js & NPM
- Git

  


### Step-by-Step Setup

```bash
# 1. Clone the repository
git clone https://github.com/ruhul7983/hospital-internal-management-system-HR-ADMIN.git
cd hospital-internal-management-system-HR-ADMIN

# 2. Install PHP dependencies
composer install

# 3. Install frontend assets
npm install && npm run build

# 4. Copy environment file
cp .env.example .env

# 5. Generate an application key
php artisan key:generate

# 6. Configure database in .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hims_db
DB_USERNAME=root
DB_PASSWORD=

# 7. Run migrations & seed initial data
php artisan migrate --seed

# 8. (Optional) Create symbolic link for storage
php artisan storage:link

# 9. Start development server
php artisan serve







# Output (Screenshots & Demo)
Demo will add soon.
#
# Live Demo (if hosted): https:// (Coming Soon)




# Acknowledgement
#
# We express our sincere gratitude to our project supervisor and faculty members 
# for their guidance throughout the development of this system.
#
# Special thanks to:
#   • Course Instructor: Md. Mezbaul Islam Zion (Lecturer)
#   • Institution: Daffodil International University
#
# This project was developed as part of the **Web Engineering Lab** 
#
# GitHub Repository: 
# https://github.com/ruhul7983/hospital-internal-management-system-HR-ADMIN
#
# Prepared in October 2025 | Version 1.0 (MVP)


