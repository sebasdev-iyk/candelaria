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
      overflow-y: auto;
      background: #000;
    }


    /* Video Background with Parallax */
    .video-background {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 200vh;
      z-index: -2;
      overflow: hidden;
      will-change: transform;
    }

    .video-background video {
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: center top;
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
      /* Restamos la altura del header (banner ~24px + nav ~76px = ~100px) */
      height: calc(100vh - 100px);
      max-height: calc(100vh - 100px);
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      gap: 3vh;
      padding-top: 2vh;
      padding-bottom: 2vh;
      z-index: 1;
      box-sizing: border-box;
      overflow: hidden;
    }

    .content {
      position: relative;
      z-index: 2;
      max-width: 1200px;
      width: 100%;
      padding: 0 15px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      box-sizing: border-box;
    }

    /* Imágenes del título y subtítulo */
    .title-image,
    .subtitle-image {
      display: block;
      margin: 0 auto;
      width: auto;
      max-width: 90%;
      filter: drop-shadow(0 4px 10px rgba(0, 0, 0, 0.8));
    }

    .title-image {
      max-height: 12vh;
      margin-bottom: 1vh;
    }

    .subtitle-image {
      max-height: 15vh;
      margin-bottom: 1.5vh;
    }

    .date-info {
      font-size: clamp(0.8rem, 2vw, 1.2rem);
      color: #e2e8f0;
      margin-bottom: 1.5vh;
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
      gap: clamp(5px, 1.5vw, 15px);
      margin-top: 1vh;
      flex-wrap: wrap;
    }

    .time-box {
      display: flex;
      flex-direction: column;
      align-items: center;
      min-width: clamp(45px, 8vw, 80px);
      background: rgba(15, 23, 42, 0.7);
      backdrop-filter: blur(10px);
      border-radius: 8px;
      padding: clamp(5px, 1vh, 12px) clamp(4px, 1vw, 10px);
      border: 1px solid rgba(251, 191, 36, 0.2);
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    }

    .time-box:hover {
      border-color: rgba(251, 191, 36, 0.5);
    }

    .time-box span {
      font-size: clamp(1.2rem, 3.5vw, 2.5rem);
      font-weight: 800;
      color: #fff;
      font-variant-numeric: tabular-nums;
      line-height: 1;
    }

    .time-box p {
      font-size: clamp(0.45rem, 1vw, 0.7rem);
      color: #cbd5e1;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-top: 3px;
      font-weight: 500;
    }

    .separator {
      font-size: clamp(1.2rem, 2.5vw, 2rem);
      font-weight: 300;
      color: #fbbf24;
      margin-bottom: 15px;
    }

    .scroll-indicator {
      position: absolute;
      bottom: 40px;
      left: 50%;
      transform: translateX(-50%);
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 20px;
      cursor: pointer;
      z-index: 100;
      transition: opacity 0.3s ease;
    }

    .scroll-indicator:hover {
      opacity: 0.92;
    }

    /* Premium metallic circle */
    .scroll-circle {
      width: 72px;
      height: 72px;
      background: radial-gradient(circle at 30% 30%,
          rgba(255, 255, 255, 0.15) 0%,
          rgba(0, 0, 0, 0.3) 70%);
      border: 1.5px solid rgba(212, 175, 110, 0.45);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow:
        0 8px 30px rgba(0, 0, 0, 0.25),
        inset 0 2px 8px rgba(255, 255, 255, 0.12),
        0 0 0 1px rgba(255, 255, 255, 0.08);
      backdrop-filter: blur(4px);
      transition: all 0.45s cubic-bezier(0.16, 1, 0.3, 1);
      position: relative;
      overflow: hidden;
    }

    .scroll-circle::before {
      content: '';
      position: absolute;
      width: 100%;
      height: 100%;
      background: linear-gradient(135deg,
          rgba(230, 219, 180, 0.08) 0%,
          rgba(180, 150, 80, 0.12) 100%);
      border-radius: 50%;
    }

    .scroll-indicator:hover .scroll-circle {
      transform: translateX(-50%) scale(1.07) translateY(-3px);
      box-shadow:
        0 12px 35px rgba(0, 0, 0, 0.32),
        inset 0 3px 12px rgba(255, 255, 255, 0.18),
        0 0 0 2px rgba(212, 175, 110, 0.6);
      border-color: rgba(212, 175, 110, 0.7);
    }

    /* Minimalist text label */
    .scroll-text {
      background: rgba(15, 15, 20, 0.78);
      color: rgba(230, 219, 180, 0.92);
      padding: 8px 28px;
      border-radius: 20px;
      font-size: 14px;
      font-weight: 500;
      letter-spacing: 1.2px;
      text-transform: uppercase;
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
      box-shadow:
        0 4px 15px rgba(0, 0, 0, 0.18),
        inset 0 1px 0 rgba(255, 255, 255, 0.08);
      backdrop-filter: blur(2px);
      border: 1px solid rgba(255, 255, 255, 0.06);
      transition: all 0.35s ease;
    }

    .scroll-indicator:hover .scroll-text {
      background: rgba(10, 10, 15, 0.92);
      transform: translateY(-3px);
      box-shadow:
        0 6px 20px rgba(0, 0, 0, 0.25),
        inset 0 1px 0 rgba(255, 255, 255, 0.1);
      color: rgba(230, 219, 180, 1);
    }

    /* Elegant arrow with subtle animation */
    .scroll-arrow {
      position: relative;
      width: 28px;
      height: 28px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .scroll-arrow::before {
      content: '';
      position: absolute;
      width: 2px;
      height: 18px;
      background: linear-gradient(to bottom,
          transparent,
          rgba(230, 219, 180, 0.95));
      border-radius: 3px;
      animation: elegantBounce 2.2s infinite ease-in-out;
    }

    .scroll-arrow::after {
      content: '';
      position: absolute;
      bottom: 0;
      width: 0;
      height: 0;
      border-left: 5px solid transparent;
      border-right: 5px solid transparent;
      border-top: 6px solid rgba(230, 219, 180, 0.95);
    }

    @keyframes elegantBounce {

      0%,
      100% {
        transform: translateY(0);
        opacity: 0.7;
      }

      50% {
        transform: translateY(8px);
        opacity: 1;
      }
    }

    /* Botones de Acción (legacy) */
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
      .hero {
        /* En móvil el header ocupa más espacio (~130px con banner + nav) */
        height: calc(100vh - 130px);
        max-height: calc(100vh - 130px);
        gap: 2vh;
        padding-top: 1vh;
        padding-bottom: 1vh;
      }

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
        /* Ajustado dinámicamente con Tailwind */
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
        width: 90%;
        max-width: 350px;
        margin-bottom: 5px;
      }

      .subtitle-image {
        width: 95%;
        max-width: 380px;
        margin-bottom: 10px;
      }

      .date-info {
        font-size: 1rem;
        margin-bottom: 10px;
      }

      .countdown {
        gap: 8px;
        margin-top: 10px;
      }

      .time-box {
        min-width: 55px;
        padding: 8px 6px;
      }

      .time-box span {
        font-size: 1.6rem;
      }

      .time-box p {
        font-size: 0.55rem;
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

      /* Scroll indicator responsive - más compacto */
      .scroll-indicator {
        gap: 4px;
        padding: 6px 10px;
        border-radius: 12px;
      }

      .scroll-text {
        font-size: 0.55rem;
        letter-spacing: 0.5px;
        text-align: center;
        padding: 0 3px;
      }

      .scroll-arrow {
        width: 28px;
        height: 28px;
        border-width: 2px;
      }

      .scroll-arrow i {
        font-size: 0.8rem;
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
        width: 85%;
        max-width: 280px;
        margin-bottom: 3px;
      }

      .subtitle-image {
        width: 90%;
        max-width: 300px;
        margin-bottom: 8px;
      }

      .date-info {
        font-size: 0.85rem;
        margin-bottom: 8px;
      }

      .time-box {
        min-width: 45px;
        padding: 6px 4px;
      }

      .time-box span {
        font-size: 1.4rem;
      }

      .time-box p {
        font-size: 0.5rem;
        margin-top: 2px;
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

      /* Scroll indicator - móvil pequeño - ultra compacto */
      .scroll-indicator {
        padding: 5px 8px;
        gap: 3px;
        border-radius: 10px;
      }

      .scroll-text {
        font-size: 0.5rem;
        letter-spacing: 0.3px;
      }

      .scroll-arrow {
        width: 24px;
        height: 24px;
        border-width: 2px;
      }

      .scroll-arrow i {
        font-size: 0.7rem;
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
  <link rel="stylesheet" href="./assets/css/sparks.css">
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

  <!-- Transition Overlay (Hidden by default) -->
  <div id="page-transition" class="fixed inset-0 z-[100] pointer-events-none opacity-0 transition-opacity duration-300">
    <!-- Left Panel (Purple) -->
    <div id="trans-left"
      class="absolute inset-y-0 left-0 w-1/2 bg-candelaria-purple transform -translate-x-full transition-transform duration-700 ease-in-out z-20 flex items-center justify-end pr-10 border-r-4 border-candelaria-gold">
      <div class="bg-white/10 p-6 rounded-full blur-3xl w-64 h-64 absolute right-[-8rem]"></div>
    </div>

    <!-- Right Panel (Purple) -->
    <div id="trans-right"
      class="absolute inset-y-0 right-0 w-1/2 bg-candelaria-purple transform translate-x-full transition-transform duration-700 ease-in-out z-20 flex items-center justify-start pl-10 border-l-4 border-candelaria-gold">
      <div class="bg-white/10 p-6 rounded-full blur-3xl w-64 h-64 absolute left-[-8rem]"></div>
    </div>

    <!-- Center Image (Virgin) -->
    <div id="trans-image-container"
      class="absolute inset-0 z-30 flex items-center justify-center opacity-0 scale-90 transition-all duration-500 delay-300">
      <div class="relative">
        <div class="absolute inset-0 bg-candelaria-gold blur-[60px] opacity-50 rounded-full animate-pulse"></div>
        <img src="./principal/virgencandelariaa.png" alt="Transition"
          class="h-64 md:h-96 w-auto object-contain drop-shadow-[0_0_30px_rgba(251,191,36,0.6)] relative z-10 transform hover:scale-105 transition-transform">
        <div class="absolute -bottom-12 left-1/2 transform -translate-x-1/2 whitespace-nowrap">
          <span
            class="text-white font-bold text-2xl tracking-[0.2em] uppercase font-heading text-shadow-glow">Conectando...</span>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Transition Logic
    function playTransition(targetUrl) {
      const overlay = document.getElementById('page-transition');
      const left = document.getElementById('trans-left');
      const right = document.getElementById('trans-right');
      const img = document.getElementById('trans-image-container');

      // Show overlay wrapper
      overlay.classList.remove('opacity-0');
      overlay.classList.add('opacity-100', 'pointer-events-auto');

      // Slide animation (Close curtains)
      requestAnimationFrame(() => {
        left.classList.remove('-translate-x-full');
        right.classList.remove('translate-x-full');

        // Show Image
        setTimeout(() => {
          img.classList.remove('opacity-0', 'scale-90');
          img.classList.add('opacity-100', 'scale-100');
        }, 300);

        // Redirect
        setTimeout(() => {
          window.location.href = targetUrl;
        }, 2000); // 2 seconds to admire the animation
      });
    }

    // Attach to Live Button
    document.addEventListener('DOMContentLoaded', () => {
      const liveBtns = document.querySelectorAll('.btn-live');
      liveBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
          e.preventDefault();
          const target = btn.getAttribute('href');
          playTransition(target);
        });
      });
    });
  </script>

  <!-- Header Mejorado -->
  <!-- Header Section - Standardized with EN VIVO Style -->
  <header class="bg-candelaria-purple text-white shadow-lg sticky top-0 z-40">
    <!-- Banner superior -->
    <div class="bg-purple-950 text-xs py-1 text-center text-purple-200">
      Festividad de la Virgen de la Candelaria 2025 - Del 2 al 11 de Febrero
    </div>

    <div class="w-full px-6 md:px-12 h-20 md:h-22 flex items-center">
      <div class="w-full flex justify-between items-center h-full">
        <!-- Left: Candelaria Branding -->
        <!-- Left: Candelaria Branding -->
        <a href="index.php" id="logo-container" class="flex items-center cursor-pointer group h-full relative spark-container">
          <img src="./principal/logoc.png" alt="Candelaria"
            class="h-full w-auto object-contain transition-transform duration-300 group-hover:scale-105 relative z-10">
        </a>
        <!-- Right: Navigation + EN TIEMPO REAL -->
        <div class="flex items-center gap-6">
          <nav class="hidden md:flex items-center gap-2">
            <a href="./servicios/index.php" class="nav-link-custom">Servicios</a>
            <a href="./cultura/cultura.html" class="nav-link-custom">Cultura</a>
            <a href="./horarios_y_danzas/index.php" class="nav-link-custom">Horarios</a>
            <a href="./noticias/index.php" class="nav-link-custom">Noticias</a>
          </nav>

          <?php include 'includes/auth-header.php'; ?>
          <!-- User Auth Button -->
          <?= getAuthButtonHTML() ?>

          <!-- EN VIVO Button -->
          <a href="./live-platform/index.php" class="btn-live group">
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
          class="block text-white text-lg hover:text-candelaria-gold font-semibold border-b border-purple-800 pb-2">Horarios</a>
        <a href="./noticias/index.php"
          class="block text-white text-lg hover:text-candelaria-gold font-semibold border-b border-purple-800 pb-2">Noticias</a>
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
    </div>

    <!-- Indicador de Scroll Animado (hijo directo de hero para layout space-between) -->
    <div class="scroll-indicator"
      onclick="document.getElementById('danzas-section').scrollIntoView({behavior: 'smooth'})">
      <span class="scroll-text">Desliza para conocer el cronograma y las danzas</span>
      <div class="scroll-arrow">
        <i class="fas fa-chevron-down"></i>
      </div>
    </div>
  </section>

  <!-- ========== Sección de Danzas con Fondo Transparente ========== -->
  <section id="danzas-section" class="danzas-section">
    <div class="danzas-container">
      <div class="danzas-header">
        <h2 class="danzas-title">
          <i data-lucide="users" class="danzas-icon"></i>
          Danzas de la Festividad
        </h2>
        <p class="danzas-subtitle">Conoce las danzas que dan vida a la celebración más grande del Perú</p>
      </div>

      <div id="danzas-grid" class="danzas-grid">
        <!-- Loading skeleton -->
        <div class="danza-card loading-skeleton">
          <div class="skeleton-image"></div>
          <div class="skeleton-content">
            <div class="skeleton-line short"></div>
            <div class="skeleton-line"></div>
            <div class="skeleton-line medium"></div>
          </div>
        </div>
        <div class="danza-card loading-skeleton">
          <div class="skeleton-image"></div>
          <div class="skeleton-content">
            <div class="skeleton-line short"></div>
            <div class="skeleton-line"></div>
            <div class="skeleton-line medium"></div>
          </div>
        </div>
        <div class="danza-card loading-skeleton">
          <div class="skeleton-image"></div>
          <div class="skeleton-content">
            <div class="skeleton-line short"></div>
            <div class="skeleton-line"></div>
            <div class="skeleton-line medium"></div>
          </div>
        </div>
      </div>

      <div class="danzas-cta">
        <a href="./horarios_y_danzas/index.php#danzas" class="btn-ver-danzas">
          <span>Ver todas las danzas</span>
          <i data-lucide="arrow-right" class="cta-arrow"></i>
        </a>
      </div>
    </div>
  </section>

  <style>
    /* ========== Sección de Danzas con Fondo Transparente ========== */
    .danzas-section {
      position: relative;
      min-height: 100vh;
      padding: 100px 20px 80px;
      background: linear-gradient(to bottom,
          rgba(0, 0, 0, 0.2) 0%,
          rgba(76, 29, 149, 0.4) 50%,
          rgba(0, 0, 0, 0.5) 100%);
      backdrop-filter: blur(3px);
      z-index: 1;
    }

    .danzas-container {
      max-width: 1400px;
      margin: 0 auto;
    }

    .danzas-header {
      text-align: center;
      margin-bottom: 50px;
    }

    .danzas-title {
      font-size: 2.5rem;
      font-weight: 800;
      color: white;
      margin-bottom: 15px;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 15px;
      text-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
    }

    .danzas-icon {
      width: 40px;
      height: 40px;
      color: #fbbf24;
    }

    .danzas-subtitle {
      font-size: 1.2rem;
      color: rgba(255, 255, 255, 0.8);
      font-weight: 400;
      text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    }

    .danzas-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
      gap: 25px;
      margin-bottom: 40px;
    }

    @media (min-width: 768px) {
      .danzas-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (min-width: 1024px) {
      .danzas-grid {
        grid-template-columns: repeat(3, 1fr);
      }
    }

    /* ========== Card Glassmorphism Style ========== */
    .danza-card {
      background: rgba(255, 255, 255, 0.12);
      backdrop-filter: blur(15px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 1.2rem;
      overflow: hidden;
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
    }

    .danza-card:hover {
      transform: translateY(-8px) scale(1.02);
      box-shadow: 0 25px 50px rgba(0, 0, 0, 0.35);
      border-color: rgba(251, 191, 36, 0.5);
      background: rgba(255, 255, 255, 0.18);
    }

    .danza-card .card-image-container {
      position: relative;
      height: 200px;
      overflow: hidden;
    }

    .danza-card .card-image {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.5s ease;
    }

    .danza-card:hover .card-image {
      transform: scale(1.1);
    }

    .danza-card .card-image-overlay {
      position: absolute;
      inset: 0;
      background: linear-gradient(to top, rgba(0, 0, 0, 0.6) 0%, transparent 50%);
    }

    .danza-card .card-category {
      position: absolute;
      top: 12px;
      left: 12px;
      background: rgba(76, 29, 149, 0.9);
      backdrop-filter: blur(5px);
      color: white;
      padding: 6px 14px;
      border-radius: 20px;
      font-size: 0.7rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      border: 1px solid rgba(251, 191, 36, 0.3);
    }

    .danza-card .card-content {
      padding: 20px;
    }

    .danza-card .card-title {
      color: white;
      font-size: 1.15rem;
      font-weight: 700;
      margin-bottom: 10px;
      line-height: 1.4;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
      text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    }

    .danza-card .card-order {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: linear-gradient(135deg, #fbbf24, #f59e0b);
      color: #4c1d95;
      padding: 5px 12px;
      border-radius: 20px;
      font-size: 0.75rem;
      font-weight: 800;
    }

    .danza-card .card-btn {
      width: 100%;
      margin-top: 15px;
      padding: 12px;
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.3);
      border-radius: 10px;
      color: white;
      font-weight: 600;
      font-size: 0.9rem;
      cursor: pointer;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
    }

    .danza-card .card-btn:hover {
      background: linear-gradient(135deg, #fbbf24, #f59e0b);
      color: #4c1d95;
      border-color: transparent;
      transform: translateY(-2px);
    }

    /* ========== Loading Skeleton ========== */
    .loading-skeleton .skeleton-image {
      height: 200px;
      background: linear-gradient(90deg, rgba(255, 255, 255, 0.1) 25%, rgba(255, 255, 255, 0.2) 50%, rgba(255, 255, 255, 0.1) 75%);
      background-size: 200% 100%;
      animation: shimmer 1.5s infinite;
    }

    .loading-skeleton .skeleton-content {
      padding: 20px;
    }

    .loading-skeleton .skeleton-line {
      height: 16px;
      background: linear-gradient(90deg, rgba(255, 255, 255, 0.1) 25%, rgba(255, 255, 255, 0.2) 50%, rgba(255, 255, 255, 0.1) 75%);
      background-size: 200% 100%;
      animation: shimmer 1.5s infinite;
      border-radius: 8px;
      margin-bottom: 12px;
    }

    .loading-skeleton .skeleton-line.short {
      width: 40%;
    }

    .loading-skeleton .skeleton-line.medium {
      width: 60%;
    }

    @keyframes shimmer {
      0% {
        background-position: 200% 0;
      }

      100% {
        background-position: -200% 0;
      }
    }

    /* ========== CTA Button ========== */
    .danzas-cta {
      text-align: center;
    }

    .btn-ver-danzas {
      display: inline-flex;
      align-items: center;
      gap: 12px;
      padding: 16px 40px;
      background: linear-gradient(135deg, #fbbf24, #f59e0b);
      color: #4c1d95;
      font-size: 1.1rem;
      font-weight: 700;
      text-decoration: none;
      border-radius: 50px;
      transition: all 0.3s ease;
      box-shadow: 0 8px 30px rgba(251, 191, 36, 0.35);
    }

    .btn-ver-danzas:hover {
      transform: translateY(-4px);
      box-shadow: 0 12px 40px rgba(251, 191, 36, 0.5);
      background: linear-gradient(135deg, #f59e0b, #d97706);
    }

    .btn-ver-danzas .cta-arrow {
      width: 20px;
      height: 20px;
      transition: transform 0.3s ease;
    }

    .btn-ver-danzas:hover .cta-arrow {
      transform: translateX(5px);
    }

    /* ========== Responsive ========== */
    @media (max-width: 768px) {
      .danzas-section {
        padding: 60px 15px;
      }

      .danzas-title {
        font-size: 1.8rem;
      }

      .danzas-subtitle {
        font-size: 1rem;
      }

      .danzas-grid {
        grid-template-columns: 1fr;
        gap: 20px;
      }

      .btn-ver-danzas {
        padding: 14px 30px;
        font-size: 1rem;
      }
    }

    @media (max-width: 480px) {
      .danzas-title {
        font-size: 1.5rem;
        flex-direction: column;
        gap: 10px;
      }

      .danzas-icon {
        width: 32px;
        height: 32px;
      }
    }
  </style>


  <script>
    // Efecto de parallax en el video de fondo y hero al hacer scroll
    window.addEventListener('scroll', function () {
      const scrollY = window.scrollY;

      // Parallax effect on video background - moves up as you scroll down
      const videoBackground = document.querySelector('.video-background');
      if (videoBackground) {
        // Move video up at 50% of scroll speed to reveal more of the Virgin
        videoBackground.style.transform = `translateY(-${scrollY * 0.5}px)`;
      }

      // Efecto adicional en navbar
      const navbar = document.getElementById('navbar');
      if (navbar) {
        if (scrollY > 50) {
          navbar.classList.add('scrolled');
        } else {
          navbar.classList.remove('scrolled');
        }
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
  <script>
    // Script.js logic is already inline or handled
  </script>

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

    // ========== Cargar Danzas desde API ==========
    async function loadDanzas() {
      const danzasGrid = document.getElementById('danzas-grid');
      if (!danzasGrid) return;

      try {
        const response = await fetch('./api/danzas.php');
        if (!response.ok) throw new Error(`Error HTTP: ${response.status}`);

        const result = await response.json();
        const danzas = Array.isArray(result) ? result : result.data || [];

        if (danzas.length === 0) {
          danzasGrid.innerHTML = `
            <div class="danza-card" style="grid-column: 1 / -1; text-align: center; padding: 40px;">
              <p style="color: rgba(255,255,255,0.7);">No se encontraron danzas disponibles</p>
            </div>
          `;
          return;
        }

        // Shuffle and take first 6 for homepage display
        const shuffled = danzas.sort(() => Math.random() - 0.5);
        const displayDanzas = shuffled.slice(0, 6);

        // Render cards
        danzasGrid.innerHTML = displayDanzas.map(danza => {
          const categoria = danza.categoria || 'TRADICIONAL';
          const imageUrl = danza.foto || `https://placehold.co/400x300/4c1d95/fbbf24?text=${encodeURIComponent(danza.conjunto || 'Danza')}`;

          return `
            <div class="danza-card">
              <div class="card-image-container">
                <img class="card-image" 
                     src="${imageUrl}" 
                     alt="${danza.conjunto}"
                     onerror="this.onerror=null; this.src='https://placehold.co/400x300/4c1d95/fbbf24?text=Danza';">
                <div class="card-image-overlay"></div>
                <span class="card-category">${categoria}</span>
              </div>
              <div class="card-content">
                <h3 class="card-title">${danza.conjunto}</h3>
                ${danza.orden_concurso ? `<span class="card-order">#${danza.orden_concurso} Concurso</span>` : ''}
                <a href="./horarios_y_danzas/index.php#danzas" class="card-btn">
                  Ver más
                  <i data-lucide="arrow-right" style="width: 16px; height: 16px;"></i>
                </a>
              </div>
            </div>
          `;
        }).join('');

        // Re-initialize Lucide icons for the new cards
        lucide.createIcons();

      } catch (error) {
        console.error('Error loading danzas:', error);
        danzasGrid.innerHTML = `
          <div class="danza-card" style="grid-column: 1 / -1; text-align: center; padding: 40px;">
            <p style="color: rgba(255,255,255,0.7);">Error al cargar las danzas</p>
          </div>
        `;
      }
    }

    // Load danzas when DOM is ready
    document.addEventListener('DOMContentLoaded', loadDanzas);
  </script>
  <!-- Chatbot Widget -->
  <link rel="stylesheet" href="assets/css/chatbot-widget.css">
  <div id="chatbot-widget"></div>
  <script src="assets/js/chatbot-widget.js"></script>

  <!-- Auth Modal and Dropdown -->
  <?= getAuthModalHTML() ?>
  <?= getAuthJS('') ?>
  <!-- Spark Effect Script -->
  <script src="./assets/js/spark-effect.js"></script>
</body>

</html>