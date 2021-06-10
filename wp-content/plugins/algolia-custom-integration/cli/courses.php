<?php

class Courses
{
    private static function get_courses_header($title)
    {
        return "<header id='course__header'>
                    <article class='box'>
                        <section class='box__title--header'>
                            <h1>" . $title . "</h1>
                        </section>
                    </article>
                </header>";
    }

    private static function get_courses_info($content)
    {
        $course_type_index = 0;
        $course_type_list = "";

        foreach ($content['course_type'] as $course_type) {
            $course_type_list .= $course_type;
            ++$course_type_index;

            if ($course_type_index == count($content['course_type']) - 1) {
                $course_type_list .= ", ";
            }
        }

        $website = "";

        foreach ($content['other_info'] as $other_info) {
            $info_type = $other_info['information_type']['it'] ? $other_info['information_type']['it'] : $other_info['information_type']['en'];
            if ($info_type == "Website") {
                $website = $other_info['value'];
            }
        }

        $course_date_text = "";
        // start - end
        $course_date_from = "";
        $course_date_to = "";
        $course_date_from_text = "";
        $course_date_to_text = "";
        // avail start - avail end
        $course_avail_start_date = "";
        $course_avail_end_date = "";
        $course_avail_start_text = "";
        $course_avail_end_text = "";

        foreach ($content['course_date'] as $course_date) {
            if (strcasecmp($course_date['date_type'], "Data inizio corso") == 0)
                $course_date_from = $course_date['value'];

            if (strcasecmp($course_date['date_type'], "Data fine corso") == 0)
                $course_date_to = $course_date['value'];

            if (strcasecmp($course_date['date_type'], "Data inizio disponibilità corso") == 0) {
                $course_avail_start_date = $course_date['value'];
            }

            if (strcasecmp($course_date['date_type'], "Data fine disponibilità corso") == 0) {
                $course_avail_end_date = $course_date['value'];
            }
        }

        if ($course_date_from != "" || $course_date_to != "") {
            if ($course_date_from == $course_date_to) {
                $course_date_text .= $course_date_from;
            } else {
                $course_date_from_text .= $course_date_from ? "dal " . $course_date_from : "";
                $course_date_to_text .= $course_date_to ? " al " . $course_date_to : "";

                $course_date_text =  $course_date_from_text .
                    $course_date_to_text;
            }
        } else {
            if ($course_avail_start_date == $course_avail_end_date) {
                $course_date_text .= $course_avail_start_date;
            } else {
                $course_avail_start_text .= $course_avail_start_date ? "corso disponibile dal " . $course_avail_start_date : "";
                $course_avail_end_text .= $course_avail_end_date ? " al " . $course_avail_end_date : "";

                $course_date_text = $course_avail_start_text . $course_avail_end_text;
            }
        }

        $course_type_detail = $course_type_list != "" ? "<li><i class='fas fa-chalkboard-teacher fw fa-lg'></i> " . $course_type_list . "</li>" : "";
        $course_duration_detail = $content['duration'] ? "<li><i class='far fa-clock fw fa-lg'></i> " . $content['duration'] . " ore</li>" : "";
        $course_date_detail = $course_date_text != "" ? "<li><i class='far fa-calendar-alt fw fa-lg'></i> " . $course_date_text . "</li>" : "";
        $course_credits_detail = $content['ecm_credits'] ? "<li><i class='fas fa-award fw fa-lg'></i> " . $content['ecm_credits'] . " crediti ECM</li>" : "";
        $course_price_detail = $content['price'] ? "<li><i class='far fa-credit-card fw fa-lg'></i> &euro;" . $content['price'] . "</li>" : "";
        $course_website_detail = $website ? "<li><i class='fas fa-external-link-alt fw fa-lg'></i>Per maggiori informazioni: " . $website . "</li>" : "";
        $course_address_detail = $content['address'] ? "<li><i class='fas fa-map-marker-alt fw fa-lg'></i>" . $content['address'] . "</li>" : "";

        return "<article class='box'>
                    <section class='box__container--course-info'>
                        <div class='box__container--course-items'>
                            <img src='https://www.med4.care/wp-content/uploads/2021/02/temporomandibular-joint-cousr-article-thumbnail-size.jpg' />
                        </div>
                        <div class='box__container--course-items'>
                            <h2 class=' box__container--info-title'>Informazioni sul corso</h2>
                            <ul>" .
            $course_type_detail .
            $course_duration_detail .
            $course_date_detail .
            $course_credits_detail .
            $course_price_detail .
            $course_website_detail .
            $course_address_detail .
            "</ul>
                        </div>
                    </section>
                </article>";
    }

    private static function get_courses_other_info($content)
    {

        $other_info_list = "";
        foreach ($content['other_info'] as $other_info) {
            $info_type = $other_info['information_type']['it'] ? $other_info['information_type']['it'] : $other_info['information_type']['en'];
            $other_info_list .= "<li>" . $info_type . ": " . $other_info['value'] . "</li>";
        }

        $author_list = "";
        foreach ($content['authors'] as $author) {
            $auth_type = $author['author_type']['it'] ? $author['author_type']['it'] : $author['author_type']['en'];
            $author_list .= "<li>" . $author['name']['firstname'] . " " . $author['name']['middlename'] . " " . $author['name']['surname'] . " - " . $auth_type . "</li>";
        }

        $destinatari_list = "";
        foreach ($content['destinatari'] as $destinatari) {
            $dest_name = $destinatari['name']['it'] ? $destinatari['name']['it'] : $destinatari['name']['en'];
            $destinatari_list .= "<li><img src='" . $destinatari['icon'] . "' class='course__sidebar--icon'/>" . $dest_name . "</li>";
        }

        $discipline_list = "";
        foreach ($content['disciplin_ecm'] as $discipline) {
            $dscp_name = $discipline['name']['it'] ? $discipline['name']['it'] : $discipline['name']['en'];
            $discipline_list .= "<li><img src='" . $discipline['icon'] . "' class='course__sidebar--icon'/>" . $dscp_name . "</li>";
        }

        return "<div id='course__body--other-info' class='box'>
                    <article class='box'>
                        <div class='box__container--tab-container'>
                            <div class='box__container--tab-buttons'>
                                <div class='box__container--tab-button active' data-tab='0'>DESCRIZIONE</div>
                                <div class='box__container--tab-button' data-tab='1'>OBIETTIVI</div>
                                <div class='box__container--tab-button' data-tab='2'>PROGRAMMA</div>
                                <div class='box__container--tab-button' data-tab='3'>ALTRE INFORMAZIONI</div>
                            </div>
                            <div class='box__container--tab-contents'>
                                <div class='box__container--tab-content active' data-tab-content='0'>" . $content['description'] . "</div>
                                <div class='box__container--tab-content' data-tab-content='1'>" . $content['objectives'] . "</div>
                                <div class='box__container--tab-content' data-tab-content='2'>" . $content['program'] . "</div>
                                <div class='box__container--tab-content' data-tab-content='3'><ul>" . $content['rationale'] . "</ul></div>
                            </div>
                        </div>
                    </article>
                    <article class='box'>
                        <section class='box__container box__sidebar--courses'>
                            <div class='box__container--12 box__container--accordion'>
                                <div class='box__container--accordion-title-container'>
                                    <i class='fas fa-chalkboard-teacher fw fa-lg'></i>
                                    <h6 class='box__container--accordion-title'>
                                        Docenti e Responsabili Scientifici
                                    </h6>
                                    <i class='fas fa-chevron-down fa-xs box__container--accordion-icon'></i>
                                </div>
                                <div class='box__container--accordion-content'>
                                    <ul>" . $author_list . "</ul>
                                </div>
                            </div>
                            <div class='box__container--12 box__container--accordion'>
                                <div class='box__container--accordion-title-container'>
                                    <i class='fas fa-user-friends fw fa-lg'></i>
                                    <h6 class='box__container--accordion-title'>
                                        Destinatari
                                    </h6>
                                    <i class='fas fa-chevron-down fa-xs box__container--accordion-icon'></i>
                                </div>
                                <div class='box__container--accordion-content'>
                                    <ul>" . $destinatari_list . "</ul>
                                </div>
                            </div>
                            <div class='box__container--12 box__container--accordion'>
                                <div class='box__container--accordion-title-container'>
                                    <i class='fas fa-user-graduate fw fa-lg'></i>
                                    <h6 class='box__container--accordion-title'>
                                        Discipline
                                    </h6>
                                    <i class='fas fa-chevron-down fa-xs box__container--accordion-icon'></i>
                                </div>
                                <div class='box__container--accordion-content'>
                                    <ul>" . $discipline_list . "</ul>
                                </div>
                            </div>
                        </section>
                    </article>
                </div>";
    }

    public static function get_courses_body($content)
    {
        return "<article id='course__body'>
                    " . Courses::get_courses_info($content) . "
                    " . Courses::get_courses_other_info($content) . "
                </article>";
    }

    public static function get_courses_footer()
    {
        return "<footer id='course__footer'>
                    <article class='box'>
                        <section class='box__container--footer'>
                            <div class='box__container--footer-content'>
                                Sei Responsabile del corso e vuoi aiutarci a migliorare le informazioni qui pubblicate? Sei un organizzatore di corsi e vuoi pubblicare la pagina del tuo corso?
                            </div>
                            <div class='box__container--footer-content'>
                                <a target='_new' href='/form-provider'>Clicca qui</a>
                            </div>
                        </section>
                    </article>
                </footer>";
    }

    private static function get_courses_content($title, $content)
    {
        return
            Courses::get_courses_header($title) . "
            " . Courses::get_courses_body($content) . "    
            " . Courses::get_courses_footer();
    }

    public function add_new_courses()
    {
        global $algolia;
        $index = $algolia->initIndex($_ENV['ALGOLIA_COURSES_INDEX']);

        $results = $index->search(null, [
            'facetFilters' => [
                "record_status:Added",
            ]
        ]);

        $count = 0;

        $category_id = [];

        $category_name = "Corso";

        if (is_int(term_exists($category_name, 'category')))
            array_push($category_id, term_exists($category_name, 'category'));
        else
            array_push($category_id, wp_create_category($category_name, 0));

        remove_action('save_post', 'algolia_update_post');

        $progress = \WP_CLI\Utils\make_progress_bar('Adding ' . $category_name, 20);
        foreach ($results['hits'] as $item) {
            $title = $item['title']['it'] ? $item['title']['it'] : $item['title']['en'];

            $content = Courses::get_courses_content(gettype($title) == "string" ? $item['title'] : $title, $item['content']);

            $new_post_id = wp_insert_post(array(
                'post_title' => gettype($title) == "string" ? $item['title'] : $title,
                'post_content' => $content,
                'post_type' => 'post',
                'post_status' => 'publish',
                'post_category' => $category_id,
                'post_date' => date("Y-m-d H:i:s", strtotime("-1 month")),
            ));


            $index->partialUpdateObjects(
                [
                    [
                        'objectID'  => $item['objectID'],
                        'title' => $item['title'],
                        'meta_description' => $item['meta_description'],
                        'slug' => $item['slug'],
                        'alt_tag_image' => $item['alt_tag_image'],
                        'image_description' => $item['image_description'],
                        'record_status' => 'sync',
                        'brand' => $item['brand'],
                        'content' => $item['content'],
                        'post_id' => $new_post_id,
                        'url' => get_permalink($new_post_id),
                    ]
                ]
            );

            $count++;
            $progress->tick();
        }
        $progress->finish();

        add_action('save_post', 'algolia_update_post', 10, 3);

        WP_CLI::success("$count new $category_name to Med4Care");
    }
    // end

    public function update_existing_courses($args, $assoc_args)
    {
        global $algolia;
        $index = $algolia->initIndex($_ENV['ALGOLIA_COURSES_INDEX']);

        $results = $index->search(null, [
            'facetFilters' => [
                "record_status:recently updated",
            ]
        ]);

        $count = 0;

        $category_id = [];

        $category_name = "Corso";

        if (is_int(term_exists($category_name, 'category')))
            array_push($category_id, term_exists($category_name, 'category'));
        else
            array_push($category_id, wp_create_category($category_name, 0));

        remove_action('save_post', 'algolia_update_post');

        $progress = \WP_CLI\Utils\make_progress_bar('Updating ' . $category_name, 20);
        foreach ($results['hits'] as $item) {
            $title = $item['title']['it'] ? $item['title']['it'] : $item['title']['en'];

            $content = Courses::get_courses_content(gettype($title) == "string" ? $item['title'] : $title, $item['content']);

            $updated_id = wp_update_post(array(
                'ID' => $item['post_id'],
                'post_title' => gettype($title) == "string" ? $item['title'] : $title,
                'post_content' => $content,
                'post_type' => 'post',
                'post_status' => 'publish',
                'post_category' => $category_id,
                'post_date' => date("Y-m-d H:i:s", strtotime("-1 month")),
            ));

            $index->partialUpdateObjects(
                [
                    [
                        'objectID'  => $item['objectID'],
                        'title' => $item['title'],
                        'meta_description' => $item['meta_description'],
                        'slug' => $item['slug'],
                        'alt_tag_image' => $item['alt_tag_image'],
                        'image_description' => $item['image_description'],
                        'record_status' => 'sync',
                        'brand' => $item['brand'],
                        'content' => $item['content'],
                        'post_id' => $updated_id,
                        'url' => get_permalink($updated_id),
                    ]
                ]
            );
            $count++;
        }
        $progress->finish();

        add_action('save_post', 'algolia_update_post', 10, 3);

        WP_CLI::success("Updated $count $category_name to Med4Care");
    }

    public function reindex_courses($args, $assoc_args)
    {
        global $algolia;
        $index = $algolia->initIndex($_ENV['ALGOLIA_COURSES_INDEX']);

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
}
