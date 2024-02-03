
const sendMessageBox = document.querySelector(".send-message-box");
const inputMessage = document.getElementById("messageTextarea");
const chatHistory = document.querySelector(".chat-history");
const startButton = document.querySelector(".start-button");
const instructionMessages = document.querySelector(".instruction-messages");
const instructionImage = document.querySelector(".instruction-image");
const countdownTimer = document.querySelector(".countdown-timer");
const timerHours = countdownTimer.querySelector(".timer-hours");
const timerMinutes = countdownTimer.querySelector(".timer-minutes");
const timerSeconds = countdownTimer.querySelector(".timer-seconds");
const exitButton = document.querySelector(".exit-button");
const skipButton = document.querySelector(".skip-button");
const sendIcon = document.querySelector('#sendIcon');
gradesButton = document.getElementById('grades-button');

var webContext = 'Please compose a response to the query `${prompt}` using the web resources `${text}`. Please include at least one link to the information source.';
var gptcontext;
var numPrompts;

var corpus;
var scorpus;
var mcq;
var fresp;
var tscore;
var timeeff;

var timerInterval;
var currentInstructionIndex;

startButton.style.display="none";
skipButton.style.display="none";


var textMain ="";
var instructions;

var topicScores = {};
var timeEfficiencies = [];
var totalGrade = 0;
var expectedNumPrompts = 2;
var startTime; // Declare startTime outside the startTimer function

let textBank





// const chatHistory = document.getElementById('chat-history');
const imagePromptButton = document.getElementById('image-prompt-button');
const pdfPromptButton = document.getElementById('pdf-prompt-button');
const exportButton = document.getElementById('export-button');

sendIcon.addEventListener('click', () => {
    handleSendMessage()
});

async function handleSendMessage() {
  //  && (instructions[currentInstructionIndex].message1!=='Quiz')
  //   if ((event.key === 'Enter' && event.shiftKey) || event.target === sendIcon ) {  
        
        // Enter key
      // event.preventDefault(); // Prevent newline insertion
      // Add your code here to handle the event
      console.log('Shift + Enter pressed. Triggering the event...');        
      const message = inputMessage.value;//event.target.value.trim();
      if (message !== "" && currentInstructionIndex <= instructions.length-2) {
        numPrompts++;
        
        addChatMessage(message, true);
        // event.target.value = "";
        inputMessage.value="";
        textBank += message + " ";

        console.log('TEXT Bank', textBank);
        console.log('TEXT Main', textMain);



            // Calculate the percentage of keywords in textMain found in textBank
            
            const keywordList = textMain.split(", ");
            const keywordCount = keywordList.filter(keyword => textBank.toLowerCase().includes(keyword.toLowerCase())).length;
            const percentage = (keywordCount / keywordList.length) * 100;

            // Update topicScores with the score
            const currentInstruction = instructions[currentInstructionIndex];
            const topic = currentInstruction.message1;
            topicScores[topic] = percentage;

            // Calculate the time usage efficiency
            const efficiency = (numPrompts / expectedNumPrompts) * 100;

            // Append the time usage efficiency to timeEfficiencies
            timeEfficiencies.push(efficiency);

            // Perform further actions with the score and efficiency
            console.log("promptEfficiency:", percentage);
            console.log("timeEfficiency:", efficiency);



            


        if (currentInstructionIndex === instructions.length - 1) {
          skipButton.style.display = 'none';
          try {


            const score = await scorer(instructions, message);
            console.log("Accuracy:", score);
            totalGrade = score;
            // Perform further actions with the score
            // make query to update grades table
            console.log("Total: ", totalGrade);
            console.log("TopicScores: ",topicScores);
            console.log("TimeEfficiencies: ",timeEfficiencies);

            // Calculate the average of topicScores values
            const topicScoreValues = Object.values(topicScores);
            const topicScoreSum = topicScoreValues.reduce((sum, score) => sum + score, 0);
            const topicScoreAverage = topicScoreSum / topicScoreValues.length;

            const keys = Object.keys(topicScores);
            const values = Object.values(topicScores);
            
            const topic = keys[0];
            const mscore = values[0];
            const total = 0.75*totalGrade + 0.125*timeEfficiencies[timeEfficiencies.length - 1] / 10 + 0.125*topicScoreAverage;
            
            const userData = JSON.parse(sessionStorage.user);
            // Access the stdnumber property
            var sid = userData.stdnumber;
            
            // Create the toDispatch object
            const toDispatch = {
            studentId: sid,
            courseId: sessionStorage.getItem('courseToLearn'),
            score: total.toFixed(2), //mscore,
            topic: topic,
            total:total.toFixed(2),
            ac: totalGrade.toFixed(2),
            te: timeEfficiencies[timeEfficiencies.length - 1] / 10,
            pe: topicScoreAverage.toFixed(2),
            action: "saveGrades"
            };
            console.log('GRADES TO SAVE: ', toDispatch);
            // Send the data via jQuery Ajax
            $.ajax({
                url: 'api/api.php',
                method: "POST",
                data: toDispatch,
                success: function(response) {
                console.log("Grades saved successfully:", response);
                alert("Grades saved successfully:"+ response);

                },
                error: function(error) {
                console.error("Failed to save grades:", error);
                }
            });

              
            
                                    

          } catch (error) {
            console.error("Error:", error);
            // Handle the error
          }
        }


        // CHECK Where ANSWERS ARE Supposed to come from and constitute the desired prompt

        if (message.startsWith('file:')) {
          // Extract the message without 'file:' from the beginning
          const message_trimmed = message.slice(5).trim();
      
          // Fetch studCorpus from sessionStorage
          const studCorpus = sessionStorage.getItem('studCorpus');
      
          if (studCorpus) {
            try {
              // Parse studCorpus as JSON
              // const [sfile, stext] = scorpus;
              // console.log('STD FILE:', sfile);
              console.log('TRIMMED:',message_trimmed);
              var extracts = performSearch(message_trimmed, scorpus);
              console.log('BEST MATCH CHUNK STUDENT CORPUS: ', extracts);
              //var textbookContext = 'Please reply only if the prompt is related to '+topic+' , else say "Please lets chat only about" '+topic+'. Please compose a response to the query: '+message+' using the book extracts: '+text+'. Cite the book name and page number in your response. Please format the response as HTML markup for appending to innerHTML';
              //var textbookContext = "If the prompt: "+message+" is in the same subject area as the topic: "+topic+", and if the book extracts "+extracts+" are relevant for responding to the prompt: "+message+", use them to formulate a response to the prompt. Supplement the response with your own knowledge. Cite book name and page in the response. Include at least one HTML hyperlink. Format response using HTML tags for appending to innerHTML";
              var textbookContext = "You may use the document extracts: "+extracts+", only if suitable, to fomulate a response to the prompt: "+message+". Cite the book and page number where necessary. Give at least one link to more information. Format the response using divs and relevant html tags for appending to innerHTML. Advice to stay focussed when the prompt is too unrelated to the topic: "+topic+".";
              const gptResponse = await generateResponse(textbookContext);
              addChatMessage(gptResponse);




            } catch (error) {
              console.error('Error parsing studCorpus:', error);
            }
          } else {
            console.error('studCorpus not found in sessionStorage');
          }
        } else if (message.startsWith('image:')) {
          // Handle other user input or provide a default response
          addChatMessage(`<br><br>Sorry, Image chat is a feature available only in DUX Premium. <br><br> Set your GPT PLUS user API key first. <br><br> Alternatively, Click on the following button for a free image chat  <br>          <a class="ad-link" target="_blank" href="https://www.bing.com/search?q=Bing+AI&showconv=1&FORM=hpcodx">
          <img src="assets/icons/fi-rr-square-star.svg">
          <p>AI Image Chat</p>
        </a> <br><br>` );
          // Provide a default response or take appropriate action
        }else if(sessionStorage.getItem('responseOrigin')==='textbooks'){
          var extracts = performSearch(message, corpus);
          console.log('BEST MATCH CHUNK: ', extracts);
          //var textbookContext = 'Please reply only if the prompt is related to '+topic+' , else say "Please lets chat only about" '+topic+'. Please compose a response to the query: '+message+' using the book extracts: '+text+'. Cite the book name and page number in your response. Please format the response as HTML markup for appending to innerHTML';
          //var textbookContext = "If the prompt: "+message+" is in the same subject area as the topic: "+topic+", and if the book extracts "+extracts+" are relevant for responding to the prompt: "+message+", use them to formulate a response to the prompt. Supplement the response with your own knowledge. Cite book name and page in the response. Include at least one HTML hyperlink. Format response using HTML tags for appending to innerHTML";
          var textbookContext = "You may use the book extracts: "+extracts+", only if suitable, to fomulate a response to the prompt: "+message+". Cite the book and page number where necessary. Give at least one link to more information. Format the response using divs and relevant html tags for appending to innerHTML. Advice to stay focussed when the prompt is too unrelated to the topic: "+topic+".";
          const gptResponse = await generateResponse(textbookContext);
          addChatMessage(gptResponse);
        }else if(sessionStorage.getItem('responseOrigin')==='chatGPT'){
          //var gptContext = "If the prompt: "+message+" is not in the same subject area as the topic: "+topic+", please advise that questions should be related to the topic and stop there, else provide a short answer and include at least one link to the source of the information you provide, make the links clickable. Please format your response using divs and html markup for appending to innerHTML";
          var gptContext = "Fomulate a response to the prompt: "+message+". Provide at least links to sources of your information. Format the response using divs and relevant html tags for appending to innerHTML. Advice to stay focussed when the prompt is too unrelated to the topic: "+topic+".";
          console.log('AWATING RESPONSE FOR: ', message + gptContext);
          const gptResponse = await generateResponse(message + gptContext);
          addChatMessage(gptResponse);
        }else if(sessionStorage.getItem('responseOrigin')==='All'){
          var extracts = performSearch(message, corpus);
          if(extracts !=="") {
          //var allContext = "If the prompt: "+message+" is not in the same subject area as the topic: "+topic+", please advise that questions should be related to the topic and stop there. If the book extracts "+extracts+" are not relevant for answering the question "+message+", discard them, else use them to formulate an answer to the question. Supplement with your own knowledge. Cite book name and page in response. Include at least one HTML hyperlink. Format response using HTML tags for appending to innerHTML";
          var allContext =  "You may use the book extracts: "+extracts+", only if suitable, to fomulate a response to the prompt: "+message+". Cite the book and page number where necessary. Give at least one link to more information. Format the response using divs and relevant html tags for appending to innerHTML. Advice to stay focussed when the prompt is too unrelated to the topic: "+topic+".";
        }else{
          //var allContext = "If the prompt "+message+" is not in the same subject area as the topic: "+topic+", please advise that questions should be related to the topic and stop there, else provide a short answer and include at least one link to the source of the information you provide. Format the links using the html 'a' tag. Please format your response using divs and html markup for appending to innerHTML";
          var allContext = "Fomulate a response to the prompt: "+message+". Provide at least 2 links to sources of your information. Format the response using divs and relevant html tags for appending to innerHTML. Advice to stay focussed when the prompt is too unrelated to the topic: "+topic+".";
        }
        console.log('AWATING RESPONSE FOR: ', message + gptContext);
          const gptResponse = await generateResponse(allContext);
          addChatMessage(gptResponse);
        }


        

      } 
    //else{
    //   const gptResponse = "      GPT is evaluating your prompt ...";
    //   addChatMessage(gptResponse);
    // }
  }


// Add event listeners to the buttons
imagePromptButton.addEventListener('click', () => {
  const input = document.createElement('input');
  input.type = 'file';

  input.addEventListener('change', () => {
    const file = input.files[0];
    
    // Create a div to wrap the image
    const imageWrapper = document.createElement('div');
    imageWrapper.style.paddingTop = '30px';
    imageWrapper.style.paddingBottom = '30px';
  
    // Create the image element
    const image = document.createElement('img');
    image.src = URL.createObjectURL(file);
    image.style.width = '250px'; // Set the width of the image
    image.style.display = 'block';
    image.style.margin = '0 auto';
  
    // Append the image to the div
    imageWrapper.appendChild(image);
  
    // Append the wrapped image to the chat history
    chatHistory.appendChild(imageWrapper);
  });

  input.click();
});

// pdfPromptButton.addEventListener('click', () => {
//   const input = document.createElement('input');
//   input.type = 'file';

//   input.addEventListener('change', () => {
//     const file = input.files[0];
//     const embed = document.createElement('embed');
//     embed.src = URL.createObjectURL(file);
//     embed.style.width = '100%'; // Set the width of the embedded document
//     embed.style.zoom = '150%';
//     chatHistory.appendChild(embed);
//   });

//   input.click();
// });

async function fetchAndExtractTextFromPDF(path) {
  console.log('PDF FILE PATH: ', path);

  // // Fetch and extract text from the specified PDF file
  // try {
  //   const pdfData = await fetchPdfData('temp/' + pdfFilePath);
  //   const pdf = pdfjsLib.getDocument(pdfData).promise;
  //   const pdfText = await extractTextFromPDF(pdf);
  //   console.log('PDF Text:', pdfText);
  //   return pdfText;
  // } catch (error) {
  //   console.error('Error fetching or extracting PDF:', error);
  //   throw error; // Propagate the error to the caller if needed
  // }

  if (path) {
    console.log('REQUIRED TO USE DOCUMENT:', path);
    sessionStorage.setItem('responseOrigin','studentDocument');
    const pdfFilePaths = ['temp/'+path];

    let pdfTexts = {};
    // Fetch and extract text from each PDF file sequentially
    let promises = [];
    for (const pdfFilePath of pdfFilePaths) {
        const promise = fetchPdfData(pdfFilePath)
            .then(pdfData => pdfjsLib.getDocument(pdfData).promise)
            .then(pdf => extractTextFromPDF(pdf))
            .then(pdfText => {
                pdfTexts[pdfFilePath] = pdfText;
            });
        promises.push(promise);
    }

    Promise.all(promises)
        .then(() => {
            console.log('STUDENT PDF Texts:', pdfTexts);
            sessionStorage.setItem('scorpus',pdfTexts);
            scorpus = pdfTexts;
            console.log('STUDENT NAME SPACE CORPUS: ', scorpus);
            sessionStorage.setItem('studCorpus',scorpus);
        })
        .catch(error => {
            console.error('Error fetching PDFs:', error);
        });
}

}

// You can call the function like this for a single PDF path:
// Replace [0] with the index of the desired PDF path



// pdfPromptButton.addEventListener('click', () => {
//   const input = document.createElement('input');
//   input.type = 'file';

//   input.addEventListener('change', () => {
//     const file = input.files[0];
//     console.log('FILE PATH:', file);

//     // Call the get_corpus function with the selected file
//     fetchAndExtractTextFromPDF(file)
//   .then(pdfText => {
//       // Handle the extracted PDF text here
//       sessionStorage.setItem('stud-corpus', pdfText);
//       corpus = pdfText;
//       console.log('NAME SPACE CORPUS: ', corpus);
//   })

//   .catch(error => {
//       // Handle errors here if necessary
//   });

//     // Rest of your code to display the PDF
//     const embed = document.createElement('embed');
//     embed.src = URL.createObjectURL(file);
//     embed.type = 'application/pdf';
//     embed.style.width = '100%';
//     embed.style.height = '300px';
//     chatHistory.appendChild(embed);
//   });

//   input.click();
// });


pdfPromptButton.addEventListener('click', () => {
  const sdata = JSON.parse(sessionStorage.getItem('user'));
  const stdNumber = sdata.stdNumber;
  const input = document.createElement('input');
  input.type = 'file';

  input.addEventListener('change', () => {
    const file = input.files[0];
    console.log('FILE PATH:', file);

    // Create a FormData object to send the file
    const formData = new FormData();
    formData.append('stdNumber', stdNumber); // Assuming stdNumber is defined
    formData.append('file', file);
    formData.append('action','uploadTempFile')

    // Send the file to the server using AJAX
    $.ajax({
      url: 'api/api.php',
      type: 'POST',
      data: formData,
      processData: false, // Prevent jQuery from processing the data
      contentType: false, // Prevent jQuery from setting the content type
      dataTye: 'json', // Expected response type (optional)
      success: function(response) {
        // Handle the server's response here, if necessary
        console.log('Server Response:', response);
        const res = JSON.parse(response);
        fetchAndExtractTextFromPDF(res.fileName);


      },
      error: function(error) {
        // Handle errors here if necessary
        console.error('Error:', error);
      },
    });

    // Rest of your code to display the PDF
    const embed = document.createElement('embed');
    embed.src = URL.createObjectURL(file);
    embed.type = 'application/pdf';
    embed.style.width = '100%';
    embed.style.height = '300px';
    
    // Create a div to wrap the embed
    const embedWrapper = document.createElement('div');
    embedWrapper.style.paddingTop = '30px';
    embedWrapper.style.paddingBottom = '30px';
    
    // Append the embed to the div
    embedWrapper.appendChild(embed);
    
    // Append the wrapped embed to the chat history
    chatHistory.appendChild(embedWrapper);
  });

  input.click();
});


exportButton.addEventListener('click', () => {
  // Create a new jsPDF instance
  const doc = new jsPDF();

  // Get the HTML content of the chat history
  const content = chatHistory.innerHTML;

  // Add the HTML content to the PDF document
  doc.fromHTML(content);

  // Download the PDF document
  doc.save('chat-history.pdf');
});







const instructionsb = [
  {
    message1: "Introduction to Robotics",
    message2: "Study 1: Robot Mechanics",
    message3: "Learn the basics of robot mechanics",
    image: "coursefiles/robotics3.png",
    duration: 20
  },
  {
    message1: "Robot Programming",
    message2: "Study 2: Robot Programming",
    message3: "Explore different programming techniques for robots",
    image: "coursefiles/neugpt.mp4",
    duration: 20
  },
  {
    message1: "Quiz: Robotics",
    message2: "Test your knowledge on robotics",
    message3: "What is the role of sensors in robotics?",
    image: "coursefiles/robotics2.png",
    duration: 20
  }
];



document.getElementById('export-button').addEventListener('click', function() {
  // Create a new window to display the generated HTML
  var printWindow = window.open('', '_blank');
  printWindow.document.write(`
    <!DOCTYPE html>
    <html>
      <head>
        <title>Chat History</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="styles.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
        <style>
          .fa-user {width:50px}
        </style>
      </head>
      <body>
        <div class="container" style="display:flex; flex-direction:row">
          <h1>Chat History</h1>
          <button id="printBtn" class="btn btn-primary">Print to PDF</button>
        </div>
        <div class="content-container">
          <!-- Chat history content here -->
          ${chatHistory.innerHTML}
        </div>

        <script>
          document.getElementById('printBtn').addEventListener('click', function() {
            const doc = new jspdf.jsPDF();

            // Set the page title
            doc.setProperties({
              title: 'Chat History'
            });

            // Get the HTML elements to export
            const container = document.querySelector('.content-container');
            const chatHistory = container.innerHTML;

            // Set the font size and text color
            doc.setFontSize(12);
            doc.setTextColor(0, 0, 0);

            // Convert the HTML to PDF
            doc.html(chatHistory, {
              callback: function(pdf) {
                // Save the PDF file
                pdf.save('chat_history.pdf');
              }
            });
          });
        </script>
      </body>
    </html>
  `);

  // Wait for the content to load before printing
  printWindow.document.addEventListener('DOMContentLoaded', function() {
    printWindow.document.getElementById('printBtn').click();
    printWindow.onafterprint = function() {
      printWindow.close();
    };
  });
});


// ******************* START SPEECH RECOGNITION **********************
const micButton = document.getElementById('mic-button');
const micStatus = document.getElementById('mic-status');
// const inputBox = document.getElementById('input-box');
const recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition)();

recognition.interimResults = true;
let isListening = false;
let micCountdown = 5;
let speechEndedTimeout;

function startListening() {
  isListening = true;
  micCountdown = 5;
  micStatus.innerText = 'Listening... ' + micCountdown;
  micCountdownTimer();
  recognition.start();
}

function stopListening() {
  isListening = false;
  recognition.stop();
  micStatus.innerText = 'Start Listening';
}

function micCountdownTimer() {
  const micTimerInterval = setInterval(() => {
      micCountdown -= 1;
      micStatus.innerText = 'Listening... ' + micCountdown;
      if (micCountdown === 0) {
          clearInterval(micTimerInterval);
          stopListening();
      }
  }, 1000);
}

micButton.addEventListener('mousedown', () => {
  startListening();
});

micButton.addEventListener('mouseup', () => {
  stopListening();
});

// inputBox.addEventListener('keyup', (event) => {
//     if (event.key === 'Enter') {
//         const message = sendMessageBox.value.trim();
//         if (message !== '') {
//             addToChat('You', message);
//             inputBox.value = '';
//         }
//     }
// });

recognition.addEventListener('result', async (event) => {
const transcript = Array.from(event.results)
    .map((result) => result[0])
    .map((result) => result.transcript)
    .join('');

clearTimeout(speechEndedTimeout); // Clear any previous timeout
speechEndedTimeout = setTimeout(async () => {
    // addChatMessage(transcript, true);
    try {
      //*** START BLOCK */
      console.log('Using speech...');        
      const message = transcript;
      if (message !== "" && currentInstructionIndex <= instructions.length-2) {
        numPrompts++;
        
        addChatMessage(message, true);
        // event.target.value = "";
        textBank += message + " ";

        console.log('TEXT Bank', textBank);
        console.log('TEXT Main', textMain);



            // Calculate the percentage of keywords in textMain found in textBank
            
            const keywordList = textMain.split(", ");
            const keywordCount = keywordList.filter(keyword => textBank.toLowerCase().includes(keyword.toLowerCase())).length;
            const percentage = (keywordCount / keywordList.length) * 100;

            // Update topicScores with the score
            const currentInstruction = instructions[currentInstructionIndex];
            const topic = currentInstruction.message1;
            topicScores[topic] = percentage;

            // Calculate the time usage efficiency
            const efficiency = (numPrompts / expectedNumPrompts) * 100;

            // Append the time usage efficiency to timeEfficiencies
            timeEfficiencies.push(efficiency);

            // Perform further actions with the score and efficiency
            console.log("promptEfficiency:", percentage);
            console.log("timeEfficiency:", efficiency);



            


        if (currentInstructionIndex === instructions.length - 1) {
          skipButton.style.display = 'none';
          try {


            const score = await scorer(instructions, message);
            console.log("Accuracy:", score);
            totalGrade = score;
            // Perform further actions with the score
            // make query to update grades table
            console.log("Total: ", totalGrade);
            console.log("TopicScores: ",topicScores);
            console.log("TimeEfficiencies: ",timeEfficiencies);

            // Calculate the average of topicScores values
            const topicScoreValues = Object.values(topicScores);
            const topicScoreSum = topicScoreValues.reduce((sum, score) => sum + score, 0);
            const topicScoreAverage = topicScoreSum / topicScoreValues.length;

            const keys = Object.keys(topicScores);
            const values = Object.values(topicScores);
            
            const topic = keys[0];
            const mscore = values[0];
            const total = 0.75*totalGrade + 0.125*timeEfficiencies[timeEfficiencies.length - 1] / 10 + 0.125*topicScoreAverage;
            
            const userData = JSON.parse(sessionStorage.user);
            // Access the stdnumber property
            var sid = userData.stdnumber;
            
            // Create the toDispatch object
            const toDispatch = {
            studentId: sid,
            courseId: sessionStorage.getItem('courseToLearn'),
            score: total.toFixed(2), //mscore,
            topic: topic,
            total:total.toFixed(2),
            ac: totalGrade.toFixed(2),
            te: timeEfficiencies[timeEfficiencies.length - 1] / 10,
            pe: topicScoreAverage.toFixed(2),
            action: "saveGrades"
            };
            console.log('GRADES TO SAVE: ', toDispatch);
            // Send the data via jQuery Ajax
            $.ajax({
                url: 'api/api.php',
                method: "POST",
                data: toDispatch,
                success: function(response) {
                console.log("Grades saved successfully:", response);
                alert("Grades saved successfully:"+ response);

                },
                error: function(error) {
                console.error("Failed to save grades:", error);
                }
            });

              
            
                                    

          } catch (error) {
            console.error("Error:", error);
            // Handle the error
          }
        }


        // CHECK Where ANSWERS ARE Supposed to come from and constitute the desired prompt
        if(sessionStorage.getItem('responseOrigin')==='textbooks'){
          var extracts = performSearch(message, corpus);
          console.log('BEST MATCH CHUNK: ', extracts);
          //var textbookContext = 'Please reply only if the prompt is related to '+topic+' , else say "Please lets chat only about" '+topic+'. Please compose a response to the query: '+message+' using the book extracts: '+text+'. Cite the book name and page number in your response. Please format the response as HTML markup for appending to innerHTML';
          //var textbookContext = "If the prompt: "+message+" is in the same subject area as the topic: "+topic+", and if the book extracts "+extracts+" are relevant for responding to the prompt: "+message+", use them to formulate a response to the prompt. Supplement the response with your own knowledge. Cite book name and page in the response. Include at least one HTML hyperlink. Format response using HTML tags for appending to innerHTML";
          var textbookContext = "You may use the book extracts: "+extracts+", only if suitable, to fomulate a response to the prompt: "+message+". Cite the book and page number where necessary. Give at least one link to more information. Format the response using divs and relevant html tags for appending to innerHTML. Advice to stay focussed when the prompt is too unrelated to the topic: "+topic+".";
          const gptResponse = await generateResponse(textbookContext);
          addChatMessage(gptResponse);
        }else if(sessionStorage.getItem('responseOrigin')==='chatGPT'){
          //var gptContext = "If the prompt: "+message+" is not in the same subject area as the topic: "+topic+", please advise that questions should be related to the topic and stop there, else provide a short answer and include at least one link to the source of the information you provide, make the links clickable. Please format your response using divs and html markup for appending to innerHTML";
          var gptContext = "Fomulate a response to the prompt: "+message+". Provide at least links to sources of your information. Format the response using divs and relevant html tags for appending to innerHTML. Advice to stay focussed when the prompt is too unrelated to the topic: "+topic+".";
          console.log('AWATING RESPONSE FOR: ', message + gptContext);
          const gptResponse = await generateResponse(message + gptContext);
          addChatMessage(gptResponse);
        }else if(sessionStorage.getItem('responseOrigin')==='All'){
          var extracts = performSearch(message, corpus);
          if(extracts !=="") {
          //var allContext = "If the prompt: "+message+" is not in the same subject area as the topic: "+topic+", please advise that questions should be related to the topic and stop there. If the book extracts "+extracts+" are not relevant for answering the question "+message+", discard them, else use them to formulate an answer to the question. Supplement with your own knowledge. Cite book name and page in response. Include at least one HTML hyperlink. Format response using HTML tags for appending to innerHTML";
          var allContext =  "You may use the book extracts: "+extracts+", only if suitable, to fomulate a response to the prompt: "+message+". Cite the book and page number where necessary. Give at least one link to more information. Format the response using divs and relevant html tags for appending to innerHTML. Advice to stay focussed when the prompt is too unrelated to the topic: "+topic+".";
        }else{
          //var allContext = "If the prompt "+message+" is not in the same subject area as the topic: "+topic+", please advise that questions should be related to the topic and stop there, else provide a short answer and include at least one link to the source of the information you provide. Format the links using the html 'a' tag. Please format your response using divs and html markup for appending to innerHTML";
          var allContext = "Fomulate a response to the prompt: "+message+". Provide at least 2 links to sources of your information. Format the response using divs and relevant html tags for appending to innerHTML. Advice to stay focussed when the prompt is too unrelated to the topic: "+topic+".";
        }
        console.log('AWATING RESPONSE FOR: ', message + gptContext);
          const gptResponse = await generateResponse(allContext);
          addChatMessage(gptResponse);
        }


        

      } 
      //*** END BLOCK */
    } catch (error) {
        console.error('Error generating response:', error);
    }
}, 1000); // Adjust this delay as needed (1 second in this example).
});

function addToChat(sender, message) {
  const chatEntry = document.createElement('div');
  chatEntry.innerHTML = `<strong>${sender}:</strong> ${message}`;
  chatHistory.appendChild(chatEntry);
}

recognition.addEventListener('end', () => {
  if (isListening) {
      startListening();
  }
});
// *************** END SPEECH RECOGNITION ***************  



// FETCH INSTRUCTIONS
function fetchInstructions(mtopicId, mcourseId) {
$.ajax({
  url: 'api/api.php',
  method: 'POST',
  data: { topicId: mtopicId, courseId: mcourseId, action: 'fetchInstructions' },
  //dataType: 'json',
  success: function(response) {
    instructions = response;
    console.log('Fetched instructions:', instructions);
    startButton.style.display = "grid";
    skipButton.style.display = "grid";
    const submitButton = document.getElementById("my-submit-button");
    if(submitButton){
      submitButton.remove();
    }
    //let pdfTexts = {};
    fetchBaseSettings(mcourseId);

  },
  error: function(jqXHR, textStatus, errorThrown) {
    console.error('Failed to fetch instructions:', errorThrown);
  }
});
}

//instructions =  JSON.parse(sessionStorage.getItem('Instructions'));
//fetchInstructions(sessionStorage.getItem('topicToLearn')); 

const setButton = document.querySelector(".set-button");    

setButton.addEventListener("click", function() {
numPrompts = 0; 
// Set the instructions variable to the retrieved value
const submitButton = document.getElementById('my-submit-button');
if(submitButton){submitButton.style.display="none";}
fetchInstructions(sessionStorage.getItem('topicToLearn'), sessionStorage.getItem('courseToLearn')); 
clearInterval(timerInterval);
sessionStorage.setItem('currentInstructionIndex',0);
startButton.disabled = false;
if(submitButton){
submitButton.style.display="none";
}



// Use the instructions variable as needed
console.log('INSTRUCTIONS FETCH ON SET: ',instructions);
}); 



    // Mock GPT responses with random ipsum text
    const responses = {
      "Hi": "Hi. How may I help you?",
      "What is robotics?": "Robotics is the branch of technology that deals with the design, construction, operation, and application of robots. It involves various fields such as mechanical engineering, electrical engineering, computer science, and artificial intelligence. {\"mcqs\": 20, \"free_response\": 5}",
      "What are robot mechanics?": "Robot mechanics refers to the design and study of the physical structure, components, and mechanisms used in robots. It involves concepts such as kinematics, dynamics, actuators, sensors, and motion control. {\"mcqs\": 20, \"free_response\": 5}",
      "What is robot programming?": "Robot programming involves writing instructions or code to control the behavior and actions of robots. It can include programming languages, robot-specific software, and algorithms for tasks such as navigation, manipulation, and decision-making. {\"mcqs\": 20, \"free_response\": 5}",
      "How do robots perceive their environment?": "Robots perceive their environment through various sensors such as cameras, LiDAR, ultrasonic sensors, proximity sensors, and tactile sensors. These sensors provide feedback on the robot's surroundings, enabling it to make decisions and interact with the environment. {\"mcqs\": 20, \"free_response\": 5}",
      "What is the role of artificial intelligence in robotics?": "Artificial intelligence plays a significant role in robotics by enabling robots to perceive, learn, reason, and make decisions. AI techniques such as machine learning, computer vision, and natural language processing enhance the capabilities of robots and enable them to adapt to changing situations. {\"mcqs\": 20, \"free_response\": 5}",
      "What are some applications of robotics?": "Robotics has applications in various fields, including industrial automation, healthcare, agriculture, space exploration, entertainment, and education. Robots are used for tasks such as manufacturing, surgery, exploration, companionship, and education. {\"mcqs\": 20, \"free_response\": 5}",
      "How can I get started with robotics?": "To get started with robotics, you can begin by learning the basics of electronics, programming, and mechanical systems. Familiarize yourself with popular robotics platforms and start experimenting with simple projects. Join robotics clubs, attend workshops, and explore online resources to deepen your knowledge and skills. {\"mcqs\": 20, \"free_response\": 5}",
      "What are some challenges in robotics?": "Some challenges in robotics include designing robots that can operate in unstructured environments, developing robust and efficient control algorithms, achieving human-like dexterity and perception, ensuring safety and ethical considerations, and integrating robots into existing systems and workflows. {\"mcqs\": 20, \"free_response\": 5}",
      "What are the types of robots?": "There are various types of robots, including industrial robots used in manufacturing, service robots for tasks like cleaning and caregiving, humanoid robots designed to resemble humans, autonomous drones used for aerial surveillance or delivery, and educational robots for learning purposes. {\"mcqs\": 20, \"free_response\": 5}",
      "What is the difference between a robot and an android?": "A robot is a general term for a machine that can carry out tasks autonomously or under remote control. An android specifically refers to a robot designed to resemble a human in appearance and behavior. {\"mcqs\": 20, \"free_response\": 5}",
      "What is the role of sensors in robotics?": " 60 Sensors play a crucial role in robotics by providing robots with information about their surroundings. Sensors such as proximity sensors, accelerometers, gyroscopes, and vision sensors enable robots to perceive objects, navigate obstacles, and interact with the environment. {\"mcqs\": 20, \"free_response\": 5}",
      "What is inverse kinematics in robot motion control?": "Inverse kinematics is a technique used in robot motion control to determine the joint configurations required to achieve a desired end-effector position or trajectory. It involves solving mathematical equations to find the joint angles or lengths that produce the desired motion. {\"mcqs\": 20, \"free_response\": 5}",
      "What programming languages are commonly used in robotics?": "Several programming languages are commonly used in robotics, including C++, Python, Java, and MATLAB. These languages offer a wide range of libraries, frameworks, and tools for robot programming and control. {\"mcqs\": 20, \"free_response\": 5}",
      "What are some ethical considerations in robotics?": "Ethical considerations in robotics include ensuring the safety and well-being of humans interacting with robots, addressing privacy concerns related to data collection by robots, defining ethical guidelines for autonomous robots, and considering the societal impact of widespread robot deployment. {\"mcqs\": 20, \"free_response\": 5}",
      "What is the future of robotics?": "The future of robotics holds great potential. Advancements in artificial intelligence, machine learning, and robotics are expected to lead to more capable and versatile robots. We may see increased integration of robots in various industries, advancements in human-robot collaboration, and the emergence of new applications we can't yet imagine. {\"mcqs\": 20, \"free_response\": 5}",
      "How do robots learn and adapt?": "Robots can learn and adapt through techniques such as machine learning and reinforcement learning. By training on large datasets or through interaction with the environment, robots can improve their performance, acquire new skills, and adapt to different tasks and scenarios. {\"mcqs\": 20, \"free_response\": 5}",
      "What are the safety considerations when working with robots?": "Safety considerations when working with robots include implementing proper guarding and protective measures to prevent accidents, ensuring clear and comprehensive safety protocols, and designing robots with built-in safety features such as collision detection and emergency stop mechanisms. {\"mcqs\": 20, \"free_response\": 5}",
      "How can robots be used in healthcare?": "Robots have various applications in healthcare, including surgical robots for precise and minimally invasive procedures, robotic exoskeletons for rehabilitation, telepresence robots for remote patient monitoring and consultation, and assistive robots for tasks like lifting and patient care. {\"mcqs\": 20, \"free_response\": 5}",
    };       
   


currentInstructionIndex = sessionStorage.getItem('currentInstructionIndex');
let currentInstruction;

// Function to generate a response based on the prompt
function generateResponse_MOCK(prompt) {
    let maxMatchCount = 0;
    let bestMatchResponse = "I did not understand your request. Please try again.";
  
    // Iterate over each key in the responses object
    for (const key in responses) {
      const keywords = key.split(" ");
      let matchCount = 0;
  
      // Count the number of keywords that match the prompt
      for (const keyword of keywords) {
        if (prompt.toLowerCase().includes(keyword.toLowerCase())) {
          matchCount++;
        }
      }
  
      // Update the best match if the current key has more matches
      if (matchCount > maxMatchCount) {
        maxMatchCount = matchCount;
        bestMatchResponse = responses[key];
      }
    }
  
    return bestMatchResponse;
  }
  

// GENERATE RESPONSE RAPID API
async function generateResponse_RAI(prompt) {
const url = 'https://chatgpt-api8.p.rapidapi.com/';
const options = {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json',
    //'X-RapidAPI-Key': 'ea727bfbf4msh1dc00b8277e3c7dp196e01jsn3aa17795fe37',
    'X-RapidAPI-Key':'2d07654b7dmshb310dce780e7846p185c69jsnff765d8d92e4',
    //'X-RapidAPI-Key':'c914c23eedmshebab214eb8d9e87p131847jsn17fe2e5a5627',
    //'X-RapidAPI-Key': '1b7977a558msh55d41b0de7de7b5p120732jsne07e93e458ec',
    //'X-RapidAPI-Key': '394f136122msh3869dace1ae1718p1d7b89jsn07a08fca74eb',
    //'X-RapidAPI-Key': '13d6b48bc0msh1e618f5a046f273p1c3c6cjsnefa28abb9a85',
    'X-RapidAPI-Host': 'chatgpt-api8.p.rapidapi.com'
  },
  body: JSON.stringify([
    {
      content: prompt,
      role: 'user'
    }
  ])
};

try {
  const response = await fetch(url, options);
  const result = await response.json();
  console.log(result);
  return result.text || result.message;
} catch (error) {
  console.error(error);
  return "Failed";
}
}

// GPT4ALL API
async function generateResponse_Ola(prompt) {
const apiUrl = `https://1181-34-143-210-26.ngrok-free.app/generate/?prompt=${encodeURIComponent(prompt)}`;

try {
  const response = await fetch(apiUrl, {
    method: 'POST'
  });

  const data = await response.json();

  if (data && data.response) {
    return data.response;
  } else {
    throw new Error('Invalid response received from the API');
  }
} catch (error) {
  console.error('Error occurred during API request:', error);
  throw error;
}
}

// BARD API
function generateResponse_BARD(prompt) {
const apiUrl = `http://127.0.0.1:5000/?prompt=${encodeURIComponent(prompt)}`;
console.log('API URL', apiUrl);
return $.post(apiUrl)
  .then((data) => {
    if (data && data.output) {
      return data.output;
    } else {
      throw new Error('Invalid response received from the API');
    }
  })
  .catch((error) => {
    console.error('Error occurred during API request:', error);
    throw error;
  });
}

let apiKey;
let mdata;

function getGeneralApiKey() {
$.ajax({
  url: 'api/api.php',
  method: 'POST',
  data: {
    action: 'getGeneralApiKey',
  },
  success: function (response) {
    // Redirect to index.html after successful logout
    apiKey = JSON.parse(response).apiKey;
    mdata = response;

  },
  error: function (xhr, status, error) {
    // Handle error if necessary
    console.error(error);
    // Redirect to index.html regardless of the API call result
  }
});
}

// Example usage:
getGeneralApiKey();



//CHATGPT
async function generateResponse(prompt) {
//neu 


const endpoint = 'https://api.openai.com/v1/chat/completions';

try {
const response = await fetch(endpoint, {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json',
    'Authorization': `Bearer ${apiKey}`
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
console.log('HERE IS DATA FROM GPT: ',data.choices[0].message.content);

// You can process the response here or display it in the HTML, etc.
// For this example, we're just logging the output to the console.
return data.choices[0].message.content;
} catch (error) {
console.error('Error fetching response:', error);
return null;
}
}


// EXTRACT JSON OBJECT FROM GPT RESPONSE
function extractJsonObject(text) {
// Find the JSON object within the text
const jsonRegex = /{[^{}]*}/g; // Regular expression to match JSON object

const matches = text.match(jsonRegex); // Find all matches of JSON objects in the text

if (matches && matches.length > 0) {
// Extract the first JSON object
const jsonString = matches[0];

try {
  // Parse the JSON string into an object
  const jsonObject = JSON.parse(jsonString);

  // Store the parsed JSON object in sessionStorage as "scores"
  sessionStorage.setItem("scores", JSON.stringify(jsonObject));
  console.log("EXTRACTED RESULTS: ",jsonObject);

  // Return the extracted JSON object
  return jsonObject;
} catch (error) {
  console.error("Error parsing JSON:", error);
}
}

// If no JSON object is found, return null or handle the case accordingly
return null;
}

// Function to add a chat message to the history
// function addChatMessage(message, isUser = false) {
//   const chatMessage = document.createElement("div");
//   chatMessage.className = isUser ? "user-message" : "gpt-message";

//   const iconClass = isUser ? "fas fa-user" : "fas fa-robot";
//   const iconElement = document.createElement("i");
//   iconElement.className = iconClass;

//   chatMessage.appendChild(iconElement);

//   const messageText = document.createElement("p");
//   messageText.textContent = message;
//   chatMessage.appendChild(messageText);

//   chatHistory.appendChild(chatMessage);
//   chatHistory.scrollTop = chatHistory.scrollHeight;
// }

function addChatMessage(message, isUser = false) {
  const chatMessage = document.createElement("div");
  chatMessage.className = isUser ? "user-message" : "gpt-message";

  const iconElement = document.createElement("i");
  iconElement.className = isUser ? "fas fa-user" : ""; // Use "fas fa-user" for user, empty string for GPT

  if (!isUser) {
    iconElement.remove(); // Remove the icon element for GPT
    const faviconElement = document.createElement("img");
    faviconElement.src = "assets/img/favicon.ico"; // Set the source of the favicon image
    faviconElement.className = "favicon-icon";
    chatMessage.appendChild(faviconElement);
  } else {
    chatMessage.appendChild(iconElement);
  }

  const messageText = document.createElement("p");
  messageText.innerHTML = message; // Set innerHTML instead of textContent
  chatMessage.appendChild(messageText);

  if (!isUser) {
// Create a transparent button
const speakButton = document.createElement("button");
speakButton.classList.add("btn", "btn-transparent");

// Create a Font Awesome icon element for the image icon
const imageIcon = document.createElement("i");
imageIcon.classList.add("fas", "fa-volume-up");
imageIcon.style.color = "blue"; 

// Add the image icon to the button
speakButton.appendChild(imageIcon);
speakButton.insertAdjacentHTML("beforeend", " Speak");


let isSpeaking = false; // Flag to track speech status
let speechUtterance = null; // Reference to the speech utterance
let pausedAt = 0; // Track the position where speech was paused

const toggleIcon = () => {
if (isSpeaking) {
imageIcon.classList.remove("fa-pause");
imageIcon.classList.add("fa-play");
} else {
imageIcon.classList.remove("fa-play");
imageIcon.classList.add("fa-pause");
}
};

const speak = () => {
if (!isSpeaking) {
if (speechUtterance) {
  speechUtterance.text = message.slice(pausedAt);
  speechSynthesis.speak(speechUtterance);
} else {
  speechUtterance = new SpeechSynthesisUtterance(message);
  speechUtterance.addEventListener("end", () => {
    pausedAt = 0;
    isSpeaking = false;
    toggleIcon();
  });
  speechSynthesis.speak(speechUtterance);
}
isSpeaking = true;
} else {
speechSynthesis.cancel();
pausedAt = speechUtterance.text.length - speechUtterance.text.slice(pausedAt).length;
isSpeaking = false;
}

toggleIcon();
};

speakButton.addEventListener("click", speak);
chatMessage.appendChild(speakButton);
chatMessage.appendChild(messageText);
  }

  chatHistory.appendChild(chatMessage);
  chatHistory.scrollTop = chatHistory.scrollHeight;
}


function speak_b(text) {
  // Use text-to-speech API or library to produce audio from text
  // This part depends on the specific text-to-speech implementation you choose
  // Here's an example using the SpeechSynthesis API
  const speech = new SpeechSynthesisUtterance(text);
  speechSynthesis.speak(speech);
}

function isVideoLink(url) {
  // Add your specific conditions for video file extensions
  const videoExtensions = ['mp4', 'avi', 'mov', 'wmv'];

  // Check if the URL matches Google Drive shared link pattern
  const isGoogleDriveLink = /https:\/\/drive\.google\.com\/file\/d\/([a-zA-Z0-9_-]+)\/view/.test(url);

  if (isGoogleDriveLink) {
      // If it's a Google Drive link, return true as it's likely a video link
      return true;
  }

  // Extract the file name from the URL
  const parts = url.split('/');
  const fileName = parts[parts.length - 1];



  // Extract the file extension from the file name
  const extensionParts = fileName.split('.');
  const extension = extensionParts.length > 1 ? extensionParts.pop() : null;

  // Check if the extension (if present) is in the videoExtensions array
  return (extension && videoExtensions.includes(extension.toLowerCase())) || fileName==='preview';
}

// useful func to populate instructions div
function populateInstructionMessages(instruction) {
const messageKeys = Object.keys(instruction);
const innerHTML = '';
for (const messageKey of messageKeys) {
if (messageKey.startsWith('message')) {
  const message = instruction[messageKey];
  innerHTML += `<p>${message}</p>`;
}
}
instructionMessages.innerHTML = innerHTML;
}


// Function to display the current instruction
function displayCurrentInstruction() {
currentInstruction = instructions[currentInstructionIndex];
// instructionMessages.innerHTML = `
//   <p>${currentInstruction.message1}</p>
//   <p>${currentInstruction.message2}</p>
//   <p>${currentInstruction.message3}</p>
// `;

instructionMessages.innerHTML = '';
const messageKeys = Object.keys(currentInstruction);

for (const messageKey of messageKeys) {
  if (messageKey.startsWith('message')) {
    const message = currentInstruction[messageKey];
    instructionMessages.innerHTML += `<p>${message}</p>`;
  }
}

// const currentInstruction = instructions[currentInstructionIndex];
// populateInstructionMessages(currentInstruction);

instructionImage.src = currentInstruction.image;
const instructionDuration = currentInstruction.duration;
startTimer(instructionDuration);

// Clear the media container
chatHistory.innerHTML = "";

// Check if the media URL is a video link
if (isVideoLink(currentInstruction.image)) {
  // Create a button element for playing the video
  const playButton = document.createElement("button");
  playButton.id = "playButton";
  playButton.classList.add("btn", "btn-primary");
  
  // Create a Font Awesome icon element for the play icon
  const playIcon = document.createElement("i");
  playIcon.classList.add("fas", "fa-play");
  
  // Add the play icon to the button
  playButton.appendChild(playIcon);
  playButton.insertAdjacentHTML("beforeend", " Play Video");
  
  playButton.addEventListener("click", function() {
    // Clear the media container
    //chatHistory.innerHTML = "";
  
    // Create an iframe element for embedding the video player
    const iframe = document.createElement("iframe");
    iframe.src = currentInstruction.image;
    
    // Set iframe width and height to 100% of parent
    iframe.width = "100%";  
    iframe.height = "100%";
    
    // Important to set styles
    iframe.style.border = "none";
  
    // Append the iframe to the media container
    chatHistory.appendChild(iframe);
  });
  
  // Append the button to the desired location
  const buttonContainer = document.getElementById("buttonContainer");
  buttonContainer.innerHTML = "";
  buttonContainer.appendChild(playButton);
} else {
  // Create a button element for displaying the photo
  const displayButton = document.createElement("button");
  displayButton.id = "displayButton";
  displayButton.classList.add("btn", "btn-primary");
  
  // Create a Font Awesome icon element for the image icon
  const imageIcon = document.createElement("i");
  imageIcon.classList.add("fas", "fa-image");
  
  // Add the image icon to the button
  displayButton.appendChild(imageIcon);
  displayButton.insertAdjacentHTML("beforeend", " Display Photo");
  
  displayButton.addEventListener("click", function() {
    // Create an image element
    const image = document.createElement("img");
    image.src = currentInstruction.image;
    image.style.maxWidth = "100%"; // Set the maximum width of the image to 100%
  
    // Clear the media container and append the image element
    //chatHistory.innerHTML = "";
    chatHistory.appendChild(image);
  });
  
  // Append the button to the desired location
  const buttonContainer = document.getElementById("buttonContainer");
  buttonContainer.innerHTML = "";
  buttonContainer.appendChild(displayButton);
}
}




// Function to start the instruction countdown timer
function startTimer(duration) {
  
  let timer = duration;
  let hours, minutes, seconds;
  // Track the number of prompts entered by the user
  textMainSetter(currentInstructionIndex);
  textBank = "";

  timerInterval = setInterval(function() {
    hours = Math.floor((timer / (60 * 60)) % 24);
    minutes = Math.floor((timer / 60) % 60);
    seconds = Math.floor(timer % 60);

    hours = hours.toString().padStart(2, "0");
    minutes = minutes.toString().padStart(2, "0");
    seconds = seconds.toString().padStart(2, "0");

    timerHours.textContent = hours;
    timerMinutes.textContent = minutes;
    timerSeconds.textContent = seconds;

    if (--timer < 0) {
        clearInterval(timerInterval);
        sendMessageBox.querySelector("#messageTextarea").disabled = true;



        if (currentInstructionIndex === instructions.length - 1) {
          
          startButton.style.display = "grid";
          startButton.disabled = true;
          skipButton.style.display="none";
          skipButton.disabled = false;
          createSubmitButton();
          
          async function callerFunction() {
            // Call the asynchronous function
            await questioner(instructions);
            console.log('Request made for questions');
            // Code here will run after the asynchronous function has completed
          }
          
          callerFunction();             
          //exitButton.style.display = "inline-block";
          // Redirect to grades page or perform necessary actions
        } else {
          startButton.textContent = "Next";
          startButton.disabled = false;

        }
      }

        
     

      


    }, 1000);



// Event listener for sending messages
// Attach the event listeners
sendMessageBox.addEventListener('keydown', function(event) {
if (event.key === 'Enter' && event.shiftKey) {
  event.preventDefault(); // Prevent newline insertion
  handleSendMessage();
}
});

// sendIcon.addEventListener('click', function(event) {
// //   event.preventDefault();
//     console.log("clicked")
//   handleSendMessage(event);
// });
  
}

// Event listener for the next button
skipButton.addEventListener("click", function() {
  
  if (currentInstructionIndex < instructions.length - 1) {
    clearInterval(timerInterval);
    currentInstructionIndex++;
    console.log('current inst index is: ', currentInstructionIndex);
    displayCurrentInstruction();
  } else {
    
    console.log('REACHED THE END');
    
    createSubmitButton();
    skipButton.disabled=true;
    async function callerFunction() {
      // Call the asynchronous function
      await questioner(instructions);
      console.log('Request made for questions');
      // Code here will run after the asynchronous function has completed
    }
    callerFunction(); 

    //deactivate the shit + enter key so that only submit button submits answers
    sendMessageBox.addEventListener("keydown", function(event) {
      if (event.key === "Enter" && event.shiftKey) {
        // Prevent the default newline behavior
        event.preventDefault();
    
        // Disable any further processing of the key combination
        //event.stopPropagation();
    
        // Optionally, you can also disable the input field
        sendMessageBox.querySelector("#messageTextarea").disabled = true;
    
        alert('Click on submit to submit your answers');
      }
    });

    const mySubmitButton = document.getElementById('my-submit-button');
    mySubmitButton.addEventListener("click", function() {
      const messageTextarea = sendMessageBox.querySelector("#messageTextarea");
      const messageValue = messageTextarea.value;
    
      console.log("Message Value for Scoring: ", messageValue);
      masterScorer(messageValue)
        .then(function(text) {
          console.log('Request made for Grading');
          const jsonObject = extractJsonObject(text);
    
          mcq = parseFloat(jsonObject.mcqs);
          fresp = parseFloat(jsonObject.free_response);
          tscore = 0.5 * mcq + 0.5 * fresp;
          timeeff = 0.5 * tscore;
    
          const userData = JSON.parse(sessionStorage.user);
          var sid = userData.stdnumber;
    
          const toDispatch = {
            studentId: sid,
            courseId: sessionStorage.getItem('courseToLearn'),
            score: tscore.toFixed(2),
            topic: sessionStorage.getItem('topicToLearn'),
            total: tscore.toFixed(2),
            ac: mcq.toFixed(2),
            te: timeeff.toFixed(2),
            pe: fresp.toFixed(2),
            action: "saveGrades"
          };
          
          // Send the data via jQuery POST call
          $.post('api/api.php', toDispatch)
            .done(function() {
              console.log("Grades saved successfully");
              alert("Grades saved successfully");
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
              console.error("Failed to save grades:", errorThrown);
            });
          console.log('FULL DATA: ', toDispatch);
        })
        .catch(function(error) {
          console.error("Error occurred while saving grades:", error);
        });
    });



  }
});
// Event listener for the start button
startButton.addEventListener("click", function() {
  startButton.disabled = true;
  skipButton.disabled = false;
  currentInstructionIndex = 0||parseInt(sessionStorage.getItem('currentInstructionIndex'));
  console.log('starting with index: ', currentInstructionIndex);
  displayCurrentInstruction();
  sendMessageBox.querySelector("#messageTextarea").disabled = false;
});

// Event listener for the next button
startButton.addEventListener("click", function() {
  if (startButton.textContent === "Next") {
    loadNextInstruction();
  }
});




// Function to load the next instruction
function loadNextInstruction() {
  currentInstructionIndex++;
  displayCurrentInstruction();
  sendMessageBox.querySelector("#messageTextarea").disabled = false;
}

// Event listener for the exit button
// exitButton.addEventListener("click", function() {
//   // Redirect to grades page or perform necessary actions
// });

// GENERATE RESPONSE FUNCTION
async function scorer(instructions, prompt) {
    const lastInstruction = instructions[instructions.length - 1];
    const topic = lastInstruction.message3;
  
    // Implement the logic for the scorer function
    // that evaluates the response and returns a score
    const statement = `How accurate is the answer: ${prompt} to the question: : ${topic}? Please respond in the form: 'The answer is x% accurate' `;
    console.log('STATEMENT TO EVALUATE: ', statement);
    try {
      const response = await generateResponse(statement);
      const match = response.match(/\d+/); // Extract the number between 0 and 100
      const score = match ? parseInt(match[0]) : 0.00;
      sessionStorage.setItem("accuracy", score);
      return score;
    } catch (error) {
      console.error(error);
      return 0; // Return 0 in case of an error
    }
}


async function masterScorer(prompt) {
  const lastInstruction = instructions[instructions.length - 1];
  const questions = sessionStorage.getItem('questions');

  // Implement the logic for the scorer function
  // that evaluates the response and returns a score
  const statement = `assess the answers: ${prompt} to the following questions: ${questions}. Return ONLY the evaluation results as a json object in the form: {mcqs:xx, free_response:yy} where xx is the correctness of the MCQs expressed as a percentage yy is the correctness level of the free response question expressed as a percentage.`;
  console.log('STATEMENT TO EVALUATE: ', statement);
  try {
    const response = await generateResponse(statement);
    console.log("EVALUATION RESULT: ",response);
    // const match = response.match(/\d+/); // Extract the number between 0 and 100
    // const score = match ? parseInt(match[0]) : 0.00;
    sessionStorage.setItem("scores", response);
    return response;
  } catch (error) {
    console.error(error);
    return 0; // Return 0 in case of an error
  }
}

async function questioner(instructions) {
  const firstInstruction = instructions[0];
  const topic = firstInstruction.message1;

  // Implement the logic for the scorer function
  // that evaluates the response and returns a score
  const statement = `Give me 2 MCQs and one free response question related to: ${topic}. Format the response using HTML Markup so that it can be appended to innerHTHM`;
  console.log('STATEMENT TO EVALUATE: ', statement);
  try {
    const response = await generateResponse(statement);
    sessionStorage.setItem("questions", response);
    addChatMessage(response);
    //return response;
  } catch (error) {
    console.error(error);
    //return 'Failed to get gpt questions';
  }
}

async function secretPrompter(prompt) {
    const statement = "Please give me ten comma-separated keywords relevant to the topic: " + prompt;
  
    try {
      const response = await generateResponse(statement);
      textMain = response; // Assuming `textMain` is a global variable
    } catch (error) {
      console.error(error);
    }
}


// Function to extract keywords from a message
// Function to extract keywords from a message
function extractKeywords(message) {
// Split the message into individual words
const words = message.split(" ");

// List of common prepositions, conjunctions, and disjunctions to exclude
const excludedWords = [
  "to", "with", "from", "in", "on", "at", "by", "for", "about", "through",
  "and", "or", "but", "nor", "so", "yet", "after", "although", "as", "because",
  "before", "if", "since", "though", "unless", "until", "when", "where", "while"
];

// Filter out excluded words, special characters, and null values,
// and return the remaining words as keywords
const keywords = words.filter(word => {
  const sanitizedWord = word.toLowerCase().replace(/[.,\/#!$%\^&\*;:{}=\-_`~()]/g, "");
  return !excludedWords.includes(sanitizedWord) && sanitizedWord !== "" && sanitizedWord !== "null";
});

return keywords;
}

// Function to set textMain based on the current instruction
function textMainSetter(currentIndex) {
const currentInstruction = instructions[currentIndex];

// Extract the message values dynamically
const messages = Object.values(currentInstruction).filter(value => typeof value === 'string');

// Extract important keywords from the message values
const keywords = new Set();

messages.forEach(message => {
  const messageKeywords = extractKeywords(message);
  messageKeywords.forEach(keyword => {
    keywords.add(keyword);
  });
});

// Convert the set of keywords to a comma-separated string
textMain = Array.from(keywords).join(", ");

// Log the expression to the console
console.log("New textMain is:", textMain);
}


//FUNCTION TO CREAT SUBMIT BUTTON
function createSubmitButton() {
// Create the button element
const submitButton = document.createElement("button");

// Add classes to the button
submitButton.classList.add("btn", "btn-primary");

// Set the text of the button
submitButton.textContent = "Submit";
submitButton.id = "my-submit-button";
// Get the div element with the id "submit-button"
const submitButtonContainer = document.getElementById("submit-button");

// Append the button to the div
submitButtonContainer.appendChild(submitButton);
}


// FUNCTION TO DESTROY SUBMIT BUTTON
function destroySubmitButton() {
// Get the submit button element with the id "my-submit-button"
const submitButton = document.getElementById("my-submit-button");

// Check if the submit button exists
if (submitButton) {
// If the submit button exists, remove it from the DOM
submitButton.remove();
}
}

// submitButton.addEventListener("click", function() {

//     clearInterval(timerInterval);
//     startTimer(0);

// });


// SCRIPT FROM HOME

// Function to fetch courses for a specific user
const userDatab = JSON.parse(sessionStorage.user);

// Access the stdnumber property
var sid = userDatab.stdnumber;
console.log('STUDENT NUMBER IS: ',sid);


function fetchCoursesForUser(sid) {
   $.ajax({
       url: 'api/api.php',
       method: 'POST',
       data: { studentId: sid, action: 'fetchCoursesForUser'  },
       dataType: 'json',
       success: function(response) {
           console.log('COURSES FETCHED SUCCESSFULY', response);
           var courses=response.courses;
           console.log("FIRST COURSE NAME: ",courses[0].name);
           const courseSelect = $('#course');
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
       error: function(jqXHR, textStatus, errorThrown) {
       console.error('Failed to fetch courses:', errorThrown);
       }
   });
}

//FETCH TOPICS
function fetchTopics(courseId) {
$.ajax({
   url: 'api/api.php',
   method: 'POST',
   data: { action: 'fetchTopicsForCourse', courseId: courseId },
   dataType: 'json',
   success: function(response) {
       console.log('TOPICS FETCHED SUCCESSFULY', response);
       const topicSelect = $('#topic');
           topicSelect.empty();

           // Add options for each topic
           topicSelect.append('<option value="" style="background-color:lightblue;">   Select Lecture  </option>')
           response.topics.forEach(topic => {
           const option = $('<option></option>')
               .val(topic.id)
               .text(topic.name);
           topicSelect.append(option);
           });
           sessionStorage.setItem('courseToLearn',courseId);
           //sessionStorage.setItem('topicToLearn',response.topics[0].id);
           let examtopics = [];
           const etopics = response.topics
           for(let i=0; i< etopics.lentgh;i++){
            examtopics.push(etopics[i].name);

           }
           sessionStorage.setItem('examTopics',JSON.stringify(examtopics));
   },
   error: function(jqXHR, textStatus, errorThrown) {
   console.error('Failed to fetch TOPICS:', errorThrown);
   }
});
}


function fetchCoursesForUser(sid, cdId) {
   $.ajax({
       url: 'api/api.php',
       method: 'POST',
       data: { studentId: sid, action: 'fetchCoursesForUser'  },
       dataType: 'json',
       success: function(response) {
           console.log('COURSES FETCHED SUCCESSFULY', response);
           var courses=response.courses;
           console.log("FIRST COURSE NAME: ",courses[0].name);
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
       error: function(jqXHR, textStatus, errorThrown) {
       console.error('Failed to fetch courses:', errorThrown);
       }
   });
}

//FETCH TOPICS
function fetchTopics(courseId, tdId) {
$.ajax({
   url: 'api/api.php',
   method: 'POST',
   data: { action: 'fetchTopicsForCourseS', courseId: courseId },
   dataType: 'json',
   success: function(response) {
       console.log('TOPICS FETCHED SUCCESSFULY', response);
       const topicSelect = $(tdId);
           topicSelect.empty();

           // Add options for each topic
           topicSelect.append('<option value="" style="background-color:lightblue;">   Select Lecture  </option>')
           response.topics.forEach(topic => {
           const option = $('<option></option>')
               .val(topic.id)
               .text(topic.name);
           topicSelect.append(option);
           });
           sessionStorage.setItem('courseToLearn',courseId);
           //sessionStorage.setItem('topicToLearn',response.topics[0].id);
           
   
   },
   error: function(jqXHR, textStatus, errorThrown) {
   console.error('Failed to fetch TOPICS:', errorThrown);
   }
});
}





function fetchBaseSettings(courseId) {
   let pdfTexts = {};
   const requestData = {
       courseId: courseId,
       action: 'fetchBaseSettings'
   };

   $.ajax({
       url: 'api/api.php',
       type: 'POST',
       data: requestData,
       dataType: 'json',
       success: function (response) {
           const settings = {};

           if (response.responseOrigin && response.responseOrigin.chatGPT) {
               settings['chatGPT'] = 'chatGPT';
           }

           if (response.responseOrigin && response.responseOrigin.webResources) {
               settings['webResources'] = response.responseOrigin.webResources;
           }

           if (response.responseOrigin && response.responseOrigin.textbooks) {
               settings['textbooks'] = response.responseOrigin.textbooks;
           }

           if (response.responseOrigin && response.responseOrigin.all) {
            settings['all'] = response.responseOrigin.all;
        }
           // You can now use the 'settings' object containing the fetched settings

           if (settings['textbooks']) {
               console.log('REQUIRED TO USE TEXTBOOKS:', settings['textbooks']);
               sessionStorage.setItem('responseOrigin','textbooks');
               const pdfFilePaths = Array.isArray(settings['textbooks']) ? settings['textbooks'].map(textbook => 'uploads/' + textbook) : [];
               console.log('PROCESS STARTED');
               console.log('PDF FILE PATHS: ', pdfFilePaths);

               // Fetch and extract text from each PDF file sequentially
               let promises = [];
               for (const pdfFilePath of pdfFilePaths) {
                   const promise = fetchPdfData(pdfFilePath)
                       .then(pdfData => pdfjsLib.getDocument(pdfData).promise)
                       .then(pdf => extractTextFromPDF(pdf))
                       .then(pdfText => {
                           pdfTexts[pdfFilePath] = pdfText;
                       });
                   promises.push(promise);
               }

               Promise.all(promises)
                   .then(() => {
                       console.log('PDF Texts:', pdfTexts);
                       sessionStorage.setItem('corpus',pdfTexts);
                       corpus = pdfTexts;
                       console.log('NAME SPACE CORPUS: ', corpus);
                   })
                   .catch(error => {
                       console.error('Error fetching PDFs:', error);
                   });
           } else if (settings['chatGPT']){
               console.log('USING chatGPT FOR ANSWERS');
               sessionStorage.setItem('responseOrigin','chatGPT');

           }
           else {
            console.log('REQUIRED TO USE ALL RESOURCES:');
            sessionStorage.setItem('responseOrigin','All');
            const pdfFilePaths = Array.isArray(settings['textbooks']) ? settings['textbooks'].map(textbook => 'uploads/' + textbook) : [];
            console.log('PROCESS STARTED');
            console.log('PDF FILE PATHS: ', pdfFilePaths);

            // Fetch and extract text from each PDF file sequentially
            let promises = [];
            for (const pdfFilePath of pdfFilePaths) {
                const promise = fetchPdfData(pdfFilePath)
                    .then(pdfData => pdfjsLib.getDocument(pdfData).promise)
                    .then(pdf => extractTextFromPDF(pdf))
                    .then(pdfText => {
                        pdfTexts[pdfFilePath] = pdfText;
                    });
                promises.push(promise);
            }

            Promise.all(promises)
                .then(() => {
                    console.log('PDF Texts:', pdfTexts);
                    sessionStorage.setItem('corpus',pdfTexts);
                    corpus = pdfTexts;
                    console.log('NAME SPACE CORPUS: ', corpus);
                })
                .catch(error => {
                    console.error('Error fetching PDFs:', error);
                });
             
           }
       },
       error: function (xhr, status, error) {
           console.error('AJAX Error:', error);
       }
   });
}





// JSON object to store extracted PDF texts
//   let pdfTexts = {};
//  fetchBaseSettings('C004');


//  searchButton.addEventListener('click', function(e){
//      e.preventDefault();
//      text = performSearch();
//      responseDiv.textContent = text;
//  });

//  searchTermInput.addEventListener('keydown', function(event) {
//      if (event.key === 'Enter' && event.shiftKey) {
//          event.preventDefault(); // Prevent normal Enter behavior
//          text = performSearch();
//          responseDiv.textContent = text;
//      }
//  });

async function fetchPdfData(pdfFilePath) {
   const response = await fetch(pdfFilePath);
   const blob = await response.blob();
   return new Uint8Array(await blob.arrayBuffer());
}

async function extractTextFromPDF(pdf) {
   const totalNumPages = pdf.numPages;
   const textByPage = {};

   for (let pageNum = 1; pageNum <= totalNumPages; pageNum++) {
       const page = await pdf.getPage(pageNum);
       const textContent = await page.getTextContent();
       const text = textContent.items.map(item => item.str).join(' ');
       textByPage[pageNum] = text;
   }

   return textByPage;
}

let fuseIndex = null; // Declare the Fuse instance outside the function

// ...

function performSearch(query, corpus) {
// const query = searchTermInput.value.toLowerCase();
// if (!query || Object.keys(pdfTexts).length === 0) {
//     responseDiv.textContent = 'Please wait while PDFs are being processed.';
//     return;
// }

const matches = [];
if(corpus){
  var pdfTexts = corpus;
}else {
  var pdfTexts = "No text found. Probably there are no textbooks for this"};

for (const [pdfFilePath, pdfText] of Object.entries(pdfTexts)) {
    const pdfBaseName = getBaseNameFromPath(pdfFilePath);

    for (const [pageNum, pageText] of Object.entries(pdfText)) {
        const chunks = chunkText(pageText, 250);
        let bestMatch = '';
        let bestMatchCount = 0;

        for (const [index, chunk] of chunks.entries()) {
            const keywordCount = countKeywords(chunk.toLowerCase(), query);
            if (keywordCount > bestMatchCount) {
                bestMatch = chunk;
                bestMatchCount = keywordCount;
            }
        }

        if (bestMatch) {
            matches.push({ pdf: pdfBaseName, page: pageNum, match: bestMatch, keywordCount: bestMatchCount });
        }
    }
}


if (matches.length > 0) {
    // Sort matches based on keyword count in descending order
    matches.sort((a, b) => b.keywordCount - a.keywordCount);

    // Get the top 5 matches
    const topMatches = matches.slice(0, 1);

    const response = topMatches.map(match => `Book: ${match.pdf}, Page ${match.page}: "${match.match}"`).join('\n');
    return response;
} else {
    return '';
}
}


// Function to extract base name from a file path
function getBaseNameFromPath(filePath) {
   const parts = filePath.split('/');
   const fileName = parts[parts.length - 1];
   return fileName;
}

function countKeywords(text, query) {
   return query.split(' ').reduce((count, keyword) => {
       return count + (text.includes(keyword) ? 1 : 0);
   }, 0);
}

function chunkText(text, chunkSize) {
   const chunks = [];
   for (let i = 0; i < text.length; i += chunkSize) {
       chunks.push(text.slice(i, i + chunkSize));
   }
   return chunks;
}