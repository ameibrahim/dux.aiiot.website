<?php
// Include database connection code here

$action = $_GET['action'];

// Handle different API actions
switch ($action) {
  case 'getPosts':
    getPosts();
    break;
  case 'createPost':
    createPost();
    break;
  case 'likePost':
    likePost();
    break;
  case 'addComment':
    addComment();
    break;
  default:
    // Handle invalid action
    break;
}

// Function to get all forum posts
function getPosts() {
    // Retrieve posts from the database
    // Modify the database connection details as per your setup
    $dbHost = 'localhost';
    $dbName = 'aiiovdft_neuaietutor';
    $dbUser = 'aiiovdft_neuaietutor';
    $dbPass = 'Marvelyiky';



    // Create a PDO instance
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPass);
  
    // Fetch all posts with their comments
    $query = "
      SELECT forum_posts.*, forum_comments.comment
      FROM forum_posts
      LEFT JOIN forum_comments ON forum_posts.id = forum_comments.post_id
      ORDER BY forum_posts.id DESC
    ";
  
    $stmt = $pdo->query($query);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
    // Transform the results to include an array of comments
    $posts = [];
    foreach ($results as $result) {
      $postId = $result['id'];
      $comment = $result['comment'];
      
      // Check if the post already exists in the $posts array
      if (!isset($posts[$postId])) {
        // Create a new post entry
        $post = [
          'id' => $result['id'],
          'title' => $result['title'],
          'content' => $result['content'],
          'user_id' => $result['user_id'],
          'likes' => $result['likes'],
          'comments' => []
        ];
        $posts[$postId] = $post;
      }
      
      // Add the comment to the corresponding post
      if ($comment) {
        $posts[$postId]['comments'][] = $comment;
      }
    }
  
    // Return the posts as JSON
    header('Content-Type: application/json');
    echo json_encode(array_values($posts));
  }

// Function to create a new forum post
function createPost() {
  $title = $_POST['title'];
  $content = $_POST['content'];
  $userId = $_POST['name']; // Replace with the actual user ID

  // Insert the new post into the database
  // Modify the database connection details as per your setup
    $dbHost = 'localhost';
    $dbName = 'aiiovdft_neuaietutor';
    $dbUser = 'aiiovdft_neuaietutor';
    $dbPass = 'Marvelyiky';

  // Create a PDO instance
  $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPass);

  $query = "
    INSERT INTO forum_posts (title, content, user_id)
    VALUES (:title, :content, :user_id)
  ";

  $stmt = $pdo->prepare($query);
  $stmt->bindValue(':title', $title);
  $stmt->bindValue(':content', $content);
  $stmt->bindValue(':user_id', $userId);
  $stmt->execute();

  // Return success message or appropriate JSON response
  echo 'Post created successfully';
}

// Function to like a forum post
function likePost() {
  $postId = $_POST['post_id'];

  // Update the likes count in the database
  // Modify the database connection details as per your setup
    $dbHost = 'localhost';
    $dbName = 'aiiovdft_neuaietutor';
    $dbUser = 'aiiovdft_neuaietutor';
    $dbPass = 'Marvelyiky';

  // Create a PDO instance
  $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPass);

  $query = "
    UPDATE forum_posts
    SET likes = likes + 1
    WHERE id = :post_id
  ";

  $stmt = $pdo->prepare($query);
  $stmt->bindValue(':post_id', $postId);
  $stmt->execute();

  // Return success message or appropriate JSON response
  echo 'Post liked successfully';
}

// Function to add a comment to a forum post
function addComment() {
  $postId = $_POST['post_id'];
  $comment = $_POST['comment'];

  // Insert the new comment into the database
  // Modify the database connection details as per your setup
    $dbHost = 'localhost';
    $dbName = 'aiiovdft_neuaietutor';
    $dbUser = 'aiiovdft_neuaietutor';
    $dbPass = 'Marvelyiky';

  // Create a PDO instance
  $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPass);

  $query = "
    INSERT INTO forum_comments (post_id, comment)
    VALUES (:post_id, :comment)
  ";

  $stmt = $pdo->prepare($query);
  $stmt->bindValue(':post_id', $postId);
  $stmt->bindValue(':comment', $comment);
  $stmt->execute();

  // Return success message or appropriate JSON response
  echo 'Comment added successfully';
}

