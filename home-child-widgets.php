<?php 
  $i4=0;
  if ( is_active_sidebar('sidebar-23') ) { $i4++; }
  
  switch ($i4) {
  	case 0:
    	$width_sticky = '0%';
        break;
    case 1:
       $width_sticky = '96%';
       break;

   }
?>

<?php if (is_active_sidebar('sidebar-23')) { ?>   
	<div class="stickyc">
	   	<div class="stickyc-col" style="width: <?php echo $width_sticky; ?>;">
            <ul>
                <?php dynamic_sidebar("sidebar-23"); ?>
            </ul>
        </div>
    	<div class="clear"></div>
   </div>
<?php } ?>
   
   
   

