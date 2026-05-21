const pageFlip = new St.PageFlip(document.getElementById('book'), {
    width: 600,         // required parameter - base page width
    height: 750,        // required parameter - base page height
    showCover: true,    // If this value is true, the first and the last pages will be marked as hard and will be shown in single page mode
    drawShadow: true, 
    usePortrait: false,
});
pageFlip.loadFromHTML(document.querySelectorAll('.page_cover ,.page, .page_backcover'));