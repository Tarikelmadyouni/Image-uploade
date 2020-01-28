<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use App\ImageUpload;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;


class UploadsController extends Controller
{

        public function index()
        {

              $images= ImageUpload::latest()->get();
              
                 return view('welcome', compact('images'));
        }


     public function store()
     {
               if( ! is_dir(public_path('/images'))){

                     mkdir(public_path('/images'),0777);
               }
            
               $images=Collection::wrap( request()->file('file'));


           $images->each(function($image){

                $basename= Str::random();
                
                $original =$basename. '.' . $image->getClientOriginalExtension();
                $thumbnail =$basename. '_thumb.' . $image->getClientOriginalExtension();


                  Image::make($image)
                    ->fit(250,250)
                    ->save(public_path('/images/'. $thumbnail));
              

                $image->move(public_path('/images'), $original);



                ImageUpload::create([
                    
                    'original'=> '/images/'.$original,
                    'thumbnail'=> '/images/'.$thumbnail,
                    
                    ]);
              });
          
             
     }


       public function destroy(ImageUpload $imageUpload)
       {
        //Delete the file(orignal and thumbnail) 
        File::delete([
          
             public_path($imageUpload->original),
             public_path($imageUpload->thumbnail),
        ]);
         
               $imageUpload->delete();


        return redirect('/');
       }


}
