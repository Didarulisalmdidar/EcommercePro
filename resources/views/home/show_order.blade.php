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
        .table-deg 
        {
            margin:auto;
            padding-top:20px;
            width:50%;
            text-align:center;
            
        }
        th 
        {
            background-color:skyblue;
            border:1px solid black;
        }
        td 
        {
            border:1px solid black;
        }
        .img-deg 
        {
            height: 100px;
            width: 100%;
        }
        .h1-deg 
        {
            text-align:center;
            padding-top:20px;
            padding-bottom:20px;
            font-size:50px;
            color: blue;
        }
      </style>
   </head>
   <body>
     
         <!-- header section strats -->
         @include('home.header')
         <h1  class="h1-deg">My Orders </h1>
         <div>
            <table class="table-deg">
                <tr>
                <th>Product Titlle</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Payment Status</th>
                <th>Delivery Status</th>
                <th>Image</th>
                <th>Cancel Order</th>

                </tr>
                @foreach($order as $order)
                <tr>
                    <td>{{$order->product_title}}</td>
                    <td>{{$order->quantity}}</td>
                    <td>{{$order->price}}</td>
                    <td>{{$order->payment_status}}</td>
                    <td>{{$order->deliver_status}}</td>
                    <td>
                        <img class="img-deg" src="product/{{$order->image}}">
                    </td>
                    <td>
                        @if($order->deliver_status=='processing')
                        <a onclick="return confirm('Are you sure to delete the order')"class="btn btn-danger"href="{{url('/cancel_order',$order->id)}}">cancel</a>
                        @else
                        <p style="color:blue;">Not Allow</p>
                        @endif
                    </td>


                </tr>

                @endforeach
               
            </table>

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