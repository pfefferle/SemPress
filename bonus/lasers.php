<?php
/**
 * This function echoes lasers for Matt Thomas
 * and can be called wherever and whenever required
 *
 * @link http://twitter.com/#!/iandstewart/status/104033119866322944
 * @since Toolbox 1.2
 */
function toolbox_super_laser_defense() {
	$lasers = apply_filters( 'toolbox_super_laser_defense', 'http://baldguy.files.wordpress.com/2011/07/pewpew.jpg' );
	echo '<img src="' . $lasers . '" alt="<pew><pew>" />';
}
