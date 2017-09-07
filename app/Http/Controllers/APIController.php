<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;


class APIController extends Controller
{
	private $database;

	public function __construct()
	{
		$serviceAccount = ServiceAccount::fromJsonFile(storage_path().'/app/firebase.json');
		$firebase = (new Factory)
		    ->withServiceAccount($serviceAccount)
		    ->create();
	    $this->database = $firebase->getDatabase();

	}

	public function getUserDatabase($api_key)
	{
		$user_database = '';
		$list_data = $this->database->getReference('/users/'.$api_key)->getSnapshot()->getValue();
		foreach ($list_data as $key => $data) {
			if (is_array($data)) {
				foreach ($data as $key2 => $data_child) {
					if ($data['api_key'] == $api_key) {
						$user_database = $key;
						break;
					}
				}
			}
		}

		if (! $user_database) {
			return json_encode(array('status' => 'error', 'message' => 'user not found'));
		}

		return $list_data;
	}

	public function getField($api_key, $field)
	{
		$list_data = $this->database->getReference('/users/'.$api_key.'/'.$field)->getSnapshot()->getValue();

		if (! $list_data) {
			return json_encode(array('status' => 'error', 'message' => 'field not found'));
		}

		return $list_data;
	}

	public function getFieldByValue(Request $request, $api_key, $field)
	{
		$input = $request->input();
		$key_search = key($input);
		$value_search = $input[$key_search];

		$index_field = '';
		$user_database = $this->getUserDatabase($api_key);
		$list_data = $this->database->getReference('/users/'.$user_database.'/'.$field)->getSnapshot()->getValue();
		foreach ($list_data as $key => $value) {
			if (is_array($value)) {
				foreach ($value as $key2 => $value_child) {
					if ($value_child[$key_search] == $value_search) {
						$index_field = $key;
						break;
					}
				}
			}
		}

		if (! $index_field) {
			return json_encode(array('status' => 'error', 'message' => 'data not found'));
		}

		return $index_field;
	}

	// public function getEmployee()
	// {
	// 	$list_employee = $this->database->getReference('/employee')->getSnapshot()->getValue();
	//     return $list_employee;
	// }

	// public function getEmployeeByKey($key)
	// {
	// 	$employee = $this->database->getReference('/employee/'.$key)->getSnapshot()->getValue();
	// 	if (! $employee) {
	// 		return json_encode(array('data' => 'data not found'));
	// 	}

	//     return $employee;
	// }
}
