const toggleButton = document.querySelector('.menu-toggle');
const sidebar = document.querySelector('.sidebar');

let sidebarOpen = false;

// Toggle menu saat klik hamburger
toggleButton.addEventListener('click', (event) => {
  event.stopPropagation(); // Hindari langsung tertutup karena event bubbling
  sidebar.classList.toggle('active');
  sidebarOpen = sidebar.classList.contains('active');
});

// Tutup sidebar jika klik di luar sidebar dan tombol
document.addEventListener('click', (event) => {
  if (sidebarOpen && !sidebar.contains(event.target) && !toggleButton.contains(event.target)) {
    sidebar.classList.remove('active');
    sidebarOpen = false;
  }
});
