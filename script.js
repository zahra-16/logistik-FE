/* script.js */

document.addEventListener('DOMContentLoaded', () => {
    // Fungsionalitas untuk menandai menu aktif
    const sidebarLinks = document.querySelectorAll('.sidebar li a');
    const currentPath = window.location.pathname.split('/').pop();
    
    // Asumsi: Jika kita di dashboard, tautan Dashboard harus aktif
    const activeLink = Array.from(sidebarLinks).find(link => 
        link.getAttribute('href') === '#' || link.textContent.trim().includes('Dashboard')
    );

    if (activeLink) {
        activeLink.classList.add('active');
    }

    // Fungsionalitas pencarian dasar (opsional)
    const searchInput = document.querySelector('.search-bar input');
    
    if (searchInput) {
        searchInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                console.log('Mencari:', searchInput.value);
                // Di sini Anda bisa menambahkan logika pencarian frontend
                alert('Mencari: ' + searchInput.value);
            }
        });
    }

    // Contoh interaksi kartu
    const cards = document.querySelectorAll('.card');
    cards.forEach(card => {
        card.addEventListener('click', () => {
            const header = card.querySelector('.card-header').textContent;
            console.log('Mengklik kartu:', header);
            // alert('Akan diarahkan ke halaman: ' + header);
        });
    });
});