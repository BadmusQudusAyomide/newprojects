document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.like-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            let postId = this.dataset.postId;

            fetch('like.php', {
                method: 'POST',
                body: JSON.stringify({ postId: postId }),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    let likesCount = document.querySelector(`#likes-count-${postId}`);
                    likesCount.textContent = data.likes;
                } else {
                    alert('Error liking post.');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
});