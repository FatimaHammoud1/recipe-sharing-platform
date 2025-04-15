
# 🍲 The Shared Spoon

A recipe-sharing web platform built with Laravel that connects users through a variety of cultural and dietary recipes. This platform empowers home cooks, encourages food exploration, and reduces food waste by sharing creative culinary ideas.

---

## 🔍 Project Overview

**The Shared Spoon** allows users to:
- Explore recipes from around the world
- Share their own creations
- Interact through comments and ratings
- Discover Spoonacular-powered AI recipes

---

## 🚀 Features

- ✅ User Authentication (Register, Login, Logout, Password Reset)
- 🔐 Role-Based Access Control (Admin, User, Guest)
- 🧑‍🍳 CRUD for Recipes (Create, Read, Update, Delete)
- 🗂️ Category Management (Admin only)
- 💬 Commenting System
- ⭐ 1–5 Star Rating System
- 🔍 Search Recipes with Spoonacular API
- 📷 Image Upload for Recipes
- 📊 Admin Dashboard
- 🤖 AI Chatbot (Optional)
- 🎨 Responsive Frontend using HTML, CSS, JS, Bootstrap

---

## 🧠 Database Models & Relationships

**Tables**: users, recipes, ratings, comments, categories

**Key Relationships**:
- A user has many recipes, comments, and ratings
- A recipe belongs to a user and a category
- A recipe has many comments and ratings
- A category has many recipes

---

## 🛠️ Tech Stack

- **Backend**: Laravel (PHP Framework)
- **Frontend**: Blade, HTML5, CSS3, JavaScript, Bootstrap
- **Database**: MySQL
- **External API**: Spoonacular (recipe search and details)

---

## 🔐 User Roles

| Role   | Permissions |
|--------|-------------|
| Admin  | Full control over users, recipes, comments, and categories |
| User   | Create/edit/delete own recipes, rate and comment |
| Guest  | View recipes, use Spoonacular search |

---

## 🌐 API Integration

**Spoonacular API**  
- `/spoon/search` – Search recipes  
- `/spoon/{id}` – View recipe details  
- Configured via `.env`:  
  ```
  SPOONACULAR_API_KEY=your_api_key_here
  ```

---

## 📁 Project Structure Highlights

- `app/Http/Controllers` – All controller logic
- `app/Models` – Eloquent models for each table
- `resources/views` – Blade templates for admin, auth, recipes, API, etc.
- `routes/web.php` – Route definitions (public, user, admin)
- `app/Http/Middleware/AdminMiddleware.php` – Custom access control

---

## 📜 Key Routes (web.php)

### 🌍 Public:
- `/` – Home
- `/recipes/index` – View all recipes
- `/spoon/search`, `/spoon/{id}` – External API search

### 👤 Authenticated Users:
- `/recipes/create` – New recipe
- `/recipes/{id}/edit` – Edit own recipe
- `/comments` – Post comment
- `/recipe/{id}/rate` – Rate a recipe

### 🛠️ Admin:
- `/admin/dashboard` – Admin panel
- `/admin/recipes`, `/admin/users`, `/comments`, `/categories`

---

## 🧪 Form Validation

- Laravel’s `FormRequest` & `$request->validate([...])`
- Custom validation rules using `Rule` or custom `Rule` classes
- Image upload validation (`image|mimes:jpeg,png|max:2048`)
- Unique constraints (e.g., email, recipe titles)

---

## 🧱 Middleware Usage

- `auth` – Default Laravel authentication
- `AdminMiddleware` – Custom middleware for admin routes
- `VerifyCsrfToken` – CSRF protection
- `throttle` – Login rate limiting
- `ActivityLogger` – Logs user actions like recipe creation, deletion, etc.

---

## 🤖 AI Chatbot *(optional feature)*
A chat interface for answering cooking questions using external AI integration (chat.blade.php).

---

## 📄 License

This project is open-source and available under the [MIT License](LICENSE).




