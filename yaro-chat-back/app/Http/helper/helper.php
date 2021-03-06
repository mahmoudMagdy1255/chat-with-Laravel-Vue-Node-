<?php

if (!function_exists('aurl')) {
	function aurl($url)
	{
		return url('admin/' . trim($url , '/') );
	}
}

if (!function_exists('v_image')) {
	function v_image($ext = null)
	{
		if(is_null($ext)){
			return 'image|mimes:jpg,jpeg,png,gif,bnp';
		}else {
			return 'image|mimes:' . $ext;
		}
	}
}

if (!function_exists('upload')) {
	function upload(array $data = [])
	{
		return App\Http\Controllers\Upload::upload($data);
	}
}

if (!function_exists('active_menu')) {
	function active_menu($url)
	{
		if ( preg_match( '/' . $url . '/i' , Request::segment(2)) ) {
			return ['active'];
		}else {
			return [''];
		}
	}
}

if (!function_exists('setting')) {
	function setting()
	{
		return App\Setting::all()->first();
	}
}