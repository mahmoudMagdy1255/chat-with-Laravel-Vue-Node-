<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
	public function index()
	{
		return view('admin.setting' , ['title' => trans('admin.settings') ] );
	}

	public function save_settings()
	{
		$data = $this->validate( request()  , [
			'sitename_ar'  => 'required|string',
			'sitename_en'  => 'required|string',
			'email'  => 'required|string',
			'description'  => '',
			'keywords' => '',
			'main_lang' => 'required|string',
			'status' => 'required|string',
			'message_maintenance' => '',
			'logo' => v_image(),
			'icon' => v_image(),
		] , [] , [
			'logo' => trans('admin.logo'),
			'icon' => trans('admin.icon'),
		]);

		if ( request()->hasFile('logo') ) {
			$data['logo'] = upload([
				'file' => 'logo',
				'path' => 'settings',
				'delete_file'  => setting()->logo
			]);
		}

		if ( request()->hasFile('icon') ) {
			$data['icon'] = upload([
				'file' => 'icon',
				'path' => 'settings',
				'delete_file'  => setting()->icon
			]);
		}

		setting()->update($data);

		session()->flash('success', trans('admin.updated'));
		return redirect(aurl('settings'));
	}
}
