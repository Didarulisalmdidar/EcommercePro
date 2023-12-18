<header class="header_section">
            <div class="container">
               <nav class="navbar navbar-expand-lg custom_nav-container ">
                  <a class="navbar-brand" href="{{url('/')}}"><img width="70" src="images/book_logo.jpg" alt="#" /></a>
                  <p style="color: red; width: 500px; font-weight: bold;">THE LAST CHAPTER</p>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                   <span class=""> </span> 
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                     <ul class="navbar-nav">
                     <!-- <li class="nav-item active">
                           <a class="nav-link" href="{{url('/')}}">The Last Page <span class="sr-only">(current)</span></a>
                        </li> -->
                        <!-- <li class="nav-item">
                        <a class="navbar-brand" href="{{url('/')}}"><img width="50" src="images/book_logo.jpg" alt="#" /></a>
                        </li> -->
                        <li class="nav-item active">
                           <a class="nav-link" href="{{url('/')}}">Home <span class="sr-only">(current)</span></a>
                        </li> 
                        <li class="nav-item">
                           <a class="nav-link" href="{{url('about_us')}}">ABOUT</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="{{url('products')}}">Products</a>
                        </li>
                        <!-- <li class="nav-item">
                           <a class="nav-link" href="blog_list.html">Blog</a>
                        </li> -->
                        <!-- <li class="nav-item">
                           <a class="nav-link" href="contact.html">Contact</a>
                        </li> -->
                        <li class="nav-item">
                           <a class="nav-link" href="{{url('show_cart')}}">Cart</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="{{url('show_order')}}">Order</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="{{url('show_profile')}}">Profile</a>
                        </li>
                        
                        <!-- <form class="form-inline">
                           <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit">
                           <i class="fa fa-search" aria-hidden="true"></i>
                           </button>
                        </form> -->
                       
                        @if (Route::has('login'))
                        @auth
                        <x-app-layout>
   
                      </x-app-layout>
                        @else
                        <li class="nav-item">
                           <a class="btn btn-primary"id="logincss" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                           <a class="btn btn-success" href="{{ route('register') }}">Register</a>
                        </li>
                        @endauth
                        @endif
                     </ul>
                  </div>
               </nav>
            </div>
         </header>