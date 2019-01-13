// const likeButton = document.querySelector(".like-button");
// const dislikeButton = document.querySelector(".dislike-button");

// likeButton.addEventListener("click", addLikes);
// dislikeButton.addEventListener("click", addDislikes);

function preview_image(event) {
  var reader = new FileReader();
  reader.onload = function() {
    var output = document.querySelector(".output_image");
    output.src = reader.result;
  };
  reader.readAsDataURL(event.target.files[0]);
}
