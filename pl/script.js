document.getElementById('task-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const taskName = document.getElementById('task-name').value;
    const taskDate = document.getElementById('task-date').value;

    if (taskName && taskDate) {
        addTask(taskName, taskDate);
        document.getElementById('task-form').reset();
    }
});

function addTask(name, date) {
    const taskList = document.getElementById('tasks');
    const li = document.createElement('li');
    
    li.innerHTML = `
        <span>${name}</span>
        <span class="task-date">${new Date(date).toLocaleString()}</span>
    `;
    
    taskList.appendChild(li);
}