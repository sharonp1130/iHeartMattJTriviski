<?php
$format = "/(?:(?:\+?1\s*(?:[.-]\s*)?)?(?:\(\s*([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9])\s*\)|([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9]))\s*(?:[.-]\s*)?)?([2-9]1[02-9]|[2-9][02-9]1|[2-9][02-9]{2})\s*(?:[.-]\s*)?([0-9]{4})(?:\s*(?:#|x\.?|ext\.?|extension)\s*(\d+))?$/";
$alt_format = '/^(\+\s*)?((0{0,2}1{1,3}[^\d]+)?\(?\s*([2-9][0-9]{2})\s*[^\d]?\s*([2-9][0-9]{2})\s*[^\d]?\s*([\d]{4})){1}(\s*([[:alpha:]#][^\d]*\d.*))?$/';
$first_replace = '/\s+(#|x|ext(ension)?)\.?:?\s*(\d+)/';
$ext = ' ext \3';


/**
 * @param unknown $phone
 * @param string $international
 * @return string|mixed|boolean
 */
function sanitize_phone( $phone, $international = false ) {
	global $format, $alt_format, $first_replace, $ext;
	
	// Trim & Clean extension
	$phone = trim( $phone );
	$phone = preg_replace( $first_replace, $ext, $phone );
	if ( preg_match( $alt_format, $phone, $matches ) ) {
		return '(' . $matches[4] . ') ' . $matches[5] . '-' . $matches[6] . ( !empty( $matches[8] ) ? ' ' . $matches[8] : '' );
	} elseif( preg_match( $format, $phone, $matches ) ) {
		// format
		$phone = preg_replace( $format, "($2) $3-$4", $phone );
		// Remove likely has a preceding dash
		$phone = ltrim( $phone, '-' );
		// Remove empty area codes
		if ( false !== strpos( trim( $phone ), '()', 0 ) ) {
			$phone = ltrim( trim( $phone ), '()' );
		}
		// Trim and remove double spaces created
		return preg_replace('/\\s+/', ' ', trim( $phone ));
	}
	return false;
}
?>