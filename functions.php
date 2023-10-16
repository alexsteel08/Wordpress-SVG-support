//wordpress SVG support without plugins 
//add this code your functions.php 

add_filter( 'upload_mimes', 'support_svg_upload_mimes' );
function support_svg_upload_mimes( $mimes ) {
	$mimes[ 'svg' ]  = 'image/svg+xml';
	$mimes[ 'svgz' ] = 'image/svg+xml';
	return $mimes;
}
add_filter( 'wp_check_filetype_and_ext', 'support_svg_filetype_ext', 10, 5 );
function support_svg_filetype_ext( $data, $file, $filename, $mimes, $real_mime ) {
	if( ! $data[ 'type' ] ) {
		$filetype  = wp_check_filetype( $filename, $mimes );
		$type = $filetype[ 'type' ];
		$ext = $filetype[ 'ext' ];
		if( $type && 0 === strpos( $type, 'image/' ) && 'svg' !== $ext ) {
			$ext  = false;
			$type = false;
		}
		$data = array( 
			'ext' => $ext,
			'type' => $type, 
			'proper_filename' => $data[ 'proper_filename' ],
		);
	}
	return $data;
}
