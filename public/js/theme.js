// Kiểm tra và áp dụng theme ngay lập tức để tránh chớp màn hình (FOUC)
(function() {
    const currentTheme = localStorage.getItem('theme');
    if (currentTheme === 'dark') {
        document.documentElement.classList.add('dark-mode');
    }
})();

document.addEventListener('DOMContentLoaded', () => {
    const themeToggleBtn = document.getElementById('theme-toggle');
    if (!themeToggleBtn) return;

    const currentTheme = localStorage.getItem('theme');
    updateToggleIcon(currentTheme === 'dark');

    themeToggleBtn.addEventListener('click', () => {
        document.documentElement.classList.toggle('dark-mode');
        let isDark = document.documentElement.classList.contains('dark-mode');
        
        if (isDark) {
            localStorage.setItem('theme', 'dark');
        } else {
            localStorage.setItem('theme', 'light');
        }
        updateToggleIcon(isDark);
    });
});

function updateToggleIcon(isDark) {
    const btn = document.getElementById('theme-toggle');
    if (!btn) return;

    // Xóa icon cũ
    btn.innerHTML = '';
    
    if (btn.classList.contains('admin-toggle')) {
        // Admin dùng FontAwesome
        if (isDark) {
            btn.innerHTML = '<i class="fas fa-sun"></i>';
            btn.setAttribute('title', 'Chế độ Sáng');
        } else {
            btn.innerHTML = '<i class="fas fa-moon"></i>';
            btn.setAttribute('title', 'Chế độ Tối');
        }
    } else {
        // Client dùng SVG
        const svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");
        svg.setAttribute("viewBox", "0 0 24 24");
        svg.setAttribute("class", "icon");
        svg.setAttribute("fill", "none");
        svg.setAttribute("stroke", "currentColor");
        svg.setAttribute("stroke-width", "2");
        svg.setAttribute("stroke-linecap", "round");
        svg.setAttribute("stroke-linejoin", "round");
        svg.style.width = "24px";
        svg.style.height = "24px";
        
        if (isDark) {
            svg.innerHTML = '<circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>';
            btn.setAttribute('title', 'Chế độ Sáng');
        } else {
            svg.innerHTML = '<path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>';
            btn.setAttribute('title', 'Chế độ Tối');
        }
        btn.appendChild(svg);
    }
}
