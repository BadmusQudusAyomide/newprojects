document.getElementById('registerForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    fetch('php/register.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert(data);
    });
});

document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    fetch('php/login.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert(data);
        loadPosts();
    });
});

function loadPosts() {
    fetch('php/get_posts.php')
    .then(response => response.json())
    .then(data => {
        const postsContainer = document.getElementById('posts');
        postsContainer.innerHTML = '';
        data.forEach(post => {
            const postElement = document.createElement('div');
            postElement.classList.add('post');
            postElement.innerHTML = `
                <h3>${post.username}</h3>
                <p>${post.content}</p>
                <button onclick="likePost(${post.id})">Like</button>
                <span>${post.likes} likes</span>
                <form onsubmit="commentPost(${post.id}, event)">
                    <input type="text" name="comment" placeholder="Comment" required>
                    <button type="submit">Post</button>
                </form>
                <div class="comments">
                    ${post.comments.map(comment => `<p><strong>${comment.username}</strong>: ${comment.comment}</p>`).join('')}
                </div>
            `;
            postsContainer.appendChild(postElement);
        });
    });
}

function likePost(postId) {
    fetch('php/like.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `post_id=${postId}`
    })
    .then(response => response.text())
    .then(data => {
        alert(data);
        loadPosts();
    });
}

function commentPost(postId, event) {
    event.preventDefault();
    const formData = new FormData(event.target);
    formData.append('post_id', postId);
    fetch('php/comment.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert(data);
        loadPosts();
    });
}
document.getElementById("profilePictureForm")
  .addEventListener("submit", function (e) {
    e.preventDefault();
    const formData = new FormData(this);
    fetch("php/profile_picture.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.text())
      .then((data) => {
        alert(data);
      });
  });
  document.getElementById('postForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    fetch('php/post.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert(data);
        loadPosts();
    });
});
Sec

document.getElementById('registerForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    fetch('php/register.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert(data);
    });
});

document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    fetch('php/login.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert(data);
        loadPosts();
    });
});

function loadPosts() {
    fetch('php/get_posts.php')
    .then(response => response.json())
    .then(data => {
        const postsContainer = document.getElementById('posts');
        postsContainer.innerHTML = '';
        data.forEach(post => {
            const postElement = document.createElement('div');
            postElement.classList.add('post');
            postElement.innerHTML = `
                <h3>${post.username}</h3>
                <p>${post.content}</p>
                <button onclick="likePost(${post.id})">Like</button>
                <span>${post.likes} likes</span>
                <form onsubmit="commentPost(${post.id}, event)">
                    <input type="text" name="comment" placeholder="Comment" required>
                    <button type="submit">Post</button>
                </form>
                <div class="comments">
                    ${post.comments.map(comment => `<p><strong>${comment.username}</strong>: ${comment.comment}</p>`).join('')}
                </div>
            `;
            postsContainer.appendChild(postElement);
        });
    });
}

function likePost(postId) {
    fetch('php/like.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `post_id=${postId}`
    })
    .then(response => response.text())
    .then(data => {
        alert(data);
        loadPosts();
    });
}

function commentPost(postId, event) {
    event.preventDefault();
    const formData = new FormData(event.target);
    formData.append('post_id', postId);
    fetch('php/comment.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert(data);
        loadPosts();
    });
}
document.getElementById("profilePictureForm")
  .addEventListener("submit", function (e) {
    e.preventDefault();
    const formData = new FormData(this);
    fetch("php/profile_picture.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.text())
      .then((data) => {
        alert(data);
      });
  });
  document.getElementById('postForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    fetch('php/post.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert(data);
        loadPosts();
    });
});
Sec
document.addEventListener('DOMContentLoaded', loadPosts);


document.addEventListener('DOMContentLoaded', loadPosts);
