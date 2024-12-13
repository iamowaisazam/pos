<section class="card">
    <header class="card-header bg-info">
        <div class="row">
            <div class="col-6">
                <h4 class="mb-0 text-white">Gallery</h4>
            </div>
            <div class="col-6 text-end">
                {{-- <span class="add_image" ><i class="text-white fas fa-plus"></i></span> --}}
            </div>
        </div>           
    </header>

    
    <div class="card-body">
        <div class="form-group my-2 file_manager_parent">
            <label class="form-label" for="hover_image">Gallery Images :</label>
            <select multiple class="file_manager" name="gallery[]" id="gallery">
                {{-- <option disabled>Select an option</option> --}}
                @foreach($productImages as $key=>$image)
   
                <option selected value="{{ $image }}" id="{{ $image }}">
                    {{ $image }}
                </option>
                      
                    </option>
                @endforeach
            </select>
        </div>
        {{-- <div class="row el-element-overlay gallery-box">
           @foreach($product->get_images() as $key => $item)
           <div class="col-lg-3 col-md-6">
           <div class="card">
                <div class="el-card-item mb-0 pb-0">
                    <div class="el-card-avatar el-overlay-1">
                        <img src="{{asset($item->path)}}" />
                        <div class="el-overlay">
                            <ul class="el-info">
                                <li>
                                    <a class="btn default btn-outline image-popup-vertical-fit" 
                                    href="{{asset($item->path)}}">
                                        <i class="icon-magnifier"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="btn default btn-outline" 
                                    href="{{URL::to('admin/products/remove-image/'.Crypt::encryptString($product->id))}}?image={{$item->id}}">
                                        <i class="mdi mdi-close"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
           </div>
           @endforeach
           
        </div> --}}
    </div>
</section>