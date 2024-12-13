<section class="card">
    <header class="card-header bg-info">
        <h4 class="mb-0 text-white">Image</h4>
    </header>
    <div class="card-body">       
            <div class="form-group my-2 file_manager_parent" > 
                <label class="form-label" for="">Thumbnail : </label>
                <input name="image" type="file" />
                @if($errors->has('image'))
                 <p class="invalid-feedback">{{$errors->first('image') }}</p>
                @endif 
            </div>
      </div>
</section>