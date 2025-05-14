function togglePassword(fieldId) {
    const input = document.getElementById(fieldId);
    const icon = document.getElementById(fieldId + "1");

    if (input.type === "password") {
        input.type = "text";
        icon.textContent = "🙈"; 
    } else {
        input.type = "password";
        icon.textContent = "👁️"; 
    }
}
if(document.getElementById('myForm')){
    document.getElementById('myForm').addEventListener('submit', function(e) {
        const password = document.getElementById('password');
        
        password.type = 'password';
        if(document.getElementById('confirmPassword')){
            const confirmPassword = document.getElementById('confirmPassword');
            confirmPassword.type = 'password';
        
            if (password.value !== confirmPassword.value) {
                alert("Passwords do not matchs !");
                e.preventDefault(); 
            }
        }
    });
}
