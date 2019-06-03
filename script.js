function LikeButton(post){
    const likeButton = document.getElementById("like-" + post);
    const likesCounter = document.getElementById('likes-' + post);

    const liked = likeButton.src.endsWith("_images/like_button1.png");
    // if(liked) return; // Exit if liked


    if(liked) {
        // Unlike
        likesCounter.innerHTML = Number(likesCounter.innerHTML) - 1; // Decease by 1
        likeButton.src = "_images/like_button.png"; //Change pic

        // Like in DB
        $.post("/like.php",  { like: false, post_id: post })
        .fail(function(){
            // Reset on fail
            likesCounter.innerHTML = Number(likesCounter.innerHTML) + 1; // Increase by 1
            likeButton.src = "_images/like_button1.png"; //Change pic
        });
    } else {
        // Like
        likesCounter.innerHTML = Number(likesCounter.innerHTML) + 1; // Increase by 1
        likeButton.src = "_images/like_button1.png"; //Change pic

        // Like in DB
        $.post("/like.php",  { like: true, post_id: post })
        .fail(function(){
            // Reset on fail
            likesCounter.innerHTML = Number(likesCounter.innerHTML) - 1; // Decease by 1
            likeButton.src = "_images/like_button.png"; //Change pic
        });
    }
}