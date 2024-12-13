<section class="card">
    <header class="card-header bg-info">
        <h4 class="mb-0 text-white">Description</h4>
    </header>
    <div class="card-body">
        <div class="editor-container">
        {{-- <textarea id="long_description"  class="form-control" 
        name="description">{{$product->description}}</textarea>     --}}
        <textarea id="long_description_default"  class="form-control" 
        name="description">{{$product->description}}</textarea>    
        </div>
    </div>
</section>