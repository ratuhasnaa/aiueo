document.addEventListener('DOMContentLoaded', () => {
    const customSelect = document.querySelector('.custom-select');
    const selectedOption = document.querySelector('.selected-option');
    const optionsList = document.querySelector('.options-list');
    const options = document.querySelectorAll('.option');

    selectedOption.addEventListener('click', () => {
        optionsList.style.display = optionsList.style.display === 'block' ? 'none' : 'block';
    });

    options.forEach(option => {
        option.addEventListener('click', () => {
            selectedOption.textContent = option.textContent;
            optionsList.style.display = 'none';
        });
    });

    document.addEventListener('click', (event) => {
        if (!customSelect.contains(event.target)) {
            optionsList.style.display = 'none';
        }
    });
});
