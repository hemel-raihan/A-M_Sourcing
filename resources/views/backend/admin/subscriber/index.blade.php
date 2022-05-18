@extends('layouts.app')

@section('styles')

@endsection

@section('content')

						<!-- PAGE-HEADER -->
						<div class="page-header">
							<div>
								<h1 class="page-title">Subscribers</h1>
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
								<div class="card custom-card">
									<div class="card-body">
										<div>
											<h3 class="card-title mb-1">All Subscriber</h3>
										</div>
										<div class="table-responsive">
											<table class="table border text-nowrap text-md-nowrap table-striped mg-b-0">
												<thead>
													<tr>
														<th>No</th>
														<th>Email</th>
                                                        <th>Action</th>
													</tr>
												</thead>
												<tbody>
                                                    @foreach($subscribers as $key=>$subscriber)
													<tr>
														<td>{{$key+1}}</td>
														<td>{{$subscriber->email}}</td>
                                                        <td>

                                                       <button class="btn btn-danger waves effect" type="button"
                                                        onclick="deletepost$subscribe({{ $subscriber->id}})" >
                                                        <span class="material-icons">delete</span>
                                                        </button>
                                                        <form id="deleteform-{{$subscriber->id}}" action="{{route('admin.subscribers.destroy',$subscriber->id)}}" method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                        </form>
                                                        {{-- @endif --}}
                                                        </td>
													</tr>
                                                    @endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>

@endsection('content')

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
    function deletepost$subscribe(id)

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

        <!-- Select2 js-->
		<script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>

@endsection
