const userDataa = sessionStorage.getItem('user');
let apiKey;

showTabContents("dashboard");
getGeneralApiKey();
setLearningObjectives();


// Check if the user data is present in sessionStorage
// If user data is not present, redirect to index.html
if (!userDataa) {
    window.location.href = '../auth.html';
}  else {
    const user = JSON.parse(sessionStorage.getItem('user'));
         setuserdata(user) ;
}

function setuserdata (user){
    
    let usernamePlaceholders = document.querySelectorAll('#userName');
    let imagePlaceholders = document.querySelectorAll('#userPhoto');
    let image1 = document.querySelectorAll('#userPhotos');
    let names = document.querySelectorAll('#name');
    let email = document.querySelectorAll('#email');
    let phone = document.querySelectorAll('#phone');
    let address = document.querySelectorAll('#address');
    let stdnumber = document.querySelectorAll('#studentno');
     
    usernamePlaceholders.forEach( one => one.innerHTML = 
              `
                <p class="locked-text" data-en='${user.name}' data-tr='${user.name}'></p>
                <p>( Teacher )</p>
              `
    );

    image1.forEach( one => one.src = `../${user.photo}`);
    imagePlaceholders.forEach( one => one.src = `../${user.photo}`);
    stdnumber.forEach(one => one.value = user.stdnumber);
    address.forEach(one => one.value = user.address);
    phone.forEach(one => one.value = user.phone);
    names.forEach(one => one.value = user.name);
    email.forEach(one => one.value = user.email);
  
}

function getGeneralApiKey() {
    $.ajax({
        url: '../api/api.php',
        method: 'POST',
        data: {
        action: 'getGeneralApiKey',
    },
    success: function (response) {
        // Redirect to index.html after successful logout
        apiKey = JSON.parse(response).apiKey;
    },
    error: function (xhr, status, error) {
        // Handle error if necessary
        console.error(error);
        // Redirect to index.html regardless of the API call result
    }
    });
}

// GPT Response:
async function generateResponse_CHATGPT(prompt) {

    const endpoint = 'https://api.openai.com/v1/chat/completions';

    try {

        const response = await fetch( endpoint, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${apiKey}`
            },
            body: JSON.stringify({
                // model: 'gpt-3.5-turbo',
                model: 'gpt-3.5-turbo', // Specify GPT-4 model
                messages: [
                    {
                    role: 'system',
                    content: 'You are a helpful assistant.'
                    },
                    {
                    role: 'user',
                    content: prompt
                    }
                ]
            })
        });

        const data = await response.json();

        // Display the completion response
        console.log('HERE IS DATA FROM GPT: ', data.choices[0].message.content);

        // You can process the response here or display it in the HTML, etc.
        // For this example, we're just logging the output to the console.
        return data.choices[0].message.content;

    } catch (error) {
        console.error('Error fetching response:', error);
        return null;
    }
}
//**************** end gpt response ****************

function logout() {
      // Get the email from sessionStorage
      var email = sessionStorage.getItem('user');

      // Clear user data from session storage
      sessionStorage.clear();

      // Call API to perform logout
      $.ajax({
        url: '../api/api.php',
        method: 'POST',
        data: {
          action: 'logout',
          email: email
        },
        success: function (response) {
          // Redirect to index.html after successful logout
          window.location.href = '../auth.html';
        },
        error: function (xhr, status, error) {
          // Handle error if necessary
          console.error(error);
          // Redirect to index.html regardless of the API call result
          window.location.href = '../auth.html';
        }
      });
}

// JavaScript code to prepopulate form fields when the link is clicked
function generateLectureTitles(){

    let loader = showLoader("Generating Lecture Titles...");

    // // Set the values in the form fields
    courseCode = document.getElementById("courseCodeM").value;
    courseName = document.getElementById("courseNameM").value;

    // for (var i = 0; i < lectures.length; i++) {
    //     document.getElementById("Lecture" + (i + 1)).value = lectures[i];
    // }

    // Asynchronous function to fetch lectures data
    function getLecturesData() {
        //var courseName = "Introduction to Programming";
        var prompt = 'Give me a 14 element comma-separated list of subtopics for the course with title:' + courseName + '. The 9th topic should be "Mid Term Exam" and the 14th topic should be "Final Exam". Format the response as a square bracketed javascript list of strings';

        // Call your asynchronous function to fetch lectures data
        return generateResponse_CHATGPT(prompt);
    }

    // Call the asynchronous function to get lectures data
    getLecturesData()
        .then(function (response) {
        lectures = JSON.parse(response);
        // Set the values in the form fields
        document.getElementById("courseCodeM").value = courseCode;
        document.getElementById("courseNameM").value = courseName;

        for (var i = 0; i < lectures.length; i++) {
            // document.getElementById("Lecture" + (i + 1)).setAttribute('data-en', lectures[i]);
            // document.getElementById("Lecture" + (i + 1)).setAttribute('data-tr', lectures[i]);
            document.getElementById("Lecture" + (i + 1)).textContent = lectures[i];
        }

        setTimeout(() => { 
            removeLoader(loader);
            animateDialog("Course Outline Created successfully.");
        }, 3000);

        })
        .catch(function (error) {
        console.error('Error fetching lectures data:', error);
        });
  
}

function setLearningObjectives(){
    // Asynchronous function to fetch lectures data
    function getSectionsData(prompt) {
        //var courseName = "Introduction to Programming";
        // Call your asynchronous function to fetch lectures data
        return generateResponse_CHATGPT(prompt);
        }
    
    
    
        // Get course ID
        const courseId = sessionStorage.getItem('courseToEdit');//document.getElementById("courseCodeME").value; 
        const form = document.querySelector("#lectures-form");
    
        const checkboxes = form.querySelectorAll("input[type='checkbox']");
        // Get checkboxes and associated input fields
        // const checkboxes = document.querySelectorAll("input[type='checkbox']");
        const inputs = form.querySelectorAll("input[type='text']");
    
        checkboxes.forEach((checkbox, index) => {
    
        checkbox.addEventListener("change", e => {
    
            const input = inputs[index];
            const topicId = "Lecture " + (index + 1);
            const sectionName = input.value;
            let duration = document.querySelector("#Uduration").value;
            duration = duration * 60;
    
            saveData = new FormData();
            saveData.append('courseId', courseId);
            saveData.append('topicId', topicId);
            saveData.append('sectionName', sectionName);
            saveData.append('action', 'saveSection_noUpload');
            saveData.append('duration', duration);
            saveData.append('image', 'coursefiles/generic.png');
    
            delData = new FormData();
            delData.append('courseId', courseId);
            delData.append('topicId', topicId);
            delData.append('sectionName', sectionName);
            delData.append('action', 'deleteSection');
    
            if (checkbox.checked) {
            // Send insert request
            const prompt = 'Give me a proposed list of 18 learning outcomes for the topic: ' + sectionName + '. Format the result as a javascript square bracketed list of lists of strings in which each sublist has 3 elements. Therefore the main bracket should have 6 elements. Please avoid other comments and explanations and give just the requested output.';
            console.log('Details to insert: ', saveData);
    
            // Call the asynchronous function to get lectures data
       /*     showLoadingSpinner('Setting Learning Objectives for ' + sectionName);*/
            getSectionsData(prompt)
                .then(function (response) {
                var Instructions = JSON.parse(response);
                console.log('FIRST: ', Instructions[0]);
    
    
                for (var i = 0; i < Instructions.length; i++) {
                    var instructions = Instructions[i];
                    if (saveData.has('instructions[]')) {
                    // Remove the instructions[] key from saveData
                    saveData.delete('instructions[]');
                    }
                    instructions.forEach(function (instruction, index) {
                    saveData.append('instructions[]', instruction);
                    });
    
    
                    console.log('INSTRUCTION: ', instructions);
                    $.ajax({
                    url: "../api/api.php",
                    method: "POST",
                    data: saveData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        // Handle the response from the server
                        console.log(response);
                        // Additional actions after saving instructions
                        // window.location.href = 'addlearningphase.html';
                    },
                    error: function () {
                        console.error('Failed to save instructions.');
                    },
                    complete: function () {
                        // Hide the loading spinner when the request is complete
                    /*    hideLoadingSpinner();*/
                    }
                    });
    
                }
                })
                .catch(function (error) {
                console.error('Failed to save instructions data:', error);
                });
    
    
    
            } else {
            // Send delete request
            console.log("Details to delete: ", delData);
            $.ajax({
                url: "../api/api.php",
                method: "POST",
                data: delData,
                contentType: false,
                processData: false,
                success: function (response) {
                // Handle the response from the server
                console.log(response);
                // Additional actions after saving instructions
                // window.location.href = 'addlearningphase.html';
                },
                error: function () {
                console.error('Failed to DELETE instructions.');
                },
                complete: function () {
                // Hide the loading spinner when the request is complete
               /* hideLoadingSpinner();*/
                }
            });
            }
    
        });
    
    });
}