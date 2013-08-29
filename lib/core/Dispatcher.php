<?php

/**
 * Dispatcher: A class to handle the client routing
 * @author maraya
 * 
 * This file is part of Cazuela.
 *
 * Cazuela is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Cazuela is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Cazuela. If not, see <http://www.gnu.org/licenses/>.
 */
 
class Dispatcher {

	/**
	 * Dispatcher/router method
	 * @param CazuelaRequest $request
	 * @param CazuelaResponse $response
	 * @throws CazuelaException
	 */
	public function dispatch($request, $response) {
		try {
			if (!isset($_REQUEST['__class']) || !isset($_REQUEST['__method']) || !isset($_REQUEST['__type'])) {
				throw new CazuelaException("Invalid request", 2006);
			}
			
			$request->setClass($_REQUEST['__class']);
			$request->setMethod($_REQUEST['__method']);
			$response->setType($_REQUEST['__type']);
			
			$params = array();
			foreach($_REQUEST as $parameter => $value) {
				if (stripos($parameter, '__') === false) {
					$params[$parameter] = CazuelaSanitize::html($value);
				}
			}
			
			$request->setParams($params);
			$response->setContentType($response->getType());
			
			if (!in_array($response->getType(), array("json", "xml", "yml"))) {
				throw new CazuelaException("Type ". $response->getType() . " is invalid", 2000);
			}
			
			if ($response->getType() == "yml" && function_exists("yaml_emit") == false) {
				$response->setType("json");
				$response->setContentType("json");
				throw new CazuelaException("YAML is not installed. Please verify your PHP instalation", 2001);
				
			} elseif ($response->getType() == "xml" && class_exists("DOMDocument") == false) {
				$response->setType("json");
				$response->setContentType("json");
				throw new CazuelaException("DOMDocument class not found. Please verify your PHP instalation", 2001);
			}
			
			$className = $request->getClass()."Service";
			$methodName = $request->getMethod();
			
			$privateMethods = array("beforeCall", "afterCall", "query");
			if (in_array($methodName, $privateMethods)) {
				throw new CazuelaException("Method ". $methodName ." doesn't exist", 2004);
			}
			
			if (!file_exists(CAZUELA_APP_ROOT ."/services/". $className .".php")) {
				throw new CazuelaException("Service file ". $className ." not found", 2002);
			}
			
			include(CAZUELA_APP_ROOT ."/services/". $className .".php");
			
			if (!class_exists($className)) {
				throw new CazuelaException("Class ". $className ." doesn't exist", 2003);
			} 
			
			$obj = new $className();
			
			if (!method_exists($obj, $methodName)) {
				throw new CazuelaException("Method ". $methodName ." doesn't exist", 2004);
			}
			
			// beforeCall method
			$obj->beforeCall();
			
			$data = $obj->{$methodName}(compact($request->getParams()));
			$response->setData($data);
			
			// afterCall method
			$obj->afterCall();
			
			
			/*
			try {
				$obj = new ReflectionClass($className);
			} catch (ReflectionException $e) {
				throw new CazuelaException("Class ". $className ." doesn't exist", 2003);
			}
			
			if ($obj->hasMethod($methodName) === false) {
				throw new CazuelaException("Method ". $methodName ." doesn't exist", 2004);
			}
			
			$rMethod = new ReflectionMethod($className, $methodName);
			if ($rMethod->isProtected() === true) {
				// Forbidden access to protected methods!
				throw new CazuelaException("Method ". $methodName ." doesn't exist", 2004);
			}
			
			$parameterCount = 0;
			foreach ($rMethod->getParameters() as $parameter) {
				if ($parameter->isOptional() === false) {
					$parameterCount++;
				}
			}
			
			if (sizeof($request->getParams()) < $parameterCount) {
				throw new CazuelaException("Wrong number of parameters", 2005);
			}
			
			// beforeCall method
			//$bc = new ReflectionMethod($className, "beforeCall");
			//$bc->invoke(new $className);
			
			$data = $rMethod->invokeArgs(new $className, $request->getParams());
			$response->setData($data);
			
			// afterCall method
			//$ac = new ReflectionMethod($className, "afterCall");
			//$ac->invoke(new $className);
			*/
			
		} catch (CazuelaException $e) {
			$response->setMessage($e->getMessage());
			$response->setCode($e->getCode());
			$response->setError(true);
		}
		
		if ($response->error()) {
			$info = array("code" => $response->getCode(), "message" => $response->getMessage());
		} else {
			$info = array("data" => $response->getData());
		}
		
		$response->setResponse($info);
	}
}
?>