
    	        <?php foreach ($allAssignments as $assignment): ?>
    	        	<div id="assignment-info-<?= $assignment['id'] ?>" class="hidden child-page detailContent">
                         <span class="detailTitleLabel">Title:</span><span class="detailText"><?= $assignment['title'] ?></span><br/><br/>
                         <span class="detailTitleLabel">Due:</span><span class="detailText"><?= $assignment['due_date'] ?></span><br/><br/>
                         <span class="detailTitleLabel">Course:</span><span class="detailText"><?= $assignment['course_number'] ?></span><br/><br/>
    		             <ul id="priority" class="inlineButtonList">
    						<li id="priorityHigh" priority="3" <?= $assignment['priority']==3?'class="active"':'' ?> onclick="updatePriority(this,<?= $assignment['id'] ?>);">High</li>
    						<li id="priorityNormal" priority="2" <?= $assignment['priority']==2?'class="active"':'' ?> onclick="updatePriority(this,<?= $assignment['id'] ?>);">Normal</li>
    						<li id="priorityLow" priority="1" <?= $assignment['priority']==1?'class="active"':'' ?> onclick="updatePriority(this,<?= $assignment['id'] ?>);">Low</li>
    					</ul>
    					<div style="height:90px">
        					<form id="statusForm" style="float:left;" onclick="updateComplete(<?= $assignment['id'] ?>);">
        						<input id="statusCheckbox-<?= $assignment['id'] ?>" onclick="this.checked = !this.checked;" class="statusCheckbox" type="checkbox" name="status" value="complete" <?= $assignment['complete']?'checked':'' ?>/>
        						<a id="statusText">Completed</a>					
        					</form> 
    						<div id="saveFlash-<?= $assignment['id'] ?>" style="display:none; font-style:italic; font-weight:bold; float:left; position:relative; top:50px; left:15px; font-size:20px; color:#124">Saved</div>
    					</div>
    
    					<ul id="tabBarAssignBottomWindow" class="inlineButtonList">
    						<li id="descriptionButton" class="active" onclick="toggleAssignmentDescription(this,<?= $assignment['id'] ?>);"><a>Description</a></li>
    						<li id="announceButton" onclick="toggleAssignmentDescription(this,<?= $assignment['id'] ?>);"><a>Announcements</a></li>
    					</ul>
    					<div id="assignBottomWindow">
    						<div id="assignment-description-<?= $assignment['id'] ?>" class="coursePane" style="display:block;">
    							<?= trim($assignment['description'])==""?"<i>No description given.</i>":$assignment['description'] ?>
    						</div>
    						<div id="assignment-announcements-<?= $assignment['id'] ?>" class="announcePane" style="display:none;">
    							<i>There are currently no announcements for this assignment.</i>
    						</div>
    					</div>
                    </div>
    	       <?php endforeach; ?>
    	       
    	       