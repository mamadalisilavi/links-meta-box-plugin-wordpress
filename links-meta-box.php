<?php
/*
  Plugin Name: Add Multiple Links
  Version: 1.0
  Author: Mohammad Silavi
  Author URI: https://www.udemy.com/user/bradschiff/
*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly
function links_meta_script()
{
  wp_enqueue_script('links_script', plugins_url('src/links.js', __FILE__));
}
add_action("admin_enqueue_scripts", 'links_meta_script');

function register_meta_box_links()
{
  $screens = ['app', 'game'];
  foreach ($screens as $screen) {
    add_meta_box('meta_box_links', 'Links Download', 'links_callback', $screen, 'side', 'default');
  }
}
add_action('add_meta_boxes', 'register_meta_box_links');

function links_callback($post)
{
  $value = get_post_meta($post->ID, 'links_meta');
?>
  <div id="links-input">
    <button id="btn-add-inputs-links" class="is-primary components-button">Add a new link</button><br />
    <?php
    if (!empty($value[0])) {
      $length = count($value[0]['link']);
      for ($i = 0; $i < $length; $i++) { ?>
        <label> add new link</label><br />
        <label> title link</label>
        <input type="text" name="title[]" value="<?php echo esc_html($value[0]['title'][$i]) ?>">
        <label> Link</label>
        <input type="text" name="link[]" value="<?php echo esc_html($value[0]['link'][$i]) ?>"><br />
      <?php  } ?>
    <?php } ?>
  </div>
<?php
}
function links_on_save($post_id)
{
  if (isset($_POST['link']) && isset($_POST['title'])) {
    update_post_meta($post_id, 'links_meta', array_merge(['link' => $_POST['link']], ['title' => $_POST['title']]));
  }
}

add_action('save_post', 'links_on_save');
