@extends('.layouts.app')

			@section('content')
					
					<!-- Content Wrapper. Contains page content -->
					  <div class="content">
					    <!-- Content Header (Page header) -->
						    
						    <!-- Main content -->
						    <div class="content">
						    		<tesstudentnotenrolay usertype="{{ Auth::user()->userType }}"></tesstudentnotenrolay>
						     </div>
					    <!-- /.content -->
					  </div>
			@endsection

