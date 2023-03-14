<?php
	function encrypted_url($get_)
	{
		$key = '$MD';
		$iv = '$@intmed_-+={}:;';
		$encrypted_age = openssl_encrypt($get_, 'AES-256-CBC', $key, 0, $iv);
		return $encrypted_age;
	}
	function decrypted_url($get_)
	{
		$key = '$MD';
		$iv = '$@intmed_-+={}:;';
		$decrypted_age = openssl_decrypt($get_, 'AES-256-CBC', $key, 0, $iv);
		return $decrypted_age;
	}
?>