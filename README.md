# Claire's Recipes 🍳

A modern, feature-rich recipe management and sharing platform built with Laravel 11, Livewire, and Tailwind CSS.

![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.2%7C8.3-777BB4?style=for-the-badge&logo=php)
![Livewire](https://img.shields.io/badge/Livewire-3.x-4E56A6?style=for-the-badge&logo=livewire)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.x-38B2AC?style=for-the-badge&logo=tailwind-css)

## ✨ Features

### 🍽️ Recipe Management
- **Smart Recipe Creation**: Automated ingredient extraction and processing
- **Rich Media Support**: High-quality recipe images with optimization
- **Categorization**: Organize recipes by cuisine, diet, course, and seasonal preferences
- **Nutritional Information**: Detailed nutritional breakdown with interactive display
- **Rating & Reviews**: Community-driven recipe ratings and feedback

### 📱 User Experience
- **Responsive Design**: Mobile-first approach with optimized layouts
- **Advanced Search**: Full-text search with Algolia Scout integration
- **Interactive Components**: Dynamic Livewire components for seamless UX
- **Social Sharing**: Share recipes on Facebook, Twitter/X, and Pinterest
- **Meal Planning**: Weekly meal planner with shopping list generation

### 🔧 Smart Features
- **Ingredient Intelligence**: API-powered ingredient recognition and nutrition lookup
- **Shopping Lists**: Auto-generated shopping lists from meal plans
- **Favorites System**: Save and organize favorite recipes
- **Print-Friendly**: Optimized recipe printing functionality
- **SEO Optimized**: Meta tags and structured data for search engines

### 👥 Admin Features
- **Recipe Management**: Comprehensive admin panel for content management
- **User Management**: User roles and permissions
- **Analytics**: Recipe views and engagement tracking
- **Content Moderation**: Review and moderate user-submitted content

## 🚀 Quick Start

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js & NPM
- MySQL/PostgreSQL database

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/sammytron612/claires-recipes.git
   cd claires-recipes
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure your `.env` file**
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=claires_recipes
   DB_USERNAME=your_username
   DB_PASSWORD=your_password

   FACEBOOK_APP_ID=
   FACEBOOK_APP_SECRET=
   FACEBOOK_REDIRECT=https://claires-recipes.uk/auth/facebook/callback
   
   SCOUT_DRIVER=meilisearch
   MEILISEARCH_HOST=http://127.0.0.1:7700
   MEILISEARCH_KEY=

   # Edamam API for ingredient data
   EDAMAM_APP_ID=your_edamam_app_id
   EDAMAM_APP_KEY=your_edamam_key
   ```

6. **Run migrations and seed database**
   ```bash
   php artisan migrate --seed
   ```

7. **Build assets**
   ```bash
   npm run dev
   # or for production
   npm run production
   ```

8. **Start the development server**
   ```bash
   php artisan serve
   ```

Visit `http://localhost:8000` to see your application!

## 🏗️ Architecture

### Tech Stack
- **Backend**: Laravel 11.x with PHP 8.2+
- **Frontend**: Blade templates with Livewire 3.x
- **Styling**: Tailwind CSS with custom components
- **Database**: MySQL with Eloquent ORM
- **Search**: Laravel Scout with meilisearch
- **Build Tools**: Laravel Mix with Webpack

### Key Components

#### Models
- `Recipe` - Core recipe management
- `Ingredient` - Ingredient database with nutrition data
- `RecipeIngredient` - Recipe-ingredient relationships with quantities
- `User` - User management and authentication
- `Category` - Recipe categorization (Cuisine, Diet, Course, etc.)

#### Livewire Components
- `SelectIngredients` - Dynamic ingredient selection
- `Nutrition` - Interactive nutritional information display
- `RecipeCard` - Reusable recipe display component

#### Services
- `IngredientService` - HTML parsing and ingredient extraction
- `NewIngredient` - API integration for ingredient data
- `CheckIngredients` - Ingredient validation and matching

## 📁 Project Structure

```
app/
├── Http/
│   ├── Controllers/     # Route controllers
│   ├── Livewire/       # Livewire components
│   └── Helpers/        # Helper classes and services
├── Models/             # Eloquent models
└── View/Components/    # Blade components

resources/
├── views/
│   ├── components/     # Blade components
│   ├── livewire/      # Livewire component views
│   ├── recipe/        # Recipe-related views
│   └── layouts/       # Layout templates
├── css/               # Tailwind CSS files
└── js/                # JavaScript assets

database/
├── migrations/        # Database migrations
└── seeders/          # Database seeders
```

## 🔧 Configuration

### Database Setup
The application uses several key tables:
- `recipes` - Main recipe data
- `ingredients` - Ingredient master data
- `recipe_ingredients` - Recipe-ingredient relationships
- `users` - User accounts
- `categories` - Recipe categorization

### API Integration
Configure the Edamam Food Database API for automatic ingredient nutrition lookup:
1. Sign up at [Edamam Developer Portal](https://developer.edamam.com/)
2. Get your APP_ID and APP_KEY
3. Add to your `.env` file

## 🚀 Deployment

### Production Checklist
- [ ] Set `APP_ENV=production` in `.env`
- [ ] Configure production database
- [ ] Set up file storage (local/S3)
- [ ] Configure mail settings
- [ ] Set up SSL certificate
- [ ] Configure caching (Redis recommended)
- [ ] Set up queue workers
- [ ] Configure search indexing

### Recommended Hosting
- **Shared Hosting**: Compatible with most PHP hosting providers
- **VPS/Cloud**: DigitalOcean, Linode, AWS EC2
- **Platform-as-a-Service**: Laravel Forge, Vapor

## 🤝 Contributing

We welcome contributions! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

### Development Guidelines
- Follow PSR-12 coding standards
- Write descriptive commit messages
- Add tests for new features
- Update documentation as needed

## 📝 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🙏 Acknowledgments

- **Laravel Framework** - The web artisans framework
- **Livewire** - For making Laravel dynamic
- **Tailwind CSS** - For beautiful, responsive design
- **Algolia** - For powerful search capabilities
- **Edamam API** - For comprehensive food and nutrition data

## 📞 Support

For support, email support@clairesrecipes.com or create an issue in this repository.

## 🔗 Links

- [Live Demo](https://clairesrecipes.com)
- [Documentation](https://github.com/sammytron612/claires-recipes/wiki)
- [Issues](https://github.com/sammytron612/claires-recipes/issues)
- [Releases](https://github.com/sammytron612/claires-recipes/releases)

---

Made with ❤️ by [Claire](https://github.com/sammytron612)
