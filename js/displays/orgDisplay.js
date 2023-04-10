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

var LeaveOrgbutton = document.getElementById("leave-org-btn");
var LeaveOrgPopup = document.getElementById("leave-org-popup");
var closeLeaveOrg = document.getElementById("close-leave-org-button");

var ConfirmLeaveOrgButton = document.getElementById("confirm-leave-org-btn");
var CancelLeaveOrgButton = document.getElementById("cancel-leave-org-btn");

var DeleteOrgButton = document.getElementById("delete-org-btn");
var DeleteOrgPopup = document.getElementById("delete-org-popup");
var closeDeleteOrg = document.getElementById("close-delete-org-button");

var ConfirmDeleteOrgButton = document.getElementById("confirm-delete-org-btn");
var CancelDeleteOrgButton = document.getElementById("cancel-delete-org-btn");


settingsHolder.style.display = "none";
membersHolder.style.display = "none";

var id = 0;



function CheckRole(userID, orgID) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            function ClearInputs() {
                projectName.value = "";
                projectDesc.value = "";
            }
            
            var response = JSON.parse(this.responseText);
            
            if (response.role == "owner") {
                manageNameButton.addEventListener("click", function() {
                    manageNamePopup.style.display = "block";
                });

                
                manageDescButton.addEventListener("click", function() {
                    manageDescPopup.style.display = "block";
                });

                DeleteOrgButton.addEventListener("click", function() {
                    DeleteOrgPopup.style.display = "block";
                });

                document.addEventListener('keydown', function(event) { 
                    if (event.key === "Escape") {
                        projectPopup.style.display = "none";
                        memberPopup.style.display = "none";
                        manageMemberPopup.style.display = "none";
                        manageNamePopup.style.display = "none";
                        manageDescPopup.style.display = "none";
                        DeleteOrgPopup.style.display = "none";
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

                closeDeleteOrg.addEventListener("click", function() {
                    DeleteOrgPopup.style.display = "none";
                });

                CancelDeleteOrgButton.addEventListener("click", function() {
                    DeleteOrgPopup.style.display = "none";
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

                ConfirmDeleteOrgButton.addEventListener("click", function() {
                    DeleteOrg(userID, orgID);
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

            if (response.role == "editor" || response.role == "member") {
                LeaveOrgbutton.addEventListener("click", function() {
                    LeaveOrgPopup.style.display = "block";
                });

                closeLeaveOrg.addEventListener("click", function() {
                    LeaveOrgPopup.style.display = "none";
                });

                CancelLeaveOrgButton.addEventListener("click", function() {
                    LeaveOrgPopup.style.display = "none";
                });

                ConfirmLeaveOrgButton.addEventListener("click", function() {
                    LeaveOrg(userID, orgID);
                });

                closeMember.addEventListener("click", function() {
                    memberPopup.style.display = "none";
                });

                document.addEventListener('keydown', function(event) {
                    if (event.key === "Escape") {
                        LeaveOrgPopup.style.display = "none";
                    }
                });
            }
        }
    };
    xhttp.open("GET", "../../backend/global/getuserinfo.php?userID=" + userID + "&orgID=" + orgID, true);
    xhttp.send();
}


function LeaveOrg(userID, orgID) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            window.location.href = "../../components/root/organization.php";
        }
    };
    xhttp.open("POST", "../../backend/global/leaveorg.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("userID=" + userID + "&orgID=" + orgID);
}

function DeleteOrg(userID, orgID) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            window.location.href = "../../components/root/organization.php";
        }
    };
    xhttp.open("POST", "../../backend/global/deleteorg.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("userID=" + userID + "&orgID=" + orgID);
}


document.addEventListener('keydown', function(event) {
    if (event.key === "Escape") {
        memberPopup.style.display = "none";
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

            setTimeout(function() {
            modalContent.innerHTML = "Name: " + capitalName + "<br>Email: " + capitalEmail + "<br>Role: " + capitalRole;
            }, 500);

        } else {
            modalContent.innerHTML = "Loading...";
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

            var htmlToInsert = "Current Role: " + capitalRole + "<br><br><select class='select' id='role-select' name='role-select'><option value='member'>Member</option><option value='editor'>Editor</option><option value='owner'>Owner</option></select><br><br><button class='edit-member-btn' onclick='ChangeRole("+ userID + "," + orgID + ")'>Update Role</button>";

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
            if (response.role != "owner") {
                var xhttp1 = new XMLHttpRequest();
                xhttp1.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var response = JSON.parse(this.responseText);
                        if (role ==  "member" || role == "editor") {
                            manageMemberButton.style.display = "none";
                        }
                    }
                };
                xhttp1.open("GET", "../../backend/global/changerole.php?userID=" + userID + "&orgID=" + orgID + "&role=" + role, true);
                xhttp1.send();
                
            } else {
                alert("You cannot change the role of the owner");
            }
        }
    };
    xhttp.open("GET", "../../backend/global/getuserinfo.php?userID=" + userID + "&orgID=" + orgID, true);
    xhttp.send();
}

function OpenProject(projectID) {
    window.location.href = "../../components/root/project.php?projectID=" + projectID;
}