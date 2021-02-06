<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Panel\UpdateProfileRequest;
use Auth, Storage;

class ProfileController extends Controller
{
    /**
     * Muestra el panel de configuracion del perfil de un usuario especifico
     */
    public function edit() {
    	return view('panel.profile.edit')
    		->with('profile', Auth::user());
    }

    /**
     * Actualizo la información del usuario
     */
    public function update(UpdateProfileRequest $request) {
    	//Valido que la información suministrada sea correcta
		$user = $request->user(); //Devuelve el usuario autenticado al igual que Auth::user()

		//Actualizo el nombre y el apellido en base a los puestos en el formulario
		$user->fill([
			'name'	=> $request->name,
			'lastname'	=> $request->lastname,
		]);

		//Almaceno el avatar en caso de que el usuario haya especificado uno nuevo
		$this->storeAvatar($request);

    	/**
    	 * Actualizo los datos del usuario en la BD
    	 */
    	$user->save();

    	return redirect()->route('panel::profile.edit')
    			->with('success_message', 'Tu perfil fue guardado con exito!');
    }


    /**
     * Almacena el avatar de un usuario en el caso de que esté 
     * presente en la request. Creo este método para no ensuciar el método update
     * y eventualmente podria reutilizarlo
     */
    protected function storeAvatar($request) {
    	$user = $request->user(); //El usuario de la request es el usuario autenticado. Podria obtenerlo también con Auth::user()

		/**
		 * Si cargaron una imagen en el formulario la subo
		 */
    	if($request->hasFile('avatar')) {
    		/**
    		 * En caso de que el usuario ya tuviera un avatar viejo,
    		 * lo borro ya que no lo necesito más
    		 */
    		$this->removeAvatarIfExists($user);
    		/**
    		 * 
    		 * En lugar de utilizar el método store, utilizo el método
    		 * storePublicly para que la almacena en la carpeta
    		 * storage/app/public, que es donde tenemos que guardar todas los
    		 * archivos que se suban mediante un formulario que necesitemos
    		 * que sean accesibles publicamente, por ejemplo, desde el navegador.
    		 *
    		 * Para que puedan ser accedidos publicamente tengo que acordarme
    		 * de crear el link simbolico en la carpeta public
    		 *
    		 * Para eso tengo ejecutar en el root del proyecto:
    		 * php artisan storage:link
    		 *
    		 * El cual crea un link simbolico en public/storage, apuntando a la
    		 * carpeta storage/app/public
    		 *
    		 * https://laravel.com/docs/5.3/filesystem#the-public-disk
    		 *
    		 * El segundo parámetro que le paso al método store es el disco en
    		 * el que lo quiero guardar, esto me permitiria por ejemplo guardarlo
    		 * en un servidor externo simplemente cambiando este parámetro
    		 * 
    		 * https://laravel.com/docs/5.3/filesystem
    		 * 
    		 */
    		
    		/**
    		 * Genero un nuevo nombre ya que si dos imágenes tienen el mismo
    		 * contenido, les pone el mismo nombre por defecto, lo cual si no lo
    		 * manejo cuidadosamente podria ser un problema, no es raro que dos
    		 * usuarios suban la misma imagen si uno la borrara, les desapareceria
    		 * a ambos. 
    		 */
    		
    		$newFilename = uniqid().".".$request->avatar->extension();

    		/**
    		 * Defino la carpeta en la que voy a guardar los avatares
    		 */
    		$folder = "avatars";

    		/**
    		 * Almaceno la imagen en el servidor con el nuevo nombre
    		 */
    		$path = $request->avatar->storeAs($folder, $newFilename, 'public'); 

    		/**
    		 * Guardo el path de la imagen en el usuario
    		 */
    		$user->avatar = $folder."/".$newFilename;
    	}
    }

    /**
     * Elimina el avatar de un usuario si tiene uno cargado
     * Esto se utiliza por ejemplo cuando se le sube uno nuevo
     *
     * Este método se podria reutilizar por ejemplo si se le diera 
     * a un usuario la posibilidad de borrar su avatar
     */
    protected function removeAvatarIfExists($user) {
    	if($user->avatar) {
    		/**
    		 * Storage::disk('public') va a buscar los archivos a la carpeta
    		 * storage/app/public, esto viene por defecto en config/filesystems.php
    		 *
    		 * https://laravel.com/docs/5.3/filesystem
    		 */
    		Storage::disk('public')->delete($user->avatar);
    	}
    }
}
