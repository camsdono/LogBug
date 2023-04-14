var closeBugBtn = document.getElementById("close-bug-btn");
var bugPopup = document.getElementById("bug-display-popup");





function OpenBug(bugID) {
    bugPopup.style.display = "flex";

    var bugTitle = document.getElementById("bug-title");
    var bugStatus = document.getElementById("bug-status");
    var bugDescription = document.getElementById("bug-description");
    var bugPriority = document.getElementById("bug-priority");

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
                
                document.addEventListener('keydown', function(event) {
                    if (event.key === "Escape") {
                        bugPopup.style.display = "none";
                        bugTitle.innerHTML = "Loading... <span id='close-bug-btn' class='close'>&times;</span>";
                        bugStatus.innerHTML = "";
                        bugDescription.innerHTML = "";
                        bugPriority.innerHTML = "";

                    }
                });
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