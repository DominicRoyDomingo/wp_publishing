<?php

/**
 * Plugin Name:     01 - Med4Care Algolia Integration (Read Description)
 * Plugin URI:      http://algolia.com/dashboard/
 * Description:     Add Algolia Search feature to Med4Care WP initially created for Providers and Geolocalized Pages. This plugin can do the following: ADD NEW PAGES from Algolia to this WordPress website. (Algolia -> WP). UPDATE will refresh data in WordPress (Algolia -> WP). REINDEXing will push WordPress pages to Algolia(WP -> Algolia).
 * Text Domain:     algolia-custom-integration
 * Version:         1.0.0
 * Author:          Med4Care Algolia Team
 * Author URI:      mailto:dominic.domingo@me4care.online
 *
 * @package         Algolia_Custom_Integration
 */

// Your code starts here.
// require_once __DIR__ . '/api-client/autoload.php';
// If you're using Composer, require the Composer autoload
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/wp-cli.php';
require_once __DIR__ . '/cli/geolocalization.php';
require_once __DIR__ . '/cli/actors.php';

$env_file = $_SERVER['SERVER_NAME'] == "www.med4.care" ? ".env" : ".env.development";
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__, $env_file);
$dotenv->load();

global $algolia;

if ($_ENV['ALGOLIA_APP_ID'] && $_ENV['ALGOLIA_API_KEY'])
    $algolia = \Algolia\AlgoliaSearch\SearchClient::create($_ENV['ALGOLIA_APP_ID'], $_ENV['ALGOLIA_API_KEY']);
else
    die;

if (!defined('WPINC')) {
    die;
}

define('WPPLUGIN_URL', plugin_dir_url(__FILE__));

include(plugin_dir_path(__FILE__) . 'enqueue-styles.php');

include(plugin_dir_path(__FILE__) . 'enqueue-scripts.php');

function call_add_new_geolocalized()
{
    $geolocalization = new Geolocalization();
    $add_new = $geolocalization->add_new_geolocalized();
}

function call_update_existing_geolocalized()
{
    $geolocalization = new Geolocalization();
    $update_existing = $geolocalization->update_existing_geolocalized();
}

function call_reindex_geolocalized()
{
    $geolocalization = new Geolocalization();
    $reindex = $geolocalization->reindex_geolocalized();
}
//ACTORS FUNCTION CALL

function call_add_new_actors()
{
    $actors = new Actors();
    $add_new = $actors->add_new_actors();
}

function call_update_existing_actors()
{
    $actors = new Actors();
    $update_existing = $actors->update_existing_actors();
}

function call_reindex_actors()
{
    $actors = new Actors();
    $reindex = $actors->reindex_actors();
}

function wpplugin_settings_page()
{
    add_menu_page(
        __('Med4Care Algolia Integration', 'algolia-custom-integration'),
        __('Med4Care Algolia', 'algolia-custom-integration'),
        'manage_options',
        'algolia-custom-integration',
        'wpplugin_settings_page_markup',
        'dashicons-algolia-icon',
        100
    );
}

add_action('admin_menu', 'wpplugin_settings_page');

function wpplugin_settings_page_markup()
{
    if (!current_user_can('manage_options')) {
        return;
    }
?>
    <div class="wrap algolia--wrapper">
        <h1><?php esc_html_e(get_admin_page_title());
            echo " (API Key: " . $_ENV['ALGOLIA_APP_ID'] . ")" ?></h1>
        <div class="button--containers">
            <form method="post">
                <div id="providers--buttons" class="algolia--buttons">
                    <h2><span id="providers--icon" class="algolia--icon"></span> Provider Pages (<?php echo $_ENV['ALGOLIA_PROVIDERS_INDEX'] ?>)</h2>
                    <input type="submit" class="plugin--buttons" id="new-providers--button" name="new-providers--button" value="Add new Providers" />
                    <input type="submit" class="plugin--buttons" id="update-providers--button" name="update-providers--button" value="Update Providers" />
                    <!-- HAD TO REMOVE FOR THE INITIAL PHASE -->
                    <!-- <input type="submit" class="plugin--buttons" id="reindex-providers--button" name="reindex-providers--button" value="Re-index Providers" /> -->
                </div>
                <hr />
                <div id="geolocalized--buttons" class="algolia--buttons">
                    <h2><span id="geo--icon" class="algolia--icon"></span> Geolocalized Pages (<?php echo $_ENV['ALGOLIA_GEO_INDEX'] ?>)</h2>
                    <input type="submit" onClick="return confirm('Add new Geolocalization posts in WP?')" class="plugin--buttons" id="new-geo--button" name="new-geo--button" value="Add New Geolocalized" />
                    <input type="submit" onClick="return confirm('Update Geolocalization in WP?')" class="plugin--buttons" id="new-geo--button" name="update-geo--button" value="Update Geolocalized" />
                    <!-- <input type="submit" onClick="return confirm('Re-index Geolocalization in Algolia?')" class="plugin--buttons" id="new-geo--button" name="reindex-geo--button" value="Re-index Geolocalized" /> -->
                </div>
                <hr />
                <div id="actors--buttons" class="algolia--buttons">
                    <h2><span id="actors--icon" class="algolia--icon"></span> Actors Pages (<?php echo $_ENV['ALGOLIA_ACTOR_INDEX'] ?>)</h2>
                    <input type="submit" onClick="return confirm('Add new actors posts in WP?')" class="plugin--buttons" id="new-actors--button" name="new-actors--button" value="Add New Actors" />
                    <input type="submit" onClick="return confirm('Update actors in WP?')" class="plugin--buttons" id="new-actors--button" name="update-actors--button" value="Update Actors" />
                    <!-- <input type="submit" onClick="return confirm('Re-index Actors in Algolia?')" class="plugin--buttons" id="new-actors--button" name="reindex-actors--button" value="Re-index Actors" /> -->
                </div>
                <hr />
                <div id="courses--buttons" class="algolia--buttons">
                    <h2><span id="courses--icon" class="algolia--icon"></span> Courses Pages (<?php echo $_ENV['ALGOLIA_COURSES_INDEX'] ?>)</h2>
                    <input type="submit" class="plugin--buttons courses--btn" id="new-courses--button" name="new-courses--button" value="Add new Courses" />
                    <input type="submit" class="plugin--buttons courses--btn" id="update-courses--button" name="update-courses--button" value="Update Courses" />
                    <!-- HAD TO REMOVE FOR THE INITIAL PHASE -->
                    <!-- <input type="submit" class="plugin--buttons courses--btn" id="reindex-courses--button" name="reindex-courses--button" value="Re-index Courses" /> -->
                </div>
            </form>
        </div>
        <br />
        <hr />
        <div style="background-color: #e9e9e9;">
            <h6>OUTPUT:</h6>
            <?php
            $run_command = "wp algolia ";

            // providers
            if (isset($_POST['new-providers--button'])) {
                $output = shell_exec($run_command . "add_new_providers 'Provider' --verbose 2>&1");
                echo "<pre>" . $output . "</pre>";
            }
            if (isset($_POST['update-providers--button'])) {
                $output = shell_exec($run_command . "update_existing_providers 'Provider' --verbose 2>&1");
                echo "<pre>" . $output . "</pre>";
            }
            if (isset($_POST['reindex-providers--button'])) {
                $output = shell_exec($run_command . "reindex_providers 'Provider' --verbose 2>&1");
                echo "<pre>" . $output . "</pre>";
            }


            // geolocalized
            if (isset($_POST['new-geo--button'])) {
                call_add_new_geolocalized();
            }
            if (isset($_POST['update-geo--button'])) {
                call_update_existing_geolocalized();
            }
            if (isset($_POST['reindex-geo-button'])) {
                // call_reindex_geolocalized();
                get_all_post_ID();
            }

            // actors
            if (isset($_POST['new-actors--button'])) {
                call_add_new_actors();
            }
            if (isset($_POST['update-actors--button'])) {
                call_update_existing_actors();
            }
            if (isset($_POST['reindex-actors-button'])) {
            }

            // courses
            if (isset($_POST['new-courses--button'])) {
                $output = shell_exec($run_command . "add_new_courses");
                echo "<pre>" . $output . "</pre>";
            }
            if (isset($_POST['update-courses--button'])) {
                $output = shell_exec($run_command . "update_existing_courses");
                echo "<pre>" . $output . "</pre>";
            }
            if (isset($_POST['reindex-courses--button'])) {
                $output = shell_exec($run_command . "reindex_courses");
                echo "<pre>" . $output . "</pre>";
            }
            ?>
        </div>
    </div>
<?php
}

function wpplugin_add_settings_link($links)
{
    $settings_link = '<a href="admin.php?page=algolia-custom-integration">' . __('Settings', 'algolia-custom-integration') . '</a>';
    array_push($links, $settings_link);
    return $links;
}

$filter_name = "plugin_action_links_" . plugin_basename(__FILE__);
add_filter($filter_name, 'wpplugin_add_settings_link');
?>