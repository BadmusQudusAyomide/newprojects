document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".comment-form").forEach(function (form) {
    form.addEventListener("submit", async function (e) {
      e.preventDefault();

      let postId = this.dataset.postId;
      let commentContent = this.querySelector(".comment-input").value.trim();
      let csrfToken = this.querySelector('[name="_csrf_token"]').value;

      if (commentContent === "") {
        alert("Comment cannot be empty.");
        return;
      }

      try {
        let response = await fetch("comment.php", {
          method: "POST",
          body: JSON.stringify({
            postId,
            content: commentContent,
            _csrf_token: csrfToken,
          }),
          headers: {
            "Content-Type": "application/json",
          },
        });

        let data = await response.json();

        if (data.success) {
          let commentsContainer = document.querySelector(
            `#comments-container-${postId}`
          );
          let newComment = document.createElement("div");
          newComment.classList.add("comment");
          newComment.textContent = data.comment.content;
          commentsContainer.appendChild(newComment);
          this.querySelector(".comment-input").value = "";
        } else {
          alert(data.message || "Error submitting comment.");
        }
      } catch (error) {
        console.error("Error:", error);
      }
    });
  });
});
