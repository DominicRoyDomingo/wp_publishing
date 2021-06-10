<?php 
class Actors
{
	// Adding new Geolocalized pages
	function add_new_actors()
	{
		global $algolia;
		$index = $algolia->initIndex($_ENV['ALGOLIA_ACTOR_INDEX']);

		$results = $index->search(null, [
			'facetFilters' => [
				"record_status:Added",
			]
		]);

		$count = 0;
		$category_id = [];
		$postdate = date("Y-m-d", strtotime("-30 day"));
		if (is_int(term_exists('Actors', 'category')))
			array_push($category_id, term_exists('Actors', 'category'));
		else
			array_push($category_id, wp_create_category('Actors', 0));


		remove_action('save_post', 'algolia_update_post');

		foreach ($results['hits'] as $item) {
			foreach($item['content'] as $content=>$key){
				if($content == 'title' || $content == 'firstname' || $content == 'middlename' || $content == 'surname'){
					$arr_name[] = $key;

				}
			}

			$full_name = $arr_name[0] . " " . $arr_name[1] . " " . $arr_name[2] . " " . $arr_name[3] ;

			$new_post_id = wp_insert_post(array(
				'post_title' => $full_name,
				'post_content' => json_encode($item['content']),
				'post_type' => 'post',
				'post_status' => 'publish',
				'post_date' => $postdate,
				'post_category' => $category_id,
				'record_status' => 'added'
			));
				

				$count++;
				$post_url = get_permalink( $new_post_id, false );
			$index->partialUpdateObjects(
				[
					[
						'objectID'  => $item['objectID'],
						'record_status' => 'sync',
						'brand' => $item['brand'],
						'content' => $item['content'],
						'post_id' => $new_post_id,
						'post_url' => $post_url,
					]
				]
			);
			unset($arr_name);
		}

		add_action('save_post', 'algolia_update_post', 10, 3);
		echo $count . " posts added to Wordpress!";
	}

	//Updating Geolocalized pages
	function update_existing_actors()
	{
		global $algolia;
		$index = $algolia->initIndex($_ENV['ALGOLIA_ACTOR_INDEX']);

		$results = $index->search(null, [
			'facetFilters' => [

				"record_status:recently updated",
			]
		]);

		$count = 0;
		$postdate = date("Y-m-d", strtotime("-30 day"));
		$category_id = [];

		if (is_int(term_exists('Actors', 'category')))
			array_push($category_id, term_exists('Actors', 'category'));
		else
			array_push($category_id, wp_create_category('Actors', 0));

		remove_action('save_post', 'algolia_update_post');

		foreach ($results['hits'] as $item) {
			foreach($item['content'] as $content=>$key){
				if($content == 'title' || $content == 'firstname' || $content == 'middlename' || $content == 'surname'){
					$arr_name[] = $key;

				}
			}

			$full_name = $arr_name[0] . " " . $arr_name[1] . " " . $arr_name[2] . " " . $arr_name[3] ;

			$kv_edited_post = array(
				'ID' => $item['post_id'],
				'post_title' => $full_name,
				'post_content' => json_encode($item['content']),

			);

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
			unset($arr_name);

		}
			
		add_action('save_post', 'algolia_update_post', 10, 3);
		echo $count . " posts updated to Wordpress!";
	}
}
