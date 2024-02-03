let sidebarNavLinks = document.querySelectorAll(".nav-item.nav-link");
let body = document.querySelector("body");
let mainSection = document.querySelector(".main-section");
let tabContents = document.querySelectorAll(".tab-contents");

function hideAllTabContents(){
  tabContents.forEach( tabContent => tabContent.style.display = "none")
}

function showTabContents(tabId){
  let element = document.querySelector(`#${tabId}`);
  element.style.display = "grid"
}

hideAllTabContents();

sidebarNavLinks.forEach( link => {

    link.addEventListener('click', () => {
        linkLogic(link)
    });

});

function goToLink(linkSelector){
    let MYlink = document.querySelector(linkSelector);
    linkLogic(MYlink);
}

function linkLogic(link) {

    deactivateActiveLinks();
    link.className = "nav-item nav-link active";
    closeSideBar();
    scrollTop(body);
    scrollTop(mainSection);
    
    let id = link.getAttribute("data-tab");
    hideAllTabContents();
    let currentElement = document.querySelector(`#${id}`);
    currentElement.style.display = "grid";


    console.log(link.getAttribute("data-tab"));

    if(link.getAttribute("data-tab") == "courses"){
        startRefreshingApprovedCourses();
    }

    if(link.getAttribute("data-tab") == "courses"){
        startRefreshingApprovedCourses();
    }

    if(link.getAttribute("data-tab") == "dashboard"){
        getDashboardDetails();
    }
}

function deactivateActiveLinks(){
    sidebarNavLinks.forEach(link => {
        link.className = "nav-item nav-link";
    })

    stopRefreshingApprovedCourses();
}

let refreshApprovedCourses = null;
let isRefreshingApprovedCoursesOn = false;

function startRefreshingApprovedCourses(){
    refreshApprovedCourses = setInterval(() => {
        fetchApprovedCourses(studentId);
        console.log("refreshing...");
    },5000);

    isRefreshingApprovedCoursesOn = true;
}

function stopRefreshingApprovedCourses(){
    if(isRefreshingApprovedCoursesOn){
        clearInterval(refreshApprovedCourses);
        isRefreshingApprovedCoursesOn = false;
        console.log("stopped");
    }
}

let isSideBarOpen = false;
let sidebar = document.querySelector('.sidebar');

let menuIconFlat = document.querySelector(".open-menu");
let menuIconCross = document.querySelector(".close-menu");

function toggleSideBar() {

  if(isSideBarOpen) closeSideBar();
  else openSideBar(); 
}

function closeSideBar(){
    if(isSideBarOpen){
        sidebar.className = "sidebar hidden";
        menuIconFlat.style.display = "block";
        menuIconCross.style.display = "none";
        isSideBarOpen = false;
    }
}

function openSideBar(){
    sidebar.className = "sidebar shown";
    menuIconFlat.style.display = "none";
    menuIconCross.style.display = "block";
    isSideBarOpen = true;
}

function scrollTop(element) {
    element.scrollTop = 0;
}