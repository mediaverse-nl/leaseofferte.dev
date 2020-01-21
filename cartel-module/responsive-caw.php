<?php
include_once 'responsive-caw-admin.php';
include_once 'responsive-caw-visual-composer.php';

/**
 * The class responsible for checking of the plugin has an update.
 */
require_once dirname(__FILE__) . '/vendor/autoload.php';
//require_once plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';


/**
 * Plugin Name: Cartel Auto-Webshop
 * Description: Dit is de vernieuwde responsive Cartel Auto-Webshop WordPress plugin. Deze plugin bevat ook de Auto-Webshop zoekwidget.
 * Version: 1.8.3
 * Author: Cartel Internet en Marketing
 * Author URI: https://www.cartel.nl
 * Author Email: support@cartel.nl
 *
 * Examples:
 *
 * [autowebshop configuratiecode="1" merkmodelselectie="volkswagen"]
 * [autowebshop configuratiecode="1" merkmodelselectie="volkswagen|golf"]
 * [autowebshop configuratiecode="1" merkmodelselectie="volkswagen" voertuigsoort="bedrijfswagen"]
 */
class responsive_caw {
    private $responsive_caw_admin;
    private $page;
    private $get;
    private $mapperUrl = array();
    private $ccid;
    private $target_url;
    private $debug = false; // Show debug messages
    function __construct() {
        // Session already started?
        if (strlen(session_id()) < 1) {
            session_start();
        }

        // Class with admin methods
        $responsive_caw_admin = new responsive_caw_admin();

        // Class with Visual Composer methods
        $responsive_caw_visual_composer = new responsive_caw_visual_composer();

        // Set up our hooks
        add_action('admin_menu', array($responsive_caw_admin, 'caw_admin_menu'));
        add_action('admin_enqueue_scripts', array($responsive_caw_admin, 'caw_admin_style'));

        // Plugin activation / deactivation hooks
        register_activation_hook(__FILE__, array($responsive_caw_admin, 'caw_admin_activate'));
        register_activation_hook(__FILE__, array($responsive_caw_admin, 'caw_admin_activate_create_table'));
        register_deactivation_hook(__FILE__, array($responsive_caw_admin, 'caw_admin_deactivate'));

        // Filter hooks to set slug, query vars, title and meta tag
        add_filter('query_vars', array($this, 'caw_rewrite_add_var'));

        // Disable yoast SEO plugin for caw
        add_filter('wpseo_canonical', array($this, 'caw_wpseo_canonical'));

        add_filter('wpseo_title', array($this, 'caw_set_wp_title'));
        add_action('wp_head', array($this, 'caw_set_wp_head'));
        add_action('generate_rewrite_rules', array($this, 'caw_rewrite_rules'));
        add_action('vc_before_init', array($responsive_caw_visual_composer, 'caw_integrate_with_vc'));

        // This hook is one effective place to do stuff before WordPress does any routing, processing, or handling
        add_action('wp', array($this, 'caw_parse_request'));

        // Triggered whenever a post or page is created or updated
        // Used to add caw rewrite rules
        add_action('save_post', array($this, 'caw_save_post_rewrite_rules'));

        // Add shortcodes
        add_shortcode('autowebshop', array( $this, 'caw_content'));
        add_shortcode('autowebshopzoekwidget', array( clone $this, 'caw_search_widget_content'));
        add_shortcode('autowebshopgreepaanbod', array( clone $this, 'caw_offer_content'));
        add_shortcode('autowebshopweekauto', array( clone $this, 'caw_offer_content'));
    }

    /**
     * Disable yoast SEO plugin for caw
     */
    public function caw_wpseo_canonical($canonical) {
        // Disable yoast SEO canonical tag on caw detail page
        if ($this->caw_get_page() == 'detail') {
            return false;
        }

        return $canonical;
    }

    /**
     * Triggered by generate_rewrite_rules()
     *
     * When rewrite rules are changed, wordpress drops all rewrite rules: generate those again for caw
     */
    public function caw_rewrite_rules($wp_rewrite) {
        // Get all posts
        $posts = get_posts(array('post_type' => 'any', 'nopaging' => true));

        // Loop pages for shortcodes
        foreach ($posts as $post) {
            // Add rewrite rules when caw shortcode has been found
            if (has_shortcode($post->post_content, 'autowebshop')) {
                // Caw shortcode found: add rewrite rules
                $rewrite_rules = $this->caw_add_rewrite_rules($post);

                // Always add our rules to the top, to make sure our rules have priority
                foreach ($rewrite_rules as $rewrite_rule) {
                    $wp_rewrite->rules = $rewrite_rule + $wp_rewrite->rules;
                }
            }
        }
    }

    /**
     * Add caw rewrite rules for the given post / page
     *
     * Used by caw_save_post_rewrite_rules() hook
     */
    function caw_add_rewrite_rules($post) {
        $rules	= array();
        $result	= array();

        // Get parents for this slug
        $slug  = $this->build_parent_slug($post);

        // Add post name to slug
        $slug .= $post->post_name;

        if (!empty($slug)) {
            // Rewrite to (base url)
            $base	= 'index.php?' . ($post->post_type == 'post' ? 'name=' : 'pagename=') . $slug;

            // Rewrite from
            // Page slug where caw is included
            $slug	= '^' . $slug . '/';

            $page	= '([0-9]+)/?';
            $favo	= 'favorieten';
            $vehi	= '(.*)/(.*)/(.*)/(.*)/([0-9]+)';
            $vesl	= $slug . $vehi; // vehicle slug
            $driv	= '/proefrit';
            $id		= '/(.*)/?';
            $off	= '/offerte';
            $priv	= '/private-lease';
            $oper	= '/operational-lease';
            $fina   = '/financial-lease';
            $bid	= '/doe-een-bod';
            $hist	= '/onderhoudshistorie-opvragen';
            $call	= '/bel-mij-terug';
            $than	= '/caw-bedankt';
            $seo	= '(.*)/?';
            $str	= '/(.*)'; // string

            $rules[] = array($slug . $page . '$'				=> $base . '&pagina=$matches[1]');

            $rules[] = array($slug . $favo						=> $base . '&cawpage=favorites');

            $rules[] = array($vesl . '/?$'						=> $base . '&cawpage=detail&id=$matches[5]');

            $rules[] = array($vesl . $driv . '/?$'				=> $base . '&cawpage=testdrive&id=$matches[5]');
            $rules[] = array($vesl . $driv . $id . '$'			=> $base . '&cawpage=testdrive&id=$matches[5]&sessionId=$matches[6]');

            $rules[] = array($vesl . $off . '/?$'				=> $base . '&cawpage=offer&id=$matches[5]');
            $rules[] = array($vesl . $off . $id . '$'			=> $base . '&cawpage=offer&id=$matches[5]&sessionId=$matches[6]');

            $rules[] = array($vesl . $priv . '/?$'				=> $base . '&cawpage=privatelease&id=$matches[5]');
            $rules[] = array($vesl . $priv . $id . '$'			=> $base . '&cawpage=privatelease&id=$matches[5]&sessionId=$matches[6]');

            $rules[] = array($vesl . $oper . '/?$'				=> $base . '&cawpage=operationallease&id=$matches[5]');
            $rules[] = array($vesl . $oper . $id . '$'			=> $base . '&cawpage=operationallease&id=$matches[5]&sessionId=$matches[6]');

            $rules[] = array($vesl . $fina . '/?$'				=> $base . '&cawpage=financiallease&id=$matches[5]');
            $rules[] = array($vesl . $fina . $id . '$'			=> $base . '&cawpage=financiallease&id=$matches[5]&sessionId=$matches[6]');

            $rules[] = array($vesl . $bid . '/?$'				=> $base . '&cawpage=bid&id=$matches[5]');
            $rules[] = array($vesl . $bid . $id . '$'			=> $base . '&cawpage=bid&id=$matches[5]&sessionId=$matches[6]');

            $rules[] = array($vesl . $hist . '/?$'				=> $base . '&cawpage=maintenance-history&id=$matches[5]');
            $rules[] = array($vesl . $hist . $id . '$'			=> $base . '&cawpage=maintenance-history&id=$matches[5]&sessionId=$matches[6]');

            $rules[] = array($vesl . $call . '/?$'				=> $base . '&cawpage=callme&id=$matches[5]');
            $rules[] = array($vesl . $call . $id . '$'			=> $base . '&cawpage=callme&id=$matches[5]&sessionId=$matches[6]');

            $rules[] = array($vesl . $than . '/?$'				=> $base . '&cawpage=thanks&id=$matches[5]');
            $rules[] = array($vesl . $than . $str . $id . '$'	=> $base . '&cawpage=thanks&id=$matches[5]&sessionId=$matches[7]');
            $rules[] = array($vesl . $than . $id . '$'			=> $base . '&cawpage=thanks&id=$matches[5]');

            $rules[] = array($slug . $seo . '$'					=> $base . '&seoFilters=$matches[1]'); // I.e. to preset search param: http://www.caw.nl/auto-webshop/audi/a4

            // Set correct order of rewrite rules
            foreach ($rules as $rule) {
                $result = $this->prepend($rule, $result);
            }
        }

        return $result;
    }

    /**
     * Prepend $source to $target to array
     */
    function prepend($source, $target) {
        array_unshift($target, $source);

        return $target;
    }

    /**
     * Handle caw ajax requests (url?method=)
     */
    function caw_parse_request() {
        // In case of an ajax call (method param in url)
        if ($this->caw_get_method()) {
            $this->caw_ajax_call();
        }

        // Store $_GET which will be sent to caw
        if (isset($_GET) && !empty($_GET)) {
            $this->get = $_GET;
        }
    }

    /**
     * Handle caw ajax requests
     *
     * This function dies because we don't want to output wordpress stuff
     */
    function caw_ajax_call() {
        switch ($this->caw_get_method()) {
            case 'set-view-mode':
                if (isset($_POST['view']) && in_array($_POST['view'], array('photo', 'list'))) {
                    $expire = time() + 60 * 60 * 24 * 30;

                    setcookie('caw4_view_mode', $_POST['view'], $expire);
                }

                die();
                break;
            case 'add-to-favorites':
                $vehicles = array();

                if (isset($_POST['vehicle_id'])) {
                    if (isset($_COOKIE['caw4_favorites'])) {
                        $vehicles = array_values((array)json_decode(stripslashes($_COOKIE['caw4_favorites'])));
                    }

                    if (!in_array($_POST['vehicle_id'], $vehicles)) {
                        $vehicles[] = $_POST['vehicle_id'];
                    }

                    $expire = time() + 60 * 60 * 24 * 30;

                    setcookie('caw4_favorites', json_encode($vehicles), $expire);
                }

                echo json_encode(array('total' => count($vehicles)));

                die();
                break;
            case 'delete-from-favorites':
                if (isset($_POST['vehicle_id'])) {
                    if (isset($_COOKIE['caw4_favorites'])) {
                        $vehicles = array_values((array)json_decode(stripslashes($_COOKIE['caw4_favorites'])));
                        $vehicles = array_diff($vehicles, array($_POST['vehicle_id']));

                        $expire = time() + 60 * 60 * 24 * 30;

                        setcookie('caw4_favorites', json_encode($vehicles), $expire);

                        echo json_encode(array('total' => count($vehicles)));
                    }
                }

                die();
                break;
        }
    }

    /**
     * Add rewrite rules if needed
     */
    function caw_save_post_rewrite_rules($post_id) {
        $post = get_post($post_id);

        // Add rewrite rules when caw shortcode has been found
        if (has_shortcode($post->post_content, 'autowebshop')) {
            // This will trigger generate_rewrite_rules() which will trigger caw_rewrite_rules()
            flush_rewrite_rules();
        }
    }

    /*
     * True if caw shortcode has been found
     */
    private function has_caw_shortcode() {
        global $wp_query;

        // Get current post id
        $post_id = $wp_query->post->ID;

        if ($post_id > 0) {
            // Get current post / page
            $post = get_post($post_id);

            // True if caw shortcode has been found
            return has_shortcode($post->post_content, 'autowebshop');
        }

        return false;
    }

    /**
     * Add stuff to the html head
     */
    function caw_set_wp_head() {
        global $wp_query;
        global $wpdb;

        // Get current post id
        if(!empty($wp_query->post)){
            $post_id = $wp_query->post->ID;

            if ($post_id > 0) {

                // Get current post / page
                $post = get_post($post_id);

                // Add css and meta when caw shortcode has been found
                if (has_shortcode($post->post_content, 'autowebshop')) {
                    // Parse shortcode
                    $atts = shortcode_parse_atts($post->post_content);

                    // Set configuratiecode
                    if (!isset($this->ccid)) {
                        foreach ($atts as $key => $value) {
                            $lazy = !empty($value) && strpos($value, 'configuratiecode') !== false;
                            if (($key === 'configuratiecode' && !empty($value)) || $lazy) {
                                if ($lazy) {
                                    // Strip ccid
                                    $value = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
                                }

                                $this->ccid = $value;

                                break;
                            }
                        }
                    }

                    // Get meta data
                    $meta = $this->caw_get_meta_data();

                    // Send 404 header
                    if($meta->status_code == 404 && $this->caw_get_page() == 'detail') {
                        $wp_query->set_404();
                        status_header(404);
                    }

                    // Get Vehicle ID out of URL

                    $url = explode( '/', trim( $_SERVER["REQUEST_URI"],"/" ) );
                    $vehicleId = end ( $url );


                    // See if our Vehicleid exists
                    if( is_numeric ( $vehicleId ) && !empty ($vehicleId) ) {
                        if(isset($meta->title)) {
                            $wpdb->replace(
                                $wpdb->prefix . 'caw4_cars',
                                array(
                                    'car_id' => $vehicleId,
                                    'title' => $meta->title,
                                    'last_visit' => date('Y-m-d H:i:s')
                                ),
                                array(
                                    '%d',
                                    '%s',
                                    '%s'
                                )

                            );
                        }
                    }


                    // Add meta description tag to html head
                    if (!empty($meta->description)) {
                        echo '<meta name="description" content="' . $meta->description . '">' . PHP_EOL;
                    }

                    // Add canonical tag to html head
                    if (!empty($meta->canonical)) {
                        echo '<link rel="canonical" href="' . $meta->canonical . '" />' . PHP_EOL;
                    }

                    // Open Graph
                    if(isset($meta->openGraph)) {
                        foreach ( (array) $meta->openGraph as $property => $value) {
                            if($property == 'og:url' && empty($value)) {
                                $value = $this->caw_get_protocol() . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                            }

                            echo '<meta property="' . $property . '" content="' . $value . '" />' . chr(10);
                        }
                    }

                    $cssFiles = $this->caw_get_content('css');


                    if (!empty($cssFiles)) {
                        foreach($cssFiles as $cssFile) {
                            echo '<link href="' . $cssFile->href . '" type="' . $cssFile->type . '" rel="' . $cssFile->rel . '" />' . PHP_EOL;
                        }
                    }
                }

                if (has_shortcode($post->post_content, 'autowebshopzoekwidget')) {
                    // Parse shortcode
                    $atts = shortcode_parse_atts($post->post_content);


                    // Set configuratiecode
                    if (!isset($this->ccid)) {
                        foreach ($atts as $key => $value) {
                            if ($key === 'configuratiecode' && !empty($value)) {
                                $this->ccid = $value;

                                break;
                            }
                        }
                    }

                    $cssFiles = $this->caw_get_content('css');

                    if(!empty($cssFiles)) {
                        if ( ! wp_style_is('caw-theme-style', $list = 'enqueued' ) ) {
                            wp_enqueue_style( 'caw-theme-style', $cssFiles[0]->href);
                        }
                        if ( ! wp_style_is('caw-base-theme', $list = 'enqueued' ) ) {
                            wp_enqueue_style( 'caw-base-theme', $cssFiles[1]->href);
                        }
                    }
                }
                if (has_shortcode($post->post_content, 'autowebshopgreepaanbod')) {
                    // Parse shortcode
                    $atts = shortcode_parse_atts($post->post_content);

                    // Set configuratiecode
                    if (!isset($this->ccid)) {
                        foreach ($atts as $key => $value) {
                            if ($key === 'configuratiecode' && !empty($value)) {
                                $this->ccid = $value;

                                break;
                            }
                        }
                    }

                    $cssFilesGetRemote = wp_remote_get($this->caw_get_url() . 'assets/css?ccid=' . $this->ccid . '&baseUrl=' . $this->caw_get_baseurl());

                    if( is_array($cssFilesGetRemote) ) {
                        $cssFiles = json_decode($cssFilesGetRemote['body']);

                        if(!empty($cssFiles)) {
                            if ( ! wp_style_is('caw-theme-style', $list = 'enqueued' ) ) {
                                wp_enqueue_style( 'caw-theme-style', $cssFiles[0]->href);
                            }
                            if ( ! wp_style_is('caw-base-theme', $list = 'enqueued' ) ) {
                                wp_enqueue_style( 'caw-base-theme', $cssFiles[1]->href);
                            }
                        }
                    }

                    if ( ! wp_script_is('equal-height-js', $list = 'enqueued' ) ) {
                        wp_register_script( 'equal-height-js', plugin_dir_url( __FILE__ ) . "js/jQueryEqualHeight.js", false, '1', true );
                        wp_enqueue_script('equal-height-js');
                    }
                    if ( ! wp_script_is('unveil-js', $list = 'enqueued' ) ) {
                        wp_register_script( 'unveil-js', plugin_dir_url( __FILE__ ) . "js/unveil.js", false, '1', true );
                        wp_enqueue_script('unveil-js');
                    }
                    if ( ! wp_script_is('caw-get-offer-js', $list = 'enqueued' ) ) {
                        wp_register_script( 'caw-get-offer-js', plugin_dir_url( __FILE__ ) . "js/caw-get-offer.js", false, '1', true );
                        wp_enqueue_script('caw-get-offer-js');
                    }
                }
            } else {
                // 404 is generated by Wordpress
            }
        }
    }

    /**
     * Set html title with fallback to original wordpress title
     */
    function caw_set_wp_title($title) {

        if (stristr($_SERVER['REQUEST_URI'], 'wp-admin')) {
            return $title;
        }

        global $wpdb;
        global $wp_query;

        // Get current post id
        if(!empty($wp_query->post)){
            $post_id = $wp_query->post->ID;

            if ($post_id > 0) {
                $post = get_post($post_id);

                if (has_shortcode($post->post_content, 'autowebshop')) {

                    $url = explode( '/', trim( $_SERVER["REQUEST_URI"],"/" ) );
                    $vehicleId = end ( $url );

                    if( is_numeric ( $vehicleId ) && !empty ($vehicleId) ) {
                        $tableName = $wpdb->prefix . 'caw4_cars';
                        $sql = $wpdb->prepare( "SELECT * FROM $tableName WHERE car_id = %d ", $vehicleId);
                        $vehicleData = $wpdb->get_row( $sql, ARRAY_A );
                    }

                }
            }
        }

        // Add caw title, use wordpress title as fallback
        if (empty($vehicleData['title'])) {
            return $title;
        }

        return $vehicleData['title'];
    }

    /**
     * A page / post can have parents: we need to include these in the rewrite url
     */
    function build_parent_slug($post) {
        $slug = '';

        // Get an array of Ancestors and Parents if they exist
        $parents = get_post_ancestors($post->ID);

        foreach ($parents as $parent_id) {
            $parent = get_post($parent_id);

            $slug = $parent->post_name . '/' . $slug;
        }

        return $slug;
    }

    /**
     * Pass url $_GET variables to wordpress
     */
    function caw_rewrite_add_var($vars) {
        $vars[] = 'pagina';
        $vars[] = 'cawpage';
        $vars[] = 'id';
        $vars[] = 'seoFilters';
        $vars[] = 'sessionId';
        $vars[] = 'method';

        return $vars;
    }

    /**
     * Get seoFilters from url
     *
     * I.e. to preset search param: http://www.caw.nl/auto-webshop/audi/a4
     */
    function caw_get_mapper() {
        // Try to get param seoFilters from url
        $seoFilters = $this->caw_get_seoFilters();

        // Is the param seoFilters present in the url?
        if ($seoFilters) {
            $get = array('seoFilters' => $seoFilters);
            return json_encode($get);
        } else {
            // Get $_GET key / value pairs
            $get = empty($this->get) ? array() : $this->get;

            $mapper = empty($this->mapperUrl) ? array() : $this->mapperUrl;

            // Merge $_GET and mapper param
            $get = array_merge($mapper, $get);

            if ($this->caw_get_page() == 'detail') {
                $get = array_merge($get, $mapper);
            }


            // Get pagination (url.nl/1 url.nl/2 etc)
            $pagination = $this->caw_get_pagination();

            $additional = array();
            if (!empty($pagination)) {
                $additional['pagina'] = $pagination;
            }

            $get = array_merge($get, $additional);

            return empty($get) ? '' : json_encode($get);
        }
    }

    /**
     * Get view mode from cookie
     */
    function caw_get_view() {
        return isset($_COOKIE['caw4_view_mode']) ? stripslashes($_COOKIE['caw4_view_mode']) : null;
    }

    /**
     * Get favorites from cookie
     */
    function caw_get_vehicle_ids() {
        return isset($_COOKIE['caw4_favorites']) ? stripslashes($_COOKIE['caw4_favorites']) : null;
    }

    /**
     * Render CAW (overview, detail etc)
     */
    function caw_content($atts) {
        $content = $this->caw_get_content('', $atts);

        return $this->caw_render($content , 'caw');
    }

    /**
     * Render CAW search widget
     */
    function caw_search_widget_content($atts) {
        $content = $this->caw_get_content('searchwidget', $atts);

        return $this->caw_render($content, 'caw-search-widget');
    }

    /**
     * Render CAW Greep uit ons aanbod
     */
    function caw_offer_content($atts) {
        // Used for debugging
        if ($this->debug) {
            echo ' <strong>Shortcode found</strong>: autowebshopgreepaanbod ';
            echo '<br /><br />';
        }


        $content = $this->caw_get_offer_content($atts);

        if($content->view == 'weekly') {
            return $this->caw_render($content, 'caw-weekly-offer');
        }else {
            return $this->caw_render($content, 'caw-offer');
        }
    }

    /**
     * Render caw template with given content
     */
    function caw_render($content, $template) {
        ob_start();

        include('views/' . $template . '.php');

        $output = ob_get_contents();

        ob_end_clean();

        return $output;
    }


    /**
     * Get meta title and meta description
     */
    function caw_get_meta_data() {
        $meta = $this->caw_get_content('meta');

        return $meta;
    }

    /**
     * Get caw clientConfigurationId
     */
    function caw_get_ccid() {
        return $this->ccid;
    }

    /**
     * Get caw version
     */
    function caw_get_version() {
        return get_option('caw4_version');
    }


    /**
     * Get caw include url
     */
    function caw_get_url() {
        return get_option('caw4_url');
    }

    /**
     * Get PHP session hash
     */
    function caw_get_session_id_hash() {
        return md5(session_id());
    }

    /*
     * Get pagination
     *
     * url.nl/1 -> rewrite to url.nl/pagina=1
     */
    function caw_get_pagination() {
        return get_query_var('pagina');
    }

    /**
     * Get caw page from url, use a default as fallback
     */
    function caw_get_page() {
        if (isset($this->page) && !empty($this->page)) {
            $page = $this->page;
        } else {
            $page = get_query_var('cawpage');
        }

        return empty($page) ? 'overview' : $page;
    }

    /**
     * Get cav id from url
     */
    function caw_get_id() {
        $id = get_query_var('id');

        return empty($id) ? '' : '/' . $id;
    }

    /**
     * Get sessionid from url
     */
    function caw_get_session_id() {
        $sessionId = get_query_var('sessionId');

        return empty($sessionId) ? '' : '/' . $sessionId;
    }

    /**
     * Get method param from url
     */
    function caw_get_method() {
        return get_query_var('method');
    }

    /**
     * Get seoFilters param from url
     */
    function caw_get_seoFilters() {
        return strtolower(get_query_var('seoFilters'));
    }

    /**
     * Returns used protocol
     */
    function caw_get_protocol() {
        $is_secure = false;

        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
            $is_secure = true;
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' || !empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on') {
            $is_secure = true;
        }

        return $is_secure ? 'https://' : 'http://';
    }

    /**
     * Get base url
     */
    function caw_get_baseurl() {
        // Get current post / page url
        $url = get_permalink();

        // If no http(s) found: add protocol
        if (strpos($url, 'http') === false) {
            // Add protocol
            $url = $this->caw_get_protocol() . $url;
        }

        // Used for debugging
        if ($this->debug) {
            echo ' baseurl: ';
            var_dump($url);
            echo ' ';
        }

        return $url;
    }

    /**
     * Get remote caw url for requested wordpress caw page (overview / detail etc)
     *
     * Used by caw_get_content() which uses this url to get caw content
     */
    function get_cawpage_url($page, $atts = '') {
        // Get ccID
        if (empty($this->ccid)) {
            $this->ccid = isset($atts['configuratiecode']) ? $atts['configuratiecode'] : '';
        }

        // Parse shortcode target_url attribute
        $targetUrl = isset($atts['autowebshoppagina']) ? trim($atts['autowebshoppagina'],"/") : '';
        $targetUrl = str_replace(site_url('/'), '', $targetUrl);

        $this->target_url = site_url('/') . $targetUrl;


        // Default query string for autowebshop
        $default_query_string = '?ccid=[ccid]&mapper=[mapper]&view=[view]&baseUrl=[baseurl]&sessionHash=[sessionhash]&favoriteVehicles=[vehicles]';

        switch ($page) {
            default:
            case 'overview':

                $url = '';

                $mapper = $this->caw_get_mapper();

                // Only do this once
                // After first request mapper is set in the url so we don't need to use the shortcode params anymore unless any shortcode attributes are set.
                if (empty($mapper) || isset($atts)) {

                    // Valid shortcode attributes:
                    // merkmodelselectie = volkswagen, audi|a4
                    // voertuigsoort = nieuw,demo,occassion
                    // voertuigcategorie = personenauto, bedrijfswagen
                    // prijs = 1000-150000
                    $params = array(
                        'merkmodelselectie'     => 'merkmodel',
                        'prijs'                 => 'prijs',
                        'carrosserie'           => 'carrosserie',
                        'voertuigsoort'     	=> 'voertuigsoort',
                        'voertuigcategorie'     => 'voertuigcategorie',
                        'actie_prijs'           => 'actie_prijs',
                        'voertuigmax'           => 'max',
                        'bouwjaar'              => 'bouwjaar',
                        'sortering'             => 'sortering',
                        'tellerstand'           => 'tellerstand'
                    );

                    // Convert shortcode attributes to url structure

                    $this->mapperUrl = $this->caw_atts_to_url($params, $atts, 'array');

                }
                break;

            case 'favorites':			$url = 'favorites'; break;
            case 'detail':				$url = 'detail[id]'; break;
            case 'testdrive':			$url = 'detail/testdrive[id][sessionId]'; break;
            case 'offer':				$url = 'detail/offer[id][sessionId]'; break;
            case 'privatelease':		$url = 'detail/privatelease[id][sessionId]'; break;
            case 'financiallease':		$url = 'detail/financiallease[id][sessionId]'; break;
            case 'operationallease': 	$url = 'detail/operationallease[id][sessionId]'; break;
            case 'bid':					$url = 'detail/bid[id][sessionId]';	break;
            case 'maintenance-history':	$url = 'detail/maintenancehistory[id][sessionId]'; break;
            case 'callme':	            $url = 'detail/callme[id][sessionId]'; break;
            case 'thanks':				$url = 'detail/thanks[id][sessionId]'; break;
            case 'searchwidget':
                // Set default query string
                $default_query_string = '';

                // Valid shortcode attributes
                $params = array(
                    'merkselectie'		=> 'make',
                    'modelselectie'		=> 'model',
                    'prijs'				=> 'price',
                    'carrosserie' 		=> 'bodytype',
                    'brandstof'			=> 'fuel',
                    'actie_prijs'		=> 'actie_prijs',
                    'voertuigsoort'		=> 'saleType',
                    'voertuigcategorie' => 'type',
                    'voertuigmax'		=> 'max',
                    'actie_prijs'       => 'actie_prijs',
                    'bouwjaar'          => 'year',
                    'sortering'         => 'sort',
                    'tellerstand'       => 'tellerstand',
                    'velden'			=> ''
                );

                // Convert shortcode attributes to url structure
                $url = $this->caw_atts_to_url($params, $atts);

                $url = 'cawmini?' . $url . '&ccid=[ccid]&targetUrl=[targeturl]';
                break;
        }

        return $url . $default_query_string;
    }

    /**
     * Convert array of shortcode attributes to url structure
     *
     * Used by get_cawpage_url() to create url for requested caw page
     *
     * i.e. [autowebshopzoekwidget merkselectie="audi" modelselectie="a4" velden="1 2 3 4 5"]
     *
     * velden = fields which will be visible for the user
     * 1 = make, 2 = model, 3 = fuel, 4 = transmission, 5 = body
     */
    function caw_atts_to_url($params, $atts, $type = 'string') {
        $url = $type == 'string' ? '' : array();

        if (empty($atts)) {
            return $url;
        } else {
            // Look for valid shortcode attributes
            // i.e. $params = 'velden' => '1 2 3 4'
            foreach ($params as $key => $value) {

                // Which fields to show (visible for user) for searchwidget?
                if ($key == 'velden') {
                    // Get attribute values (one or more)
                    if(isset($atts['velden'])) {
                        $values = strtolower($atts[$key]);
                    }

                    // If non given: show all fields
                    if (empty($values)) {
                        $filters = array('make', 'model', 'fuel', 'transmission', 'body');
                    } else {
                        // i.e. $values = 1 2 3 4 OR $values = 1,2,3,4
                        if (strpos($values, ',') === false) {
                            $values = explode(' ', $values);
                        } else {
                            $values = explode(',', $values);
                        }

                        // Valid mapper values
                        // i.e. 1 = make, 2 = model etc
                        $valid = array('' , 'make', 'model', 'fuel', 'transmission', 'body');

                        $filters = array();

                        // Match attribute value to mapper value
                        // i.e. 1 = make
                        foreach ($values as $value) {
                            if (isset($valid[$value])) {
                                $filters[] = $valid[$value];
                            }
                        }
                    }

                    $url .= 'filters=' . json_encode($filters);
                } else {
                    // Add field to inlcude in widget (visible and non-visible)
                    if ($type == 'string') {
                        $url .= isset($atts[$key]) ? $value . '=' . strtolower($atts[$key]) . '&' : '';
                    } else {
                        $values = '';

                        // modelmerkselectie => merkmodel: merk|model,merk|model,merk
                        if ($key == 'merkmodelselectie') {

                            if (isset($atts['merkmodelselectie'])) {
                                // Match: audi|a4 seat|leon
                                $makemodels = explode(' ', strtolower($atts['merkmodelselectie']));

                                // Loop all found makes and models
                                foreach ($makemodels as $makemodel) {
                                    $values .= $makemodel . ',';
                                }

                                // Remove trailing comma
                                $values = rtrim($values, ',');

                                $url[$value] = $values;
                            }
                        } elseif (isset($atts[$key])) {
                            $values = '';

                            // Match: value{space}value
                            $valuesLower = strtolower($atts[$key]);
                            if (strpos($valuesLower, ',') === false) {
                                $valuesArr = explode(' ', $valuesLower);
                            } else {
                                $valuesArr = explode(',', $valuesLower);
                            }

                            foreach ($valuesArr as $valueStr) {
                                $values .= $valueStr . ',';
                            }

                            // Remove trailing comma
                            $values = rtrim($values, ',');

                            $url[$value] = $values;
                        }
                    }

                }
            }
        }
        return $url;
    }

    /**
     * Get url for caw mini search page
     */
    function caw_get_target_url() {
        $url = $this->target_url;

        // If no http(s) found: add protocol
        if (strpos($url, 'http') === false) {
            // Add protocol
            $url = $this->caw_get_protocol() . $url;
        }

        return $url;
    }

    /**
     * Get CAW greep uit ons aanbod content from Caw Client API
     */
    function caw_get_offer_content($atts = '') {

        if(empty($atts['autowebshoppagina']) || empty($atts['configuratiecode'])) {
            return;
        }

        include_once 'dependecies/AbstractConnection.php';
        include_once 'dependecies/CustomOfferConnection.php';
        include_once 'dependecies/CustomOffer.php';

        // Get caw include base url
        $url = $this->caw_get_url();

        if (empty($this->ccid)) {
            $this->ccid = isset($atts['configuratiecode']) ? $atts['configuratiecode'] : '';
        }


        // Build connection
        $connection = new CawBundle\CustomOfferConnection($this->ccid, $url);

        // A fake agent
        $agent = 'CartelInternetAndMarketingSnifferCawWp';

        // Create Curl Resource
        $ch = \curl_init ( $url );

        // Set options
        \curl_setopt( $ch, CURLOPT_TIMEOUT, 5) ;
        \curl_setopt( $ch, CURLOPT_NOBODY, 1 );
        \curl_setopt( $ch, CURLOPT_USERAGENT, $agent );
        \curl_setopt( $ch, CURLOPT_HTTPGET, 1 );
        \curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );

        // Get result and info
        \curl_exec ( $ch );
        $info = \curl_getinfo ( $ch );

        \curl_close( $ch );

        // See if you get a 200
        if ( $info['http_code'] == 200 ) {
            // Build it up!
            $customOffer = new CawBundle\CustomOffer($connection);
        } else {
            return "<strong>Connection error!.</strong> ";
        }

        // Define filter variables defaults
        $makeModelSet = '';
        $priceSet = isset($atts['prijs']) ? $atts['prijs'] : "";
        $yearSet = isset($atts['bouwjaar']) ? $atts['bouwjaar'] : "";
        $countSet = isset($atts['tellerstand']) ? $atts['tellerstand'] : "";
        $limitSet = isset($atts['voertuigaantal']) ? $atts['voertuigaantal'] : 4;
        $sortSet = isset($atts['sortering']) ? $atts['sortering'] : "";
        $fuelSet = isset($atts['brandstof']) ? $atts['brandstof'] : "";
        $baseUrl = rtrim($atts['autowebshoppagina'], "/");
        $vehicleCategorySet = isset($atts['voertuigcategorie']) ? $atts['voertuigcategorie'] : "";
        $vehicleSaleTypeSet = isset($atts['voertuigsoort']) ? $atts['voertuigsoort'] : "";
        $viewSet = isset($atts['weergave']) ? $atts['weergave'] : "raster";

        $widgetTitle = isset($atts['widgettitel']) ? $atts['widgettitel'] : "";

        // Get merkmodel if used
        foreach ($atts as $key => $value) {
            if ($key == 'merkmodelselectie') {
                if (isset($atts['merkmodelselectie'])) {
                    // Match: brand|model brand|model
                    $makemodels = explode(' ', strtolower($atts['merkmodelselectie']));

                    // Loop trough all the models
                    foreach ($makemodels as $makemodel) {
                        $makeModelSet .= $makemodel . ",";
                    }
                }
            }
        }

        // Debug for all cars, remove later on
        //$limitSet = 999;
        $customOffer
            ->addArgument( 'sortering', $sortSet )
            ->addArgument( 'merkmodel', rtrim($makeModelSet, ",") )
            ->addArgument( 'tellerstand', $countSet )
            ->addArgument( 'voertuigcategorie', $vehicleCategorySet )
            ->addArgument( 'brandstof', $fuelSet )
            ->addArgument( 'voertuigsoort', $vehicleSaleTypeSet )
            ->addArgument( 'prijs', $priceSet )
            ->addArgument( 'bouwjaar', $yearSet );

        // Set the max limit if sort is not random
        if ($sortSet != 'random') {
            $customOffer->addArgument( 'max', $limitSet );
        }

        // Get Filter response from API
        $response = $customOffer->filterAction();

        $content = json_decode( $response );

        $content->base_url = $baseUrl;
        $content->limit = $limitSet;
        $content->sort = $sortSet;
        $content->view = $viewSet;

        $content->widgettitle = $widgetTitle;


        return $content;
    }
    /**
     * Get CAW content from remote caw server
     */
    function caw_get_content($type = '', $atts = '') {
        $content = '';

        // Get caw include base url
        $url = $this->caw_get_url();

        // What type of content do we need?
        switch ($type) {
            case 'meta':
                $url .= 'seo/[page][id]?ccid=[ccid]';
                break;
            case 'css':
                $url .= 'assets/css?ccid=[ccid]&baseUrl=[baseurl]';
                break;
            case 'script':
                $url .= 'assets/js?ccid=[ccid]&type=[page]&baseUrl=[baseurl]';
                break;
            case 'searchwidget':
                // Get url for requested caw page
                $url .= $this->get_cawpage_url('searchwidget', $atts);

                // Set page
                $this->page = 'cawmini';

                // Get caw script from remote caw server
                $jsFiles = $this->caw_get_content('script');

                // Unset page
                $this->page = '';

                // Add javascript
                if (!empty($jsFiles)) {


                    if ( ! wp_script_is('cawmini-js-app', $list = 'enqueued' ) ) {
                        wp_register_script( 'cawmini-js-app', $jsFiles[0]->src, false, '1', true );
                        wp_enqueue_script('cawmini-js-app');
                    }
                    if ( ! wp_script_is('cawmini-js-settings', $list = 'enqueued' ) ) {
                        wp_register_script( 'cawmini-js-settings', $jsFiles[1]->src, false, '1', true );
                        wp_enqueue_script('cawmini-js-settings');
                    }
                    if ( ! wp_script_is('cawmini-js', $list = 'enqueued' ) ) {
                        wp_register_script( 'cawmini-js', $jsFiles[2]->src, false, '1', true );
                        wp_enqueue_script('cawmini-js');
                    }
                }
                break;
            default:
                // Get requested caw page from rewritten url
                $page = $this->caw_get_page();

                // Get url for requested caw page
                $url .= $this->get_cawpage_url($page, $atts);

                // Get caw script from remote caw server
                $jsFiles = $this->caw_get_content('script');

                // Add javascript
                if (!empty($jsFiles)) {
                    foreach($jsFiles as $jsFile) {
                        $fileName = explode("/" , $jsFile->src);
                        $fileName = end($fileName);

                        if ( ! wp_script_is($fileName, $list = 'enqueued' ) ) {
                            wp_register_script( $fileName, $jsFile->src, array('jquery'), 1 , true );
                            wp_enqueue_script($fileName);
                        }
                    }
                }
        }

        // Parse values in this url
        $url = $this->caw_parse_url($url);

        // Used for debugging
        if ($this->debug) {
            echo ' cawurl: ';
            var_dump($url);
            echo '<br />';
        }
        // Set timeout higher then default
        $agsRemote = array ('timeout'     => 15);
        // Request remote caw page
        $result = wp_remote_get($url,$agsRemote);

        if (is_wp_error($result)) {
            $content = '<p>Er is iets mis gegaan tijdens het laden, controleer de settings.</p>';
        } else {
            $content = empty($content) ? json_decode($result['body']) : $content . json_decode($result['body']);
        }

        return $content;
    }

    /**
     * Replace dummies with their real values
     */
    function caw_parse_url($url) {
        // Dummy values with their associated method to get real value
        $vars = array('page'		=> 'caw_get_page',
            'ccid'		=> 'caw_get_ccid',
            'mapper'		=> 'caw_get_mapper',
            'view'		=> 'caw_get_view',
            'baseurl'		=> 'caw_get_baseurl',
            'vehicles'	=> 'caw_get_vehicle_ids',
            'id'			=> 'caw_get_id',
            'sessionhash'	=> 'caw_get_session_id_hash',
            'sessionId'	=> 'caw_get_session_id',
            'targeturl'	=> 'caw_get_target_url'
        );

        // Parse vars
        foreach ($vars as $var => $function) {
            // Convert all values to lowercase
            $url = str_replace('[' . $var . ']', $this->$function(), $url);
        }

        return $url;
    }
}

$responsive_caw = new responsive_caw();

/**
 * Run the update package
 *
 * @since    1.8
 */

$cawUpdateChecker = new Puc_v4p5_Vcs_PluginUpdateChecker(
    new Puc_v4p5_Vcs_GitLabApi('https://gitlab.cartel.nl/wordpress-public/responsive-caw/'),
    __FILE__,
    'responsive-caw'
);
$cawUpdateChecker->setBranch('master');
