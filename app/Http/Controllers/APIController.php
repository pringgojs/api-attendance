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
	 * example : api.attendance.app/Of4FyAcAulVREqGJo4KqTefcUkU2/employee
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
		$list_child = $this->database->getReference('/users/'.$api_key.'/employee/')->getChildKeys();
		foreach ($list_child as $key => $code) {
			$employee_id = $code;
			$employee_name = $this->database->getReference('/users/'.$api_key.'/employee/'.$code.'/name')->getSnapshot()->getValue();
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
		$list_child = $this->database->getReference('/users/'.$api_key.'/employee/')->getChildKeys();
		foreach ($list_child as $key => $code) {
			$employee_id = $code;
			$employee_name = $this->database->getReference('/users/'.$api_key.'/employee/'.$code.'/name')->getSnapshot()->getValue();
			$list_schedule = $this->database->getReference('/users/'.$api_key.'/employee/'.$code)->getChildKeys();
			$is_schedule = array_search('schedulle', $list_schedule);

			if (!$is_schedule) {
				continue;
			}

			$list_schedule = $this->database->getReference('/users/'.$api_key.'/employee/'.$code.'/schedulle')->getChildKeys();
			foreach ($list_schedule as $key_schedule => $value_schedule) {
				$list_data = $this->database->getReference('/users/'.$api_key.'/employee/'.$code.'/schedulle/'.$value_schedule)->getValue();
				array_push($array_data, [
					'id' => $i,
					'employee_id' => $employee_id,
					'name' => $employee_name,
					'branch_id' => $list_data['branchId'] ? : '',
					'check_in' => array_key_exists('check_in', $list_data) ? $list_data['check_in'] : '',
					'check_out' => array_key_exists('check_out', $list_data) ? $list_data['check_out'] : '',
					'date' => array_key_exists('date', $list_data) ? $list_data['date'] : '',
					'denda' => array_key_exists('denda', $list_data) ? $list_data['denda'] : '',
					'selisih_jam_datang' => array_key_exists('selisih_jam_datang', $list_data) ? $list_data['selisih_jam_datang'] : '',
					'selisih_jam_pulang' => array_key_exists('selisih_jam_pulang', $list_data) ? $list_data['selisih_jam_pulang'] : '',
					'time_in' => array_key_exists('shiftStart', $list_data) ? $list_data['shiftStart'] : '',
					'time_out' => array_key_exists('shiftEnd', $list_data) ? $list_data['shiftEnd'] : '',
					'tunjangan_makan' => array_key_exists('tunjangan_makan', $list_data) ? $list_data['tunjangan_makan'] : '',
					'tunjangan_parkir' => array_key_exists('tunjangan_parkir', $list_data) ? $list_data['tunjangan_parkir'] : '',
					'tunjangan_pulsa' => array_key_exists('tunjangan_pulsa', $list_data) ? $list_data['tunjangan_pulsa'] : '',
					'gaji' => array_key_exists('gaji', $list_data) ? $list_data['gaji'] : '',
				]);
				$i++;
			}
		}

		return json_encode($array_data);
	}

	public function getEmployeeId($api_key, $name)
	{
		$list_data = $this->database->getReference('/users/'.$api_key.'/employees')->orderByChild('name')->equalTo($name)->getSnapshot()->getValue();
		if (!$list_data) {
			return json_encode(array('status' => 'error', 'message' => 'data not found'));
		}

		return $list_data;
	}

	public function insertEmployee(Request $request, $api_key)
	{
		if (! $request->input('name') || ! $request->input('password')) {
			return json_encode(array('status' => 'error', 'message' => 'wrong parameter'));
		}

		$data = [
			'name' => $request->input('name'),
			'password' => $request->input('password')
		];
		
		$array_employee = [];
		$employee_key = $this->database->getReference('/users/'.$api_key.'/employees')->push($data)->getKey();
		$data = $this->database->getReference('/users/'.$api_key.'/employee/'.$employee_key)->getSnapshot()->getValue();
		array_push($array_employee, ['id' => $employee_key, 'name' => $data['name'], 'password' => $data['password']]);

		return json_encode($array_employee);

	}
}
