
<?php
/**
 * Suggested groups
 *@package ElggGroups
 * Sidebar
 */
$groups = group_tools_get_suggested_groups(elgg_get_logged_in_user_entity(), 9);

if (!empty($groups)) {
	echo "<ul class='elgg-gallery group-tools-suggested-groups'>";
	
	foreach ($groups as $group) {
		
		$group_url = $group->getURL();
		
		$join_url = "action/groups/join?group_guid={$group->getGUID()}";
		
		if ($group->isPublicMembership() || $group->canEdit()) {
			$join_text = elgg_echo("groups:join");
		} else {
			// request membership
			$join_text = elgg_echo("groups:joinrequest");
		}
        //Groups status
        if ($group->isPublicMembership()) {
		  $mem = elgg_echo("groups:open");
        } else {
		  $mem = elgg_echo("groups:closed");
        }
        //Number of members
    $num_members = $group->getMembers(array('count' => true));
	$members_string = elgg_echo('groups:member');
	$options = array(
		'name' => 'members',
		'text' => $num_members . ' ' . $members_string,
		'href' => false,
		'priority' => 200,
	);
	$return[] = ElggMenuItem::factory($options); 
        
        
		$content = "<li><div>";
		
		$content .= '<div class="mrgn-lft-md mrgn-rght-md pull-left">'.elgg_view("output/url", array("text" => elgg_view_entity_icon($group, "small"), "href" => $group_url)).'</div>';
        
        $content .= '<span class="mrgn-lft-md pull-left">' .elgg_view("output/url", array("text" => $group->name, "href" => $group_url)).'</span></br>';     
        $content .= '<div class=""><cite><i>'.$mem.' '.$num_members.' '.$members_string.'</i></cite></div>'; 
		$content .= "<div class='mrgn-lft-xl'><p class='clearfix mrgn-tp-lg'>" . elgg_view("output/text", array("value" => $group->briefdescription)) . "</p></div>";  
		$content .= "<div>" . elgg_view("output/url", array("text" => $join_text, "href" => $join_url, "is_action" => true, "class" => "elgg-button elgg-button-action")) . "</div>";
		$content .= "</div></li>";
	}
		
	$content .= "</ul>";
}
echo elgg_view_module('aside', elgg_echo("group_tools:groups:sorting:suggested"), $content);