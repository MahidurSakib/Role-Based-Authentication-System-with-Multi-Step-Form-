# 🛡️ RBAC System – Role-Based Authentication with Multi-Step Form

A professional **Laravel 11** application featuring:
- ✅ Role-Based Authentication (Admin / User)
- ✅ 3-Step Registration Form with session persistence
- ✅ Unique User ID Generation (USR-XXXXXX)
- ✅ Email Notifications (credentials on account creation)
- ✅ First-Login Password Change enforcement
- ✅ Admin Dashboard with submissions management
- ✅ Forgot Password with temporary password via email
- ✅ Password Strength Meter
- ✅ Professional UI (Bootstrap 5 + custom design)

---

## 🚀 Installation

### Prerequisites
- PHP >= 8.2
- Composer
- MySQL
- Node.js (optional, for Vite)

### Step 1 – Clone / Extract the project
```bash
# If cloning
git clone <your-repo-url> rbac-system
cd rbac-system

# Or extract the zip and navigate to the folder
cd laravel-rbac-app
```

### Step 2 – Install dependencies
```bash
composer install
```

### Step 3 – Environment setup
```bash
cp .env.example .env
php artisan key:generate
```

### Step 4 – Configure database
Edit `.env` and set your MySQL credentials:
```
DB_DATABASE=rbac_system
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

Create the database:
```sql
CREATE DATABASE rbac_system CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### Step 5 – Configure email (optional for dev)
For local development, use **Mailtrap**:
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_user
MAIL_PASSWORD=your_mailtrap_pass
```

Or use **log** driver to see emails in `storage/logs/laravel.log`:
```
MAIL_MAILER=log
```

### Step 6 – Run migrations & seed
```bash
php artisan migrate --seed
```

This creates all tables and seeds the default **Admin** account.

### Step 7 – Start the server
```bash
php artisan serve
```

Visit: **http://localhost:8000**

---

## 🔑 Demo Credentials

### Admin
| Field | Value |
|-------|-------|
| User ID | `ADM-000001` |
| Email | `admin@rbac.com` |
| Password | `Admin@12345` |

### New User
Register through: **http://localhost:8000/register/step-1**

---

## 🗂️ Project Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Auth/
│   │   │   ├── LoginController.php        ← Login with User ID or email
│   │   │   ├── ChangePasswordController.php ← First-login & regular change
│   │   │   └── ForgotPasswordController.php ← Forgot password (temp pass)
│   │   ├── AdminController.php            ← Admin dashboard & management
│   │   ├── UserController.php             ← User dashboard
│   │   └── MultiStepFormController.php    ← 3-step registration form
│   └── Middleware/
│       ├── RoleMiddleware.php             ← role:admin / role:user guard
│       └── FirstLoginMiddleware.php       ← Enforces password setup
├── Mail/
│   ├── UserIdMail.php                     ← Welcome email with credentials
│   └── TemporaryPasswordMail.php          ← Forgot password email
└── Models/
    ├── User.php                           ← With role, user_uid, is_first_login
    └── FormSubmission.php                 ← Multi-step form data

database/migrations/
├── create_users_table.php                 ← role, user_uid, is_first_login
└── create_form_submissions_table.php      ← All 3-step form fields

resources/views/
├── layouts/
│   ├── app.blade.php                      ← Dashboard layout (sidebar)
│   └── auth.blade.php                     ← Auth pages layout
├── auth/
│   ├── login.blade.php
│   ├── change-password.blade.php
│   └── forgot-password.blade.php
├── admin/
│   ├── dashboard.blade.php
│   ├── submissions.blade.php
│   ├── show-submission.blade.php
│   └── users.blade.php
├── user/
│   └── dashboard.blade.php
├── form/
│   ├── step1.blade.php                    ← Personal info
│   ├── step2.blade.php                    ← Address & professional
│   ├── step3.blade.php                    ← Review & submit
│   └── success.blade.php                  ← Confirmation with User ID
└── emails/
    ├── user-created.blade.php             ← Welcome email template
    └── temp-password.blade.php            ← Reset password email
```

---

## 🔄 User Flow

```
[Public Registration Form]
    Step 1: Personal Info (name, email, phone, DOB, gender)
    Step 2: Address & Professional (address, city, occupation, etc.)
    Step 3: Review & Confirm
         ↓
    [User Created] → User ID: USR-XXXXX + Temp Password
         ↓
    [Email Sent] → Credentials emailed
         ↓
    [Login] → User ID or Email + Temp Password
         ↓
    [Force Password Change] → Create new secure password
         ↓
    [User Dashboard] → View profile & submitted data
```

---

## 🎨 UI Features

- 🎨 Professional dark sidebar layout
- 📊 Stats dashboard with animated cards
- 🔍 Search & pagination for data tables
- 📱 Mobile responsive design
- 💪 Password strength indicator
- ✨ Smooth hover animations & transitions
- 🔢 Progress stepper for multi-step form
- 📋 Copy-to-clipboard User ID on success page

---

## 📋 Routes

| Method | URL | Name | Description |
|--------|-----|------|-------------|
| GET | `/login` | `login` | Login page |
| POST | `/login` | `login.post` | Process login |
| POST | `/logout` | `logout` | Logout |
| GET | `/forgot-password` | `password.forgot` | Forgot password |
| GET | `/register/step-1` | `form.step1` | Registration step 1 |
| GET | `/register/step-2` | `form.step2` | Registration step 2 |
| GET | `/register/step-3` | `form.step3` | Registration step 3 (review) |
| GET | `/register/success` | `form.success` | Success page |
| GET | `/change-password` | `password.change` | Change password |
| GET | `/admin/dashboard` | `admin.dashboard` | Admin dashboard |
| GET | `/admin/users` | `admin.users` | Manage users |
| GET | `/admin/submissions` | `admin.submissions` | All submissions |
| GET | `/user/dashboard` | `user.dashboard` | User dashboard |

---

## 🛠️ Tech Stack

- **Backend:** Laravel 11, PHP 8.2
- **Database:** MySQL
- **Frontend:** Bootstrap 5.3, Font Awesome 6, Google Fonts (Inter)
- **Email:** Laravel Mail (Mailtrap for dev)
- **Auth:** Laravel's built-in Auth with custom guards
- **Pattern:** MVC (Model-View-Controller)

---

Made with ❤️ for professional Laravel development interview.
