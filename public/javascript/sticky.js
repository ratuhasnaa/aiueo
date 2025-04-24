window.addEventListener('scroll', function() {
    var rightColumn = document.querySelector('.right-column');
    var dataPemesan = document.querySelector('.data-pemesan-box');

    var rightColumnTop = rightColumn.getBoundingClientRect().top; // Posisi top dari right-column relatif ke viewport
    var dataPemesanTop = dataPemesan.getBoundingClientRect().top; // Posisi top dari data-pemesan-box relatif ke viewport
    var scrollPosition = window.scrollY; // Posisi scroll saat ini

    if (rightColumnTop <= 20 && dataPemesanTop > (rightColumn.offsetHeight + 20)) {
        rightColumn.style.position = 'fixed';
        rightColumn.style.top = '20px';
    } else if (dataPemesanTop <= (rightColumn.offsetHeight + 20)) {
        rightColumn.style.position = 'absolute';
        rightColumn.style.top = (dataPemesanTop - rightColumn.offsetHeight - 20) + 'px';
    } else {
        rightColumn.style.position = 'relative';
        rightColumn.style.top = '0';
    }
});
