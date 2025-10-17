@extends('.layouts.app')

			@section('content')
					
					<!-- Content Wrapper. Contains page content -->
					  <div class="content">
					    <!-- Content Header (Page header) -->
						    
						    <!-- Main content -->
						    <div class="content">
						    		<equip usertype="{{ Auth::user()->userType }}"></equip>
						     </div>
					    <!-- /.content -->
					  </div>
			@endsection

