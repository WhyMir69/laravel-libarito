#!/bin/bash

# API Testing Script for Laravel Sanctum
echo "Testing Laravel Sanctum API..."
echo "=================================="

BASE_URL="http://127.0.0.1:8000/api"

# Test 1: Register a new user
echo " Testing User Registration..."
REGISTER_RESPONSE=$(curl -s -X POST $BASE_URL/register \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "name": "API Test User",
    "email": "apitest@example.com",
    "password": "password123",
    "password_confirmation": "password123"
  }')

echo "Response: $REGISTER_RESPONSE"

# Extract token from response (you would parse JSON properly in real scenario)
TOKEN=$(echo $REGISTER_RESPONSE | grep -o '"access_token":"[^"]*' | cut -d'"' -f4)

if [ ! -z "$TOKEN" ]; then
    echo " Registration successful! Token: ${TOKEN:0:20}..."
    
    # Test 2: Create a post
    echo ""
    echo " Testing Post Creation..."
    POST_RESPONSE=$(curl -s -X POST $BASE_URL/posts \
      -H "Authorization: Bearer $TOKEN" \
      -H "Content-Type: application/json" \
      -H "Accept: application/json" \
      -d '{
        "title": "Test Post via API",
        "body": "This post was created through the API testing script!"
      }')
    
    echo "Response: $POST_RESPONSE"
    
    # Test 3: Get all posts
    echo ""
    echo " Testing Get All Posts..."
    POSTS_RESPONSE=$(curl -s -X GET $BASE_URL/posts \
      -H "Authorization: Bearer $TOKEN" \
      -H "Accept: application/json")
    
    echo "Response: $POSTS_RESPONSE"
    
else
    echo " Registration failed!"
fi

echo ""
echo " API Testing Complete!"
echo "Check the responses above to verify functionality."
