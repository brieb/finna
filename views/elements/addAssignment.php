

				<form>
	                <span class="detailTitleLabel">Title:</span><input type="text" id="assignTitleField" name="assignTitle" class="detailText textInput"/><br/><br/>
	                <span class="detailTitleLabel">Due:</span><span id="assignDueDate" class="detailText" onclick="openDatePicker()"><a id="add-assignment-date">Choose date...</a></span><br/><br/>
	                <span class="detailTitleLabel">Course:</span>
	                <select id="assignCourseSelection">
        		        <?php foreach ($userCourses as $course): ?>
    	                	<option value ="<?= $course['id'] ?>"><?= $course['number'] ?></option>
        		        <?php endforeach; ?>
	                </select>	                
	                <br/><br/>	                
	                <span class="detailTitleLabel">Description:</span><br/>
	                <textarea id="assignDescriptionTextArea" placeholder="Textarea" ></textarea><br/>
	                <input id="assignSubmit" type="button" onclick="addAssignment()" value="Submit" />
				</form>
				<div id="add-feedback"></div>