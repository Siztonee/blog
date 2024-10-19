import Quill from 'quill';

document.addEventListener('DOMContentLoaded', function() {
    var quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
            toolbar: [
                ['bold', 'italic', 'underline'],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                ['link']
            ]
        }
    });

    var form = document.querySelector('#formm');
    form.onsubmit = function(e) {
        var description = document.querySelector('#hidden-description');
        description.value = quill.root.innerHTML;

        console.log('Description value:', description.value); 

        if (description.value.trim() === '') {
            alert('Описание статьи не может быть пустым');
            e.preventDefault();
            return false;
        }

        console.log(new FormData(form));

    };
});
