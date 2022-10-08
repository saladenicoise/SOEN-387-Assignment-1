<!DOCTYPE html">
		
		<html lang="en">
	   <head>
		      <title>Sample Database Query</title>
		      <style type = "text/css">
		         body  {  }
		         h2    { font-family: arial, sans-serif;
		                 color: blue }
		         input { background-color: white;
		                 color: black;
		                 font-weight: bold }
		      </style>
		   </head>
		   <body>
		      
			  <h2>Add Course</h2>
			  <form method = "post" action = "../../data/courses/addCourseScript.php">
			  <div>
			  <p>Course ID
			   <input name = "course_code" type = "text" size = "10"/><br /></p>
			   <p>Course Title
			   <input name = "title" type = "text" size = "40" />
			   </p><br/>
			   <p>Semester
				  <select id="semester" name="semester">
					<option value="2">Fall</option>
					<option value="4">Winter</option>
					<option value="1">Summer</option>
				  </select>
			   </p>
			   <p>Days of Course
				  <select id="days" name="days[]" size="5" multiple="multiple">
					<option value="M">Monday</option>
					<option value="T">Tuesday</option>
					<option value="W">Wednesday</option>
					<option value="R">Thursday</option>
					<option value="F">Friday</option>
				  </select>
			   </p>
			   <p>
			   Time
					<input type="time" id="time" name="time">
			   </p>

			   <p>
			   Instructor
					<input type="text" id="instructor" name="instructor">
			   </p>
			   <p>
			   Room
					<input type="text" id="room" name="room">
			   </p>
			   <br/>
			   <p>
			   Start Date
					<input type="date" id="start_date" name="start_date">
			   <br/>
			   End Date
					<input type="date" id="end_date" name="end_date">
			   </p>
			   <br/>



			    <input type = "submit" value = "Add Course" />
				</div>
			  </form>
</body>
</html>
