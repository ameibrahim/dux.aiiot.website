<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.2/js/bootstrap.min.js" integrity="sha512-WW8/jxkELe2CAiE4LvQfwm1rajOS8PHasCCx+knHG0gBHt8EXxS6T6tJRTGuDQVnluuAvMxWF4j8SNFDKceLFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.jsdelivr.net/npm/fuse.js/dist/fuse.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script> -->
  <!-- <script src="assets/js/talk.js"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.8.335/pdf.min.js"></script>

  <!-- Add your custom css files and js files in admin-dynamic-imports.php  -->
  <?php include 'includes/student-dynamic-imports.php' ?>

     <!-- <script>

    var message = "Not alowed!!";

    function rtclickcheck(keyp){ if (navigator.appName == "Netscape" && keyp.which == 3){ alert(message); return false; }

    if (navigator.appVersion.indexOf("MSIE") != -1 && event.button == 2) { alert(message); return false; } }

    document.onmousedown = rtclickcheck;

  </script> -->
</head>

<body>

  <!-- Header Row -->

  <div class="gtranslate_wrapper"></div>
  <script>window.gtranslateSettings = { "default_language": "en", "languages": ["en", "tr", "fr", "de", "it", "es"], "wrapper_selector": ".gtranslate_wrapper", "switcher_horizontal_position": "left", "switcher_vertical_position": "bottom", "float_switcher_open_direction": "bottom", "flag_style": "3d" }</script>
  <script src="https://cdn.gtranslate.net/widgets/latest/float.js" defer></script>


  <header class="header-navigation">

    <div class="menu-logo" onclick="toggleSideBar()">
      <img class="open-menu icon" src="assets/icons/fi-rr-grip-lines.svg" alt="">
      <img class="close-menu icon" src="assets/icons/fi-rr-cross.svg" alt="">
    </div>

    <div class="top-logo">
      <img src="assets/RCAIoT_logo.png" alt="Company Logo">
    </div>

    <div class="right-nav">
      <p id="userName" class="locked-text"></p>
      <img src="" alt="User Profile Image" class="user-avatar" id="userPhoto">
      <div class="logout-icon two-column-grid" onclick="logoutDialog()">
        <p class="text">Logout</p>
        <img class="icon" src="assets/icons/fi-rr-arrow-right-to-bracket.svg">
      </div>
    </div>

  </header>

  <!-- 
  <script>

    window.addEventListener('load', function () {
      let googleTranslateItem = document.querySelector("#gt_float_wrapper");
        googleTranslateItem.setAttribute("style", "");
    })

  </script> -->


  <!-- Main Section Row -->
  <div class="main-section">
    <!-- Sidebar -->

    <div class="sidebar nav">

      <div class="shortened-grid">

      <div class="right-nav">
        <p id="userName" class="locked-text"></p>
        <img src="" alt="User Profile Image" class="user-avatar" id="userPhoto">
      </div>


      <div class="two-column-grid">
        <a class="ad-link" target="_blank" href="https://www.bing.com/create">
          <img src="assets/icons/fi-rr-square-star.svg">
          <p>AI Image Creator</p>
        </a>

        <a class="ad-link bg-blue" target="_blank"
          href="https://www.bing.com/search?toWww=1&redig=0F5576DEB42544F78DFCAACCBF98A1CD&q=Bing+AI&showconv=1">
          <img src="assets/icons/fi-rr-message-quote.svg">
          <p>AI Chat</p>
        </a>
      </div>

      <a class="nav-item nav-link active" data-tab="tutorial" href="#">
        <img class="icon" src="assets/icons/fi-rr-play-circle.svg">
        <p>Tutorial</p>
      </a>

      <a class="nav-item nav-link" data-tab="catalog" href="#">
        <img class="icon" src="assets/icons/fi-rr-list-timeline.svg">
        <p>catalog</p>
      </a>

      <a class="nav-item nav-link" data-tab="courses" href="#">
        <img class="icon" src="assets/icons/fi-rr-books.svg">
        <p>My Courses</p>
      </a>

      <a class="nav-item nav-link" data-tab="classroom" href="#">
        <img class="icon" src="assets/icons/fi-rr-laptop.svg">
        <p>Classroom</p>
      </a>

      <a class="nav-item nav-link" data-tab="chatroom" href="#">
        <img class="icon" src="assets/icons/fi-rr-messages.svg">
        <p>Chatroom</p>
      </a>

      <a class="nav-item nav-link" data-tab="grades" href="#">
        <img class="icon" src="assets/icons/fi-rr-chart-histogram.svg">
        <p>Grades</p>
      </a>

      <a class="nav-item nav-link" data-tab="timetable" href="#">
        <img class="icon" src="assets/icons/fi-rr-calendar.svg">
        <p class="locked-text" data-en="Timetable" data-tr="Ders Programı"></p>
      </a>

      <a class="nav-item nav-link" data-tab="messages" href="#">
        <img class="icon" src="assets/icons/fi-rr-envelope.svg">
        <p>Messages</p>
      </a>

      <a class="nav-item nav-link" data-tab="documents" href="#">
        <img class="icon" src="assets/icons/fi-rr-assept-document.svg">
        <p>Documents</p>
      </a>

      <a class="nav-item nav-link" data-tab="settings" href="#">
        <img class="icon" src="assets/icons/fi-rr-settings.svg">
        <p>Settings</p>
      </a>
      
    <a class="nav-item nav-link" data-tab="profile-content" href="#">
        <img class="icon" src="assets/icons/fi-rr-user.svg">
        <p>Profile</p>
      </a>

      <a class="nav-item nav-link" data-tab="tutorial" href="#" onclick="logoutDialog()">
        <img class="icon" src="assets/icons/fi-rr-arrow-right-to-bracket.svg">
        <p>Logout</p>
      </a>

      </div>
    </div>


    <!-- Chat Area -->

    <div class="tab-contents" id="tutorial-content">
      <!-- Content for Courses tab -->
      <div class="tutorial">
        <h1 class="tab-title">Video Tutorial</h1>
        <video controls>
          <source src="uploads/tutorial.mp4" type="video/mp4">
          Your browser does not support the video tag.
        </video>
      </div>
    </div>


    <div class="tab-contents" id="catalog-content">
      <!-- Content for Courses tab -->
      <div class="all-courses">
        <h1>Course Catalog</h1>
        <div class="sub-headline">Subscribe to a course
          by clicking in the checkbox. Once your instructor approves, you will be able to use the classroom.
        </div>
        <div id="courseListAll" class="card-group"></div>
      </div>
    </div>

    <div class="tab-contents" id="classroom-content">

      <div class="chat-section">
        <h1 class="tab-title">Learning Area</h1>

        <div class="two-column-grid">
          <div class="row myselection">
            <div class="form-group">
              <label for="course">Course: </label>
              <div class="select">
                <select class="form-control" id="course" name="course">
                  <option value="">Select Course</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="topic">Lecture:</label>
              <div class="select">
                <select class="form-control" id="topic" name="topic">
                  <option value="">Select Lecture</option>
                </select>
              </div>
            </div>

            <button class="set-button" id="set-button"><i class="fas fa-cog"></i> 
            <p class="locked-text" data-en="Set" data-tr="Ayarla"></p></button>
          </div>

          <div class="timer-section">
            <div class="countdown-timer">
              <span class="timer-hours">00</span>:
              <span class="timer-minutes">00</span>:
              <span class="timer-seconds">00</span>
            </div>

            <button class="start-button grid-button"><i class="fas fa-play"></i> Start</button>
            <button class="skip-button grid-button"><i class="fas fa-arrow-alt-circle-right"></i> Next</button>

            <div class="buttons">
              <div id="buttonContainer"></div>
              <div id="submit-button"></div>
            </div>

          </div>
        </div>

        <div class="chat-history" id="chat-history">
          <!-- Chat history appears here -->
        </div>
        <br>
        <div class="action-buttons">
          <button id="image-prompt-button" class="btn btn-outline-secondary">
            <i class="far fa-image"></i>
          </button>
          <button id="pdf-prompt-button" class="btn btn-outline-secondary">
            <i class="fas fa-paperclip"></i>
          </button>
          <button id="export-button" class="btn btn-outline-secondary">
            <i class="far fa-file-pdf"></i>
          </button>
          <button id="mic-button" class="btn btn-outline-secondary">
            <i class="fas fa-microphone"></i>
            <span id="mic-status"></span>
          </button>
        </div>

        <div class="send-message-box">
          <textarea id="messageTextarea" rows="1" oninput="adjustTextareaHeight(this)" class="chat-input"
            placeholder="Type your message, then press Shift + Enter"></textarea>

          <!-- <i class="fas fa-paper-plane" style="color:blue"></i> -->
          <button id="sendIcon" 
                class="locked-text"
                data-en="Send"
                data-tr="Gönder"></button>

        </div>
      </div>

      <div class="instructions-section">
        <h1 class="tab-title">Instructions</h1>
        <div class="examiner" id="myExam" style="display:none">
          <button id="startExamBtn">Start Exam</button>
          <div id="examModal" class="qsmodal">
            <div class="qsmodal-content" style="display: flex; flex-direction: column;">
              <div class="row">
                <div class="qsmodal-header">
                  <h2>Exam</h2>
                 <button class="exam-modal-close-btn">Close</button> 
                </div>
              </div>
              <div class="row" style=" display: flex; flex-direction:row; margin-bottom: 30px;">
                <div>
                  <p class="qsloader-message" id="loader-message">Please Wait... </p> <span id="ok-icon"><i
                      class="fas fa-check" style="display: none;"></i></span>
                </div>
                <div id="loader" class="qsloader"></div>
              </div>
              <div class="row qsmy-container">
                <div class="col-md-3">
                  <div class="qsmodal-sidebar" style="display: flex; flex-direction: column;">
                    <div id="exam-count-down" class="qscountdown-timer">
                      <p id="countdown" class="qscountdown-text">00:00:00</p>
                    </div>
                    <div class="qssidebar-info">
                      <!-- Display score, questions attempted, questions left, and status -->
                    </div>
                    <div class="col">
                      <button id="downloadReceiptBtn" class="btn btn-success"><i class="fas fa-download"></i> Exam
                        Receipt</button>
                    </div>
                  </div>
                </div>
                <div class="col=md-7">
                  <div class="qsmodal-body">
                    <!-- Question content goes here -->
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
        <!-- Wrap the image in its own div and apply styling -->
        <div class="instruction-image-container" id="instructions-image-container">

          <!-- <div id="result"></div> -->
          <div class="row">
            <div class="image">
              <img id="dux-image" src="assets/dux_male.jpg" alt="Instruction Media">
            </div>
            <div class="image">
              <img
                src="https://builtin.com/cdn-cgi/image/f=auto,quality=80,width=752,height=435/https://builtin.com/sites/www.builtin.com/files/styles/byline_image/public/2021-12/machine-learning-examples-applications.png"
                alt="Instruction Media" class="instruction-image">
            </div>
          </div>
        </div>

        <div class="instruction" id="instructions">

          <div class="instruction-messages">

            <div class="welcome-message">
              <p>
              <h3>Welcome!</h3>
              </p>
              <p>I'm excited to be your virtual teacher. Together, we'll explore a wide range of topics</p>
              <p>Feel free to ask questions, seek assistance, and share your thoughts. </p>
              <p>Get ready to delve into a new experience, challenge your mind, and expand your understanding of
                the world in this virtual classroom!</p>
              <p>Best regards,<br>NEUGPT</p>
            </div>
          </div>
        </div>
      </div>

    </div>

    <div class="tab-contents" id="chatroom-content">
      <!-- Content for Classroom tab -->
      <div class="chat-room-section">
        <div class="chat-header">
          <h1 class="tab-title">Chatroom</h1>
          <p class="badge" onclick="showOnlineUsers()">19 users online</p>
        </div>
        <div class="chatroom-chat-history" id="chatroom-chat-history">
          <!-- Chatroom Chat history appears here -->
        </div>
        <div class="send-chatroom-message-box">
          <textarea id="chatroom-message-textarea" placeholder="Type your message and press Enter"></textarea>
          <button onclick="sendMessageTriggered()" 
                class="locked-text"
                data-en="Send"
                data-tr="Gönder"></button>
        </div>
      </div>
    </div>


    <!-- <div class="overlay">
          <div class="online-user-section">
            <h1 class="tab-title">Online Users</h1>
        
            <div class="logged-in-users" id="logged-in-users">

            </div>
          </div>
        </div> -->

    <div class="tab-contents" id="courses-content">
      <!-- Content for Courses tab -->
      <div class="my-courses">
        <h1 class="tab-title">Courses</h1>

        <div class="sub-headline">
          Here is a list of your approved courses
        </div>

        <div id="courseList" class="card-group"></div>
      </div>
    </div>

    <!-- CONTENT FOR GRADES  -->
    <div class="tab-contents" id="grades-content">
      <!-- Content for Grades tab -->

      <div class="chat-section">
        <h1>Grades</h1>

        <div class="two-column-grid">
          <button class="active" id="courseGradesTabG" data-toggle="tab" href="#dashboard-container"
            style="text-decoration: none;">Scores per Lecture</button>

          <button class="" id="semesterGradesTab" data-toggle="tab" href="#semesterGradesContainer"
            style="text-decoration: none;">Semester Results</button>
        </div>

        <div class="tab-content space-grid">
          <div class="tab-pane fade show active" id="dashboard-container">
            <!-- Content for Course Grades tab goes here -->
            <div class="row myselectG">
              <div class="form-group">
                <label for="courseG">Course:</label>
                <div class="select">
                  <select class="form-control" id="courseG" name="courseG">
                    <option value="">Select Course</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label for="topicG">Lecture:</label>
                <div class="select">
                  <select class="form-control" id="topicG" name="topicG">
                    <option value="">Select Lecture</option>
                  </select>
                </div>
              </div>

              <button class="set-button btn btn-primary locked-text" id="grades-button"
              data-en="Show"
              data-tr="Göster"
              ></button>
            </div>


            <div class="instructions-section">
              <div class="progress-bars" id="progressBarsContainer">
              </div>
            </div>

            <div class="dashboard-container">
              <!-- Your existing card elements for Course Grades content -->
              <div class="card">
                <div class="card-icon">
                  <i class="fas fa-check-circle"></i>
                </div>
                <div class="card-content">
                  <h2>Correctness Level</h2>
                  <p id="accuracyScore">Score: </p>
                </div>
              </div>
              <div class="card">
                <div class="card-icon">
                  <i class="fas fa-stopwatch"></i>
                </div>
                <div class="card-content">
                  <h2>Topic Relevance</h2>
                  <p id="promptEfficiencyScore">Score: </p>
                </div>
              </div>
              <div class="card">
                <div class="card-icon">
                  <i class="fas fa-clock"></i>
                </div>
                <div class="card-content">
                  <h2>Time Efficiency</h2>
                  <p id="timeEfficiencyScore">Score: </p>
                </div>
              </div>
              <div class="card">
                <div class="card-icon">
                  <i class="fas fa-clipboard-list"></i>
                </div>
                <div class="card-content">
                  <h2>Total Grade</h2>
                  <p id="totalGradeScore">Score: </p>
                </div>
              </div>
            </div>
          </div>

          <div class="tab-pane-2 fade" id="semesterGradesContainer" role="tabpanel" aria-labelledby="semesterGradesTab">
            <!-- Content for Semester Grades tab goes here -->

            <h2 class="tab-title mb-20">Semester Results</h2>

            <div class="row myselectGS mb-20">

              <div class="form-group">
                <label for="courseGS">Course: </label>
                <div class="select">
                  <select class="form-control" id="courseGS" name="courseGS">
                    <option value="">Select Course</option>
                  </select>
                </div>
              </div>

              <!-- <div class="column"> -->
              <!-- <div> -->
              <button class="set-button btn btn-primary locked-text" 
              data-en="Show"
              data-tr="Göster"
              id="semester-grades-button">

              </button>
              <!-- </div> -->
              <!-- </div> -->

            </div>

            <div class="dashboard-container">
              <!-- Your existing card elements for Course Grades content -->

              <div class="card">
                <div class="card-icon">
                  <i class="far fa-calendar-alt"></i>
                </div>

                <div class="card-content">
                  <h2>Weekly Evaluation Average</h2>
                  <p id="weeklyEvaluationScore">Score: </p>
                </div>

              </div>

              <div class="card">
                <div class="card-icon">
                  <i class="fas fa-clipboard-check"></i>
                </div>
                <div class="card-content">
                  <h2>Mid-Term Exam</h2>
                  <p id="midTermExamScore">Score: </p>
                </div>
              </div>
              <div class="card">
                <div class="card-icon">
                  <i class="fas fa-graduation-cap"></i>
                </div>
                <div class="card-content">
                  <h2>Final Exam</h2>
                  <p id="finalExamScore">Score: </p>
                </div>
              </div>
              <div class="card">
                <div class="card-icon">
                  <i class="fas fa-chart-pie"></i>
                </div>
                <div class="card-content">
                  <h2>Total Grade</h2>
                  <p id="totalSemesterScore">Score: </p>
                </div>
              </div>


              <div class="card">
                <div class="card-icon">
                  <i class="fas fa-comment"></i>
                </div>
                <div class="card-content">
                  <h2>Remark</h2>
                  <p id="semesterRemark">Failed </p>
                </div>
              </div>
              <div class="card">
                <div class="card-icon">
                  <i class="fas fa-flag-checkered"></i>
                </div>
                <div class="card-content">
                  <h2>Final Grade</h2>
                  <p id="letterGrade"> FF </p>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>

    </div>

    <div class="tab-contents" id="timetable-content">
      <!-- Content for Timetable tab -->

      <div class="my-timetable">
        <h2 class="tab-title locked-text" data-en="Timetable" data-tr="Ders Programı"></h2>

        <div class="button-group" role="group">
          <button type="button" class="btn btn-secondary" id="week-btn">This Week</button>
          <button type="button" class="btn btn-secondary" id="month-btn">This Month</button>
          <button type="button" class="btn btn-secondary" id="year-btn">This Year</button>
        </div>

        <div class="row" id="timetable-row">
        </div>

      </div>

    </div>

    <div class="tab-contents" id="messages-content">
         <h2 class="tab-title">Messages</h2>
      <!-- Content for Messages tab -->
      <div class="chat-section">
        <div class="messagingM">
          <div class="tabsM">
            <button class="tab-btnM active" onclick="showTab('Unread')">Unread: <span id="unreadCount"
                style="font-weight: bold; color: var(--pop);"></span></button>
            <button class="tab-btnM" onclick="showTab('Inbox')">Inbox: <span id="inboxCount"
                style="font-weight: bold; color: var(--accent);"></span></button>
            <button class="tab-btnM" onclick="showTab('Sent')">Sent: <span id="sentCount"
                style="font-weight: bold; color: black;"></span></button>
            <button class="tab-btnM" onclick="showTab('Spam')">Close list</button>
            <button onclick="showCreateMessageCard()">Create Message</button>
          </div>

          <div class="contentM" id="content">
            <!-- List of messages will be displayed here -->
          </div>

          <div class="cardM" id="messageCard">
            <!-- The full message card will be displayed here -->
          </div>

          <div class="cardM" id="createMessageCard">
            <!-- The create message card will be displayed here -->
            <h2>Create Message</h2>

            <form id="createMessageForm" enctype="multipart/form-data">

              <div class="form-group">
                <div class="select">
                  <select class="form-control name=" instructor-list" id="instructor-list">
                    <option value="">Select Instructor</option>
                  </select>
                </div>
              </div>

              <label for="subject">Subject:</label>
              <input type="text" id="subject" required>

              <label for="message">Message:</label>
              <textarea id="message" rows="4" required></textarea>

              <label for="attachment">Attachment:</label>
              <input type="file" id="attachment">

              <div class="buttonsM">
                <button type="button" class="cancel-btn" onclick="cancelCreateMessage()">Cancel</button>
                <button type="button" onclick="sendMessageB()" 
                class="locked-text"
                data-en="Send"
                data-tr="Gönder"></button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>


    <div class="tab-contents" id="documents-content">
      <!-- Content for Messages tab -->
      <!-- <embed src="uploads/Intro_to_robotics1.pdf" width="500" height="600" type="application/pdf"> -->
      
        <div class="pdf-for-course">

          <div class="form-group">
            <label for="course">Course: </label>
            <div class="select">
              <select class="form-control" id="course-pdf" name="course-pdf">
                <option value="">Select Course</option>
              </select>
            </div>
          </div>

        </div>
        <!-- <div class="book-viewer">
        <select class="form-control" id="my-textbooks">
          <option value="">Select a Textbook</option>
        </select> -->


      <div class="form-group">
        <label for="course">Document: </label>
        <div class="select">
          <select class="form-control" id="my-textbooks" name="my-textbooks">
            <option value="">Select Course</option>
          </select>
        </div>
      </div>

      <div id="book-viewer" style="padding-top: 30px;"></div>
  
      <script>
      $(document).ready(function() {

        const userData = JSON.parse(sessionStorage.user);
        // Access the stdnumber property
        var sid = userData.stdnumber;
        
        fetchCoursesForUser(sid, '#course-pdf');
        // Fetch textbooks and populate select field
        let courseId;
        $('#course-pdf').change(function() {
          courseId = $(this).val(); // Get the selected value
          $('#my-textbooks').empty().append('<option value="">Select a Textbook</option>');
        
        $.post('api/api.php', { action: 'fetchTextbooks', courseId: courseId }, function(response) {
          var textbooks = JSON.parse(response);

          // Populate select field with textbook names
          var selectField = $('#my-textbooks');
          textbooks.forEach(function(textbook) {
            selectField.append($('<option>', { value: textbook, text: textbook }));
          });
        });

  // Handle textbook selection
  $('#my-textbooks').change(function() {
    var selectedTextbook = $(this).val();

    // Clear previous PDF viewer content
    $('#book-viewer').empty();

    // Display selected PDF using PDF.js
    const url = 'uploads/' + selectedTextbook;
    const content = `<embed src="${url}" width="100%" height="600" type="application/pdf">`;
      $('#book-viewer').append(content);
    
        });
      });
    });
      </script>

    </div>

    <div class="tab-contents" id="settings-content">
     <h2 class="tab-title">Settings</h2>
      <!-- Content for Settings tab -->
      <div class="cardS">
        <div class="cardS-body api-key-container">
          <h2 class="tab-title">API Key</h2>
          <p class="cardS-text" id="api-key-status"></p>
          <p class="cardS-text" id="api-key-preview"></p>
          <form id="api-key-form">
            <label for="api-key-input">Register/Update Your API Key:</label>
            <input type="text" class="form-control" id="api-key-input" required>
            <button type="submit" class="btn btn-primary locked-text"
            data-en="Save"
            data-tr="Kaydet"
            ></button>
          </form>

          <div class="api-key-link">
            Don't have a key yet? <a href="https://platform.openai.com" target="_blank" id="get-api-key-link">Find
              out how to get one</a>
          </div>

<div class="tab-contents" id="profile-settings" data-tab="Profile-settings-link">
       <h1 class="tab-title">Profile Settings</h1>
  <div class="profile-container">
   <div class="profile-picture">
  <img id="userPhotos" src="" alt="User Photo">
  <input type="file" id="fileInput" accept="image/*" onchange="loadFile(event)">
  <button class="editt-photo-btn" onclick="document.getElementById('fileInput').click();">&#9998;</button>
</div>
     <div class="profile-fields">
    <input type="text" placeholder="Name" id="name">
    <input type="text" placeholder="Student No" id="studentno" readonly>
    <input type="text" placeholder="Email" id="email" readonly>
    <input type="text" placeholder="Phone No" id="phone">
    <input type="text" placeholder="Address" id="address">

     </div>

            
            <div class="profile-footer">
<button class="save-btn locked-text" onClick="edituserprofile()" id="editButton" data-en="Save" data-tr="Kaydet"></button>



            </div>
        </div>
    </div>
        </div>
        
      </div>
      
      
      
      

      <!-- Styled card with API key instructions -->
      <div id="api-key-instructions-card" class="cardS">
        <div class="cardS-body">
          <h5 class="cardS-title">To get an API key:</h5>
          <ol>
            <li>Go to <a href="https://platform.openai.com" target="_blank">platform.openai.com</a> and sign in with
              an OpenAI account.</li>
            <li>Click your profile icon at the top-right corner of the page and select "View API Keys."</li>
            <li>Click "Create New Secret Key" to generate a new API key.</li>
          </ol>
        </div>
        
      </div>
    </div> 

    
<div class="tab-contents" id="profile-settings" data-tab="Profile-settings-link">
       <h1 class="tab-title">Profile Settings</h1>
<div class="profile-container">
   <div class="profile-picture">
  <img id="userPhotos" src="" alt="User Photo">
  <input type="file" id="fileInput" accept="image/*" onchange="loadFile(event)">
  <button class="editt-photo-btn" onclick="document.getElementById('fileInput').click();">&#9998;</button>
</div>
     <div class="profile-fields">
    <input type="text" placeholder="Name" id="name">
    <input type="text" placeholder="Student No" id="studentno" readonly>
    <input type="text" placeholder="Email" id="email" readonly>
    <input type="text" placeholder="Phone No" id="phone">
    <input type="text" placeholder="Address" id="address">

     </div>

            
            <div class="profile-footer">
<button class="save-btn locked-text" onClick="edituserprofile()" id="editButton" data-en="Save" data-tr="Kaydet"></button>



            </div>
        </div>
    </div>
        </div>
</body>

</html>



  <!--<footer>-->

  <!--  <div class="image">-->
  <!--    <img src="assets/AIRI_logo.png" alt="company logo">-->
  <!--  </div>-->

  <!--  <div class="image">-->
  <!--    <img src="assets/RCAIoT_logo.png" alt="company logo">-->
  <!--  </div>-->

  <!--  <p class="footer-heading">Research Center for AI and IoT</p>-->
  <!--  <p class="footer-text">We Specialize in designing AI-based solutions for smart societies</p>-->

  <!--  <div class="footer-section">-->
  <!--    <p class="footer-heading">Contact us</p>-->
  <!--    <ul class="footer-list">-->
  <!--      <li>-->
  <!--        <i class="fas fa-map-marker-alt"></i>-->
  <!--        <p>Research Center for AI and IoT,</p>-->
  <!--        <p>AI and Robotics Institute,</p>-->
  <!--        <p>Near East University,</p>-->
  <!--        <p>Near East Blvd,</p>-->
  <!--        <p>99138 Mersin 10,</p>-->
  <!--        <p>Nicosia TRNC-->
  <!--      </li>-->
  <!--      <li>-->
  <!--        <i class="fas fa-phone"></i>-->
  <!--        <p>+90 542 852 09 85</p>-->
  <!--      </li>-->
  <!--    </ul>-->
  <!--  </div>-->

  <!--  <div class="footer-section">-->
  <!--    <p class="footer-heading">Services</p>-->
  <!--    <ul class="footer-list">-->
  <!--      <li>-->
  <!--        <i class="fas fa-home"></i>-->
  <!--        <p>Smart Home Solutions</p>-->
  <!--        <i class="fas fa-graduation-cap"></i>-->
  <!--        <p>Smart Education Solutions</p>-->
  <!--        <i class="fas fa-medkit"></i>-->
  <!--        <p>Smart Healthcare Solutions</p>-->
  <!--        <i class="fas fa-chalkboard-teacher"></i>-->
  <!--        <p>Training</p>-->
  <!--        <i class="fas fa-handshake"></i>-->
  <!--        <p>Consultancy</p>-->
  <!--      </li>-->
  <!--    </ul>-->
  <!--  </div>-->

  <!--</footer>-->

  <script>
    // Function to send chat message to the server
    const udata = JSON.parse(sessionStorage.user);
    const cse = sessionStorage.getItem('courseToLearn');
    var myuid = udata.uid;
    console.log('USER ID: ', myuid);
    console.log('COURSE ID: ', cse);

    function sendChatMessage(message) {
      console.log('SEND chat CALLED');

      $.ajax({
        url: 'api/api.php',
        method: 'POST',
        data: {
          action: 'sendMessage',
          message: message,
          userId: myuid,
          courseId: cse
        },
        success: function (response) {
          // Update chat history
          console.log(response);
          const chatHistory = $('#chatroom-chat-history');
          chatHistory.empty();
          chatHistory.append(formatChatMessage(response.messageHistory));
          chatHistory.scrollTop(chatHistory[0].scrollHeight);

          // Update logged-in users
          const loggedInUsers = $('#logged-in-users');
          loggedInUsers.html(formatLoggedInUsers(response.loggedInUsers));
        },
        error: function () {
          alert('Error sending message.');
        }
      });
    }

    // Format chat message HTML
    function formatChatMessage(messageHistory) {
      const currentUser = JSON.parse(sessionStorage.getItem('user'));

      return messageHistory.map(message => {
        const isCurrentUser = message.user.name === currentUser.name;
        const messagePosition = isCurrentUser ? 'right' : 'left';
        const avatarPosition = isCurrentUser ? 'right' : 'left';

        let messageContent = `<span class="message-content">${message.message}</span>`;
        let nameContent = `<span class="message-author">${message.user.name}</span>`;
        let avatarContent = `<img src="${message.user.photo}" alt="${message.name} Avatar" class="avatar ${avatarPosition}">`;

        if (messagePosition === 'left') {
          return `<p class="${messagePosition}-message">
                ${avatarContent}
                ${nameContent}
                ${messageContent}
              </p>`;
        } else {
          return `<p class="${messagePosition}-message">
                ${messageContent}
                ${nameContent}
                ${avatarContent}
              </p>`;
        }
      }).join('\n');
    }

    // Format logged-in users HTML
    function formatLoggedInUsers(users) {
      let html = '';
      users.forEach(user => {
        html += `<p><img src="${user.photo}" alt="${user.name} Avatar" class="avatar"> ${user.name}</p>`;
      });
      return html;
    }

    // Send chat message to server on Enter key press
    const messageTextarea = $('#chatroom-message-textarea');
    messageTextarea.on('keyup', function (event) {
      if (event.key === 'Enter' && !event.shiftKey) {
        event.preventDefault();
        sendMessageTriggered();
      }
    });

    function sendMessageTriggered() {
      const message = messageTextarea.val().trim();
      if (message) {
        console.log('MESSAGE TO SEND IS: ', message);
        sendChatMessage(message);
        messageTextarea.val('');
      }
    }


    // Load initial chat history and logged-in users
    $(document).ready(function () {

      // Function to make AJAX call and update chat history and logged-in users
      function updateChatAndUsers() {
        $.ajax({
          url: 'api/api.php',
          method: 'POST',
          data: {
            action: 'sendMessage',
            message: 'init',
            userId: myuid,
            courseId: cse
          },
          success: function (response) {
            // Update chat history
            const chatHistory = $('#chatroom-chat-history');
            const isScrolledToBottom = chatHistory[0].scrollHeight - chatHistory.scrollTop() === chatHistory.outerHeight();
            chatHistory.append(formatChatMessage(response.messageHistory));

            // Scroll to the bottom if already at the bottom before adding new messages
            if (isScrolledToBottom) {
              chatHistory.animate({ scrollTop: chatHistory.prop("scrollHeight") }, 300);
            }

            // Update logged-in users
            const loggedInUsers = $('#logged-in-users');
            loggedInUsers.html(formatLoggedInUsers(response.loggedInUsers));
          },
          error: function () {
            alert('Error sending message.');
          }
        });
      }

      // Call the updateChatAndUsers function every two seconds
      // setInterval(updateChatAndUsers, 2000); // 2000 milliseconds = 2 seconds
      updateChatAndUsers();


    });
  </script>
  <script>
    let gradesButton = document.getElementById('grades-button');

    gradesButton.addEventListener('click', function () {
      console.log('GRADES BUTTON CLICKED', sid);
      $.ajax({
        url: 'api/api.php',
        method: 'POST',
        data: {
          studentId: sid,
          courseId: sessionStorage.getItem('courseForGrade'),
          topicId: sessionStorage.getItem('topicForGrade'),
          action: 'fetchGrades',
        },
        success: function (res) {
          response = JSON.parse(res);
          console.log('FETCHED GRADES DATA: ', res);
          if (response !== null) {
            console.log('GRADES ARE: ', response);
            var mdata = {
              accuracy: response.accuracy,
              promptEfficiency: response.promptEfficiency,
              timeEfficiency: response.timeEfficiency,
              total: response.total
            };
            console.log('MDATA: ', mdata);
            console.log('accuracy: ', mdata.accuracy);
            populateDashboard(mdata);

            var tdata = {
              topics: response.topics,
              scores: response.scores
            };
            console.log('TDATA: ', tdata)
            populateProgressBars(tdata);

            sessionStorage.setItem('grades', JSON.stringify(response));
          } else {

            var mdata = {
              accuracy: 'N/A',
              promptEfficiency: 'N/A',
              timeEfficiency: 'N/A',
              total: 'N/A'
            };

            populateDashboard(mdata);

            var tdata = {
              topics: "Lecture not completed yet.",
              scores: 0
            };

            populateProgressBars(tdata);


          }
        },
        error: function () {
          console.error('Failed to fetch grades from the server.');
        }
      });

      function populateDashboard(data) {
        $('#accuracyScore').text(`Score: ${data.accuracy}%`);
        $('#promptEfficiencyScore').text(`Score: ${data.promptEfficiency}%`);
        $('#timeEfficiencyScore').text(`Score: ${data.timeEfficiency}%`);
        $('#totalGradeScore').text(`Score: ${data.total}%`);
      }

      function populateProgressBars(data) {
        const progressBarsContainer = $('#progressBarsContainer');
        const { topics, scores } = data;

        progressBarsContainer.empty();
        const progressBar = createProgressBar(topics, scores);
        //progressBarsContainer.innerHTML = ''; // Clear the container
        progressBarsContainer.append(progressBar);
      }

      function createProgressBar(label, percentage) {
        const progressBar = $('<div>').addClass('progress-bar');
        const progressBarLabel = $('<div>').addClass('progress-bar-label').text(label);
        const progressBarFill = $('<div>').addClass('progress-bar-fill').css('width', `${percentage}%`);
        const progressBarPercentage = $('<div>').addClass('progress-bar-percentage').text(`${percentage}%`);

        progressBar.append(progressBarLabel, progressBarFill, progressBarPercentage);
        return progressBar;
      }
    });
  </script>

  <style>
    /* Hide all tab contents by default */
    .tab-content>.tab-pane-2 {
      display: none;
    }

    /* Display the active tab content */
    .tab-content>.active {
      display: block;
    }

    .nav-link-2 {
      display: inline-block;
      padding: 10px 20px;
      background-color: #a8c7bb;
      color: #fff;
      text-decoration: none;
      border-radius: 4px;
      transition: background-color 0.3s ease;
    }

    .nav-link-2:hover {
      background-color: #6891b6;
    }

    .nav-link-2.active {
      background-color: #007bff;
    }


    /* FOR COURSES CARD */
    .cardc {
      width: 100%;
      border-radius: 10px;
      /* Rounded corners */
      padding: 10px;
      background: white;
    }

    .card-group {
      display: grid;
      grid-gap: 20px;
    }

    .cardc-body {
      display: grid;
      grid-template-columns: auto 1fr;
      align-items: center;
      grid-gap: 20px;
      color: var(--accent);
    }

    .details-wrapper {
      grid-column: 1/-1;
    }

    .special-card {
      padding: 30px;
      grid-template-columns: auto 1fr auto;
    }

    .course-tname {
      color: var(--pop);
    }

    .circular-check-mark {
      /* color: var(--accent); */
      font-size: 24px;
    }
  </style>

  <script>
    function adjustTextareaHeight(textarea) {
      textarea.style.height = 'auto'; // Reset the height
      textarea.style.height = textarea.scrollHeight + 'px'; // Set the height to fit the content
    }
  </script>


  <script>
    // JavaScript code to handle tab switching
    $(document).ready(function () {
      // When a tab is clicked, switch to the corresponding tab content
      $(".nav-link-2").on("click", function (e) {
        // Get the target tab's href attribute
        e.preventDefault(); // Prevent the default link behavior
        const targetTab = $(this).attr("href");
        const instSec = document.querySelector(".instructions-section");
        instSec.style.display = "none";
        // Hide all tab contents
        $(".tab-pane-2").removeClass("show active");


        // Show the target tab content
        $(targetTab).addClass("show active");
      });
    });
  </script>

  <script>

    function showPopup(message) {
      // Create a popup container
      const popupContainer = document.createElement('div');
      popupContainer.className = 'popup-container';

      // Create the popup content
      const popupContent = document.createElement('div');
      popupContent.className = 'popup-content';

      // Create the close button
      const closeButton = document.createElement('span');
      closeButton.className = 'popup-close-btn';
      closeButton.innerHTML = '&times;'; // The "x" symbol for closing

      // Create the FontAwesome checkmark icon
      const checkIcon = document.createElement('i');
      checkIcon.className = 'fa fa-check-circle';

      // Create the message element
      const messageElement = document.createElement('p');
      messageElement.textContent = message;

      // Append the close button, checkmark icon, and message to the popup content
      popupContent.appendChild(closeButton);
      popupContent.appendChild(checkIcon);
      popupContent.appendChild(messageElement);

      // Append the popup content to the popup container
      popupContainer.appendChild(popupContent);

      // Add a click event listener to the close button
      closeButton.addEventListener('click', () => {
        document.body.removeChild(popupContainer);
      });

      // Add the popup container to the document body
      document.body.appendChild(popupContainer);
    }
  </script>

  <script>
    // JavaScript code for tab functionality
    $(document).ready(function () {
      // Get the active tab from session storage or set default to 'classroom'
      var activeTab = sessionStorage.getItem('activeTab') || 'classroom';

      console.log("activeTab: ", activeTab);

      // Show the corresponding tab content
      $('.tab-contents').hide();
      $('#' + activeTab + '-content').show();

      // Handle tab clicks
      $('.nav-link').on('click', function (e) {
        e.preventDefault();
        var tabId = $(this).data('tab');
        $('.tab-contents').hide();
        $('#' + tabId + '-content').show();
        // Store the active tab in session storage
        sessionStorage.setItem('activeTab', tabId);
      });


      function validateSessionToken(token) {
      
    $.ajax({
        url: '../api/api.php',
        type: 'POST',
        dataType: 'json',
        data: { action: 'validateSession', token: token },
        success: function(response) {
            if (response.status === 'success') {
                // Session token is valid, you can proceed with user interactions
                console.log('Session token is valid');
            } else {
                // Session token is not valid, log the user out or take appropriate action
                console.error('Session token validation failed: ' + response.message);
                // Call the logout function when the token is not valid
                logout();
            }
        },
        error: function(error) {
            console.error('Error validating session token: ' + error);
        }
    });
}

// Get the session token from sessionStorage
const sessionToken = JSON.parse(sessionStorage.getItem('user')).token;
// validateSessionToken(sessionToken); // TODO:

    });

    // JavaScript code for logout functionality
    function logout() {
      // Get the email from sessionStorage
      var email = sessionStorage.getItem('user');

      // Clear user data from session storage
      sessionStorage.clear();

      // Call API to perform logout
      $.ajax({
        url: 'api/api.php',
        method: 'POST',
        data: {
          action: 'logout',
          email: email
        },
        success: function (response) {
          // Redirect to index.html after successful logout
          window.location.href = 'auth.html';
        },
        error: function (xhr, status, error) {
          // Handle error if necessary
          console.error(error);
          // Redirect to index.html regardless of the API call result
          window.location.href = 'auth.html';
        }
      });
    }
  </script>







  <script>
    // JavaScript code to dynamically add Semester Grades cards
    $(document).ready(function () {
      // Example data for Semester Grades (Replace this with your dynamic data)
      const weeklyQuizzesData = [
        { cardTitle: 'Quiz 1', icon: 'fas fa-book', scoreId: 'quiz1Score' },
        // Add more data for weekly quizzes as needed...
      ];

      const midTermExamData = [
        { cardTitle: 'Mid-Term', icon: 'fas fa-code', scoreId: 'midTermScore' },
        // Add more data for mid-term exams as needed...
      ];

      const finalExamData = [
        { cardTitle: 'Final Exam', icon: 'fas fa-language', scoreId: 'finalExamScore' },
        // Add more data for final exams as needed...
      ];

      const totalData = [
        { cardTitle: 'Total Grade', icon: 'fas fa-rocket', scoreId: 'totalScore' },
        // Add more data for the total grade as needed...
      ];

      // Function to create a Semester Grades card
      function createSemesterGradesCard(data) {
        const card = $('<div>').addClass('card').css('background-color', '#9168ec');
        const cardTitle = $('<div>').addClass('title').text(data.cardTitle);
        const icon = $('<i>').addClass(data.icon);
        const score = $('<div>').addClass('value').attr('id', data.scoreId).text('Score: ');

        card.append(cardTitle, icon, score);
        return card;
      }

      // Get the containers for Semester Grades cards
      const weeklyQuizzesGrid = $('#weeklyQuizzesGrid');
      const midTermExamGrid = $('#midTermExamGrid');
      const finalExamGrid = $('#finalExamGrid');
      const totalGrid = $('#totalGrid');

      // Add Weekly Quizzes cards to the container
      for (const quizData of weeklyQuizzesData) {
        const card = createSemesterGradesCard(quizData);
        weeklyQuizzesGrid.append(card);
      }

      // Add Mid-Term Exam cards to the container
      for (const examData of midTermExamData) {
        const card = createSemesterGradesCard(examData);
        midTermExamGrid.append(card);
      }

      // Add Final Exam cards to the container
      for (const examData of finalExamData) {
        const card = createSemesterGradesCard(examData);
        finalExamGrid.append(card);
      }

      // Add Total Grade cards to the container
      for (const tData of totalData) {
        const card = createSemesterGradesCard(tData);
        totalGrid.append(card);
      }
    });
  </script>



  <script>
    // Check if the user data is present in sessionStorage
    const userDataa = sessionStorage.getItem('user');
    // If user data is not present, redirect to index.html
    if (!userDataa) {
      window.location.href = 'index.html';
    } else {
      const user = JSON.parse(sessionStorage.getItem('user'));
      setUsernameDetails(user);
    }
  </script>






  <script>

    const userData = JSON.parse(sessionStorage.user);
    // Access the stdnumber property
    var sid = userData.stdnumber;

    $(document).ready(function () {
      // $.ajax({
      //   url: 'api/api.php',
      //   method: 'POST',
      //   data: {
      //     studentId: sid,
      //     courseId: sessionStorage.getItem('courseForGrade'),
      //     topicId: sessionStorage.getItem('topicForGrade'),
      //     action: 'fetchGrades',
      //   },
      //   success: function (res) {
      //     response = JSON.parse(res);
      //     console.log('GRADES ARE: ', response);
      //     var mdata = {
      //       accuracy: response.accuracy[0],
      //       promptEfficiency: response.promptEfficiency[0],
      //       timeEfficiency: response.timeEfficiency[0],
      //       total: response.total[0]
      //     };
      //     console.log('MDATA: ', mdata);
      //     console.log('accuracy: ', mdata.accuracy);
      //     populateDashboard(mdata);

      //     var tdata = {
      //       topics: response.topics,
      //       scores: response.scores
      //     };
      //     console.log('TDATA: ', tdata)
      //     populateProgressBars(tdata);

      //     sessionStorage.setItem('grades', JSON.stringify(response));
      //   },
      //   error: function () {
      //     console.error('Failed to fetch grades from the server.');
      //   }
      // });

      // function populateDashboard(data) {
      //   $('#accuracyScore').text(`Score: ${data.accuracy}%`);
      //   $('#promptEfficiencyScore').text(`Score: ${data.promptEfficiency}%`);
      //   $('#timeEfficiencyScore').text(`Score: ${data.timeEfficiency}%`);
      //   $('#totalGradeScore').text(`Score: ${data.total}%`);
      // }

      // function populateProgressBars(data) {
      //   const progressBarsContainer = $('#progressBarsContainer');
      //   const { topics, scores } = data;

      //   for (let i = 0; i < topics.length; i++) {
      //     const progressBar = createProgressBar(topics[i], scores[i]);
      //     progressBarsContainer.append(progressBar);
      //   }
      // }

      // function createProgressBar(label, percentage) {
      //   const progressBar = $('<div>').addClass('progress-bar');
      //   const progressBarLabel = $('<div>').addClass('progress-bar-label').text(label);
      //   const progressBarFill = $('<div>').addClass('progress-bar-fill').css('width', `${percentage}%`);
      //   const progressBarPercentage = $('<div>').addClass('progress-bar-percentage').text(`${percentage}%`);

      //   progressBar.append(progressBarLabel, progressBarFill, progressBarPercentage);
      //   return progressBar;
      // }
    });
  </script>

  <script>

    // Retrieve the studentId from the userData
    let studentId = userData.stdnumber;

    // Function to fetch and display the course list
    function fetchCoursesC(studentId) {
      $.ajax({
        url: 'api/api.php',
        method: 'POST',
        data: { action: 'fetchCourses', studentId: studentId },
        //dataType: 'json',
        success: function (response) {
          console.log('COURSE CATALOG FETCHED SUCCESSFULY', response);
          displayCourseList(response);

        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.error('Failed to fetch courses:', errorThrown);
        }
      });
    }

    // Function to display the course list
    function displayCourseList(courses) {
      const courseListContainer = $('#courseListAll');
      courseListContainer.empty();

      courses.forEach(course => {
        const listItem = $('<div class="cardc"></div>');

        const icon = $('<i class="fa fa-book circular-check-mark"></i>');
        const name = $('<span class="course-name" style="font-size: 18px;"></span>').text(course.name);
        const checkbox = $('<input type="checkbox" class="subscription-checkbox">')
          .attr('data-course-id', course.id)
          .attr('data-student-id', studentId);

        if (course.status === 'Subscribed') {
          checkbox.prop('checked', true);
        }

        const cardBody = $('<div class="cardc-body special-card"></div>')
          .append(icon)
          .append(name)
          .append($('<div class="checkbox-container"></div>').append(checkbox));

        // Display tname and temail values in new lines
        const tname = $('<div class="course-tname"></div>').text('Instructor: ' + course.tname);
        const temail = $('<div class="course-temail" style="font-size: 16px;"></div>').text('Email: ' + course.temail);

        const detailsWrapper = $('<div class="details-wrapper"></div>')

        detailsWrapper.append(tname).append(temail);
        cardBody.append(detailsWrapper);

        listItem.append(cardBody);
        courseListContainer.append(listItem);
      });

      // Attach event listener to the checkboxes
      $('.subscription-checkbox').on('change', function () {
        const courseId = $(this).data('course-id');
        const studentId = $(this).data('student-id');
        const isChecked = $(this).prop('checked');

        if (isChecked) {
          subscribeToCourse(courseId, studentId);
        } else {
          unsubscribeFromCourse(courseId, studentId);
        }
      });
    }


    // Function to subscribe to a course
    function subscribeToCourse(courseId, studentId) {
      $.ajax({
        url: 'api/api.php',
        method: 'POST',
        data: { action: 'subscribeToCourse', studentId: studentId, courseId: courseId },
        //dataType: 'json',
        success: function (response) {

          console.log('Subscribed to course:', response);
          window.location.href = 'home.php';
        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.error('Failed to subscribe to course:', errorThrown);
        }
      });
    }

    // Function to unsubscribe from a course
    function unsubscribeFromCourse(courseId, studentId) {
      $.ajax({
        url: 'api/api.php',
        method: 'POST',
        data: { action: 'unsubscribeFromCourse', studentId: studentId, courseId: courseId },
        //dataType: 'json',
        success: function (response) {

          console.log('Unsubscribed from course:', response);
          window.location.href = 'home.php';
        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.error('Failed to unsubscribe from course:', errorThrown);
        }
      });
    }

    // Call the fetchCourses function to populate the course list on page load
    fetchCoursesC(studentId);

  </script>


  <script>

    // Retrieve the studentId from the userData
    // const studentId = userData.stdnumber;

    // Function to fetch and display the course list
    function fetchApprovedCourses(studentId) {
      $.ajax({
        url: 'api/api.php',
        method: 'POST',
        data: { action: 'fetchApprovedCourses', studentId: studentId },
        //dataType: 'json',
        success: function (response) {
          console.log('APPROVED COURSES FETCHED SUCCESSFULY', response);
          displayApprovedCourseList(response);

        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.error('Failed to fetch courses:', errorThrown);
        }
      });
    }

    // Function to display the course list
    function displayApprovedCourseList(courses) {
      const courseListContainer = $('#courseList');
      courseListContainer.empty();

      courses.forEach(course => {
        if (course.status === 'Approved') {
          const listItem = $('<div class="cardc"></div>');

          const icon = $('<i class="fas fa-check-circle circular-check-mark"></i>');
          const name = $('<span class="course-name"></span>').text(course.name);

          const cardBody = $('<div class="cardc-body"></div>')
            .append(icon)
            .append(name);

          listItem.append(cardBody);
          courseListContainer.append(listItem);
        }
      });

      // Attach event listener to the checkboxes
      // $('.subscription-checkbox').on('change', function () {
      //   const courseId = $(this).data('course-id');
      //   const studentId = $(this).data('student-id');
      //   const isChecked = $(this).prop('checked');

      //   if (isChecked) {
      //     subscribeToCourse(courseId, studentId);
      //   } else {
      //     unsubscribeFromCourse(courseId, studentId);
      //   }
      // });
    }

    // Function to subscribe to a course
    // function subscribeToCourse(courseId, studentId) {
    //   $.ajax({
    //     url: 'api/api.php',
    //     method: 'POST',
    //     data: { action: 'subscribeToCourse', studentId: studentId, courseId: courseId },
    //     //dataType: 'json',
    //     success: function (response) {

    //       console.log('Subscribed to course:', response);
    //       window.location.href = 'home.php';
    //     },
    //     error: function (jqXHR, textStatus, errorThrown) {
    //       console.error('Failed to subscribe to course:', errorThrown);
    //     }
    //   });
    // }

    // // Function to unsubscribe from a course
    // function unsubscribeFromCourse(courseId, studentId) {
    //   $.ajax({
    //     url: 'api/api.php',
    //     method: 'POST',
    //     data: { action: 'unsubscribeFromCourse', studentId: studentId, courseId: courseId },
    //     //dataType: 'json',
    //     success: function (response) {

    //       console.log('Unsubscribed from course:', response);
    //       window.location.href = 'home.php';
    //     },
    //     error: function (jqXHR, textStatus, errorThrown) {
    //       console.error('Failed to unsubscribe from course:', errorThrown);
    //     }
    //   });
    // }

    // Call the fetchCourses function to populate the course list on page load
    fetchApprovedCourses(studentId);

  </script>


  <script>
    $(document).ready(function () {
      // Retrieve studentId from sessionStorage



      // Fetch courses for the user on page load
      fetchCoursesForUser(sid, '#course');
      fetchCoursesForUser(sid, '#courseG');
      fetchCoursesForUser(sid, '#courseGS');

      // Handle course selection change event
      $('#course').change(function (e) {
        e.preventDefault();
        const courseId = $(this).val();
        if (courseId) {
          fetchTopics(courseId, '#topic');
          sessionStorage.setItem('courseToLearn', courseId); // Save selected course to sessionStorage
        } else {
          // Clear topic options if no course is selected
          const topicSelect = $('#topic');
          topicSelect.empty();
          sessionStorage.setItem('topicToLearn', null);
        }
      });


      // Handle topic selection change event
      $('#topic').change(function (e) {
        e.preventDefault();
        const topicId = $(this).val();
        if (topicId) {
          sessionStorage.setItem('topicToLearn', topicId); // Save selected topic to sessionStorage
          // if (topicId === 'Mid Term Exam') {
          //   const examDiv = document.getElementById('myExam');
          //   const imageDiv = document.getElementById('instructions-image-container')
          //   const instDiv = document.getElementById('instructions')
          //   examDiv.style.display = 'block';
          //   imageDiv.innerHTML="";
          //   instDiv.innerHTML="";
        
          // }

          const tid = topicId;
          
          console.log("tid:",tid);
if (tid === 'Mid Term Exam' || tid === 'Final Exam') {
  const examDiv = document.getElementById('myExam');
  const imageDiv = document.getElementById('instructions-image-container')
  const instDiv = document.getElementById('instructions')
  examDiv.style.display = 'block';
  imageDiv.style.display = 'none';
  instDiv.style.display = 'none';

}else{
  const examDiv = document.getElementById('myExam');
  const imageDiv = document.getElementById('instructions-image-container')
  const instDiv = document.getElementById('instructions')
  examDiv.style.display = 'none';
  imageDiv.style.display = 'block';
  instDiv.style.display = 'block';
}


        }
      });


      $('#courseG').change(function (e) {
        e.preventDefault();
        const courseId = $(this).val();
        if (courseId) {
          fetchTopics(courseId, '#topicG');
          sessionStorage.setItem('courseForGrade', courseId); // Save selected course to sessionStorage
        } else {
          // Clear topic options if no course is selected
          const topicSelect = $('#topicG');
          topicSelect.empty();
          sessionStorage.setItem('topicForGrade', null);
        }
      });


      // Handle topic selection change event
      $('#topicG').change(function () {
        const topicId = $(this).val();
        if (topicId) {
          sessionStorage.setItem('topicForGrade', topicId); // Save selected topic to sessionStorage

        }
      });

      $('#courseGS').change(function (e) {
        e.preventDefault();
        const courseId = $(this).val();
        if (courseId) {
          //fetchTopics(courseId, '#topicG');
          sessionStorage.setItem('semesterCourseForGrade', courseId); // Save selected course to sessionStorage
        }
      });


      const semGradesButton = document.getElementById('semester-grades-button');
      semGradesButton.addEventListener('click', function (e) {
        e.preventDefault();


        $.ajax({
          url: 'api/api.php',
          type: 'POST',
          data: {
            studentId: sid,
            courseId: sessionStorage.getItem('semesterCourseForGrade'),
            action: 'fetchSemesterGrades'
          },
          dataType: 'json',
          success: function (data) {
            // Update the card elements with the received data
            $('#weeklyEvaluationScore').text('Score: ' + data.weekly_score);
            $('#midTermExamScore').text('Score: ' + data.midterm_score);
            $('#finalExamScore').text('Score: ' + data.exam_score);
            $('#totalSemesterScore').text('Score: ' + data.total_score);
            $('#semesterRemark').text(data.remark);
            $('#letterGrade').text(data.letter_grade);
          },
          error: function (xhr, status, error) {
            console.error('Error:', error);
          }
        });
      });



    });
  </script>


  <script>
    $(document).ready(function () {
      // Set the default view to "This Week"
      var ttuser = JSON.parse(sessionStorage.getItem('user'));
      var view = "week";

      // Function to get the timetable data from the server
      function getTimetableData(studentNumber) {
        $.ajax({
          url: 'api/api.php',
          method: "POST",
          data: {
            action: "fetchTimetableData",
            studentId: studentNumber,
          },
          dataType: "json",
          success: function (data) {
            console.log("FETCHED TIMETABLE: ", data);
            // Clear the current timetable
            $("#timetable-row").empty();

            // Loop through the data and add cards to the timetable
            $.each(data, function (index, item) {
              // Loop through the lectures in the item
              $.each(item, function (id, lecture) {
                console.log("lecture: ", lecture);
                // Check if the lecture's datetime is within the current view
                if (isDateTimeWithinView(lecture.date, view)) {
                  // Create a card with the lecture's data
                  var card = $(`<div class="col-md-12" style="max-width:100%;">
                <div class="carddd">
                  <div class="carddd-body">
                    <h5 class="carddd-title">Course: ${index}</h5>
                    <h6 class="carddd-subtitle mb-2 text-muted">Lecture: ${lecture.lectureTitle}</h6>
                    <p class="carddd-text">Date: ${lecture.date}</p>
                  </div>
                </div>
              </div>`);
                  $("#timetable-row").append(card);
                }
              });
            });
          },
          error: function (xhr, status, error) {
            // Handle the error here
            console.log("Error: " + error);
          },
        });
      }

      // Function to check if a datetime is within the current view
      function isDateTimeWithinView(datetime, view) {
        // Get the current date
        var currentDate = new Date();
        var year = currentDate.getFullYear();
        var month = currentDate.getMonth() + 1;
        var day = currentDate.getDate();

        // Get the start and end dates for the current view
        var startDate, endDate;
        if (view == "week") {
          // Get the start and end dates for the current week
          var currentDayOfWeek = currentDate.getDay();
          startDate = new Date(year, month - 1, day - currentDayOfWeek);
          endDate = new Date(year, month - 1, day + (6 - currentDayOfWeek));
        } else if (view == "month") {
          // Get the start and end dates for the current month
          startDate = new Date(year, month - 1, 1);
          endDate = new Date(year, month, 0);
        } else if (view == "year") {
          // Get the start and end dates for the current year
          startDate = new Date(year, 0, 1);
          endDate = new Date(year, 11, 31);
        }

        // Convert the datetime to a Date object
        var datetimeObj = new Date(datetime);

        // Check if the datetime is within the current view
        return datetimeObj >= startDate && datetimeObj <= endDate;
      }

      // Get the timetable data for the default view
      var studentNumber = ttuser.stdnumber;
      getTimetableData(studentNumber);

      // Handle the "This Week" button click
      $("#week-btn").click(function () {
        view = "week";
        getTimetableData(studentNumber);
      });

      // Handle the "This Month" button click
      $("#month-btn").click(function () {
        view = "month";
        getTimetableData(studentNumber);
      });

      // Handle the "This Year" button click
      $("#year-btn").click(function () {
        view = "year";
        getTimetableData(studentNumber);

      });
    });
  </script>


  <script>
    var messages;
    var custodian;
    var sentMessages;
    var unreadMessages;
    var readMessages;
    $(document).ready(function () {
      const userDatam = JSON.parse(sessionStorage.getItem('user'));
      var stdNumber = userDatam.stdnumber; // Replace with the actual student number
      var unread_count;
      var inbox_count;
      var sent_count;
      var spam_count = 0;

      // Function to populate messages in a tab
      // function populateMessagesTab(tabId, messages) {
      //   var tabContent = '';
      //   if (messages && messages.length > 0) {
      //     for (var i = 0; i < messages.length; i++) {
      //       var message = messages[i];
      //       tabContent += '<div class="message">';
      //       tabContent += '<div class="message-sender">' + message.from + '</div>';
      //       tabContent += '<div class="message-subject">' + message.subject + '</div>';
      //       tabContent += '<div class="message-body">' + message.body + '</div>';
      //       tabContent += '</div>';
      //     }
      //   } else {
      //     tabContent += '<p>No messages.</p>';
      //   }
      //   $('#' + tabId + '-tab').html(tabContent);
      // }

      // Make AJAX call to get messages
      $.ajax({
        url: 'api/api.php',
        type: 'POST',
        data: {
          action: 'get_all_messages',
          stdNumber: stdNumber
        },
        success: function (response) {
          try {
            messages = response.messages;
            inbox_count = messages.length;
            custodian = response.owner;

            console.log("MESSAGES: ", messages);
            // populateMessagesTab('all-messages', messages);

            sentMessages = response.sent_messages;
            sent_count = messages.filter(message => message.from === custodian).length;
            // populateMessagesTab('sent', sentMessages);

            unreadMessages = response.unread_messages;
            unread_count = messages.filter(message => message.is_read == 0).length;
            // populateMessagesTab('unread', unreadMessages);

            readMessages = response.read_messages;
            // populateMessagesTab('read', readMessages);

            var unreadCountElement = document.getElementById("unreadCount");
            var inboxCountElement = document.getElementById("inboxCount");
            var sentCountElement = document.getElementById("sentCount");

            unreadCountElement.textContent = unread_count;
            sentCountElement.textContent = sent_count;
            inboxCountElement.textContent = inbox_count;



          } catch (error) {
            console.error("Error processing messages:", error);
          }
        },
        error: function () {
          alert('Error fetching messages.');
        }
      });
    });



    // Function to display messages based on the selected tab
    // function showTab(tabName) {
    //   // Get the content element where messages will be displayed
    //   const content = document.getElementById('content');

    //   // Filter messages based on the selected tab and display them
    //   const filteredMessages = messages.filter((message) => {
    //     if (tabName === "Unread") return message.is_read == 0; // For the sake of this mock scenario, we don't have unread messages
    //     if (tabName === "Inbox") return true; // Display all messages for the Inbox tab
    //     if (tabName === "Sent") return message.from === custodian;
    //     if (tabName === "Spam") return false; // For the sake of this mock scenario, we don't have spam messages
    //   });

    //   // Render the list of messages in the content element
    //   content.innerHTML = `<ul>${filteredMessages.map(message => `<li onclick="showMessage('${message.id}')">${message.subject}</li>`).join('')}</ul>`;
    // }


    function showTab(tabName) {
      // Get the content element where messages will be displayed
      const content = document.getElementById('content');

      // Filter messages based on the selected tab and display them
      const filteredMessages = messages.filter((message) => {
        if (tabName === "Unread") return message.is_read == 0;
        if (tabName === "Inbox") return true;
        if (tabName === "Sent") return message.from === custodian;
        if (tabName === "Spam") return false;
      });

      // Render the list of messages in the content element
      const listItems = filteredMessages.map((message) => {
        return `<li data-messageid="${message.id}" onclick="showMessage('${message.id}')">${message.subject}</li>`;
      });

      const list = `<ul>${listItems.join('')}</ul>`;
      content.innerHTML = list;

      // Add click event listener to list items
      $('li', content).on('click', function () {
        const messageId = $(this).data('messageid');

        // Make the AJAX call to change the message status
        $.ajax({
          url: 'api/api.php',
          type: 'POST',
          data: {
            action: 'statusChange',
            messageId: messageId
          },
          success: function (response) {
            // Handle the success response
            console.log('Message status changed successfully');
            console.log('Response:', response);

            // Update the UI to reflect the updated message status
            $(this).addClass('read'); // Add a CSS class to indicate the message is read
          },
          error: function (xhr, status, error) {
            // Handle the error response
            console.log('Error changing message status');
            console.log('Status:', status);
            console.log('Error:', error);
          }
        });
      });
    }


    // Function to display the full message card
    function showMessage(messageId) {
      const message = messages.find(message => message.id == parseInt(messageId));
      console.log("FOUND MSG: ", message);
      const messageCard = document.getElementById('messageCard');
      cancelCreateMessage();

      messageCard.innerHTML = `
  <h2>${message.subject}</h2>
  <p>From: ${message.from}</p>
  <p>${message.body}</p>
  <button class="close-btnM" onclick="hideMessageCard()">Close</button>
`;

      messageCard.style.display = "block";
    }

    // Function to hide the full message card
    function hideMessageCard() {
      const messageCard = document.getElementById('messageCard');
      messageCard.style.display = "none";
    }

    // Function to show the create message card
    function showCreateMessageCard() {
      const createMessageCard = document.getElementById('createMessageCard');
      createMessageCard.style.display = "block";
      hideMessageCard();
    }

    // Function to hide the create message card and reset the form
    function cancelCreateMessage() {
      const createMessageCard = document.getElementById('createMessageCard');
      createMessageCard.style.display = "none";
      document.getElementById('createMessageForm').reset();
    }



    function sendMessageB() {
      // Create a FormData object to handle file upload
      var formData = new FormData();

      // Add form fields to the FormData object
      formData.append('action', 'emailInstructor');
      formData.append('instructor', $('#instructor-list').val());
      formData.append('subject', $('#subject').val());
      formData.append('message', $('#message').val());

      // Add the attachment file (if selected)
      var attachmentInput = $('#attachment')[0];
      if (attachmentInput.files.length > 0) {
        formData.append('attachment', attachmentInput.files[0]);
      }

      $.ajax({
        type: 'POST',
        url: 'api/api.php',
        data: formData,
        processData: false, // Prevent jQuery from processing the data
        contentType: false, // Set content type to false, as FormData handles it
        success: function (response) {
          // Handle the success response here
          alert("Email Sent Successfully");
          // console.log('Email sent successfully:', response);
          // Clear form fields or perform any other actions as needed
          $('#instructor-list').val('');
          $('#subject').val('');
          $('#message').val('');
          $('#attachment').val('');
        },
        error: function (xhr, textStatus, errorThrown) {
          // Handle any AJAX errors here
          console.error('Error:', textStatus, errorThrown);
        }
      });
    }

    // Add an event listener to the form submission
    $('#createMessageForm').submit(function (event) {
      event.preventDefault(); // Prevent the default form submission

      // Call the sendMessage function when the form is submitted
      sendMessage();
    });


    // Function to handle sending the new message
    function sendMessage() {
      const to = document.getElementById('to').value;
      const subject = document.getElementById('subject').value;
      const messageBody = document.getElementById('message').value;
      //const attachment = $('#attachment').prop('files')[0];
      var attachment = $('#attachment')[0].files[0]
      var msguser = JSON.parse(sessionStorage.getItem('user'));

      // Create a FormData object to store the form data
      var formData = new FormData();
      formData.append('to', to);
      formData.append('subject', subject);
      formData.append('message', messageBody);
      formData.append('attachment', attachment);
      formData.append('studentId', msguser.stdnumber);
      formData.append('action', 'createMessage');

      console.log('data for created msg: ', formData);

      // Make the AJAX POST request
      $.ajax({
        url: 'api/api.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function (response) {
          // Handle the success response
          console.log('Message created successfully');
          console.log('Response:', response);
        },
        error: function (xhr, status, error) {
          // Handle the error response
          console.log('Error creating message');
          console.log('Status:', status);
          console.log('Error:', error);
        }
      });

      // Hide the create message card and reset the form
      cancelCreateMessage();

      // Refresh the message list based on the active tab
      const activeTab = document.querySelector('.tab-btnM.active');
      showTab(activeTab.innerText);
    }
  </script>





  <script>
    $(document).ready(function () {
      // Get the API key status and preview elements
      var apiKeyStatus = $('#api-key-status');
      var apiKeyPreview = $('#api-key-preview');

      // Retrieve the user data from session storage
      var userData = JSON.parse(sessionStorage.getItem('user'));
      var userId = userData.uid;

      // Function to update the API key status and preview
      function updateApiKeyStatus(apiKey) {
        if (apiKey) {
          apiKeyStatus.html('Your API key is Set <span class="fas fa-check-circle" style="color:green; font-size: 1.2em; margin-left: 0.2em;"></span>');
          apiKeyPreview.text(apiKey.substr(0, 10) + ' ... ' + apiKey.substr(40, 51));
          sessionStorage.setItem('token', apiKey);
        } else {
          apiKeyStatus.html('You have not Set an API key Yet <span class="fas fa-times-circle" style="color:red; font-size: 1.2em; margin-left: 0.2em;"></span>');
          apiKeyPreview.text('');
        }
      }

      // Retrieve the API key status and preview from the server
      $.ajax({
        url: 'api/api.php',
        type: 'POST',
        dataType: 'json',
        data: { action: 'getAPIKey', userId: userId },
        success: function (response) {
          var apiKey = response.apiKey;
          updateApiKeyStatus(apiKey);

          // Set the input field value to the retrieved API key
          $('#api-key-input').val('');
        },
        error: function () {
          console.log('Error occurred during API key retrieval.');
        }
      });

      // Handle form submission
      $('#api-key-form').submit(function (event) {
        event.preventDefault();

        // Get the entered API key
        var apiKey = $('#api-key-input').val();

        // Regular expression to validate the API key format
        var apiKeyRegex = /^sk-[a-zA-Z0-9]{48}$/;

        // Check if the entered API key matches the expected format
        if (!apiKeyRegex.test(apiKey)) {
          alert('Invalid API key format. Please enter a valid API key starting with "sk-" and consisting of 51 characters made up of numbers, lowercase and uppercase letters only.');
          return;
        }

        // Send the API key to the server for saving
        $.ajax({
          url: 'api/api.php',
          type: 'POST',
          dataType: 'json',
          data: {
            action: 'saveAPIKey',
            apiKey: apiKey,
            userId: userId
          },
          success: function (response) {
            if (response.success) {
              updateApiKeyStatus(apiKey);
            } else {
              alert('Failed to save API key. Please try again.');
            }
          },
          error: function () {
            console.log('Error occurred during API key saving.');
          }
        });
      });



    });


    $(document).ready(function () {
      // Get the styled card element
      var apiKeyInstructionsCard = $('#api-key-instructions-card');

      // Handle click event of the "Find out how to get one" link
      $('#get-api-key-link').click(function (event) {
        event.preventDefault();
        apiKeyInstructionsCard.show();
      });

      // Hide the styled card by default
      apiKeyInstructionsCard.hide();
    });
  </script>

  <script>

    $(document).ready(function () {

      // Access the stdnumber property
      const aaa = JSON.parse(sessionStorage.user);
      var sid = aaa.stdnumber;

      var action = 'getInstructorList';
      const data = {
        studentId: sid,
        action: action
      };

      console.log("DATA FOR INSTRUCTORS: ", data);
      // $.ajax({
      //   url: "api/api.php",
      //   method: "POST",
      //   data: {
      //     studentId: searchId,
      //     action: action
      //   },
      //   success: function(data) {
      //     console.log('RESPONSE FROM INST. LIST', data);
      //     // Populate the instructor-list select field
      //     $("#instructor-list").empty();
      //     for (var i = 0; i < data.length; i++) {
      //       var option = $("<option></option>");
      //       option.val(data[i].uid);
      //       option.text(data[i].courseId + " " + data[i].name);
      //       $("#instructor-list").append(option);
      //     }
      //   }
      // });


      $.ajax({
        url: 'api/api.php',
        method: 'POST',
        data: { studentId: sid, action: 'getInstructorList' },
        dataType: 'json',
        success: function (response) {
          console.log('INSTRUCTORS FETCHED SUCCESSFULY', response);
          // var courses = JSON.parse(response); //.courses;
          var courses = response;

          const courseSelect = $('#instructor-list');
          courseSelect.empty();
          courseSelect.append('<option value="" style="background-color:lightblue;">  Select an Instructor  </option>');
          for (var key in courses) {
            if (courses.hasOwnProperty(key)) {
              var item = courses[key];

              const option = $('<option></option>')
                .val(item.email)
                .text(item.name + " (" + item.courseId + ") ");
              courseSelect.append(option);
              // You can access properties of 'item' like item.courseId, item.createdBy, etc.
            }
          }



          // Trigger change event to populate topics for the selected course
          courseSelect.trigger('change');
          //sessionStorage.setItem("courseToLearn",courseId);

        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.error('FAILED TO FETCH INSTRUCTORS', errorThrown);
        }
      });


    });
  </script>

