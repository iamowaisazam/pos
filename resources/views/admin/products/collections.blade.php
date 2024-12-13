<section class="card">
    <header class="card-header bg-info">
        <h4 class="mb-0 text-white">Select Collections</h4>
    </header>
    <div class="card-body">        

                <?php 
                  $idz = $product->collection->pluck('collection_id')->toArray();    
                ?>
               
                @foreach ($collections as $collect)
                   <div style="display: flex;justify-content: space-between;" class="form-group">
                        <label for="collection-{{$collect->id}}">{{$collect->title}}</label>
                        <input
                          @if(in_array($collect->id,$idz)) checked @endif 
                          id="collection-{{$collect->id}}" 
                          type="checkbox"
                          value="{{$collect->id}}"  
                        name="collections[{{$collect->id}}]" />
                    </div>
                @endforeach

                @if($errors->has('collections'))
                 <p class="invalid-feedback" >{{ $errors->first('collections') }}</p>
                @endif 
            
    </div>
</section>