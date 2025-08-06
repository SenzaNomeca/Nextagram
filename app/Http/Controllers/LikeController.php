<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;

class LikeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function like($image_id){
        // Recoger datos del user y la imagen
        $user = Auth::user();

        // Condicion para ver si ya existe el like y no duplicado
        $isset_like = Like::where('user_id', $user->id)
        ->where('image_id', $image_id)->count();

        if($isset_like == 0){
            $like = new Like();
            $like->user_id = $user->id;
            $like->image_id = (int)$image_id;

            //Guardo en BD
            $like->save();

            return response()->json([
                'like' => $like,
            ]);
        }else{
            return response()->json([
                'message' => "Eliminar like",
            ]);
        }
    }
    public function unlike($image_id){
        // Recoger datos del user y la imagen
        $user = Auth::user();

        // Condicion para ver si ya existe el like y no duplicado
        $like = Like::where('user_id', $user->id)
            ->where('image_id', $image_id)
            ->first();

        if($like){
            // Eliminar de la BD
            $like->delete();

            return response()->json([
                'like' => true,
                'message' => 'Dislike realizado correctamente'
            ]);
        }

        return response()->json([
            'like' => false,
            'message' => 'No se encontró el like para eliminar'
        ], 404);
    }

    public function index(){
        $user = Auth::user();
        $likes = Like::where('user_id', $user->id)
            ->orderBy('id', 'desc')
            ->paginate(5);

        return view('like.likes', ['likes' => $likes]);
    }
}
