$(document).ready(function() {
    // Load existing forum posts when the page loads
    loadForumPosts();
  
    // Handle form submission for creating a new forum post
    $('#createPostForm').submit(function(event) {
      event.preventDefault();
      createForumPost();
    });
  
    // Event delegation to handle like button clicks
    $('#postsContainer').on('click', '.like-button', function() {
      var postId = $(this).data('post-id');
      likePost(postId);
    });
  
    // Event delegation to handle comment form submission
    $('#postsContainer').on('submit', '.comment-form', function(event) {
      event.preventDefault();
      var postId = $(this).data('post-id');
      var commentInput = $(this).find('.comment-input');
      var comment = commentInput.val();
      addComment(postId, comment);
      commentInput.val('');
    });
  });
  
  // Function to load existing forum posts
  function loadForumPosts() {
    $.ajax({
      url: 'api/api.php?action=getPosts',
      dataType: 'json',
      success: function(posts) {
        // Clear the posts container
        $('#postsContainer').empty();
  
        // Append each post to the container
        posts.forEach(function(post) {
          var postHtml = '<div class="card mb-3">';
          postHtml += '<div class="card-body">';
          postHtml += '<h5 class="card-title">' + post.title + '</h5>';
          postHtml += '<p class="card-text">' + post.content + '</p>';
          postHtml += '<button class="btn btn-primary like-button" data-post-id="' + post.id + '">Like</button>';
          postHtml += '<hr>';
          postHtml += '<h6>Comments</h6>';
          postHtml += '<ul class="list-unstyled comment-list">';
          post.comments.forEach(function(comment) {
            postHtml += '<li>' + comment + '</li>';
          });
          postHtml += '</ul>';
          postHtml += '<form class="comment-form" data-post-id="' + post.id + '">';
          postHtml += '<div class="form-group">';
          postHtml += '<input type="text" class="form-control comment-input" placeholder="Add a comment" required>';
          postHtml += '</div>';
          postHtml += '<button type="submit" class="btn btn-secondary">Comment</button>';
          postHtml += '</form>';
          postHtml += '</div>';
          postHtml += '<div class="card-footer">';
          postHtml += '<small class="text-muted">Posted by User ID: ' + post.user_id + '</small>';
          postHtml += '</div>';
          postHtml += '</div>';
  
          $('#postsContainer').append(postHtml);
        });
      }
    });
  }
  
  // Function to create a new forum post
  function createForumPost() {
    var formData = $('#createPostForm').serialize();
  
    $.ajax({
      type: 'POST',
      url: 'api/api.php?action=createPost',
      data: formData,
      success: function(response) {
        // Clear the form inputs
        $('#title').val('');
        $('#content').val('');
  
        // Reload the posts
        loadForumPosts();
      }
    });
  }
  
  // Function to like a forum post
  function likePost(postId) {
    $.ajax({
      type: 'POST',
      url: 'api/api.php?action=likePost',
      data: { post_id: postId },
      success: function(response) {
        // Reload the postsloadForumPosts();
      }
    });
  }
  
  // Function to add a comment to a forum post
  function addComment(postId, comment) {
    $.ajax({
      type: 'POST',
      url: 'api/api.php?action=addComment',
      data: { post_id: postId, comment: comment },
      success: function(response) {
        // Reload the posts
        loadForumPosts();
      }
    });
  }