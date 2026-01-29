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
  <!-- jsPDF & AutoTable -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.29/jspdf.plugin.autotable.min.js"></script>

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
      padding-bottom: 15vh;
      /* Increased to prevent overlap with scroll indicator */
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

    /* Info Cards Styles */
    .info-cards-container {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 0;
      margin: 4vh auto 0;
      width: 100%;
      max-width: 600px;
      /* Limit width for better aesthetics */
    }

    .info-card {
      position: relative;
      width: 100%;
      height: 40px;
      /* Reducing height to make it flatter */
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      text-decoration: none;
      border: 1px solid rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
      box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.3);
      transition: all 0.3s ease;
      z-index: 1;
    }

    /* Grid Layout Specifics */

    /* Card 1: Gold - Spans full top */
    .info-card:nth-child(1) {
      grid-column: 1 / -1;
      border-radius: 30px 30px 0 0;
      z-index: 2;
      /* Ensure border overlap looks right */
    }

    /* Card 2: Purple - Bottom Left */
    .info-card:nth-child(2) {
      border-radius: 0 0 0 30px;
      margin-top: -1px;
      /* Overlap with top card */
    }

    /* Card 3: Dark - Bottom Right */
    .info-card:nth-child(3) {
      border-radius: 0 0 30px 0;
      margin-top: -1px;
      /* Overlap with top card */
      margin-left: -1px;
      /* Overlap with left card */
    }

    .info-card:hover {
      transform: translateY(-5px) scale(1.02);
      box-shadow: 0 20px 40px -5px rgba(0, 0, 0, 0.4);
    }

    .card-text {
      position: relative;
      z-index: 2;
      color: white;
      font-weight: 700;
      text-transform: uppercase;
      font-size: 0.9rem;
      line-height: 1.2;
      letter-spacing: 0.5px;
      text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
    }

    .card-glow {
      position: absolute;
      inset: 0;
      opacity: 0.6;
      transition: opacity 0.3s ease;
      z-index: 1;
    }

    .info-card:hover .card-glow {
      opacity: 0.8;
    }

    /* Card Themes */
    .card-gold {
      background: linear-gradient(135deg, rgba(251, 191, 36, 0.2), rgba(245, 158, 11, 0.3));
      border-color: rgba(251, 191, 36, 0.4);
    }

    .card-gold .card-glow {
      background: radial-gradient(circle at center, rgba(251, 191, 36, 0.4) 0%, transparent 70%);
    }

    .card-purple {
      background: linear-gradient(135deg, rgba(124, 58, 237, 0.2), rgba(109, 40, 217, 0.3));
      border-color: rgba(139, 92, 246, 0.4);
    }

    .card-purple .card-glow {
      background: radial-gradient(circle at center, rgba(139, 92, 246, 0.4) 0%, transparent 70%);
    }

    .card-dark {
      background: linear-gradient(135deg, rgba(76, 29, 149, 0.3), rgba(67, 56, 202, 0.4));
      border-color: rgba(99, 102, 241, 0.4);
    }

    .card-dark .card-glow {
      background: radial-gradient(circle at center, rgba(99, 102, 241, 0.4) 0%, transparent 70%);
    }

    /* Responsive adjustments for info cards */
    @media (max-width: 768px) {
      .info-cards-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 2vh;
        width: 90%;
        max-width: 400px;
      }

      .info-card {
        width: 100%;
        height: 40px;
        margin: 0;
        margin-top: -1px;
      }

      .info-card:nth-child(1) {
        border-radius: 30px 30px 0 0;
      }

      /* Reset grid specific radius for mobile stack */
      .info-card:nth-child(2) {
        border-radius: 0;
      }

      .info-card:nth-child(3) {
        margin-left: 0;
        border-radius: 0 0 30px 30px;
      }

      /* Cleaned up redundant styles */
    }

    @media (max-width: 480px) {
      .info-cards-container {
        flex-direction: column;
        align-items: center;
        gap: 12px;
      }

      .info-card {
        width: 100%;
        max-width: 280px;
        height: 60px;
      }

      .card-text {
        font-size: 0.9rem;
        flex-direction: row;
      }

      .card-text br {
        display: none;
      }

      .card-text::after {
        content: " ";
      }


      /* Scroll Indicator - Pill Style */
    }

    .scroll-indicator {
      position: absolute;
      bottom: 30px;
      left: 50%;
      transform: translateX(-50%);
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 15px;
      cursor: pointer;
      z-index: 100;
      transition: opacity 0.3s ease;
    }

    .scroll-indicator:hover {
      opacity: 0.9;
    }

    /* Pill Text Container - Restored Pill Style */
    .scroll-text {
      background: rgba(15, 23, 42, 0.85);
      /* Dark background */
      color: #f8fafc;
      /* White text */
      padding: 12px 30px;
      border-radius: 50px;
      font-size: 0.85rem;
      font-weight: 600;
      letter-spacing: 1.5px;
      text-transform: uppercase;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
      backdrop-filter: blur(5px);
      border: 1px solid rgba(255, 255, 255, 0.1);
      white-space: nowrap;
      text-shadow: none;
      /* Pill has background, no heavy shadow needed */
    }

    .scroll-indicator:hover .scroll-text {
      background: rgba(15, 23, 42, 0.95);
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.4);
      color: #fbbf24;
    }

    /* Simple Arrow Below */
    .scroll-arrow {
      position: relative;
      width: 30px;
      height: 30px;
      margin-top: 5px;
      display: flex;
      justify-content: center;
      /* No animation on container, animations are on children */
    }

    .main-arrow {
      position: relative;
      z-index: 2;
      color: white;
      font-size: 1.5rem;
      animation: bounceArrow 2s infinite ease-in-out;
      text-shadow: 0 2px 5px rgba(0, 0, 0, 0.8);
    }

    .ghost-arrow {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      text-align: center;
      color: #fbbf24;
      /* Gold */
      font-size: 1.5rem;
      z-index: 1;
      opacity: 0;
      animation: ghostArrow 2s infinite ease-in-out;
    }

    /* Remove old complex styles */
    .scroll-circle,
    .scroll-line {
      display: none;
    }

    @keyframes bounceArrow {

      0%,
      100% {
        transform: translateY(0);
      }

      50% {
        transform: translateY(10px);
      }
    }

    @keyframes ghostArrow {

      0%,
      100% {
        opacity: 0;
        transform: translateY(0);
      }

      50% {
        opacity: 0.6;
        transform: translateY(18px);
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
  <!-- Header Mejorado -->
  <!-- Header Section - Standardized with EN TIEMPO REAL Style -->
  <?php
  $headerDepth = 0;
  $activePage = 'inicio';
  include 'includes/standard-header.php';
  ?>


  <!-- Contenido Principal -->
  <section class="hero">
    <div class="content">
      <!-- Imágenes reemplazando los textos originales - AHORA MÁS GRANDES -->
      <img src="./principal/Festividad.png" alt="Festividad" class="title-image">
      <img src="./principal/virgencandelariaa.png" alt="Virgen de la Candelaria" class="subtitle-image">

      <div class="date-info">Del <span>16 de Enero al 10 de Febrero</span> | Puno, Perú</div>

      <!-- Countdown -->
      <div class="countdown" id="countdown">
        <!-- Se llenará con JavaScript -->
      </div>

      <!-- Info Cards Section -->
      <div class="info-cards-container">
        <!-- Card 1: Gold -->
        <div class="info-card card-gold" style="cursor: default;">
          <style>
            .info-card.card-gold:hover {
              transform: none !important;
              box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.3) !important;
            }

            .info-card.card-gold .card-glow {
              opacity: 0.6 !important;
            }
          </style>
          <div class="card-glow"></div>
          <span class="card-text">COBERTURA EN TIEMPO REAL: SABADO 31 DE ENERO </span>
        </div>

        <!-- Card 2: Purple -->
        <a href="./live-platform/index.php#scores" class="info-card card-purple">
          <div class="card-glow"></div>
          <span class="card-text">Puntajes</span>
        </a>

        <!-- Card 3: Dark Purple -->
        <a href="./live-platform/index.php#map" class="info-card card-dark">
          <div class="card-glow"></div>
          <span class="card-text">Recorrido</span>
        </a>
      </div>
    </div>

    <!-- Indicador de Scroll Animado (hijo directo de hero para layout space-between) -->
    <div class="scroll-indicator"
      onclick="document.getElementById('danzas-section').scrollIntoView({behavior: 'smooth'})">
      <span class="scroll-text">DESLIZA PARA CONOCER LAS DANZAS</span>
      <div class="scroll-arrow">
        <i class="fas fa-chevron-down main-arrow"></i>
        <i class="fas fa-chevron-down ghost-arrow"></i>
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

      <!-- Search bar for danzas -->
      <form id="danzas-search-form" class="danzas-search-form">
        <div class="search-input-wrapper">
          <i data-lucide="search" class="search-icon"></i>
          <input type="text" id="danzas-search-input" class="search-input" placeholder="Buscar danzas por nombre...">
        </div>
        <button type="submit" class="search-btn">
          Buscar
        </button>
      </form>

      <!-- Category Filter Buttons -->
      <div class="category-filter-container">
        <button class="category-filter-btn active" data-category="" onclick="filterByCategory('')">
          <i data-lucide="grid-3x3" style="width: 16px; height: 16px;"></i>
          Todos
        </button>
        <button class="category-filter-btn" data-category="Autoctonos" onclick="filterByCategory('Autoctonos')">
          <i data-lucide="mountain" style="width: 16px; height: 16px;"></i>
          Autóctonos
        </button>
        <button class="category-filter-btn" data-category="Luces Parada" onclick="filterByCategory('Luces Parada')">
          <i data-lucide="sparkles" style="width: 16px; height: 16px;"></i>
          Traje de Luces
        </button>
        <a href="./assets/orden.pdf" download="Programacion_Candelaria_2026.pdf"
          class="category-filter-btn download-btn"
          style="border-color: #fbbf24; color: #fbbf24; text-decoration: none;">
          <i data-lucide="download" style="width: 16px; height: 16px;"></i>
          Descargar Danzas
        </a>
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

      <!-- Pagination container -->
      <div id="pagination-container" class="pagination-container">
        <div class="pagination-info" id="results-info">
          Cargando resultados...
        </div>
        <div class="pagination-controls" id="pagination">
          <!-- Pagination controls will be loaded dynamically -->
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->


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
        grid-template-columns: repeat(4, 1fr);
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

    /* ========== Search Form Styles ========== */
    .danzas-search-form {
      display: flex;
      gap: 12px;
      max-width: 600px;
      margin: 0 auto 40px;
    }

    .search-input-wrapper {
      position: relative;
      flex: 1;
    }

    .search-icon {
      position: absolute;
      left: 16px;
      top: 50%;
      transform: translateY(-50%);
      width: 20px;
      height: 20px;
      color: rgba(255, 255, 255, 0.5);
      pointer-events: none;
    }

    .search-input {
      width: 100%;
      padding: 14px 16px 14px 50px;
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 12px;
      color: white;
      font-size: 1rem;
      transition: all 0.3s ease;
    }

    .search-input::placeholder {
      color: rgba(255, 255, 255, 0.5);
    }

    .search-input:focus {
      outline: none;
      border-color: #fbbf24;
      background: rgba(255, 255, 255, 0.15);
      box-shadow: 0 0 20px rgba(251, 191, 36, 0.2);
    }

    .search-btn {
      padding: 14px 28px;
      background: linear-gradient(135deg, #fbbf24, #f59e0b);
      color: #4c1d95;
      font-weight: 700;
      font-size: 1rem;
      border: none;
      border-radius: 12px;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .search-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(251, 191, 36, 0.4);
    }

    /* ========== Category Filter Styles ========== */
    .category-filter-container {
      display: flex;
      justify-content: center;
      gap: 12px;
      margin: 25px 0;
      flex-wrap: wrap;
    }

    .category-filter-btn {
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 12px 24px;
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
      border: 2px solid rgba(255, 255, 255, 0.2);
      border-radius: 50px;
      color: rgba(255, 255, 255, 0.8);
      font-size: 0.95rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .category-filter-btn:hover {
      background: rgba(255, 255, 255, 0.2);
      border-color: rgba(251, 191, 36, 0.5);
      color: #fff;
      transform: translateY(-2px);
    }

    .category-filter-btn.active {
      background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
      border-color: #fbbf24;
      color: #1e1b4b;
      box-shadow: 0 4px 15px rgba(251, 191, 36, 0.4);
    }

    .category-filter-btn.active:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(251, 191, 36, 0.5);
    }

    @media (max-width: 480px) {
      .category-filter-btn {
        padding: 10px 18px;
        font-size: 0.85rem;
      }
    }

    /* ========== Pagination Styles ========== */
    .pagination-container {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 20px;
      margin-top: 40px;
      padding: 25px;
      background: rgba(255, 255, 255, 0.08);
      backdrop-filter: blur(10px);
      border-radius: 16px;
      border: 1px solid rgba(255, 255, 255, 0.15);
    }

    .pagination-info {
      color: rgba(255, 255, 255, 0.8);
      font-size: 0.95rem;
    }

    .pagination-controls {
      display: flex;
      gap: 8px;
      flex-wrap: wrap;
      justify-content: center;
    }

    .pagination-controls button {
      padding: 10px 16px;
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 8px;
      font-weight: 600;
      font-size: 0.9rem;
      cursor: pointer;
      transition: all 0.3s ease;
      font-family: 'Montserrat', sans-serif;
    }

    .pagination-controls button.page-btn {
      background: rgba(255, 255, 255, 0.1);
      color: white;
    }

    .pagination-controls button.page-btn:hover:not(:disabled) {
      background: rgba(255, 255, 255, 0.2);
      border-color: #fbbf24;
    }

    .pagination-controls button.page-btn.active {
      background: linear-gradient(135deg, #fbbf24, #f59e0b);
      color: #4c1d95;
      border-color: transparent;
    }

    .pagination-controls button.nav-btn {
      background: rgba(76, 29, 149, 0.8);
      color: white;
      border-color: rgba(76, 29, 149, 0.5);
    }

    .pagination-controls button.nav-btn:hover:not(:disabled) {
      background: #5b21b6;
    }

    .pagination-controls button:disabled {
      opacity: 0.5;
      cursor: not-allowed;
    }

    .pagination-controls span.ellipsis {
      padding: 10px 8px;
      color: rgba(255, 255, 255, 0.6);
    }

    /* ========== Modal Styles ========== */
    .modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.85);
      z-index: 1000;
      overflow-y: auto;
    }

    .modal.active {
      display: flex;
      justify-content: center;
      align-items: flex-start;
      padding: 2rem;
    }

    .modal-content {
      background: white;
      border-radius: 1.5rem;
      width: 90%;
      max-width: 1000px;
      max-height: 90vh;
      overflow-y: auto;
      position: relative;
      animation: modalFadeIn 0.3s ease;
    }

    @keyframes modalFadeIn {
      from {
        opacity: 0;
        transform: translateY(-20px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .modal-header {
      padding: 1.5rem 2rem;
      background: linear-gradient(135deg, #4c1d95, #5b21b6);
      color: white;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-radius: 1.5rem 1.5rem 0 0;
    }

    .modal-header h2 {
      font-size: 1.5rem;
      font-weight: 700;
      margin: 0;
    }

    .modal-close {
      background: none;
      border: none;
      color: white;
      font-size: 2rem;
      cursor: pointer;
      padding: 0;
      width: 2.5rem;
      height: 2.5rem;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.3s ease;
      border-radius: 50%;
    }

    .modal-close:hover {
      background: rgba(255, 255, 255, 0.2);
      color: #fbbf24;
    }

    .modal-body {
      padding: 2rem;
    }

    .modal-section {
      margin-bottom: 2rem;
    }

    .modal-section h3 {
      color: #4c1d95;
      font-size: 1.25rem;
      margin-bottom: 1rem;
      padding-bottom: 0.5rem;
      border-bottom: 2px solid #fbbf24;
    }

    .dance-details-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 2rem;
    }

    .dance-image {
      width: 100%;
      height: 280px;
      object-fit: cover;
      border-radius: 1rem;
      box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.15);
    }

    .quick-facts {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 1rem;
      margin-top: 1.5rem;
    }

    .info-item {
      display: flex;
      flex-direction: column;
      gap: 0.25rem;
    }

    .info-label {
      font-size: 0.75rem;
      color: #6b7280;
      font-weight: 600;
      text-transform: uppercase;
    }

    .info-value {
      font-size: 0.95rem;
      color: #1f2937;
      font-weight: 700;
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

      .danzas-search-form {
        flex-direction: column;
      }

      .search-btn {
        width: 100%;
      }

      .modal.active {
        padding: 1rem;
      }

      .modal-content {
        border-radius: 1rem;
      }

      .modal-header {
        padding: 1rem 1.5rem;
        border-radius: 1rem 1rem 0 0;
      }

      .modal-body {
        padding: 1.5rem;
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

      .pagination-controls button {
        padding: 8px 12px;
        font-size: 0.8rem;
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
      const header = document.querySelector('.header-manta-premium');
      if (header) {
        if (scrollY > 50) {
          header.classList.add('scrolled');
        } else {
          header.classList.remove('scrolled');
        }
      }

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


  <script>
    // Initialize Lucide icons
    lucide.createIcons();

    // Mobile Menu Logic
    // Mobile Menu Logic - Handled in standard-header.php

    // ========== Photo path helper function ==========
    function fixPhotoPath(foto) {
      if (!foto || foto === 'null' || foto === '') return null;
      // Already a full URL
      if (foto.startsWith('http://') || foto.startsWith('https://')) return foto;
      // Already has assets/uploads path
      if (foto.includes('assets/uploads')) return foto;
      // Just filename - prepend the uploads path
      return `./assets/uploads/${foto}`;
    }

    // ========== Current state for danzas (RAM MODE) ==========
    let RAM_DANZAS = []; // Toda la base de datos en memoria
    let filteredDanzas = []; // Resultados filtrados actuales
    let currentPage = 1;
    const pageSize = 12; // Static page size
    let currentSearchQuery = '';
    let currentCategory = '';
    let isRamLoaded = false;
    let isLoading = false;


    // ========== Load ALL Danzas into RAM (Turbo Load) ==========
    async function loadAllDanzasIntoRam() {
      if (isRamLoaded || isLoading) return;
      isLoading = true;

      const danzasGrid = document.getElementById('danzas-grid');

      if (danzasGrid) {
        danzasGrid.innerHTML = `
            <div class="danza-card loading-skeleton">
              <div class="skeleton-image"></div>
              <div class="skeleton-content"><div class="skeleton-line short"></div><div class="skeleton-line"></div></div>
            </div>
            <div class="danza-card loading-skeleton">
              <div class="skeleton-image"></div>
              <div class="skeleton-content"><div class="skeleton-line short"></div><div class="skeleton-line"></div></div>
            </div>
            <div class="danza-card loading-skeleton">
              <div class="skeleton-image"></div>
              <div class="skeleton-content"><div class="skeleton-line short"></div><div class="skeleton-line"></div></div>
            </div>
          `;
      }

      try {
        console.time("🚀 Descarga Turbo");
        const response = await fetch('./api/danzas_all.php');
        if (!response.ok) throw new Error(`Error HTTP: ${response.status}`);

        RAM_DANZAS = await response.json();
        console.timeEnd("🚀 Descarga Turbo");
        console.log(`✅ ${RAM_DANZAS.length} danzas cargadas en RAM.`);

        isRamLoaded = true;
        filterAndRender();

      } catch (error) {
        console.error('Error loading ALL danzas:', error);
        if (danzasGrid) {
          danzasGrid.innerHTML = `
              <div class="danza-card" style="grid-column: 1 / -1; text-align: center; padding: 40px;">
                <p style="color: rgba(255,255,255,0.7);">Error al cargar las danzas: ${error.message}</p>
                <button onclick="loadAllDanzasIntoRam()" class="search-btn" style="margin-top:15px;">Reintentar</button>
              </div>
            `;
        }
      } finally {
        isLoading = false;
      }
    }

    // ========== Logic: Filter RAM -> filteredDanzas -> Paginate -> Render ==========
    function filterAndRender() {
      let results = RAM_DANZAS;

      // Filtro por Categoría
      if (currentCategory && currentCategory.trim() !== '') {
        results = results.filter(d =>
          (d.categoria && d.categoria === currentCategory) ||
          (currentCategory === 'Luces Parada' && d.categoria === 'Luces Parada')
        );
      }

      // Filtro por Búsqueda
      if (currentSearchQuery && currentSearchQuery.trim() !== '') {
        const q = currentSearchQuery.toLowerCase();
        results = results.filter(d => {
          const text = (
            (d.conjunto || '') + ' ' +
            (d.categoria || '') + ' ' +
            (d.descripcion || '')
          ).toLowerCase();
          return text.includes(q);
        });
      }

      filteredDanzas = results;
      renderCurrentPage();
    }

    function renderCurrentPage() {
      const danzasGrid = document.getElementById('danzas-grid');
      const resultsInfo = document.getElementById('results-info');
      const paginationContainer = document.getElementById('pagination');

      if (!danzasGrid) return;

      const total = filteredDanzas.length;

      if (total === 0) {
        danzasGrid.innerHTML = `
            <div class="danza-card" style="grid-column: 1 / -1; text-align: center; padding: 40px;">
              <p style="color: rgba(255,255,255,0.7);">
                ${currentSearchQuery ? `No se encontraron danzas para "${currentSearchQuery}"` : 'No hay danzas disponibles en esta categoría.'}
              </p>
            </div>
           `;
        if (resultsInfo) resultsInfo.textContent = '0 resultados';
        if (paginationContainer) paginationContainer.innerHTML = '';
        return;
      }

      const totalPages = Math.ceil(total / pageSize);
      if (currentPage > totalPages) currentPage = 1;

      const startIdx = (currentPage - 1) * pageSize;
      const endIdx = Math.min(startIdx + pageSize, total);

      const pageItems = filteredDanzas.slice(startIdx, endIdx);

      danzasGrid.innerHTML = pageItems.map(danza => {
        const categoriaRaw = danza.categoria || 'TRADICIONAL';
        const displayCategory = categoriaRaw === 'Luces Parada' ? 'TRAJE DE LUCES' : categoriaRaw.toUpperCase();
        const imageUrl = fixPhotoPath(danza.foto) || `https://placehold.co/400x300/4c1d95/fbbf24?text=${encodeURIComponent(danza.conjunto || 'Danza')}`;

        return `
            <div class="danza-card">
              <div class="card-image-container">
                <img class="card-image" 
                     src="${imageUrl}" 
                     alt="${danza.conjunto}"
                     loading="lazy"
                     onerror="this.onerror=null; this.src='https://placehold.co/400x300/4c1d95/fbbf24?text=Danza';">
                <div class="card-image-overlay"></div>
                <span class="card-category">${displayCategory}</span>
              </div>
              <div class="card-content">
                <h3 class="card-title">${danza.conjunto}</h3>
                <button class="card-btn" onclick="window.location.href='./horarios_y_danzas/index.php?danzaId=${danza.id}#danzas'">
                  Ver Detalles
                  <i data-lucide="eye" style="width: 16px; height: 16px;"></i>
                </button>
              </div>
            </div>
          `;
      }).join('');

      if (resultsInfo) {
        resultsInfo.textContent = `Mostrando ${startIdx + 1} a ${endIdx} de ${total} danzas`;
      }

      if (paginationContainer) {
        let paginationHtml = '';

        const maxVisible = 5;
        let pStart = Math.max(1, currentPage - Math.floor(maxVisible / 2));
        let pEnd = Math.min(totalPages, pStart + maxVisible - 1);
        if (pEnd - pStart + 1 < maxVisible) pStart = Math.max(1, pEnd - maxVisible + 1);

        // Prev
        paginationHtml += `<button class="nav-btn" ${currentPage === 1 ? 'disabled' : `onclick="changeDanzaPage(${currentPage - 1})"`}>← Anterior</button>`;

        if (pStart > 1) {
          paginationHtml += `<button class="page-btn" onclick="changeDanzaPage(1)">1</button>`;
          if (pStart > 2) paginationHtml += '<span class="ellipsis">...</span>';
        }

        for (let i = pStart; i <= pEnd; i++) {
          paginationHtml += `<button class="page-btn ${i === currentPage ? 'active' : ''}" onclick="changeDanzaPage(${i})">${i}</button>`;
        }

        if (pEnd < totalPages) {
          if (pEnd < totalPages - 1) paginationHtml += '<span class="ellipsis">...</span>';
          paginationHtml += `<button class="page-btn" onclick="changeDanzaPage(${totalPages})">${totalPages}</button>`;
        }

        // Next
        paginationHtml += `<button class="nav-btn" ${currentPage === totalPages ? 'disabled' : `onclick="changeDanzaPage(${currentPage + 1})"`}>Siguiente →</button>`;

        paginationContainer.innerHTML = paginationHtml;
      }

      if (typeof lucide !== 'undefined') lucide.createIcons();
    }

    // Function to change page (Local)
    function changeDanzaPage(page) {
      if (page < 1) return;
      currentPage = page;
      renderCurrentPage();
      document.getElementById('danzas-section').scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    // Function to search danzas (Compat)
    function searchDanzas(query) {
      currentSearchQuery = query;
      currentPage = 1;
      filterAndRender();
    }

    // ========== Category Filter Function ==========
    function filterByCategory(category) {
      document.querySelectorAll('.category-filter-btn').forEach(btn => {
        btn.classList.toggle('active', btn.dataset.category === category);
      });

      currentCategory = category;
      currentPage = 1;
      filterAndRender();
    }

    // ========== Dance Modal Functions ==========
    function openDanceModal(id, conjunto, descripcion, categoria, hora, ordenConcurso, ordenVeneracion, detalles, imagen, diaConcurso, diaVeneracion) {
      const modal = document.getElementById('dance-modal');
      const modalTitle = document.getElementById('dance-modal-title');
      const modalBody = document.getElementById('dance-modal-body');

      if (!modal || !modalBody) return;

      modalTitle.textContent = conjunto || 'Danza';

      // Format dates for display
      const formatDate = (dateStr) => {
        if (!dateStr || dateStr === 'null' || dateStr === '') return 'No especificada';
        return dateStr;
      };

      // Format categoria - change "Luces Parada" to "Traje de Luces"
      const displayCategoria = (cat) => {
        if (cat === 'Luces Parada') return 'Traje de Luces';
        return cat || 'N/A';
      };

      modalBody.innerHTML = `
        <div class="dance-details-grid">
          <div>
            <img src="${fixPhotoPath(imagen) || 'https://placehold.co/400x300?text=Imagen+no+disponible'}"
                 alt="${conjunto}"
                 class="dance-image"
                 onerror="this.onerror=null; this.src='https://placehold.co/400x300?text=Imagen+no+disponible';">
            <div class="quick-facts">
              <div class="info-item">
                <div class="info-label">Categoria</div>
                <div class="info-value">${displayCategoria(categoria)}</div>
              </div>
              <div class="info-item">
                <div class="info-label">Dia de Concurso</div>
                <div class="info-value">${formatDate(diaConcurso)}</div>
              </div>
              <div class="info-item">
                <div class="info-label">Dia de Veneracion</div>
                <div class="info-value">${formatDate(diaVeneracion)}</div>
              </div>
              <div class="info-item">
                <div class="info-label">Orden Concurso</div>
                <div class="info-value">${ordenConcurso ? '#' + ordenConcurso : 'N/A'}</div>
              </div>
              <div class="info-item">
                <div class="info-label">Orden Veneracion</div>
                <div class="info-value">${ordenVeneracion ? '#' + ordenVeneracion : 'N/A'}</div>
              </div>
            </div>
          </div>
        </div>
      `;

      modal.classList.add('active');
    }

    function closeDanceModal() {
      const modal = document.getElementById('dance-modal');
      if (modal) modal.classList.remove('active');
    }

    // ========== Debounce Function ==========
    function debounce(func, wait) {
      let timeout;
      return function (...args) {
        const context = this;
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(context, args), wait);
      };
    }

    // ========== Initialize ==========
    // ========== Initialize ==========
    document.addEventListener('DOMContentLoaded', function () {
      // 1. CARGA INICIAL DE TODO (Turbo Mode)
      loadAllDanzasIntoRam();

      // Set up search form
      const searchForm = document.getElementById('danzas-search-form');
      const searchInput = document.getElementById('danzas-search-input');

      // Prevent Form Submit (Reload)
      if (searchForm) {
        searchForm.addEventListener('submit', function (e) {
          e.preventDefault();
        });
      }

      // 2. BUSQUEDA INSTANTANEA
      // Usamos 'input' para reacción inmediata sin debounce (o mínimo).
      if (searchInput) {
        searchInput.addEventListener('input', function (e) {
          currentSearchQuery = e.target.value;
          currentPage = 1; // Reset page
          filterAndRender(); // Filtrado local instantáneo
        });
      }

      // Set up modal close
      const modalCloseBtn = document.getElementById('dance-modal-close');
      if (modalCloseBtn) {
        modalCloseBtn.addEventListener('click', closeDanceModal);
      }

      // Close modal on outside click
      const modal = document.getElementById('dance-modal');
      if (modal) {
        modal.addEventListener('click', function (e) {
          if (e.target === modal) {
            closeDanceModal();
          }
        });
      }
    });
  </script>

  <?php
  // Footer
  $footerDepth = 0;
  include __DIR__ . '/includes/standard-footer.php';


  ?>


  <div class="modal" id="dance-modal">
    <div class="modal-content">
      <div class="modal-header">
        <h2 id="dance-modal-title">Detalles de la Danza</h2>
        <button class="modal-close" id="dance-modal-close">&times;</button>
      </div>
      <div class="modal-body" id="dance-modal-body"></div>
    </div>
  </div>
  <?= getAuthModalHTML() ?>
  <?= getAuthJS() ?>
  <script src="./assets/js/spark-effect.js"></script>

</body>

</html>