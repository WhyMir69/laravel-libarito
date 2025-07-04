# Laravel Sanctum API Testing Guide

## 🚀 **API Testing Instructions**

Your Laravel Sanctum API is ready for testing! Here are the available endpoints and how to test them.

## 📍 **Base URL**: `http://localhost:8000/api/`

---

## 🔐 **Authentication Endpoints**

### 1. **Register a New User**
```bash
curl -X POST http://localhost:8000/api/register \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "name": "Test User",
    "email": "test@example.com", 
    "password": "password123",
    "password_confirmation": "password123"
  }'
```

**Expected Response:**
```json
{
  "message": "User registered successfully",
  "user": {
    "id": 1,
    "name": "Test User",
    "email": "test@example.com"
  },
  "access_token": "1|abc123...",
  "token_type": "Bearer"
}
```

### 2. **Login**
```bash
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "email": "test@example.com",
    "password": "password123"
  }'
```

### 3. **Get Current User**
```bash
curl -X GET http://localhost:8000/api/user \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -H "Accept: application/json"
```

---

## 📝 **Posts Endpoints (Protected)**

### 1. **List All Posts**
```bash
curl -X GET http://localhost:8000/api/posts \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -H "Accept: application/json"
```

### 2. **Create a New Post**
```bash
curl -X POST http://localhost:8000/api/posts \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "title": "My First Post",
    "body": "This is the content of my first post!"
  }'
```

### 3. **Show Specific Post**
```bash
curl -X GET http://localhost:8000/api/posts/1 \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -H "Accept: application/json"
```

### 4. **Update a Post**
```bash
curl -X PUT http://localhost:8000/api/posts/1 \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "title": "Updated Post Title",
    "body": "Updated post content"
  }'
```

### 5. **Delete a Post**
```bash
curl -X DELETE http://localhost:8000/api/posts/1 \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -H "Accept: application/json"
```

---

## 💬 **Comments Endpoints (Protected)**

### 1. **Create a Comment**
```bash
curl -X POST http://localhost:8000/api/comments \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "post_id": 1,
    "body": "This is a great post!"
  }'
```

### 2. **Update a Comment**
```bash
curl -X PUT http://localhost:8000/api/comments/1 \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "body": "Updated comment text"
  }'
```

### 3. **Delete a Comment**
```bash
curl -X DELETE http://localhost:8000/api/comments/1 \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -H "Accept: application/json"
```

---

## 🧪 **Testing Workflow**

### **Step 1: Start the Server**
```bash
php artisan serve
```

### **Step 2: Register or Login**
1. Register a new user OR login with existing credentials
2. Copy the `access_token` from the response

### **Step 3: Test Protected Endpoints**
1. Replace `YOUR_TOKEN_HERE` with your actual token
2. Test creating posts and comments
3. Test updating and deleting your own content

---

## 📱 **Postman Testing**

### **Collection Setup:**
1. **Base URL**: `http://localhost:8000/api`
2. **Authorization**: Bearer Token (set in Postman Auth tab)

### **Environment Variables:**
- `base_url`: `http://localhost:8000/api`
- `token`: Your access token from login/register

### **Request Examples:**

#### **Register User**
- **Method**: POST
- **URL**: `{{base_url}}/register`
- **Body** (JSON):
```json
{
  "name": "Test User",
  "email": "test@example.com",
  "password": "password123", 
  "password_confirmation": "password123"
}
```

#### **Create Post**
- **Method**: POST
- **URL**: `{{base_url}}/posts`
- **Auth**: Bearer Token `{{token}}`
- **Body** (JSON):
```json
{
  "title": "My API Post",
  "body": "Content created via API!"
}
```

---

## ✅ **Expected Behavior**

1. **Registration/Login** → Receive access token
2. **Create Post** → Returns post with ID
3. **Create Comment** → Returns comment linked to post
4. **Update/Delete** → Only works for content you own
5. **Unauthorized Access** → Returns 401/403 errors

---

## 🛠️ **Troubleshooting**

### **Common Issues:**
- **401 Unauthorized**: Check your Bearer token
- **403 Forbidden**: You don't own this resource
- **422 Validation Error**: Check required fields
- **500 Server Error**: Check Laravel logs

### **Check Logs:**
```bash
tail -f storage/logs/laravel.log
```

Your API is fully functional and ready for testing! 🎉
