<div id="copyText">
    <div class="leftBox">
        <div>© 2014 - <?php echo date('Y'); ?> ecDB - Created by <a href="http://nilsf.se">Nils Fredriksson</a> Edit by Andrey Shamis</div>
        <div class="stats">
            <?php
                $member_q   = $db->query("SELECT member_id FROM members");
                $data_q     = $db->query("SELECT id FROM data");
                $project_q  = $db->query("SELECT project_id FROM projects");
            ?>
        	<?php $members = $db->count($member_q); echo $members; ?>
			<span class="boldText">members</span>,

			<?php $components = $db->count($data_q); echo $components; ?>
			<span class="boldText">components </span>and

			<?php $projects = $db->count($project_q); echo $projects; ?>
			<span class="boldText">projects</span>.

        </div>
    </div>
    <div class="rightBox">
        Design by <span class="blIcon"></span>
    </div>
</div>
