let loginContainer = document.querySelector(".login-container");
let signupContainer = document.querySelector(".signup-container");

let studentForm = document.querySelector(".student-form");
let teacherForm = document.querySelector(".teacher-form");

let studentTabButton = document.querySelector(".student-tab-button");
let teacherTabButton = document.querySelector(".teacher-tab-button");

let bubbleMessageContainer = document.querySelector(".bubble-message-container");

let isTeacherOrStudent = "student";

function showSignup(){
    loginContainer.style.display = "none";
    signupContainer.style.display = "grid";
}

function showLogin(){
    loginContainer.style.display = "grid";
    signupContainer.style.display = "none";
}

function showStudentForm(){
    studentForm.style.display = "grid";
    teacherForm.style.display = "none";

    studentTabButton.setAttribute("data-active", "true");
    teacherTabButton.setAttribute("data-active", "false");

    isTeacherOrStudent = "student";
}

function showTeacherForm(){
    studentForm.style.display = "none";
    teacherForm.style.display = "grid";

    studentTabButton.setAttribute("data-active", "false");
    teacherTabButton.setAttribute("data-active", "true");

    isTeacherOrStudent = "teacher";

}

function uniqueID(stregth = 2){
    const date = Date.now();
    const dateReversed = parseInt(String(date).split("").reverse().join(""));
    const base36 = number => (number).toString(36);
    if(stregth == 1) return base36(date);
    if(stregth == -1) return  base36(dateReversed);
    return base36(dateReversed) + base36(date);
}

async function login(){

    let usernameField = document.querySelector("#username-field");
    let passwordField = document.querySelector("#password-field");

    //TODO: Regex test fields
    //TODO: Hash password

    let email = usernameField.value;
    let password = passwordField.value;
    let params = `email=${email}&&`+`password=${password}&&`+`action=login`;

    let callObject = {
        phpFilePath: "api/api.php",
        rejectMessage: "Login Failed",
        params,
        type: "post",
    }

    try {

        let result = await AJAXCall(callObject)
        let _result = JSON.parse(result);

        if (_result.state != "error") {
            sessionStorage.setItem('user', result);
            let { utype } = _result; 

            switch(utype){
                case "Admin":
                case "Teacher":
                    window.location.href="adminPanel/home.php"
                    break;
                case "student":
                    window.location.href="home.php"
                    break;

            }
        }
        else {
            showLoginError();
        }
    }
    catch(error){
        showLoginError();
    }

}

function showLoginError(){
    
    bubbleMessageContainer.textContent = "Wrong Credentials";

    bubbleMessageContainer.style.top = "-100px";

    setTimeout(() => {
        bubbleMessageContainer.style.top = "0%";
    },2000);
}

function bubbleError(errorMessage){
    alert(errorMessage);
}

async function signup(){

    let params;
    let uid = 'U' + uniqueID(1);

    // if(!isPictureChosen()){
    //     bubbleError("Choose an Image");
    //     return;
    // }

    if(isPictureNotChosen()){
        bubbleError("Choose an Image");
        return;
    }
    else if(emptyFields()){
        bubbleError("Fill in all Fields");
        return;
    }

    function isPictureNotChosen(){
        let imageElement = document.querySelector("#chosenPhoto");
        if (imageElement.src === "")
            return true;
        return false;
    }

    function emptyFields(){
        let emptyElements = false;
        return emptyElements;
    }

    let imageInput = document.querySelector("#signupImageInput");
    let { newFileName: photoName } = await uploadFile(imageInput.files[0], "api/upload.php");

    if(!photoName){
        bubbleError("Upload Photo Failed");
        return;
    }

    switch(isTeacherOrStudent){
        case "student":
            signupAsStudent();
            break;
        case "teacher":
            signupAsTeacher();
            break;
    }

    let call = {
        phpFilePath: "api/api.php",
        rejectMessage: "Signup Failed",
        params,
        type: "fetch",
    };

    console.log(call);

    try {
        let result = await AJAXCall(call);
        sessionStorage.setItem('user', result);

        // re-route to login or show success message.

        console.log("done:", result);

    } catch(error) {
        console.error("Signup failed:", error);
    }

    function signupAsStudent(){
        let studentName = document.querySelector("#name");
        let studentNumber = document.querySelector("#stdnumber");
        let studentDepartment = document.querySelector("#department");
        let studentEmail = document.querySelector("#email");
        let studentAddress = document.querySelector("#address");
        let studentPhone = document.querySelector("#phone");
        let studentPassword = document.querySelector("#password");

        let name = studentName.value;
        let studentno = studentNumber.value;
        let department = studentDepartment.value;
        let email = studentEmail.value;
        let address = studentAddress.value;
        let phone = studentPhone.value;
        let password = studentPassword.value;

        params =`action=signup&utype=student` + `&&uid=${uid}` + `&&name=${name}&&` + `studentno=${studentno}` + `&&department=${department}` + `&&email=${email}` + `&&address=${address}` + `&&phone=${phone}` + `&&password=${password}` + `&&photoName=${photoName}`;

    }

    function signupAsTeacher(){
        let teacherName = document.querySelector("#t-name");
        let teacherDepartment = document.querySelector("#t-department");
        let teacherEmail = document.querySelector("#t-email");
        let teacherAddress = document.querySelector("#t-address");
        let teacherPhone = document.querySelector("#t-phone");
        let teacherPassword = document.querySelector("#t-password");

        let name = teacherName.value;
        let department = teacherDepartment.value;
        let email = teacherEmail.value;
        let address = teacherAddress.value;
        let phone = teacherPhone.value;
        let password = teacherPassword.value;
        let teacherID = "TD" + uniqueID(-1); // Genarate random ID number for the teacher.

        params = `uid=${uid}&name=${name}&studentno=${teacherID}&department=${department}&email=${email}&address=${address}&phone=${phone}&password=${password}&photoName=${photoName}&action=signup&utype=Teacher`;

    }
}

