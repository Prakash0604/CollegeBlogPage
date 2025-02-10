@extends('admin.layout.main')
@section('content')
    <div class="container-fluid ">
        <button type="button" class="btn  btn-primary" id="addEventBtnToggle">
            <i class="bi bi-plus-lg "></i>  Add Event
          </button>
          {{-- @include('admin.event.eventmodal') --}}
          @include('admin.event.create_event')

          <div
            class="table-responsive mt-4 mb-4"
          >
{{-- form  --}}
            <table
                class="table table-bordered table-striped  "
                id="fetch-event-data"
            >
                <thead>
                    <tr>
                        <th scope="col">S.N</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Type</th>
                        <th scope="col">Starting Date</th>
                        <th scope="col">Ending Date</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
            </table>
          </div>


    </div>
    @push('style-items')
    <style>
        .create_event_container{
            background: linear-gradient(#2d5858f2,#b99248a8);
            display: none;
        }


    </style>
    @endpush

    @push('script-items')

<<script>
    // Function to apply alternating gradient colors (Onion Skin)
    function applyOnionSkinColors() {
      const items = document.querySelectorAll('.onionskin');
      const colors = ['#FFFFFF', '#D8B0FF', '#8A2BE2']; // White, Light Purple, Purple

      // Generate the gradient layers by repeating the colors 100 times
      let gradient = '';
      for (let i = 0; i < 100; i++) {
        gradient += `${colors[i % colors.length]} ${i * 1}%, `;
      }
      // Remove the trailing comma and space
      gradient = gradient.slice(0, -2);

      // Apply the radial gradient to each .onionskin item
      items.forEach((item) => {
        item.style.background = `radial-gradient(circle, ${gradient})`;
      });
    }

    // Function to apply the grey fur wolf gradient
    function applyGreyFurWolves() {
      const items = document.querySelectorAll('.greyfurwolves');
      const colors = ['#808080', '#D3D3D3', '#C0C0C0', '#8B4513']; // Grey, Light Grey, White Silver, Brown

      // Generate the gradient layers by repeating the colors 200 times
      let gradient = '';
      for (let i = 0; i < 200; i++) {
        gradient += `${colors[i % colors.length]} ${i * 1.5}%, `;
      }
      // Remove the trailing comma and space
      gradient = gradient.slice(0, -2);

      // Apply the linear gradient to each .greyfurwolves item with a top-right to bottom-left tilt
      items.forEach((item) => {
        item.style.background = `linear-gradient(45deg, ${gradient})`; // 45deg gives the tilt from top-right to bottom-left
      });
    }

    // Call both functions when the page is loaded
    window.onload = function() {
      applyOnionSkinColors();
      applyGreyFurWolves();
    };
  </script>



    @endpush
@endsection
