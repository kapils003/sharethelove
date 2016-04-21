<?php
/**
 * Template Name: User Profile Template
 *
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>
<div class="secondary-menu">
	<?php
	if (is_user_logged_in()) {
		print(' <div class="secondary-menu-logo">
			<ul>
			<li><a href="');echo home_url(); print('/activity/"><img src="');echo home_url(); print('/wp-content/uploads/2016/04/1-e1459847100362.png" title="Activity"></a></li>
			<li><a href="');echo home_url(); print('/search/"><img src="');echo home_url(); print('/wp-content/uploads/2016/04/2-e1459847082992.png" title="search"></a></li>
			<li><a href="');echo home_url(); print('/profile-page/"><img src="');echo home_url(); print('/wp-content/uploads/2016/04/3-e1459847059371.png" title="User Profile"></a></li>
			<li><a href="');echo home_url(); print('/add-projects/"><img src="');echo home_url(); print('/wp-content/uploads/2016/04/4-e1459846938556.png" title="Add Project"></a></li>
			</ul>
			</div>');
			?>
		</div>
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
				<?php
				// Start the loop.
				while ( have_posts() ) : the_post();

				// Include the page content template.
				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}

				// End of the loop.
				endwhile;
				?>
				<?php 
				$user_id = get_current_user_id();
				$image = get_user_meta($user_id ,"profile_image", true);
				$name = get_user_meta($user_id ,"first_name", true);
				$state = get_user_meta($user_id ,"State", true); 
				$city = get_user_meta($user_id ,"user-city", true);
				$home_url = home_url();
				$website = get_user_meta($user_id ,"website", true); 
				$bio = get_user_meta($user_id ,"description", true); 
				$user_profile = " ";
				$user_profile .= "<a class='profile-edit' href='".$home_url."/update-profile'>Update Profile</a>";
				$user_profile .= "<div class='user-prof-img'><div class='usr-img'><img src=".$image."></div><div class='user-prof-img-txt'>Image</div></div>";
				$user_profile .= "<div class='user-prof-main'>";
				
				$user_profile .= "<div class='user-prof-name'><div class='user-prof-name-txt'>Name:"." ".$name."</div></div>";
				$user_profile .= "<div class='user-prof-state'><div class='user-prof-state-txt'>Location:"." ".$city."(".$state.")</div></div>";
				$user_profile .= "<div class='user-prof-website'><div class='user-prof-website-txt'>Website:"." ".$website."</div></div>";
				$user_profile .= "<div class='user-prof-bio'><div class='user-prof-bio-txt'>Bio:</div><div class='usr-bio'>".$bio."</div></div>";
				$user_profile .= "</div>";

				echo $user_profile;
			}
			?>

		</main><!-- .site-main -->
	</div><!-- .content-area -->
	<h3 class="my-projects"> My Projects </h3>
	<?php 
            //get your custom posts ids as an array
	$posts = get_posts(array(
		'post_type'   => 'projects',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'fields' => 'ids'
		)
	);
			//loop over each post
	foreach($posts as $p){
			//get the meta you need from each post
		$home_url = home_url();
		$pro_h_img = get_the_post_thumbnail($p);
		$hed_img_url = wp_get_attachment_url( get_post_thumbnail_id($p) );
		$post_title = get_the_title($p);
		$role_title = get_post_meta($p,"role-title",true);
		$pro_vac = get_post_meta($p,"project-vacancies",true);
		$post_by = get_post_field( 'post_author', $p );
		$pro_loc = get_post_meta($p,"project-location",true);
		$pro_loc_pl = get_post_meta($p,"location-place",true);
		$pro_s_date = get_post_meta($p,"project-from-date",true);
		$pro_e_date = get_post_meta($p,"project-to-date",true);
		$pro_tags = get_post_meta($p,"project-tags",true);
		$pro_img1 = get_post_meta($p,"project-image-1",true);
		$pro_img2 = get_post_meta($p,"project-image-2",true);
		$pro_img3 = get_post_meta($p,"project-image-3",true);
		$pro_img4 = get_post_meta($p,"project-image-4",true);
		$pro_des = get_post_meta($p,"project-description",true);
		$pro_rol = get_post_meta($p,"role-description",true);
		$pro_fac = get_post_meta($p,"project-facilities",false);
		$pro_fac_dt = get_post_meta($p,"project-facility-details",true);
		$pro_email = get_post_meta($p,"project-email",true);
		$pro_phone = get_post_meta($p,"project-phone",true);
		$pro_mobile = get_post_meta($p,"project-mobile",true);
		$user_info = get_userdata($post_by);
		$user_id = get_current_user_id();
		if($user_id == $post_by){
			$project = " ";
			$project .= "<div class='activity-main'>";
			$project .= "<a class='manage-projects' href='".$home_url."/manage-projects'>Manage</a>";
			$project .= "<div class='header_image'><a href='".$hed_img_url."'rel='lightbox[".$p."]'>" . $pro_h_img . "</a></div>";
			$project .= "<div class='activity-desc'>";
			$project .= "<p>". $post_title .  "</p>";
			$project .= "<p>Role Title: ". $role_title .  "</p>";
			$project .= "<p>Vacancies: ". $pro_vac .  "</p>";
			$project .= "<p>Posted By: <a href='". $home_url."/user-profile-listing/?id=". $post_by ."'>" . $user_info->user_login . "</a></p>";
			$project .= "<p>Location: <a href='".$home_url."/?s=".$pro_loc_pl."'>". $pro_loc_pl . "</a>";
			$project .= "<a href='".$home_url."/?s=".$pro_loc."'>(". $pro_loc . ")</a></p>" ;
			$project .= "<p>Start Date: " . $pro_s_date . "</p>";
			$project .= "<p> Ends On: " . $pro_e_date . "</p>";
			$tags = explode(" ", $pro_tags);
			foreach($tags as $pro_tag){
				$tag_seacrh = preg_replace('/[^A-Za-z0-9\-]/', '', $pro_tag);
				$project .= "<a href='".$home_url."/?s=%23".$tag_seacrh."'>". $pro_tag . "&nbsp;</a>" ;
			}
			$project .= "</div>";
			$project .= "<div class='project-img'>";
			$project .= "<a href='".$pro_img1."'rel='lightbox[".$p."]'><img src=" . $pro_img1 . "></a>";
			$project .= "<a href='".$pro_img2."'rel='lightbox[".$p."]'><img src=" . $pro_img2 . "></a>";
			$project .= "<a href='".$pro_img3."'rel='lightbox[".$p."]'><img src=" . $pro_img3 . "></a>";
			$project .= "<a href='".$pro_img4."'rel='lightbox[".$p."]'><img src=" . $pro_img4 . "></a>";
			$project .= "</div>";
			$project .= "<div class='toggle-container'>";
			$project .= "<div class='description'>";
			$project .= "<h3>Project Description </h3>";
			$project .= "<p>". $pro_des .  "</p>";
			$project .= "</div>";
			$project .= "<div class='role-description'>";
			$project .= "<h3>Role Description </h3>";
			$project .= "<p>". $pro_rol .  "</p>";
			$project .= "</div>";
			$project .= "<div class='facilities'>";
			$project .= "<h3>Facilities:</h3>";
			$project .= "<p>" . implode($pro_fac,', ') . "</p>";
			$project .= "</div>";
			$project .= "<div class='role-description'>";
			$project .= "<h3>Details:</h3>";
			$project .= "<p>" . $pro_fac_dt . "</p>";
			$project .= "</div>";
			$project .= "<div class='contact-details'>";
			$project .= "<h3>Contact Details</h3>";
			$project .= "<p> ". $pro_email .  "</p>";
			$project .= "<p>" . $pro_phone . "</p>";
			$project .= "<p>" . $pro_mobile . "</p>";
			$project .= "</div>";
			$project .= "</div>";
			$project .= "<a class='moreshow'><span>Know More</span></a>";
			$project .= "</div>";
				//echo $project;
			echo $project;	
		}
	}
	?>
	<div class="add-project-logo">
		<a href="<?php echo home_url(); ?>/?page_id=104"><img src='<?php echo home_url(); ?>/wp-content/uploads/2016/04/4-e1459846938556.png' /></a>
		<div class="add-project">Add Project</div>
	</div>
	<?php get_footer(); ?>
