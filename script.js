document.getElementById('resumeForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const formData = {
        title: document.getElementById('title').value,
        description: document.getElementById('description').value,
        experience: document.getElementById('experience').value,
        skills: document.getElementById('skills').value,
        contacts: document.getElementById('contacts').value
    };

    fetch('/submit_resume', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
        console.log('Резюме успешно сохранено:', data);
    })
    .catch(error => {
        console.error('Ошибка сохранения резюме:', error);
    });
});
