function reload() {
    window.location.href = window.location.href.split('?')[0];
    window.location.href = baseUrl + '?retake=true';

    var timerElement = document.getElementById('timer');
    if (timerElement) {
        timerElement.innerHTML = 'Time remaining: 5:00';
    }
}

var timer;
var timeLeft = 300;

function startTimer() {
    timer = setInterval(function() {
        timeLeft--;

        if (timeLeft <= 0) {
            clearInterval(timer);
            var timerElement = document.getElementById('timer');
            if (timerElement) {
                timerElement.innerHTML = 'Time is up!';
            }
            submitForm(); 
        } else {
            var minutes = Math.floor(timeLeft / 60);
            var seconds = timeLeft % 60;
            var timerElement = document.getElementById('timer');
            if (timerElement) {
                timerElement.innerHTML =
                    'Time remaining: ' + minutes + ':' + (seconds < 10 ? '0' : '') + seconds;
            }
        }
    }, 1000);
}

function submitForm() {
    document.getElementById('quizForm').submit();
}

window.onload = function() {
    startTimer();
};