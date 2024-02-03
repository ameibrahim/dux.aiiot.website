// Fetch questions from PHP endpoint
let questionData;
let fileName;

function fetchQuestions() {
    var courseCode = $("#courseCode").val();
    var examType = $("#examType").val();
    var fileName = courseCode + " " + examType;

    // Define the action and other necessary parameters
    var action = "getquestions";


    // Create a new XMLHttpRequest object
    var xhr = new XMLHttpRequest();

    // Set up the request
    xhr.open("POST", "questions.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // Define the request parameters
    var params = "action=" + encodeURIComponent(action) + "&fileName=" + encodeURIComponent(fileName);

    console.log("EXAM FILE: ",fileName);
    // Handle the response
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Handle the successful response
                var response = JSON.parse(xhr.responseText);
                console.log("RESPONSE FROM QUESTIONS FETCH: ",response);
                displayQuestions(response);
            } else {
                // Handle the error response
                console.error("Error: " + xhr.status);
            }
        }
    };

    // Send the request
    xhr.send(params);
}

  
  // scripts.js
  
  // Function to fetch questions from the server
  function fetchQuestionss() {
    var courseCode = $("#courseCode").val();
    var examType = $("#examType").val();
    
    // Concatenate course code and exam type to get the file name
    var fileName = courseCode + ' ' + examType;
    console.log("FILENAME: ", fileName);
    
    // Use fetch to get questions from the server
    fetch('questions.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            action: 'getquestions',
            fileName: fileName,
        }),
    })
        .then(response => response.json())
        .then(data => displayQuestions(data))
        .catch(error => console.error('Error fetching questions:', error));
    
    
    }
    
    // Function to display questions in the list group
    function displayQuestions(questions) {
      const questionList = document.getElementById('questionList');
      const questionDetails = document.getElementById('questionDetails');
      questionData = questions;
      console.log("QUESTION DATA: ",questionData);
      // Clear the existing list
      questionList.innerHTML = '';
      questionDetails.innerHTML = '';
    
      // Iterate through topics and questions
      for (const topic in questions) {
        const topicItem = document.createElement('div');
        topicItem.className = 'list-group-item list-group-item-dark';
        topicItem.textContent = topic;
    
        questionList.appendChild(topicItem);
    
        questions[topic].forEach((question, index) => {
          const listItem = document.createElement('a');
          listItem.href = '#';
          listItem.className = 'list-group-item list-group-item-action';
          listItem.textContent = `Question ${index + 1}`;
          listItem.addEventListener('click', () => showQuestionDetails(question));
          questionList.appendChild(listItem);
        });
      }
    }
    
    // Function to show question details in the modal
    function showQuestionDetails(question) {
      const questionDetails = document.getElementById('questionDetails');
      questionDetails.innerHTML = '';
  
      // Create elements to display question details
      const questionTitle = document.createElement('h4');
      questionTitle.textContent = question.question;
  
      const questionType = document.createElement('p');
      questionType.textContent = `Type: ${question.type}`;
  
      const questionAnswer = document.createElement('p');
      questionAnswer.textContent = `Answer: ${question.answer}`;
  
    // Append question details to the modal
    questionDetails.appendChild(questionTitle);
    questionDetails.appendChild(questionType);
      // Display options for MCQ questions
      if (question.type === 'mcq') {
          const optionsTitle = document.createElement('p');
          optionsTitle.textContent = 'Options:';
  
          const optionsList = document.createElement('ul');
          question.options.forEach(option => {
              const optionItem = document.createElement('li');
              optionItem.textContent = option;
              optionsList.appendChild(optionItem);
          });
  
          questionDetails.appendChild(optionsTitle);
          questionDetails.appendChild(optionsList);
      }
  

      questionDetails.appendChild(questionAnswer);
  
      // Add buttons for CRUD operations
      const editButton = document.createElement('button');
      editButton.textContent = 'Edit';
      editButton.className = 'btn btn-warning mr-2';
      editButton.addEventListener('click', () => editQuestion(question));
  
      const deleteButton = document.createElement('button');
      deleteButton.textContent = 'Delete';
      deleteButton.className = 'btn btn-danger mr-2';
      deleteButton.addEventListener('click', () => deleteQuestion(question));
  
      const createButton = document.createElement('button');
      createButton.textContent = 'Create';
      createButton.className = 'btn btn-success mr-2';
      createButton.addEventListener('click', () => createQuestion());
  
      // Append buttons to the modal
      questionDetails.appendChild(editButton);
      questionDetails.appendChild(deleteButton);
      questionDetails.appendChild(createButton);
  }
  
  
  // Function to create a new question
  // Function to create a new question
function createQuestion() {
    // Create a form for creating a new question
    const createForm = document.createElement('form');
    createForm.classList.add('container'); // Add Bootstrap container class for spacing

    // Create label and input for the question
    const questionLabel = document.createElement('label');
    questionLabel.textContent = 'Question:';
    questionLabel.htmlFor = 'questionInput';
    
    const questionInput = document.createElement('input');
    questionInput.type = 'text';
    questionInput.placeholder = 'Enter the question';
    questionInput.id = 'questionInput';
    questionInput.classList.add('form-control', 'mb-2'); // Add Bootstrap form-control class and margin-bottom
    
    // Create label and input for the answer
    const answerLabel = document.createElement('label');
    answerLabel.textContent = 'Answer:';
    answerLabel.htmlFor = 'answerInput';
    
    const answerInput = document.createElement('input');
    answerInput.type = 'text';
    answerInput.placeholder = 'Enter the answer';
    answerInput.id = 'answerInput';
    answerInput.classList.add('form-control', 'mb-2'); // Add Bootstrap form-control class and margin-bottom
    
    // Create label and select for the question type
    const typeLabel = document.createElement('label');
    typeLabel.textContent = 'Question Type:';
    typeLabel.htmlFor = 'typeSelect';
    
    const typeSelect = document.createElement('select');
    typeSelect.id = 'typeSelect';
    typeSelect.classList.add('form-select', 'mb-2'); // Add Bootstrap form-select class and margin-bottom
    typeSelect.innerHTML = `
        <option value="">Select type</option>
        <option value="mcq">MCQ</option>
        <option value="fill-blank">Fill in the Blank</option>
        <option value="free-response">Free Response</option>
    `;
    
    // Create label and select for the topic
    const topicLabel = document.createElement('label');
    topicLabel.textContent = 'Topic:';
    topicLabel.htmlFor = 'topicSelect';
    
    const topicSelect = document.createElement('select');
    topicSelect.id = 'topicSelect';
    topicSelect.classList.add('form-select', 'mb-2'); // Add Bootstrap form-select class and margin-bottom
    topicSelect.innerHTML = `
        <option value="" disabled selected>Select or Enter Topic</option>
    `;
    
 
    
    // Populate the topic dropdown with existing topics
    fetchQuestions(); // Make sure to fetch questions first

    const topics = Object.keys(questionData);
    topics.forEach(topic => {
        const option = document.createElement('option');
        option.value = topic;
        option.textContent = topic;
        topicSelect.appendChild(option);
    });

    // Create an input field for entering a new topic
    const newTopicInput = document.createElement('input');
    newTopicInput.type = 'text';
    newTopicInput.placeholder = 'Enter New Topic';
    newTopicInput.style.display = 'none'; // Initially hide the input field

    // Show/hide the input field based on the selected option
    topicSelect.addEventListener('change', () => {
        newTopicInput.style.display = (topicSelect.value === '') ? 'block' : 'none';
    });

    // Create a div for options (for MCQ questions)
    const optionsDiv = document.createElement('div');
    optionsDiv.style.display = 'none'; // Initially hide the options div

    // Create input fields for options
    const optionsInput = document.createElement('textarea');
    optionsInput.placeholder = 'Enter options (one per line)';
    optionsInput.rows = 4;

    // Show the options div if the selected type is MCQ
    typeSelect.addEventListener('change', () => {
        optionsDiv.style.display = (typeSelect.value === 'mcq') ? 'block' : 'none';
    });

    // Create a save button for creating the question
    const saveButton = document.createElement('button');
    saveButton.textContent = 'Save';
    saveButton.className = 'btn btn-success';
    saveButton.addEventListener('click', () => {
        const selectedTopic = (topicSelect.value === '') ? newTopicInput.value.trim() : topicSelect.value.trim();
        if (selectedTopic !== '') {
            const newQuestion = {
                question: questionInput.value,
                answer: answerInput.value,
                type: typeSelect.value,
                options: (typeSelect.value === 'mcq') ? optionsInput.value.split('\n').filter(option => option.trim() !== '') : undefined
            };
            saveCreatedQuestion(newQuestion, selectedTopic);
        } else {
            alert('Please select or enter a topic for the question.');
        }
    });

    // Append input fields, dropdowns, and save button to the form
    createForm.appendChild(questionLabel)
    createForm.appendChild(questionInput);
    createForm.appendChild(answerLabel)
    createForm.appendChild(answerInput);
    createForm.appendChild(typeLabel)
    createForm.appendChild(typeSelect);
    createForm.appendChild(topicSelect);
    createForm.appendChild(newTopicInput);
    createForm.appendChild(optionsDiv);
    optionsDiv.appendChild(optionsInput);
    createForm.appendChild(saveButton);



    // Display the form in the modal
    const questionDetails = document.getElementById('questionDetails');
    questionDetails.innerHTML = '';
    questionDetails.appendChild(createForm);
}

    
  //   // Function to edit a question
  //   function editQuestion(question) {
  //     // Implement edit functionality (e.g., show a form with existing values)
  //     alert('Edit functionality not implemented yet.');
  //   }
    
  //   // Function to delete a question
  //   function deleteQuestion(question) {
  //     // Implement delete functionality (e.g., show a confirmation dialog)
  //     const confirmation = confirm('Are you sure you want to delete this question?');
  //     if (confirmation) {
  //       alert('Delete functionality not implemented yet.');
  //     }
  //   }
    
  
  
  // Function to edit a question
  // function editQuestion(question) {
  //     // Create a form for editing
  //     const editForm = document.createElement('form');
  
  //     // Create input fields for question and answer
  //     const questionInput = document.createElement('input');
  //     questionInput.type = 'text';
  //     questionInput.value = question.question;
  
  //     const answerInput = document.createElement('input');
  //     answerInput.type = 'text';
  //     answerInput.value = question.answer;
  
  //     // Create a save button
  //     const saveButton = document.createElement('button');
  //     saveButton.textContent = 'Save';
  //     saveButton.className = 'btn btn-success';
  //     saveButton.addEventListener('click', () => saveEditedQuestion(question, questionInput.value, answerInput.value));
  
  //     // Append input fields and save button to the form
  //     editForm.appendChild(questionInput);
  //     editForm.appendChild(answerInput);
  //     editForm.appendChild(saveButton);
  
  //     // Display the form in the modal
  //     const questionDetails = document.getElementById('questionDetails');
  //     questionDetails.innerHTML = '';
  //     questionDetails.appendChild(editForm);
  // }
  
  // Function to edit a question
  function editQuestion(question) {
      // Create a form for editing
      const editForm = document.createElement('form');
      editForm.classList.add('container'); // Add Bootstrap container class for spacing
      
      // Create label and input for the question
      const questionLabel = document.createElement('label');
      questionLabel.textContent = 'Question:';
      questionLabel.htmlFor = 'editQuestionInput';
      
      const questionInput = document.createElement('input');
      questionInput.type = 'text';
      questionInput.id = 'editQuestionInput';
      questionInput.placeholder = 'Enter the question';
      questionInput.value = question.question;
      questionInput.classList.add('form-control', 'mb-2'); // Add Bootstrap form-control class and margin-bottom
      
      // Create label and input for the answer
      const answerLabel = document.createElement('label');
      answerLabel.textContent = 'Answer:';
      answerLabel.htmlFor = 'editAnswerInput';
      
      const answerInput = document.createElement('input');
      answerInput.type = 'text';
      answerInput.id = 'editAnswerInput';
      answerInput.placeholder = 'Enter the answer';
      answerInput.value = question.answer;
      answerInput.classList.add('form-control', 'mb-2'); // Add Bootstrap form-control class and margin-bottom
      
      // Create label and textarea for options (for MCQ questions)
      let optionsLabel, optionsInput;
      if (question.type === 'mcq') {
          optionsLabel = document.createElement('label');
          optionsLabel.textContent = 'Options:';
          optionsLabel.htmlFor = 'editOptionsInput';
      
          optionsInput = document.createElement('textarea');
          optionsInput.rows = 4;
          optionsInput.id = 'editOptionsInput';
          optionsInput.value = question.options.join('\n');
          optionsInput.classList.add('form-control', 'mb-2'); // Add Bootstrap form-control class and margin-bottom
      }
      
      // Create a save button
      const saveButton = document.createElement('button');
      saveButton.textContent = 'Save';
      saveButton.className = 'btn btn-success';

      saveButton.addEventListener('click', () => {
          const newQuestion = {
              question: questionInput.value,
              answer: answerInput.value,
              type: question.type
              // options: (optionsInput) ? optionsInput.value.split('\n').filter(option => option.trim() !== '') : undefined
              //options: (optionsInput && optionsInput.value.split('\n')) || question.options
          };
          if(question.type==='mcq'){
            newQuestion.options=(optionsInput) ? optionsInput.value.split('\n').filter(option => option.trim() !== '') : undefined;
          }
          console.log("NEW QUSETION: ",newQuestion);
          saveEditedQuestion(question, newQuestion);
      });
  
      // Append input fields and save button to the form
      editForm.appendChild(questionLabel);
      editForm.appendChild(questionInput);
      editForm.appendChild(answerLabel);
      editForm.appendChild(answerInput);
      if (optionsInput) {
          const optionsLabel = document.createElement('label');
          optionsLabel.textContent = 'Options (one per line):';
          editForm.appendChild(optionsLabel);
          editForm.appendChild(optionsInput);
      }
      editForm.appendChild(saveButton);
  
      // Display the form in the modal
      const questionDetails = document.getElementById('questionDetails');
      questionDetails.innerHTML = '';
      questionDetails.appendChild(editForm);
  }
  
  
  // Function to save edited question
  function saveEditedQuestion(originalQuestion, newQuestion) {
      // Update the question details
      originalQuestion.question = newQuestion.question;
      originalQuestion.answer = newQuestion.answer;
      originalQuestion.options = newQuestion.options;
      var courseCode = $("#courseCode").val();
      var examType = $("#examType").val();
      var fileName = courseCode + " " + examType;
  
      // Make an API call to update the question on the server
      $.ajax({
          type: 'POST',
          url: 'questions.php',
          data: { action: 'edit', fileName:fileName, question: JSON.stringify(originalQuestion) },
          success: function(response) {
              // Handle success (you may show an alert or update the UI)
              console.log('Question updated successfully');
              // Refresh the question list after editing
              fetchQuestions();
          },
          error: function(error) {
              console.log('Error updating question:', error);
          }
      });
  }
  
  
  // Function to delete a question
  function deleteQuestion(question) {
      // Implement delete functionality (show a confirmation dialog)
      const confirmation = confirm('Are you sure you want to delete this question?');
      var courseCode = $("#courseCode").val();
      var examType = $("#examType").val();
      var fileName = courseCode + " " + examType;
      if (confirmation) {
          // Make an API call to delete the question on the server
          $.ajax({
              type: 'POST',
              url: 'questions.php',
              data: { action: 'delete',fileName:fileName, question: JSON.stringify(question) },
              success: function(response) {
                  // Handle success (you may show an alert or update the UI)
                  console.log('Question deleted successfully');
                  // Refresh the question list after deleting
                  fetchQuestions();
              },
              error: function(error) {
                  console.log('Error deleting question:', error);
              }
          });
      }
  }
  
  
  // Function to save a newly created question
  function saveCreatedQuestion(newQuestion, topic) {
    var courseCode = $("#courseCode").val();
    var examType = $("#examType").val();
    var fileName = courseCode + " " + examType;
      // Make an API call to save the new question on the server
      $.ajax({
          type: 'POST',
          url: 'questions.php',
          data: {
              action: 'create',
              fileName:fileName,
              question: JSON.stringify(newQuestion),
              topic: topic
          },
          success: function(response) {
              // Handle success (you may show an alert or update the UI)
              console.log('Question created successfully');
              // Refresh the question list after creating
              fetchQuestions();
          },
          error: function(error) {
              console.log('Error creating question:', error);
          }
      });
  }
  

  
//     document.getElementById('launchModalButton').addEventListener('click', function() {

//         $('#questionsModal').modal('show');
//       fetchQuestions();
//   });
    // Event listener for the Launch Questions Modal button


