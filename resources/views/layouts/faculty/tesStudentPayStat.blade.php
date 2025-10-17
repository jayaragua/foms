@extends('.layouts.app')

			@section('content')
					
					<!-- Content Wrapper. Contains page content -->
					  <div class="content">
					    <!-- Content Header (Page header) -->
						    
						    <!-- Main content -->
						    <div class="content">
						    		<tesstudentpaystat usertype="{{ Auth::user()->userType }}"></tesstudentpaystat>
						     </div>
					    <!-- /.content -->
					  </div>
			@endsection

