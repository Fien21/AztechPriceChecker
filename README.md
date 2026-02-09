## Laravel + Tailwind Css Starter Project with Multi-Auth (Admin / Teacher and User )

**Project Screenshot**
![Project Screenshot](image.png)

- Admin login ( http://localhost:8000/admin/login )
- Staff login (http://localhost:8000/teacher/login )
- User login (http://localhost:8000/login )

---

## How to Run the Code

1.  **Configure Environment:**
    ```bash
    cp .env.example .env
    ```

2.  **Install Dependencies:**
    ```bash
    composer install
    ```

3.  **Generate Application Key:**
    ```bash
    php artisan key:generate
    ```

4.  **Run Migrations (Database Setup):**
    ```bash
    php artisan migrate:fresh
    ```

5.  **Start the Development Server:**
    ```bash
    php artisan serve
    ```
