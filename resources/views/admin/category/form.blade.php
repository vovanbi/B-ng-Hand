<form action="" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="form-group">
                <label for="name"> Tên danh mục:</label>
                <input type="text" class="form-control" placeholder="Tên danh mục" value="{{ old('name',isset($category->c_name) ? $category->c_name : '') }}" name="name" required>
                @if($errors->has('name'))<span class="error-text">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="form-group">
                <img id="out_img" src="{{ asset('image/unnamed.png') }}" style="height: 100px;width: 100px">
            </div>
            <div class="form-group">
                <label for="name"> Hình ảnh:</label>
                <input type="file" id="input_img" name="avatar" class="form-control" {{ isset($category) ? '' : 'required' }}>
            </div>
            <button type="submit" class="btn btn-success"> Lưu thông tin</button>
        </div>
    </div>
</form>
