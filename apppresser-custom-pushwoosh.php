<?php
/*
Plugin Name: AppPresser Custom PushWoosh
Plugin URI: http://apppresser.com
Description: Extends AppPresser push notifications for Pushwoosh to customize the data sent to PushWoosh Remote API
Version: 0.1
Author: AppPresser Team
Author URI: http://apppresser.com
License: GPLv2
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

class AppPresserCustomPushwoosh {

	const VERSION           = '1.0.0';

	public function hooks() {
		add_filter( 'ap3_send_pushwoosh_data', array( $this, 'custom_push' ), 10, 2 );
	}

	public function custom_push( $data, $post = null ) {

		if( 
			isset( 
				$_POST,
				$_POST['send_push_notification'],
				$_POST['ID'] 
			) 
			&& $_POST['send_push_notification'] === '1'
		  ) {
			
			// thumnail
			if( isset( $_POST['_thumbnail_id'] ) ) {
				$thumb_url = get_the_post_thumbnail_url( (int)$_POST['ID'] );
	
				if( $thumb_url ) {
	
					$data['android_banner'] = $thumb_url;
					$data['android_custom_icon'] = $thumb_url;
				}
			}

			// URL
			$url = get_the_permalink( (int)$_POST['ID'] );
			if( $url ) {
				$data['data'] = json_encode(array( 
					'url' => $url,
				) );
			}
		}

		return $data;
	}
}


$apppImagePush = new AppPresserCustomPushwoosh();
$apppImagePush->hooks();
