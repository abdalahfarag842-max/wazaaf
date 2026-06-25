const menuToggle = document.getElementById('menuToggle');
const sidebar = document.getElementById('sidebar');
const pageWrapper = document.getElementById('pageWrapper');

menuToggle.addEventListener('click', () => {
    sidebar.classList.toggle('active');
    pageWrapper.classList.toggle('expanded');
});