
# Laravel Push Post

## About Project

This platform provides basic functionalities for users to create accounts, manage multiple posts, and interact through comments. The platform also supports API routes for CRUD operations on posts and creating comments.

### Key Features:

#### User Authentication and Authorization:

Users can create accounts and log in securely.
Role-based access control ensures administrators have additional privileges.

#### Post Management:

Users can create, edit, and delete posts.
Posts are displayed with their titles, content, and comments.

#### Commenting System:

Users can comment on posts, fostering interaction and engagement.
Comments are associated with specific posts and users.

####  API Routes:

API endpoints are available for creating posts.
Comments can also be created through API endpoints, ensuring integration with external services or applications.

#### Implementation Details:

User Management: Utilizes Laravel's built-in authentication for user registration, login.

Post and Comment Handling: Posts and comments are stored in the database with appropriate relationships.



## Installation instructions.

1. Clone this repository:
   ```bash
   git clone https://github.com/EbosetaleseDunjoyin/Push-Post.git
   ```

2. Install Composer dependencies
     ```bash
      composer install
   ```
3. Install Package dependencies
     ```bash
      npm install
   ```

4. Create a copy of the .env.example file and rename it to .env
     ```bash
      cp .env.example .env
   ```

5. Generate an application key
     ```bash
      php artisan key:generate
   ```
6. Configure your .env file with your database credentials, mail and other settings.

7. Run the database migrations
    ```bash
      php artisan migrate
   ```

8. Start the Laravel development server
    ```bash
      php artisan serve
   ```
9. Compile assets and start the Laravel breeze
   ```bash
      npm run dev
   ```
10. API routes and web routes can be found in the ```routes/api.php``` and ```routes/web.php``` directories, respectively.

You are good to go.


## API Documentation

### General Guidelines

- **All API POST requests must include the following headers:**
  ```http
  Accept: application/json
  Authorization: Bearer {token}
   ```

### API Routes

#### Authentication

- **Register**
  ```bash
  POST {{url}}/api/v1/auth/register
   ```
- **Login**
  ```bash
  POST {{url}}/api/v1/auth/login
   ```
#### Posts

- **Get All Posts**
  ```bash
  GET {{url}}/api/v1/posts
   ```
- **Get a single post**
  ```bash
  POST {{url}}/api/v1/posts/{post}
   ```
- **Create new post**
  ```bash
  POST {{url}}/api/v1/posts/store
   ```
- **Create new post comment**
  ```bash
  POST {{url}}/api/v1/posts/{post}/comments/store
   ```

## Conclucion

This app can be further improved and updated. Future enhancements could include adding images to post giving proper authorization and permissions for updating and deleting posts and comments.



