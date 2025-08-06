<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function config(){


        return view('user.config');
    }

    public function update(Request $request)
    {
        //Conseguir usuario y su ID
        $user = Auth::user();
        $id = $user->id;

        //Validacion del form
        $validate = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'nick' => ['required', 'string', 'max:255', 'unique:users,nick,' .$id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' .$id],
        ]);

        // Recoger datos del form mediante el request
        $name = $request->input('name');
        $surname = $request->input('surname');
        $nick = $request->input('nick');
        $email = $request->input('email');

        // Hago el update a traves de objeto del user
        $user->name = $name;
        $user->surname = $surname;
        $user->nick = $nick;
        $user->email = $email;

        //Subir la imagen
        $imagen_path = $request->file('image_path');
        if($imagen_path){
            //Pongo nombre unico
          $image_path_name = time() .$imagen_path->getClientOriginalName();

          // Guardar en la carpeta sotrage (storage/app/users)
          Storage::disk('users')->put($image_path_name, File::get($imagen_path));

          // Seteo el nombre de la imagen en el objeto
          $user->image = $image_path_name;
        }


        // Ejecutar cambios en DB
        $user->update();

        return redirect()->route('user.config')-> with('status', 'Usuario actualizado correctamente');


    }

    public function getImage($filename){
        $file = Storage::disk('users')->get($filename);
        return new Response($file, 200);
    }

    public function profile($id){
        $user = User::find($id);
        return view('user.profile', ['user' => $user]);
    }

    public function index($search = null){
        if(!empty($search)){
            $users = User::where('nick', 'LIKE', '%' . $search . '%')
                ->orWhere('name', 'LIKE', '%' . $search . '%')
                ->orWhere('surname', 'LIKE', '%' . $search . '%')
                ->orderBy('id', 'desc')
                ->paginate(5);
        }else{
            $users = User::orderBy('id', 'desc')
                ->paginate(5);
        }

        return view('user.index', ['users' => $users]);
    }

}
