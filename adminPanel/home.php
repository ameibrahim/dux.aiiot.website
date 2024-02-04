<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel</title>

  <link href="https://fonts.googleapis.com/css?family=DM+Sans:400,400i,700,700i" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

  <!-- Add your custom css files and js files in admin-dynamic-imports.php  -->
  <?php include '../includes/admin-dynamic-imports.php' ?>

</head>

<body>

  <script>
  
  function clearEditLearningObjectivesInputs() {  

    let inputs = document.querySelectorAll("#first-section-learning-objectives input");

    inputs.forEach( input => input.value = "");


  }

  </script>
  
  <!-- Header 

   <script>

    var message = "Not allowed!!";

    function rtclickcheck(keyp){ if (navigator.appName == "Netscape" && keyp.which == 3){ alert(message); return false; }

    if (navigator.appVersion.indexOf("MSIE") != -1 && event.button == 2) { alert(message); return false; } }

    document.onmousedown = rtclickcheck;

    function deleteFormGroup(element){
      let parentElement = element.parentElement;
      parentElement.remove();
      outcomeRowsCount--;
    }

  </script> -->

  <div class="gtranslate_wrapper"></div>
  <script>window.gtranslateSettings = {"default_language":"en","languages":["en","tr","fr","de","it","es"],"wrapper_selector":".gtranslate_wrapper","switcher_horizontal_position":"left","switcher_vertical_position":"bottom","float_switcher_open_direction":"bottom","flag_style":"3d"}</script>
  <script src="https://cdn.gtranslate.net/widgets/latest/float.js" defer></script>


  <header class="header-navigation">

    <div class="menu-logo" onclick="toggleSideBar()">
      <img class="open-menu icon" src="../assets/icons/fi-rr-grip-lines.svg" alt="">
      <img class="close-menu icon" src="../assets/icons/fi-rr-cross.svg" alt="">
    </div>

    <div class="top-logo">
      <img src="assets/RCAIoT_logo.png" alt="Company Logo">
    </div>

    <div class="right-nav"  onclick="goToLink('#Profile-settings')">
      <p class="text-primary notranslate" id="userName"></p>
      <img src="" alt="User Profile Image" class="user-avatar" id="userPhoto"> 
      <div class="logout-icon two-column-grid" onclick="logoutDialog()">
        <p class="text">Logout</p>
        <img class="icon" src="../assets/icons/fi-rr-arrow-right-to-bracket.svg" >
      </div>    
    </div>

  </header>

<!-- <div class="gtranslate_wrapper"></div> -->

  <!-- Main Content -->

  <div class="main-section">
    <!-- Sidebar -->

    <div class="sidebar nav">
      <div class="shortened-grid">
        <h2 class="tab-title mb-20">Admin Panel</h2>

      <div class="right-nav"  onclick="goToLink('#Profile-settings')">
          <p class="text-primary" id="userName"></p>
          <img src="" alt="User Profile Image" class="user-avatar" id="userPhoto">     
        </div>

        <div class="two-column-grid">
          <a class="ad-link" target="_blank" href="https://www.bing.com/create">
            <img src="../assets/icons/fi-rr-square-star.svg" >
            <p>AI Image Creator</p>
          </a>

          <a class="ad-link bg-blue" target="_blank" href="https://www.bing.com/search?toWww=1&redig=0F5576DEB42544F78DFCAACCBF98A1CD&q=Bing+AI&showconv=1">
            <img src="../assets/icons/fi-rr-message-quote.svg" >
            <p>AI Chat</p>
          </a>
        </div>

        <a class="nav-item nav-link active" data-tab="dashboard" href="#">
          <img class="icon" src="../assets/icons/fi-rr-border-all.svg" >
          <p>Dashboard</p>
        </a>

        <a class="nav-item nav-link" id="students-requests-sidebar-link" data-tab="requests" href="#">
          <img class="icon" src="../assets/icons/fi-rr-badge-check.svg" >
          <p>Requests</p>
        </a>

        <a class="nav-item nav-link" data-tab="chatroom-content" href="#">
          <img class="icon" src="../assets/icons/fi-rr-messages.svg" >
          <p>Chatroom</p>
        </a>

        <a class="nav-item nav-link" id="create-course-sidebar-link" data-tab="create-course" href="#">
          <img class="icon" src="../assets/icons/fi-rr-apps-add.svg" >
          <p>Course Management</p>
        </a>

        <!-- <a class="nav-item nav-link" data-tab="course-phase" href="#">
          <img class="icon" src="assets/icons/fi-rr-messages.svg" >
          <p>Create Lecture Phase</p>
        </a> -->

        <a class="nav-item nav-link" data-tab="edit-phase" href="#">
          <img class="icon" src="../assets/icons/fi-rr-apps-sort.svg" >
          <p>Edit Learning Objectives</p>
        </a>

        <a class="nav-item nav-link" data-tab="scheduling" href="#">
          <img class="icon" src="../assets/icons/fi-rr-time-fast.svg" >
          <p>Scheduling</p>
        </a>
        
        <a class="nav-item nav-link" id="messaging-sidebar-link" data-tab="messaging" href="#">
          <img class="icon" src="../assets/icons/fi-rr-mailbox.svg" >
          <p>Messaging</p>
        </a>

        <a class="nav-item nav-link" data-tab="grades" href="#">
          <img class="icon" src="../assets/icons/fi-rr-chart-pie-alt.svg" >
          <p class="locked-text" 
          data-en="Weight Assignment"
          data-tr="Ağırlıkları Ata"
          ></p>
        </a>

        <a class="nav-item nav-link" data-tab="class-grades" href="#">
          <img class="icon" src="../assets/icons/fi-rr-chart-line-up.svg" >
          <p>Class Grades</p>
        </a>

        <a class="nav-item nav-link" data-tab="profile-settings" id="Profile-settings" href="#">
          <img class="icon" src="../assets/icons/fi-rr-user.svg" >
          <p>Profile Settings</p>
        </a>

        <a class="nav-item nav-link" data-tab="settings" href="#">
          <img class="icon" src="../assets/icons/fi-rr-settings.svg" >
          <p>Settings</p>
        </a>

        <a class="nav-item nav-link" data-tab="dashboard" href="#" onclick="logoutDialog()">
          <img class="icon" src="../assets/icons/fi-rr-arrow-right-to-bracket.svg" >
          <p>Logout</p>
        </a>
      </div>

    </div>

    <div class="tab-contents" id="dashboard">
      <h1 class="tab-title">Dashboard</h1>
      <div class="inner-container">

        <!-- TODO: Dashboard -->

        <div class="dashboard-card" onclick="goToLink('#create-course-sidebar-link'); goToTab('course-management-container','edit-course');">
            <img src="../assets/icons/fi-rr-racquet.svg" alt="">
            <p>Courses</p>
            <span id="dashboard-courses-count">0</span>
        </div>

        <div class="dashboard-card" onclick="goToLink('#students-requests-sidebar-link');">
          <img src="../assets/icons/fi-rr-racquet.svg" alt="">
          <p>Total Students</p>
          <span id="dashboard-students-count">0</span>
         </div>

        <div class="dashboard-card" onclick="goToLink('#messaging-sidebar-link')">
          <img src="../assets/icons/fi-rr-racquet.svg" alt="">
          <p>Unread Messages</p>
          <span id="dashboard-unread-messages-count">0</span>
        </div>

        <div class="dashboard-card" onclick="goToLink('#students-requests-sidebar-link')">
          <img src="../assets/icons/fi-rr-racquet.svg" alt="">
          <p>Approved Students</p>
          <span id="dashboard-approved-student-count">0</span>
        </div>

        <div class="dashboard-card" onclick="goToLink('#students-requests-sidebar-link')">
          <img src="../assets/icons/fi-rr-racquet.svg" alt="">
          <p>Requests</p>
          <span id="dashboard-requests-count">0</span>
        </div>

          <!-- <button onclick="simulateAsyncOperation()">Start Operation</button> -->

      </div>
    </div>

      <div class="tab-contents" id="requests">
        <!-- Content for Courses tab -->
            <div class="chat-section">
              <h1 class="tab-title">Requests</h1>
              <div class="sub-headline">
                Find here, a list of students requesting to join your course. Approve by clicking in the check boxes.
              </div>
              
                <div class="form-group">
                  <label for="courseGS">Classes: </label>
                  <div class="select">
                    <select id="courseSelectStud" class="form-control mb-3">
                      <option value="">Select a Course</option>
                      <!-- Populate this dropdown with course options -->
                    </select>
                  </div>
                </div>

                <div class="batch-select-container">
                </div>

                <div id="studentsListAll" class="card-group inner-container">
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
                data-tr="Gönder"
                ></button>
              </div>
            </div>
      </div>

      <div class="tab-contents" id="create-courses">

        <!-- TODO: Is this a shadow tab-content -->
        <div class="row">
          <div class="col-md-6">
            <form>
              <div class="mb-3">
                <label for="courseCode" class="form-label">Course Management</label>
                <input type="text" class="form-control" id="courseCode" name="courseCode">
              </div>
              <div class="mb-3">
                <label for="courseName" class="form-label">Course Name</label>
                <input type="text" class="form-control" id="courseName" name="courseName">
              </div>
            </form>
          </div>


          <div class="col-md-6">
            <form>
              <div class="mb-3">
                <label class="form-label">Lectures</label>
                <input type="text" class="form-control" value="Lecture 1" name="Lecture1">
                <input type="text" class="form-control" value="Lecture 2" name="Lecture2">
                <input type="text" class="form-control" value="Lecture 3" name="Lecture3">
                <input type="text" class="form-control" value="Lecture 4" name="Lecture4">
                <input type="text" class="form-control" value="Lecture 5" name="Lecture5">
                <input type="text" class="form-control" value="Lecture 6" name="Lecture6">
                <input type="text" class="form-control" value="Lecture 7" name="Lecture7">
                <input type="text" class="form-control" value="Lecture 8" name="Lecture8">

              </div>
              <div class="mb-3">
                <label class="form-label">Mid Term Exam</label>
                <input type="text" class="form-control">
              </div>
              <div class="mb-3">
                <label class="form-label">Lectures</label>
               
                <input type="text" class="form-control" value="Lecture 9" name="Lecture9">
                <input type="text" class="form-control" value="Lecture 10" name="Lecture10">
                <input type="text" class="form-control" value="Lecture 11" name="Lecture11">
                <input type="text" class="form-control" value="Lecture 12" name="Lecture12">
              </div>
              <div class="mb-3">
                <label class="form-label">Final Exam</label>
                <input type="text" class="form-control">
              </div>
              <button type="submit" class="btn btn-primary">Save Course Outline</button>
            </form>
          </div>
        </div>
      </div>

      <div class="tab-contents" id="create-course" role="tabpanel" aria-labelledby="create-course-tab">
        <!-- Sub-Tabs -->

        <h1 class="tab-title">Course Management</h1>

        <div class="tab-container-view" id="course-management-container">
          <div class="tab-header">
              <div class="header-tab" data-for="create-course">Create Course</div>
              <div class="header-tab" data-for="edit-course">Edit course</div>
              <div class="header-tab" data-for="course-textbooks">Course Textbooks</div>
              <div class="header-tab" data-for="course-web-resources">Course Web Resources</div>
               <div class="header-tab" data-for="course-exams">Course exams</div>             
          </div>
  
          <div class="tab-body simple-grid" data-for="create-course">

            <h2 class="tab-title">Create Course</h2>

            <p class="warning">A course is taught for 14 weeks in a semester.
              After specifying the course code and course title, click on create. Dux will generate a 14 week course
              outline for you.
              Week 9 is possibly 'Mid Term Exam' and week 14 is 'Final Exam'. If need be, edit the outline and save.
            </p>

            <form id="create-course-form" class="two-pane-grid">
                
              <div class="right-pane">
                <div class="input-box-container">
                  <label for="courseCodeM" class="form-label">Course Code</label>
                  <input type="text" class="form-control" id="courseCodeM" name="courseCodeM">
                </div>

                <div class="input-box-container">
                  <label for="courseNameM" class="form-label">Course Name</label>
                  <input type="text" class="form-control" id="courseNameM" name="courseNameM">
                </div>

                <div class="form-group">
                  <label for="">Semester</label>

                    <div class="dropdown" name="courseSemester" id="courseSemester"
                      data-value-tr="Dönem Seçiniz" 
                      data-value-en="Select Semester" 
                      data-value="Real Data Value"
                      data-type="static"
                      data-empty="true"
                      >
                      <ul class="values">
                          <li class="locked-text" data-tr="Güz" data-en="Fall"></li>
                          <li class="locked-text" data-tr="Bahar" data-en="Spring"></li>
                          <li class="locked-text" data-tr="Yaz" data-en="Summer"></li>
                      </ul>
                    </div>

                </div>

                  <div id="my-button" class="button" onclick="generateLectureTitles()">
                    Generate Lecture Titles
                  </div>

              </div>

              <div class="left-pane">

                <div class="simple-grid">
                  <h1 class="tab-title">Lecture Topics</h1>
                  <div id="Lecture1" class="long-box" data-en="Week 1 Topic" data-tr="1. Hafta Konusu">Week 1 Topic</div>
                  <div id="Lecture2" class="long-box" data-en="Week 2 Topic" data-tr="2. Hafta Konusu">Week 2 Topic</div>
                  <div id="Lecture3" class="long-box" data-en="Week 3 Topic" data-tr="3. Hafta Konusu">Week 3 Topic</div>
                  <div id="Lecture4" class="long-box" data-en="Week 4 Topic" data-tr="4. Hafta Konusu">Week 4 Topic</div>
                  <div id="Lecture5" class="long-box" data-en="Week 5 Topic" data-tr="5. Hafta Konusu">Week 5 Topic</div>
                  <div id="Lecture6" class="long-box" data-en="Week 6 Topic" data-tr="6. Hafta Konusu">Week 6 Topic</div>
                  <div id="Lecture7" class="long-box" data-en="Week 7 Topic" data-tr="7. Hafta Konusu">Week 7 Topic</div>
                  <div id="Lecture8" class="long-box" data-en="Week 8 Topic" data-tr="8. Hafta Konusu">Week 8 Topic</div>
                </div>

                <div class="simple-grid">
                  <h2 class="tab-title">Mid Term Exam</h2>
                  <div id="Lecture9" class="long-box" data-en="Mid Term Exam" data-tr="Ara sınav">Mid Term Exam</div>
                </div>

                <div class="simple-grid">
                  <h2 class="tab-title">Lectures</h2>
                  <div id="Lecture10" class="long-box" data-en="Week 10 Topic" data-tr="10. Hafta Konusu">Week 10 Topic</div>
                  <div id="Lecture11" class="long-box" data-en="Week 11 Topic" data-tr="11. Hafta Konusu">Week 11 Topic</div>
                  <div id="Lecture12" class="long-box" data-en="Week 12 Topic" data-tr="12. Hafta Konusu">Week 12 Topic</div>
                  <div id="Lecture13" class="long-box" data-en="Week 13 Topic" data-tr="13. Hafta Konusu">Week 13 Topic</div>
                </div>

                <div class="simple-grid">
                  <h2 class="tab-title">Final Exam</h2>
                  <div id="Lecture14" class="long-box" data-en="Final Exam" data-tr="Final sınav">Final Exam</div>
                </div>
              
                <div onclick="createNewCourse()" class="button" id="submitLectureInfo">Save Course
                Outline
                </div>
              </div>
            
            </form>

          </div>
  
          <div class="tab-body" data-for="edit-course">
            <div class="two-pane-grid">
              <div class="right-pane">
                <h2 class="tab-title">Edit Course</h2>
  
                <div class="form-group">
                  <label for="">Select Course</label>
                  <div class="select">
                    <select id="editCourseDropdown" class="form-control mb-3">
                      <option value="">Select a Course</option>
                      <!-- Populate this dropdown with course options -->
                    </select>
                  </div>
                </div>
                
                <form id="edit-course-form" class="simple-grid">
                  <div class="input-box-container">
                    <label for="courseCodeME" class="form-label">Course Code</label>
                    <input type="text" class="form-control" id="courseCodeME" name="courseCodeME">
                  </div>
                  <div class="input-box-container">
                    <label for="courseNameME" class="form-label">Course Name</label>
                    <input type="text" class="form-control" id="courseNameME" name="courseNameME">
                  </div>
  
                </form>
              </div>
  
                <form id="lectures-form" class="left-pane">
                  
                    <h2 class="form-label tab-title">Lectures</h2>
                    <div class="input-checkbox-pair">
                      <input type="text" class="form-control" id="LectureE1" name="LectureE1">
                      <input type="checkbox" id="LectureE1Checkbox">
                    </div>
                    <div class="input-checkbox-pair">
                      <input type="text" class="form-control" id="LectureE2" name="LectureE2">
                      <input type="checkbox" id="LectureE2Checkbox">
                    </div>
                    <div class="input-checkbox-pair">
                      <input type="text" class="form-control" id="LectureE3" name="LectureE3">
                      <input type="checkbox" id="LectureE3Checkbox">
                    </div>
                    <div class="input-checkbox-pair">
                      <input type="text" class="form-control" id="LectureE4" name="LectureE4">
                      <input type="checkbox" id="LectureE4Checkbox">
                    </div>
                    <div class="input-checkbox-pair">
                      <input type="text" class="form-control" id="LectureE5" name="LectureE5">
                      <input type="checkbox" id="LectureE5Checkbox">
                    </div>
                    <div class="input-checkbox-pair">
                      <input type="text" class="form-control" id="LectureE6" name="LectureE6">
                      <input type="checkbox" id="LectureE6Checkbox">
                    </div>
                    <div class="input-checkbox-pair">
                      <input type="text" class="form-control" id="LectureE7" name="LectureE7">
                      <input type="checkbox" id="LectureE7Checkbox">
                    </div>
                    <div class="input-checkbox-pair">
                      <input type="text" class="form-control" id="LectureE8" name="LectureE8">
                      <input type="checkbox" id="LectureE8Checkbox">
                    </div>
    
                  

                  
                    <h3 class="form-label tab-title">Mid Term Exam</h3>
                    <div class="input-checkbox-pair">
                      <input type="text" class="form-control" id="LectureE9" name="LectureE9">
                      <input type="checkbox" id="LectureE9Checkbox">
                    </div>
                  

                    <h3 class="form-label tab-title">Lectures</h3>
                    <!-- Repeat for LectureE10Checkbox to LectureE13Checkbox -->
                    <div class="input-checkbox-pair">
                      <input type="text" class="form-control" id="LectureE10" name="LectureE10">
                      <input type="checkbox" id="LectureE10Checkbox">
                    </div>
                    <div class="input-checkbox-pair">
                      <input type="text" class="form-control" id="LectureE11" name="LectureE11">
                      <input type="checkbox" id="LectureE11Checkbox">
                    </div>
                    <div class="input-checkbox-pair">
                      <input type="text" class="form-control" id="LectureE12" name="LectureE12">
                      <input type="checkbox" id="LectureE12Checkbox">
                    </div>
                    <div class="input-checkbox-pair">
                      <input type="text" class="form-control" id="LectureE13" name="LectureE13">
                      <input type="checkbox" id="LectureE13Checkbox">
                    </div>
                  


                    <h3 class="form-label tab-title">Final Exam</h3>
                    <div class="input-checkbox-pair">
                      <input type="text" class="form-control" id="LectureE14" name="LectureE14">
                      <input type="checkbox" id="LectureE14Checkbox">
                    </div>


                  <button type="submit" class="submitLectureInfoE btn btn-primary" id="submitLectureInfoE">Save
                    Updates</button>
                </form>

            </div>

          </div>
  
          <div class="tab-body simple-grid" data-for="course-textbooks">

            <h2 class="tab-title">Course Textbooks</h2>

            <div class="simple-grid">
            
              <div class="simple-grid">
              
                <h4>Textbooks for Selected Course</h4>
  
                <div class="form-group">
                  <label for=""> Select Course</label>
                  <div class="select">
                    <select id="courseSelectA" class="form-control mb-3">
                      <option value="">Select a Course</option>
                      <!-- Populate this dropdown with course options -->
                    </select>
                  </div>
                </div>
                  
                <ul class="list-group list-group-flush" id="textbooks-list">
                  <!-- Textbooks will be dynamically populated here -->
                </ul>
  
              </div>
  
              <div class="simple-grid">
                <h4>Upload New Textbook</h4>
                <form id="upload-form" class="simple-grid" enctype="multipart/form-data">
                  <div class="mb-3">
                    <label for="bookFile" class="form-label">Select a PDF file</label>
                    <input type="file" class="form-control" id="bookFile" name="bookFile" accept=".pdf">
                  </div>
                  <input type="hidden" id="selectedCourseId" name="selectedCourseId">
                  <button type="submit" id="textbook-button" class="btn btn-primary locked-text"
                  data-en="Upload"
                  data-tr="Yükle"
                  ></button>
                </form>
              </div>
            </div>

          </div>
  
          <div class="tab-body simple-grid" data-for="course-web-resources">

            <h2 class="tab-title">Course Web Resources</h2>

            <div class="simple-grid">

              <div class="simple-grid">
                <h4 class="tab-title">Web resources for Selected Course</h4>

                <div class="form-group">
                  <label for="">Select Course</label>
                  <div class="select">
                    <select id="courseSelectW" class="form-control mb-3">
                      <option value="">Select a Course</option>
                      <!-- Populate this dropdown with course options -->
                    </select>
                  </div>
                </div>

                <ul class="simple-grid" id="webresources-list">
                  <!-- Textbooks will be dynamically populated here -->
                </ul>
              </div>

              <div class="simple-grid">
                <h4 class="tab-title">Enter New Web Resource</h4>
                <form id="webresource-form" class="simple-grid">
                  <div class="input-box-container">
                    <label for="webresource" class="form-label">Name a web resource</label>
                    <input type="text" class="form-control" id="webresource" name="webresource">
                  </div>
                  <input type="hidden" id="selectedCourseIdW" name="selectedCourseIdW">
                  <button type="submit" id="web-resource-button" class="btn btn-primary locked-text"
                  data-en="Save"
                  data-tr="Kaydet"
                  ></button>
                </form>
              </div>

            </div>

          </div>

        <div class="tab-body simple-grid" data-for="course-exams">

          <h2 class="tab-title">Course Exams</h2>

          <div class="iframe-container">
            <iframe src="../modules/qs/index.html" frameborder="0"></iframe>
          </div>
          <style>
            .iframe-container {
              width: 100%;
              height: 100%;
              /* This is to ensure that the container takes the full height of the viewport */
            }

            iframe {
              width: 100%;
              height: 100vh;
              border: none;
              /* Optional: removes the border around the iframe */
            }
          </style>


        </div>

        </div>
      

        

      </div>

      <!-- Create Phase Tab Content -->
      <div class="tab-contents" id="create-phase">

        <!-- TODO: This tab doesn't show -->

        <div class="container">
          <h1>Create an Objective</h1>
          <form id="instructionsForm" enctype="multipart/form-data" style="max-width: 300px;">
            <div class="form-group">
              <label for="courseId">Course ID:</label>
              <input type="text" class="form-control" id="courseId" name="courseId" required>
            </div>
            <div class="form-group">
              <label for="sectionName">Phase Title:</label>
              <input type="text" class="form-control" id="sectionName" name="sectionName" required>
            </div>
            <div class="form-group">
              <label for="topicId">Lesson ID:</label>
              <input type="text" class="form-control" id="topicId" name="topicId" required>
            </div>
            <div class="form-group">
              <label for="instruction1" class="locked-text" data-en="Outcome 1:" data-tr="Kazanım 1:"></label>
              <input type="text" class="form-control instruction" id="instruction1" name="instructions[]" required>
            </div>
            <div id="dynamicInstructions"></div>
            <button type="button" class="btn btn-primary" id="addInstructionBtn">Add
              Instruction</button>
            <div class="form-group">
              <label for="image">Add Image or Video</label>
              <input type="file" class="form-control-file" id="image" name="image" required>
            </div>
            <div class="form-group">
              <label for="duration">Duration (in seconds):</label>
              <input type="number" class="form-control" id="duration" name="duration" required>
            </div>

            <button type="submit" class="btn btn-success">Save Instructions</button>
          </form>
        </div>



      </div>

      <!-- Edit Phase Tab Content -->
      <div class="tab-contents" id="edit-phase">

        <div class="container chat-section">
          <h1 class="tab-title">Update Learning Objectives</h1>
          <p class="warning">NOTE: A 3-hour lecture is divided into 6 30-minute
            phases</p>

            <form class="chat-section" id="editInstructionsForm" enctype="multipart/form-data">
                <p class="warning">Fetch the information of the phase to be edited
                </p>

                <div class="inner-section" id="first-section-learning-objectives">
                    <div class="form-group">
                      <label for="Ucourse">Course:</label>
                      <div class="select">
                        <select class="form-control" id="Ucourse" name="Ucourse" onchange="clearEditLearningObjectivesInputs()" required>
                          <option value="">Select Course</option>
                          <!-- Populate with course options from database -->
                          <!-- Example: <option value="course1">Course 1</option> -->
                        </select>
                      </div>
                    </div>
    
                    <div class="form-group">
                      <label for="Utopic">Lecture:</label>
                      <div class="select">
                        <select class="form-control" id="Utopic" name="Utopic" onchange="clearEditLearningObjectivesInputs()" required>
                          <!-- Populate with topic options based on selected course -->
                          <!-- Example: <option value="topic1">Topic 1</option> -->
                        </select>
                      </div>
                    </div>
    
                    <div class="form-group">
                      <label for="UsectionId" class="locked-text"
                      data-en="Phase:"
                      data-tr="Hedef:"
                      ></label>
                      <div class="select">
                        <select class="form-control" id="UsectionId" name="UsectionId" required>
                          <!-- Populate with sectionId options based on selected topic -->
                          <!-- Example: <option value="section1">Section 1</option> -->
                        </select>
                      </div>
                    </div>
    
    
                  <!-- Hidden input field to store selected sectionId -->
                  <input type="hidden" id="UselectedSectionId" name="UselectedSectionId">
    
                  <div class="form-group">
                    <label for="UcourseId">Course ID:</label>
                    <input type="text" class="form-control" id="UcourseId" name="UcourseId" required>
                  </div>
                  <div class="form-group">
                    <label for="UsectionName">Lecture Title:</label>
                    <input type="text" class="form-control" id="UsectionName" name="UsectionName" required>
                  </div>
                  <div class="form-group">
                    <label for="UtopicId" class="locked-text"
                    data-en="Phase ID:"
                    data-tr="Hedef Kimliği"
                    ></label>
                    <input type="text" class="form-control" id="UtopicId" name="UtopicId" required>
                  </div>
                  <div class="form-group">
                    <label for="Uinstruction1" class="locked-text" data-en="Outcome 1:" data-tr="Kazanım 1:"></label>
                    <input type="text" class="form-control instruction" id="Uinstruction1" name="Uinstructions[]"
                      required>
                  </div>
                  <div id="UdynamicInstructions" class="chat-section"></div>
                  <button type="button" class="btn btn-primary" id="UaddInstructionBtn">Add
                    Objective
                  </button>
                </div>

                <div class="inner-section">
                  <div class="form-group">
                    <label for="Uimage">Add Image or Video</label>
                    <input type="file" class="form-control-file" id="Uimage" name="Uimage" required>
                    <img src="" id="UsectionImagePreview" alt="Preview of the selected image"
                      style="display:none; max-width: 200px;">
                  </div>

                  <div class="form-group">
                    <label for="Uduration">Duration In Minutes (30 is standard):</label>
                    <input type="number" class="form-control" id="Uduration" name="Uduration" value="30" required>
    
                  </div>
    
                  <!-- Add instruction button and dynamic instruction fields -->
                  <!-- ... (existing addInstructionBtn and dynamicInstructions) ... -->
    
                  <button type="submit" class="btn btn-success">Update Lesson Objectives</button>
                  
                </div>
            </form>

        </div>
      </div>

      <!-- Scheduling Tab Content -->
      <div class="tab-contents" id="scheduling">
        <h1 class="tab-title">Class Scheduling</h1>
        <p class="sub-headline">Choose a date of week when each lesson will be active.</p>

          <form class="chat-section" id="schedulesForm">
            <!-- Course Dropdown -->
            <div class="form-group">
              <label for="courseSCH">Course:</label>
              <div class="select">
                <select class="form-control" id="courseSCH" name="courseSCH" required>
                  <!-- Populate with course options from the database using AJAX -->
                </select>
              </div>
            </div>

            <!-- Topic Cards (Generated Dynamically using AJAX) -->
            <div class="chat-section inner-container" id="topicCardsContainer">
              <!-- Topic Cards will be added here -->
            </div>

            <button type="submit" class="btn btn-primary locked-text"
            data-en="Submit"
            data-tr="Gönder"
            ></button>
          </form>

      </div>


      <div class="tab-contents" id="messaging">

        <h1 class="tab-title">Messaging</h1>
        <div class="chat-section">
          <div class="messagingM">
            <div class="tabsM">
              <button class="tab-btnM active" onclick="showTab('Unread')">Unread: <span id="unreadCount" style="font-weight: bold; color: var(--pop);"></span></button>
              <button class="tab-btnM" onclick="showTab('Inbox')">Inbox: <span id="inboxCount" style="font-weight: bold; color: var(--accent);"></span></button>
              <button class="tab-btnM" onclick="showTab('Sent')">Sent: <span id="sentCount" style="font-weight: bold; color: black;"></span></button>
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
        <select class="form-control" name="instructor-list" id="instructor-list">
            <option value="">Select student</option>
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
                  data-tr="Gönder"
                  >
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>


      <!-- Scheduling Tab Content -->
      <div class="tab-contents" id="grades">
          <!-- Content for Messages tab -->
          <div class="chat-section">
            <h1 class="tab-title">Assign Weights</h1>
            <p class="sub-headline"> Assign percentages to the various evaluations to process students' final grades</p>
            
            <form class="chat-section" id="grades-form">
              <div class="form-group">
                <label for="courseWTS">Course:</label>
                <div class="select">
                  <select class="form-control" id="courseWTS" name="courseWTS" required>
                    <!-- Populate with course options from the database using AJAX -->
                  </select>
                </div>
              </div>
              <div class="two-column-grid">
                <div class="form-group">
                  <label for="weekly-evaluation">Weekly Evaluation (%)</label>
                  <input type="number" class="form-control" id="weekly-evaluation" name="weekly_evaluation" min="0"
                    max="8" required>
                </div>
                <div class="form-group">
                  <label for="weekly-evaluation">12 Week Total (%)</label>
                  <div class="long-box" id="weekly-evaluation-total" ></div>
                </div>
              </div>


              <div class="two-column-grid">
                <div class="form-group">
                  <label for="midterm-exam">Midterm Exam (%)</label>
                  <input type="number" class="form-control" id="midterm-exam" name="midterm_exam" min="0" max="100"
                    required>
                </div>
                <div class="form-group">
                  <label for="weekly-evaluation">Midterm Total (%)</label>
                  <div class="long-box" id="midterm-evaluation-total" ></div>
                </div>
              </div>

              <div class="two-column-grid">
                <div class="form-group">
                  <label for="final-exam">Final Exam (%)</label>
                  <input type="number" class="form-control" id="final-exam" name="final_exam" min="0" max="100"
                    required>
                </div>
                <div class="form-group">
                  <label for="weekly-evaluation">Final Exam Total (%)</label>
                  <div class="long-box" id="final-evaluation-total" ></div>
                </div>
              </div>

              <div class="two-column-grid">
                <div class="form-group">
                </div>
                <div class="form-group">
                  <label for="weekly-evaluation">Weights Total (%)</label>
                  <div class="long-box" id="total-evaluation-total" ></div>
                </div>
              </div>

              <button type="submit" class="btn btn-primary"

              >Save Weights</button>
            </form>
            <div id="response-div" style="margin-top: 10px; color:blue"></div>
          </div>
      </div>

      <div class="tab-contents" id="settings">
        
        <h1 class="tab-title">Settings</h1>

        <div class="tab-container-view">
          <div class="tab-header">
              <div class="header-tab" data-for="api-key-settings">API Key Settings</div>
              <div class="header-tab" data-for="course-resources">Course Rescources</div>
              <div class="header-tab" data-for="other-settings">Other Settings</div>
          </div>
  
          <div class="tab-body" data-for="api-key-settings">
            <div class="simple-grid">

              <h2 class="tab-title">API Key Settings</h2>
              

              <div class="bordered-box">
                <h5 class="cardS-title">API Key</h5>
                <p class="cardS-text" id="api-key-status"></p>
                <p class="cardS-text" id="api-key-preview" style="background-color: #f9f6f0;"></p>
                <form id="api-key-form">
                  <div class="form-group">
                    <label for="api-key-input">Register/Update Your API Key:</label>
                    <input type="text" class="form-control" id="api-key-input" required>
                  </div>
                  <button type="submit" class="btn btn-primary locked-text"
                  data-en="Save"
                  data-tr="Kaydet"
                  ></button>
                </form>
                </div>

              <div id="Admin-API-Box" class="bordered-box simple-grid">
                <div class="simple-grid">
                  <h3 class="tab-title">Select Free Courses</h3>
                  <p class="warning"> By checking in a check box, the course in questions is
                    selected as a free course. Students will use system API key to interact with GPT</p>
                  <ul id="course-list" class="list-group simple-grid">
                    <!-- Courses will be dynamically populated here -->
                  </ul>
                </div>

                <button type="submit" id="api-key-button" class="btn btn-primary locked-text"
                data-en="Save"
                data-tr="Kaydet"
                >
                </button>
              </div>
            </div>
          </div>
  
          <div class="tab-body" data-for="course-resources">
            
            <div class="container simple-grid">

              <h2 class="tab-title">Course Resources</h2>

              <p class="sub-headline">Select a course, then choose the resources you want Dux to use in this course.</p>


              <div class="simple-grid">

                <div class="simple-grid">
                  <div class="form-group">
                    <label for="">Select a Course</label>
                    <div class="select">
                      <select class="form-control" id="courseDropdownO">
                        <option value="" selected disabled>Select a course</option>
                        <!-- Add more options as needed -->
                      </select>
                    </div>
                  </div>
                </div>

                <div class="simple-grid">
                  <h2 class="tab-title">Select Resources</h2>
                  
                  <ul class="list-group simple-grid">
                    <li class="list-group-item">
                      ChatGPT only
                      <input type="checkbox" name="resourceOption" value="chatGPT">
                    </li>
                    <li class="list-group-item">
                      Textbooks
                      <input type="checkbox" name="resourceOption" value="textbooks">
                    </li>
                    <li class="list-group-item">
                      Web Resources
                      <input type="checkbox" name="resourceOption" value="webResources">
                    </li>
                    <li class="list-group-item">
                      All
                      <input type="checkbox" name="resourceOption" value="all">
                    </li>
                  </ul>
                  <button type="button" class="btn btn-primary mt-3 locked-text" id="saveResourcesBtn"
                  data-en="Save"
                  data-tr="Kaydet"
                  ></button>
                </div>
              
              </div>

            </div>

          </div>
  
          <div class="tab-body" data-for="other-settings">
              Other Settings Coming Soon ...
          </div>
        </div>

      </div>

      <div class="tab-contents" id="class-grades">

        <h1 class="tab-title">Class Grades</h1>

        <div class="tab-container-view">
          <div class="tab-header">
              <div class="header-tab" data-for="class-view">Class View</div>
              <div class="header-tab" data-for="student-view">Student View</div>
              <div class="header-tab" data-for="modify-marks">Modify Marks</div>
              <div class="header-tab" data-for="export-grades">Export Grades</div>
          </div>
  
          <div class="tab-body" data-for="class-view">
            <div class="simple-grid">
              <h2 class="tab-title">Class List</h2>
              <div class="simple-grid">
                
                  <div class="form-group">
                    <label for="">Select Course:</label>
                    <div class="select">
                      <select id="courseIdDropdown" class="form-control">
                        <!-- Populate this dropdown with course options -->
                        <!-- <option value="">Select Course to Fetch Data</option>
                        <option value="C003">Natural Language Processing</option>
                        <option value="C004">Introduction to Robotics</option> -->
                        <!-- Add more options as needed -->
                      </select>
                    </div>
                  </div>
                
                
                  <div class="form-group">
                    <label for="">Choose Field</label>
                    <div class="select">
                      <select id="displayFieldDropdown" class="form-control" style="padding-left:20px">
                        <!-- Populate this dropdown with course options -->
                        <option value="">Select field to display</option>
                        <option value="accuracy">Accuracy</option>
                        <option value="promptEfficiency">Topic Relevance</option>
                        <option value="timeEfficiency">Time Efficiency</option>
                        <option value="total">Total</option>
                        <!-- Add more options as needed -->
                      </select>
                    </div>
                  </div>
               
                <div class="simple-grid" >
                  <button id="fetchDataButton" class="btn btn-primary">Fetch Data</button>
                  <button id="exportClassButton" class="btn btn-primary">Export to Excel</button>
                </div>
              </div>
  
              <!-- Create a table to display the data -->
              <div class="table-responsive" style="display: flex; flex-direction: row;justify-content: space-around; background-color: white; border-radius: 5px; padding: 5px; margin: 10px; font-size: smaller;">
                <table id="dataTable" class="table table-bordered">
                  <thead>
                    <tr>
                      <th>SN</th>
                      <th>Photo</th>
                      <th>Name</th>
                      <!-- Add 14 columns for data -->
                      <th>L1</th>
                      <th>L2</th>
                      <th>L3</th>
                      <th>L4</th>
                      <th>L5</th>
                      <th>L6</th>
                      <th>L7</th>
                      <th>L8</th>
                      <th>MTE</th>
                      <th>L9</th>
                      <th>L10</th>
                      <th>L11</th>
                      <th>L12</th>
                      <th>FE</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- Data rows will be added dynamically using JavaScript -->
                  </tbody>
                </table>
              </div>
            </div>
          </div>
  
          <div class="tab-body" data-for="student-view">
            <div class="simple-grid">
              <h2 class="tab-title">View a single student's grades</h2>
            
              <div class="simple-grid">
                <div class="form-group">
                  <label for="courseCGC">Course:</label>
                  <div class="select">
                    <select id="courseCGC" name="courseCGC">
                      <option value="">Select Course</option>
                    </select>
                  </div>
                </div>
  
                <div class="form-group">
                  <label for="courseCGS">Student:</label>
                  <div class="select">
                    <select class="form-control" id="courseCGS" name="courseGS">
                      <option value="">Select Student</option>
                    </select>
                  </div>
                </div>
  
                <button class="set-button btn btn-primary" id="semester-grades-button">
                  Show Results
                </button>
              </div>
  
              <div class="inner-container">
  
                <div class="card-body two-pane-grid">
                  <div class="card-icon">
                    <i class="far fa-calendar-alt"></i>
                  </div>
                  <div class="simple-grid">
                    <h2 class="card-title">Weekly Evaluation Average</h2>
                    <p id="weeklyEvaluationScore"
                    class="locked-text"
                    data-en="Score: "
                    data-tr="Puan: "
                    ></p>
                  </div>
                </div>
  
                <div class="card-body two-pane-grid">
                  <div class="card-icon">
                    <i class="fas fa-clipboard-check"></i>
                  </div>
                  <div class="simple-grid">
                    <h2 class="card-title">Mid-Term Exam</h2>
                    <p id="midTermExamScore"
                    class="locked-text"
                    data-en="Score: "
                    data-tr="Puan: "></p>
                  </div>
                </div>
  
                <div class="card-body two-pane-grid">
                  <div class="card-icon">
                    <i class="fas fa-graduation-cap"></i>
                  </div>
                  <div class="simple-grid">
                    <h2 class="card-title">Final Exam</h2>
                    <p id="finalExamScore"
                    class="locked-text"
                    data-en="Score: "
                    data-tr="Puan: "></p>
                  </div>
                </div>
  
                <div class="card-body two-pane-grid">
                  <div class="card-icon">
                    <i class="fas fa-chart-pie"></i>
                  </div>
                  <div class="simple-grid">
                    <h2 class="card-title">Total Grade</h2>
                    <p id="totalSemesterScore"
                    class="locked-text"
                    data-en="Score: "
                    data-tr="Puan: "></p>
                  </div>
                </div>
  
                <div class="card-body two-pane-grid">
                  <div class="card-icon">
                    <i class="fas fa-comment"></i>
                  </div>
                  <div class="simple-grid">
                    <h2 class="card-title">Remark</h2>
                    <p id="semesterRemark">Failed </p>
                  </div>
                </div>
  
                <div class="card-body two-pane-grid">
                  <div class="card-icon">
                    <i class="fas fa-flag-checkered"></i>
                  </div>
                  <div class="simple-grid">
                    <h2 class="card-title">Final Grade</h2>
                    <p id="letterGrade"> FF </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
  
          <div class="tab-body" data-for="modify-marks">
              
            <div class="simple-grid">
                <h2 class="tab-title">Modify a students scores</h2>
              
                <div class="simple-grid">
                   
                  <div class="form-group">
                    <label for="">Course:</label>
                    <div class="select">
                      <select id="courseModifyC" name="courseModifyC">
                        <option value="">Select Course</option>
                      </select>
                    </div>
                  </div>
  
                  <div class="form-group">
                    <label for="">Lecture:</label>
                    <div class="select">
                      <select id="topicModifyT" name="topicModifyT">
                        <option value="">Select Lecture</option>
                      </select>
                    </div>
                  </div>
  
                  <div class="form-group">
                    <label for="">Student:</label>
                    <div class="select">
                      <select id="courseModifyS" name="courseModifyS">
                        <option value="">Select Student</option>
                      </select>
                    </div>
                  </div>
  
                </div>
  
                <form id="score-modify-form" class="simple-grid">
                    <div class="input-box-container">
                      <label for="accuracy">Accuracy:</label>
                      <input type="text" class="form-control" id="accuracyModify" name="accuracyModify" value="n/a">
                    </div>
                    <div class="input-box-container">
                      <label for="promptEfficiency">Prompt Efficiency:</label>
                      <input type="text" class="form-control" id="promptEfficiencyModify" name="promptEfficiencyModify">
                    </div>
                  <div class="input-box-container">
                      <label for="timeEfficiency">Time Efficiency:</label>
                      <input type="text" class="form-control" id="timeEfficiencyModify" name="timeEfficiencyModify">
                  </div>
                  <div class="input-box-container">
                      <label for="total">Total:</label>
                      <input type="text" class="form-control" id="totalModify" name="totalModify" readonly>
                  </div>
                  <button type="button" class="btn btn-primary locked-text" id="update-scores-button"
                  data-en="Save"
                  data-tr="Kaydet"
                  ></button>
                </form>
            </div>

          </div>
  
          <div class="tab-body" data-for="export-grades">        
            <div class="simple-grid">
              <h2 class="tab-title">Export List to Excel</h2>

              <div class="simple-grid">
                <div class="form-group">
                  <label for="">Select Course</label>
                  <div class="select">
                    <select id="courseExport" class="form-control">
                      <!-- Populate this dropdown with course options -->
                      <option value="">Select Course to Fetch Data</option>
                      <option value="C003">Natural Language Processing</option>
                      <option value="C004">Introduction to Robotics</option>
                      <!-- Add more options as needed -->
                    </select>
                  </div>
                </div>
              
                <button id="exportToExcel" class="btn btn-primary">Export Data</button>

              </div>

              <div class="final-course-list" id="final-course-list">
              </div>

          </div>

          </div>

        </div>

      </div>


      

<div class="tab-contents" id="profile-settings" data-tab="Profile-settings-link">
       <h1 class="tab-title">Profile Settings</h1>
<div class="profile-container">
    <div class="profile-picture">
      <img id="userPhotos" src="" alt="User Photo">
      <input type="file" id="fileInput" accept="image/*" onchange="loadImage(event, '#userPhotos')">
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

    <footer>

      <div class="image">
        <img src="../assets/AIRI_logo.png" alt="company logo">
      </div>

      <div class="image">
        <img src="../assets/RCAIoT_logo.png" alt="company logo"> 
      </div>

      <p class="footer-heading">Research Center for AI and IoT</p>
      <p class="footer-text">We Specialize in designing AI-based solutions for smart societies</p>

      <div class="footer-section">
        <p class="footer-heading">Contact us</p>
        <ul class="footer-list">
          <li>
            <i class="fas fa-map-marker-alt"></i>
            <p>Research Center for AI and IoT,</p>
            <p>AI and Robotics Institute,</p>
            <p>Near East University,</p>
            <p>Near East Blvd,</p> 
            <p>99138 Mersin 10,</p>
            <p>Nicosia TRNC
          </li>
          <li>
            <i class="fas fa-phone"></i>
            <p>+90 542 852 09 85</p>
          </li>
        </ul>
      </div>

    <div class="footer-section">
      <p class="footer-heading">Services</p>
          <ul class="footer-list">
            <li>
              <i class="fas fa-home"></i>
              <p>Smart Home Solutions</p>
              <i class="fas fa-graduation-cap"></i>
              <p>Smart Education Solutions</p>
              <i class="fas fa-medkit"></i>
              <p>Smart Healthcare Solutions</p>
              <i class="fas fa-chalkboard-teacher"></i>
              <p>Training</p>
              <i class="fas fa-handshake"></i>
              <p>Consultancy</p>
            </li>
          </ul>
        </div>
      </div>
    </footer>
<script>

async function edituserprofile(){

    const name = document.getElementById('name').value;
    const phone = document.getElementById('phone').value;
    const address = document.getElementById('address').value;
    const imageInput = document.getElementById('fileInput');
    const email = document.getElementById('email').value;

    let isPhoto = "false";

      try{
          if(imageInput.files[0]){
            let { newFileName } = await uploadFile(imageInput.files[0]);
            isPhoto = "true";
            fetchAndSetSessionStorage(newFileName);
          }
          else{
              let newFileName = "";
              fetchAndSetSessionStorage(newFileName);
          }
      }catch(error){
        console.log(error);
      }

    async function fetchAndSetSessionStorage(newFileName){
      
      let details = await AJAXCall({
              phpFilePath: "../api/editProfileDetails.php",
              rejectMessage: "Details not updated",
              params: `name=${name}&&phone=${phone}&&address=${address}&&photoName=${newFileName}&&email=${email}&&isPhoto=${isPhoto}`,
              type: "fetch"
            });

      console.log(details);            

      sessionStorage.setItem("user", JSON.stringify(details[0]));
      setuserdata(details[0]);
    }

}

</script>
<script>    

async function getStudentList() {
    
  // fetch('../api/api.php', {
  //       method: 'POST',
  //       headers: {
  //           'Content-Type': 'application/json',
  //       },
  //       body: JSON.stringify({ action: 'getstudentsList' })
  //   })
  //   .then(response => {
  //       if (!response.ok) {
  //           throw new Error('Network response was not ok');
  //       }
  //       return response.json();
  //   })
  //   .then(data => {
  //       if (data.error) {
  //           throw new Error(data.error);
  //       }
  //       const select = document.getElementById('instructor-list');
  //       select.innerHTML = '<option value="">Select student</option>';
  //       data.forEach(student => {
  //           const option = document.createElement('option');
  //           option.value = student.uid;
  //           option.textContent = student.name;
  //           select.appendChild(option);
  //       });
  //   })
  //   .catch(error => {
  //       console.error('Error fetching student list:', error);
  //   });

  let studentList = await AJAXCall({
              phpFilePath: "../api/api.php",
              rejectMessage: "Details not fetched",
              params: `action=getstudentsList`,
              type: "fetch"
            });
          

  console.log("studentList:", studentList);

  // TODO: This student list is for the messaging feature
}



getStudentList();


</script>
  <script>

      var sid = JSON.parse(sessionStorage.getItem('user')).stdnumber;
      console.log("_sid:", sid);

     $(document).ready(function () {
        var userData = JSON.parse(sessionStorage.getItem('user'));
        let auth= userData.utype;
        if (auth=='student'){
          window.location.href='../home.php';
        }
      $('.nav-link').on('click', function (e) {
        e.preventDefault();
        $(this).tab('show');
      });



      // Dynamic instruction field counter
      var instructionCount = 1;

      // Add instruction button click event
      $('#addInstructionBtn').click(function () {
        instructionCount++;

        var newInstructionField = $('<div>').addClass('form-group');
          
        newInstructionField.append($('<label>', {
          class: 'locked-text',
          'data-en': `Outcome ${instructionCount}:`,
          'data-tr': `Kazanım ${instructionCount}:`,
        }));

        newInstructionField.append($('<input>').attr({
          type: 'text',
          class: 'form-control instruction',
          id: 'instruction' + instructionCount,
          name: 'instructions[]',
          required: true
        }));

        $('#dynamicInstructions').append(newInstructionField);
      });

      // Instructions form submit event
      $('#instructionsForm').submit(function (e) {
        e.preventDefault();

        // Create a FormData object
        var formData = new FormData(this);
        formData.append('action', 'saveSection');

        // Send form data using jQuery AJAX post request
        $.ajax({
          url: '../api/api.php',
          type: 'POST',
          data: formData,
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
          }
        });
      });




      // Populate course options from the database (Replace the example with your API call)
      $.ajax({
        url: '../api/api.php',
        type: 'POST',
        data: {teacherId:sid, action: 'getCoursesTeacher' },
        success: function (response) {
          // Process the response and populate the course dropdown
          var courses = JSON.parse(response);
          var courseSelect = $('#Ucourse');
          courseSelect.empty();
          courseSelect.append($('<option>').val("").text("Select Course"));
          $.each(courses, function (index, course) {
            courseSelect.append($('<option>').val(course.courseId).text(course.courseName));
          });
        },
        error: function () {
          console.error('Failed to fetch courses.');
        }
      });

      // Topic dropdown change event handler
      $('#Ucourse').change(function () {
        var selectedCourseId = $('#Ucourse').val();

        // Fetch sectionId options based on the selected course and topic (Replace the example with your API call)
        $.ajax({
          url: '../api/api.php',
          type: 'POST',
          data: {
            action: 'fetchTopicsForCourse',
            courseId: selectedCourseId,

          },
          success: function (response) {
            // Process the response and populate the sectionId dropdown
            var topicIds = response.topics; //JSON.parse(response);
            console.log(response);
            var topicIdSelect = $('#Utopic');
            topicIdSelect.empty();
            topicIdSelect.append($('<option>').val("").text("Select Lecture"));
            $.each(topicIds, function (index, topicId) {
              topicIdSelect.append($('<option>').val(topicId.id).text(topicId.name));
            });
          },
          error: function () {
            console.error('Failed to fetch sectionIds.');
          }
        });
      });

      // Topic dropdown change event handler
      $('#Utopic').change(function () {
        var selectedCourseId = $('#Ucourse').val();
        var selectedTopicId = $(this).val();

        // Fetch sectionId options based on the selected course and topic (Replace the example with your API call)
        $.ajax({
          url: '../api/api.php',
          type: 'POST',
          data: {
            action: 'getPhaseById',
            courseId: selectedCourseId,
            topicId: selectedTopicId
          },
          success: function (response) {
            // Process the response and populate the sectionId dropdown
            var sectionIds = JSON.parse(response);
            var sectionIdSelect = $('#UsectionId');
            sectionIdSelect.empty();
            sectionIdSelect.append($('<option>').val("").text("Select Phase"));
            $.each(sectionIds, function (index, section) {
              sectionIdSelect.append($('<option>').val(section.sectionId).text(section.sectionId + ": " + section.sectionName));
            });
          },
          error: function () {
            console.error('Failed to fetch sectionIds.');
          }
        });
      });

      // SectionId dropdown change event handler
      $('#UsectionId').change(function () {
        var selectedSectionId = $(this).val();
        // Store the selected sectionId in the hidden input field
        $('#UselectedSectionId').val(selectedSectionId);

        // Fetch section information from the database based on the selected sectionId (Replace the example with your API call)
        $.ajax({
          url: '../api/api.php',
          type: 'POST',
          data: {
            action: 'getPhaseInfo',
            sectionId: selectedSectionId
          },
          success: function (response) {
            // Process the response and populate the form fields with the fetched data
            var sectionInfo = JSON.parse(response);
            var instructions = JSON.parse(sectionInfo.instructions);
            console.log('PHASE FETCHED: ', sectionInfo.instructions);
            $('#UcourseId').val(sectionInfo.courseId);
            $('#UsectionName').val(sectionInfo.sectionName);
            $('#UtopicId').val(sectionInfo.topicId);
            $('#Uduration').val(sectionInfo.duration);
            $('#Uinstruction1').val(instructions[0]);

            $('#UdynamicInstructions').empty();

            for (var i = 1; i < instructions.length; i++) {
              var newInstruction = $('<div class="form-group"><label for="Uinstruction' + (i + 1) + '" class="locked-text" data-en="Outcome ' + (i + 1) + ':" data-tr="Kazanım ' + (i + 1) + ':" ></label><input type="text" class="form-control instruction" id="Uinstruction' + (i + 1) + '" name="Uinstructions[]" required value="' + instructions[i] + '"></div>');
              $('#UdynamicInstructions').append(newInstruction);
            }
            // Populate additional dynamic instruction fields if needed
            outcomeRowsCount = instructions.length;

            $('#UaddInstructionBtn').click(function () {
              outcomeRowsCount++;
              var newInstruction = $(
                `<div class="form-group three-centered-column-grid">
                  <label for="Uinstruction${outcomeRowsCount}" class="locked-text" 
                  data-en="Outcome ${outcomeRowsCount}:" 
                  data-tr="Kazanım ${outcomeRowsCount}:"></label>
                  <input type="text" class="form-control instruction" 
                  id="instruction${outcomeRowsCount}" name="instructions[]" required>
                  <button class="locked-text" data-en="delete" data-tr="Sil" 
                  onclick="deleteFormGroup(this)"
                  ></button>
                  </div>`);

              $('#UdynamicInstructions').append(newInstruction);
            });

            // Populate image field if the section has an image
            if (sectionInfo.image !== null) {
              var imageSrc = '../' + sectionInfo.image;
              $('#UsectionImagePreview').attr('src', imageSrc).show();
            }

            // Optional: You can handle displaying the fetched image or video here
            // ...
          },
          error: function () {
            console.error('Failed to fetch section information.');
          }
        });
      });

      // Display a preview of the selected image when the user selects a file
      $('#image').on('change', function () {
        var reader = new FileReader();
        reader.onload = function (e) {
          $('#sectionImagePreview').attr('src', e.target.result).show();
        };
        reader.readAsDataURL(this.files[0]);
      });


      // Instructions form submit event
      $('#editInstructionsForm').submit(function (e) {
        e.preventDefault();

        // Create a FormData object
        var formData = new FormData(this);
        formData.append('action', 'updateSection');

        // Send form data using jQuery AJAX post request
        $.ajax({
          url: '../api/api.php',
          type: 'POST',
          data: formData,
          contentType: false,
          processData: false,
          success: function (response) {
            // Handle the response from the server
            console.log(response);
            // Additional actions after saving instructions
            animateDialog('Learning Phase Updated Sucessfully');
            // window.location.href = 'addlearningphase.html';
          },
          error: function () {
            console.error('Failed to save instructions.');
          }
        });
      });

            // Fetch courses using AJAX (Replace with your API call)
      $.ajax({
        url: '../api/api.php',
        type: 'POST',
        data: {teacherId: sid, action: 'getCoursesTeacher' },
        success: function (response) {
          var courses = JSON.parse(response);
          var courseSelect = $('#courseSCH');
          courseSelect.empty();
          $.each(courses, function (index, course) {
            courseSelect.append($('<option>').val(course.courseId).text(course.courseName));
          });

          // Trigger the change event to populate topic cards for the default course
          courseSelect.trigger('change');
        },
        error: function () {
          console.error('Failed to fetch courses.');
        }
      });

      // Handle course dropdown change event
      $('#courseSCH').change(function () {
        var selectedCourseId = $(this).val();

        // Fetch topicIds and sectionNames using AJAX (Replace with your API call)
        $.ajax({
          url: '../api/api.php',
          type: 'POST',
          data: {
            action: 'fetchTopicsForCourse',
            courseId: selectedCourseId
          },
          success: function (response) {
            var topicsAndSections = response.topics; //JSON.parse(response);
            console.log(response);
            var topicCardsContainer = $('#topicCardsContainer');
            topicCardsContainer.empty();

            // Create and append topic cards for each topicId and sectionName
            $.each(topicsAndSections, function (index, topic) {
              var cardHtml = `
                    <div class="card-body">
                        <h5 class="card-title">Week ${index + 1}: ${topic.id}</h5>
                        <div>
                          <p class="card-text">${topic.name}</p>
                          <input type="text" class="form-control datetime-picker" name="date-${topic.id}" placeholder="Select Date and Time">
                        </div>
                    </div>
                  `;
              topicCardsContainer.append(cardHtml);
            });

            // Initialize datetime picker for the dynamically added inputs
            flatpickr(".datetime-picker", {
              enableTime: true,
              dateFormat: "Y-m-d H:i",
            });

            // Cascading Date Changes

            cascadingDateChanges();


          },
          error: function () {
            console.error('Failed to fetch topics and sections.');
          }
        });


        // Fetch schedule information for the selected courseId using AJAX (Replace with your API call)
        $.ajax({
          url: '../api/api.php',
          type: 'POST',
          data: {
            action: 'getScheduleByCourse',
            courseId: selectedCourseId
          },
          success: function (response) {
            var scheduleData = JSON.parse(response);
            console.log('SCHEDULES FROM DB: ', scheduleData);
            // Loop through the schedule data and prepopulate datetime pickers
            $.each(scheduleData, function (index, schedule) {
              var topicId = schedule.topicId;
              var date = schedule.date;
              console.log('item date: ', date);

              // Find the datetime picker input for the current topicId and set its value
              $(`.datetime-picker[name='date-${topicId}']`).val(date);
            });
          },
          error: function () {
            console.error('Failed to fetch schedule for the selected course.');
          }
        });


      });

      // Handle form submission
      $('#schedulesForm').submit(function (e) {
        e.preventDefault();

        // Prepare the data for submission
        var formData = {
          action: 'fixSchedules',
          courseId: $('#courseSCH').val(),
          schedules: [] // Array to hold objects with topicId and date
        };

        // Iterate through the datetime pickers and add their values to the formData
        $(".datetime-picker").each(function () {
          var topicId = $(this).attr('name').replace('date-', '');
          var dateValue = $(this).val();

          // Push the data as an object into the schedules array
          formData.schedules.push({
            topicId: topicId,
            date: dateValue
          });
        });

        // Send the data using AJAX (Replace with your API call)
        console.log('SCHEDULES TO SAVE: ', formData);
        $.ajax({
          url: '../api/api.php',
          type: 'POST',
          data: formData,
          success: function (response) {
            // Handle the response from the server
            console.log(response);
            animateDialog('Schedules Saved Successfully.')
            // Additional actions after submitting the form
          },
          error: function () {
            console.error('Failed to submit form.');
          }
        });
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


      // Make AJAX call to get messages
      $.ajax({
        url: '../api/api.php',
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
          animateDialog('Error fetching messages.', "error");
        }
      });
    });




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
          url: '../api/api.php',
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
        url: '../api/api.php',
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
    success: function(response) {
      // Handle the success response here
      console.log('Email sent successfully:', response);
      // Clear form fields or perform any other actions as needed
      $('#instructor-list').val('');
      $('#subject').val('');
      $('#message').val('');
      $('#attachment').val('');
    },
    error: function(xhr, textStatus, errorThrown) {
      // Handle any AJAX errors here
      console.error('Error:', textStatus, errorThrown);
    }
  });
}

// Add an event listener to the form submission
$('#createMessageForm').submit(function(event) {
  event.preventDefault(); // Prevent the default form submission
  
  // Call the sendMessage function when the form is submitted
  sendMessageB();
});
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
        url: '../api/api.php',
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
          animateDialog('Invalid API key format. Please enter a valid API key starting with "sk-" and consisting of 51 characters made up of numbers, lowercase and uppercase letters only.', "error");
          return;
        }

        // Send the API key to the server for saving
        $.ajax({
          url: '../api/api.php',
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
              animateDialog('Failed to save API key. Please try again.', "error");
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
    // Function to send chat message to the server
    const udata = JSON.parse(sessionStorage.user);
    const cse = sessionStorage.getItem('courseToLearn');
    var myuid = udata.uid;
    console.log('USER ID: ', myuid);
    console.log('COURSE ID: ', cse);

    function sendChatMessage(message) {
      console.log('SEND chat CALLED');

      $.ajax({
        url: '../api/api.php',
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
          animateDialog('Error sending message.', "error");
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
        let avatarContent = `<img src="../${message.user.photo}" alt="${message.name} Avatar" class="avatar ${avatarPosition}">`;

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
        html += `<p><img src="../${user.photo}" alt="${user.name} Avatar" class="avatar"> ${user.name}</p>`;
      });
      return html;
    }

    const messageTextarea = $('#chatroom-message-textarea');
    messageTextarea.on('keyup', function (event) {
      if (event.key === 'Enter' && !event.shiftKey) {
        event.preventDefault();
        sendMessageTriggered();
      }
    });

    function sendMessageTriggered(){
      const message = messageTextarea.val().trim();
        if (message) {
          console.log('MESSAGE TO SEND IS: ', message);
          sendChatMessage(message);
          messageTextarea.val('');
        }
    }


    // Load initial chat history and logged-in users
    $(document).ready(function () {
      // Update chat history
      // const chatHistory = $('#chatroom-chat-history');
      // initialChatHistory.forEach(message => {
      //   chatHistory.append(formatChatMessage(message));
      // });
      // chatHistory.scrollTop(chatHistory[0].scrollHeight);

      // // Update logged-in users
      // const loggedInUsers = $('#logged-in-users');
      // loggedInUsers.html(formatLoggedInUsers(initialLoggedInUsers));

      $.ajax({
        url: '../api/api.php',
        method: 'POST',
        data: {
          action: 'sendMessage',
          message: 'init',
          userId: myuid,
          courseId: cse
        },
        success: function (response) {
          // Update chat history
          console.log(response);
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
          animateDialog('Error sending message.', "error");
        }
      });


    });
  </script>

  <script>
    $(document).ready(function () {
        var userData = JSON.parse(sessionStorage.getItem('user'));
      const sid = userData.stdnumber;
      $.ajax({
        url: '../api/api.php',
        type: 'POST',
        data: { teacherId:sid, action: 'getCoursesTeacher' },
        success: function (response) {
          var courses = JSON.parse(response);
          var courseSelect = $('#courseWTS');
          courseSelect.empty();
          $.each(courses, function (index, course) {
            courseSelect.append($('<option>').val(course.courseId).text(course.courseName));
          });

          // Trigger the change event to populate topic cards for the default course
          courseSelect.trigger('change');
        },
        error: function () {
          console.error('Failed to fetch courses.');
        }
      });


      $('#grades-form').submit(function (event) {
        event.preventDefault(); // Prevent the form from submitting normally


        if(checkWeightAssignments()){
          // Send the form data to the server
          $.ajax({
            url: '../api/api.php',
            type: 'POST',
            data: $(this).serialize() + '&action=saveWeights',
            success: function (response) {
              console.log('WEIGHTS: ', response);
              animateDialog("Weights Have Been Saved")
              // Update the response-div with the server's response
              $('#response-div').html(response);
            }
          });
        }
        else{
          animateDialog("Weights Need To Add To 100%","error")
        }

      });
    });
  </script>


  <script>
    $(document).ready(function () {
      const courseSelectA = $('#courseSelectA');
      const textbooksList = $('#textbooks-list');

      // Populate course options in the dropdown on page load
      userData = JSON.parse(sessionStorage.getItem('user'));
      const studentId = userData.stdnumber;

      // Function to fetch and display the course list
      function fetchCoursesC(studentId) {
        $.ajax({
          url: '../api/api.php',
          method: 'POST',
          data: { action: 'fetchCoursesTeacher', studentId: studentId },
          //dataType: 'json',
          success: function (response) {
            console.log('COURSES FETCHED SUCCESSFULLY', response);

            coursesData = response;
            // Populate the dropdown options using jQuery
            coursesData.forEach(course => {
              console.log("course is: ", course);
              const option = $('<option>', {
                value: course.id,
                text: course.name
              });
              courseSelectA.append(option);
            });

          },
          error: function (jqXHR, textStatus, errorThrown) {
            console.error('Failed to fetch courses:', errorThrown);
          }
        });
      }

      fetchCoursesC(studentId);

      // Populate textbooks list based on selected course
      courseSelectA.change(function () {
        const selectedCourseId = courseSelectA.val();
        if (selectedCourseId) {
          console.log("SELECTED Course Id for textbooks: ", selectedCourseId);
          fetchTextbooks(selectedCourseId);
        } else {
          textbooksList.empty();
        }
      });

      // Fetch textbooks for the selected course
      function fetchTextbooks(courseId) {
        $.ajax({
          url: '../api/api.php',
          method: 'POST',
          data: { action: 'fetchTextbooks', courseId: courseId }, // Adjust this data as needed
          //dataType: 'json', // Uncomment if you expect JSON response
          success: function (response) {
            data = JSON.parse(response);
            console.log(data.length);
            console.log('TEXTBOOKS FETCHED SUCCESSFULLY', data);

            // Clear the textbooks list
            textbooksList.empty();

            if (data.length === 0) {
              // No textbooks uploaded yet
              const noTextbooksListItem = $('<li>', {
                class: 'list-group-item',
                text: 'No textbook uploaded yet'
              });

              textbooksList.append(noTextbooksListItem);
            } else {
              // Populate the textbooks list using jQuery
              data.forEach(textbook => {
                const listItem = $('<li>', {
                  class: 'list-group-item clickable',
                  text: textbook, // Use the string value directly
                  click: function () {
                    openPDFViewer(`../uploads/${textbook}`);
                  }
                });

                // Create delete button and append it to the list item
                const deleteButton = $('<button>', {
                  html: '<i class="fas fa-trash"></i>', // FontAwesome icon
                  class: 'btn btn-danger delete-button locked-text button-grid',
                  click: function () {
                    deleteTextbook(courseId, textbook); // Use the string value directly
                  },
                  'data-en': "Delete",
                  'data-tr': "Sil"
                });

                listItem.append(deleteButton);

                textbooksList.append(listItem);
              });
            }

          },
          error: function (jqXHR, textStatus, errorThrown) {
            console.error('Failed to fetch textbooks:', errorThrown);
          }
        });
      }


      // Rest of the jQuery code for textbook deletion and upload remains the same
      function deleteTextbook(courseId, textbookName) {

        const tosend = {
          action: 'deleteTextbook',
          courseId: courseId,
          textbookName: textbookName
        }

        formData = new FormData()
        formData.append('action', 'deleteTextbook');
        formData.append('courseId', courseId);
        formData.append('textbookName', textbookName);

        let options = {
          title: `Are you sure you want to delete ${textbookName}?`,
          denyTitle: 'No',
          acceptTitle: 'Yes',
        }
    
        showOptionsDialog( options, () => confirmDeleteTextbook());

        function confirmDeleteTextbook(){
          $.ajax({
            url: '../api/api.php',
            method: 'POST',
            data: formData,
            //dataType: 'json',
            processData: false,
            contentType: false,
            success: function (response) {
              console.log('Textbook deleted successfully:', response);
              // Assuming you need to update the textbooks list after deletion

              animateDialog('Textbook deleted successfully!');
              fetchTextbooks(courseId); // Call your fetchTextbooks function

            },
            error: function (jqXHR, textStatus, errorThrown) {
              console.log("Failed with data: ", tosend);
              console.error('Failed to delete textbook:', errorThrown);
            }
          })
        }

  
      }

    });
  </script>

  <script>


    $(document).ready(function () {
      $('#upload-form').submit(function (e) {
        e.preventDefault();

        const selectedCourseId = $('#courseSelectA').val(); // Get the selected course ID
        var formData = new FormData(this);
        formData.append('action', 'uploadTextbook');
        formData.append('selectedCourseId', selectedCourseId);

        $.ajax({
          url: '../api/api.php',
          type: 'POST',
          data: formData,
          processData: false,
          contentType: false,
          success: function (response) {
            // Handle the response from the server
            //fetchTextbooks(courseId);
            console.log(response);
            animateDialog('Textbook uploaded successfully');
            window.location.href = 'home.html';
          },
          error: function (xhr, status, error) {
            // Handle errors
            console.log(error);
          }
        });
      });


    });

  </script>



  <script>
    $(document).ready(function () {
      const courseSelectW = $('#courseSelectW');
      const webresourcesList = $('#webresources-list');

      // Populate course options in the dropdown on page load
      userData = JSON.parse(sessionStorage.getItem('user'));
      const studentId = userData.stdnumber;

      // Function to fetch and display the course list
      function fetchCoursesW(studentId) {
        $.ajax({
          url: '../api/api.php',
          method: 'POST',
          data: { action: 'fetchCoursesTeacher', studentId: studentId },
          //dataType: 'json',
          success: function (response) {
            console.log('COURSES FETCHED SUCCESSFULLY', response);

            coursesData = response;
            // Populate the dropdown options using jQuery
            coursesData.forEach(course => {
              console.log("course is: ", course);
              const option = $('<option>', {
                value: course.id,
                text: course.name
              });
              courseSelectW.append(option);
            });

          },
          error: function (jqXHR, textStatus, errorThrown) {
            console.error('Failed to fetch courses:', errorThrown);
          }
        });
      }

      fetchCoursesW(studentId);

      // Populate textbooks list based on selected course
      courseSelectW.change(function () {
        const selectedCourseId = courseSelectW.val();
        if (selectedCourseId) {
          console.log("SELECTED Course Id for textbooks: ", selectedCourseId);
          fetchWebresources(selectedCourseId);
        } else {
          webresourcesList.empty();
        }
      });

      // Fetch textbooks for the selected course
      function fetchWebresources(courseId) {
        $.ajax({
          url: '../api/api.php',
          method: 'POST',
          data: { action: 'fetchWebresources', courseId: courseId }, // Adjust this data as needed
          //dataType: 'json', // Uncomment if you expect JSON response
          success: function (response) {
            data = JSON.parse(response);
            console.log(data.length);
            console.log('WEB SOURCES FETCHED SUCCESSFULLY', data);

            // Clear the textbooks list
            webresourcesList.empty();

            if (data.length === 0) {
              // No textbooks uploaded yet
              const noWebresourcesListItem = $('<li>', {
                class: 'list-group-item',
                text: 'No Web resources saved yet'
              });

              webresourcesList.append(noWebresourcesListItem);
            } else {
              // Populate the textbooks list using jQuery
              data.forEach(webresource => {

                let listItem = document.createElement("li");
                listItem.className = "list-group-item d-flex justify-content-between align-items-center"

                let button = document.createElement('button');
                button.className = "btn btn-danger delete-button locked-text button-grid";
                button.setAttribute("data-en", "Delete")
                button.setAttribute("data-tr", "Sil")
                button.innerHTML = `<i class="fas fa-trash"></i>`;
                button.addEventListener("click", () => deleteWebresource(courseId, webresource));

                const innerHTML = `
                <a href="${webresource}" target="_blank">${webresource}</a>
                `;

                listItem.innerHTML = innerHTML;
                listItem.append(button);

                // const listItem = $('<li>', {
                //   class: 'list-group-item d-flex justify-content-between align-items-center',
                //   text: webresource // Use the string value directly
                // });

                // Create delete button and append it to the list item
                // const deleteButton = $('<button>', {
                //   html: '<i class="fas fa-trash"></i>', // FontAwesome icon
                //   class: 'btn btn-danger delete-button locked-text button-grid',
                //   click: function () {
                //     deleteWebresource(courseId, webresource); // Use the string value directly
                //   },
                //   'data-en': "Delete",
                //   'data-tr': "Sil"
                // });

                webresourcesList.append(listItem);
              });
            }

          },
          error: function (jqXHR, textStatus, errorThrown) {
            console.error('Failed to fetch textbooks:', errorThrown);
          }
        });
      }


      // Rest of the jQuery code for textbook deletion and upload remains the same
      function deleteWebresource(courseId, webresourceName) {

        const tosend = {
          action: 'deleteWebresource',
          courseId: courseId,
          webresourceName: webresourceName
        }

        formData = new FormData()
        formData.append('action', 'deleteWebresource');
        formData.append('courseId', courseId);
        formData.append('webresourceName', webresourceName);

        let options = {
          title: `Are you sure you want to delete ${webresourceName}?`,
          denyTitle: 'No',
          acceptTitle: 'Yes',
        }
    
        showOptionsDialog( options, () => confirmDeleteWebResource() )

        function confirmDeleteWebResource(){
          $.ajax({
            url: '../api/api.php',
            method: 'POST',
            data: formData,
            //dataType: 'json',
            processData: false,
            contentType: false,
            success: function (response) {
              console.log('Web resource deleted successfully:', response);
              // Assuming you need to update the textbooks list after deletion
              fetchWebresources(courseId); // Call your fetchTextbooks function
            },
            error: function (jqXHR, textStatus, errorThrown) {
              console.log("Failed with data: ", tosend);
              console.error('Failed to delete textbook:', errorThrown);
            }
          })
        }

      }

    });
  </script>
  <script>
    $(document).ready(function () {

      $('#webresource-form').submit(function (e) {
        e.preventDefault();

        const selectedCourseId = $('#courseSelectW').val(); // Get the selected course ID
        const webresource = $('#webresource').val();
        var formData = new FormData(this);
        formData.append('action', 'saveWebresource');
        formData.append('courseId', selectedCourseId);
        formData.append('webresource', webresource);

        $.ajax({
          url: '../api/api.php',
          type: 'POST',
          data: formData,
          processData: false,
          contentType: false,
          success: function (response) {
            // Handle the response from the server
            //fetchWebresources(courseId);
            console.log(response);
            animateDialog("Web link saved successfully");
            window.location.href('home.html');
          },
          error: function (xhr, status, error) {
            // Handle errors
            console.log(error);
          }
        });
      });


    });

  </script>

  <script>

    function createNewCourse(){

      let chosenCourseSemester = document.querySelector("#courseSemester");
        chosenCourseSemester = chosenCourseSemester.getAttribute("data-value");
        console.log("data-value: ", chosenCourseSemester);

        // Get the form data.
        var formData = {
          courseCode: $('#courseCodeM').val(),
          courseName: $('#courseNameM').val(),
          courseSemester: chosenCourseSemester,
          stdNumber: JSON.parse(sessionStorage.getItem("user")).stdnumber,
          lectures: [
            $('#Lecture1').text(),
            $('#Lecture2').text(),
            $('#Lecture3').text(),
            $('#Lecture4').text(),
            $('#Lecture5').text(),
            $('#Lecture6').text(),
            $('#Lecture7').text(),
            $('#Lecture8').text(),
            $('#Lecture9').text(),
            $('#Lecture10').text(),
            $('#Lecture11').text(),
            $('#Lecture12').text(),
            $('#Lecture13').text(),
            $('#Lecture14').text()
          ],
          // midTermExam: $('#midTermExam').val(),
          // finalExam: $('#finalExam').val()
          action: 'createCourse'
        };
        console.log('CREATE COURSE: ', formData);

        // Send the form data to the API.
        $.ajax({
          url: '../api/api.php',
          method: 'POST',
          data: formData,
          //dataType: 'json',
          success: function (resp) {
            response = JSON.parse(resp);
            if (response.status === 'success') {
              animateDialog('Course created successfully!');
            } else {
              animateDialog('Something went wrong', "error");
              console.log(response.message);
            }
          },
          error: function (jqXHR, textStatus, errorThrown) {
            console.log(errorThrown);
          }
        });

    }

  </script>


  <script>
    $(document).ready(function () {

      const courseSelectE = $('#editCourseDropdown');


      // Populate course options in the dropdown on page load
      userData = JSON.parse(sessionStorage.getItem('user'));
      const studentId = userData.stdnumber;
      function fetchCoursesE(studentId) {
        $.ajax({
          url: '../api/api.php',
          method: 'POST',
          data: { action: 'fetchCoursesTeacher', studentId: studentId },
          //dataType: 'json',
          success: function (response) {
            console.log('COURSES for EDIT FETCHED', response);

            coursesData = response;
            // Populate the dropdown options using jQuery
            coursesData.forEach(course => {
              console.log("course is: ", course);
              const option = $('<option>', {
                value: course.id,
                text: course.name
              });
              courseSelectE.append(option);
            });

          },
          error: function (jqXHR, textStatus, errorThrown) {
            console.error('Failed to fetch courses:', errorThrown);
          }
        });
      }

      fetchCoursesE(studentId);

      $("#editCourseDropdown").on("change", function () {
        var selectedCourseId = $(this).val();
        sessionStorage.setItem('courseToEdit', selectedCourseId);
        var action = "fetchCourseAndLectureDetails";

        // Construct the data object using plain JavaScript object syntax
        var requestData = {
          courseId: selectedCourseId,
          action: action
        };
        $.ajax({
          type: "POST",
          url: '../api/api.php', // Replace with your PHP script URL
          data: requestData, //{ courseId: selectedCourseId, action: action },
          dataType: "json",
          success: function (response) {
            console.log("CheckState:", response.checkState.length === response.lectures.length);
            if (response.action === "populateForm") {
              // Populate form fields with fetched data
              $("#courseCodeME").val(response.courseCode);
              $("#courseNameME").val(response.courseName);

              for (var i = 0; i < response.lectures.length; i++) {
                $("#LectureE" + (i + 1)).val(response.lectures[i]);
                $("#LectureE" + (i + 1) + "Checkbox").prop("checked", response.checkState[i] === 'ok' ? true : false);
                // Check or uncheck the corresponding checkbox based on checkstate
                // if (response.checkstate[i] === 'ok') {
                //   $("#LectureE" + (i + 1) + "Checkbox").prop("checked", true);
                // } else{
                //   $("#LectureE" + (i + 1) + "Checkbox").prop("checked", false);
                // }

              }
            } else {
              console.log("Invalid response action");
            }
          },
          error: function (xhr, status, error) {
            console.error("Error fetching course and lecture details:", error);
          }
        });



        // LISTEN TO CLICK OF SAVE BUTTON
        $("#lectures-form").submit(function (event) {
          event.preventDefault(); // Prevent default form submission

          // Get the form data.
          var formData = {
            courseCode: $('#courseCodeME').val(),
            courseName: $('#courseNameME').val(),
            lectures: [
              $('#LectureE1').val(),
              $('#LectureE2').val(),
              $('#LectureE3').val(),
              $('#LectureE4').val(),
              $('#LectureE5').val(),
              $('#LectureE6').val(),
              $('#LectureE7').val(),
              $('#LectureE8').val(),
              $('#LectureE9').val(),
              $('#LectureE10').val(),
              $('#LectureE11').val(),
              $('#LectureE12').val(),
              $('#LectureE13').val(),
              $('#LectureE14').val()
            ],
            // midTermExam: $('#midTermExam').val(),
            // finalExam: $('#finalExam').val()
            action: 'editCourse'
          };
          console.log('EDIT COURSE: ', formData);

          // Send the form data to the API.
          $.ajax({
            url: '../api/api.php',
            method: 'POST',
            data: formData,
            //dataType: 'json',
            success: function (resp) {
              response = JSON.parse(resp);
              if (response.status === 'success') {
                animateDialog('Edited course successfully!');
              } else {
                animateDialog("Something went wrong", "error")
                console.log(response.message);
              }
            },
            error: function (jqXHR, textStatus, errorThrown) {
              console.log(errorThrown);
            }
          });
        });



      });
    });

  </script>

  <script>
    $(document).ready(function () {
      const courseSelectO = $('#courseDropdownO');
      // Populate course options in the dropdown on page load
      userData = JSON.parse(sessionStorage.getItem('user'));
      const studentId = userData.stdnumber;
      function fetchCoursesO(studentId) {
        $.ajax({
          url: '../api/api.php',
          method: 'POST',
          data: { action: 'fetchCoursesTeacher', studentId: studentId },
          //dataType: 'json',
          success: function (response) {
            console.log('COURSES for EDIT FETCHED', response);

            coursesData = response;
            // Populate the dropdown options using jQuery
            coursesData.forEach(course => {
              console.log("course is: ", course);
              const option = $('<option>', {
                value: course.id,
                text: course.name
              });
              courseSelectO.append(option);
            });

          },
          error: function (jqXHR, textStatus, errorThrown) {
            console.error('Failed to fetch courses:', errorThrown);
          }
        });
      }

      fetchCoursesO(studentId);



      $("#courseDropdownO").on("change", function () {
        var selectedCourseId = $(this).val();
        var action = "getResponseOrigin";

        $.ajax({
          type: "POST",
          url: '../api/api.php', // Path to your PHP script
          data: { courseId: selectedCourseId, action: action },
          dataType: "json",
          success: function (response) {
            // Parse the response array and check corresponding checkboxes
            var responseArray = JSON.parse(response.responseOrigin);

            $("input[name='resourceOption']").prop("checked", false);

            for (var i = 0; i < responseArray.length; i++) {
              $("input[value='" + responseArray[i] + "']").prop("checked", true);
            }
          },
          error: function (xhr, status, error) {
            console.error("Error fetching response origin:", error);
          }
        });
      });

      // Save button click event
      $("#saveResourcesBtn").on("click", function () {

        var selectedResources = [];
        $("input[name='resourceOption']:checked").each(function () {
          selectedResources.push($(this).val());
        });

        var courseId = $("#courseDropdownO").val();
        var action = "saveResources";
        datatosave = { courseId: courseId, selectedResources: selectedResources, action: action };
        console.log('DATA TO SAVE: ', datatosave);

        $.ajax({
          type: "POST",
          url: '../api/api.php', // Path to your PHP script
          data: datatosave,
          dataType: "json",
          success: function (response) {
            // Handle the success response, if needed
            animateDialog('Resources saved successfully');
            console.log("Resources saved successfully:", response);
          },
          error: function (xhr, status, error) {
            animateDialog('Failed to save resources', "error")
            console.error("Error saving resources:", error);
          }
        });
      });
    });

  </script>

  <script>

    $(document).ready(function () {
      var userData = JSON.parse(sessionStorage.getItem('user'));
      const studentId = userData.stdnumber;
      // Fetch and populate course list for the student
      $.ajax({
        type: "POST",
        url: '../api/api.php', // Path to your PHP script
        data: { action: "getPureCourses", studentId: studentId }, // Replace with actual studentId
        dataType: "json",
        success: function (response) {
          var courseList = $("#course-list");
          response.forEach(function (course) {
            var listItem = $("<li>", {
              class: "list-group-item"
            }).appendTo(courseList);

            $("<span>", {
              text: course.courseName
            }).appendTo(listItem);

            var checkbox = $("<input>", {
              type: "checkbox",
              "data-course-id": course.courseId
            }).appendTo(listItem);

            // Check the checkbox if apiKey is set for the course
            if (course.apiKey) {
              checkbox.prop("checked", true);
            }
          });
        },
        error: function (xhr, status, error) {
          console.error("Error fetching course list:", error);
        }
      });

      // Save API Key for selected courses
      // Save API Key for selected courses
      $("#api-key-button").on("click", function (e) {
        e.preventDefault();


        var coursesToUpdate = [];
        var coursesToDeleteApiKey = [];

        // Loop through checked checkboxes and update/delete API key
        $("input[type='checkbox']").each(function () {
          var courseId = $(this).data("course-id");

          if ($(this).is(":checked")) {
            coursesToUpdate.push(courseId);
          } else {
            coursesToDeleteApiKey.push(courseId);
          }
        });

        // Update API key for selected courses
        $.ajax({
          type: "POST",
          url: '../api/api.php', // Path to your PHP script
          data: { action: "updateApiKeys", studentId: studentId, coursesToUpdate: coursesToUpdate },
          dataType: "json",
          success: function (response) {
            console.log("API Keys updated successfully:", response);

          },
          error: function (xhr, status, error) {
            console.error("Error updating API Keys:", error);
          }
        });

        // Delete API key for unchecked courses
        $.ajax({
          type: "POST",
          url: '../api/api.php', // Path to your PHP script
          data: { action: "deleteApiKeys", studentId: studentId, coursesToDeleteApiKey: coursesToDeleteApiKey },
          dataType: "json",
          success: function (response) {
            console.log("API Keys deleted successfully:", response);
          },
          error: function (xhr, status, error) {
            console.error("Error deleting API Keys:", error);
          }
        });

        animateDialog('API Key Removed');
      });
    });

  </script>


  <script>
    $(document).ready(function () {
      var userData = JSON.parse(sessionStorage.getItem('user'));
      const sid = userData.stdnumber;
      fetchCoursesForUser(sid, '#courseIdDropdown');

      $("#fetchDataButton").click(function () {
        var courseId = $("#courseIdDropdown").val();
        var field = $("#displayFieldDropdown").val();; // Change this to the desired field (accuracy, promptEfficiency, timeEfficiency, total)

        // Make an AJAX request to api.php to fetch the data
        $.ajax({
          url: "../api/api.php",
          method: "POST",
          data: { action: 'fetchClassGrades', courseId: courseId, selectedField: field },
          dataType: "json",
          success: function (data) {
            // Clear existing table rows
            $("#dataTable tbody").empty();

            // Populate the table with fetched data
            data.forEach(function (student, index) {
              var row = $("<tr>");
              row.append($("<td>").text(index + 1));
              row.append($("<td>").html(
                `
                <div class="table-image">
                  <img src="${student.photo}" alt="Student Photo">
                </div>
                `
              ));
              row.append($("<td>").text(student.name));

              // Populate 14 data columns based on topics array
              for (var i = 1; i <= 14; i++) {
                var columnKey = "column" + i;
                var cellValue = student[columnKey] || "";
                row.append($("<td>").text(cellValue));
              }

              $("#dataTable tbody").append(row);
            });
          },
          error: function (error) {
            console.error(error);
          }
        });
      });
    });
  </script>

  <script>
    function fetchCoursesForUser(sid, cdId) {
      $.ajax({
        url: '../api/api.php',
        method: 'POST',
        data: { studentId: sid, action: 'fetchCoursesForUserTeacher' },
        dataType: 'json',
        success: function (response) {
          console.log('COURSES FETCHED SUCCESSFULY', response);
          var courses = response.courses;
          console.log("FIRST COURSE NAME: ", courses[0].name);
          const courseSelect = $(cdId);
          courseSelect.empty();
          courseSelect.append('<option value="" style="background-color:lightblue;">  Select a Course  </option>');
          // Add options for each course
          courses.forEach(course => {
            const option = $('<option></option>')
              .val(course.id)
              .text(course.name);
            courseSelect.append(option);
          });

          // Trigger change event to populate topics for the selected course
          courseSelect.trigger('change');
          //sessionStorage.setItem("courseToLearn",courseId);

        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.error('Failed to fetch courses:', errorThrown);
        }
      });
    }


    function fetchStudentsForCourse(cId, cdId) {
      $.ajax({
        url: '../api/api.php',
        method: 'POST',
        data: { courseId: cId, action: 'fetchStudentsForCourse' },
        dataType: 'json',
        success: function (response) {
          console.log('STUDENTS FETCHED SUCCESSFULY', response);
          var students = response.students;
          console.log("FIRST STUDENT NAME: ", students.name);
          const studentSelect = $(cdId);
          studentSelect.empty();
          studentSelect.append('<option value="" style="background-color:lightblue;">  Select a student  </option>');
          // Add options for each course
          students.forEach(student => {
            const option = $('<option></option>')
              .val(student.id)
              .text(student.name);
            studentSelect.append(option);
          });

          // Trigger change event to populate topics for the selected course
          studentSelect.trigger('change');
          //  sessionStorage.setItem("courseToLearn",courseId);

        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.error('Failed to fetch courses:', errorThrown);
        }
      });
    }

    $(document).ready(function () {
      // Retrieve studentId from sessionStorage
      const userData = JSON.parse(sessionStorage.user);
      // Access the stdnumber property
      var sid = userData.stdnumber;
      // Fetch courses for the user on page load
      // fetchCoursesForUser(sid, '#course');
      // fetchCoursesForUser(sid, '#courseG');
      fetchCoursesForUser(sid, '#courseCGC');

      // Handle course selection change event
      $('#courseCGC').change(function (e) {
        e.preventDefault();
        const courseId = $(this).val();
        if (courseId) {
          fetchStudentsForCourse(courseId, '#courseCGS');
          // sessionStorage.setItem('courseToLearn', courseId); // Save selected course to sessionStorage
        } else {
          // Clear topic options if no course is selected
          const topicSelect = $('#courseCGS');
          topicSelect.empty();
          // sessionStorage.setItem('topicToLearn', null);
        }
      });


      // Handle topic selection change event
      $('#courseCGS').change(function (e) {
        e.preventDefault();
        const studentToView = $(this).val();
        if (studentToView) {
          sessionStorage.setItem('studentToView', studentToView); // Save selected topic to sessionStorage

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

      $('#courseCGC').change(function (e) {
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

        let weeklyEvaluationScore = document.querySelector('#weeklyEvaluationScore');
        let midTermExamScore = document.querySelector('#midTermExamScore');
        let finalExamScore = document.querySelector('#finalExamScore');
        let totalSemesterScore = document.querySelector('#totalSemesterScore');

        $.ajax({    
          url: '../api/api.php',
          type: 'POST',
          data: {
            studentId: sessionStorage.getItem('studentToView'),
            courseId: sessionStorage.getItem('semesterCourseForGrade'),
            action: 'fetchSemesterGrades'
          },
          dataType: 'json',
          success: function (data) {
            console.log("DATA: ",data);
            // Update the card elements with the received data
            weeklyEvaluationScore.setAttribute('data-en', 'Score: ' + data.weekly_score)
            weeklyEvaluationScore.setAttribute('data-tr', 'Puan: ' + data.weekly_score)

            midTermExamScore.setAttribute('data-en', 'Score: ' + data.midterm_score)
            midTermExamScore.setAttribute('data-tr', 'Puan: ' + data.midterm_score)

            finalExamScore.setAttribute('data-en', 'Score: ' + data.exam_score)
            finalExamScore.setAttribute('data-tr', 'Puan: ' + data.exam_score)

            totalSemesterScore.setAttribute('data-en', 'Score: ' + data.total_score)
            totalSemesterScore.setAttribute('data-tr', 'Puan: ' + data.total_score)
            
            $('#semesterRemark').text(data.remark);
            $('#letterGrade').text(data.letter_grade);
          },
          error: function (xhr, status, error) {
            console.error('Error:', error);
            weeklyEvaluationScore.setAttribute('data-en', 'Score: N/A')
            weeklyEvaluationScore.setAttribute('data-tr', 'Puan: N/A');

            midTermExamScore.setAttribute('data-en', 'Score: N/A')
            midTermExamScore.setAttribute('data-tr', 'Puan: N/A');

            finalExamScore.setAttribute('data-en', 'Score: N/A' )
            finalExamScore.setAttribute('data-tr', 'Puan: N/A');

            totalSemesterScore.setAttribute('data-en', 'Score: N/A' )
            totalSemesterScore.setAttribute('data-tr', 'Puan: N/A');

            $('#semesterRemark').text('N/A');
            $('#letterGrade').text('N/A');
          }
        });


      });
    });
  </script>


<script>
  //MODIFYING A STUDENT'S GRADES
function fetchTopics(cid, divId){
  $.ajax({
          url: '../api/api.php',
          type: 'POST',
          data: {
            action: 'fetchTopicsForCourse',
            courseId: cid,

          },
          success: function (response) {
            // Process the response and populate the sectionId dropdown
            var topicIds = response.topics; //JSON.parse(response);
            console.log(response);
            var topicIdSelect = $(divId);
            topicIdSelect.empty();
            $.each(topicIds, function (index, topicId) {
              topicIdSelect.append($('<option>').val(topicId.id).text(topicId.name));
            });
          },
          error: function () {
            console.error('Failed to fetch sectionIds.');
          }
        });
}



function fetchLectureScores(sid, cid, tid, divid){
  const verif={
            action: 'fetchLectureScores',
            courseId: cid,
            studentId: sid,
            topicId: tid

          };
  console.log('DATA DISPATCHED FOR SCORES: ', verif);

  $.ajax({
          url: '../api/api.php',
          type: 'POST',
          data: {
            action: 'fetchLectureScores',
            courseId: cid,
            studentId: sid,
            topicId: tid

          },
          success: function (res) {
            // Process the response and populate the sectionId dropdown
            // Populate the input fields with the fetched data
            console.log('RESPONSE ',res);
            response = JSON.parse(res);
            $('#accuracyModify').val(response.accuracy);
            $('#promptEfficiencyModify').val(response.promptEfficiency);
            $('#timeEfficiencyModify').val(response.timeEfficiency);
            $('#totalModify').val(response.total);
            // Calculate the total score based on weights
            console.log("PE: ",JSON.parse(res).promptEfficiency);
        
          },
          error: function () {
            console.error('Failed to fetch sectionIds.');
          }
        });
}



function updateLectureScores(sid, cid, tid, score, ac, pe, te,total){

  const requestData={
            action: 'saveGrades',
            courseId: cid,
            studentId: sid,
            topic: tid,
            score: score,
            pe: pe,
            te: te,
            ac: ac,
            total: total

          };

  $.ajax({
          url: '../api/api.php',
          type: 'POST',
          data: requestData,
          success: function (res) {
            // Process the response and populate the sectionId dropdown
            // Populate the input fields with the fetched data
            console.log('RESPONSE ',res);
            animateDialog('Scores updated successfully');
        
          },
          error: function () {
            console.error('Failed to fetch sectionIds.');
          }
        });
}


  $(document).ready(function () {
      // Retrieve studentId from sessionStorage
      const userData = JSON.parse(sessionStorage.user);
      // Access the stdnumber property
      var sid = userData.stdnumber;
      // Fetch courses for the user on page load
      // fetchCoursesForUser(sid, '#course');
      // fetchCoursesForUser(sid, '#courseG');
      fetchCoursesForUser(sid, '#courseModifyC');

      $('#courseModifyC').change(function (e) {
        e.preventDefault();
        const courseId = $(this).val();
        if (courseId) {
          fetchTopics(courseId, '#topicModifyT');
          sessionStorage.setItem('courseForGrade', courseId); // Save selected course to sessionStorage
        } else {
          // Clear topic options if no course is selected
          const topicSelect = $('#topicModifyT');
          topicSelect.empty();
          sessionStorage.setItem('courseForGrade', null);
        }
      });      
      // Handle course selection change event
      $('#topicModifyT').change(function (e) {
        e.preventDefault();
        const courseId = $('#courseModifyC').val();//sessionStorage.getItem('courseForGrade');//$(this).val();
        if (courseId) {
          fetchStudentsForCourse(courseId, '#courseModifyS');
          // sessionStorage.setItem('courseToLearn', courseId); // Save selected course to sessionStorage
        } else {
          // Clear topic options if no course is selected
          const topicSelect = $('#courseModifyS');
          topicSelect.empty();
          // sessionStorage.setItem('topicToLearn', null);
        }
      });


      // Handle topic selection change event
      $('#courseModifyS').change(function (e) {
        e.preventDefault();
        const sid = $(this).val();
        if (sid) {
          var cid = $('#courseModifyC').val();
          var tid = $('#topicModifyT').val();
          var divid = '#gradesModifyForm';
          fetchLectureScores(sid, cid, tid, divid);
          sessionStorage.setItem('studentToView', sid); // Save selected topic to sessionStorage

        }
      });




      const updateScoresButton = document.getElementById('update-scores-button');
      updateScoresButton.addEventListener('click', function (e) {
        e.preventDefault();

        console.log("Initiated Scores Update");
        const sid = $('#courseModifyS').val();
        const cid = $('#courseModifyC').val();
        const tid = $('#topicModifyT').val();
        const ac = $('#accuracyModify').val();
        const pe = $('#promptEfficiencyModify').val();
        const te = $('#timeEfficiencyModify').val();
        var totl = (0.4*parseFloat(ac) + 0.45*parseFloat(pe)+0.15*parseFloat(te)).toFixed(2);
        const score = totl;
        updateLectureScores(sid, cid, tid, score, ac, pe, te,totl);

      });
    });


</script>


<script>
  $(document).ready(function() {

    var userData = JSON.parse(sessionStorage.getItem('user'));
      const sid = userData.stdnumber;
      fetchCoursesForUser(sid, '#courseExport');

  let my_courseId;
  $('#courseExport').change(function (e) {
        e.preventDefault();
        my_courseId = $(this).val();

        $.ajax({
    type: 'POST',
    url: '../api/api.php',
    data: { courseId: my_courseId, action:'fetchCourseList' },
    success: async function (response) {
        // Parse the JSON response
        var courseList = JSON.parse(response);
        console.log('COURSE LIST FOR EXPORT: ',courseList[0]);
        // Create a table element
        var table = document.createElement('table');
        table.className = 'course-table'; // Add a CSS class if needed

        // Create table headers
        var tableHeader = table.createTHead();
        var headerRow = tableHeader.insertRow(0);
        for (var key in courseList[0]) {
            var th = document.createElement('th');
            th.textContent = key;
            headerRow.appendChild(th);
        }

        // Create table rows and populate data
        var tableBody = table.createTBody();
        for (var i = 0; i < courseList.length; i++) {
            var row = tableBody.insertRow(i);
            for (var key in courseList[i]) {
                var cell = row.insertCell();
                cell.textContent = courseList[i][key];
            }
        }

        console.log('table: ',table);
        // Clear the existing content of the course-list div
        var courseListDiv = document.getElementById('final-course-list');
        courseListDiv.innerHTML = '';

        // Append the table to the course-list div
        if(courseList.length !==0){
          courseListDiv.appendChild(table);
        }else{
          courseListDiv.innerHTML = '   No Data Available for selected course';
        }
        
    },
    error: function (error) {
        console.error('AJAX Error:', error);
    }
});
      });
  // AJAX request to fetch course list


  const exportToExcelButton = document.getElementById('exportToExcel');
  exportToExcelButton.addEventListener('click', function(e){
    e.preventDefault();
    console.log('EXPORT BUTTON CLICKED');
    $.ajax({
    url: '../api/api.php',
    type: 'POST',
    data: {
      action: 'fetchCourseList',
      courseId: my_courseId // Replace with the actual course ID
    },
    success: async function (res) {
        response = JSON.parse(res);
        console.log('TO EXCEL: ',response);

        response = JSON.parse(res);

        const XLSX = await import("https://cdn.sheetjs.com/xlsx-0.19.2/package/xlsx.mjs");

        const worksheet = XLSX.utils.json_to_sheet(response)

        const workbook = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(workbook, worksheet, "Result Sheet");

        XLSX.writeFile(workbook, "Results Lists.xlsx", { compression: true });
        

                        // Convert the HTML response to Excel
                        // htmlTableToExcel(response, 'course_list.xlsx');

                    },
    error: function() {
      // Handle error case
      console.log('Error occurred in AJAX request');
    }
  });
  })


});
</script>  

<script>
  document.getElementById('exportClassButton').addEventListener('click', function () {
    // Get the table element
    var table = document.getElementById('dataTable');

    // Convert the table data to an array
    var dataArray = [];
    var headers = [];
    for (var i = 0; i < table.rows[0].cells.length; i++) {
      headers[i] = table.rows[0].cells[i].innerText;
    }
    dataArray.push(headers);
    for (var i = 1; i < table.rows.length; i++) {
      var row = [];
      for (var j = 0; j < table.rows[i].cells.length; j++) {
        row[j] = table.rows[i].cells[j].innerText;
      }
      dataArray.push(row);
    }

    // Create a worksheet
    var ws = XLSX.utils.aoa_to_sheet(dataArray);

    // Create a workbook
    var wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');

    // Export the workbook as an Excel file
    XLSX.writeFile(wb, 'table_data.xlsx');
  });
</script>


<script>



  $(document).ready(function() {
      // Function to fetch and display data
      
      var userData = JSON.parse(sessionStorage.getItem('user'));
      const sid = userData.stdnumber;
      
      fetchCoursesForUser(sid, '#courseSelectStud');

      function fetchData(teacherId, selectedCourseId) {
          $.ajax({
              url: '../api/api.php',
              type: 'POST',
              data: {
                  teacherId: teacherId,
                  courseId: selectedCourseId,
                  action: 'getStudentsRequestList'
              },
              success: function(data) {
                    // Parse the JSON data
                    var studentsData = data; //JSON.parse(data);
                    console.log(data);
                    var listHTML = '';

                    // Loop through the data and create list items
                    $.each(studentsData, function(index, student) {
                      listHTML += '<li class="row-list-card">';
                      listHTML += '<span style="flex: 1;">' + student.name + ' (ID: ' + student.stdNumber + ')</span>';
                      var isChecked = student.approval === 'Approved' ? 'checked' : '';
                      listHTML += '<input type="checkbox" data-studentid="' + student.studentId + '" style="margin-left: 10px;" ' + isChecked + ' />';
                      listHTML += '</li>';
                    });

                    $('#studentsListAll').html(listHTML);

                    // Attach a click event handler to the checkboxes
                    $('.row-list-card input[type="checkbox"]').on('change', function() {

                      showBatchSelectContainerView();

                      var studentId = $(this).data('studentid');
                      var approvalStatus = this.checked ? 'Approved' : 'Not Approved';

                      // Make an AJAX request to update subscriptions.approval
                      $.ajax({
                        url: '../api/api.php',
                        type: 'POST',
                        data: {
                          action: 'updateApprovalStatus',
                          studentId: studentId,
                          courseId: selectedCourseId,
                          approvalStatus: approvalStatus 
                        },
                        success: function(response) {
                          // Handle the response if needed
                          // console.log('Approval status updated for student with ID: ' + studentId);
                          console.log(response);
                        },
                        error: function(error) {
                          // Handle errors if any
                          console.error('Error updating approval status: ' + error.responseText);
                        }
                      });
                    });

                    showBatchSelectContainerView();
                  },
              error: function(error) {
                  // Handle errors if any
                  console.error('Error fetching data: ' + error.responseText);
              }
          });
      }
 
      

      $('#courseSelectStud').change(function () {
        var selectedCourseId = $('#courseSelectStud').val();
        console.log('TRIGGERED STUDENT LIST FETCH');
        fetchData(teacherId=sid, selectedCourseId);
      });
      // Call the fetchData function to load data initially
      
  });
  </script>
  
  <script>
  // Get the stdNumber from sessionStorage.user
  var stdNumber = sessionStorage.getItem("user");
  stdNumber = JSON.parse(stdNumber).stdnumber;

  // console.log("stdNumber", stdNumber)

  //TODO: This code hides the Select free courses under the API KEY tab
  // Check if stdNumber is not equal to 'STD020'
  if (stdNumber !== 'STD020') {
    document.getElementById('Admin-API-Box').style.display = 'none';
  }

</script>

<script>

  function getDashboardDetails(){
        // Define the studentId
        const dbData = JSON.parse(sessionStorage.getItem('user'));
        const studentId = dbData.stdnumber;
    
        // Make an AJAX request to fetch data
        $.ajax({
            url: '../api/api.php',
            type: 'POST',
            dataType: 'json',
            data: { action: 'getAdminDashboardData', teacherId: studentId },
            success: function(data) {
                // Update the dashboard cards with the received data
                $("#dashboard-courses-count").text(data.courses);
                $("#dashboard-students-count").text(data.students);
                $("#dashboard-unread-messages-count").text(data.unread_messages);
                $("#dashboard-approved-student-count").text(data.online_students);
                $("#dashboard-requests-count").text(data.requests);

                console.log('requests: ', data.requests);
            },
            error: function(error) {
                console.error('Error fetching data: ' + error);
            }
        });
  }

  $(document).ready(function() {
      getDashboardDetails();
  })

</script>

</body>

</html>