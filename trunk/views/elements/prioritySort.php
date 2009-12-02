
<?php 
    $priorityImages = array("", "priority_green.png", "priority_yellow.png", "priority_red.png");
    $priorityPositions = array("", "top:12px; left:6px; height:20px;", "top:12px; left:6px; height:20px;", "top:12px; left:6px; height:20px;");
?>
            <?php if (empty($assignmentsByPriority)):?>
            <?php else: ?>
			    <ul>
			        <?php foreach ($assignmentsByPriority as $assignment): ?>
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