// Get modal elements
const eventModal = document.getElementById("eventModal");
const eventPostButton = document.getElementById("eventPostButton");
const closeEventButton = document.getElementById("closeEventButton");
const closeModal = document.querySelector(".close-btn");

// Show modal on button click
eventPostButton.addEventListener("click", () => {
    eventModal.style.display = "block";
});

// Close modal on "Close" button click
closeEventButton.addEventListener("click", () => {
    eventModal.style.display = "none";
});

// Close modal on "X" click
closeModal.addEventListener("click", () => {
    eventModal.style.display = "none";
});

// Close modal when clicking outside of modal content
window.addEventListener("click", (e) => {
    if (e.target === eventModal) {
        eventModal.style.display = "none";
    }
});
