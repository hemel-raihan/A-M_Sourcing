@extends('layouts.app')

@section('styles')

        <!-- INTERNAL SELECT2 CSS -->
        <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet"/>
		<!-- DATA TABLE CSS -->
		<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.css') }}" rel="stylesheet" />
		<link href="{{ asset('assets/plugins/datatable/css/buttons.bootstrap5.min.css') }}"  rel="stylesheet">
		<link href="{{ asset('assets/plugins/datatable/responsive.bootstrap5.css') }}" rel="stylesheet" />

@endsection

@section('content')

						<!-- PAGE-HEADER -->
						<div class="page-header">
							<div>
								<h1 class="page-title">Order Management/h1>
								{{-- <ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Tables</a></li>
									<li class="breadcrumb-item active" aria-current="page">Table</li>
								</ol> --}}
							</div>

						</div>
						<!-- PAGE-HEADER END -->

						<!-- Row -->
		<div class="row row-sm">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">All Orders</h3>
					</div>
					<div class="card-body">
						<div class="table-responsive export-table">
							<table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom  w-100">
								<thead>
									<tr>
										<th class="border-bottom-0">Order Number</th>
										<th class="border-bottom-0">Customer Name</th>
										<th class="border-bottom-0">Package</th>
                                        <th class="border-bottom-0">Status</th>
										<th class="border-bottom-0">Action</th>
									</tr>
								</thead>
								<tbody>
                                @foreach($orders as $order)
                                <input type="hidden" value="{{$order->id}}" id="order_id">
									<tr>
										<td>{{$order->order_code}}</td>
                                        <td>{{$order->address->name}}</td>
										<td>
                                            {{$order->price->title}}
                                            {{-- <select name="delivery_status" class=" form-control form-select select2 "  onchange='changeAction({{$order->id}})' id="update_delivery_status">
                                                <option value="pending" @if ($order->delivery_status == 'pending') selected @endif>Pending</option>
                                                <option value="processing" @if ($order->delivery_status == 'processing') selected @endif>Processing</option>
                                                <option value="completed" @if ($order->delivery_status == 'completed') selected @endif>Completed</option>
                                                <option value="rejected" @if ($order->delivery_status == 'rejected') selected @endif>Rejected</option>
                                            </select> --}}
                                        </td>
                                        <td>{{$order->delivery_status}}</td>
										<td>

                                            <a href="{{route('admin.all_orders.show',$order->id)}}" class="btn btn-success">
                                                <i class="fa fa-eye"></i>
                                            </a>

                                            <a href="#" class="btn btn-success">
                                            <i class="fa fa-edit"></i>
                                            </a>

                                        <button class="btn btn-danger waves effect" type="button"
                                            onclick="deletepost$post({{ $order->id}})" >
                                            <i class="fa fa-trash"></i>
                                            </button>
                                            <form id="deleteform-{{$order->id}}" action="#" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                            </form>
                                            </td>
									</tr>
                                @endforeach
								</tbody>
							</table>
                            {{ $orders->links('vendor.pagination.custom') }}
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Row -->

@endsection

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
    function deletepost$post(id)

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

<script>
    function changeAction(value){
        var order_id = value;
         var status = $('#update_delivery_status').val();
         alert(status);
        $.post('{{ route('admin.orders.update_delivery_status') }}', {
            _token:'{{ @csrf_token() }}',
            order_id:order_id,
            status:status
        }, function(data){

            iziToast.success({
            title: 'Success',
            message: 'Delivery status has been updated',
             });
             window.location.reload();
        });
}
    //  $('#update_delivery_status').on('change', function(){

    //     //var order_id = $('#order_id').val();
    //     var status = $('#update_delivery_status').val();
    //     var id = $(this).find('option:selected').attr('id');
    //     alert(id);
    //     $.post('{{ route('admin.orders.update_delivery_status') }}', {
    //         _token:'{{ @csrf_token() }}',
    //         order_id:id,
    //         status:status
    //     }, function(data){

    //         iziToast.success({
    //         title: 'Success',
    //         message: 'Delivery status has been updated',
    //          });
    //          window.location.reload();
    //     });
    // });
</script>

<!-- DATA TABLE JS-->
        <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
		<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.js') }}"></script>
		<script src="{{ asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
		<script src="{{ asset('assets/plugins/datatable/js/buttons.bootstrap5.min.js') }}"></script>
		<script src="{{ asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
		<script src="{{ asset('assets/plugins/datatable/pdfmake/pdfmake.min.js') }}"></script>
		<script src="{{ asset('assets/plugins/datatable/pdfmake/vfs_fonts.js') }}"></script>
		<script src="{{ asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
		<script src="{{ asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
		<script src="{{ asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
		<script src="{{ asset('assets/plugins/datatable/dataTables.responsive.min.js') }}"></script>
		<script src="{{ asset('assets/plugins/datatable/responsive.bootstrap5.min.js') }}"></script>
		<script src="{{ asset('assets/js/table-data.js') }}"></script>

       <!-- CHARTJS JS -->
		<script src="{{ asset('assets/plugins/chart/Chart.bundle.js')}}"></script>
		<script src="{{ asset('assets/plugins/chart/utils.js')}}"></script>

        <!-- INTERNAL SELECT2 JS -->
        <script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script>
		<script src="{{ asset('assets/js/select2.js') }}"></script>

@endsection
