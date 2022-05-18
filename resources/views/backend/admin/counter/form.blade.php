@extends('layouts.app')

@section('styles')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- FILE UPLODE CSS -->
        <link href="{{ asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css"/>
		<!-- INTERNAL Fancy File Upload css -->
		<link href="{{ asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
        <!-- WYSIWYG EDITOR CSS -->
        <link href="{{ asset('assets/plugins/wysiwyag/richtext.css') }}" rel="stylesheet"/>

        <!-- SUMMERNOTE CSS -->
        <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.css') }}">

        <!-- INTERNAL Quill css -->
        <link href="{{ asset('assets/plugins/quill/quill.snow.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/plugins/quill/quill.bubble.css') }}" rel="stylesheet">
        <!-- INTERNAL SELECT2 CSS -->
        <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet"/>

		<!-- INTERNAL Jquerytransfer css-->
		<link rel="stylesheet" href="{{ asset('assets/plugins/jQuerytransfer/jquery.transfer.css') }}">
		<link rel="stylesheet" href="{{ asset('assets/plugins/jQuerytransfer/icon_font/icon_font.css') }}">


		<!-- MULTI SELECT CSS -->
		<link rel="stylesheet" href="{{ asset('assets/plugins/multipleselect/multiple-select.css') }}">

		<!--INTERNAL IntlTelInput css-->
		<link rel="stylesheet" href="{{ asset('assets/plugins/intl-tel-input-master/intlTelInput.css') }}">

		<!-- INTERNAL multi css-->
		<link rel="stylesheet" href="{{ asset('assets/plugins/multi/multi.min.css') }}">






		        <!-- FILE UPLODE CSS -->
				<link href="{{ asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css"/>

				<!-- SELECT2 CSS -->
				<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet"/>

				<!-- INTERNAL Fancy File Upload css -->
				<link href="{{ asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />

				<!--BOOTSTRAP-DATERANGEPICKER CSS-->
				<link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.css') }}">

				<!-- TIME PICKER CSS -->
				<link href="{{ asset('assets/plugins/time-picker/jquery.timepicker.css') }}" rel="stylesheet"/>

				<!-- INTERNAL Date Picker css -->
				<link href="{{ asset('assets/plugins/date-picker/date-picker.css') }}" rel="stylesheet" />

				<!-- INTERNAL Sumoselect css-->
				<link rel="stylesheet" href="{{ asset('assets/plugins/sumoselect/sumoselect.css') }}">

				<!-- INTERNAL Jquerytransfer css-->
				<link rel="stylesheet" href="{{ asset('assets/plugins/jQuerytransfer/jquery.transfer.css') }}">
				<link rel="stylesheet" href="{{ asset('assets/plugins/jQuerytransfer/icon_font/icon_font.css') }}">

				<!-- INTERNAL Bootstrap DatePicker css-->
				<link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.css') }}">

				<!-- MULTI SELECT CSS -->
				<link rel="stylesheet" href="{{ asset('assets/plugins/multipleselect/multiple-select.css') }}">

				<!--INTERNAL IntlTelInput css-->
				<link rel="stylesheet" href="{{ asset('assets/plugins/intl-tel-input-master/intlTelInput.css') }}">

				<!-- INTERNAL multi css-->
				<link rel="stylesheet" href="{{ asset('assets/plugins/multi/multi.min.css') }}">

@endsection

@section('content')

						<!-- PAGE-HEADER -->
						<div class="page-header">

							<div class="ms-auto pageheader-btn">
								<a href="{{route('admin.counters.index')}}" class="btn btn-primary btn-icon text-white me-2">
									<span>
										{{-- <i class="fe fe-minus"></i> --}}
									</span> Back To List
								</a>
							</div>
						</div>

	<div class="row">
		{{-- Left Side --}}

        <div class="col-lg-7 col-xl-7 col-md-12 col-sm-12">
			<div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Faqs</h3>

                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom  w-100">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">Title</th>
                                    <th class="border-bottom-0">Number</th>
                                    <th class="border-bottom-0">Extra Text</th>
                                    <th class="border-bottom-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
		</div>

<div class="col-lg-5 col-xl-5 col-md-12 col-sm-12">
    <form method="POST"  enctype="multipart/form-data">

    <div id="create" class="card">
        <div class="card-header">
            <h3 class="card-title">Create New Counter</h3>
        </div>
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group">
                <label for="exampleInputname">Title</label>
                <input type="text" class="form-control" value="" name="title"  id="create_name">
            </div>

            <div class="form-group">
                <label for="exampleInputname">Number</label>
                <input type="number" class="form-control" value="" name="number"  id="create_number">
            </div>

            <div class="form-group">
                <label for="exampleInputname">Color</label>
                <input type="text" class="form-control" placeholder="ex: #fff" name="color"  id="create_color">
            </div>

            <div class="form-group">
                <label for="exampleInputname">Icon</label>
                <input type="text" class="form-control" placeholder="ex: user,download,smile " name="icon"  id="create_icon">
            </div>

            <div class="form-group">
                <label for="exampleInputname">Extra Text (k+, m+)</label>
                <textarea name="extra_text" class="my-editor form-control" id="create_extra_text" style="height: 200px;" cols="30" rows="10"></textarea>
            </div>


        </div>
        <div class="card-footer text-end">
            <button type="submit" id="btn_submit" class="btn btn-success mt-1">
                <i class="fas fa-arrow-circle-up"></i>
                Save
            </button>

        </div>
    </div>

    <div id="edit" class="card" style="display: none;">
        <div class="card-header">
            <h3 class="card-title">Edit Category</h3>
        </div>
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <input type="hidden" id="counter_edit_id" value="">

            <div class="form-group">
                <label for="exampleInputname">Name</label>
                <input type="text" class="form-control" value="" name="title"  id="edit_name">
            </div>

            <div class="form-group">
                <label for="exampleInputname">Number</label>
                <input type="number" class="form-control" value="" name="number"  id="edit_number">
            </div>

            <div class="form-group">
                <label for="exampleInputname">Color</label>
                <input type="text" class="form-control" placeholder="ex: #fff" name="color"  id="edit_color">
            </div>

            <div class="form-group">
                <label for="exampleInputname">Icon</label>
                <input type="text" class="form-control" placeholder="ex: user,download,smile " name="icon"  id="edit_icon">
            </div>

            <div class="form-group">
                <label for="exampleInputname">Extra Text</label>
                <textarea name="extra_text" class="my-editor form-control" id="edit_extra_text" style="height: 200px;" cols="30" rows="10"></textarea>
            </div>


        </div>
        <div class="card-footer text-end">
            <button type="submit" id="btn_submit_edit" class="btn btn-success mt-1">
                <i class="fas fa-arrow-circle-up"></i>
                Update
            </button>

        </div>
    </div>


</form>
</div>

	</div>

	<!-- ROW-1 CLOSED -->
@endsection()

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
    function deletepost$counter(id)

    {
        Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {
   event.preventDefault();
   document.getElementById('deleteform-'+id).submit();
  }
})
    }
    </script>

@section('scripts')




<script type="text/javascript">


$(document).ready(function(){

    fetchcounter();

function fetchcounter()
{
    $.ajax({
        type: "GET",
        url: "{{route('admin.counters.fetch')}}",
        dtaType: "json",
        success: function(response)
        {
            $('tbody').html('');
            $.each(response.counters, function(key, item){


                var id = item.id;



                var delete_url = '{{ route("admin.counters.destroy", ":counter") }}';
                delete_url = delete_url.replace(':counter', id);

                $('tbody').append(`<tr>
                        <td>`+item.title+`</td>
                        <td>`+item.number+`</td>
                        <td>`+item.extra_text+`</td>
                        <td>
                            <button class="edit_category btn btn-success waves effect" type="button"
                            value="`+item.id+`" >
                            <i class="fa fa-edit"></i>
                            </button>
                            <button class="btn btn-danger waves effect" type="button"
                            onclick="deletepost$counter(`+item.id+`)" >
                            <i class="fa fa-trash"></i>
                            </button>
                            <form id="deleteform-`+item.id+`" action="`+delete_url+`" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                            </form>
                        </td>
                        </tr>`);
            });
        }
    });
}



$(document).on('click', '.edit_category', function(e){
    e.preventDefault();
    var counter_id = $(this).val();
    //document.getElementById("name").value = tax_id;
    var urll = '{{ route("admin.counters.edit", ":counter") }}';
    urll = urll.replace(':counter', counter_id);
    $.ajax({
        type: 'GET',
        url: urll,
        success: function(response)
        {
            if(response.status == 404)
            {
                iziToast.success({
                title: 'Error',
                message: response.message,
                 });
            }
            else
            {
                $.each(response.counterss, function(key, item){
                    $('#create').hide();
                    $('#edit').show();
                    $("#counter_edit_id").val(item.id);
                    $("#edit_name").val(item.title);
                    $("#edit_number").val(item.number);
                    $("#edit_color").val(item.color);
                    $("#edit_icon").val(item.icon);
                    $("#edit_extra_text").val(item.extra_text);
                });
            }
        }
    });
});

    $("#btn_submit_edit").click(function(e){

        e.preventDefault();
        var name = $("#edit_name").val();
        var number = $("#edit_number").val();
        var color = $("#edit_color").val();
        var icon = $("#edit_icon").val();
        var extra_text = $("#edit_extra_text").val();
        var counter_id = $("#counter_edit_id").val();
        var urll = '{{ route("admin.counters.update", ":counter") }}';
        urll = urll.replace(':counter', counter_id);

        // var data = {
        //     _token: "{{ csrf_token() }}";
        //     'name' : name;
        //     'tax' : tax_id;
        // }
        $.ajax({
        url: urll,
        method: 'PUT',
        data:{
                _token: "{{ csrf_token() }}",
                title:name,
                number:number,
                color:color,
                icon:icon,
                extra_text:extra_text,
                id: counter_id,
                },
        dataType: 'json',
        success:function(response){
            if(response.success){
                iziToast.success({
                title: 'Success',
                message: 'Successfully add menu in the list',
                });
            }else{
                iziToast.success({
                title: 'Error',
                message: 'Something Wrong',
                });
            }
            fetchcounter();
            $('#edit_name').val('');
            $('#edit_number').val('');
            $('#edit_color').val('');
            $('#edit_icon').val('');
            $('#edit_extra_text').val('');
        },
        error:function(error){
            console.log(error)
        }
        });

    });


    $("#btn_submit").click(function(e){

        e.preventDefault();
        var name = $("input[name=title]").val();
        var number = $("input[name=number]").val();
        var color = $("input[name=color]").val();
        var icon = $("input[name=icon]").val();
        var extra_text = $("#create_extra_text").val();
        var url = '{{ route('admin.counters.store') }}';

        $.ajax({
        url:url,
        method:'POST',
        data:{
                _token: "{{ csrf_token() }}",
                title:name,
                number:number,
                color:color,
                icon:icon,
                extra_text:extra_text,
                },
        success:function(response){
            if(response.success){

                iziToast.success({
                title: 'Success',
                message: 'Successfully add menu in the list',
                 });
            }else{
                iziToast.success({
                title: 'Error',
                message: 'Something Wrong',
                 });
            }
            fetchcounter();
            $('#create_name').val('');
            $('#create_number').val('');
            $('#create_color').val('');
            $('#create_icon').val('');
            $('#create_extra_text').val('');
        },
        error:function(error){
            console.log(error)
        }
        });

    });
});




</script>


        <!-- <script>
            $('#select-all').click(function(event){
                if(this.checked)
                {
                    $(':checkbox').each(function(){
                        this.checked = true;
                    });
                }
                else
                {
                    $(':checkbox').each(function(){
                        this.checked = false;
                    });
                }
            });
         </script> -->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


        <!-- CHARTJS JS -->
        <script src="{{ asset('assets/plugins/chart/Chart.bundle.js')}}"></script>
		<script src="{{ asset('assets/plugins/chart/utils.js')}}"></script>

        <!-- INTERNAL SELECT2 JS -->
        <script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script>
		<script src="{{ asset('assets/js/select2.js') }}"></script>
		<!-- FILE UPLOADES JS -->
		<script src="{{ asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
		<script src="{{ asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>

		<!-- INTERNAL File-Uploads Js-->
		<script src="{{ asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
        <script src="{{ asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
        <script src="{{ asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
        <script src="{{ asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
        <script src="{{ asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>

		<!-- WYSIWYG Editor JS -->
		<script src="{{ asset('assets/plugins/wysiwyag/jquery.richtext.js') }}"></script>
		<script src="{{ asset('assets/plugins/wysiwyag/wysiwyag.js') }}"></script>

		<!-- INTERNAL multi js-->
		<script src="{{ asset('assets/plugins/multi/multi.min.js') }}"></script>

				<!-- MULTI SELECT JS-->
				<script src="{{ asset('assets/plugins/multipleselect/multiple-select.js') }}"></script>
				<script src="{{ asset('assets/plugins/multipleselect/multi-select.js') }}"></script>

						<!-- FORMELEMENTS JS -->
		<script src="{{ asset('assets/js/formelementadvnced.js') }}"></script>
		<script src="{{ asset('assets/js/form-elements.js') }}"></script>


		<!-- INTERNAL jquery transfer js-->
		<script src="{{ asset('assets/plugins/jQuerytransfer/jquery.transfer.js') }}"></script>

		<!-- SUMMERNOTE JS -->
		<script src="{{ asset('assets/plugins/summernote/summernote-bs4.js') }}"></script>

		<!-- FORMEDITOR JS -->
		<script src="{{ asset('assets/plugins/quill/quill.min.js') }}"></script>
		<script src="{{ asset('assets/js/form-editor2.js') }}"></script>

@endsection
