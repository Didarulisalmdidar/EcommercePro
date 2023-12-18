<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="images/favicon.png" type="">
      <title>THE LAST CHAPTER</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="home/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="home/css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="home/css/responsive.css" rel="stylesheet" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header')
         <!-- end header section -->
         <!-- slider section -->
       
      <!-- end product section -->

      <!-- Comment section starts -->
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <table class="table">
                  <tbody>
                     <tr>
                        <th>Name</th>
                        <td>{{$user->name}}</td>
                     </tr>
                     <tr>
                        <th>Email</th>
                        <td>{{$user->email}}</td>
                     </tr>
                     <tr>
                        <th>Phone Number</th>
                        <td>
                           @foreach($phone as $phoneNumber)
                           {{$phoneNumber->phone}}<br>
                           @endforeach
                           
                           <form method="POST" action="{{ route('save-phone-number') }}">
                                 @csrf
                                 <input type="text" name="phone" class="phone-input" placeholder="Enter phone number">
                                 <button type="" class="save-phone-number btn btn-success">Save</button>
                              </form>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
      
      </div>
      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>
      
      

   </body>
</html>
