// Handles the progress bar for plate progress
var i = 0;
function move() {
    if (i == 0) {
        i = 1;
        var elem = document.getElementById("myBar");
        var width = 1;
        var totalTime = 1500; // total time in seconds (25 minutes)
        var interval = (totalTime * 10); // 1500ms per step (this would fill it in 25 minutes)
        var id = setInterval(frame, interval);
        function frame() {
            if (width >= 100) {
                clearInterval(id);
                i = 0;
            } else {
                width++;
                elem.style.width = width + "%"; //update width by 1%
            }
        }
    }
}