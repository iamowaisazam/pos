<div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="variationsForm" method="post" action="{{ URL::to('/admin/products/variations/'.Crypt::encryptString($product->id)) }}">
                @csrf
                <input type="hidden" class="product-id" value="{{ Crypt::encryptString($product->id) }}">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Generate Variations</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
                </div>
                <div class="modal-body">
                    @foreach ($attributes as $attribute)
                    @if($attribute->is_enable == 1)
                        <div class="">
                            <label class="form-label">{{$attribute->title}}:</label>
                            <select multiple 
                                    class="attributes select3" 
                                    name="attr[{{$attribute->id}}][]" >
                                @foreach ($attribute->values as $option)
                                <option value="{{$option->id}}">{{$option->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    @endforeach
                    
                    <div class="f pt-3">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success text-white">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.modal -->