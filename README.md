# Hair Salon Backend - Laravel 12 API

A complete Laravel 12 backend API for the Hair Salon mobile application with JWT authentication and Filament admin panel.

## 🚀 Features

### API Endpoints
- **Authentication**: JWT-based user registration, login, logout
- **Services**: Browse services with packages and pricing
- **Bookings**: Create, view, and cancel appointments
- **Notifications**: Real-time notifications system
- **Time Slots**: Available time slot management
- **Loyalty System**: Points earning and redemption

### Admin Panel (Filament)
- **User Management**: Manage customers and their data
- **Service Management**: Add/edit services and packages
- **Booking Management**: View and manage all appointments
- **Stylist Management**: Manage salon staff
- **Notification Management**: Send and manage notifications
- **Loyalty Management**: Track loyalty transactions

### Database Models
- **Users**: Customer accounts with loyalty points
- **Services**: Salon services with packages
- **Service Packages**: Different pricing tiers for services
- **Stylists**: Salon staff with specializations
- **Bookings**: Appointment management
- **Notifications**: User notifications system
- **Loyalty Transactions**: Points tracking
- **Time Slots**: Available appointment slots

## 📋 Requirements

- PHP 8.2+
- Laravel 12
- SQLite/MySQL/PostgreSQL
- Composer

## 🛠️ Installation

### 1. Clone and Setup
```bash
cd hair_salon_backend
composer install
cp .env.example .env
php artisan key:generate
```

### 2. Database Setup
```bash
# For SQLite (default)
touch database/database.sqlite

# Or configure MySQL/PostgreSQL in .env
php artisan migrate
php artisan db:seed
```

### 3. JWT Configuration
```bash
php artisan jwt:secret
```

### 4. Start Development Server
```bash
php artisan serve
```

The API will be available at `http://localhost:8000/api`

## 🔐 Authentication

### Register User
```http
POST /api/auth/register
Content-Type: application/json

{
    "full_name": "John Doe",
    "phone": "+923001234567",
    "email": "john@example.com",
    "password": "password123"
}
```

### Login User
```http
POST /api/auth/login
Content-Type: application/json

{
    "phone": "+923001234567",
    "password": "password123"
}
```

### Get Current User
```http
GET /api/auth/me
Authorization: Bearer {jwt_token}
```

## 📱 API Endpoints

### Authentication
- `POST /api/auth/register` - Register new user
- `POST /api/auth/login` - Login user
- `GET /api/auth/me` - Get current user
- `POST /api/auth/logout` - Logout user
- `POST /api/auth/refresh` - Refresh JWT token

### Services
- `GET /api/services` - Get all active services
- `GET /api/services/{id}` - Get specific service with packages

### Bookings
- `POST /api/bookings` - Create new booking
- `GET /api/bookings` - Get user's bookings (with status filter)
- `GET /api/bookings/{id}` - Get specific booking
- `POST /api/bookings/{id}/cancel` - Cancel booking

### Notifications
- `GET /api/notifications` - Get user's notifications
- `POST /api/notifications/{id}/read` - Mark notification as read
- `POST /api/notifications/mark-all-read` - Mark all as read
- `GET /api/notifications/unread-count` - Get unread count

### Time Slots
- `GET /api/time-slots` - Get available time slots

## 🎯 Business Logic

### Loyalty Points System
- **Earning**: 1 point per PKR 100 spent
- **First Booking Bonus**: 10% discount
- **Redemption Tiers**:
  - 50 points → 5% discount
  - 100 points → 10% discount
  - 200 points → 15% discount + free service
- **Points Expiry**: 365 days

### Booking Rules
- **Advance Booking**: Up to 60 days in advance
- **Cancellation**: Points deducted if cancelled
- **Status Flow**: booked → completed/cancelled/no_show

## 🎨 Admin Panel

Access the admin panel at: `http://localhost:8000/admin`

### Default Admin Credentials
- **Email**: admin@hairsalon.com
- **Phone**: +923001234567
- **Password**: password

### Admin Features
- **Dashboard**: Overview of bookings, users, and revenue
- **User Management**: View/edit customer profiles
- **Service Management**: Add/edit services and packages
- **Booking Management**: View all appointments with filters
- **Stylist Management**: Manage salon staff
- **Notification Management**: Send notifications to users
- **Loyalty Management**: Track points and transactions

## 📊 Database Schema

### Users Table
```sql
- id (primary key)
- name (required)
- full_name (required)
- email (nullable, unique)
- phone (required, unique)
- password (hashed)
- loyalty_points (default: 0)
- email_verified_at (nullable)
- created_at, updated_at
```

### Services Table
```sql
- id (primary key)
- title (required)
- description (nullable)
- base_price (decimal)
- duration_minutes (integer)
- image_url (nullable)
- category_id (nullable)
- is_active (boolean, default: true)
- created_at, updated_at
```

### Bookings Table
```sql
- id (primary key)
- user_id (foreign key)
- service_id (foreign key)
- package_id (nullable, foreign key)
- stylist_id (nullable, foreign key)
- date_time (datetime)
- status (enum: booked, cancelled, completed, no_show)
- loyalty_points_awarded (integer)
- notes (nullable)
- created_at, updated_at
```

## 🔧 Configuration

### Environment Variables
```env
# Database
DB_CONNECTION=sqlite
DB_DATABASE=/path/to/database.sqlite

# JWT
JWT_SECRET=your_jwt_secret_here

# App
APP_NAME="Hair Salon API"
APP_URL=http://localhost:8000
```

### CORS Configuration
The API is configured to accept requests from the Flutter mobile app. Update CORS settings in `config/cors.php` if needed.

## 🧪 Testing

### Sample API Calls

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

## 📱 Mobile App Integration

### Flutter App Configuration
Update the Flutter app's `lib/constants/app_constants.dart`:

```dart
static const String baseUrl = 'http://localhost:8000/api';
```

### API Response Format
All API responses follow this format:

```json
{
  "success": true,
  "message": "Operation successful",
  "data": { ... },
  "errors": { ... } // Only on validation errors
}
```

## 🚀 Deployment

### Production Setup
1. Configure production database
2. Set `APP_ENV=production`
3. Generate JWT secret: `php artisan jwt:secret`
4. Run migrations: `php artisan migrate --force`
5. Seed database: `php artisan db:seed --force`
6. Optimize: `php artisan config:cache && php artisan route:cache`

### Heroku Deployment
```bash
# Add to Procfile
web: vendor/bin/heroku-php-apache2 public/

# Environment variables
APP_ENV=production
DB_CONNECTION=pgsql
JWT_SECRET=your_production_jwt_secret
```

## 📚 Additional Resources

### Laravel Documentation
- [Laravel 12 Documentation](https://laravel.com/docs/12.x)
- [JWT Auth Documentation](https://jwt-auth.readthedocs.io/)
- [Filament Documentation](https://filamentphp.com/docs)

### API Testing
- Use Postman collection (included in project)
- Test all endpoints with sample data
- Verify JWT token flow

## 🤝 Contributing

1. Fork the repository
2. Create feature branch
3. Make changes
4. Test thoroughly
5. Submit pull request

## 📄 License

This project is licensed under the MIT License.

## 🆘 Support

For issues and questions:
- Create an issue in the repository
- Contact: support@hairsalon.com

---

**Built with ❤️ using Laravel 12, JWT Auth, and Filament**