@extends('.layouts.app')

			@section('content')
					
					<!-- Content Wrapper. Contains page content -->
					  <!-- <div class="content"> -->
					    <!-- Content Header (Page header) -->
						    
						    <!-- Main content -->
						    <!-- <div class="content"> -->
						    		<trips usertype="{{ Auth::user()->userType }}"></trips>
						     <!-- </div> -->
					    <!-- /.content -->
					  <!-- </div> -->
			@endsection

