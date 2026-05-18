// getElementById looks exactly for one element with the specific ID
// querySelector collects every element that matches the class (".npc-card") -> looks for all elements from the npc-card class
// And puts them into a collection-"box" (NodeList is similar to a PHP-array)
const npcModal = document.getElementById('npcModal');
const allCards = document.querySelectorAll('.npc-card');

// Foreach card: 
allCards.forEach(card => {
    // Wait for next click
    card.addEventListener("click", function (event) {
        // If click on delete don´t open profile
        if (event.target.tagName === 'BUTTON' || event.target.closest('form')) {
            return;
        }
        // Read all Data- attribute of the clicked card/npc
        const id = this.getAttribute("data-id") || '';
        const name = this.getAttribute("data-name") || "Unknown";
        const town = this.getAttribute("data-town") || "Unknown";
        const size = this.getAttribute("data-size") || "-";
        const race = this.getAttribute("data-parentrace") || "-";
        const profession = this.getAttribute("data-profession") || "-";
        const alignment = this.getAttribute("data-alignment") || "-";
        const status = this.getAttribute("data-status") || "-";
        const info = this.getAttribute("data-info") || "Keine weiteren Informationen aufgezeichnet.";
        const image = this.getAttribute("data-image") || "assets/img/npc/default.png";

        // Put all data into empty Modal-html
        document.getElementById("modal-name").innerText = name;
        document.getElementById("modal-town").innerText = town;
        document.getElementById("modal-size").innerText = size;
        document.getElementById("modal-race").innerText = race;
        document.getElementById("modal-profession").innerText = profession;
        document.getElementById("modal-alignment").innerText = alignment;
        document.getElementById("modal-status").innerText = status;
        document.getElementById("modal-info").innerText = info;

        // Change image 
        document.getElementById('modal-image').src = image;

        // Creating dynamic edit-button
        document.getElementById("modal-edit-btn").href = "index.php?page=npc_form&id=" + id;

        // Make the modal visible
        npcModal.style.display = "block";
    });
});

// Close-button on profile
// Get X-Button from html
const closeButton = document.querySelector(".closeButton");

// Close window with clicking X
if (closeButton) {
    closeButton.addEventListener("click", function () {
        npcModal.style.display = "none";
    });
}

// Close window with clicking outside the profile
window.addEventListener("click", function (event) {
    if (event.target === npcModal) {
        npcModal.style.display = "none";
    }
});