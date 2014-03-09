<?php
// [search]
function search_shortcode() {
  return get_product_search_form();
}
add_shortcode("search", "search_shortcode");
?>
