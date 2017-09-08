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

	/**
	 * API for get child
	 * call api : api.attendance.app/[API_KEY]/[FIELD]
	 * example : api.attendance.app/Of4FyAcAulVREqGJo4KqTefcUkU2/employees
	 */
	public function getField($api_key, $field)
	{
		$list_data = $this->database->getReference('/users/'.$api_key.'/'.$field)->getSnapshot()->getValue();

		if (! $list_data) {
			return json_encode(array('status' => 'error', 'message' => 'field not found'));
		}

		return $list_data;
	}

	public function getEmployee($api_key)
	{
		$array_data = [];
		$name_employee = '';
		$i=1;
		$list_child = $this->database->getReference('/users/'.$api_key.'/employees/')->getChildKeys();
		foreach ($list_child as $key => $code) {
			$employee_id = $code;
			$employee_name = $this->database->getReference('/users/'.$api_key.'/employees/'.$code.'/name')->getSnapshot()->getValue();
			array_push($array_data, ['id' => $employee_id, 'name' => $employee_name]);
		}

		return $array_data;
	}

	/**
	 * API for get report all user
	 */
	public function getReport($api_key)
	{
		$array_data = [];
		$name_employee = '';
		$i=1;
		$list_child = $this->database->getReference('/users/'.$api_key.'/employees/')->getChildKeys();
		foreach ($list_child as $key => $code) {
			$employee_id = $code;
			$employee_name = $this->database->getReference('/users/'.$api_key.'/employees/'.$code.'/name')->getSnapshot()->getValue();
			$list_schedule = $this->database->getReference('/users/'.$api_key.'/employees/'.$code.'/schedulle')->getChildKeys();
			foreach ($list_schedule as $key_schedule => $value_schedule) {
				$list_data = $this->database->getReference('/users/'.$api_key.'/employees/'.$code.'/schedulle/'.$value_schedule)->getValue();
				array_push($array_data, [
					'id' => $i,
					'employee_id' => $employee_id,
					'name' => $employee_name,
					'check_in' => $list_data['check_in'],
					'check_out' => $list_data['check_out'],
					'date' => $list_data['date'],
					'denda' => $list_data['denda'],
					'selisih_jam_datang' => $list_data['selisih_jam_datang'],
					'selisih_jam_pulang' => $list_data['selisih_jam_pulang'],
					'time_in' => $list_data['time_in'],
					'time_out' => $list_data['time_out'],
					'tunjangan_makan' => $list_data['tunjangan_makan'],
					'tunjangan_parkir' => $list_data['tunjangan_parkir'],
					'tunjangan_pulsa' => $list_data['tunjangan_pulsa'],
					'gaji' => $list_data['gaji']
				]);
				$i++;
			}
		}

		return json_encode($array_data);
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

	public function insertEmployee($api_key)
	{
		$data = [
			'name' => \Input::get('name'),
			'password' => \Input::get('password')
		];
		
		$employee_key = $this->database->getReference('/users/'.$api_key.'/employees')->push()->getKey();
		return $this->database->getReference('/users/'.$api_key.'/employees/'.$employee_key)->getSnapshot()->getValue();

	}
}
