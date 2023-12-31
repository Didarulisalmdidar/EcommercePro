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
     <style>
        .center 
        {
            margin:auto;
            width:50%;
            text-align:center;
            padding:30px;
        }
        table,td
        {
            border:1px solid grey;
        }
        th 
        {
            font-size:20px;
            background-color:skyblue;
            border:1px solid grey;
            padding:10px;
        }
        .img_deg 
        {
            height:100px;
            width:100px;
        }
        .tot_deg 
        {
           
            font-size:20px;
            padding-top:10px;
            color:blue;
            
        }
     </style>
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header')
         <!-- end header section -->
         <!-- slider section -->
        
         <!-- end slider section -->
         @if(session()->has('message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                x</button>
                {{session()->get('message')}}

            </div>
        @endif
     
      <div class="center">
      
        <table>
            <tr>
                <th>Product Title</th>
                <th>Product Quantity</th>
                <th>Price</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
            <?php $total_price=0 ?>
            @foreach ($cart as $cart)
            <tr>
                <td>{{$cart->product_title}}</td>
                <td>{{$cart->quantity}}</td>
                <td>${{$cart->price}}</td>
                <td><img class="img_deg" src="/product/{{$cart->image}}" alt=""></td>
                <td><a class="btn btn-danger" onclick="return confirm('Are You Sure To Remove')" href="{{url('/remove_cart',$cart->id)}}">Remove</a></td>

            </tr>
            <?php $total_price=$total_price + $cart->price?>

            @endforeach
            
        </table>
        <div>
            <h1 class="tot_deg">Total Price : {{$total_price}}tk</h1>
        </div>
        <div style="padding-top:20px;">
            <h1 style="font-size:25px;padding-bottom:10px;">Proceed To Order</h1>
            <a class="btn btn-danger"href="{{url('cash_order')}}">Cash on Delivery</a>
            <a class="btn btn-danger"href="{{url('stripe',$total_price)}}">Pay Using Card</a>
        </div>
      </div>
      <!-- why section -->
      
      <!-- end client section -->
      <!-- footer start -->
     
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© All Rights Reserved Authority <a href="https://html.design/">  </a><br>
         
              <a href="https://themewagon.com/" target="_blank"></a>
         
         </p>
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