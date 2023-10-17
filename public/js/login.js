const passwordField = document.getElementById('password');
const eyeIcon = document.getElementById('showPassword');

eyeIcon.addEventListener('click', function() {
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
    } else {
        passwordField.type = 'password';
    }
});

function cerrarAlerta() {
    const alerta = document.querySelector('.alert');
    alerta.style.display = 'none';
}
