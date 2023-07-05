var closeBugBtn = document.getElementById("close-bug-btn");
var bugPopup = document.getElementById("bug-display-popup");

function OpenBug(bugID) {
    
    bugPopup.style.display = "flex";

    var bugTitle = document.getElementById("bug-title");
    var bugStatus = document.getElementById("bug-status");
    var bugDescription = document.getElementById("bug-description");
    var bugPriority = document.getElementById("bug-priority");

    var buttonHolder = document.getElementById("button-holder");

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
           
            
            var response = JSON.parse(this.responseText);
            var capitalName = response.bugName.charAt(0).toUpperCase() + response.bugName.slice(1);
            var capitalDescription = response.bugDesc.charAt(0).toUpperCase() + response.bugDesc.slice(1);
            var capitalPriority = response.priority.charAt(0).toUpperCase() + response.priority.slice(1);
           
            if (response.closedBug == "0") {
                var capitalStatus = "Open";
            } else {
                var capitalStatus = "Closed";
            }

           

            setTimeout(function() {
                // bug info
                bugTitle.innerHTML = capitalName + " <span id='close-bug-btn' class='close'>&times;</span>";
                bugStatus.innerHTML = "Bug Status: " + capitalStatus;
                bugDescription.innerHTML = "Bug Description: " + capitalDescription;
                bugPriority.innerHTML = "Bug Priority: " + capitalPriority;
                closeBugBtn = document.getElementById("close-bug-btn");
                bugPopup = document.getElementById("bug-display-popup");

                closeBugBtn.addEventListener("click", function() {
                    bugPopup.style.display = "none";
                    bugTitle.innerHTML = "Loading... <span id='close-bug-btn' class='close'>&times;</span>";
                    bugStatus.innerHTML = "";
                    bugDescription.innerHTML = "";
                    bugPriority.innerHTML = "";
                });

                // Page Switching
                var generalbtn = document.getElementById("general-btn");
                var membersbtn = document.getElementById("members-btn");
    
                var generalpage = document.getElementById("general-page");
                var memberspage = document.getElementById("members-page");

                var settingsbtn = document.getElementById("bug-settings");
                var settingspage = document.getElementById("bug-settings-page");

                membersbtn.addEventListener("click", function() {
                    generalpage.style.display = "none";
                    memberspage.style.display = "block";
                    settingspage.style.display = "none";
                });

                generalbtn.addEventListener("click", function() {
                    generalpage.style.display = "block";
                    memberspage.style.display = "none";
                    settingspage.style.display = "none";
                });

                settingsbtn.addEventListener("click", function() {
                    generalpage.style.display = "none";
                    memberspage.style.display = "none";
                    settingspage.style.display = "block";
                });

                // close bug
                
                document.addEventListener('keydown', function(event) {
                    if (event.key === "Escape") {
                        var updatePriorityPopUp = document.getElementById("update-bug-priorty-popup");
                        if (updatePriorityPopUp.style.display == "block") {
                            CloseUpdatePriorityPopUp();
                        } else {
                            bugPopup.style.display = "none";
                        }
                        bugTitle.innerHTML = "Loading... <span id='close-bug-btn' class='close'>&times;</span>";
                        bugStatus.innerHTML = "";
                        bugDescription.innerHTML = "";
                        bugPriority.innerHTML = "";

                    }
                });

                buttonHolder.style.display = "block";
            }, 500);

        } else {
            bugTitle.innerHTML = "Loading... <span id='close-bug-btn' class='close'>&times;</span>";
            closeBugBtn = document.getElementById("close-bug-btn");
            bugPopup = document.getElementById("bug-display-popup");

            closeBugBtn.addEventListener("click", function() {
                bugPopup.style.display = "none";
            });
            
            document.addEventListener('keydown', function(event) {
                if (event.key === "Escape") {
                    bugPopup.style.display = "none";
                }
            });
        }
    };
    xhttp.open("GET", "../../backend/global/getbuginfo.php?bugID=" + bugID, true);
    xhttp.send();
}

window.addEventListener('load', function() {
    var pageReloaded = localStorage.getItem('assignBug');
    var bugID = localStorage.getItem('bugID');

    if (pageReloaded) {
        // Clear the flag
        localStorage.removeItem('assignBug');
        localStorage.removeItem('bugID');
        
        // Call your function here
        OpenBug(bugID);
    }
});

function assignUserBug(bugID) {
    var userID = document.getElementById("assign-user-input").value;

    if (userID == "") {
        alert("Please enter either a email or username.");
        return;
    } else {
        var xhttp = new XMLHttpRequest();
        xhttp.open("GET", "../../backend/global/assignuserbug.php?bugID=" + bugID + "&userID=" + userID, true);
        xhttp.send();
    
        setTimeout(function() {
            localStorage.setItem('assignBug', 'true');
            localStorage.setItem('bugID', bugID);
            
            location.reload();
        }
        , 500);
    }

    
}

function CloseOpenBug(status, bugID) {
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", "../../backend/global/closeopenbug.php?bugID=" + bugID + "&status=" + status, true);
    xhttp.send();

    setTimeout(function() {
        localStorage.setItem('assignBug', 'true');
        localStorage.setItem('bugID', bugID);
        location.reload();
    }
    , 500);
}

function OpenUpdatePriorityPopUp() {
    var updatePriorityPopUp = document.getElementById("update-bug-priorty-popup");
    var bugPopUp = document.getElementById("bug-display-popup");
    bugPopUp.style.zIndex = 0;
    updatePriorityPopUp.style.zIndex = 1;
    updatePriorityPopUp.style.display = "block";
}

function CloseUpdatePriorityPopUp() {
    var updatePriorityPopUp = document.getElementById("update-bug-priorty-popup");
    updatePriorityPopUp.style.display = "none";
}  

function UpdateNameOpen() {
    var updateNamePopUp = document.getElementById("update-bug-name-popup");
    var bugPopUp = document.getElementById("bug-display-popup");
    bugPopUp.style.zIndex = 0;
    updateNamePopUp.style.zIndex = 1;
    updateNamePopUp.style.display = "block";
}

function UpdateNameClose() {
    var updateNamePopUp = document.getElementById("update-bug-name-popup");
    updateNamePopUp.style.display = "none";
}

function UpdateDescriptionOpen() {
    var updateDescriptionPopUp = document.getElementById("update-bug-desc-popup");
    var bugPopUp = document.getElementById("bug-display-popup");
    bugPopUp.style.zIndex = 0;
    updateDescriptionPopUp.style.zIndex = 1;
    updateDescriptionPopUp.style.display = "block";
}

function UpdateDescriptionClose() {
    var updateDescriptionPopUp = document.getElementById("update-bug-desc-popup");
    updateDescriptionPopUp.style.display = "none";
}

function OpenDeleteBug() {
    var deleteBugPopUp = document.getElementById("delete-bug-popup");
    var bugPopUp = document.getElementById("bug-display-popup");
    bugPopUp.style.zIndex = 0;
    deleteBugPopUp.style.zIndex = 1;
    deleteBugPopUp.style.display = "block";
}

function DeleteBug(bugID, userID) {
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", "../../backend/global/deletebug.php?bugID=" + bugID + "&userID=" + userID, true);
    xhttp.send();

    setTimeout(function() {
        location.reload();
    }
    , 500);
}

function CancelDeleteBug() {
    var deleteBugPopUp = document.getElementById("delete-bug-popup");
    deleteBugPopUp.style.display = "none";
}

function CreateBugOpen() {
    var createBugPopUp = document.getElementById("create-bug-popup");
    createBugPopUp.style.display = "block";
}

function CreateBugClose() {
    var createBugPopUp = document.getElementById("create-bug-popup");
    createBugPopUp.style.display = "none";
}

function CancelDeleteProject() {
    var deleteProjectPopUp = document.getElementById("delete-project-popup");
    deleteProjectPopUp.style.display = "none";
}

function OpenDeleteProject() {
    var deleteProjectPopUp = document.getElementById("delete-project-popup");
    deleteProjectPopUp.style.display = "block";
}

function DeleteProject(projectID, orgID) {
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", "../../backend/global/deleteproject.php?projectID=" + projectID + "&orgID=" + orgID, true);
    xhttp.send();

    setTimeout(function() {
        location.href = "../../components/displays/orgdisplay.php?id=" + orgID;
    }
    , 500);
}

function OpenProjectSettings() {
    var projectSettingsPopUp = document.getElementById("project-settings-page");
    var projectBugsPopUp = document.getElementById("project-bugs-popup");
    projectSettingsPopUp.style.display = "flex";
    projectBugsPopUp.style.display = "none";
}

function OpenProjectBugs() {
    var projectBugsPopUp = document.getElementById("project-bugs-popup");
    var projectSettingsPopUp = document.getElementById("project-settings-page");
    projectBugsPopUp.style.display = "flex";
    projectSettingsPopUp.style.display = "none";
}

function OpenGetAPIKey() {
    var getAPIKeyPopUp = document.getElementById("get-api-key-popup");
    getAPIKeyPopUp.style.display = "block";
}

function CancelgetAPI() {   
    var getAPIKeyPopUp = document.getElementById("get-api-key-popup");
    getAPIKeyPopUp.style.display = "none";
}