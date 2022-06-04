## Instructions
- Setup backend:

    1.) Navigate to `backend` folder. Which contains the Laravel project.
    ```
    cd backend
    ```
    2.) Duplicate the `.env.example` and rename it to `.env`.
    
    3.) Execute this command to install all dependencies.
    ```
    composer install
    ```
    
    4.) Generate an `APP_KEY`.
    ```
    php artisan key:generate
    ```
    
    5.) Create a database and name it `user_management`.
    
    6.) Run database table migration.
    ```
    php artisan migrate
    ```
    
    7.) Setup Laravel Passport.
    ```
    php artisan passport:install
    ```
    
    8.) Place the `Laravel Password Grant Client`'s `ID` and `SECRET` to `CLIENT_ID` and `CLIENT_SECRET` inside the `.env` file.
    ```
    CLIENT_ID=<id here>
    CLIENT_SECRET=<secret here>
    ```
    
    9.) Run database seeders.
    ```
    php artisan db:seed
    ```
    
    10.) Run the backend.
    ```
    php artisan serve
    ```
    
    ### PHP Unit Tests
    ```
    php artisan test
    ```
    
    ### Laravel Telescope
    Visit the backend URL, example: `http://127.0.0.1:8000/telescope`

- Setup frontend:

    1.) Navigate to `frontend` folder. Which contains the Vue project.
    ```
    cd frontend
    ```
    
    2.) Duplicate the `.env.example` and rename it to `.env.local`.
    
    3.) Place the backend URL to `VUE_APP_API_URL` inside the `.env.local`.
    ```
    VUE_APP_API_URL=http://127.0.0.1:8000
    ```
    
    4.) Execute this command to install all dependencies.
    ```
    npm install
    ```
    
    5.) Run the frontend.
    ```
    npm run serve
    ```

## Usage
Initial administrator account:
- email: `admin@mail.test`
- password: `Password123?`

The password for all users created via seeder/factory is `Password123?`
