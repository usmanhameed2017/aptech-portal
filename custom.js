// Toaster function need to define seconds to be live and the text to be shown. 
function toaster(text, duration)
{
    Toastify({
      text: text,
      duration: duration*1000,
      newWindow: true,
      close: true,
      gravity: "top",
      position: "center",
      pauseOnHover: true,
      style: {
        "background": "rgb(68 67 67 / 84%)",
        "backdrop-filter": "saturate(180%) blur(20px)",
        "-webkit-backdrop-filter": "saturate(180%) blur(20px)",
        "border-radius": "20px",
      }, 
      onClick: function(){} 
    }).showToast();
}

let isDragging = false;
let startX;
let scrollLeft;

const card = document.querySelector('.card');

card.addEventListener('mousedown', (e) => {
  isDragging = true;
  startX = e.clientX;
  scrollLeft = card.scrollLeft;
  card.style.cursor = 'grabbing';
});

document.addEventListener('mousemove', (e) => {
  if (!isDragging) return;

  const deltaX = e.clientX - startX;
  card.scrollLeft = scrollLeft - deltaX;
});

document.addEventListener('mouseup', () => {
  isDragging = false;
  card.style.cursor = 'grab';
});
