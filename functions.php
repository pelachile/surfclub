<?php 

add_action( 'after_setup_theme','bones_ahoy', 15);

function bones_ahoy() {
  add_action( 'init', 'bones_head_cleanup');
  add_action( 'wp_enqueue_scripts','surfclub_scripts_styles', 999);
  add_action( 'widgets_init', 'surfclub_register_sidebar');
  add_action( 'after_setup_theme', 'surfclub_theme_support');
}

function surfclub_theme_support() {
  add_theme_support( 'menus' );

  register_nav_menus(
    array(
      'main-nav' => __( 'The Main Menu'),
      'beer_nav' => __( 'The Beer Menu'),
      'food_nav' => __( 'The Food Menu')
    )
  );
}

function surf_main_nav() {
  wp_nav_menu(array(
    'container' => false,
    'container_class' => 'nav-collapse',
    'menu' => 'The Main Menu',
    'menu_class' => 'nav',
    'theme_location' => 'main-nav',
    'before' => '',
    'after' => '',
    'link_before' => '',
    'link_after' => '',
    'fallback_cb' => 'surfclub_main_nav_fallback'
  ));
}

function surfclub_main_nav_fallback() {
  wp_page_menu( 'show_home=Home' );
}

function surfclub_scripts_styles() {
  
  wp_register_style( 'surfclub-stylsheet', get_stylesheet_directory_uri() . '/style.css', array(), '', 'all' );

  wp_register_script('validate', get_stylesheet_directory_uri(). '/assets/js/vendor/jquery.validate.min.js', array(), '', true );
  
  wp_register_script( 'surfclub-plugins', get_stylesheet_directory_uri() . '/assets/js/plugins.min.js', array(), '', true );

  wp_register_script( 'surfclub-mainjs', get_stylesheet_directory_uri() . '/assets/js/main.min.js', array(), '', true );

  wp_enqueue_script('jquery');

  wp_enqueue_script('validate');

  wp_enqueue_style( 'surfclub-stylsheet');

  wp_enqueue_script( 'surfclub-plugins');

  wp_enqueue_script( 'surfclub-mainjs');

}

function bones_head_cleanup() {
  // category feeds
  // remove_action( 'wp_head', 'feed_links_extra', 3 );
  // post and comment feeds
  // remove_action( 'wp_head', 'feed_links', 2 );
  // EditURI link
  remove_action( 'wp_head', 'rsd_link' );
  // windows live writer
  remove_action( 'wp_head', 'wlwmanifest_link' );
  // index link
  remove_action( 'wp_head', 'index_rel_link' );
  // previous link
  remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
  // start link
  remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
  // links for adjacent posts
  remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
  // WP version
  remove_action( 'wp_head', 'wp_generator' );
  // remove WP version from css
  add_filter( 'style_loader_src', 'bones_remove_wp_ver_css_js', 9999 );
  // remove Wp version from scripts
  add_filter( 'script_loader_src', 'bones_remove_wp_ver_css_js', 9999 );

} /* end bones head clean up */

// remove WP version from RSS
function bones_rss_version() { return ''; }

// remove WP version from scripts
function bones_remove_wp_ver_css_js( $src ) {
  if ( strpos( $src, 'ver=' ) )
    $src = remove_query_arg( 'ver', $src );
  return $src;
}

// remove injected CSS for recent comments widget
function bones_remove_wp_widget_recent_comments_style() {
  if ( has_filter('wp_head', 'wp_widget_recent_comments_style') ) {
    remove_filter('wp_head', 'wp_widget_recent_comments_style' );
  }
}

// remove injected CSS from recent comments widget
function bones_remove_recent_comments_style() {
  global $wp_widget_factory;
  if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
  }
}

// remove injected CSS from gallery
function bones_gallery_style($css) {
  return preg_replace("!<style type='text/css'>(.*?)</style>!s", '', $css);
}

function surfclub_register_sidebar() {
  register_sidebar( array( 
    'name'      => 'Google Map',
    'id'      => 'sidebar1',
    'description'  => 'This is the google map widget',
    'before_widget'  => '',
    'after_widget'  => "",
    'before_title'  => '',
    'after_title'  => "\n"
  )  
);
  register_sidebar( array( 
    'name'      => 'Twitter',
    'id'      => 'sidebar2',
    'description'  => 'This is the Twitter widget',
    'before_widget'  => '',
    'after_widget'  => "",
    'before_title'  => '',
    'after_title'  => "\n"
  )  
); 
}
function surfclub_beer_nav() {

  wp_nav_menu(array(
    'menu' => 'beer_nav',
    'theme_location' => 'beer_nav',
    'container_class' => 'nav nav-list',
    'menu_id' => ' ',
    'items_wrap' => '<li class="nav-header"><h3>Beer</h3></li>%3$s</ul>' 
  ));
}

function surfclub_food_nav() {

  wp_nav_menu(array(
    'menu' => 'food_nav',
    'theme_location' => 'food_nav',
    'container_class' =>'nav nav-list',
    'menu_id' => ' ',
    'items_wrap' => '<li class="nav-header"><h3>Food</h3></li>%3$s</ul>'
  ));
}

function surf_tweets() {

  /*
   * JSON list of tweets using:
   *    http://dev.twitter.com/doc/get/statuses/user_timeline
   * Cached using WP transient API.
   *    http://www.problogdesign.com/wordpress/use-the-transients-api-to-list-the-latest-commenter/
   */

  // Configuration.
  $numTweets = 3;
  $name = 'ExecSurfClub';
  $transName = 'list-tweets'; // Name of value in database.
  $cacheTime = 5; // Time in minutes between updates.

  if(false === ($tweets = get_transient($transName) ) ) :

    // Get the tweets from Twitter.
    $json = wp_remote_get("http://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=$name&count=$numTweets");

  // Get tweets into an array.
  $twitterData = json_decode($json['body'], true);

  // Now update the array to store just what we need.
  foreach ($twitterData as $tweet) :
    // Core info.
    $name = $tweet['user']['name'];
  $permalink = 'http://twitter.com/#!/'. $name .'/status/'. $tweet['id_str'];

  /* Alternative image sizes method: http://dev.twitter.com/doc/get/users/profile_image/:screen_name */
  $image = $tweet['user']['profile_image_url'];

  // Message. Convert links to real links.
  $pattern = '/http:(\S)+/';
  $replace = '<p class="twitter-url"><a href="${0}" target="_blank" rel="nofollow">${0}</a></p>';
  $text = preg_replace($pattern, $replace, $tweet['text']);

  // Need to get time in Unix format.
  $time = $tweet['created_at'];
  $time = date_parse($time);
  $uTime = mktime($time['hour'], $time['minute'], $time['second'], $time['month'], $time['day'], $time['year']);

  // Now make the new array.
  $tweets[] = array(
    'text' => $text,
    'name' => $name,
    'permalink' => $permalink,
    'image' => $image,
    'time' => $uTime
  );
endforeach;
// Save our new transient.
set_transient($transName, $tweets, 60 * $cacheTime);
endif;
// Now display the tweets.
foreach($tweets as $t) : ?>
  <li class="clearfix">
    <img src="<?php echo $t['image']; ?>" width="48" height="48" alt="" />        

      <p>
             <?php echo $t['name'] . ': '. $t['text']; ?>
             <span class="twitter-time"><?php echo human_time_diff($t['time'], current_time('timestamp')); ?> ago</span>
        </p>

  </li>
<?php endforeach; ?>
<?php } ?>
