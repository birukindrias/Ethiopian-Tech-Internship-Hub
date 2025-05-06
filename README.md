# Gigavel

**Gigavel** is a minimalist Laravel-style PHP MVC framework — built for developers who want the structure of Laravel without the bloat. It comes powered by **HTMX** and **Alpine.js**, enabling reactive and dynamic interfaces with almost zero JavaScript code.

> ✨ The smallest Laravel-like MVC with just enough magic and full control.

---

## ⚙️ Core Stack

- 🐘 **PHP MVC** – Models, Views, and Controllers inspired by Laravel's architecture.
- ⚡ **HTMX (~14kB)** – Handles dynamic content, AJAX, and HTML swaps declaratively.
- 🔮 **Alpine.js (~7kB)** – Gives reactivity like Vue but fits in your HTML.
- 🪶 **Super lightweight** – ~21kB of JS, near-zero boilerplate, blazing fast.

---

## 📁 Directory Structure

```

gigavel/
├── app/
│   └── Controllers/
│       └── HomeController.php
├── config/
│   └── routes.php
├── resources/
│   └── views/
│       └── home.php
├── public/
│   └── index.php
├── .env.example
├── composer.json
└── README.md

```

---

## 🚀 Why Gigavel?

- 🧠 Laravel-like structure without the heavy framework
- 🔥 HTMX for backend-powered dynamic UIs (no AJAX boilerplate)
- 🧬 Alpine for instant frontend reactivity
- 🏎️ Fast load, minimal dependencies
- 🛠️ Designed for simplicity and rapid prototyping

---

## 💡 HTMX + Alpine vs. Livewire

| Feature              | HTMX + Alpine.js        | Laravel Livewire          |
|----------------------|-------------------------|----------------------------|
| Initial JS Load      | ⚡ ~21kB                 | 🐘 ~80-100kB               |
| Page Updates         | ⚡ HTML swaps            | 🐢 JSON + DOM rehydration |
| PHP Integration      | ✅ Return views directly | ✅ Full reactivity         |
| Manual JS Needed     | ❌ Minimal               | ✅ Required                |
| Speed                | ⚡ Faster overall        | 🐢 Heavier & slower        |

**✅ Verdict**: HTMX + Alpine wins for raw speed, control, and simplicity — perfect for Gigavel’s lean mission.

---

## 📦 Installation

```bash
git clone https://github.com/yourusername/gigavel.git
cd gigavel
composer install
cp .env.example .env
php run

Then open [http://localhost:8000](http://localhost:8000) in your browser.

---

## ✨ Example Usage

### Define a Route (`config/routes.php`)

```php
return [
    '/' => ['App\Controllers\HomeController', 'index']
];
```


Create a Controller (app/Controllers/HomeController.php)

```

namespace App\Controllers;

class HomeController {
    public function index() {
        require_once __DIR__ . '/../../resources/views/home.php';
    }
}

```

Build a View (resources/views/home.php)

```

<h1 hx-get="/some-action" hx-swap="outerHTML">Click me</h1>

<div x-data="{ open: false }" @click="open = !open">
    <p x-show="open">Hello from Alpine!</p>
</div>
```


# 🧪 Philosophy

**Gigavel** is about fast iteration and keeping your tools out of your way.
It gives you enough Laravel-style structure to scale while staying lean and snappy.
  
# 📜 License

MIT © Biruk Endrias






# Ethiopian-Tech-Internship-Hub
# Ethiopian-Tech-Internship-Hub
