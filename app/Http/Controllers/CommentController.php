<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;

class CommentController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function save(Request $request){

        $validate = $this->validate($request, [
            'image_id' => 'int|required',
            'content' => 'string|required',

        ]);

        $user = Auth::user();
        $image_id = $request->input('image_id');
        $content = $request->input('content');

        $comment = new Comment();
        $comment->user_id =  $user->id;
        $comment->image_id = $image_id;
        $comment->content = $content;

        $comment->save();

        return redirect()->route('image.detail', ['id' => $image_id])->with('status', 'Haz comentado correctamente!');

    }

    public function delete($id){
        // Consigo datos del usuario identificado
        $user = Auth::user();

        //Conseguir objeto del comment
        $comment = Comment::find($id);

        // Necesito el id de la imagen para el return
        $image_id = $comment->image_id;

        // Comprobar si soy el sue;o del comment o de la pulicacion
         if($user && ($comment->user_id == $user->id || $comment->image->user_id == $user->id)){
            $comment->delete();
         }else{
             return redirect()->route('image.detail', ['id' => $image_id])->with('status', 'El comentario no se ha eliminado!');
         }
        return redirect()->route('image.detail', ['id' => $image_id])->with('status', 'Haz eliminado tu comentario correctamente!');
    }
}
