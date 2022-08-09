<?php 
    namespace App\Helpers;

    use App\Http\Requests\ImageRequest;
    use Illuminate\Support\Facades\Storage;

    class AjaxImage{
        public function mediaUpdate(ImageRequest $request,  $object)
        {
            if ($request->hasFile('image')) {
    
                $object->clearMediaCollection('images');
                $object->addMediaFromRequest('image')
                ->toMediaCollection('images');
    
            }
    
            return redirect()->route('admin.index');
        }
    }
?>