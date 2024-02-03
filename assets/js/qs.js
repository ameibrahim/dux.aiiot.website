

// Sample question bank in JSON format

var questionBankB = {
  "Topic1": [
    {
      type: "mcq",
      question: "What is the capital of France?",
      options: ["Paris", "Lisbon", "Nicosia", "Berlin"],
      answer: "Paris",
    },
    {
      type: "fill-blank",
      question: "The largest planet in our solar system is __________.",
      answer: "Jupiter",
    },
    {
      type: "free-response",
      question: "Explain the concept of gravity.",
      answer: "Gravity is the force that attracts two bodies toward each other.",
    },
    // Add more questions here
  ], "Topic2": [
    {
      type: "mcq",
      question: "What is the capital of France?",
      options: ["Paris", "Lisbon", "Nicosia", "Berlin"],
      answer: "Paris",
    },
    {
      type: "fill-blank",
      question: "The largest planet in our solar system is __________.",
      answer: "Jupiter",
    },
    {
      type: "free-response",
      question: "Explain the concept of gravity.",
      answer: "Gravity is the force that attracts two bodies toward each other.",
    },
    // Add more questions here
  ]
};



const modal = document.getElementById("examModal");
const startExamBtn = document.getElementById("startExamBtn");
const modalContent = modal.querySelector(".qsmodal-content");
const modalBody = modalContent.querySelector(".qsmodal-body");
const sidebarInfo = modalContent.querySelector(".qssidebar-info");

let currentSetIndex = 0;
let currentQuestionIndex = 0;
let score = 0;
let questionsAttempted = 0;
let userAnswers = [];
let questionBank = {};
let userAnswersBank = {}
let userScoreBank = [0];
let accuracy = 0;
let topicRelevance = 0;
let examType = "";
sessionStorage.setItem('userScoreBank', JSON.stringify(userScoreBank));


function filterLecturesByExamType(lectures, examType) {
  if (examType === "Mid Term Exam") {
    // Filter the first 8 lectures
    return lectures.topics.slice(0, 8);
  } else if (examType === "Final Exam") {
    // Filter the first 8 lectures and lectures 10 to 13
    return lectures.topics.slice(0, 8).concat(lectures.topics.slice(9, 13));
  } else {
    // Invalid examType
    console.error("Invalid examType");
    return [];
  }
}

function fetchETopics(courseId, examType) {
  return new Promise(function (resolve, reject) {
    $.ajax({
      url: 'api/api.php',
      method: 'POST',
      data: { action: 'fetchTopicsForCourse', courseId: courseId },
      dataType: 'json',
      success: function (response) {
        var examTopics = filterLecturesByExamType(response, examType);
        resolve(examTopics);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error('Failed to fetch TOPICS:', errorThrown);
        reject(errorThrown);
      }
    });
  });
}


function updateExamStatus(studentId, courseId, examType, status) {
  var apiUrl = 'api/api.php';
  var requestData = {
    action: 'updateExamStatus',
    studentId: studentId,
    courseId: courseId,
    examType: examType,
    status: status
  };

  $.ajax({
    url: apiUrl,
    type: 'POST',
    data: requestData,
    dataType: 'json',
    success: function (response) {
      alert(response.message);
    },
    error: function (xhr, status, error) {
      alert('Error: ' + error);
    }
  });
}


function checkExamStatus(studentId, courseId, examType) {
  return new Promise(function(resolve, reject) {
    var apiUrl = 'api/api.php';
    var requestData = {
      action: 'checkExamStatus',
      studentId: studentId,
      courseId: courseId,
      examType: examType
    };
  
    $.ajax({
      url: apiUrl,
      type: 'POST',
      data: requestData,
      dataType: 'json',
      success: function (response) {
        resolve(response); // Pass the response value to the resolve function
      },
      error: function (xhr, status, error) {
        reject(error); // Pass the error value to the reject function
      }
    });
  });
}





async function saveExamGrades(total, ac, te, pe) {
  try {

    const examTopic = sessionStorage.getItem('topicToLearn');
    const userData = JSON.parse(sessionStorage.user);
    var sid = userData.stdnumber;

    const toDispatch = {
      studentId: sid,
      courseId: sessionStorage.getItem('courseToLearn'),
      score: total,
      topic: examTopic,
      total: total,
      ac: ac.toFixed(2),
      te: te.toFixed(2),
      pe: pe.toFixed(2),
      action: 'saveGrades'
    };
    console.log('INITIALIZING GRADES: ', toDispatch);

    $.ajax({
      url: 'api/api.php',
      method: 'POST',
      data: toDispatch,
      success: function (response) {
        console.log('Exam Grades Initialized successfully:', response);

        updateExamStatus(sid, courseId, examTopic, 'Started');
      },
      error: function (error) {
        console.error('Failed to save grades:', error);
      }
    });
  } catch (error) {
    console.error('Error:', error);
    // Handle the error
  }
}



const courseId = sessionStorage.getItem('courseToLearn');
// const examType = sessionStorage.getItem('topicToLearn');
const topicfield = document.getElementById('topic')
topicfield.addEventListener('change', function (e) {
  e.preventDefault();
  examType = this.value;
  console.log('EXAM TYPE FROM qs monitor: ', examType);
})

let topics;

// var topicsPromise = fetchETopics(courseId, examType);
// topicsPromise.then(function(examTopics) {
//   // Use the examTopics variable here or assign it to another variable outside the function
//   console.log(examTopics);
//   topics = examTopics
// }).catch(function(error) {
//   // Handle error
//   console.error(error);
// });
// Event listener for the "Start Exam" button


startExamBtn.addEventListener("click", async () => {
  console.log('CLICKED EXAM BUTTON');
  
  startExamBtn.textContent = "Please Wait... ";
  startLoader();

  checkExamStatus(studentId, courseId, examType)
  .then(function(response) {
    console.log('VERIFIED exam STATUS: ',response);
    if (response.status !== 'NA') {
    //   alert("You are not allowed to take the exam for a second time");
    //   // Stop the chain by returning a rejected Promise
    //   startExamBtn.textContent = "Exam Done";
    //   startExamBtn.disabled = true;
      return saveExamGrades(total = 0, ac = 0, te = 0, pe = 0);
    //   return Promise.reject("Exam already taken");
    } else {
      // Continue the chain by calling the next function
      return saveExamGrades(total = 0, ac = 0, te = 0, pe = 0);
    }
  })
  .then(function(grades) {
    // Exam grades are saved successfully
    console.log("Exam grades saved:", grades);

    // Continue the chain by calling the next function
    return fetchETopics(courseId, examType);;
  })
  .then(async function(examTopics) {
    // Topics fetched successfully
    console.log("Fetched topics:", examTopics);

    const tarray = []
    for (let i = 0; i < examTopics.length; i++) {
      tarray[i] = examTopics[i].name;
    }
    topics = tarray;
    console.log('EXAM TYPE: ', examType);
    console.log('EXAM TOPICS: ', topics);
    const mycourse = sessionStorage.getItem('courseToLearn');
    //lets generate and save the question bank
    // const nqb =await generateQuestionBank(topics);
    // console.log('Question Bank:', nqb);
    // sessionStorage.setItem('questionBank', JSON.stringify(nqb));
    // saveQuestionBank(mycourse, examType, nqb);


    return getQuestionBank(mycourse, examType);
  })
  .then(function(qb){
    questionBank = qb;
    sessionStorage.setItem('questionBank',JSON.stringify(qb));
        stopLoader();
    initializeExam();
    modal.style.display = "block";
    startExamBtn.textContent = "Exam Done.";
    startExamBtn.disabled = true;
  })
  .catch(function(error) {
    // Handle any errors that occur in the chain
    console.error('Error: ' + error);
  });



  // try {

  //   var topicsPromise = fetchETopics(courseId, examType);
  //   topicsPromise.then(async function (examTopics) {
  //     // Use the examTopics variable here or assign it to another variable outside the function

  //     const tarray = []
  //     for (let i = 0; i < examTopics.length; i++) {
  //       tarray[i] = examTopics[i].name;
  //     }
  //     topics = tarray;
  //     console.log('EXAM TYPE: ', examType);
  //     console.log('EXAM TOPICS: ', topics);
  //     const mycourse = sessionStorage.getItem('courseToLearn');

  //     // const qBank = await generateQuestionBank(topics);
  //     // console.log('Question Bank:', qBank);
  //     // sessionStorage.setItem('questionBank', JSON.stringify(qBank));
  //     // saveQuestionBank(mycourse, examType, qBank);

  //     getQuestionBank(mycourse, examType)
  //       .then(qb => {
  //         questionBank = qb;
  //       })
  //       .catch(error => {
  //         console.log(error);
  //       });



  //   }).catch(function (error) {
  //     // Handle error
  //     console.error(error);
  //   });




  //   // questionBank =qBank;
  //   // These actions should occur after the asynchronous operation completes
  //   // questionBank = questionBankB;
  //   stopLoader();
  //   initializeExam();
  //   modal.style.display = "block";
  //   startExamBtn.textContent = "Exam Done.";
  // } catch (error) {
  //   console.error('Error generating question bank:', error);

    // Handle any errors here, if necessary
  
});




// Function to add a score to userScoreBank
function addScore(score) {
  userScoreBank.push(score);
}

// Function to remove the last score from userScoreBank
function removeLastScore() {
  userScoreBank.pop();
  updateSidebarInfo();
}

// Function to calculate the total score
function calculateTotalScore() {
  return userScoreBank.reduce((total, score) => total + score, 0);
}



function countQuestions(questionBank) {
  let totalQuestions = 0;
  for (const key in questionBank) {
    if (questionBank.hasOwnProperty(key)) {
      totalQuestions += questionBank[key].length;
    }
  }
  return totalQuestions
}


function calculateTotalMaxScore(questionBank) {
  let maxScore = 0;
  let freeResponseCount = 0;
  let mcqCount = 0;
  let fillBlankCount = 0;

  for (const key in questionBank) {
    if (questionBank.hasOwnProperty(key)) {
      const questions = questionBank[key];
      for (let i = 0; i < questions.length; i++) {
        const questionType = questions[i].type;
        switch (questionType) {
          case 'free-response':
            freeResponseCount++;
            break;
          case 'mcq':
            mcqCount++;
            break;
          case 'fill-blank':
            fillBlankCount++;
            break;
          default:
            console.error(`Unsupported question type: ${questionType}`);
        }
      }
    }
  }

  maxScore = 5 * freeResponseCount + mcqCount + fillBlankCount;
  return maxScore;
}


// Function to initialize the exam modal
function initializeExam() {
  // Add welcome message and instructions
  modalBody.innerHTML = `<p style="font-weight: bold; font-size: 18px; color: #333;">Welcome to the exam! Please read and follow the instructions carefully:</p>
  <p>1. Once you start the exam, please <span style="font-weight: 600; color: #555;">do not close the window</span> or navigate away until you have completed all the questions. Any attempt to refresh, close, or restart will lead to a zero score.</p>
  <p>2. The examination can only be taken <span style="font-weight: 600; color: #555;">once</span>. Any second attempt will result in a zero score.</p>
  <p>3. The exam is made up of a mix of <span style="font-weight: 600; color: #555;">Multiple Choice Questions</span>, <span style="font-weight: 600; color: #555;">Fill-the-blank questions</span>, and <span style="font-weight: 600; color: #555;">Free response questions</span>.</p>
  <p>4. For ALL questions, please <span style="font-weight: 600; color: #555;">type the correct answer</span> in the provided input box.</p>
  <p>5. At the end of the exam, you will be able to <span style="font-weight: 600; color: #555;">download an exam receipt</span> that includes your score and the exam correction.</p> <p>Good luck with your exam!</p><button id="beginBtn">Begin</button>`;

  // Add event listener to the "Begin" button
  beginBtn.addEventListener("click", function () {
    startCountdown(90);
    loadQuestion();
  });
}

// Create mcq options
function createMCQOptions(questionData) {
  const options = questionData.options.map((option, index) => `
        <div>
            <input type="radio" id="option-${index}" name="mcq-option" value="${option}">
            <label for="option-${index}">${option}</label>
        </div>
    `);
  return options.join('');
}

// Function to load a question
function loadQuestion() {
  const questionBank = JSON.parse(sessionStorage.getItem('questionBank'));
  const currentQuestionSet = questionBank[Object.keys(questionBank)[currentSetIndex]];
  const question = currentQuestionSet[currentQuestionIndex];
  modalBody.innerHTML = `
    <div class="row">
        <div class="col">
            <p>${question.question}</p>
            <p>${question.type === 'mcq' ? createMCQOptions(question) : ''}</p>
            <input type="text" id="answerInput" class="form-control" placeholder="Type your answer...">
        </div>
        <div class="col" style="display:flex; flex-direction:row;">
            <button id="gradeBtn" class="btn btn-primary" disabled><i class="fas fa-check-circle" ></i> Submit</button>
            <button id="prevBtn" class="btn btn-secondary" ${currentQuestionIndex === 0 ? 'disabled' : ''}><i class="fas fa-chevron-left"></i> </button>
            <button id="nextBtn" class="btn btn-primary"><i class="fas fa-chevron-right"></i> </button>
        </div>
    </div>
`;

  // Add event listeners to input and buttons
  const answerInput = modalBody.querySelector("#answerInput");
  const gradeBtn = modalBody.querySelector("#gradeBtn");
  const prevBtn = modalBody.querySelector("#prevBtn");
  const nextBtn = modalBody.querySelector("#nextBtn");

  answerInput.addEventListener("input", () => {
    gradeBtn.removeAttribute("disabled");
  });

  gradeBtn.addEventListener("click", () => {

    const questionBank = JSON.parse(sessionStorage.getItem('questionBank'));
    var qbKeys = Object.keys(questionBank);
    const userAnswer = answerInput.value.trim();
    const correctAnswer = question.answer;
    userAnswers.push(userAnswer);

    if (question.type !== 'free-response') {
      if (userAnswer.toLowerCase() === correctAnswer.toLowerCase()) {
        score++;
        accuracy++;
        var userScoreBank = JSON.parse(sessionStorage.getItem('userScoreBank'));

        // Modify the userScoreBank variable (e.g., add a new score)
        userScoreBank.push(score); // Example: Add a score of 10

        // Set the updated userScoreBank back to sessionStorage
        sessionStorage.setItem('userScoreBank', JSON.stringify(userScoreBank));
      }
    } else {
      // Split the correct answer and user answer into words
      const correctWords = correctAnswer.toLowerCase().match(/\b\w+\b/g);
      const userWords = userAnswer.toLowerCase().match(/\b\w+\b/g);

      // Count the number of prepositions in the correct answer
      const prepositions = ['about', 'above', 'across', 'after', 'against', 'along', 'among', 'around', 'at', 'before', 'behind', 'below', 'beneath', 'beside', 'between', 'beyond', 'but', 'by', 'despite', 'down', 'during', 'except', 'for', 'from', 'in', 'inside', 'into', 'like', 'near', 'of', 'off', 'on', 'onto', 'out', 'outside', 'over', 'past', 'since', 'through', 'throughout', 'to', 'toward', 'under', 'underneath', 'until', 'up', 'upon', 'with', 'within', 'without'];
      let correctWordsCount = 0;

      for (let word of correctWords) {
        if (!prepositions.includes(word)) {
          correctWordsCount++;
        }
      }

      // Calculate the score based on the ratio of correct words found in the user answer
      const userWordsCount = userWords.length;
      const ratio = correctWordsCount > 0 ? (userWordsCount / correctWordsCount) : 0;
      const roundedScore = Math.round(ratio * 5);

      score += roundedScore;
      topicRelevance += roundedScore;
      // Get the userScoreBank from sessionStorage
      var userScoreBank = JSON.parse(sessionStorage.getItem('userScoreBank'));

      // Modify the userScoreBank variable (e.g., add a new score)
      userScoreBank.push(score); // Example: Add a score of 10

      // Set the updated userScoreBank back to sessionStorage
      sessionStorage.setItem('userScoreBank', JSON.stringify(userScoreBank));
    }
    //************************** */

    questionsAttempted++;
    updateSidebarInfo();

    if (currentQuestionIndex === currentQuestionSet.length - 1) {
      if (currentSetIndex < qbKeys.length - 1) {
        // Load the next set of questions
        userAnswersBank[qbKeys[currentSetIndex]] = userAnswers;
        console.log('USER ANSWERS BANK: ', userAnswersBank);
        currentSetIndex++;
        currentQuestionIndex = 0;
        userAnswers = [];

        loadQuestion();
      } else {
        // Last question in the last set, disable buttons after grading
        userAnswersBank[qbKeys[currentSetIndex]] = userAnswers;
        console.log('FINAL USER ANSWERS BANK: ', userAnswersBank);
        sessionStorage.setItem('userAnswersBank', JSON.stringify(userAnswersBank));
        gradeBtn.setAttribute("disabled", true);
        prevBtn.setAttribute("disabled", true);
        nextBtn.setAttribute("disabled", true);
        document.getElementById("answerInput").setAttribute("disabled", true);

        // EXAM END REACHED. SAVE SCORES


        try {
          const max = calculateTotalMaxScore(questionBank);
          const total = (score * 100 / max).toFixed(2);
          const nquest = countQuestions(questionBank);


          const userData = JSON.parse(sessionStorage.user);
          // Access the stdnumber property
          var sid = userData.stdnumber;

          // Create the toDispatch object
          const toDispatch = {
            studentId: sid,
            courseId: sessionStorage.getItem('courseToLearn'),
            score: total,
            topic: sessionStorage.getItem('topicToLearn'),
            total: total,
            ac: accuracy.toFixed(2),
            te: (nquest * 100 / questionsAttempted).toFixed(2),
            pe: (topicRelevance * 100 / max).toFixed(2),
            action: "saveGrades"
          };
          console.log('EXAM GRADES TO SAVE: ', toDispatch);
          // Send the data via jQuery Ajax
          $.ajax({
            url: 'api/api.php',
            method: "POST",
            data: toDispatch,
            success: function (response) {
              console.log("Exam Grades saved successfully:", response);
              // modal.style.display = 'none';
              alert("Exam Grades saved successfully. Any attempt to take the exam for a second time will earn you a zero");

            },
            error: function (error) {
              console.error("Failed to save grades:", error);
            }
          });

        } catch (error) {
          console.error("Error:", error);
          // Handle the error
        }



      }
    } else {
      // Load the next question in the current set
      currentQuestionIndex++;
      console.log('SET: ', currentSetIndex);
      console.log('QUESTION: ', currentQuestionIndex);
      loadQuestion();
    }


  });

  prevBtn.addEventListener("click", () => {
    if (currentQuestionIndex > 0) {
    //   currentQuestionIndex--;
    //   removeLastScore();
    //   updateSidebarInfo();
    //   loadQuestion();
    alert("You are not allowed to go back");
    }
  });

  nextBtn.addEventListener("click", () => {
    if (currentQuestionIndex < questionBank.length - 1) {
      currentQuestionIndex++;
      loadQuestion();
    }
  });

  updateSidebarInfo();
}

// Function to update sidebar information
function updateSidebarInfo() {
  const questionBank = JSON.parse(sessionStorage.getItem('questionBank'));
  const userScoreBank = JSON.parse(sessionStorage.getItem('userScoreBank'));
  const score = userScoreBank.pop();
  const maxScore = calculateTotalMaxScore(questionBank);
  const questionsLeft = countQuestions(questionBank);// - (currentQuestionIndex + 1);
  const status = 'Active'; // (currentQuestionIndex === currentQuestionSet.length - 1)&&(currentSetIndex===qbKeys.length-1) ? "Exam completed" : `Question ${currentQuestionIndex + 1} Graded`;

  sidebarInfo.innerHTML = `
  <div style="font-weight: bold; font-size: larger; color: white;" class="qscore">Score: ${score}/${maxScore}</div>
  <div style="font-weight: bold; font-size: larger; color: white;" class="qquestions-info">Attempted: ${questionsAttempted + 1} | Total: ${questionsLeft}</div>
  <div style="font-weight: bold; font-size: larger; color: white;" class="qstatus">${status}</div>
`;
}

// Event listener for the "Start Exam" button
// const topics = ['Language Modeling',  'Tokenization'];

// startExamBtn.addEventListener("click", (topics) => {
//   console.log('CLICKED EXAM BUTTON');
//   startLoader();
//   // sessionStorage.setItem('questionBank',JSON.stringify(questionBankB));
// generateQuestionBank(topics)
//   .then(questions => {
//     var questionBank = questions;
//     console.log('Question Bank:', questions);
//     sessionStorage.setItem('questionBank',JSON.stringify(questionBank));
//   })
//   .catch(error => {
//     console.error('Error generating question bank:', error);
//   });

// stopLoader();
//     initializeExam();
//     modal.style.display = "block";
// });

// Close the modal when the close button is clicked
modalContent.querySelector(".exam-modal-close-btn").addEventListener("click", () => {
  modal.style.display = "none";
});

// Close the modal when clicking outside the modal
window.addEventListener("click", (event) => {
  if (event.target === modal) {
    modal.style.display = "none";
  }
});


function startLoader() {
  document.getElementById("loader").style.display = "block";
  document.getElementById("loader-message").style.display = "block";
  document.getElementById("ok-icon").style.display = "none";
}

// Function to stop the loader
function stopLoader() {
  document.getElementById("loader").style.display = "none";
  document.getElementById("loader-message").style.display = "none";
  document.getElementById("ok-icon").style.display = "block";
}

// Asynchronous function example


initializeExam();



function startCountdown(minutes) {
  var targetDate = new Date();
  targetDate.setMinutes(targetDate.getMinutes() + minutes);

  var countdownInterval = setInterval(function () {
    var now = new Date().getTime();
    var distance = targetDate - now;

    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    document.getElementById("countdown").innerHTML = (hours < 10 ? "0" : "") + hours + ":" + (minutes < 10 ? "0" : "") + minutes + ":" + (seconds < 10 ? "0" : "") + seconds;

    if (distance < 0) {
      clearInterval(countdownInterval);
      document.getElementById("countdown").innerHTML = "EXPIRED";
      // Add any additional actions upon countdown expiration
    }
  }, 1000);
}


// Add event listener to the "Download Exam Receipt" button
const downloadReceiptBtn = document.getElementById("downloadReceiptBtn");
downloadReceiptBtn.addEventListener("click", () => {
  generateExamReceiptPDF();
});


// Function to generate the PDF
function generateExamReceiptPDF() {
  // Create a new document object
  const questionBank = JSON.parse(sessionStorage.getItem('questionBank'));
  var qbKeys = Object.keys(questionBank);
  const userAnswersBank = JSON.parse(sessionStorage.getItem('userAnswersBank'));
  const doc = new jsPDF();

  // Define some constants for margins and spacing
  const MARGIN_LEFT = 15;
  const MARGIN_TOP = 15;
  const LINE_HEIGHT = 10;
  const SECTION_SPACING = 20;
  const QUESTION_SPACING = 40;
  const SECTION_HEIGHT = LINE_HEIGHT * 3; // Height of each section

  // Define some constants for font sizes and colors
  const FONT_SIZE_HEADER = 18;
  const FONT_SIZE_NORMAL = 12;
  const FONT_COLOR_RED = [255, 0, 0];
  const FONT_COLOR_BLACK = [0, 0, 0];
  const FONT_COLOR_BLUE = [0, 0, 255];

  // Define background colors
  const ADDRESS_SECTION_COLOR = [200, 200, 200]; // Gray
  const USER_INFO_SECTION_COLOR = [255, 255, 204]; // Light Yellow
  const COURSE_INFO_SECTION_COLOR = [255, 204, 255]; // Light Yellow
  const SCORE_SECTION_COLOR = [204, 255, 204]; // Light Green
  const QUESTION_SECTION_COLOR = [255, 204, 204]; // Light Pink


  // Function to draw colored background
  function drawSectionBackground(color, x, y, width, height) {
    doc.setFillColor(...color);
    doc.rect(x, y, width, height, 'F');
  }


  // Add school name, address, and logo
  doc.setFontSize(FONT_SIZE_HEADER);
  doc.setFontStyle('bold');
  doc.text("Near East University", MARGIN_LEFT, MARGIN_TOP);
  doc.setDrawColor(0);
  doc.setLineWidth(0.5);
  doc.line(MARGIN_LEFT, MARGIN_TOP + 10, 200, MARGIN_TOP + 10);
  // Add the address
  doc.setFontSize(FONT_SIZE_NORMAL);
  doc.text(
    "Near East blvd, 99138 Mersin 10, Nicosia TRNC",
    MARGIN_LEFT + 5,
    MARGIN_TOP + 2 * LINE_HEIGHT + 10
  );
  // Draw background color for the address section
  //drawSectionBackground(ADDRESS_SECTION_COLOR, MARGIN_LEFT, MARGIN_TOP + LINE_HEIGHT + 10, 180, SECTION_HEIGHT);



  // Insert the school logo
  const logo = new Image();
  logo.src = "uploads/logo.png";
  logo.onload = function () {
    const courseId = sessionStorage.getItem('courseToLearn');
    doc.addImage(logo, "PNG", 150, 10, 40, 40);

    // Add course code and course title
    let yOffset = MARGIN_TOP + SECTION_SPACING + LINE_HEIGHT + 10;

    // Draw background color for the user info section
    //drawSectionBackground(USER_INFO_SECTION_COLOR, MARGIN_LEFT, yOffset, 180, SECTION_HEIGHT);
    yOffset += SECTION_SPACING;
    const selectElement = document.getElementById('course');
    // Get the selected option element
    const selectedOption = selectElement.options[selectElement.selectedIndex];
    // Get the display text of the selected option
    const selectedText = selectedOption.textContent;
    // Add course code and course title

    const user = JSON.parse(sessionStorage.getItem('user'));
    const userName = user.name;
    const userAddress = user.address;
    const userEmail = user.email;
    const studentNumber = user.stdnumber;
    const userPhotoPath = user.photo; // Path to user photo
    // Add student name and ID
    doc.setFontStyle('bold');
    doc.text(`STUDENT INFORMATION: `, MARGIN_LEFT + 5, yOffset + 5);
    doc.text(`Student Name: ${userName}`, MARGIN_LEFT + 5, yOffset + LINE_HEIGHT + 5);
    doc.text(`Student ID: ${studentNumber}`, MARGIN_LEFT + 5, yOffset + 2 * LINE_HEIGHT + 5);

    //drawSectionBackground(COURSE_INFO_SECTION_COLOR, MARGIN_LEFT, yOffset, 180, SECTION_HEIGHT);
    yOffset += SECTION_SPACING + 3 * LINE_HEIGHT + 10;
    doc.setFontStyle('bold');
    doc.text(`COURSE INFORMATION: `, MARGIN_LEFT + 5, yOffset + 5);
    doc.text(`Course Code: ${courseId}`, MARGIN_LEFT + 5, yOffset + LINE_HEIGHT + 5);
    doc.text(
      `Course Title: ${selectedText}`,
      MARGIN_LEFT + 5,
      yOffset + 2 * LINE_HEIGHT + 5
    );

    // Get student information from session storage
    // addUserInformation();

    // Draw background color for the score section
    // yOffset += SECTION_SPACING;
    // drawSectionBackground(USER_INFO_SECTION_COLOR, MARGIN_LEFT, yOffset + SECTION_SPACING, 180, SECTION_HEIGHT);
    // const user = JSON.parse(sessionStorage.getItem('user'));
    // const userName = user.name;
    // const userAddress = user.address;
    // const userEmail = user.email;
    // const studentNumber = user.stdNumber;
    // const userPhotoPath = user.photo; // Path to user photo
    // // Add student name and ID
    // doc.setFontStyle('bold');
    // doc.text(`STUDENT INFORMATION: `, MARGIN_LEFT + 5, yOffset + SECTION_SPACING + 5);
    // doc.text(`Student Name: ${userName}`, MARGIN_LEFT + 5, yOffset + SECTION_SPACING + 5);
    // doc.text(`Student ID: ${studentNumber}`, MARGIN_LEFT + 5, yOffset + SECTION_SPACING + LINE_HEIGHT + 5);

    // Add date of exam, number of questions attempted, and score
    yOffset += SECTION_SPACING + 3 * LINE_HEIGHT + 10;

    // Draw background color for the score section
    drawSectionBackground(SCORE_SECTION_COLOR, MARGIN_LEFT, yOffset, 180, SECTION_HEIGHT);


    const currentTime = new Date().toLocaleTimeString(); // Add current timestamp
    const currentDate = new Date().toLocaleDateString();
    doc.setFontStyle('bold');
    doc.text(`SCORE REPORT`, MARGIN_LEFT + 5, yOffset + 5);
    doc.setFontStyle('normal');
    doc.text(`Date of Exam: ${currentDate} ${currentTime}`, MARGIN_LEFT + 5, yOffset + LINE_HEIGHT + 5);
    doc.text(
      `Number of Questions Attempted: ${questionsAttempted}`,
      MARGIN_LEFT + 5,
      yOffset + 2 * LINE_HEIGHT + 5
    );
    // doc.text(`Score: ${score}`, MARGIN_LEFT + 5, yOffset + 3 * LINE_HEIGHT + 5);
    doc.setTextColor(...FONT_COLOR_BLUE); // Set font color to red for user answer
    doc.setFontSize(FONT_SIZE_HEADER);
    doc.setFontStyle('bold');
    doc.text(
      `Your Score: ${score} / ${calculateTotalMaxScore(questionBank)}`,
      MARGIN_LEFT + 5,
      yOffset + 3 * LINE_HEIGHT + 5
    );

    doc.setFontStyle('normal');
    doc.setTextColor(...FONT_COLOR_BLACK);
    doc.setFontSize(FONT_SIZE_NORMAL);
    // Add questions, correct answers, and user answers
    yOffset += SECTION_SPACING + LINE_HEIGHT;

    yOffset += QUESTION_SPACING; // Adjust this value for spacing
    doc.line(
      MARGIN_LEFT,
      yOffset - 5,
      200,
      yOffset - 5
    ); // Add a horizontal line



    for (let j = 0; j < qbKeys.length; j++) {
      var currentQuestionSet = questionBank[qbKeys[j]];
      var currentAnswersSet = userAnswersBank[qbKeys[j]];
      for (let i = 0; i < currentQuestionSet.length; i++) {
        const question = currentQuestionSet[i];
        const userAnswer = currentAnswersSet[i];

        // Draw background color for each question section
        drawSectionBackground(QUESTION_SECTION_COLOR, MARGIN_LEFT, yOffset, 180, SECTION_HEIGHT);

        doc.setFontStyle('bold');
        doc.text(
          `Question ${i + 1}: ${question.question}`,
          MARGIN_LEFT + 5,
          yOffset + 5
        );
        doc.setFontStyle('normal');
        doc.text(
          `Correct Answer: ${question.answer}`,
          MARGIN_LEFT + 5,
          yOffset + LINE_HEIGHT + 5
        );
        doc.setTextColor(...FONT_COLOR_RED); // Set font color to red for user answer
        doc.text(
          `Your Answer: ${userAnswer}`,
          MARGIN_LEFT + 5,
          yOffset + 2 * LINE_HEIGHT
        );
        doc.setTextColor(...FONT_COLOR_BLACK); // Reset font color

        yOffset += QUESTION_SPACING; // Adjust this value for spacing
        doc.line(
          MARGIN_LEFT,
          yOffset - 5,
          200,
          yOffset - 5
        ); // Add a horizontal line
        if (yOffset > 280) { // Adjust the value based on the page height
          doc.addPage(); // Add a new page
          yOffset = SECTION_SPACING; // Reset the yOffset for the new page
        }
      }
      doc.line(
        MARGIN_LEFT,
        yOffset - 5,
        200,
        yOffset - 5
      );

    }

    // Save the PDF with a filename
    const filename = "exam_receipt.pdf";
    doc.save(filename);
  };
}



// Function to generate the receipt document
// const OPENAI_API_KEY = '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';
// const OPENAI_API_KEY = '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';

//jeries
// const OPENAI_API_KEY = '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';

//dux ok
// const OPENAI_API_KEY = "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";

//save cash ok
// const OPENAI_API_KEY = "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";
const OPENAI_API_KEY = "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";
// const OPENAI_API_KEY = "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";


async function generateResponse(prompt, topics) {

  const endpoint = 'https://api.openai.com/v1/chat/completions';

  try {
    const response = await fetch(endpoint, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${OPENAI_API_KEY}`
      },
      body: JSON.stringify({
        // model: 'gpt-3.5-turbo',
        model: 'gpt-3.5-turbo-0613', // Specify GPT-4 model
        messages: [
          {
            role: 'system',
            content: 'You are a helpful assistant.'
          },
          {
            role: 'user',
            content: prompt
          }
        ],
        max_tokens: 300
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

const question_format = `  
  {
      type: "mcq",
      question: "What is the capital of France?",
      options: ["Paris", "Lisbon","Nicosia","Berlin"],
      answer: "Paris",
  },
  {
      type: "fill-blank",
      question: "The largest planet in our solar system is __________.",
      answer: "Jupiter",
  },
  {
      type: "free-response",
      question: "Explain the concept of gravity.",
      answer: "Gravity is the force that attracts two bodies toward each other.",
  },
  // Add more questions here
`

async function generateQuestionBank(topics) {
  var qBank = {};

  async function delay(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
  }

  for (let i = 0; i < topics.length; i++) {
    const topic = topics[i];
    const prompt = `Generate a mixture of 2 mcqs, 2 fill-the-blank and 2 free-response questions with corresponding answers on the topic ${topic}, and return a json object as response. use the format: ${question_format} to present questions.`;

    const questionsResponse = await generateResponse_QB(prompt);
    console.log("SET: ", i);
    console.log(questionsResponse);


    // Store the questions in the question bank with the topic index as the key
    // qBank[i] = {
    //   topic:topic,
    //   questions:questionsResponse
    // };
    qBank[topic] = (JSON.parse(questionsResponse)).questions
    console.log('TOPIC SET: ', questionBank);
    await delay(5000);
  }

  return qBank;
}

async function generateResponse_QB(prompt) {
  const endpoint = 'https://api.openai.com/v1/chat/completions';

  try {
    const response = await fetch(endpoint, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${OPENAI_API_KEY}`
      },
      body: JSON.stringify({
        model: 'gpt-3.5-turbo-0613',
        messages: [
          {
            role: 'system',
            content: `You are an exam specialist who can set exam questions of three types; mcqs, fill-the-blank and free-response, on any topic following the defined format: ${question_format}`
          },
          {
            role: 'user',
            content: prompt
          }
        ],
        max_tokens: 1000, // Adjust the max_tokens as needed
      })
    });

    const data = await response.json();
    console.log('GPT DATA: ', data);
    // Extract and return the question content
    const question = data.choices[0].message.content.trim();
    return question;
  } catch (error) {
    console.error('Error fetching response:', error);
    return null;
  }
}

// document.addEventListener('DOMContentLoaded', async function() {
//   // Code to execute when the document is ready
//   console.log('READY TO GET ')
//   const topicsArray = ["Robotics compontnets and sensors" ]; // Replace with your actual topics

//   try {
//     const questionBank = await generateQuestionBank(topicsArray);
//     console.log('Question Bank:', questionBank);
//   } catch (error) {
//     console.error('An error occurred:', error);
//   }
// });

// Function to save the questionBank from sessionStorage to a .json file
// function saveQuestionBankToFile(courseId, topicId) {
//   // Get the questionBank from sessionStorage
//   const questionBank = JSON.parse(sessionStorage.getItem('questionBank'));

//   if (!questionBank) {
//     console.error('Question bank not found in sessionStorage.');
//     return;
//   }

//   try {
//     // Convert the questionBank object to JSON string
//     const jsonString = JSON.stringify(questionBank);

//     // Create the file name
//     const fileName = `${courseId} ${topicId}.json`;

//     // Set the file path
//     const filePath = `exams/${fileName}`;

//     // Create a Blob object with the JSON string
//     const blob = new Blob([jsonString], { type: 'application/json' });

//     // Create a link element and set its properties
//     const link = document.createElement('a');
//     link.href = URL.createObjectURL(blob);
//     link.download = fileName;

//     // Simulate a click on the link to trigger the download
//     link.dispatchEvent(new MouseEvent('click'));

//     console.log('Question bank saved to file:', fileName);
//   } catch (error) {
//     console.error('Failed to save question bank to file:', error);
//   }
// }

// // Function to load the questionBank from a .json file
// function loadQuestionBankFromFile(courseId, topicId) {
//   // Create the file name
//   const fileName = `${courseId} ${topicId}.json`;

//   // Set the file path
//   const filePath = `exams/${fileName}`;

//   // Create a new XMLHttpRequest object
//   const xhr = new XMLHttpRequest();

//   xhr.onreadystatechange = function () {
//     if (xhr.readyState === XMLHttpRequest.DONE) {
//       if (xhr.status === 200) {
//         const jsonString = xhr.responseText;

//         try {
//           // Parse the JSON string to an object
//           const questionBank = JSON.parse(jsonString);

//           console.log('Question bank loaded from file:', fileName);

//           // Use the loaded questionBank object
//           console.log(questionBank);
//         } catch (parseError) {
//           console.error('Failed to parse question bank JSON:', parseError);
//         }
//       } else {
//         console.error('Failed to load question bank file:', xhr.status);
//       }
//     }
//   };

//   // Send a GET request to fetch the .json file
//   xhr.open('GET', filePath, true);
//   xhr.send();
// }

// saveQuestionBankToFile(courseId='C004', topicId='Mid Term Exam');


// function downloadQuestionBankToFile(courseId, topicId, questionBank) {

//   const fileName = courseId + '_' + topicId + '.json';
//   console.log('ATTEMTPTING TO SAVE QB WITH NAME: ',fileName);
//   const fileContent = JSON.stringify(questionBank);
//   const blob = new Blob([fileContent], { type: 'application/json' });
//   const url = URL.createObjectURL(blob);
//   const a = document.createElement('a');
//   a.href = url;
//   a.download = fileName;
//   document.body.appendChild(a);
//   a.click();
//   document.body.removeChild(a);
//   URL.revokeObjectURL(url);
// }




function saveQuestionBank(courseId, topicId, questionBank) {
  $.ajax({
    url: 'api/api.php',
    type: 'POST',
    data: {
      action: 'saveQuestionBank',
      questionBank: questionBank,
      courseId: courseId,
      topicId: topicId,
    },
    success: function (response) {
      console.log(response);
    },
    error: function (xhr, status, error) {
      console.log(xhr.responseText);
    }
  });
}


// function getQuestionBank(courseId, topicId) {
//   $.ajax({
//     url: 'api/api.php',
//     type: 'POST',
//     data: {
//       action: 'getQuestionBank',
//       courseId: courseId,
//       topicId: topicId
//     },
//     success: function(response) {
//       const qb = JSON.parse(response).content;
//       console.log('FETCHED QB FROM FILE: ',qb);
//     },
//     error: function(xhr, status, error) {
//       console.log(xhr.responseText);
//     }
//   });
// }

function getQuestionBank(courseId, topicId) {
  return new Promise((resolve, reject) => {
    $.ajax({
      url: 'api/api.php',
      type: 'POST',
      data: {
        action: 'getQuestionBank',
        courseId: courseId,
        topicId: topicId
      },
      success: function (response) {
        const qb =JSON.parse(response).content;
        console.log('FETCHED QB FROM FILE: ', qb);
        sessionStorage.setItem('questionBank', qb);
        resolve(qb);
      },
      error: function (xhr, status, error) {
        console.log(xhr.responseText);
        reject(error);
      }
    });
  });
}


