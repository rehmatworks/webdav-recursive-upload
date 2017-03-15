#!/usr/bin/php
<?php

	#########################################################
	#	Name: WebDav Recursive Upload                 	#
	#	Description: Uploads files and directories    	#
	#	to a remote WebDav machine recursively	      	#
	#	Author: Rehmat Alam				#
	#	Website: https://rehmat.works			#
	#########################################################

	/* Editable part starts */
	
	// requires login
	define('WEBDAV_REQUIRES_LOGIN', true);

	// webDav login details if you have set above option true
	define('WEBDAV_USER', 'enter_webdav_username');
	define('WEBDAV_PASSWORD', 'enter_webdav_user_password');

	// Add forward slash at the end or you will break things
	define('WEBDAV_BASE_URL', 'enter_webdav_http_url');

	// Either month based folder should be generated on remote machine or not
	define('DATE_BASED_DIR', true);

	/* Editable part ends */

	function recursive_scan($src = './') {

		if(WEBDAV_REQUIRES_LOGIN == true) {

			$construct_url = '-u ' . WEBDAV_USER . ':' . WEBDAV_PASSWORD . ' ' . WEBDAV_BASE_URL;

		} else {

			$construct_url = WEBDAV_BASE_URL;

		}
	
		$all_content = scandir($src);

		if(DATE_BASED_DIR == true) {

			$folder = @date('m-y') . '-uploads';

			exec('curl -X MKCOL ' . $construct_url . $folder);

			$full_url = $construct_url . $folder . '/';

		} else {

			$full_url = $construct_url;

		}

		$upDir = str_replace('./', '', $src) . '/';

		if(strlen($upDir) > 0) {

			exec('curl -X MKCOL ' . $full_url . str_replace(' ', '', $upDir));

		}

		$files = array_diff($all_content, array('.', '..', pathinfo(__FILE__, PATHINFO_FILENAME) . '.' . pathinfo(__FILE__, PATHINFO_EXTENSION)));

		if(is_array($files)) {

			foreach ($files as $file) {

				if(is_dir($src.$file)) {

					exec('curl -X MKCOL ' . $full_url . str_replace(' ', '', $upDir) . str_replace(' ' , '', $file));

					recursive_scan($src.$file.'/');

				} else {

					exec('curl -T "' . $src . $file . '" ' . $full_url . str_replace(' ', '', $upDir) . str_replace(' ', '', $file));

				}

			}

		}

	}

	// call function to start the upload
	recursive_scan('./');

?>
