document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('comment-form');
    if (form) {
        form.addEventListener('submit', submitComment);
    } else {
        console.error('Form with id "comment-form" not found');
    }
});

function submitComment(event) {
    event.preventDefault();
    console.log('Form submission intercepted');
    
    const form = event.target;
    const articleId = form.querySelector('input[name="article_id"]').value;
    const content = form.querySelector('textarea[name="content"]').value;
    
    if (!content.trim()) {
        alert('Пожалуйста, введите комментарий');
        return;
    }
    
    const formData = new FormData();
    formData.append('article_id', articleId);
    formData.append('content', content);
    
    const csrfToken = document.querySelector('meta[name="csrf-token"]');
    if (!csrfToken) {
        console.error('CSRF token not found');
        return;
    }
    
    fetch('/comment', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => {
        console.log('Response status:', response.status);
        return response.json().then(data => {
            if (!response.ok) {
                return Promise.reject(data);
            }
            return data;
        });
    })
    .then(data => {
        console.log('Response data:', data);
        if (data.success) {
            addCommentToDOM(data.comment);
            form.reset();
        } else {
            alert('Ошибка при отправке комментария: ' + (data.message || 'Неизвестная ошибка'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Произошла ошибка при отправке комментария: ' + (error.message || 'Неизвестная ошибка'));
    });
}

function addCommentToDOM(comment) {
    const commentsSection = document.querySelector('.mt-12');
    const noCommentsMessage = commentsSection.querySelector('p');
    
    if (noCommentsMessage && noCommentsMessage.textContent === 'Пока нет комментариев') {
        noCommentsMessage.remove();
    }
    
    const commentElement = document.createElement('div');
    commentElement.className = 'bg-white shadow rounded-lg p-6 mb-4';
    commentElement.innerHTML = `
        <div class="flex items-center mb-4">
            <div>
                <h3 class="font-medium text-gray-900">${comment.user.login}</h3>
                <span class="text-sm text-gray-600">только что</span>
            </div>
        </div>
        <p class="text-gray-700">${comment.content}</p>
    `;
    
    commentsSection.insertBefore(commentElement, commentsSection.querySelector('form'));
}