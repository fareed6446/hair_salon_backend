# Hair Salon Backend Setup Guide

## 🚀 Quick Start with Herd

This guide will help you set up the Hair Salon backend using Laravel Herd for a seamless development experience.

### Prerequisites
- [Laravel Herd](https://herd.laravel.com/) installed
- PHP 8.2+ (included with Herd)
- Composer (included with Herd)

---

## 📋 Step-by-Step Setup

### 1. Clone and Navigate
```bash
cd "/Users/ghulamfareed/Documents/New Folder/hair_salon_backend"
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Environment Configuration
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Generate JWT secret
php artisan jwt:secret
```

### 4. Database Setup
```bash
# Create SQLite database (default)
touch database/database.sqlite

# Run migrations
php artisan migrate

# Seed with sample data
php artisan db:seed
```

### 5. Start Development Server
```bash
php artisan serve
```

The API will be available at: `http://localhost:8000/api`

---

## 🎯 Herd Integration

### Adding to Herd
1. Open Laravel Herd
2. Click "Add Site"
3. Navigate to the project directory
4. Set the domain (e.g., `hair-salon-api.test`)
5. Click "Add Site"

### Access URLs
- **API**: `http://hair-salon-api.test/api`
- **Admin Panel**: `http://hair-salon-api.test/admin`

---

## 🔐 Default Credentials

### Admin Panel Access
- **URL**: `http://localhost:8000/admin` (or your Herd domain)
- **Email**: `admin@hairsalon.com`
- **Phone**: `+923001234567`
- **Password**: `password`

### Test User Accounts
| Name | Phone | Email | Password | Loyalty Points |
|------|-------|-------|----------|----------------|
| Sarah Ahmed | +923001234568 | sarah@example.com | password | 150 |
| Fatima Khan | +923001234569 | fatima@example.com | password | 75 |
| Ayesha Malik | +923001234570 | ayesha@example.com | password | 200 |
| Zara Sheikh | +923001234571 | zara@example.com | password | 50 |

---

## 📱 Mobile App Configuration

### Update Flutter App
In your Flutter app's `lib/constants/app_constants.dart`:

```dart
// For local development
static const String baseUrl = 'http://localhost:8000/api';

// For Herd development
static const String baseUrl = 'http://hair-salon-api.test/api';

// For production
static const String baseUrl = 'https://your-domain.com/api';
```

### Test API Connection
```bash
# Test API health
curl http://localhost:8000/api/services

# Test with authentication
curl -X POST http://localhost:8000/api/auth/login \
  -H "Content-Type: application/json" \
  -d '{"phone": "+923001234568", "password": "password"}'
```

---

## 🗄️ Database Management

### View Database
```bash
# Open SQLite database
sqlite3 database/database.sqlite

# View tables
.tables

# View users
SELECT * FROM users;

# Exit
.quit
```

### Reset Database
```bash
# Fresh migration with seeding
php artisan migrate:fresh --seed
```

### Add More Sample Data
```bash
# Run specific seeder
php artisan db:seed --class=UserSeeder
```

---

## 🎨 Admin Panel Features

### Dashboard
- Overview of bookings, users, and revenue
- Quick statistics and charts
- Recent activity feed

### User Management
- View all customers
- Edit user profiles
- Manage loyalty points
- View booking history

### Service Management
- Add/edit services
- Manage service packages
- Set pricing and duration
- Upload service images

### Booking Management
- View all appointments
- Filter by status, date, stylist
- Edit booking details
- Cancel bookings
- Mark as completed

### Stylist Management
- Add/edit stylists
- Set specializations
- Manage working hours
- Upload stylist photos

### Notification Management
- Send notifications to users
- View notification history
- Manage notification types
- Bulk notifications

---

## 🔧 Development Tools

### Artisan Commands
```bash
# Clear all caches
php artisan optimize:clear

# Generate new JWT secret
php artisan jwt:secret

# Create new migration
php artisan make:migration create_new_table

# Create new model
php artisan make:model NewModel

# Create new controller
php artisan make:controller Api/NewController
```

### Debugging
```bash
# Enable debug mode
# Set APP_DEBUG=true in .env

# View logs
tail -f storage/logs/laravel.log

# Tinker for testing
php artisan tinker
```

---

## 🚀 Production Deployment

### Environment Setup
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hair_salon
DB_USERNAME=your_username
DB_PASSWORD=your_password

JWT_SECRET=your_production_jwt_secret
```

### Deployment Steps
```bash
# Install dependencies
composer install --optimize-autoloader --no-dev

# Generate key and JWT secret
php artisan key:generate
php artisan jwt:secret

# Run migrations
php artisan migrate --force

# Seed database
php artisan db:seed --force

# Cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## 🧪 Testing the API

### Postman Collection
Import the following endpoints into Postman:

1. **Authentication**
   - POST `/auth/register`
   - POST `/auth/login`
   - GET `/auth/me`

2. **Services**
   - GET `/services`
   - GET `/services/{id}`

3. **Bookings**
   - POST `/bookings`
   - GET `/bookings`
   - GET `/bookings/{id}`
   - POST `/bookings/{id}/cancel`

4. **Notifications**
   - GET `/notifications`
   - POST `/notifications/{id}/read`

### Test Scenarios
1. Register a new user
2. Login and get JWT token
3. Browse available services
4. Create a booking
5. View user's bookings
6. Check notifications
7. Cancel a booking

---

## 🔍 Troubleshooting

### Common Issues

#### JWT Token Issues
```bash
# Regenerate JWT secret
php artisan jwt:secret --force
```

#### Database Issues
```bash
# Reset database
php artisan migrate:fresh --seed
```

#### Permission Issues
```bash
# Fix storage permissions
chmod -R 775 storage bootstrap/cache
```

#### CORS Issues
- Update `config/cors.php` for your domain
- Add your Flutter app's domain to allowed origins

### Log Files
- **Laravel Logs**: `storage/logs/laravel.log`
- **PHP Error Log**: Check your PHP configuration
- **Web Server Logs**: Check Apache/Nginx logs

---

## 📚 Additional Resources

### Documentation
- [Laravel 12 Documentation](https://laravel.com/docs/12.x)
- [JWT Auth Documentation](https://jwt-auth.readthedocs.io/)
- [Filament Documentation](https://filamentphp.com/docs)

### Useful Commands
```bash
# Check Laravel version
php artisan --version

# List all routes
php artisan route:list

# Check configuration
php artisan config:show

# Clear specific cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

---

## 🎉 Success!

Your Hair Salon backend is now ready! 

- ✅ API running at `http://localhost:8000/api`
- ✅ Admin panel at `http://localhost:8000/admin`
- ✅ Sample data loaded
- ✅ JWT authentication configured
- ✅ Ready for mobile app integration

### Next Steps
1. Test the API endpoints
2. Configure your Flutter app
3. Start developing your mobile app features
4. Customize the admin panel as needed

---

**Happy Coding! 🚀**



