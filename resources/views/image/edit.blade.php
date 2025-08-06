@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Actualizar imagen</div>


                    <div class="card-body">
                        <form method="POST" action="{{ route('image.update') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="image-container--edit">
                                <h4> Imagen: </h4>
                                <img class="image-file--edit" src="{{ route('image.file', ['filename' => $image->imagen_path]) }}" alt="image" />
                            </div>

                            <input type="hidden" name="image_id" value="{{ $image->id }}">

                            <div class="form-group row card-edit">
                                <label for="image_path" class="col-md-3 col col-form-label text-md-end">Subir nueva imagen</label>
                                <div class="col-md-7">
                                    <input id="image_path" type="file" name="image_path" class="form-control @error('image_path') is-invalid @enderror">
                                    @error('image_path')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <br>

                            <div class="form-group row">
                                <label for="description" class="col-md-3 col col-form-label text-md-end" >Description</label>
                                <div class="col-md-7">
                                    <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" >{{ $image->description }}</textarea>
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <br>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-3">
                                    <input type="submit" class="btn btn-primary" value="Actualizar imagen">
                                </div>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
