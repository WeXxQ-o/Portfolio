# 💼 Portfolio Website - Reštruktúrizované

Modernizovaná súborová štruktúra s best practices pre PHP projekty.

## 🛠️ Tech Stack

- **Frontend:** HTML5, CSS3, JavaScript
- **Backend:** PHP
- **Framework:** Bootstrap 5
- **Architecture:** Modular structure with separation of concerns

## 📁 Profesionálna Štruktúra

```
Portfolio_/
├── config/              # Konfigurácia (config.php)
├── includes/            # Opakovateľné komponenty (header, navbar, footer, functions)
├── components/          # Znovupoužiteľné UI komponenty
├── handlers/            # Backend spracovanie (contact-handler.php)
├── pages/               # Všetky podstránky
├── assets/              # Statické súbory
│   ├── css/             # 7 modulárnych CSS súborov
│   ├── js/              # 4 modulárne JS súbory
│   └── img/             # Organizované obrázky
├── data/                # JSON dáta (projects, skills)
├── templates/           # Email templates
└── uploads/             # Nahraté súbory (chránené)
```

## 🚀 Spustenie

1. **Clone repository:**
   ```bash
   git clone https://github.com/WeXxQ-o/Portfolio.git
   cd Portfolio
   ```

2. **Presun obrázkov:**
   ```bash
   python move_images.py
   ```

3. **Konfigurácia:**
   - Uprav `config/config.php` - zmeň `BASE_URL` na svoju URL
   - Pre production vypni `display_errors`

4. **Otvor v prehliadači:**
   ```
   http://localhost/Portfolio_/index.php
   ```

## ✨ Výhody Novej Štruktúry

- ✅ **DRY Princíp** - Header/Footer len raz definované
- ✅ **Modularita** - CSS a JS rozdelené logicky  
- ✅ **Bezpečnosť** - .htaccess ochrana, sanitizácia vstupov
- ✅ **Škálovateľnosť** - Ľahko rozšíriteľné
- ✅ **Profesionálne** - Industry best practices

## 📄 Stránky

- **Home** - `index.php`
- **About** - `pages/about.php`
- **Skills** - `pages/skills.php`
- **Projects** - `pages/projects.php`
- **FAQ** - `pages/faq.php`
- **Contact** - `pages/contact.php`

## 📬 Contact

- GitHub: [@WeXxQ-o](https://github.com/WeXxQ-o)
- Email: example@email.com
- Location: Slovakia

---

**Made with 💜 by WeXxQ**
