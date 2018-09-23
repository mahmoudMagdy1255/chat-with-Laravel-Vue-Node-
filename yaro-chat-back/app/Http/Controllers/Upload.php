<?php

namespace App\Http\Controllers;

use Storage;

class Upload
{
	public static function upload(array $data = [])
	{
		if( request()->hasFile($data['file'])  ){

			
			Storage::has($data['delete_file']) ? Storage::delete($data['delete_file']) : '';
			return request()->file($data['file'])->store($data['path']);
		}
	}
}
