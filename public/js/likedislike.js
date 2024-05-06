document.querySelectorAll('.like-icon').forEach(function(likeIcon) {
    likeIcon.addEventListener('click', function() {
        let productId = likeIcon.dataset.productId;

        // Envoyer une requête AJAX pour liker le produit
        fetch('/like/' + productId)
            .then(response => response.json())
            .then(data => {
                // Mettre à jour le badge de compteur avec le nombre de likes retourné
                likeIcon.querySelector('.like-count-badge').innerText = data.likes;
                // Afficher une notification ou effectuer toute autre action requise
            });
    });
});

document.querySelectorAll('.dislike-icon').forEach(function(dislikeIcon) {
    dislikeIcon.addEventListener('click', function() {
        let productId = dislikeIcon.dataset.productId;

        // Envoyer une requête AJAX pour disliker le produit
        fetch('/dislike/' + productId)
            .then(response => response.json())
            .then(data => {
                // Mettre à jour le badge de compteur avec le nombre de dislikes retourné
                dislikeIcon.querySelector('.dislike-count-badge').innerText = data.dislikes;
                // Afficher une notification ou effectuer toute autre action requise
            });
    });
});
