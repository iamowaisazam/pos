<section class="card">
    <header class="card-header bg-info">
        <h4 class="mb-0 text-white" >Seo Details</h4>
    </header>
    <div class="card-body">
        
        <div class="form-group">
            <label class="form-label">Meta Title</label>
            <input placeholder="Meta Title" type="text" value="{{$product->meta_title}}" name="meta_title" class="form-control" />
            @if($errors->has('meta_title'))
             <p class="invalid-feedback" >{{ $errors->first('meta_title') }}</p>
            @endif
        </div>

        <div class="form-group">
            <label class="form-label">Meta Description</label>
            <input type="text" placeholder="Meta Description" 
            value="{{$product->meta_description}}" name="meta_description" class="form-control" />
            @if($errors->has('meta_description'))
             <p class="invalid-feedback" >{{ $errors->first('meta_description') }}</p>
            @endif
        </div>

        <div class="form-group">
            <label class="form-label">Meta Keywords</label>
            <input type="text" placeholder="Meta Keywords" 
            value="{{$product->meta_keywords}}" name="meta_keywords" 
            class="form-control" />
            @if($errors->has('meta_keywords'))
             <p class="invalid-feedback" >{{ $errors->first('meta_keywords') }}</p>
            @endif
        </div>

    </div>
</section>