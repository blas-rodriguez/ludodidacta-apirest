<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Creo un controlador base para el api de forma tal
 * de tener centralizado el formato de la misma en un solo lugar,
 * ya sea para devolver respuestas de exito, de error...
 */
class BaseController extends Controller
{
	protected function getErrorResponse($title, $detail, $statusCode) {
		return response()->json([
			'errors'=> [
				'title'=>$title, 
				'detail'=>$detail]
			], $statusCode);
	}

	/**
	 * Devuelve una respuesta exitosa con el formato necesario para nuestra API
	 *
	 * De esta forma nos aseguramos que todas las respuestas exitosas tengan
	 * el mismo formato
	 */
	protected function getSuccessResponse($data, $statusCode=200) {
		return response()->json([
				'data'=>$data
			], 
			$statusCode);
	}

	/**
	 * Devuelve una respuesta exitosa de creación de un elemento con el formato
	 * necesario para nuestra API
	 */
	protected function getCreatedResponse($item) {
		return response()->json([
				'data'=>$item
			], 
			201);
	}

	/**
	 * Devuelve información paginada
	 *
	 * En general no es aconsejable y es peligroso devolver el conjunto completo 
	 * de elementos sin paginar, en especial cuando el conjunto es/puede ser 
	 * muy numeroso
	 */
	protected function getPaginatedSuccessResponse($items, $paginationLinks) {
		return response()->json([
			'data' => 
				$items,
			'links'=> [
				'prev'	=> $paginationLinks['prev'],
				'next' => $paginationLinks['next'],
				'total' => $paginationLinks['total'],
			]], 200);
	}
}
