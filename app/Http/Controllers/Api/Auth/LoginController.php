<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Controllers\Api\BaseController as ApiController;
use Illuminate\Validation\ValidationException;

use Auth;

class LoginController extends ApiController
{
	/**
	 * El login funciona de la siguiente forma, 
	 * el usuario suministra su email y su contraseña, en caso
	 * de que sean correctas se le devuelve su api_token, con el que
	 * va a poder utilizar las rutas del api que requieran autenticación
	 * (Por ejemplo la creación de posts). Ejemplo de petición:
	 *
	 * POST api/users/{id}/posts?api_token=.....
	 * 
	 */
    public function login(Request $request) {
    	/**
    	 * Con un buen manejo de exceptions custom y form requests, 
    	 * toda esta logica de validación puede extraerse totalmente
    	 */
    	try {
    		$this->validate($request, [
    			'email'=>'required|email',
    			'password'=>'required'
			]);

			/**
			 * Verifico que el email y la contraseña del usuario sean correctos
			 * No utilizo Auth::attempt ya que no debo persistir al usuario en la
			 * sesión: 
			 * https://es.wikipedia.org/wiki/Transferencia_de_Estado_Representacional
			 */
	    	$validCredentials = Auth::once($request->only('email', 'password'));

	    	//Si se loguea con exito, entonces le devuelvo el api_token
	    	if($validCredentials) {
	    		return response()->json([
	    			'message' 	=> 'Valid credentials',
	    			'api_token'	=> Auth::user()->api_token,
				]);
	    	} 

	    	//Si estaban mal las credenciales respondo con un mensaje de error
			return $this->getErrorResponse('Wrong credentials', 'The email or password you entered are invalid', 422);
    	} catch(ValidationException $e) {
    		return $this->getErrorResponse('Invalid request', $e->validator->errors(), 403);
    	}
    }
}
