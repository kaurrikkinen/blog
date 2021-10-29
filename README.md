## Blog API

Made with Laravel Lumen framework.

A local MySQL server instance and database was used.

In .env file:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blog
DB_USERNAME=root
DB_PASSWORD=test
```

Migrate database: `php artisan migrate`  
Run local web server: `php -S localhost:8000 -t public`  
For `phpunit` tests empty database `blog_test` is required.  

### API endpoints

GET `/api/categories`  
Return all categories

POST `/api/categories/`  
Create new category {"name": "newCategory"}

PUT `/api/categories/{id}`  
Update existing category {"name": "newName"}

GET `/api/posts/{category_id}`  
Return all posts of the given category

POST `/api/posts`  
Create new post under given category {"content": "newPost", "category_id": 1}

PUT `/api/posts/{id}`  
Update existing post {"content": "newContent"}

DELETE `/api/posts/{id}`  
Delete post
