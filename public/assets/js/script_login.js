function AlternarContraseña() {
    const passwordInput = document.getElementById('password');
    const icon = document.querySelector('.alternar-contraseña');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.textContent = '👁️'; // Cambia el ícono para indicar que la contraseña está visible
    } else {
        passwordInput.type = 'password';
        icon.textContent = '👁️'; // Cambia el ícono para indicar que la contraseña está oculta
    }
}
