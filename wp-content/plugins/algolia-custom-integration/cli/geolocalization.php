<?php 
class Geolocalization
{
	// Adding new Geolocalized pages
	function add_new_geolocalized()
	{
		global $algolia;
		$index = $algolia->initIndex($_ENV['ALGOLIA_GEO_INDEX']);

		$results = $index->search(null, [
			'facetFilters' => [
				"record_status:added",
				"post_type: geolocalizations"
			]
		]);

		$count = 0;
		$category_id = [];
		$postdate = date("Y-m-d", strtotime("-30 day"));
		if (is_int(term_exists('Geolocalizations', 'category')))
			array_push($category_id, term_exists('Geolocalizations', 'category'));
		else
			array_push($category_id, wp_create_category('Geolocalizations', 0));


		remove_action('save_post', 'algolia_update_post');

		foreach ($results['hits'] as $item) {

			foreach ($item['content'] as &$item_content) {

				$new_post_id = wp_insert_post(array(
					'post_title' => $item_content['title'],
					'post_content' => $item_content['body'],
					'post_type' => 'post',
					'post_status' => 'publish',
					'post_date' => $postdate,
					'post_name' => $item_content['slug'],
					'post_category' => $category_id,
					'record_status' => 'added'
				));
				if($item_content['featured_image'] != null){

					$image_url        = $item_content['featured_image']; // Define the image URL here
					$pathinfo 		  = pathinfo($image_url);
					$image_name       = $pathinfo['basename'];
					$upload_dir       = wp_upload_dir(); // Set upload folder
					$image_data       = file_get_contents($image_url); // Get image data
					$unique_file_name = wp_unique_filename( $upload_dir['path'], $image_name ); // Generate unique name
					$filename         = basename( $unique_file_name ); // Create image file name
					$image_description = $item_content['image_description'];
					$alt_tag_image = $item_content['alt_tag_image'];

					if( wp_mkdir_p( $upload_dir['path'] ) ) {
						$file = $upload_dir['path'] . '/' . $filename;
					} else {
						$file = $upload_dir['basedir'] . '/' . $filename;
					}

					file_put_contents( $file, $image_data );
					$wp_filetype = wp_check_filetype( $filename, null );
					$attachment = array(
						'post_mime_type' => $wp_filetype['type'],
						'post_title'     => sanitize_file_name( $filename ),
						'post_content'   => $image_description,
						'post_status'    => 'inherit'
					);

					$attach_id = wp_insert_attachment( $attachment, $file, $new_post_id );
					require_once(ABSPATH . 'wp-admin/includes/image.php');
					$attach_data = wp_generate_attachment_metadata( $attach_id, $file );
					wp_update_attachment_metadata( $attach_id, $attach_data );

					update_post_meta( $attach_id, '_wp_attachment_image_alt', $alt_tag_image );
					set_post_thumbnail( $new_post_id, $attach_id );
				}
				update_post_meta($new_post_id, '_yoast_wpseo_metadesc', $item_content['meta_description']);
				update_post_meta($new_post_id, '_yoast_wpseo_focuskw', $item_content['title']);

				$count++;

				$item_content['post_id'] = $new_post_id;
			}
			$index->partialUpdateObjects(
				[
					[
						'objectID'  => $item['objectID'],
						'record_status' => 'sync',
						'content' => $item['content'],
						'author' => $item['author'],
						'excerpt' => $item['except'],
						'tags' => $item['tags'],
						'url' => $item['url'],
						'custom_field' => $item['custom_field'],
					]
				]
			);
		}

		add_action('save_post', 'algolia_update_post', 10, 3);
		echo $count . " posts added to Wordpress!";
	}

	//Updating Geolocalized pages
	function update_existing_geolocalized()
	{
		global $algolia;
		$index = $algolia->initIndex($_ENV['ALGOLIA_GEO_INDEX']);

		$results = $index->search(null, [
			'facetFilters' => [

				"record_status:recently updated",
				"post_type: geolocalizations"
			]
		]);

		$count = 0;
		$postdate = date("Y-m-d", strtotime("-30 day"));
		$category_id = [];

		if (is_int(term_exists('Geolocalizations', 'category')))
			array_push($category_id, term_exists('Geolocalizations', 'category'));
		else
			array_push($category_id, wp_create_category('Geolocalizations', 0));

		remove_action('save_post', 'algolia_update_post');

		foreach ($results['hits'] as $item) {
			foreach ($item['content'] as &$item_content) {
				if ($item_content['post_id'] == 0) {
					$new_post_id = wp_insert_post(array(
						'post_title' => $item_content['title'],
						'post_content' => $item_content['body'],
						'post_type' => 'post',
						'post_status' => 'publish',
						'post_date' => $postdate,
						'post_name' => $item_content['slug'],
						'post_category' => $category_id,
						'record_status' => 'added'
					));
					if($item_content['featured_image'] != null){

						$image_url        = $item_content['featured_image']; // Define the image URL here
						$pathinfo 		  = pathinfo($image_url);
						$image_name       = $pathinfo['basename'];
						$upload_dir       = wp_upload_dir(); // Set upload folder
						$image_data       = file_get_contents($image_url); // Get image data
						$unique_file_name = wp_unique_filename( $upload_dir['path'], $image_name ); // Generate unique name
						$filename         = basename( $unique_file_name ); // Create image file name
						$image_description = $item_content['image_description'];
						$alt_tag_image = $item_content['alt_tag_image'];
	
						if( wp_mkdir_p( $upload_dir['path'] ) ) {
							$file = $upload_dir['path'] . '/' . $filename;
						} else {
							$file = $upload_dir['basedir'] . '/' . $filename;
						}
	
						file_put_contents( $file, $image_data );
						$wp_filetype = wp_check_filetype( $filename, null );
						$attachment = array(
							'post_mime_type' => $wp_filetype['type'],
							'post_title'     => sanitize_file_name( $filename ),
							'post_content'   => $image_description,
							'post_status'    => 'inherit'
						);
	
						$attach_id = wp_insert_attachment( $attachment, $file, $new_post_id );
						require_once(ABSPATH . 'wp-admin/includes/image.php');
						$attach_data = wp_generate_attachment_metadata( $attach_id, $file );
						wp_update_attachment_metadata( $attach_id, $attach_data );

						update_post_meta( $attach_id, '_wp_attachment_image_alt', $alt_tag_image );
						set_post_thumbnail( $new_post_id, $attach_id );
					}
					update_post_meta($new_post_id, '_yoast_wpseo_metadesc', $item_content['meta_description']);
					update_post_meta($new_post_id, '_yoast_wpseo_focuskw', $item_content['title']);
					
					$item_content['post_id'] = $new_post_id;

					$index->partialUpdateObjects(
						[
							[
								'objectID'  => $item['objectID'],
								'record_status' => 'sync',
								'author' => $item['author'],
								'excerpt' => $item['except'],
								'content' => $item['content'],
								'tags' => $item['tags'],
								'url' => $item['url'],
								'custom_field' => $item['custom_field'],
							]
						]
					);
					$count++;
				} else if ($item_content['post_id'] != 0) {

					$kv_edited_post = array(
						'ID'           => $item_content['post_id'],
						'post_title' => $item_content['title'],
						'post_content' => $item_content['body'],
						'post_name' => $item_content['slug'],

					);
					if($item_content['featured_image'] != null){
					
						$image_url        = $item_content['featured_image']; // Define the image URL here
						$pathinfo 		  = pathinfo($image_url);
						$image_name       = $pathinfo['basename'];
						$upload_dir       = wp_upload_dir(); // Set upload folder
						$image_data       = file_get_contents($image_url); // Get image data
						$unique_file_name = wp_unique_filename( $upload_dir['path'], $image_name ); // Generate unique name
						$filename         = basename( $unique_file_name ); // Create image file name
						$image_description = $item_content['image_description'];
						$alt_tag_image = $item_content['alt_tag_image'];

						if( wp_mkdir_p( $upload_dir['path'] ) ) {
							$file = $upload_dir['path'] . '/' . $filename;
						} else {
							$file = $upload_dir['basedir'] . '/' . $filename;
						}
	
						file_put_contents( $file, $image_data );
						$wp_filetype = wp_check_filetype( $filename, null );
						$attachment = array(
							'post_mime_type' => $wp_filetype['type'],
							'post_title'     => sanitize_file_name( $filename ),
							'post_content'   => $image_description,
							'post_status'    => 'inherit'
						);
						
						$attach_id = wp_insert_attachment( $attachment, $file, $item_content['post_id'] );
						require_once(ABSPATH . 'wp-admin/includes/image.php');
						$attach_data = wp_generate_attachment_metadata( $attach_id, $file );
						wp_update_attachment_metadata( $attach_id, $attach_data );
	
						update_post_meta( $attach_id, '_wp_attachment_image_alt', $alt_tag_image );
						set_post_thumbnail( $item_content['post_id'], $attach_id );

					}
					wp_update_post($kv_edited_post);
					$index->partialUpdateObjects(
						[
							[
								'objectID'  => $item['objectID'],
								'record_status' => 'sync',
							]
						]
					);
					$count++;
				}
			}
		}
		add_action('save_post', 'algolia_update_post', 10, 3);
		echo $count . " posts updated to Wordpress!";
	}
}
