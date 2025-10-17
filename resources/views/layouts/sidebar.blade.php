<!-- Main Sidebar Container -->
  <aside class="main-sidebar navbar-light bg-light">
    <!-- Brand Logo -->
   <a href="#" class="brand-link logo-switch">
  <!-- <img src="https://cdn.pixabay.com/photo/2020/07/01/12/58/icon-5359553_960_720.png" alt="GADTC" class="brand-image-xl logo-xs"> -->
  <!-- <img src="https://cdn.pixabay.com/photo/2020/07/01/12/58/icon-5359553_960_720.png" alt="AdminLTE" class="brand-image-xs logo-xl" style="left: 12px"> -->
  FOMS-ADMIN
</a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <!-- <img src="https://cdn.pixabay.com/photo/2020/07/01/12/58/icon-5359553_960_720.png" alt="GADTC" class="logo-xl"> -->
          <!-- <img style= "height: auto;" src="https://cdn.pixabay.com/photo/2020/07/01/12/58/icon-5359553_960_720.png" class="img-circle elevation-2" alt="User Image"> -->
        </div>
        <div class="info">
          
           @if (Auth::guest())
                <p>GADTC</p>
                @else
                    <a href="/home" class="d-block"><b>{{ Auth::user()->name}}</b></a>
                @endif
          <a href="home"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
       
      </div>
       
      @if (Auth::user()->userType==='Admin')
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item">
            <a href="/home" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>  
          
         

         

          <li class="nav-item has-treeview">
            <a href="/trip-ticket" class="nav-link">
            <i class="nav-icon fas fa-car"></i>
              <p>
                Trip Ticket
                
              
              </p>
            </a>

                

          </li>
    
          

          <li class="nav-item has-treeview">
            <a href="/equipment" class="nav-link">
              <i class="nav-icon fas fa-id-card-alt"></i>
              <p>
                Equipment
                
              
              </p>
            </a>

                

          </li>

          <li class="nav-item">
            <a href="/tesdocs" class="nav-link">
              <i class="nav-icon fa fa-file-pdf-o"></i>
              <p>
                Driver
              
              </p>
            </a>
          </li>

          <!-- <li class="nav-item">
            <a href="attendance" class="nav-link">
          
              <i class="fas fa-list nav-icon"></i>
              <p>
                Payroll
              
              </p>
            </a>
          </li> -->

          <li class="nav-item has-treeview">
            <a href="/user" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <!-- <i class="fas fa-users"></i> -->
              <p>
              Office
                
              </p>
            </a>
           
          </li>

          <li class="nav-item has-treeview">
            <a href="/logs" class="nav-link">
            <i class="nav-icon fas fa-clipboard-list"></i>
              <!-- <i class="fas fa-users"></i> -->
              <p>
              Logs
                
              </p>
            </a>
           
          </li>

           <li class="nav-item">
            <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <!-- <i class="nav-icon fas fa-ticket-alt"></i> -->
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              
              </p>
            </a>


            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>



            <!-- <a href="#" class="btn btn-default btn-flat float-right"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Sign out
                        </a> -->
                       
          </li>
          <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Simple Link
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li> -->
        </ul>
      </nav>
    @endif


    @if (Auth::user()->userType==='Acctg')
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item">
            <a href="/home" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>  
          
      

          <li class="nav-item">
            <a href="" class="nav-link">
              <i class="nav-icon fas fa-id-card-alt"></i>
              <p>
                Fund Utilization
                <i class="right fas fa-angle-left"></i>
              
              </p>
            </a>

                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="/tes-fund" class="nav-link ">
                      &nbsp;&nbsp;&nbsp;&nbsp;<i class="nav-icon fas fa-users"></i>
                        <p>TES Fund</p>
                      </a>
                    </li>
                 
                    <!-- <li class="nav-item">
                      <a href="/tes-fund-disbursement" class="nav-link ">
                      &nbsp;&nbsp;&nbsp;&nbsp;<i class="nav-icon fas fa-portrait"></i>
                        <p>TES Disbursements</p>
                      </a>
                    </li> -->
                  
                  </ul>

          </li>

      
           <li class="nav-item">
            <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <!-- <i class="nav-icon fas fa-ticket-alt"></i> -->
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              
              </p>
            </a>


            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>



            <!-- <a href="#" class="btn btn-default btn-flat float-right"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Sign out
                        </a> -->
                       
          </li>
          <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Simple Link
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li> -->
        </ul>
      </nav>
    @endif

      @if (Auth::user()->userType==='User')
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item">
            <a href="/home" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>  
          
      

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user-circle"></i>
              <p>
              Students
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/student" class="nav-link ">
                &nbsp;&nbsp;&nbsp;&nbsp;<i class="nav-icon fas fa-users"></i>
                  <p>Student's Master List</p>
                </a>
              </li>
        
              <li class="nav-item">
                <a href="/tes-student" class="nav-link ">
                &nbsp;&nbsp;&nbsp;&nbsp;<i class="nav-icon fas fa-portrait"></i>
                  <p>TES Grantees</p>
                </a>
              </li>


              <li class="nav-item">
                <a href="/not-enrolled" class="nav-link ">
                &nbsp;&nbsp;&nbsp;&nbsp;<i class="nav-icon fas fa-portrait"></i>
                  <p>Not Enrolled</p>
                </a>
              </li>
            
            </ul>
          </li>
    
          

          <li class="nav-item">
            <a href="/tes-fund" class="nav-link">
              <i class="nav-icon fas fa-id-card-alt"></i>
              <p>
                Fund Utilization
              
              </p>
            </a>
          </li>


          <li class="nav-item">
            <a href="/tesdocs" class="nav-link">
              <i class="nav-icon fa fa-file-pdf-o"></i>
              <p>
                Documents
              
              </p>
            </a>
          </li>

          <!-- <li class="nav-item">
            <a href="attendance" class="nav-link">
              
              <i class="fas fa-list nav-icon"></i>
              <p>
                Payroll
              
              </p>
            </a>
          </li> -->

        

           <li class="nav-item">
            <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <!-- <i class="nav-icon fas fa-ticket-alt"></i> -->
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              
              </p>
            </a>


            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>



            <!-- <a href="#" class="btn btn-default btn-flat float-right"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Sign out
                        </a> -->
                       
          </li>
          <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Simple Link
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li> -->
        </ul>
      </nav>




      <!-- /.sidebar-menu -->
      @else
 



    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
<!-- 
          <li class="nav-item">
            <a href="/home" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>      -->

          
          <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Simple Link
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li> -->
        </ul>
      </nav>
      @endif
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>



