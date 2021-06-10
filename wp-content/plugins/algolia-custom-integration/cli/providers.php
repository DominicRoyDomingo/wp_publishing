<?php

class Providers
{
    public function add_new_providers($args, $assoc_args)
    {
        global $algolia;
        $index = $algolia->initIndex($_ENV['ALGOLIA_PROVIDERS_INDEX']);

        $results = $index->search(null, [
            'facetFilters' => [
                "record_status:added",
            ]
        ]);

        $count = 0;

        $category_id = [];

        if (is_int(term_exists($args[0], 'category')))
            array_push($category_id, term_exists($args[0], 'category'));
        else
            array_push($category_id, wp_create_category($args[0], 0));

        remove_action('save_post', 'algolia_update_post');

        $progress = \WP_CLI\Utils\make_progress_bar('Adding ' . $args[0], 20);
        foreach ($results['hits'] as $item) {
            $new_post_id = wp_insert_post(array(
                'post_title' => $item['title'],
                'post_content' => $item['content'],
                'post_type' => 'post',
                'post_status' => 'publish',
                'post_category' => $category_id,
                'post_date' => date("Y-m-d H:i:s", strtotime("-1 month")),
            ));


            $index->partialUpdateObjects(
                [
                    [
                        'objectID'  => $item['objectID'],
                        'record_status' => 'sync',
                        'post_id' => $new_post_id,
                        'title' => $item['title'],
                        'author' => $item['author'],
                        'excerpt' => $item['except'],
                        'content' => $item['content'],
                        'tags' => $item['tags'],
                        'url' => get_permalink($new_post_id),
                        'custom_field' => $item['custom_field'],
                    ]
                ]
            );

            $count++;
            $progress->tick();
        }
        $progress->finish();

        add_action('save_post', 'algolia_update_post', 10, 3);

        WP_CLI::success("$count new $args[0] to Med4Care");
    }
    // end

    public function reindex_providers($args, $assoc_args)
    {
        global $algolia;
        $index = $algolia->initIndex($_ENV['ALGOLIA_PROVIDERS_INDEX']);

        $index->clearObjects()->wait();

        $paged = 1;
        $count = 0;

        do {
            $posts = new WP_Query([
                'posts_per_page' => 100,
                'paged' => $paged,
                'post_type' => 'post',
                'category_name' => $args[0]
            ]);

            if (!$posts->have_posts()) {
                break;
            }

            $records = [];

            foreach ($posts->posts as $post) {
                if ($assoc_args['verbose']) {
                    WP_CLI::line('Serializing [' . $post->post_title . ']');
                }
                $record = (array) apply_filters('post_to_record', $post);

                if (!isset($record['objectID'])) {
                    $record['objectID'] = implode('#', [$post->post_type, $post->ID]);
                }

                $records[] = $record;
                $count++;
            }

            if ($assoc_args['verbose']) {
                WP_CLI::line('Sending batch');
            }

            $index->saveObjects($records);

            $paged++;
        } while (true);

        WP_CLI::success("$count $args[0] re-indexed in Algolia");
    }

    public function update_existing_providers($args, $assoc_args)
    {
        global $algolia;
        $index = $algolia->initIndex($_ENV['ALGOLIA_PROVIDERS_INDEX']);

        $results = $index->search(null, [
            'facetFilters' => [
                "record_status:recently updated",
            ]
        ]);

        $count = 0;

        $category_id = [];

        if (is_int(term_exists($args[0], 'category')))
            array_push($category_id, term_exists($args[0], 'category'));
        else
            array_push($category_id, wp_create_category($args[0], 0));

        remove_action('save_post', 'algolia_update_post');

        $progress = \WP_CLI\Utils\make_progress_bar('Updating ' . $args[0], 20);
        foreach ($results['hits'] as $item) {
            $updated_id = wp_update_post(array(
                'ID' => $item['post_id'],
                'post_title' => $item['title'],
                'post_content' => $item['content'],
                'post_type' => 'post',
                'post_status' => 'publish',
                'post_category' => $category_id,
                'record_status' => 'added'
            ));

            $index->partialUpdateObjects(
                [
                    [
                        'objectID'  => $item['objectID'],
                        'record_status' => 'sync',
                        'post_id' => $updated_id,
                        'title' => $item['title'],
                        'author' => $item['author'],
                        'excerpt' => $item['except'],
                        'content' => $item['content'],
                        'tags' => $item['tags'],
                        'url' => get_permalink($updated_id),
                        'custom_field' => $item['custom_field'],
                    ]
                ]
            );

            $count++;
            $progress->tick();
        }
        $progress->finish();

        add_action('save_post', 'algolia_update_post', 10, 3);

        WP_CLI::success("Updated $count $args[0] to Med4Care");
    }
}
