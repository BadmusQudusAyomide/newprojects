const addCourseButton = document.getElementById("add-course-btn");
const coursesContainer = document.getElementById("courses");

let courseCount = 0;

function createCourseElement() {
  courseCount++;

  const newCourse = document.createElement("div");
  newCourse.classList.add("course");

  const courseTitle = document.createElement("h3");
  courseTitle.innerText = `Course ${courseCount}`;
  newCourse.appendChild(courseTitle);

  const courseDetails = document.createElement("div");
  courseDetails.classList.add("course-details");

  const daysSelect = document.createElement("select");
  const days = ["M", "Tu", "W", "Th", "F"];
  days.forEach((day) => {
    const option = document.createElement("option");
    option.value = day;
    option.text = day;
    daysSelect.appendChild(option);
  });
  courseDetails.appendChild(daysSelect);

  const timeInput = document.createElement("input");
  timeInput.type = "time";
  courseDetails.appendChild(timeInput);

  const professorInput = document.createElement("input");
  professorInput.type = "text";
  professorInput.placeholder = "Professor Name";
  courseDetails.appendChild(professorInput);

  const locationInput = document.createElement("input");
  locationInput.type = "text";
  locationInput.placeholder = "Location";
  courseDetails.appendChild(locationInput);

  const deleteButton = document.createElement("button");
  deleteButton.innerText = "Delete";
  deleteButton.addEventListener("click", function () {
    coursesContainer.removeChild(newCourse);
    saveSchedule(); // Call save function on course deletion
  });
  courseDetails.appendChild(deleteButton);

  newCourse.appendChild(courseDetails);
  coursesContainer.appendChild(newCourse);

  return newCourse;
}

addCourseButton.addEventListener("click", function () {
  createCourseElement();
});

// Load schedule from local storage on page load
function loadSchedule() {
  const savedSchedule = localStorage.getItem("studySchedule");
  if (savedSchedule) {
    const courses = JSON.parse(savedSchedule); // Parse JSON string back to objects
    courses.forEach((courseData) => {
      const newCourse = createCourseElement(); // Create course element
      // Set course details from loaded data
      newCourse.querySelector("select").value = courseData.day;
      newCourse.querySelector('input[type="time"]').value = courseData.time;
      newCourse.querySelector(
        'input[type="text"][placeholder="Professor Name"]'
      ).value = courseData.professor;
      newCourse.querySelector(
        'input[type="text"][placeholder="Location"]'
      ).value = courseData.location;
    });
  }
}

// Save schedule to local storage on course changes
function saveSchedule() {
  const courses = [];
  const courseElements = coursesContainer.querySelectorAll(".course");
  courseElements.forEach((course) => {
    const courseData = {
      day: course.querySelector("select").value,
      time: course.querySelector('input[type="time"]').value,
      professor: course.querySelector(
        'input[type="text"][placeholder="Professor Name"]'
      ).value,
      location: course.querySelector(
        'input[type="text"][placeholder="Location"]'
      ).value,
    };
    courses.push(courseData);
  });
  localStorage.setItem("studySchedule", JSON.stringify(courses)); // Convert objects to JSON string
}

loadSchedule(); // Call load function on page load
