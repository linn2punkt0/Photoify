// Likes and Dislikes

//const likeButton = document.querySelector(".like-button");
// const dislikeButton = document.querySelector(".dislike-button");

// likeButton.addEventListener("click", addLikes);
// dislikeButton.addEventListener("click", addDislikes);

// Preview image in input-forms
function preview_image(event) {
  const reader = new FileReader();
  reader.onload = function() {
    const output = document.querySelector(".output_image");
    output.src = reader.result;
  };
  reader.readAsDataURL(event.target.files[0]);
}
