

	        <?php foreach ($userCourses as $course): ?>
	        	<div id="course-info-<?= $course['id'] ?>" courseId="<?= $course['id'] ?>" class="hidden child-page detailContent">
	        	     <table>
	        	     	<tbody>
	        	     		<tr>
	        	     			<td><span class="detailTitleLabel">Course:</span></td>
	        	     			<td><div class="detailText"><?= $course['number'] ?></div></td>
	        	     		</tr>
	        	     		<tr>
	        	     			<td><span class="detailTitleLabel">Title:</span></td>
	        	     			<td><div class="detailText"><?= $course['title'] ?></div></td>
	        	     		</tr>
	        	     	</tbody>
	        	     </table>
	        	     <table style="margin-top: 8px;">
	        	     	<tbody>
	        	     		<tr>
	        	     			<td colspan="2">
    	        	     			<span class="detailTitleLabel">Description:</span><br/>
    	        	     			<div style="margin-top:5px;" class="detailText"><?= $course['description'] ?></div>
	        	     			</td>
	        	     		</tr>
	        	     	</tbody>
	        	     </table>
	        	     <table style="margin-top: 5px;">
	        	     	<tbody>
	        	     		<tr>
	        	     			<td><span class="detailTitleLabel">Office Hours:</span></td>
	        	     			<td><div class="detailText">None listed.</div></td>
	        				</tr>
	        	     		<tr>
	        	     			<td><span class="detailTitleLabel">Announcements:</span></td>
	        	     			<td><div class="detailText">None</div></td>
	        	     		</tr>
	        	     	</tbody>
	        	     </table>
	        	   
                </div>
	        <?php endforeach; ?>