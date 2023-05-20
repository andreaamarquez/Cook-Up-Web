const username = document.getElementById('username');
const email = document.getElementById('email');
const password = document.getElementById('password');
const button = document.getElementById('button')

button.addEventListener('click', (e) => {
    e.preventDefault()
    const data = {
        username: username.value,
        email: email.value,
        password: password.value
    }

    alert("Datos ingresados");
})