# IMPORTANT
Make sure that in your project you have the directory name where the github repo is cloned into as the following "SOEN_387_A1" otherwise, the email link will not work

## index.php
This is the main index page, the page that does not require user authentication. If the user attempts to access the main page without being logged in, they will be redirected to the login page

## mainPage.php
This is the page that requires user authentication, when logged in a session is created and the "login" property is set, if this property is not met, then it will redirect to login