
			
<?php 
    $priorityImages = array("", "priority_green.png", "priority_yellow.png", "priority_red.png");
    $priorityPositions = array("", "top:12px; left:6px; height:20px;", "top:12px; left:6px; height:20px;", "top:12px; left:6px; height:20px;");
?>
            <?php if (empty($assignmentsByDue)):?>
            <?php else:
            $i = 0;
            $pages = count($assignmentsByDue)-1;
            foreach ($assignmentsByDue as $page):
            ?>
            
                <ul id="dueSortPage-<?= $i ?>"<?= $i!=0?' style="display:none;"':'' ?>>
                	<?php if ($i!=0): ?>
                        <li class="scrollable" ontouchend="$('#dueSortPage-<?= $i ?>').css('display','none'); $('#dueSortPage-<?= $i-1 ?>').css('display','block');" style="font-family:Helvetica; height:35px;">
                        	<div class="row-selection-BG">
                        	</div>
                        	<div style="text-align:center; font-size:20px; font-weight:bold; vertical-align:middle; padding-top:7px; color:#124;">Previous</div>
                        	<div class="li-arrow-template" style="top:12px; left:104px; background-image: url(/finna/img/chevron-left.png);"></div>
                        </li>
                    <?php else: ?>
                        <li class="scrollable" style="font-family:Helvetica; height:35px;">
                        </li>
                    <?php endif; ?>
                    
                    <?php foreach ($page as $assignment): ?>
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
                	<?php if ($i!=$pages): ?>
                    <li class="scrollable" ontouchend="$('#dueSortPage-<?= $i ?>').css('display','none'); $('#dueSortPage-<?= $i+1 ?>').css('display','block');" style="font-family:Helvetica; height:35px;">
                    	<div class="row-selection-BG">
                    	</div>
                    	<div class="pageButton" style="text-align:center; font-size:20px; font-weight:bold; vertical-align:middle; padding-top:7px; color:#124;">
                    		Next
                    	</div>
                        <div class="li-arrow-template" style="top:12px; left:187px;"></div>
                    </li>
                    <?php endif; ?>
                </ul>
			<?php 
			    $i ++;
			endforeach;
			endif; ?>
			