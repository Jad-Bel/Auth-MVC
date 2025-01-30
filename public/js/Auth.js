console.log(1)

const form = document.querySelector('form');

form.addEventListener('submit', e => {         
    const userNameInput = document.getElementById('username').value.trim();
    const emailInput = document.getElementById('email').value.trim();
    const passwordInput = document.getElementById('password').value.trim();

    const userNamePattern = /^[a-zA-Z0-9_]{5,20}$/;
    const emailPattern =  /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    const passwordPattern = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;


    if (!userNameInput || !emailInput || !passwordInput) {
        e.preventDefault();
        Swal.fire({
            title: "Error!",
            text: "Please fill all required fields",
            icon: "error"
        });
        return;
    }

    if (!userNamePattern.test(userNameInput)) {
        e.preventDefault();
        Swal.fire({
            title: "Invalid Username!",
            text: "Username must be 5-20 characters and can only contain letters, numbers, and underscores (_).",
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
})
