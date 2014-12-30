
<!-- High Calculus -->

	<?php $sidebars_widgets = wp_get_sidebars_widgets();

		$i3=0;

		if ( is_active_sidebar('sidebar-20') ) { $i3++; }
		if ( is_active_sidebar('sidebar-21') ) { $i3++; }
		if ( is_active_sidebar('sidebar-22') ) { $i3++; }

		switch ($i3) {
	    case 0:
	        $width_home = '0%';
	        break;
	    case 1:
	        $width_home = '96%';
	        break;
	    case 2:
	        $width_home = '46%';
	        break;
	    case 3:
	        $width_home = '30%';
	        break;
		}


	?>

<div class="stickyc">
        <?php if (is_active_sidebar('sidebar-20')) { ?>
            <div class="stickyc-col" style="width: <?php echo $width_home; if ($i3 > 1) { echo '; border-right: 1px dotted #25385D'; } ?>;">
                <ul>
                    <?php dynamic_sidebar("sidebar-20"); ?>
                </ul>
            </div>
        <?php } ?>
        <?php if (is_active_sidebar('sidebar-21')) { ?>
            <div class="stickyc-col" style="width: <?php echo $width_home; if ($i3 == 3) { echo '; border-right: 1px dotted #25385D'; } ?>;">
                <ul>
                    <?php dynamic_sidebar("sidebar-21"); ?>
                </ul>
            </div>
        <?php } ?>
        <?php if (is_active_sidebar('sidebar-22')) { ?>
            <div class="stickyc-col" style="width: <?php echo $width_home;?>;">
                <ul>
                    <?php dynamic_sidebar("sidebar-22"); ?>
                </ul>
            </div>
        <?php } ?>
        <div class="clear"></div>
    </div>




