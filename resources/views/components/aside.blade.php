       <!--start sidebar -->
       <aside class="sidebar-wrapper" data-simplebar="true">
           <div class="sidebar-header">
               <div>
                   <img src="{{ asset('assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
               </div>
               <div>
                   <h4 class="logo-text">{{ env('APP_NAME') }}</h4>
               </div>
               <div class="toggle-icon ms-auto"> <i class="bi bi-list"></i>
               </div>
           </div>
           <!--navigation-->
           <ul class="metismenu" id="menu">
               {{-- dashboard --}}
               <li class="{{ request()->is('home') ? 'active' : '' }}">
                   <a href="{{ route('home') }}">
                       <div class="parent-icon"><i class="bi bi-house-fill"></i>
                       </div>
                       <div class="menu-title">Dashboard</div>
                   </a>
               </li>
               
               <x-select-device></x-select-device>
               
               {{-- file manager --}}
               <li class="{{ request()->is('file-manager') ? 'active' : '' }}">
                   <a href="{{ route('file-manager') }}">
                       <div class="parent-icon"><i class="bi bi-file-earmark-fill"></i>
                       </div>
                       <div class="menu-title">File Manager</div>
                   </a>

               </li>
               {{-- phone book --}}
               <li class="{{ request()->is('phonebook') ? 'active' : '' }}">
                   <a href="{{ route('phonebook') }}">
                       <div class="parent-icon"><i class="bi bi-telephone-fill"></i>
                       </div>
                       <div class="menu-title">Phone Book</div>
                   </a>
               </li>
               

               

               {{-- these menus only show if exists selected devices --}}
               @if (Session::has('selectedDevice'))
                   <li class="{{ request()->is('autoreply') ? 'active' : '' }}">
                       <a href="{{ route('autoreply') }}">
                           <div class="parent-icon"><i class="bi bi-chat-left-text-fill"></i>
                           </div>
                           <div class="menu-title">Auto Reply</div>
                       </a>
                   </li>
                   {{-- Create campaign --}}
                   <li class=" {{ url()->current() == route('campaign.create') ? 'mm-active' : '' }}">
                       <a class="" href="{{ route('campaign.create') }}">
                           <div class="parent-icon"><i class="bi bi-send-plus-fill"></i>
                           </div>
                           <div class="menu-title">Create Campaign</div>
                       </a>
                   </li>
                   {{-- end create campaign --}}
                   {{-- Message Test --}}
                   <li class=" {{ url()->current() == route('messagetest') ? 'mm-active' : '' }}">
                       <a class="" href="{{ route('messagetest') }}">
                           <div class="parent-icon"><i class="bi bi-chat-left-dots-fill"></i>
                           </div>
                           <div class="menu-title">Test Message</div>
                       </a>
                   </li>
                   
                   {{-- Message Test --}}
                   {{-- reports --}}
               <li>
                   <a href="javascript:;" class="has-arrow">
                       <div class="parent-icon">
                           {{-- histories icon --}}
                           <i class="bi bi-file-earmark-bar-graph-fill"></i>
                       </div>
                       <div class="menu-title">Reports</div>
                   </a>
                   <ul>
                       <li class="{{ request()->is('campaigns') ? 'active' : '' }}">
                           <a href="{{ route('campaigns') }}"><i class="bi bi-circle"></i>Campaign / Blast</a>
                       </li>
                       <li class="{{ request()->is('messages.history') ? 'active' : '' }}">
                           <a href="{{ route('messages.history') }}"><i class="bi bi-circle"></i>Messages History</a>
                       </li>

                   </ul>
               </li>
                   
               @endif

               {{-- Api Documentation --}}
                <li><hr></li>
               <li class=" {{ url()->current() == route('rest-api') ? 'mm-active' : '' }}">
                   <a class="" href="{{ route('rest-api') }}">
                       <div class="parent-icon"><i class="bi bi-code-square"></i>
                       </div>
                       <div class="menu-title">API Docs</div>
                   </a>
               </li>
               {{-- end api documentation --}}

               {{-- menus for admin --}}
               @if (Auth::user()->level == 'admin')
                   <li>
                       <a href="javascript:;" class="has-arrow">
                           <div class="parent-icon">
                               {{-- admin icon --}}
                               <i class="bi bi-person-lines-fill"></i>
                           </div>
                           <div class="menu-title">Admin</div>
                       </a>
                       <ul>
                           <li class="{{ request()->is('admin.settings') ? 'active' : '' }}">
                               <a href="{{ route('admin.settings') }}"><i class="bi bi-circle"></i>Setting Server</a>
                           </li>
                           <li class="{{ request()->is('admin.manage-users') ? 'active' : '' }}">
                               <a href="{{ route('admin.manage-users') }}">
                                <i class="bi bi-circle"></i>
                               Manage User</a>
                           </li>
                          
                       </ul>
                   </li>
                   <li><br></li>
                   <li><br></li>
               @endif


               {{-- <li class="menu-label">UI Elements</li> --}}



           </ul>
           <!--end navigation-->
       </aside>
       <!--end sidebar -->
