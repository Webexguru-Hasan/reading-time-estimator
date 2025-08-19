document.addEventListener("DOMContentLoaded", function() {
    const openBtn = document.getElementById("rte-open-popup");
    const popup = document.getElementById("rte-popup");
    const closeBtn = document.querySelector(".rte-close");

    if(openBtn){
        // Open
        openBtn.addEventListener("click", function() {
            popup.classList.add("show");
        });

        // Close
        closeBtn.addEventListener("click", function() {
            popup.classList.remove("show");
        });

        // Close when clicking outside
        window.addEventListener("click", function(e) {
            if (e.target === popup) {
                popup.classList.remove("show");
            }
        });
    }
});
