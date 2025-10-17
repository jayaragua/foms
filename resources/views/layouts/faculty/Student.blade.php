@extends('.layouts.app')

			@section('content')
					
					<!-- Content Wrapper. Contains page content -->
					  <div >
					    <!-- Content Header (Page header) -->
						    
						    <!-- Main content -->
						    <div class="content">
						    		<student usertype="{{ Auth::user()->userType }}"></student>
						     </div>
					    <!-- /.content -->
					  </div>
			@endsection

