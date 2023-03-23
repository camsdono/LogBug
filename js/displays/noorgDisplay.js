var noOrgHolder = document.getElementById("no-org-holder");
var noOrg = document.getElementById("no-org");
var popup = document.getElementById("pop-up");
var main = document.getElementById("main");
var closebutton = document.getElementsByClassName("close-button")[0];
var nav = document.getElementById("nav");
var orgName = document.getElementsByName("orgName")[0];
var orgDesc = document.getElementsByName("orgDesc")[0];


noOrg.addEventListener("click", function() {
    popup.style.display = "block";
    main.style.filter = "blur(5px)";
    nav.style.filter = "blur(5px)";
    noOrgHolder.style.display = "blur(5px)";
});

closebutton.addEventListener("click", function() {
    popup.style.display = "none";
    main.style.filter = "none";
    nav.style.filter = "none";
    noOrgHolder.style.display = "none";
    ClearInputs();
});

// When the user clicks anywhere outside of the modal, close it if it is open
window.onclick = function(event) {
    if (event.target == popup) {
        popup.style.display = "none";
        main.style.filter = "none";
        nav.style.filter = "none";
        noOrgHolder.style.display = "none";
        ClearInputs();
    }
}

// if the user presses escape close the modal
document.addEventListener('keydown', function(event) {
    if (event.key === "Escape") {
        popup.style.display = "none";
        main.style.filter = "none";
        nav.style.filter = "none";
        noOrgHolder.style.display = "none";
        ClearInputs();
    }
});

function ClearInputs() {
    orgName.value = "";
    orgDesc.value = "";
}