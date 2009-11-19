

	        <?php foreach ($userCourses as $course): ?>
	        	<div id="course-info-<?= $course['id'] ?>" courseId="<?= $course['id'] ?>" class="hidden child-page detailContent">
	        	     <span class="detailTitleLabel">Course:</span><span class="detailText"><?= $course['number'] ?></span><br/><br/>
	        	     <span class="detailTitleLabel">Title:</span><span class="detailText"><?= $course['title'] ?></span><br/><br/>
                     
                     <ul id="tabBarCourseBottomWindow" class="roundRectangleListType">
						<li id="descriptionButton" class="active"><a class="showArrow" loc="">Description</a></li>
						<li id="officeHoursButton"><a class="showArrow">Office Hours</a></li>
						<li id="handoutsButton"><a class="showArrow">Handouts</a></li>
						<li id="announcementsButton"<a class="showArrow">Announcements</a></li>
					</ul>
					<div id="courseBottomWindow" style="display:none;">
						<div id="description" style="display:none;">
							<?= $course['description'] ?>
						</div>
						<div id="officeHours" style="display:none;">
							officeHours Pane
						</div>
						<div id="handouts" style="display:none;">
							handouts Pane
						</div>
						<div id="announcements" style="display:none;">
							announcements Pane
						</div>
					</div>
                </div>
	        <?php endforeach; ?>