
window.addEventListener('scroll', function() {
  const hero = document.querySelector('.hero');
  const scrollY = window.scrollY;


  hero.style.backgroundPositionY = `${scrollY * 0.5}px`;
});


const eventDate = new Date("February 2, 2026 00:00:00").getTime();

const countdown = setInterval(() => {

  const now = new Date().getTime();
  

  const distance = eventDate - now;


  if (distance < 0) {
    clearInterval(countdown);
    document.querySelector(".countdown").innerHTML = "¡La festividad ha comenzado!";
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

  document.querySelector(".countdown").innerHTML = `
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
}, 1000);
