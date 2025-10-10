Gemini CLI Project Brief: Family Organizer App
1. Project Goal
Develop a "Mobile First" web application for family organization, designed to run on standard shared web hosting. The core features include a meal planner, a recipe catalog, a series tracker, and a budget manager. The app will integrate with the OpenAI API for AI-powered suggestions.

2. Technology Stack
Backend: PHP 8+ (providing a RESTful API).

Frontend: Vue.js 3 with Vite as the build tool.

Database: MySQL / MariaDB.

Authentication: PHP session-based authentication for the API.

Password Hashing: PHP's native password_hash() and password_verify() functions.

Email Sending: A library like PHPMailer to send styled HTML emails.

API Integration: OpenAI API for meal suggestions. Potential integration with TheMovieDB or similar for the series tracker.

3. Core Modules & Logic
3.1. User & Family Management

User Registration & Login: A dedicated screen for user registration (Name, Email, Password). Passwords must be securely hashed.

Family System: A new user creates a new "family." The user can manage their family's preferences (like number of adults/children and dietary styles) on their profile page.

Future Scope: The system is designed to later support inviting other users to join a family via a unique link. This will involve the `family_members` and `invitations` tables.

3.2. Meal Planner

Weekly View: A 7x3 grid for planning meals (Breakfast, Lunch, Dinner).

Add/Edit Meals: A modal allows users to add a meal name, category, and number of people.

AI Suggestions: A button triggers a modal where users can enter a prompt. The PHP backend calls the OpenAI API and displays the suggestions.

3.2.1. Meal Plan Preferences

To provide personalized and AI-driven meal suggestions, the following user preferences will be collected:

1. Household

Number of Adults: Simple integer input.

Number of Children: Simple integer input.

2. Dietary Styles & Preferences

Preferred Diets (Multi-select):

Omnivore

Vegetarian

Vegan

Cooking Styles (Multi-select):

Kid-Friendly

Quick & Easy (e.g., under 30 mins)

Low-Calorie

Whole Foods (Focus on unprocessed, natural ingredients)

Disliked Ingredients: A text field where users can list ingredients to avoid (e.g., Brussels sprouts, liver, olives).

3. Special Wishes & Notes

Notes for the AI: A free-text field for specific, recurring wishes (e.g., "We always have fish on Fridays," "Mondays need to be very simple meals," "We want to try more Asian cuisine.").

3.3. Future Modules (to be implemented after core functionality)

Recipe Catalog: A searchable database for users to save and view their favorite recipes.

Series Tracker: A module to log watched series and movies. Should be designed to potentially fetch data (covers, descriptions) from an external API.

Budget Manager: A tool to track recurring fixed costs (rent, subscriptions) and set monthly budgets for different spending categories.

4. Initial Database Schema
users, families, family_members, invitations, meal_plan tables as defined previously.

New table for meal plan preferences:

The `family_preferences` table has been updated to a more flexible key-value structure.

```sql
CREATE TABLE family_preferences (
    id INT AUTO_INCREMENT PRIMARY KEY,
    family_id INT NOT NULL,
    preference_key VARCHAR(255) NOT NULL,
    preference_value TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (family_id) REFERENCES families(id) ON DELETE CASCADE,
    UNIQUE KEY unique_family_preference (family_id, preference_key)
);
```

The following keys (`preference_key`) are used to store settings:
- `num_adults`: (Integer)
- `num_children`: (Integer)
- `preferred_diets`: (JSON Array)
- `cooking_styles`: (JSON Array)
- `disliked_ingredients`: (Text)
- `ai_notes`: (Text)

New tables for future modules:

recipes

id (PK)

family_id (FK)

title (VARCHAR)

ingredients (TEXT)

instructions (TEXT)

source (VARCHAR, e.g., 'AI-generated' or 'Manual')

series

id (PK)

family_id (FK)

title (VARCHAR)

status (ENUM('watching', 'completed', 'on-hold'))

tmdb_id (INT, NULLABLE, for external API mapping)

fixed_costs

id (PK)

family_id (FK)

description (VARCHAR)

amount (DECIMAL)

payment_interval (ENUM('monthly', 'quarterly', 'yearly'))

budgets

id (PK)

family_id (FK)

category (VARCHAR)

amount (DECIMAL)

month (DATE, e.g., '2025-10-01')

5. Suggested Project Structure
/
|-- api/                    (Backend: PHP API)
|   |-- v1/
|   |   |-- endpoints/      (e.g., login.php, meal-plan.php)
|   |   |-- core/           (e.g., database.php, user.php, mailer.php)
|   |   |-- templates/      (e.g., invitation-email.html)
|   |-- .htaccess
|   `-- index.php
|
|-- client/                 (Frontend: Vue.js / Vite)
|   |-- src/
|   |   |-- components/
|   |   |-- views/
|   |   |-- assets/
|   |   `-- main.js
|   `-- package.json

