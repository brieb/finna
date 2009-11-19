

    		    <ul>
    		        <?php foreach ($userCourses as $course): ?>
        			    <li loc="course-info-<?= $course['id'] ?>" header="course-header" id="course-li-<?= $course['id'] ?>" class="scrollable">
            			    <div class="row-selection-BG" style="position: absolute; right: 0pt; left: 0pt; top: 0pt; bottom: 0pt; opacity: 1; display:none;"></div>
                            <div class="label_template">
                                <?= $course['number'] ?>
                            </div>
                            <div class="arrow_template"></div>
                        </li>
    		        <?php endforeach; ?>
    		    </ul>