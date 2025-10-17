# 📮 Hair Salon API - Postman Collection Guide

## 🚀 Quick Start

### 1. Import Collection & Environment
1. **Import Collection**: Import `Hair_Salon_API.postman_collection.json` into Postman
2. **Import Environment**: Import `Hair_Salon_API.postman_environment.json` into Postman
3. **Select Environment**: Choose "Hair Salon API Environment" from the environment dropdown

### 2. Start Your API Server
```bash
cd hair_salon_backend
php artisan serve
```

### 3. Test Authentication
1. Run **"Login User"** request (uses test user credentials)
2. JWT token will be automatically saved to environment
3. All subsequent requests will use the saved token

---

## 📋 Collection Overview

### 🔐 Authentication (5 endpoints)
- **Register User** - Create new account
- **Login User** - Get JWT token
- **Get Current User** - View profile
- **Logout User** - Invalidate token
- **Refresh Token** - Get new token

### 🎯 Services (2 endpoints)
- **Get All Services** - Browse available services
- **Get Service Details** - View specific service with packages

### 📅 Bookings (4 endpoints)
- **Create Booking** - Make new appointment
- **Get User Bookings** - View all bookings (with filters)
- **Get Booking Details** - View specific booking
- **Cancel Booking** - Cancel upcoming appointment

### 🔔 Notifications (4 endpoints)
- **Get Notifications** - View all notifications
- **Mark Notification as Read** - Mark specific notification
- **Mark All Notifications as Read** - Mark all as read
- **Get Unread Count** - Count unread notifications

### ⏰ Time Slots (1 endpoint)
- **Get Available Time Slots** - Check appointment availability

---

## 🎯 Test User Credentials

### Pre-loaded Test Users
| Name | Phone | Email | Password | Loyalty Points |
|------|-------|-------|----------|----------------|
| Sarah Ahmed | +923001234568 | sarah@example.com | password | 150 |
| Fatima Khan | +923001234569 | fatima@example.com | password | 75 |
| Ayesha Malik | +923001234570 | ayesha@example.com | password | 200 |
| Zara Sheikh | +923001234571 | zara@example.com | password | 50 |

### Admin Credentials
- **Email**: admin@hairsalon.com
- **Phone**: +923001234567
- **Password**: password

---

## 🔧 Environment Variables

### Auto-Managed Variables
These are automatically set by the collection:
- `jwt_token` - JWT authentication token
- `user_id` - Current user ID
- `user_name` - Current user name
- `loyalty_points` - User's loyalty points
- `booking_id` - Last created booking ID
- `loyalty_points_awarded` - Points from last booking

### Manual Variables
You can modify these as needed:
- `base_url` - API base URL (default: http://localhost:8000/api)
- `service_id` - Service ID for testing (default: 1)
- `package_id` - Package ID for testing (default: 1)
- `stylist_id` - Stylist ID for testing (default: 1)

---

## 🧪 Testing Workflow

### 1. Authentication Flow
```
1. Login User → JWT token saved
2. Get Current User → Verify authentication
3. Refresh Token → Get new token
4. Logout User → Invalidate token
```

### 2. Service Discovery
```
1. Get All Services → Browse available services
2. Get Service Details → View specific service
```

### 3. Booking Flow
```
1. Get Available Time Slots → Check availability
2. Create Booking → Make appointment
3. Get User Bookings → View all bookings
4. Get Booking Details → View specific booking
5. Cancel Booking → Cancel if needed
```

### 4. Notification Management
```
1. Get Notifications → View all notifications
2. Get Unread Count → Check unread count
3. Mark Notification as Read → Mark specific notification
4. Mark All Notifications as Read → Mark all as read
```

---

## 📝 Sample Request Bodies

### Register User
```json
{
    "full_name": "John Doe",
    "phone": "+923001234567",
    "email": "john@example.com",
    "password": "password123"
}
```

### Login User
```json
{
    "phone": "+923001234568",
    "password": "password"
}
```

### Create Booking
```json
{
    "service_id": 1,
    "package_id": 1,
    "stylist_id": 1,
    "date_time": "2024-12-25 14:00:00",
    "notes": "Regular appointment for hair cut"
}
```

---

## 🔍 Response Examples

### Successful Login Response
```json
{
    "success": true,
    "message": "Login successful",
    "user": {
        "id": 2,
        "full_name": "Sarah Ahmed",
        "phone": "+923001234568",
        "email": "sarah@example.com",
        "loyalty_points": 150
    },
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9..."
}
```

### Services Response
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
            "packages": [
                {
                    "id": 1,
                    "name": "Basic Cut",
                    "price": "1500.00",
                    "duration_minutes": 45
                }
            ]
        }
    ]
}
```

### Booking Created Response
```json
{
    "success": true,
    "message": "Booking created successfully",
    "data": {
        "id": 1,
        "user_id": 2,
        "service_id": 1,
        "package_id": 1,
        "stylist_id": 1,
        "date_time": "2024-12-25T14:00:00.000000Z",
        "status": "booked",
        "loyalty_points_awarded": 15,
        "notes": "Regular appointment for hair cut",
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

---

## ❌ Error Handling

### Common Error Responses

#### 401 - Unauthorized
```json
{
    "success": false,
    "message": "Invalid credentials"
}
```

#### 422 - Validation Error
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

#### 404 - Not Found
```json
{
    "success": false,
    "message": "Service not found"
}
```

---

## 🎯 Business Logic Testing

### Loyalty Points System
- **Earning**: 1 point per PKR 100 spent
- **First Booking**: 10% discount bonus
- **Redemption Tiers**:
  - 50 points → 5% discount
  - 100 points → 10% discount
  - 200 points → 15% discount + free service

### Booking Rules
- **Advance Booking**: Maximum 60 days in advance
- **Cancellation**: Points deducted if cancelled
- **Status Flow**: `booked` → `completed`/`cancelled`/`no_show`

### Notification Types
- `booking_confirmation` - Booking created/confirmed
- `appointment_reminder` - Upcoming appointment reminder
- `promotional` - Special offers and discounts
- `loyalty_update` - Points earned/redeemed

---

## 🔧 Troubleshooting

### Common Issues

#### 1. JWT Token Expired
**Solution**: Run "Refresh Token" request or login again

#### 2. 401 Unauthorized
**Solution**: Check if JWT token is set in environment variables

#### 3. 422 Validation Error
**Solution**: Check request body format and required fields

#### 4. 404 Not Found
**Solution**: Verify service/booking IDs exist in database

#### 5. Server Not Running
**Solution**: Start Laravel server with `php artisan serve`

---

## 🚀 Advanced Usage

### Running Collection Tests
1. Select the entire collection
2. Click "Run" button
3. Choose environment
4. Click "Run Hair Salon API"

### Custom Test Scripts
Each request includes test scripts that:
- Automatically save JWT tokens
- Set environment variables
- Log API responses
- Handle errors gracefully

### Environment Switching
Create multiple environments for:
- **Local Development**: `http://localhost:8000/api`
- **Herd Development**: `http://hair-salon-api.test/api`
- **Production**: `https://your-domain.com/api`

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

---

## 🎉 Success!

Your Postman collection is ready! You can now:

✅ **Test all 16 API endpoints**  
✅ **Automatically manage JWT tokens**  
✅ **Test complete user workflows**  
✅ **Verify business logic**  
✅ **Debug API issues**  
✅ **Integrate with mobile app**

### Next Steps
1. Import the collection and environment
2. Start your Laravel server
3. Run the authentication flow
4. Test all endpoints
5. Integrate with your Flutter app

**Happy Testing! 🚀**

---

**Collection Version**: 1.0  
**Last Updated**: January 2024  
**Compatible with**: Laravel 12, JWT Auth, Filament 3
