<?php
/**
 * Search Form template
 *
 * @package TRAVIC
 * @author Template Path
 * @version 1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Restricted' );
}
?>

<form method="post" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <div class="form-group">
        <input type="search" name="s" value="<?php echo get_search_query(); ?>" placeholder="<?php echo esc_attr__( 'Search...', 'travic' ); ?>" required>
        <button type="submit"><i class="icon-27"></i></button>
    </div>
</form>
