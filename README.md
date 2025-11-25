# 💼 Personal Portfolio Website

<div align="center">

![Portfolio Banner](https://img.shields.io/badge/Portfolio-WeXxQ-a855f7?style=for-the-badge)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)
![Bootstrap](https://img.shields.io/badge/Bootstrap-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)

**A modern, responsive portfolio website showcasing my journey as a student developer**

[View Demo](#) · [Report Bug](https://github.com/WeXxQ-o/Portfolio/issues) · [Request Feature](https://github.com/WeXxQ-o/Portfolio/issues)

</div>

---

## 📋 Table of Contents

- [About](#-about)
- [Features](#-features)
- [Tech Stack](#-tech-stack)
- [Project Structure](#-project-structure)
- [Getting Started](#-getting-started)
- [Pages Overview](#-pages-overview)
- [Customization](#-customization)
- [Browser Support](#-browser-support)
- [Contributing](#-contributing)
- [License](#-license)
- [Contact](#-contact)

---

## 🎯 About

This is my personal portfolio website built to showcase my skills, projects, and journey as a student developer. The website features a modern glassmorphism design with a purple gradient theme, smooth animations, and full responsiveness across all devices.

### ✨ Design Philosophy

- **Modern & Minimal** - Clean design with focus on content
- **Glassmorphism** - Trendy glass-like UI elements with backdrop blur
- **Purple Gradient Theme** - Professional yet vibrant color scheme
- **Smooth Animations** - Subtle hover effects and transitions
- **Mobile-First** - Fully responsive design for all screen sizes

---

## 🚀 Features

- ✅ **Fully Responsive** - Works seamlessly on desktop, tablet, and mobile
- ✅ **Modern UI/UX** - Glassmorphism design with smooth animations
- ✅ **Fast Loading** - Optimized performance with minimal dependencies
- ✅ **Clean Code** - Well-structured and commented codebase
- ✅ **SEO Friendly** - Semantic HTML with proper meta tags
- ✅ **Cross-Browser** - Compatible with all modern browsers
- ✅ **Easy Customization** - CSS variables for quick theme changes
- ✅ **Animated Elements** - Glowing effects, ripple animations, and hover states
- ✅ **Status Badge** - Live status indicator with pulse animation
- ✅ **Social Media Integration** - Links to GitHub, LinkedIn, and more

---

## 🛠️ Tech Stack

### Frontend
- **HTML5** - Semantic markup
- **CSS3** - Custom styles with modern features (Grid, Flexbox, Animations)
- **JavaScript (ES6+)** - Vanilla JS for interactivity
- **Bootstrap 5.3.8** - Responsive grid system and components

### Fonts & Icons
- **JetBrains Mono** - Modern monospace font
- **Bootstrap Icons** - Icon library
- **Devicon** - Technology logos

### Tools & Hosting
- **Git** - Version control
- **GitHub** - Code hosting and deployment
- **VS Code** - Code editor

---

## 📁 Project Structure

```
Portfolio_/
├── 📄 index.html           # Homepage
├── 📄 README.md            # Project documentation
│
├── 📁 css/
│   └── 📄 style.css        # Main stylesheet with all custom styles
│
├── 📁 js/
│   └── 📄 script.js        # JavaScript functionality
│
├── 📁 img/
│   └── 🖼️ zoro.jpg         # Profile image
│
└── 📁 pages/
    ├── 📄 about.html       # About me page
    ├── 📄 skills.html      # Skills showcase
    ├── 📄 projects.html    # Projects portfolio
    └── 📄 contact.html     # Contact information
```

---

## 🎬 Getting Started

### Prerequisites

- A modern web browser (Chrome, Firefox, Safari, Edge)
- A code editor (VS Code recommended)
- Basic knowledge of HTML/CSS/JavaScript (for customization)

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/WeXxQ-o/Portfolio.git
   ```

2. **Navigate to the project directory**
   ```bash
   cd Portfolio
   ```

3. **Open in browser**
   - Simply open `index.html` in your web browser
   - Or use a local development server:
   ```bash
   # Using Python
   python -m http.server 8000
   
   # Using Node.js (http-server)
   npx http-server
   ```

4. **Start customizing!**
   - Edit content in HTML files
   - Modify styles in `css/style.css`
   - Update images in `img/` folder

---

## 📄 Pages Overview

### 🏠 Home (`index.html`)
- Hero section with animated status badge
- Introduction with gradient text
- Call-to-action buttons
- Social media links
- Animated background glows

### 👤 About (`pages/about.html`)
- Profile card with animated border
- Personal information and bio
- Education timeline
- Work experience section
- Interests and hobbies
- Quick info badges

### 💪 Skills (`pages/skills.html`)
- Programming languages with progress bars
- Frontend technologies showcase
- Tools and technologies grid
- Currently learning section
- Skill categories with icons

### 🚀 Projects (`pages/projects.html`)
- Project showcase cards
- Project descriptions and features
- Technology stack badges
- Live demo and GitHub links
- Filtered project categories

### 📧 Contact (`pages/contact.html`)
- Contact form with validation
- Social media links
- Email and location information
- Interactive map (optional)

---

## 🎨 Customization

### Changing Colors

Edit the CSS variables in `css/style.css`:

```css
:root {
    --bg-dark: #0f0f16;           /* Main background */
    --bg-card: #1a1a2e;           /* Card background */
    --purple-main: #a855f7;       /* Primary purple */
    --purple-hover: #9333ea;      /* Hover purple */
    --purple-glow: rgba(168, 85, 247, 0.5);
    --text-main: #f1f5f9;         /* Main text color */
    --text-muted: #cbd5e1;        /* Muted text color */
}
```

### Updating Content

1. **Personal Information** - Edit text in HTML files
2. **Profile Image** - Replace `img/zoro.jpg` with your photo
3. **Social Links** - Update href attributes in navigation
4. **Skills & Progress** - Modify percentages and skill names
5. **Projects** - Add your own project cards

### Adding New Sections

Use the existing card/section structure:

```html
<div class="glass-panel">
    <h3>Your Section Title</h3>
    <p>Your content here...</p>
</div>
```

---

## 🌐 Browser Support

| Browser | Version |
|---------|---------|
| Chrome  | ✅ Latest |
| Firefox | ✅ Latest |
| Safari  | ✅ Latest |
| Edge    | ✅ Latest |
| Opera   | ✅ Latest |

---

## 📝 License

This project is **open source** and available for anyone to use as a template for their own portfolio.

---

## 📬 Contact

**WeXxQ** - Student Developer

- 📧 Email: [your.email@example.com](mailto:your.email@example.com)
- 💼 LinkedIn: [Your LinkedIn](https://linkedin.com/in/yourprofile)
- 🐙 GitHub: [@WeXxQ-o](https://github.com/WeXxQ-o)
- 🌐 Portfolio: [Your Website](https://wexxq-o.github.io/Portfolio)

---

<div align="center">

### ⭐ Star this repo if you found it helpful!

**Made with 💜 by WeXxQ**

![Footer](https://capsule-render.vercel.app/api?type=waving&color=a855f7&height=100&section=footer)

</div>
