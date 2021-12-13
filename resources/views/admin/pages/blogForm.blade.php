@extends('admin.layouts.main')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Add Blog
                    </h3>
                </div>
                <!-- /.card-header -->
                <form action="/administrator/blog" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title">
                                    @error('title')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Thumbnail Image</label>
                                    <input  onchange="readURL(this)" type="file" class="form-control-file @error('blog_image') is-invalid @enderror" id="blog_image" name="blog_image">
                                    @error('blog_image')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Category</label>
                                    <select class="form-control" name="category_id" id="category_id" name="category_id">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{$category->category_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Writer</label>
                                    <input type="text" class="form-control @error('writer') is-invalid @enderror" id="writer" name="writer">
                                    @error('writer')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div id="pre" class="form-group">

                                </div>
                            </div>
                            
                        </div>
                        <label>Content</label>
                        <textarea id="content" class="form-control @error('content') is-invalid @enderror" name="content" rows="10" cols="50"></textarea>
                        @error('content')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="card-footer">
                        <div class="text-right">
                            <button type="submit" class="btn btn-outline-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.col-->
    </div>
</section>

@endsection

@section('ajax')
<script type="text/javascript">
    var content = document.getElementById("content");
        CKEDITOR.replace(content,{
        language:'en-gb'
    });
    CKEDITOR.config.allowedContent = true;

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                // $('#preview').attr('src', e.target.result);
                let img = e.target.result;
                $('#pre').html(`<img src="${img}" width='200' class='img-thumbnail rounded mx-auto d-block' />`)
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

@endsection