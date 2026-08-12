const togglePassword = document.getElementById("togglePassword");
const password = document.getElementById("password");

togglePassword.addEventListener("click", function () {

    if (password.type === "password") {
        password.type = "text";

        this.classList.remove("bi-eye");
        this.classList.add("bi-eye-slash");

    } else {
        password.type = "password";

        this.classList.remove("bi-eye-slash");
        this.classList.add("bi-eye");
    }

});