document.addEventListener('DOMContentLoaded', function() {
    const likeButton = document.getElementById('likeButton');
    const likeCount = document.getElementById('likeCount');
    const heartPath = document.getElementById('heartPath');

    if (likeButton) {
        const isLiked = likeButton.getAttribute('data-is-liked') === 'true';
        updateHeartStyle(isLiked);

        likeButton.addEventListener('click', function() {
            const articleId = this.getAttribute('data-article-id');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch('/like', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    article_id: articleId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    likeCount.textContent = data.likes;
                    updateHeartStyle(data.isLiked);
                    likeButton.setAttribute('data-is-liked', data.isLiked);
                }
            })
            .catch(error => console.error('Error:', error));
        });
    }

    function updateHeartStyle(isLiked) {
        if (isLiked) {
            heartPath.setAttribute('fill', 'currentColor');
            likeButton.classList.add('text-red-500');
            likeButton.classList.remove('text-gray-400');
        } else {
            heartPath.setAttribute('fill', 'none');
            likeButton.classList.remove('text-red-600');
            likeButton.classList.add('text-gray-400');
        }
    }
});