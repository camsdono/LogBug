var projectHolder = document.getElementById("project-holder");
var settingsHolder = document.getElementById("settings-holder");
var settingsButton = document.getElementById("settings-button");
var membersButton = document.getElementById("members-button");
var projectButton = document.getElementById("project-button");
var membersHolder = document.getElementById("members-holder");
var createProjectButton = document.getElementById("create-project");
var manageMemberButton = document.getElementById("manage-member-button");
var projectName = document.getElementsByName("projectName")[0];
var projectDesc = document.getElementsByName("projectDesc")[0];
var projectPopup = document.getElementById("create-project-window");
var closebutton = document.getElementById("close-project-button");
var closeMember = document.getElementById("close-member-button");
var closeManageMember = document.getElementById("close-manage-member-button");
var memberPopup = document.getElementById("modal-container");
var manageMemberPopup = document.getElementById("manage-member-popup");
var memberPopup = document.getElementById("modal-container");


settingsHolder.style.display = "none";
membersHolder.style.display = "none";

var id = 0;

closebutton.addEventListener("click", function() {
    projectPopup.style.display = "none";
    ClearInputs();
});

closeMember.addEventListener("click", function() {
    memberPopup.style.display = "none";
    ClearInputs();
});


closeManageMember.addEventListener("click", function() {
    manageMemberPopup.style.display = "none";
});

window.onclick = function(event) {
    if (event.target == projectPopup) {
        projectPopup.style.display = "none";
        ClearInputs();
    }

    if (event.target == memberPopup) {
        memberPopup.style.display = "none";
    }

    if (event.target == manageMemberPopup) {
        manageMemberPopup.style.display = "none";
    }
}


document.addEventListener('keydown', function(event) {
    if (event.key === "Escape") {
        projectPopup.style.display = "none";
        memberPopup.style.display = "none";
        manageMemberPopup.style.display = "none";
        ClearInputs();
    }
});


createProjectButton.addEventListener("click", function() {
    projectPopup.style.display = "block";
});



settingsButton.addEventListener("click", function() {
    settingsHolder.style.display = "flex";
    projectHolder.style.display = "none";
    membersHolder.style.display = "none";
});

membersButton.addEventListener("click", function() {
    settingsHolder.style.display = "none";
    projectHolder.style.display = "none";
    membersHolder.style.display = "flex";
});

projectButton.addEventListener("click", function() {
    settingsHolder.style.display = "none";
    projectHolder.style.display = "flex";
    membersHolder.style.display = "none";
});

function ClearInputs() {
    projectName.value = "";
    projectDesc.value = "";
}

function showModal(userID, orgID) {
    var modalContainer = document.getElementById("modal-container");
    var modalContent = document.getElementById("modal-content-text");
    modalContainer.style.display = "block";
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            var response = JSON.parse(this.responseText);
            var capitalRole = response.role.charAt(0).toUpperCase() + response.role.slice(1);
            var capitalName = response.name.charAt(0).toUpperCase() + response.name.slice(1);
            var capitalEmail = response.email.charAt(0).toUpperCase() + response.email.slice(1);
            modalContent.innerHTML = "Name: " + capitalName + "<br>Email: " + capitalEmail + "<br>Role: " + capitalRole;

        }
    };
    xhttp.open("GET", "../../backend/global/getuserinfo.php?userID=" + userID + "&orgID=" + orgID, true);
    xhttp.send();
}

function ManageMemberPopup(userID, orgID) {
    var modalContainer = document.getElementById("manage-member-popup");
    var modalContent = document.getElementById("manage-member-content");
    modalContainer.style.display = "block";
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            var response = JSON.parse(this.responseText);
            var capitalRole = response.role.charAt(0).toUpperCase() + response.role.slice(1);
            var capitalName = response.name.charAt(0).toUpperCase() + response.name.slice(1);
            var capitalEmail = response.email.charAt(0).toUpperCase() + response.email.slice(1);
            modalContent.innerHTML = "Name: " + capitalName + "<br>Email: " + capitalEmail + "<br>Role: " + capitalRole;

        }
    };
    xhttp.open("GET", "../../backend/global/getuserinfo.php?userID=" + userID + "&orgID=" + orgID, true);
    xhttp.send();
}