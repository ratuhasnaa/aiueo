function showContent(contentId) {
    // Sembunyikan semua konten
    const contents = document.querySelectorAll('.content-section');
    contents.forEach(content => {
        content.style.display = 'none';
    });

    // Tampilkan konten yang dipilih
    const selectedContent = document.getElementById(contentId);
    if (selectedContent) {
        selectedContent.style.display = 'block';
    }
}