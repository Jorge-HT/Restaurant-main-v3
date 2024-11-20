// Handles the progress bar for plate progress
let i = 0;
function move() {
    if (i == 0) {
        i = 1;
        const elem = document.getElementById("myBar");
        let width = 1;
        const id = setInterval(frame, 10);
        function frame() {
            if (width >= 100) {
                clearInterval(id);
                i = 0;
            } else {
                width++;
                elem.style.width = width + "%";  // Update width
            }
        }
    }
}