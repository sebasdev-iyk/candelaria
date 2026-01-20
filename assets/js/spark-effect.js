document.addEventListener('DOMContentLoaded', () => {
    const logoContainer = document.getElementById('logo-container');

    if (!logoContainer) return;

    // Asegurar que el contenedor tenga overflow hidden para que las chispas no salgan
    logoContainer.style.overflow = 'hidden';
    if (getComputedStyle(logoContainer).position === 'static') {
        logoContainer.style.position = 'relative';
    }

    function createSpark() {
        const spark = document.createElement('div');
        spark.classList.add('spark');

        // Random properties for a more realistic spark effect
        const size = Math.random() * 4 + 2; // 2px to 6px
        // Position primarily near the center/image but allowed to spawn across width
        const left = Math.random() * 100; // 0% to 100%
        const duration = Math.random() * 1.5 + 1; // 1s to 2.5s
        const tx = (Math.random() - 0.5) * 100; // -50px to 50px horizontal drift

        spark.style.width = `${size}px`;
        spark.style.height = `${size}px`;
        spark.style.left = `${left}%`;
        spark.style.setProperty('--tx', `${tx}px`);
        spark.style.animation = `floatUp ${duration}s ease-out forwards`;

        logoContainer.appendChild(spark);

        setTimeout(() => {
            spark.remove();
        }, duration * 1000);
    }

    // Generar chispas constantemente
    const sparkInterval = setInterval(createSpark, 80);

    // Chispas extra al hacer hover
    logoContainer.addEventListener('mouseenter', () => {
        // Burst
        for (let i = 0; i < 10; i++) {
            setTimeout(() => createSpark(), i * 30);
        }
    });

    // Más chispas durante hover
    let hoverInterval;
    logoContainer.addEventListener('mouseenter', () => {
        hoverInterval = setInterval(createSpark, 40);
    });

    logoContainer.addEventListener('mouseleave', () => {
        if (hoverInterval) {
            clearInterval(hoverInterval);
        }
    });

});
