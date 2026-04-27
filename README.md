# Black Fragrance

Black Fragrance is a Laravel storefront project built from a fashion e-commerce template. The app is currently focused on the front-end experience: a homepage, product browsing, blog, about, contact, styles, and thank-you pages are wired through Laravel routes and rendered with Blade views.

## What Is In The Project

- Laravel app shell with Blade-based page rendering
- Home page at `/` and `/index.html`
- Content pages for `/about`, `/blog`, `/contact`, `/shop`, `/single-post`, `/styles`, and `/thank-you`
- Static template assets under `public/` for images, CSS, and JavaScript
- Tailwind and Vite scaffolding available for future UI work

## Main Entry Points

- [routes/web.php](routes/web.php) defines all public pages
- [resources/views/pages/index.blade.php](resources/views/pages/index.blade.php) contains the main storefront homepage markup
- [public/style.css](public/style.css) and [resources/css/app.css](resources/css/app.css) hold the project styling layers

## Local Setup

1. Install dependencies with `composer install` and `npm install`.
2. Copy `.env.example` to `.env` and set your app and database values.
3. Run migrations with `php artisan migrate` if you want the database tables created.
4. Start the app with `php artisan serve`.
5. In a second terminal, run `npm run dev` for frontend assets.

## Notes

- The repo includes a full storefront theme, but most navigation targets are still template-driven rather than backed by database models.
- The current focus is on page presentation and routing, not on a completed checkout or product management system.
