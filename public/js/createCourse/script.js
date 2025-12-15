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
const dayButtons = document.querySelectorAll('.day-btn');
const link = document.getElementById('link');
const timeInput = document.getElementById('timeInput');
const button = document.getElementById('createNewCourseBtn');
let topicCount = 1;
let isTopic;
let isDayValid = false;

document.querySelectorAll('.day-btn').forEach(btn => {
    btn.addEventListener('click', e => {
        if (btn.classList.contains('locked')) return;
        e.preventDefault();
        const checkbox = btn.querySelector('.day-checkbox');
        checkbox.checked = !checkbox.checked;
        btn.classList.toggle('btn-active', checkbox.checked);
        isDayValid = checkbox.checked;
        validateForm();
    });
});

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
    validateForm();
});

topicsContainer.addEventListener('input', () => {
    previewTopics.innerHTML = '';
    document.querySelectorAll('.topicInput').forEach(input => {
        isTopic = input.value;
        validateForm();
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

link.addEventListener('input', () => {
    validateForm();
})

timeInput.addEventListener('change', () => {
    validateForm();
});

sessionButtons.forEach(btn => {
    btn.addEventListener('click', () => {
        const session = btn.dataset.session;
        previewSession.innerText = `${session} Sesi / ${60 * session} Menit`;
        setActiveButton(sessionButtons, btn);
        validateForm();
    });
});

levelButtons.forEach(btn => {
    btn.addEventListener('click', () => {
        setActiveButton(levelButtons, btn);
        validateForm();
    });
});

subjectButtons.forEach(btn => {
    btn.addEventListener('click', () => {
        document.getElementById('subjectInput').value = btn.dataset.subject;
        validateForm();
    });
});

sessionButtons.forEach(btn => {
    btn.addEventListener('click', () => {
        document.getElementById('sessionInput').value = btn.dataset.session;
        validateForm();
    });
});

levelButtons.forEach(btn => {
    btn.addEventListener('click', () => {
        document.getElementById('levelInput').value = btn.dataset.level;
        validateForm();
    });
});

function validateForm(){
    const selectedSubject = document.getElementById('subjectInput').value;
    const sessionInput = document.getElementById('sessionInput').value;
    const levelInput = document.getElementById('levelInput').value;
    const regex = /^https:\/\/.*$/;

    if(selectedSubject != '' && isDayValid && isTopic.trim() != '' && titleInput.value != '' && sessionInput != '' && levelInput != ''  && timeInput.value != ''  && regex.test(link.value) ){
        button.removeAttribute('disabled');
    }else{
        button.disabled = true;
    }
}
