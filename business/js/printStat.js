function printStatus(status) {
    this.statusBox = document.getElementById('statusBox');
    if (status === "signupU") { //Signup Username already taken
        this.statusBox.innerHTML = "<span class=\"fail\">Username Already Taken</span>";
    }
    if (status === "signupE") {
        this.statusBox.innerHTML = "<span class=\"fail\">A user account with that email already exists</span>"
    }
    if (status === "signupD") { //Database Error!
        this.statusBox.innerHTML = "<span class=\"fail\">Database Error</span>";
    }
    if (status === "loginF") { //Login Fail
        this.statusBox.innerHTML = "<span class=\"fail\">Username or Password is Invalid</span>";
    }
    if (status === "notA") { //Not Admin
        this.statusBox.innerHTML = "<span class=\"fail\">You are not admin</span>";
    }
    if (status === "notL") { //Not Logged In
        this.statusBox.innerHTML = "<span class=\"fail\">You are not logged in</span>";
    }
    if (status === "changePassE") {
        this.statusBox.innerHTML = "<span class=\"fail\">Email does not exist</span>";
    }
    if (status === "changePassD") {
        this.statusBox.innerHTML = "<span class=\"fail\">Database Error</span>";
    }
    if (status === "changePassS") {
        this.statusBox.innerHTML = "<span class=\"success\">Successfully changed password</span>";
    }
    if (status === "login") {
        this.statusBox.innerHTML = "<span class=\"fail\">You must login to access this content</span>"
    }
    if (status === "createCourseD") {
        this.statusBox.innerHTML = "<span class=\"fail\">Unable to create course</span>"
    }
    if (status === "createCourseS") {
        this.statusBox.innerHTML = "<span class=\"fail\">Successfully created course</span>"
    }
    if (status === "addCourseD") {
        this.statusBox.innerHTML = "<span class=\"fail\">Unable to add course</span>"
    }
    if (status === "addCourseS") {
        this.statusBox.innerHTML = "<span class=\"success\">Successfully added course</span>"
    }
    if (status === "addCourseES") {
        this.statusBox.innerHTML = "<span class=\"fail\">Student does not exist</span>"
    }
    if (status === "addCourseEC") {
        this.statusBox.innerHTML = "<span class=\"fail\">Course does not exist</span>"
    }
    if (status === "addCourseER") {
        this.statusBox.innerHTML = "<span class=\"fail\">Student already registered in course</span>"
    }
    if (status === "addCourseEM") {
        this.statusBox.innerHTML = "<span class=\"fail\">Max number of registered courses reached</span>"
    }
}