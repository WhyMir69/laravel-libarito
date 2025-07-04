# Libretto Library Database Schema Documentation

## Overview

The Libretto Library Management System uses a relational database with the following entities and relationships:

## Database Schema: `libretto-ymir`

### Tables and Relationships

## 1. Authors Table
**Table Name:** `authors`

| Column | Type | Description |
|--------|------|-------------|
| id | BIGINT (PK) | Primary key |
| name | VARCHAR(255) | Author's full name |
| biography | TEXT | Author's biography (nullable) |
| birth_date | DATE | Author's birth date (nullable) |
| nationality | VARCHAR(255) | Author's nationality (nullable) |
| created_at | TIMESTAMP | Record creation timestamp |
| updated_at | TIMESTAMP | Record update timestamp |

**Relationships:**
- **One-to-Many** with Books (An author can write many books)

## 2. Books Table
**Table Name:** `books`

| Column | Type | Description |
|--------|------|-------------|
| id | BIGINT (PK) | Primary key |
| title | VARCHAR(255) | Book title |
| description | TEXT | Book description (nullable) |
| isbn | VARCHAR(255) | ISBN number (unique, nullable) |
| publication_date | DATE | Publication date (nullable) |
| pages | INTEGER | Number of pages (nullable) |
| price | DECIMAL(8,2) | Book price (nullable) |
| publisher | VARCHAR(255) | Publisher name (nullable) |
| language | VARCHAR(255) | Book language (default: English) |
| cover_image | VARCHAR(255) | Cover image path (nullable) |
| author_id | BIGINT (FK) | Foreign key to authors table |
| created_at | TIMESTAMP | Record creation timestamp |
| updated_at | TIMESTAMP | Record update timestamp |

**Relationships:**
- **Many-to-One** with Authors (Each book belongs to one author)
- **One-to-Many** with Reviews (A book can have many reviews)
- **Many-to-Many** with Genres (A book can belong to many genres)

## 3. Genres Table
**Table Name:** `genres`

| Column | Type | Description |
|--------|------|-------------|
| id | BIGINT (PK) | Primary key |
| name | VARCHAR(255) | Genre name (unique) |
| description | TEXT | Genre description (nullable) |
| created_at | TIMESTAMP | Record creation timestamp |
| updated_at | TIMESTAMP | Record update timestamp |

**Relationships:**
- **Many-to-Many** with Books (A genre can have many books)

## 4. Book-Genre Pivot Table
**Table Name:** `book_genre`

| Column | Type | Description |
|--------|------|-------------|
| id | BIGINT (PK) | Primary key |
| book_id | BIGINT (FK) | Foreign key to books table |
| genre_id | BIGINT (FK) | Foreign key to genres table |
| created_at | TIMESTAMP | Record creation timestamp |
| updated_at | TIMESTAMP | Record update timestamp |

**Constraints:**
- Unique combination of (book_id, genre_id)
- CASCADE delete on both foreign keys

## 5. Reviews Table
**Table Name:** `reviews`

| Column | Type | Description |
|--------|------|-------------|
| id | BIGINT (PK) | Primary key |
| content | TEXT | Review content |
| rating | INTEGER | Rating (1-5 stars) |
| reviewer_name | VARCHAR(255) | Reviewer's name (nullable) |
| reviewer_email | VARCHAR(255) | Reviewer's email (nullable) |
| book_id | BIGINT (FK) | Foreign key to books table |
| user_id | BIGINT (FK) | Foreign key to users table (nullable) |
| created_at | TIMESTAMP | Record creation timestamp |
| updated_at | TIMESTAMP | Record update timestamp |

**Relationships:**
- **Many-to-One** with Books (Each review belongs to one book)
- **Many-to-One** with Users (Each review can belong to one registered user, optional)

## 6. Users Table (Existing)
**Table Name:** `users`

| Column | Type | Description |
|--------|------|-------------|
| id | BIGINT (PK) | Primary key |
| name | VARCHAR(255) | User's name |
| email | VARCHAR(255) | Email address (unique) |
| password | VARCHAR(255) | Hashed password |
| email_verified_at | TIMESTAMP | Email verification timestamp |
| remember_token | VARCHAR(100) | Remember token for authentication |
| created_at | TIMESTAMP | Record creation timestamp |
| updated_at | TIMESTAMP | Record update timestamp |

**Relationships:**
- **One-to-Many** with Reviews (A user can write many reviews)

---

## Relationship Details

### 1. Authors ↔ Books (One-to-Many)
- **Nature:** An author can write multiple books, but each book has only one primary author
- **Implementation:** `author_id` foreign key in books table
- **Laravel Eloquent:**
  ```php
  // Author model
  public function books() {
      return $this->hasMany(Book::class);
  }
  
  // Book model
  public function author() {
      return $this->belongsTo(Author::class);
  }
  ```

### 2. Books ↔ Reviews (One-to-Many)
- **Nature:** A book can have multiple reviews, but each review belongs to one book
- **Implementation:** `book_id` foreign key in reviews table
- **Laravel Eloquent:**
  ```php
  // Book model
  public function reviews() {
      return $this->hasMany(Review::class);
  }
  
  // Review model
  public function book() {
      return $this->belongsTo(Book::class);
  }
  ```

### 3. Books ↔ Genres (Many-to-Many)
- **Nature:** A book can belong to multiple genres, and a genre can contain multiple books
- **Implementation:** Pivot table `book_genre` with foreign keys to both tables
- **Laravel Eloquent:**
  ```php
  // Book model
  public function genres() {
      return $this->belongsToMany(Genre::class, 'book_genre');
  }
  
  // Genre model
  public function books() {
      return $this->belongsToMany(Book::class, 'book_genre');
  }
  ```

### 4. Users ↔ Reviews (One-to-Many)
- **Nature:** A registered user can write multiple reviews, but each review belongs to one user (optional)
- **Implementation:** `user_id` foreign key in reviews table (nullable)
- **Laravel Eloquent:**
  ```php
  // User model
  public function reviews() {
      return $this->hasMany(Review::class);
  }
  
  // Review model
  public function user() {
      return $this->belongsTo(User::class);
  }
  ```

---

## Sample Data

The system includes seeded data with:
- **5 Authors:** J.K. Rowling, George R.R. Martin, Agatha Christie, Stephen King, Jane Austen
- **10 Genres:** Fantasy, Mystery, Romance, Science Fiction, Horror, Historical Fiction, Adventure, Young Adult, Classic Literature, Thriller
- **5 Books:** Harry Potter and the Philosopher's Stone, A Game of Thrones, Murder on the Orient Express, The Shining, Pride and Prejudice
- **Multiple Reviews:** Sample reviews for each book with ratings and content

---

## API Endpoints

### Library Routes (Protected - Authentication Required)
- `GET /library` - Library dashboard with books, authors, and statistics
- `GET /library/author/{id}` - Books by specific author
- `GET /library/genre/{id}` - Books by specific genre  
- `GET /library/book/{id}` - Book details with reviews
- `GET /library/test-relationships` - JSON endpoint to test all relationships

---

## Usage Examples

### Testing Relationships
Visit `/library/test-relationships` to see JSON output demonstrating all relationships:
- Author → Books relationship
- Book → Author relationship  
- Book → Genres relationship (Many-to-Many)
- Book → Reviews relationship with ratings

### Querying with Relationships
```php
// Get all books with their authors and genres
$books = Book::with(['author', 'genres', 'reviews'])->get();

// Get author with all their books
$author = Author::with('books')->find(1);

// Get books in a specific genre
$fantasyBooks = Genre::where('name', 'Fantasy')->first()->books;

// Get book with average rating
$book = Book::with('reviews')->find(1);
$averageRating = $book->reviews->avg('rating');
```

---

## Foreign Key Constraints

All foreign key relationships include proper constraints:
- **CASCADE DELETE:** When a parent record is deleted, related child records are also deleted
- **SET NULL:** For optional relationships (like user_id in reviews), the field is set to NULL when the parent is deleted

This ensures data integrity and prevents orphaned records in the database.
