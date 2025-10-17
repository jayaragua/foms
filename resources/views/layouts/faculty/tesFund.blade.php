@extends('.layouts.app')

			@section('content')
					
					<!-- Content Wrapper. Contains page content -->
					  <div class="content">
					    <!-- Content Header (Page header) -->
						    
						    <!-- Main content -->
						    <div class="content">
						    		<tesfund usertype="{{ Auth::user()->userType }}"></tesfund>
						     </div>
					    <!-- /.content -->
					  </div>
			@endsection

