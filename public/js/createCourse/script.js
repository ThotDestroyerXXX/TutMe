const subjectButtons = document.querySelectorAll('.subject-btn');
const subjectImage = document.getElementById('subjectImage');
const previewSubject = document.getElementById('previewSubject');
const previewTitle = document.getElementById('previewTitle');
const previewTopics = document.getElementById('previewTopics');
const previewSession = document.getElementById('previewSession');
const titleInput = document.getElementById('titleInput');
const addTopic = document.getElementById('addTopic');
const removeTopic = document.getElementById('removeTopic');
const topicsContainer = document.getElementById('topicsContainer');
const sessionButtons = document.querySelectorAll('.session-btn');
const levelButtons = document.querySelectorAll('.level-btn');
let topicCount = 1;

function setActiveButton(group, clickedButton) {
    group.forEach(btn => btn.classList.remove('btn-active'));
    clickedButton.classList.add('btn-active');
}

subjectButtons.forEach(btn => {
    btn.addEventListener('click', () => {
        const subject = btn.dataset.subject;
        previewSubject.innerText = subject;
        subjectImage.src = `/Resources/${subject.toLowerCase()}.png`;
        setActiveButton(subjectButtons, btn);
    });
});

titleInput.addEventListener('input', () => {
    previewTitle.innerText = titleInput.value || 'Title';
});

topicsContainer.addEventListener('input', () => {
    previewTopics.innerHTML = '';
    document.querySelectorAll('.topicInput').forEach(input => {
        if (input.value.trim() !== '') {
            const li = document.createElement('li');
            li.textContent = input.value;
            previewTopics.appendChild(li);
        }
    });
});

addTopic.addEventListener('click', () => {
    if (topicCount < 4) {
        topicCount++;
        const input = document.createElement('input');
        input.type = 'text';
        input.name = 'topics[]';
        input.classList.add('form-control', 'topicInput');
        input.placeholder = `Enter topic ${topicCount}`;
        input.style.marginBottom = '0.5rem';
        topicsContainer.appendChild(input);
    }
});

removeTopic.addEventListener('click', () => {
    if (topicCount > 1) {
        topicsContainer.removeChild(topicsContainer.lastElementChild);
        topicCount--;

        previewTopics.innerHTML = '';
        document.querySelectorAll('.topicInput').forEach(input => {
            if (input.value.trim() !== '') {
                const li = document.createElement('li');
                li.textContent = input.value;
                previewTopics.appendChild(li);
            }
        });
    }
});

sessionButtons.forEach(btn => {
    btn.addEventListener('click', () => {
        const session = btn.dataset.session;
        previewSession.innerText = `${session} Sesi / ${60 * session} Menit`;
        setActiveButton(sessionButtons, btn);
    });
});

levelButtons.forEach(btn => {
    btn.addEventListener('click', () => {
        setActiveButton(levelButtons, btn);
    });
});

subjectButtons.forEach(btn => {
    btn.addEventListener('click', () => {
        document.getElementById('subjectInput').value = btn.dataset.subject;
    });
});

sessionButtons.forEach(btn => {
    btn.addEventListener('click', () => {
        document.getElementById('sessionInput').value = btn.dataset.session;
    });
});

levelButtons.forEach(btn => {
    btn.addEventListener('click', () => {
        document.getElementById('levelInput').value = btn.dataset.level;
    });
});

function deleteBtn(courseId) {
    if (confirm('Are you sure you want to delete this course?')) {
        document.getElementById('deleteForm-' + courseId).submit();
    }
}