# Security Guidelines for Claire's Recipes

## Environment Variables Required

Add these to your `.env` file:

```env
# API Keys (NEVER commit these to version control)
RAPIDAPI_KEY=your_rapidapi_key_here
EDAMAM_APP_ID=your_edamam_app_id
EDAMAM_APP_KEY=your_edamam_app_key

# Application Security
APP_KEY=your_32_character_app_key
APP_ENV=production
APP_DEBUG=false

# Database (use strong passwords)
DB_PASSWORD=your_strong_database_password

# Session Security
SESSION_SECURE_COOKIE=true
SESSION_HTTP_ONLY=true
SESSION_SAME_SITE=strict
```

## Security Checklist

### ✅ Implemented
- [x] Laravel Authentication system
- [x] CSRF protection on all forms  
- [x] SQL injection prevention (Eloquent ORM)
- [x] Route middleware protection
- [x] File upload validation
- [x] Password hashing (bcrypt)
- [x] API key moved to environment variables
- [x] Authorization checks for user actions
- [x] XSS prevention with proper escaping

### 🔄 Additional Recommendations

#### **File Upload Security**
```php
// Enhanced file validation
'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048|dimensions:max_width=2000,max_height=2000'
```

#### **Rate Limiting**
Add to routes that need protection:
```php
Route::middleware(['throttle:10,1'])->group(function () {
    // Limited routes
});
```

#### **Content Security Policy (CSP)**
Add to `.htaccess` or nginx config:
```
Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline'; style-src 'self' 'unsafe-inline';
```

#### **Security Headers**
Consider adding security middleware:
```php
// In middleware
$response->headers->set('X-Content-Type-Options', 'nosniff');
$response->headers->set('X-Frame-Options', 'DENY');
$response->headers->set('X-XSS-Protection', '1; mode=block');
```

## Regular Security Tasks

### Weekly
- [ ] Check for Laravel security updates
- [ ] Review user access logs
- [ ] Monitor failed login attempts

### Monthly  
- [ ] Review file uploads for suspicious content
- [ ] Check database for unusual activity
- [ ] Update dependencies with security patches

### Quarterly
- [ ] Security audit of new features
- [ ] Review API key usage and rotation
- [ ] Penetration testing of public endpoints

## Incident Response

If you suspect a security breach:

1. **Immediate**: Change all API keys and passwords
2. **Assessment**: Check logs for unauthorized access
3. **Containment**: Block suspicious IP addresses  
4. **Recovery**: Restore from clean backups if needed
5. **Documentation**: Record incident details and response

## Contact

For security concerns, contact: security@clairesrecipes.com
