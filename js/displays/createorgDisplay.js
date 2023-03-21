var popup = document.getElementById("pop-up");
var main = document.getElementById("main");
var orgbutton = document.getElementById("org-create");
var closebutton = document.getElementsByClassName("close-button")[0];
var nav = document.getElementById("nav");
var orgName = document.getElementsByName("orgName")[0];
var orgDesc = document.getElementsByName("orgDesc")[0];

orgbutton.addEventListener("click", function() {
    popup.style.display = "block";
    main.style.filter = "blur(5px)";
    nav.style.filter = "blur(5px)";
});

closebutton.addEventListener("click", function() {
    popup.style.display = "none";
    main.style.filter = "none";
    nav.style.filter = "none";
    ClearInputs();
});

// When the user clicks anywhere outside of the modal, close it if it is open
window.onclick = function(event) {
    if (event.target == popup) {
        popup.style.display = "none";
        main.style.filter = "none";
        nav.style.filter = "none";
        ClearInputs();
    }
}

// if the user presses escape close the modal
document.addEventListener('keydown', function(event) {
    if (event.key === "Escape") {
        popup.style.display = "none";
        main.style.filter = "none";
        nav.style.filter = "none";
        ClearInputs();
    }
});

function ClearInputs() {
    orgName.value = "";
    orgDesc.value = "";
}