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

var manageNamePopup = document.getElementById("manage-name-popup");
var manageNameButton = document.getElementById("change-name-btn");
var closeName = document.getElementById("close-name-button");

var manageDescPopup = document.getElementById("manage-desc-popup");
var manageDescButton = document.getElementById("change-desc-btn");
var closeDesc = document.getElementById("close-desc-button");

var getJoincodeButton = document.getElementById("get-joincode-btn");
var getJoincodePopup = document.getElementById("get-joincode");
var closeJoincode = document.getElementById("close-joincode-button");


settingsHolder.style.display = "none";
membersHolder.style.display = "none";

var id = 0;



function CheckRole(userID, orgID) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            
            var response = JSON.parse(this.responseText);
            
            if (response.role == "owner") {
                manageNameButton.addEventListener("click", function() {
                    manageNamePopup.style.display = "block";
                });

                
                manageDescButton.addEventListener("click", function() {
                    manageDescPopup.style.display = "block";
                });

                document.addEventListener('keydown', function(event) { 
                    if (event.key === "Escape") {
                        projectPopup.style.display = "none";
                        memberPopup.style.display = "none";
                        manageMemberPopup.style.display = "none";
                        manageNamePopup.style.display = "none";
                        manageDescPopup.style.display = "none";
                        ClearInputs();
                    }
                });
    
                createProjectButton.addEventListener("click", function() {
                    projectPopup.style.display = "block";
                });
    
                closebutton.addEventListener("click", function() {
                    projectPopup.style.display = "none";
                    ClearInputs();
                });
                
                
                closeMember.addEventListener("click", function() {
                    memberPopup.style.display = "none";
                    ClearInputs();
                });
                
                closeName.addEventListener("click", function() {
                    manageNamePopup.style.display = "none";
                });
                
                
                closeManageMember.addEventListener("click", function() {
                    manageMemberPopup.style.display = "none";
                });
                
                closeDesc.addEventListener("click", function() {
                    manageDescPopup.style.display = "none";
                });
            }

            if (response.role == "owner" || response.role == "editor") {
                getJoincodeButton.addEventListener("click", function() {
                    getJoincodePopup.style.display = "block";
                });

                closeJoincode.addEventListener("click", function() {
                    getJoincodePopup.style.display = "none";
                });

                document.addEventListener('keydown', function(event) { 
                    if (event.key === "Escape") {
                        getJoincodePopup.style.display = "none";
                    }
                });
                
            }
        }
    };
    xhttp.open("GET", "../../backend/global/getuserinfo.php?userID=" + userID + "&orgID=" + orgID, true);
    xhttp.send();
}


document.addEventListener('keydown', function(event) {
    if (event.key === "Escape") {
        memberPopup.style.display = "none";
        ClearInputs();
    }
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
    var modalContentText = document.getElementById("member-content-text");
    modalContainer.style.display = "block";
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            
            var response = JSON.parse(this.responseText);
            var capitalRole = response.role.charAt(0).toUpperCase() + response.role.slice(1);

            var htmlToInsert = "Current Role: " + capitalRole + "<br><br><select class='select' id='role-select' name='role-select'><option value='member'>Member</option><option value='editor'>Editor</option><option value='owner'>Owner</option></select><br><br><button onclick='ChangeRole("+ userID + "," + orgID + ")'>Update Role</button>";

            setTimeout(function(){
                modalContentText.innerHTML = htmlToInsert;
            }, 500);
        } else {
            modalContentText.innerHTML = "Loading...";
        }
    };
    xhttp.open("GET", "../../backend/global/getuserinfo.php?userID=" + userID + "&orgID=" + orgID, true);
    xhttp.send();
}

function ChangeRole(userID, orgID) {
    var role = document.getElementById("role-select").value;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var response = JSON.parse(this.responseText);
            if (role ==  "member" || role == "editor") {
                manageMemberButton.style.display = "none";
            }
            location.reload();
        }
    };
    xhttp.open("GET", "../../backend/global/changerole.php?userID=" + userID + "&orgID=" + orgID + "&role=" + role, true);
    xhttp.send();
}