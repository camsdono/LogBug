const loginform = document.getElementById("login-form");
const signupform = document.getElementById("signup-form");
const title = document.getElementById("title");
const loginDetails = document.getElementById("login-detail");

signupform.style.display = "none";

function LoginPage() {
    loginform.style.display = "block";
    signupform.style.display = "none";
    title.innerHTML = "Login";
    loginDetails.innerHTML = "Login";
}

function SignupPage() {
    loginform.style.display = "none";
    signupform.style.display = "block";
    title.innerHTML = "Register";
    loginDetails.innerHTML = "Register";
}