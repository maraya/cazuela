<?php

class Dispatcher {

	public function dispatch($request, $response) {
		try {
			$request->setClass($_REQUEST['__class']);
			$request->setMethod($_REQUEST['__method']);
			$response->setType($_REQUEST['__type']);
			
			$params = array();
			foreach($_REQUEST as $parameter => $value) {
				if (stripos($parameter, '__') === false) {
					$params[$parameter] = $value;
				}
			}
			
			$request->setParams($params);
			
			$className = $request->getClass();
			$methodName = $request->getMethod();
			$type = $response->getType();
			
			$response->setContentType($type);
			
			if (!in_array($type, array("json", "xml"))) {
				throw new CazuelaException("Type ". $type . " is invalid", 400);
			}
						
			if (!file_exists(CAZUELA_APP_ROOT ."/class/". $className.".php")) {
				throw new CazuelaException("Class file ". $className ." not found", 404);
			}
			
			include(CAZUELA_APP_ROOT ."/class/". $className .".php");
			
			if (!class_exists($request->getClass())) {
				throw new CazuelaException("Class ". $className ." doesn't exist", 404);
			}
			
			$className = $request->getClass();
			$obj = new $className();
			
			if (!method_exists($obj, $methodName)) {
				throw new CazuelaException("Method ". $methodName ." doesn't exist", 404);
			}
			
			$data = call_user_func_array(array($obj, $methodName), $request->getParams());
			$response->setData($data);
		
		} catch (CazuelaException $e) {
			$response->setMessage($e->getMessage());
			$response->setCode($e->getCode());
			$response->setError(true);
		}
		
		if ($response->error()) {
			$output = array("code" => $response->getCode(), "message" => $response->getMessage());
		} else {
			$output = array("data" => $response->getData());
		}
		
		header("Content-Type: ".$response->getContentType());
		echo $response->getResponse($output);
	}
}
?>