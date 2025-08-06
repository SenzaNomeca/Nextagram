<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use App\Models\Comment;
use App\Models\Like;

class ImageController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function create(){
        return view('image.create');
    }

    public function save(Request $request){

        //Validacion
        $validate = $this->validate($request, [
            'description' => 'required',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        //Recoger datos
        $image_path = $request->file('image_path');
        $description = $request->input('description');


        //Asignar valores al objeto e identificar User
        $user = Auth::user();
        $image = new image();
        $image->user_id = $user->id;
        $image->description = $description;

        // Subir fichero
        if($image_path){
            $image_path_name = time() .'_' .$image_path->getClientOriginalName();

            // Instanciar el ImageManager
            $manager = new ImageManager(new Driver());

            // Redimensionamos la imagen on Inervention
//            $resized_image = $manager->read($image_path)
//            ->resize(null, 700, function ($constraint) {
//                $constraint->aspectRatio();
//                $constraint->upsize();
//            })->encode(); // Lo convierte en binario

            Storage::disk('images')->put($image_path_name, File::get($image_path));
            // Guardo nombre en base de datos
            $image->imagen_path = $image_path_name;
        }

        $image->save();

        return redirect()->route('home')->with('status', 'Image successfully uploaded');


    }

    public function getImage($filename){
        if(Storage::disk('images')->get($filename)){
            $file = Storage::disk('images')->get($filename);
            return new Response($file, 200);
        }else{
            $path = public_path('img/img-broke.png');

            if (file_exists($path)) {
                $file = file_get_contents($path);
                return new Response($file, 200, [
                    'Content-Type' => 'image/png'
                ]);
            } else {
                return response('Imagen no encontrada', 404);
            }
        }

    }

    public function detalle($id){
        $image = image::find($id);

        return view('image.detail', ['image' => $image]);
    }

    public function delete($id){
        $user = Auth::user();

        $image = image::find($id);
        $comments = $image->comments;
        $likes = $image->likes;

        if($user && $image && $image->user->id == $user->id){
            // delete comments
            if($comments && count($comments) > 0){
                foreach($comments as $comment){
                    $comment->delete();
                }
            }
            // delete likes
            if($likes && count($likes) > 0){
                foreach($likes as $like){
                    $like->delete();
                }
            }

            // delete images paths
            Storage::disk('images')->delete($image->imagen_path);

            // delete register from image
            $image->delete();
            $message = array('message' => 'Imagen eliminada correctamente');
        }else{
            $message = array('message' => 'Error al eliminar imagen');
        }
        return redirect()->route('home')->with('message', $message);
    }

    public function edit($id){
        $user = Auth::user();
        $image = image::find($id);

        if($user && $image && $image->user_id == $user->id){
            return view('image.edit', ['image' => $image]);
        }else{
            return redirect()->route('home');
        }
    }

    public function update(Request $request){
        $user = Auth::user();

        //Validacion
        $validate = $this->validate($request, [
            'description' => 'required',
            'image_path' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        // Recoger datos
        $image_id = $request->input('image_id');
        $description = $request->input('description');
        $image_path = $request->file('image_path');

        // Conseguir objeto de la image en BD
        $image = image::find($image_id);
        $image->description = $description;

        // Subir fichero en nuestra carpeta
        if($image_path){
            $image_path_name = time() .'_' .$image_path->getClientOriginalName();

            Storage::disk('images')->put($image_path_name, File::get($image_path));
            // Guardo nombre en base de datos
            $image->imagen_path = $image_path_name;
        }

        //Actualizo registro
        $image->update();
        return redirect()->route('image.detail', ['id' => $image_id])->with('status', 'Imagen actualizada correctamente');
    }
}
