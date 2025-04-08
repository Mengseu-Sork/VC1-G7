document.querySelectorAll('.navbar div').forEach(tab => {
    tab.addEventListener('click', () => {
        document.querySelectorAll('.navbar div').forEach(t => t.classList.remove('active'));
        tab.classList.add('active');
    });
});
