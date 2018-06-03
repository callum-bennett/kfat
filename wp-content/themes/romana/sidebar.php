<?php 
/**
 * sidebar template file
**/ ?>
<div class="col-md-4 col-sm-4 col-xs-12 blog-sidebar">
    <?php if (is_active_sidebar('sidebar-1')) {
        dynamic_sidebar('sidebar-1');
    } ?>
</div>