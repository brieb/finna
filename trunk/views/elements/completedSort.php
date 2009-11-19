
<?php 
    $priorityImages = array("", "low-priority.png", "normal-priority.png", "high-priority.png");
    $priorityPositions = array("", "top:12px; left:6px; height:23px;", "top: 15px; left: 8px;", "top:8px; left:12px; height:33px;")
?>
            <?php if (empty($completedAssignments)):?>
            	You have no completed assignments.
            <?php else: ?>
			    <ul>
			        <?php foreach ($completedAssignments as $assignment): ?>
                        <li loc="assignment-info-<?= $assignment['id'] ?>" header="assignment-header" class="scrollable" style="font-family:Helvetica">
                        	<div class="row-selection-BG">
                        	</div>
                            <img src="/finna/img/<?= $priorityImages[$assignment['priority']] ?>" style="position:absolute; <?= $priorityPositions[$assignment['priority']] ?>"/>
                            <div class="li-assignment-name">
                                <?= $assignment['title'] ?>
                            </div>
            				<div class="li-course-number">
            					<?= $assignment['course_number'] ?>
            				</div>
            				<div class="li-due-date">
            					<?= $assignment['due_date'] ?>
            				</div>
                            <div class="li-arrow-template"></div>
                        </li>
                    <?php endforeach; ?>
			    </ul>
			<?php endif; ?>