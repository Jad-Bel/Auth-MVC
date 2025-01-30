const loginForm = document.querySelector('#loginForm');

loginForm.addEventListener('submit', e => {
    const emailInput = document.getElementById('email').value.trim();
    const passwordInput = document.getElementById('password').value.trim();

    const emailPattern =  /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    const passwordPattern = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;


    if (!emailInput || !passwordInput) {
        e.preventDefault();
        Swal.fire({
            title: "Error!",
            text: "Please fill all required fields",
            icon: "error"
        });
        return;
    }

    if (!emailPattern.test(emailInput)) {
        e.preventDefault();
        Swal.fire({
            title: "Invalid Email!",
            text: "Please enter a valid email address.",
            icon: "error"
        });
        return;
    }

    if (!passwordPattern.test(passwordInput)) {
        e.preventDefault();
        Swal.fire({
            title: "Weak Password!",
            text: "Password must be at least 8 characters long and include an uppercase letter, a number, and a special character.",
            icon: "error"
        });
        return;
    }
});

