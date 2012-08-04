== Changelog ==

= 1.4 - Jan 6 2012 =
* The comments disabled notice should show up on posts and pages only if there are comments AND comments are disabled
* Bugfix: filtering attachment link URLs that don't have pretty permalinks will cause a 404 when viewing an unattached attachment
* Fix @package and @subpackage information
* Add generic action-hooks to header and sidebar
* Add max-width to wp-caption to prevent overflow
* Support older self-hosted installs with is_multi_author function check

= 1.3 - Oct 5 2011 =
* Make the comment markup in our callback switch the default markup for any new comment types following Twenty Eleven's example
* Add in a content id attribute to the image navigation links for a better user experience
* the_post should always be called in the loop
* Set svn:eol-style on JS and TXT files
* Fix get_the_author() escaping
* Add in the older section-heading class for backwards compatibility
* Trim whitespace
* TEMPLATEPATH to get_template_directory()
* Add POT file