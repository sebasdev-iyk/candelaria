<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Festividad de la Candelaria 2026 - Puno</title>
  <link rel="stylesheet" href="./styles.css" />
  <!-- Fuentes de Google -->
  <link
    href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600&display=swap"
    rel="stylesheet">
  <!-- Iconos -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Lucide Icons -->
  <script src="https://unpkg.com/lucide@latest"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            candelaria: {
              purple: '#4c1d95',
              gold: '#fbbf24',
              lake: '#0ea5e9',
              light: '#f5f3ff'
            }
          },
          fontFamily: {
            sans: ['Open Sans', 'sans-serif'],
            heading: ['Montserrat', 'sans-serif'],
          }
        }
      }
    }
  </script>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Montserrat', sans-serif;
      color: white;
      height: 100vh;
      overflow-x: hidden;
      background: #000;
    }

    /* Video Background */
    .video-background {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -2;
      overflow: hidden;
    }

    .video-background video {
      min-width: 100%;
      min-height: 100%;
      object-fit: cover;
      filter: brightness(0.7);
    }

    .video-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(45deg, rgba(76, 29, 149, 0.4), rgba(0, 0, 0, 0.7));
      z-index: -1;
    }





    /* Navegación Principal */


    /* Botón EN VIVO con animación */
    .btn-live {
      position: relative;
      background: linear-gradient(135deg, #dc2626, #b91c1c);
      color: white;
      padding: 10px 24px;
      border-radius: 30px;
      font-weight: 700;
      font-size: 0.9rem;
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: 10px;
      box-shadow: 0 4px 15px rgba(220, 38, 38, 0.4);
      overflow: hidden;
      animation: pulseLive 2s infinite;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    .btn-live::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.25), transparent);
      transition: left 0.6s;
    }

    .btn-live:hover::before {
      left: 100%;
    }

    .btn-live:hover {
      transform: scale(1.05);
      box-shadow: 0 6px 25px rgba(220, 38, 38, 0.6);
    }

    .live-dot {
      width: 10px;
      height: 10px;
      background: white;
      border-radius: 50%;
      animation: blink 1s infinite;
    }

    @keyframes blink {

      0%,
      100% {
        opacity: 1;
      }

      50% {
        opacity: 0.3;
      }
    }

    @keyframes pulseLive {

      0%,
      100% {
        box-shadow: 0 4px 15px rgba(220, 38, 38, 0.4);
      }

      50% {
        box-shadow: 0 4px 25px rgba(220, 38, 38, 0.7), 0 0 30px rgba(220, 38, 38, 0.4);
      }
    }

    /* ========== Navigation Link Styles ========== */
    .nav-link-custom {
      color: #e9d5ff;
      text-decoration: none;
      font-weight: 600;
      font-size: 0.9rem;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      padding: 8px 16px;
      position: relative;
      transition: color 0.3s ease;
    }

    .nav-link-custom:hover {
      color: #fbbf24;
    }

    .nav-link-custom::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 0;
      height: 2px;
      background: #fbbf24;
      transition: width 0.3s ease;
    }

    .nav-link-custom:hover::after {
      width: 80%;
    }

    .nav-link-custom.active {
      color: #fbbf24;
    }

    .nav-link-custom.active::after {
      width: 80%;
    }

    /* Botón Perfil */
    .btn-profile {
      width: 42px;
      height: 42px;
      border-radius: 50%;
      background: linear-gradient(135deg, #475569, #1e293b);
      display: flex;
      align-items: center;
      justify-content: center;
      color: #fbbf24;
      font-size: 1.2rem;
      border: 2px solid rgba(251, 191, 36, 0.3);
      transition: all 0.3s ease;
    }

    .btn-profile:hover {
      transform: scale(1.1);
      border-color: #fbbf24;
      box-shadow: 0 0 15px rgba(251, 191, 36, 0.3);
    }

    /* Contenido Principal */
    .hero {
      position: relative;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
      padding-top: 100px;
      background-attachment: fixed;
      transition: background-position 0.1s ease;
    }

    .content {
      position: relative;
      z-index: 2;
      max-width: 1200px;
      padding: 0 20px;
    }

    /* Imágenes del título y subtítulo - AHORA MÁS GRANDES */
    .title-image,
    .subtitle-image {
      display: block;
      margin: 0 auto;
      height: auto;
      max-width: 100%;
      filter: drop-shadow(0 4px 10px rgba(0, 0, 0, 0.8));
    }

    .title-image {
      width: 60%;
      max-width: 900px;
      margin-bottom: 15px;
    }

    .subtitle-image {
      width: 590%;
      max-width: 999px;
      margin-bottom: 25px;
    }

    .date-info {
      font-size: 1.5rem;
      color: #e2e8f0;
      margin-bottom: 40px;
      font-weight: 300;
      letter-spacing: 1px;
    }

    .date-info span {
      color: #fbbf24;
      font-weight: 600;
    }

    /* Countdown Mejorado */
    .countdown {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 20px;
      margin-top: 50px;
      flex-wrap: wrap;
      min-height: 120px;
    }

    .time-box {
      display: flex;
      flex-direction: column;
      align-items: center;
      min-width: 110px;
      background: rgba(15, 23, 42, 0.7);
      backdrop-filter: blur(10px);
      border-radius: 15px;
      padding: 20px 15px;
      border: 1px solid rgba(251, 191, 36, 0.2);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
      transition: transform 0.3s ease;
    }

    .time-box:hover {
      transform: translateY(-5px);
      border-color: rgba(251, 191, 36, 0.5);
    }

    .time-box span {
      font-size: 3.5rem;
      font-weight: 800;
      color: #fff;
      font-variant-numeric: tabular-nums;
      line-height: 1;
    }

    .time-box p {
      font-size: 0.9rem;
      color: #cbd5e1;
      text-transform: uppercase;
      letter-spacing: 1px;
      margin-top: 8px;
      font-weight: 500;
    }

    .separator {
      font-size: 2.5rem;
      font-weight: 300;
      color: #fbbf24;
      margin-bottom: 30px;
    }

    /* Botones de Acción */
    .button-container {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 25px;
      margin-top: 50px;
      flex-wrap: wrap;
    }

    .btn-primary {
      background: linear-gradient(135deg, #4c1d95, #7c3aed);
      color: white;
      font-weight: 700;
      font-size: 1.1rem;
      padding: 15px 35px;
      border: none;
      border-radius: 50px;
      cursor: pointer;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      gap: 10px;
      box-shadow: 0 6px 20px rgba(76, 29, 149, 0.4);
    }

    .btn-primary:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 25px rgba(76, 29, 149, 0.6);
      background: linear-gradient(135deg, #5b21b6, #8b5cf6);
    }

    .btn-secondary {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
      color: white;
      padding: 15px 35px;
      text-decoration: none;
      border-radius: 50px;
      font-weight: 700;
      font-size: 1.1rem;
      transition: all 0.3s ease;
      border: 1px solid rgba(255, 255, 255, 0.2);
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .btn-secondary:hover {
      background: rgba(255, 255, 255, 0.2);
      transform: translateY(-3px);
      border-color: rgba(251, 191, 36, 0.5);
    }

    /* Scroll Indicator */
    .scroll-indicator {
      position: absolute;
      bottom: 40px;
      left: 50%;
      transform: translateX(-50%);
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 10px;
      z-index: 10;
      animation: bounce 2s infinite;
    }

    .scroll-text {
      font-size: 0.9rem;
      color: #cbd5e1;
      letter-spacing: 1px;
    }

    .scroll-line {
      width: 2px;
      height: 50px;
      background: linear-gradient(to bottom, transparent, #fbbf24, transparent);
    }

    @keyframes bounce {

      0%,
      100% {
        transform: translateX(-50%) translateY(0);
      }

      50% {
        transform: translateX(-50%) translateY(10px);
      }
    }

    /* Responsive para las imágenes */
    @media (max-width: 1200px) {
      .title-image {
        width: 98%;
        max-width: 800px;
      }

      .subtitle-image {
        width: 95%;
        max-width: 700px;
      }
    }

    @media (max-width: 992px) {
      .navbar {
        padding: 15px 25px 15px 135px;
      }

      /* 40 + 55 + 40 */
      .nav-main {
        gap: 20px;
      }

      .header-buttons {
        gap: 15px;
      }

      .title-image {
        width: 100%;
        max-width: 700px;
      }

      .subtitle-image {
        width: 95%;
        max-width: 600px;
      }

      .time-box {
        min-width: 90px;
      }

      .time-box span {
        font-size: 2.8rem;
      }

      .logo-image {
        width: 55px;
        height: 55px;
      }

      /* Logo más pequeño */
    }

    @media (max-width: 768px) {
      .navbar {
        flex-direction: column;
        gap: 15px;
        padding: 15px 15px 15px 90px;
        /* 20 + 50 + 20 */
      }

      .logo-container {
        left: 20px;
        /* Más cerca del borde */
      }

      .logo-image {
        width: 50px;
        height: 50px;
      }

      .nav-main {
        flex-wrap: wrap;
        justify-content: center;
        gap: 15px;
        order: 3;
        width: 100%;
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
      }

      .header-buttons {
        order: 2;
        width: 100%;
        justify-content: center;
      }

      .logo-container {
        position: absolute;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
      }

      .title-image {
        width: 100%;
        max-width: 500px;
      }

      .subtitle-image {
        width: 100%;
        max-width: 450px;
      }

      .date-info {
        font-size: 1.2rem;
      }

      .countdown {
        gap: 10px;
      }

      .time-box {
        min-width: 70px;
        padding: 15px 10px;
      }

      .time-box span {
        font-size: 2.2rem;
      }

      .time-box p {
        font-size: 0.8rem;
      }

      .separator {
        font-size: 1.8rem;
        margin-bottom: 20px;
      }

      .button-container {
        gap: 15px;
      }

      .btn-primary,
      .btn-secondary {
        padding: 12px 25px;
        font-size: 1rem;
      }
    }

    @media (max-width: 480px) {
      .navbar {
        padding-left: 80px;
      }

      /* 15 + 45 + 20 */
      .logo-container {
        left: 15px;
      }

      .logo-image {
        width: 45px;
        height: 45px;
      }

      .title-image {
        width: 100%;
        max-width: 400px;
      }

      .subtitle-image {
        width: 100%;
        max-width: 350px;
      }

      .date-info {
        font-size: 1rem;
      }

      .time-box {
        min-width: 65px;
      }

      .time-box span {
        font-size: 1.8rem;
      }

      .time-box p {
        font-size: 0.7rem;
      }

      .button-container {
        flex-direction: column;
      }

      .btn-primary,
      .btn-secondary {
        width: 100%;
        max-width: 280px;
        justify-content: center;
      }

      /* Ajuste para que el contador se muestre en dos filas en móviles */
      .countdown {
        flex-direction: column;
        gap: 5px;
      }

      .countdown-row {
        display: flex;
        gap: 10px;
        width: 100%;
        justify-content: center;
      }

      .time-box {
        min-width: 60px;
        padding: 10px 5px;
      }

      .time-box span {
        font-size: 1.6rem;
      }

      .separator {
        display: none;
      }
    }

    /* Menú Mobile */
    .mobile-menu-btn {
      display: none;
      background: none;
      border: none;
      color: white;
      font-size: 1.5rem;
      cursor: pointer;
    }

    @media (max-width: 768px) {
      .mobile-menu-btn {
        display: block;
        position: absolute;
        right: 20px;
        top: 20px;
      }

      .nav-main,
      .header-buttons {
        display: none;
        flex-direction: column;
        width: 100%;
      }

      .nav-main.active,
      .header-buttons.active {
        display: flex;
      }

      .navbar {
        padding-bottom: 20px;
      }
    }
  </style>
</head>

<body>
  <!-- Video Background -->
  <div class="video-background">
    <video autoplay muted loop playsinline>
      <source src="./principal/candelaria-backgroundOFF.mp4" type="video/mp4">
      <!-- Video de respaldo si el principal no carga -->
      <source src="https://assets.mixkit.co/videos/preview/mixkit-fireworks-over-a-lake-at-night-41356-large.mp4"
        type="video/mp4">
      Tu navegador no soporta videos HTML5.
    </video>
    <div class="video-overlay"></div>
  </div>

  <!-- Header Mejorado -->
  <!-- Header Section - Standardized with EN VIVO Style -->
  <header class="bg-candelaria-purple text-white shadow-lg sticky top-0 z-40">
    <!-- Banner superior -->
    <div class="bg-purple-950 text-xs py-1 text-center text-purple-200">
      Festividad de la Virgen de la Candelaria 2025 - Del 2 al 11 de Febrero
    </div>

    <div class="w-full px-6 md:px-12 py-5">
      <div class="flex justify-between items-center">
        <!-- Left: Candelaria Branding -->
        <a href="index.php" class="flex items-center cursor-pointer group">
          <img src="./principal/virgencandelariaa.png" alt="Candelaria"
            class="h-10 md:h-12 w-auto object-contain transition-transform duration-300 group-hover:scale-105">
        </a>
        <!-- Right: Navigation + EN TIEMPO REAL -->
        <div class="flex items-center gap-6">
          <nav class="hidden md:flex items-center gap-2">
            <a href="./servicios/index.php" class="nav-link-custom">Servicios</a>
            <a href="./cultura/cultura.html" class="nav-link-custom">Cultura</a>
            <a href="./horarios_y_danzas/index.php" class="nav-link-custom">Horarios y Danzas</a>
          </nav>

          <!-- EN VIVO Button -->
          <a href="./horarios_y_danzas/index.php" class="btn-live group">
            <div class="live-dot"></div>
            <span class="tracking-wider">EN TIEMPO REAL</span>
          </a>

          <!-- Mobile Menu Button -->
          <button id="mobile-menu-btn" class="md:hidden text-white hover:text-candelaria-gold transition-colors">
            <i data-lucide="menu" class="w-8 h-8"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Mobile Menu (Hidden by default) -->
    <div id="mobile-menu"
      class="hidden md:hidden bg-candelaria-purple absolute top-full left-0 w-full shadow-lg border-t border-purple-800 z-30 transition-all duration-300">
      <nav class="flex flex-col p-6 space-y-4">
        <a href="./servicios/index.php"
          class="block text-white text-lg hover:text-candelaria-gold font-semibold border-b border-purple-800 pb-2">Servicios</a>
        <a href="./cultura/cultura.html"
          class="block text-white text-lg hover:text-candelaria-gold font-semibold border-b border-purple-800 pb-2">Cultura</a>
        <a href="./horarios_y_danzas/index.php"
          class="block text-white text-lg hover:text-candelaria-gold font-semibold border-b border-purple-800 pb-2">Horarios
          y Danzas</a>
      </nav>
    </div>
    </div>
    </div>
    </div>
  </header>


  <!-- Contenido Principal -->
  <section class="hero">
    <div class="content">
      <!-- Imágenes reemplazando los textos originales - AHORA MÁS GRANDES -->
      <img src="./principal/Festividad.png" alt="Festividad" class="title-image">
      <img src="./principal/virgencandelariaa.png" alt="Virgen de la Candelaria" class="subtitle-image">

      <div class="date-info">Del <span>2 al 12 de Febrero</span> | Puno, Perú</div>

      <!-- Countdown -->
      <div class="countdown" id="countdown">
        <!-- Se llenará con JavaScript -->
      </div>

      <!-- Botones de Acción -->
      <div class="button-container">
        <button class="btn-primary" onclick="scrollToSection()">
          <i class="fas fa-info-circle"></i>
          Conocer más sobre la festividad
        </button>
        <a href="#" onclick="alert('Pronto disponible')" class="btn-secondary">
          <i class="fas fa-ticket-alt"></i>
          Comprar Entradas
        </a>
      </div>
    </div>



    <script>
      // Efecto de parallax en el hero al hacer scroll
      window.addEventListener('scroll', function () {
        const hero = document.querySelector('.hero');
        const scrollY = window.scrollY;

        hero.style.backgroundPositionY = `${scrollY * 0.5}px`;

        // Efecto adicional en navbar
        const navbar = document.getElementById('navbar');
        if (window.scrollY > 50) {
          navbar.classList.add('scrolled');
        } else {
          navbar.classList.remove('scrolled');
        }
      });



      // Nuevo contador con meses y actualización de fecha a 2026
      const eventDate = new Date("February 2, 2026 00:00:00").getTime();
      const countdownElement = document.getElementById('countdown');

      function updateCountdown() {
        const now = new Date().getTime();
        const distance = eventDate - now;

        if (distance < 0) {
          countdownElement.innerHTML = `
          <div class="time-box" style="min-width: 300px;">
            <span>¡HA COMENZADO!</span>
            <p>La festividad está en curso</p>
          </div>
        `;
          return;
        }

        const totalDays = Math.floor(distance / (1000 * 60 * 60 * 24));

        const avgDaysInMonth = 365.25 / 12;

        const months = Math.floor(totalDays / avgDaysInMonth);

        const days = Math.floor(totalDays % avgDaysInMonth);

        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        const pad = (n) => String(Math.floor(n)).padStart(2, "0");

        // Diferente estructura para móviles
        if (window.innerWidth <= 480) {
          countdownElement.innerHTML = `
          <div class="countdown-row">
            <div class="time-box">
              <span>${pad(months)}</span>
              <p>meses</p>
            </div>
            <div class="time-box">
              <span>${pad(days)}</span>
              <p>días</p>
            </div>
            <div class="time-box">
              <span>${pad(hours)}</span>
              <p>horas</p>
            </div>
          </div>
          <div class="countdown-row">
            <div class="time-box">
              <span>${pad(minutes)}</span>
              <p>min.</p>
            </div>
            <div class="time-box">
              <span>${pad(seconds)}</span>
              <p>seg.</p>
            </div>
          </div>
        `;
        } else {
          countdownElement.innerHTML = `
          <div class="time-box">
            <span>${pad(months)}</span>
            <p>meses</p>
          </div>
          <div class="separator">:</div>
          <div class="time-box">
            <span>${pad(days)}</span>
            <p>días</p>
          </div>
          <div class="separator">:</div>
          <div class="time-box">
            <span>${pad(hours)}</span>
            <p>horas</p>
          </div>
          <div class="separator">:</div>
          <div class="time-box">
            <span>${pad(minutes)}</span>
            <p>minutos</p>
          </div>
          <div class="separator">:</div>
          <div class="time-box">
            <span>${pad(seconds)}</span>
            <p>segundos</p>
          </div>
        `;
        }
      }

      // Actualizar cada segundo
      setInterval(updateCountdown, 1000);
      updateCountdown(); // Llamar inmediatamente

      // Función para scroll suave
      function scrollToSection() {
        window.scrollTo({
          top: window.innerHeight,
          behavior: 'smooth'
        });
      }

      // Efecto de partículas sutiles
      function createParticles() {
        const particlesContainer = document.createElement('div');
        particlesContainer.style.position = 'fixed';
        particlesContainer.style.top = '0';
        particlesContainer.style.left = '0';
        particlesContainer.style.width = '100%';
        particlesContainer.style.height = '100%';
        particlesContainer.style.pointerEvents = 'none';
        particlesContainer.style.zIndex = '1';
        document.body.appendChild(particlesContainer);

        for (let i = 0; i < 30; i++) {
          const particle = document.createElement('div');
          particle.style.position = 'absolute';
          particle.style.width = Math.random() * 3 + 1 + 'px';
          particle.style.height = particle.style.width;
          particle.style.background = 'rgba(251, 191, 36, 0.5)';
          particle.style.borderRadius = '50%';
          particle.style.left = Math.random() * 100 + 'vw';
          particle.style.top = Math.random() * 100 + 'vh';
          particle.style.boxShadow = '0 0 10px rgba(251, 191, 36, 0.5)';

          particle.animate([
            { transform: 'translateY(0px)', opacity: 0 },
            { transform: `translateY(${-Math.random() * 100 - 50}px)`, opacity: 0.7 },
            { transform: `translateY(${-Math.random() * 200 - 100}px)`, opacity: 0 }
          ], {
            duration: Math.random() * 3000 + 2000,
            iterations: Infinity,
            delay: Math.random() * 5000
          });

          particlesContainer.appendChild(particle);
        }
      }

      // Iniciar partículas
      window.addEventListener('load', createParticles);

      // Preload del video
      window.addEventListener('load', function () {
        const video = document.querySelector('video');
        if (video) {
          video.play().catch(e => console.log("Autoplay prevented:", e));
        }
      });
    </script>
    <script src="./script.js"></script>

    <!-- Chatbot Widget -->
    <link rel="stylesheet" href="assets/css/chatbot-widget.css">
    <div id="chatbot-widget"></div>
    <script src="assets/js/chatbot-widget.js"></script>
    <script>
      // Initialize Lucide icons
      lucide.createIcons();

      // Mobile Menu Logic
      const mobileMenuBtn = document.getElementById('mobile-menu-btn');
      const mobileMenu = document.getElementById('mobile-menu');

      if (mobileMenuBtn && mobileMenu) {
        mobileMenuBtn.addEventListener('click', () => {
          mobileMenu.classList.toggle('hidden');
        });
      }
    </script>
</body>

</html>