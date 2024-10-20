function validatePasswords() {
    const password = document.getElementById('password').value;
    const passwordConfirm = document.getElementById('password_confirm').value;
    const errorMessage = document.getElementById('error-message');

    if (password !== passwordConfirm) {
        errorMessage.classList.remove('hidden');
        return false;
    } else {
        errorMessage.classList.add('hidden');
    }

    return true;
}