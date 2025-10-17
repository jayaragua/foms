@extends('.layouts.app')

			@section('content')
					
					<!-- Content Wrapper. Contains page content -->
					  <div class="content">
					    <!-- Content Header (Page header) -->
						    
						    <!-- Main content -->
						    <div class="content">
						    		<fundutildtl usertype="{{ Auth::user()->userType }}"></fundutildtl>
						     </div>
					    <!-- /.content -->
					  </div>
			@endsection

