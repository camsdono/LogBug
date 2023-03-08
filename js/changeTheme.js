const root = document.querySelector(':root');

var lightBackground = "#F4F7FE";
var lightCard = "#FFFFFF";
var ligthText = "#000000";
var whiteLightText = "#FFFFFF";
var lightGrayBackground = "#F4F7FE";
var lightNavHover = "#c5c5c5";

var darkBackground = "#0D1117";
var darkCard = "#161B22";
var darkText = "#d4d4d4";
var whiteDarkText = "#FFFFFF";
var darkGrayBackground = "#464646";
var darkNavHover = "#575757";

if (localStorage.getItem('theme') == 'dark') {
    DarkTheme();
    
} else {
    LightTheme();
}

document.querySelector('.dropdown-toggle').addEventListener('mouseover', function() {
    document.querySelector('.dropdown-menu').style.display = 'flex';
});
document.querySelector('.dropdown-menu').addEventListener('mouseover', function() {
    document.querySelector('.dropdown-menu').style.display = 'flex';
});

document.querySelector('.dropdown-toggle').addEventListener('mouseleave', function() {
    document.querySelector('.dropdown-menu').style.display = 'none';
});

document.querySelector('.dropdown-menu').addEventListener('mouseleave', function() {
    document.querySelector('.dropdown-menu').style.display = 'none';
});

document.querySelector('.color-select').addEventListener('click', function() {
    if (localStorage.getItem('theme') == 'dark') {
        localStorage.setItem('theme', 'light');
        LightTheme()
    } 
    else {
        localStorage.setItem('theme', 'dark');
        DarkTheme()
    }
});

function LightTheme() {
    root.style.setProperty('--main-bg-color', lightBackground);
    root.style.setProperty('--card-bg-color', lightCard);
    root.style.setProperty('--text-color', ligthText);
    root.style.setProperty('--nav-hover-color', lightNavHover);
    root.style.setProperty('--white-text-color', whiteLightText);
    root.style.setProperty('--gray-bg-color', lightGrayBackground);
    color.innerHTML = 'Dark Mode';
}

function DarkTheme() {
    root.style.setProperty('--main-bg-color', darkBackground);
    root.style.setProperty('--card-bg-color', darkCard);
    root.style.setProperty('--text-color', darkText);
    root.style.setProperty('--white-text-color', whiteDarkText);
    root.style.setProperty('--gray-bg-color', darkGrayBackground);
    root.style.setProperty('--nav-hover-color', darkNavHover);
    color.innerHTML = 'Light Mode';
}