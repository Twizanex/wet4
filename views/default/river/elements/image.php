<?php
/**
 * Elgg river image
 *
 * Displayed next to the body of each river item
 *
 * @uses $vars['item']
 */

$item = $vars['item'];
/* @var ElggRiverItem $item */

$subject = $item->getSubjectEntity();
if(elgg_get_context() !== 'widgets'){
  if (elgg_in_context('widgets')) {
	echo elgg_view_entity_icon($subject, 'medium');
} else {
	echo elgg_view_entity_icon($subject, 'medium');
}  
}else{
 if (elgg_in_context('widgets')) {
	echo elgg_view_entity_icon($subject, 'small');
} else {
	echo elgg_view_entity_icon($subject, 'small');
}   
}

