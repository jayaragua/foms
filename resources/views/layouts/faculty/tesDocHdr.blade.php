@extends('.layouts.app')

			@section('content')
					
					<!-- Content Wrapper. Contains page content -->
					  <div class="content">
					    <!-- Content Header (Page header) -->
						    
						    <!-- Main content -->
						    <div class="content">
						    		<tesdochdr1 usertype="{{ Auth::user()->userType }}"></tesdochdr1>
						     </div>
					    <!-- /.content -->
					  </div>
			@endsection

