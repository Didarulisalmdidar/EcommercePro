<!DOCTYPE html>
<html lang="en">
  <head>
  <title>ORDER</title>
    <!-- Required meta tags -->
    @include('admin.css')
    <style>
        .title_deg 
        {
            text-align:center;
            font-size:30px;
            font-weight:bold;
            padding-bottom:40px;
        }
        .table_deg 
        {
            text-align:center;
            border:2px solid white;
            margin:auto;
            width:100%;
        }
        th
        {
            background-color:skyblue;
        }
        th,td 
        {
            border:2px solid white;
           
        }
        .img_size 
        {
            height:150px;
            width:150px;
        }
        .search_deg 
        {
          margin:auto;
          text-align:center;
          padding-left:100px;
          padding-bottom:30px;
          color:black;
        }
       
    </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
       @include('admin.header')
        <!-- partial -->
        <div class="main-panel">
           
          <div class="content-wrapper">
            <div>
              <h1 class="title_deg">All orders</h1>
              <div class="search_deg">
                <form action="{{url('search')}}" method="get">
                  @csrf
                  <input type="text" name="search" placeholder="search something">
                  <input type="submit" value="search" class="btn btn-outline-primary">
                </form>

              </div >
              <table class="table_deg">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Product Title</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Payment Status</th>
                    <th>Delivery Status</th>
                    <th>Image</th>
                    <th>Delivered</th>
                    <th>Print PDF</th>
                    
                </tr>
                @forelse($order as $order)
                <tr>
                    <td>{{$order->name}}</td>
                    <td>{{$order->email}}</td>
                    <td>{{$order->address}}</td>
                    <td>{{$order->phone}}</td>
                    <td>{{$order->product_title}}</td>
                    <td>{{$order->quantity}}</td>
                    <td>{{$order->price}}</td>
                 
                    <td>{{$order->payment_status}}</td>
                    <td>{{$order->deliver_status}}</td>
                    <td> 
                       <img class="img_size" src="/product/{{$order->image}}" alt="">
                    </td>
                    <td>
                        @if($order->deliver_status=="processing")
                        <a href="{{url('delivered',$order->id)}}" onclick="return confirm('Are You Sure This Product is Delivered')" class="btn btn-primary">Deliver</a>
                        @else
                        <p style="color:green;">Done</p>
                        @endif
                    </td>
                    <td>
                        <a href="{{url('print_pdf',$order->id)}}" class="btn btn-secondary">PDF</a>
                    </td>
                </tr>
                @empty
                <tr>
                <td colspan="20">
                  No data Found
                </td>

                </tr>
               
                @endforelse
              </table>
            </div>
     
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>