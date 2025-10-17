# Hair Salon API Documentation

## 🔗 Base URL
```
http://localhost:8000/api
```

## 🔐 Authentication

All protected endpoints require a JWT token in the Authorization header:
```
Authorization: Bearer {jwt_token}
```

---

## 📋 Authentication Endpoints

### Register User
**POST** `/auth/register`

Register a new user account.

**Request Body:**
```json
{
    "full_name": "John Doe",
    "phone": "+923001234567",
    "email": "john@example.com",
    "password": "password123"
}
```

**Response:**
```json
{
    "success": true,
    "message": "User registered successfully",
    "user": {
        "id": 1,
        "full_name": "John Doe",
        "phone": "+923001234567",
        "email": "john@example.com",
        "loyalty_points": 0,
        "created_at": "2024-01-01T00:00:00.000000Z"
    },
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9..."
}
```

### Login User
**POST** `/auth/login`

Authenticate user and get JWT token.

**Request Body:**
```json
{
    "phone": "+923001234567",
    "password": "password123"
}
```

**Response:**
```json
{
    "success": true,
    "message": "Login successful",
    "user": {
        "id": 1,
        "full_name": "John Doe",
        "phone": "+923001234567",
        "email": "john@example.com",
        "loyalty_points": 150
    },
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9..."
}
```

### Get Current User
**GET** `/auth/me`

Get authenticated user's profile.

**Headers:**
```
Authorization: Bearer {jwt_token}
```

**Response:**
```json
{
    "success": true,
    "user": {
        "id": 1,
        "full_name": "John Doe",
        "phone": "+923001234567",
        "email": "john@example.com",
        "loyalty_points": 150,
        "created_at": "2024-01-01T00:00:00.000000Z"
    }
}
```

### Logout User
**POST** `/auth/logout`

Invalidate current JWT token.

**Headers:**
```
Authorization: Bearer {jwt_token}
```

**Response:**
```json
{
    "success": true,
    "message": "Logout successful"
}
```

### Refresh Token
**POST** `/auth/refresh`

Get a new JWT token.

**Headers:**
```
Authorization: Bearer {jwt_token}
```

**Response:**
```json
{
    "success": true,
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9..."
}
```

---

## 🎯 Service Endpoints

### Get All Services
**GET** `/services`

Get all active services with their packages.

**Headers:**
```
Authorization: Bearer {jwt_token}
```

**Response:**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "title": "Hair Cut",
            "description": "Professional hair cutting service",
            "base_price": "1500.00",
            "duration_minutes": 45,
            "image_url": "https://example.com/image.jpg",
            "category_id": "hair",
            "is_active": true,
            "packages": [
                {
                    "id": 1,
                    "name": "Basic Cut",
                    "price": "1500.00",
                    "duration_minutes": 45,
                    "details": "Basic hair cutting service"
                }
            ]
        }
    ]
}
```

### Get Specific Service
**GET** `/services/{id}`

Get a specific service with all its packages.

**Headers:**
```
Authorization: Bearer {jwt_token}
```

**Response:**
```json
{
    "success": true,
    "data": {
        "id": 1,
        "title": "Hair Cut",
        "description": "Professional hair cutting service",
        "base_price": "1500.00",
        "duration_minutes": 45,
        "image_url": "https://example.com/image.jpg",
        "category_id": "hair",
        "is_active": true,
        "packages": [
            {
                "id": 1,
                "name": "Basic Cut",
                "price": "1500.00",
                "duration_minutes": 45,
                "details": "Basic hair cutting service"
            },
            {
                "id": 2,
                "name": "Premium Cut",
                "price": "2500.00",
                "duration_minutes": 60,
                "details": "Premium hair cutting with styling"
            }
        ]
    }
}
```

---

## 📅 Booking Endpoints

### Create Booking
**POST** `/bookings`

Create a new appointment booking.

**Headers:**
```
Authorization: Bearer {jwt_token}
Content-Type: application/json
```

**Request Body:**
```json
{
    "service_id": 1,
    "package_id": 1,
    "stylist_id": 1,
    "date_time": "2024-01-15 14:00:00",
    "notes": "Regular appointment"
}
```

**Response:**
```json
{
    "success": true,
    "message": "Booking created successfully",
    "data": {
        "id": 1,
        "user_id": 1,
        "service_id": 1,
        "package_id": 1,
        "stylist_id": 1,
        "date_time": "2024-01-15T14:00:00.000000Z",
        "status": "booked",
        "loyalty_points_awarded": 15,
        "notes": "Regular appointment",
        "service": {
            "id": 1,
            "title": "Hair Cut"
        },
        "package": {
            "id": 1,
            "name": "Basic Cut",
            "price": "1500.00"
        },
        "stylist": {
            "id": 1,
            "name": "Amina Khan"
        }
    }
}
```

### Get User's Bookings
**GET** `/bookings`

Get all bookings for the authenticated user.

**Headers:**
```
Authorization: Bearer {jwt_token}
```

**Query Parameters:**
- `status` (optional): Filter by status (`upcoming`, `past`, `cancelled`)

**Response:**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "user_id": 1,
            "service_id": 1,
            "package_id": 1,
            "stylist_id": 1,
            "date_time": "2024-01-15T14:00:00.000000Z",
            "status": "booked",
            "loyalty_points_awarded": 15,
            "notes": "Regular appointment",
            "service": {
                "id": 1,
                "title": "Hair Cut"
            },
            "package": {
                "id": 1,
                "name": "Basic Cut",
                "price": "1500.00"
            },
            "stylist": {
                "id": 1,
                "name": "Amina Khan"
            }
        }
    ]
}
```

### Get Specific Booking
**GET** `/bookings/{id}`

Get details of a specific booking.

**Headers:**
```
Authorization: Bearer {jwt_token}
```

**Response:**
```json
{
    "success": true,
    "data": {
        "id": 1,
        "user_id": 1,
        "service_id": 1,
        "package_id": 1,
        "stylist_id": 1,
        "date_time": "2024-01-15T14:00:00.000000Z",
        "status": "booked",
        "loyalty_points_awarded": 15,
        "notes": "Regular appointment",
        "service": {
            "id": 1,
            "title": "Hair Cut",
            "description": "Professional hair cutting service"
        },
        "package": {
            "id": 1,
            "name": "Basic Cut",
            "price": "1500.00",
            "details": "Basic hair cutting service"
        },
        "stylist": {
            "id": 1,
            "name": "Amina Khan",
            "specialization": "Hair Cutting & Coloring"
        }
    }
}
```

### Cancel Booking
**POST** `/bookings/{id}/cancel`

Cancel a booking (only for upcoming appointments).

**Headers:**
```
Authorization: Bearer {jwt_token}
```

**Response:**
```json
{
    "success": true,
    "message": "Booking cancelled successfully",
    "data": {
        "id": 1,
        "status": "cancelled",
        "service": {
            "title": "Hair Cut"
        }
    }
}
```

---

## 🔔 Notification Endpoints

### Get Notifications
**GET** `/notifications`

Get all notifications for the authenticated user.

**Headers:**
```
Authorization: Bearer {jwt_token}
```

**Query Parameters:**
- `is_read` (optional): Filter by read status (`true`, `false`)

**Response:**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "user_id": 1,
            "type": "booking_confirmation",
            "title": "Booking Confirmed",
            "message": "Your booking for Hair Cut has been confirmed for Jan 15, 2024 at 2:00 PM",
            "is_read": false,
            "data": {
                "booking_id": 1,
                "service_title": "Hair Cut",
                "date_time": "2024-01-15T14:00:00.000000Z"
            },
            "created_at": "2024-01-01T00:00:00.000000Z"
        }
    ],
    "unread_count": 3
}
```

### Mark Notification as Read
**POST** `/notifications/{id}/read`

Mark a specific notification as read.

**Headers:**
```
Authorization: Bearer {jwt_token}
```

**Response:**
```json
{
    "success": true,
    "message": "Notification marked as read",
    "data": {
        "id": 1,
        "is_read": true
    }
}
```

### Mark All Notifications as Read
**POST** `/notifications/mark-all-read`

Mark all notifications as read.

**Headers:**
```
Authorization: Bearer {jwt_token}
```

**Response:**
```json
{
    "success": true,
    "message": "All notifications marked as read"
}
```

### Get Unread Count
**GET** `/notifications/unread-count`

Get the count of unread notifications.

**Headers:**
```
Authorization: Bearer {jwt_token}
```

**Response:**
```json
{
    "success": true,
    "unread_count": 3
}
```

---

## ⏰ Time Slot Endpoints

### Get Available Time Slots
**GET** `/time-slots`

Get available time slots for a specific service and date.

**Headers:**
```
Authorization: Bearer {jwt_token}
```

**Query Parameters:**
- `service_id` (required): Service ID
- `date` (required): Date in YYYY-MM-DD format
- `stylist_id` (optional): Filter by specific stylist

**Response:**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "date": "2024-01-15",
            "start_time": "09:00:00",
            "end_time": "10:00:00",
            "is_available": true,
            "stylist_id": 1,
            "stylist": {
                "id": 1,
                "name": "Amina Khan"
            }
        }
    ]
}
```

---

## ❌ Error Responses

### Validation Error (422)
```json
{
    "success": false,
    "message": "Validation failed",
    "errors": {
        "phone": ["The phone field is required."],
        "password": ["The password must be at least 6 characters."]
    }
}
```

### Authentication Error (401)
```json
{
    "success": false,
    "message": "Invalid credentials"
}
```

### Not Found Error (404)
```json
{
    "success": false,
    "message": "Service not found"
}
```

### Server Error (500)
```json
{
    "success": false,
    "message": "Internal server error"
}
```

---

## 🎯 Business Rules

### Loyalty Points
- **Earning**: 1 point per PKR 100 spent
- **First Booking**: 10% discount bonus
- **Redemption Tiers**:
  - 50 points → 5% discount
  - 100 points → 10% discount
  - 200 points → 15% discount + free service
- **Expiry**: 365 days from earning

### Booking Rules
- **Advance Booking**: Maximum 60 days in advance
- **Cancellation**: Points deducted if cancelled
- **Status Flow**: `booked` → `completed`/`cancelled`/`no_show`

### Notification Types
- `booking_confirmation`: Booking created/confirmed
- `appointment_reminder`: Upcoming appointment reminder
- `promotional`: Special offers and discounts
- `loyalty_update`: Points earned/redeemed

---

## 🧪 Testing Examples

### cURL Examples

#### Register User
```bash
curl -X POST http://localhost:8000/api/auth/register \
  -H "Content-Type: application/json" \
  -d '{
    "full_name": "Test User",
    "phone": "+923001234999",
    "email": "test@example.com",
    "password": "password123"
  }'
```

#### Login User
```bash
curl -X POST http://localhost:8000/api/auth/login \
  -H "Content-Type: application/json" \
  -d '{
    "phone": "+923001234999",
    "password": "password123"
  }'
```

#### Get Services
```bash
curl -X GET http://localhost:8000/api/services \
  -H "Authorization: Bearer YOUR_JWT_TOKEN"
```

#### Create Booking
```bash
curl -X POST http://localhost:8000/api/bookings \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer YOUR_JWT_TOKEN" \
  -d '{
    "service_id": 1,
    "package_id": 1,
    "stylist_id": 1,
    "date_time": "2024-01-15 14:00:00",
    "notes": "Regular appointment"
  }'
```

---

## 📱 Mobile App Integration

### Flutter Configuration
Update your Flutter app's constants:

```dart
// lib/constants/app_constants.dart
static const String baseUrl = 'http://localhost:8000/api';
```

### Response Handling
All API responses follow this consistent format:

```json
{
  "success": boolean,
  "message": "string",
  "data": object|array,
  "errors": object // Only present on validation errors
}
```

### Error Handling
Handle different HTTP status codes:
- `200`: Success
- `201`: Created
- `401`: Unauthorized (invalid token)
- `422`: Validation error
- `404`: Not found
- `500`: Server error

---

**API Version**: 1.0  
**Last Updated**: January 2024  
**Base URL**: `http://localhost:8000/api`


