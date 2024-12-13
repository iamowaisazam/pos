<section class="card">
    <header class="card-header bg-info">
        <h4 class="mb-0 text-white">Select Category</h4>
    </header>
    <div class="card-body">        
            <div class="form-group">
               <select class="form-control" name="category_id" >
                @foreach($categories as $category)
                <?php  $subcats = $category->children; ?>
                   <option @if($product->category_id == $category->id) selected @endif value="{{$category->id}}">{{ $category->title }} </option>
                    @foreach($subcats as $child)
                      <option @if($product->category_id == $child->id) selected @endif value="{{$child->id}}">---- {{ $child->title }} </option>
                            @foreach($child->children as $subchild)
                            <option @if($product->category_id == $subchild->id) selected @endif value="{{$subchild->id}}" class="">--------- {{ $subchild->title }} </option>
                            @endforeach
                    @endforeach          
                @endforeach
               </select>
                @if($errors->has('category_id'))
                 <p class="invalid-feedback" >{{ $errors->first('category_id') }}</p>
                @endif 
            </div>
    </div>
</section>