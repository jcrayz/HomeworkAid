function detectID() {
    var url = "manageCourses.php";
    var courseSelector = document.getElementById("selectCourse");
    var courseID = document.getElementById("selectCourse").value;
    var hash = "?courseID=" + courseID;
    window.location.href = url + hash;
}

function deleteCourse(course) {
    if (confirm("Are you sure you want to delete this course?") == true) {
        window.location.href = "deleteCourse.php?courseID=" + course;
    } else {
        window.location.href = "manageCourses.php";
    }
}

function completeHomework(homework) {
    if (confirm("Do you want to mark this assignment as completed?") == true) {
        window.location.href = "completeAssignment.php?homeworkID=" + homework;
    } else {
        window.location.href = "view.php";
    }
}

function reminder(numMilestones) {
    if (document.getElementById("addReminder").checked) {
        if (confirm("You want to add a reminder?") == true) {
            numMilestones++;
            var hwName = document.getElementById("hwName").value;
            var due = document.getElementById("dueDate").value;
            var courseCode = document.getElementById("courseCode").value;
            var url = "addHW.php?courseCode=" + courseCode + "&numMilestones=" + numMilestones + "&hwTitle=" + hwName + "&due=" + due;
            window.location.href = url;
        } else {
            window.location.href = "manageCourses.php";
        }
    }
}
