<!-- ================== BEGIN core-js ================== -->
<script src="{{ asset('admin/js/vendor.min.js') }}"></script>
<script src="{{ asset('admin/js/app.min.js') }}"></script>
<script src="{{ asset('/admin/plugins/@fortawesome/fontawesome-free/js/fontawesome.min.js') }}"></script>

@isset($extraJs)
    @foreach ($extraJs as $js)
        <script src="{{ $js }}"></script>;
    @endforeach
@endisset

@php
    $path = Request::path();
    $dir_path = public_path() . '/js/' . $path;
    if (is_dir($dir_path)) {
        $directory = new DirectoryIterator($dir_path);
        while ($directory->valid()) {
            if (!$directory->isDir()) {
                $filename = url('js/' . $path . '/' . $directory->getFilename());
                echo '<script src="'.$filename.'"></script>';
            }
            $directory->next();
        }
    }
@endphp
