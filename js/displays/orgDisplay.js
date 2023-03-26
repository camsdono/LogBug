var projectHolder = document.getElementById("project-holder");
var settingsHolder = document.getElementById("settings-holder");
var settingsButton = document.getElementById("settings-button");
var membersButton = document.getElementById("members-button");
var projectButton = document.getElementById("project-button");
var membersHolder = document.getElementById("members-holder");

settingsHolder.style.display = "none";
membersHolder.style.display = "none";


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