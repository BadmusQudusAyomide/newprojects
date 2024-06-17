document.addEventListener('DOMContentLoaded', function () {
    fetch('../php/get_students.php')
        .then(response => response.json())
        .then(data => {
            const studentsTable = document.getElementById('studentsTable').getElementsByTagName('tbody')[0];
            data.forEach(student => {
                const row = studentsTable.insertRow();
                row.insertCell(0).innerText = student.student_id;
                row.insertCell(1).innerText = student.name;
                const deleteCell = row.insertCell(2);
                const deleteButton = document.createElement('button');
                deleteButton.innerText = 'Delete';
                deleteButton.onclick = function () {
                    fetch(`../php/delete_student.php?id=${student.student_id}`, {
                        method: 'POST'
                    })
                    .then(response => response.text())
                    .then(data => {
                        if (data === "Student deleted successfully") {
                            row.remove();
                        } else {
                            alert("Failed to delete student");
                        }
                    });
                };
                deleteCell.appendChild(deleteButton);
            });
        });

    fetch('../php/get_attendance.php')
        .then(response => response.json())
        .then(data => {
            const attendanceTable = document.getElementById('attendanceTable').getElementsByTagName('tbody')[0];
            data.forEach(record => {
                const row = attendanceTable.insertRow();
                row.insertCell(0).innerText = record.student_id;
                row.insertCell(1).innerText = record.name;
                row.insertCell(2).innerText = record.date;
            });
        });
});
