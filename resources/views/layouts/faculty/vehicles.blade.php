@extends('.layouts.app')

			@section('content')
					
					<!-- Content Wrapper. Contains page content -->
					  <div class="content">
					    <!-- Content Header (Page header) -->
						    
						    <!-- Main content -->
						    <div class="content">
						    		<vec usertype="{{ Auth::user()->userType }}"></vec>
						     </div>
					    <!-- /.content -->
					  </div>
			@endsection

