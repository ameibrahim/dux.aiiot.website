<?php

// Check if an action parameter is provided
if (isset($_POST['action'])) {
    $action = $_POST['action'];

    switch ($action) {
        case 'getquestions':
            if (isset($_POST['fileName'])) {
                $questionsJson = "../../exams/".$_POST['fileName'] . ".json";
    
                // Check if the file exists
                if (file_exists($questionsJson)) {
                    $questions = json_decode(file_get_contents($questionsJson), true);
                    header('Content-Type: application/json');
                    echo json_encode($questions);
                } else {
                    // Handle the case where the file does not exist
                    $jsonString = '{
                        "Question Bank is Empty": [
                          {
                            "type": "NA",
                            "question": "No questions are available for this course",
                            "options": [],
                            "answer": "Please generate questions first"
                          }
                        ]
                    }';
                    echo json_encode(['Question Bank is empty. Please generate questions for this exam' => 'error', 'message' => 'File not found']);
                }
            }
            break;

        case 'checkfile': // Add the 'checkfile' case
            if (isset($_POST['fileName'])) {
                $fileName = $_POST['fileName'] ;//. ".json";
                $filePath = "../../exams/" . $fileName; // Path to the file in the 'exams' folder

                if (file_exists($filePath)) {
                    echo json_encode(['status' => 'success', 'message' => 'File exists'.$filePath]);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'File not found']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Missing file name']);
            }
            break;


        case 'deletefile': // Add the 'deletefile' case
            if (isset($_POST['fileName'])) {
                $fileName = $_POST['fileName'];
                $filePath = "../../exams/" . $fileName; // Path to the file in the 'exams' folder

                if (file_exists($filePath)) {
                    if (unlink($filePath)) {
                        echo json_encode(['status' => 'success', 'message' => 'File deleted']);
                    } else {
                        echo json_encode(['status' => 'error', 'message' => 'Failed to delete file']);
                    }
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'File not found']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Missing file name']);
            }
            break;

        case 'edit':
            if (isset($_POST['question'])) {
                $editedQuestion = json_decode($_POST['question'], true);
                $questions = getQuestionsFromJson($_POST['fileName']); // Read the JSON file

                // Find the corresponding question and update it
                updateQuestion($questions, $editedQuestion);

                // Save the updated questions back to the JSON file
                saveQuestionsToJson($_POST['fileName'], $questions);

                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Missing question data']);
            }
            break;

        case 'delete':
            if (isset($_POST['question'])) {
                $deletedQuestion = json_decode($_POST['question'], true);
                $questions = getQuestionsFromJson($_POST['fileName']); // Read the JSON file

                // Find the corresponding question and remove it
                removeQuestion($questions, $deletedQuestion);

                // Save the updated questions back to the JSON file
                saveQuestionsToJson($_POST['fileName'], $questions);

                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Missing question data']);
            }
            break;

        case 'create':
            if (isset($_POST['question'], $_POST['topic'])) {
                $newQuestion = json_decode($_POST['question'], true);
                $topic = $_POST['topic'];
                $questions = getQuestionsFromJson($_POST['fileName']); // Read the JSON file

                // Add the new question to the specified topic
                addQuestion($questions, $topic, $newQuestion);

                // Save the updated questions back to the JSON file
                saveQuestionsToJson($_POST['fileName'], $questions);

                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Missing question data or topic']);
            }
            break;

        default:
            echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
            break;
    }
} else {
    // If no action parameter is provided, return all questions
    header('Content-Type: application/json');
    echo getNoQuestionsResponse();
}

function getQuestionsFromJson($fileName) {
    $questionsJson = "../../exams/".$fileName . ".json";
    return json_decode(file_get_contents($questionsJson), true);
}

function saveQuestionsToJson($fileName, $questions) {
    $questionsJson = "../../exams/".$fileName . ".json";
    file_put_contents($questionsJson, json_encode($questions));
}

function updateQuestion(&$questions, $editedQuestion) {
    foreach ($questions as $topic => &$topicQuestions) {
        foreach ($topicQuestions as &$q) {
            if ($q['question'] == $editedQuestion['question']) {
                $q['question'] = $editedQuestion['question'];
                $q['answer'] = $editedQuestion['answer'];
                $q['options'] = $editedQuestion['options'];
            }
        }
    }
}

function removeQuestion(&$questions, $deletedQuestion) {
    foreach ($questions as $topic => &$topicQuestions) {
        $topicQuestions = array_filter($topicQuestions, function ($q) use ($deletedQuestion) {
            return $q['question'] !== $deletedQuestion['question'];
        });
    }
}

function addQuestion(&$questions, $topic, $newQuestion) {
    if (!isset($questions[$topic])) {
        $questions[$topic] = [];
    }
    $questions[$topic][] = $newQuestion;
}

function getNoQuestionsResponse() {
    $response = array("status" => "Failed", "message" => "No questions set for this course");
    $jsonString = '{
        "Status": [
          {
            "type": "NA",
            "question": "No questions are available for this course",
            "options": [],
            "answer": "Please generate questions first"
          }
        ]
    }';
    return $jsonString;
}
?>