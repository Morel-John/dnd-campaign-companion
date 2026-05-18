// Creating constant variable that keep their value
// document is the whole HTML-document, shown in the browser at that moment

// getElementById looks exactly for one element with the specific ID
// querySelector collects every element that matches the class (".npc-card") -> looks for all elements from the npc-card class
// And puts them into a collection-"box" (NodeList is similar to a PHP-array)
const searchInput = document.getElementById("searchInput");   // The searchbar
const npcCards = document.querySelectorAll(".npc-card");      // The collection of all npc-cards

// Tell the searchbar to be a "listener" -> reacts to inputs immediatly 
searchInput.addEventListener("input", function () {
    // We get the input and save it in a variable and force everything to lower case
    const filterText = this.value.toLowerCase();

    // for each element in our NodeList we do something:
    npcCards.forEach(npc => {
        // Reading and saving combined information all at once
        const searchContent = npc.getAttribute('data-search') || '';
        // If input includes something the npc stays visible 
        if (searchContent.includes(filterText)) {
            npc.style.display = "";
            // Everything else wont be displayed
        } else {
            npc.style.display = "none";
        }
    });
});
