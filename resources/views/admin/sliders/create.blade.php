<x-admin.layouts.admin_master>

        <h1 class="h3 mb-3"> sliders</h1>

        <div class="card-header">
            Create sliders <a class="btn btn-info" href="{{route('sliders.index')}}">List</a>

        </div>

        <div class="card-body">
            <form action="{{route('sliders.store')}}" method="post" enctype="multipart/form-data">

                @csrf
                <div class="mb-3">
                    <label for="inputTitle" class="col-sm-3 col-form-label">SliderTitle</label>
                    <div class="col-8">
                        <input type="text"
                               class="form-control"
                               id="inputTitle"
                               name="slider_title"
                               value="">

                    </div>
                </div>

                <div class="mb-3">
                    <label for="inputTitle" class="col-sm-3 col-form-label">ShortTitle</label>
                    <div class="col-8">
                        <input type="text"
                               class="form-control"
                               id="inputTitle"
                               name="short_title"
                               value="">

                    </div>
                </div>
                <div class="mb-3">
                    <label for="inputPicture" class="col-sm-3 col-form-label">Picture</label>
                    <div class="col-8">
                        <input type="file"
                               class="form-control"
                               id="inputPicture"
                               name="slider_image"
                               value="">

                    </div>
                </div>

                <div class="mb-3">
                    <div class="col-sm-8">
                        <button type="submit" class="btn btn-info">Submit</button>
                    </div>

                </div>

            </form>
        </div>

</x-admin.layouts.admin_master>
