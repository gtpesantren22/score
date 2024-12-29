
$(document).ready(function() {
    let timer;
    let seconds = 0;
    let minutes = 0;

    function updateDisplay() {
        $('#timerDisplay').text(
            (minutes < 10 ? '0' : '') + minutes + ':' +
            (seconds < 10 ? '0' : '') + seconds
        );
    }

    // function startTimer() {
    //     timer = setInterval(function() {
    //         seconds++;
    //         if (seconds == 60) {
    //             seconds = 0;
    //             minutes++;
    //         }
    //         updateDisplay();
    //     }, 1000);
    // }

    // function stopTimer() {
    //     clearInterval(timer);
    // }

    window.startTimer = function() { // Memastikan startTimer berada di cakupan global
        console.log("Timer started!"); // Logging untuk debugging
        timer = setInterval(function() {
            seconds++;
            if (seconds == 60) {
                seconds = 0;
                minutes++;
            }
            updateDisplay();
        }, 1000);
    }

     window.stopTimer = function() { // Memastikan stopTimer berada di cakupan global
        console.log("Timer stopped!"); // Logging untuk debugging
        clearInterval(timer);
    }

    $('#startButton').click(function() {
        startTimer();
    });

    $('#stopButton').click(function() {
        stopTimer();
    });

    updateDisplay(); // Initialize the display
});
