<?php

namespace rest;

class Klein {
	public static function install_routing($klein) {

		$klein->respond('GET', '/api/[:service]', function ($request, $response) {

			$rest = new \rest\Rest();
			$rest->set_method('GET');
			$rest->set_service('\\'.str_replace('_', '\\', $request->service ?? 'Index'));
			$rest->set_data($_GET);
			$rest->run();
			exit();
		});

		$klein->respond('GET', '/api/[:service]/[:id]', function ($request, $response) {
			$rest = new \rest\Rest();
			$rest->set_method('GET');
			$rest->set_id($request->id);
			$rest->set_params($_GET);
			$rest->set_service('\\'.str_replace('_', '\\', $request->service ?? 'Index'));
			$rest->set_data($_GET);
			$rest->run();
			exit();
		});

		$klein->respond('POST', '/api/[:service]/[:action]', function ($request, $response) {
			$rest = new \rest\Rest();
			$rest->set_method('POST');
		//	$rest->set_id($request->id);
			$rest->set_action($request->action);
			$rest->set_service('\\'.str_replace('_', '\\', $request->service ?? 'Index'));
			$data = file_get_contents('php://input');
			$data = json_decode($data, TRUE);
//			$rest->set_params($data['params']);
            $rest->set_params($data);

            $rest->run();
			exit();
		});


        $klein->respond('PATCH', '/api/[:service]/[:id]', function ($request, $response) {
            $rest = new \rest\Rest();
            $rest->set_method('PATCH');
            $rest->set_id($request->id);
        //    $rest->set_action($request->action);
            $rest->set_session($_COOKIE['ocid']);
            $rest->set_service('\\' . str_replace('_', '\\', $request->service ?? 'Index'));
            $data = file_get_contents('php://input');
            $rest->set_data(json_decode($data, TRUE));
            $rest->run();
            exit();
        });
	}
}
