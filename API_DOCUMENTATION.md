# Laravel Sanctum API Documentation

Your Laravel Library System now has a fully functional REST API with authentication using Laravel Sanctum!

## 🚀 **API Endpoints**

### **Authentication Endpoints**

#### Register a new user
```bash
POST /api/register
Content-Type: application/json

{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123",
    "password_confirmation": "password123"
}
```

#### Login
```bash
POST /api/login
Content-Type: application/json

{
    "email": "john@example.com",
    "password": "password123"
}
```

#### Get authenticated user details
```bash
GET /api/user
Authorization: Bearer {your_token}
```

#### Logout
```bash
POST /api/logout
Authorization: Bearer {your_token}
```

#### Logout from all devices
```bash
POST /api/logout-all
Authorization: Bearer {your_token}
```

### **Books Endpoints**

#### Get all books (Public)
```bash
GET /api/books?per_page=10
```

#### Get a specific book (Public)
```bash
GET /api/books/{id}
```

#### Create a new book (Protected)
```bash
POST /api/books
Authorization: Bearer {your_token}
Content-Type: application/json

{
    "title": "New Book Title",
    "author_id": 1,
    "genre_ids": [1, 2, 3]
}
```

#### Update a book (Protected)
```bash
PUT /api/books/{id}
Authorization: Bearer {your_token}
Content-Type: application/json

{
    "title": "Updated Book Title",
    "author_id": 2
}
```

#### Delete a book (Protected)
```bash
DELETE /api/books/{id}
Authorization: Bearer {your_token}
```

### **Authors Endpoints**

#### Get all authors (Public)
```bash
GET /api/authors?per_page=10
```

#### Get a specific author (Public)
```bash
GET /api/authors/{id}
```

#### Create a new author (Protected)
```bash
POST /api/authors
Authorization: Bearer {your_token}
Content-Type: application/json

{
    "name": "Author Name",
    "biography": "Author biography...",
    "birth_date": "1970-01-01",
    "nationality": "American"
}
```

#### Update an author (Protected)
```bash
PUT /api/authors/{id}
Authorization: Bearer {your_token}
Content-Type: application/json

{
    "name": "Updated Author Name",
    "biography": "Updated biography..."
}
```

#### Delete an author (Protected)
```bash
DELETE /api/authors/{id}
Authorization: Bearer {your_token}
```

## 🔐 **Authentication Flow**

1. **Register** or **Login** to get an access token
2. Include the token in the `Authorization` header as `Bearer {token}`
3. Use the token to access protected endpoints

## 📊 **API Features**

- ✅ JWT-like token authentication with Laravel Sanctum
- ✅ Public read access for books and authors
- ✅ Protected write access (create, update, delete)
- ✅ Pagination support
- ✅ Relationship loading (books with authors, genres, reviews)
- ✅ Proper validation and error handling
- ✅ RESTful API design

## 🧪 **Testing the API**

You can test the API using tools like:
- **Postman**
- **Insomnia**
- **cURL**
- **HTTPie**

### Example cURL requests:

```bash
# Register a new user
curl -X POST http://localhost:8000/api/register \
  -H "Content-Type: application/json" \
  -d '{"name":"Test User","email":"test@example.com","password":"password123","password_confirmation":"password123"}'

# Get all books
curl -X GET http://localhost:8000/api/books

# Get a specific book with relationships
curl -X GET http://localhost:8000/api/books/1
```

Your API is now ready to be consumed by frontend applications, mobile apps, or any other client that can make HTTP requests!
