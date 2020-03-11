<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;


trait ApiResponser
{

	// SUCCESS MESSAGE
	private function successResponse($data, $code)
	{
		return response()->json($data, $code);
	}

	// ERROR MESSAGE
	protected function errorResponse($message, $code)
	{
		return response()->json(['error' => $message, 'code' => $code], $code);
	}


	// SHOW COLLECTIONS
	protected function showCollection(Collection $collection, $code = 200)
	{

		if ($collection->isEmpty()) {
			return $this->successResponse(['data' => $collection], $code);
		}

		$transformer = $collection->first()->transformer;

		$collection = $this->transformData($collection, $transformer);

		return $this->successResponse($collection, $code);
	}


	// SHOW ITEM
	protected function showItem(Model $instance, $code = 200)
	{

		if(!$instance)
		{
			return $this->successResponse(['data' => $instance], $code);
		}

		$transformer = $instance->transformer;

		$instance = $this->transformData($instance, $transformer);

		return $this->successResponse($instance, $code);
	}


	// TRANSFORM DATA
	protected function transformData($data, $transformer)
	{

		$transformation = fractal($data, new $transformer);

		return $transformation->toArray();

	}

}
