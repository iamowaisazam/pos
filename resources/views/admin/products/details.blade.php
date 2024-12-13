<section class="card">
    <header class="card-header bg-info">
        <h4 class="mb-0 text-white">Details</h4>
    </header>
    <div class="card-body"> 
        <div class="col-12">
            <div class="form-group">
                <textarea rows="10" cols="10" placeholder="Details..." class="form-control" 
                name="details">{{$product->short_description}}</textarea>
                @if($errors->has('short_description'))
                <p class="invalid-feedback" >{{ $errors->first('short_description') }}</p>
                @endif
            </div>
        </div>
    </div>
</section>