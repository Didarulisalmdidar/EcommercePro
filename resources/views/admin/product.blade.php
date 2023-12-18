<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <title>Admin Panel</title>
    @include('admin.css')
    <style>
        .center 
        {
            text-align:center;
            padding-top:40px;
        }

        .font-size 
        {
            font-size:40px;
            padding-bottom:40px;
        }
        .text-color 
        {
            color:black;
        }
        label 
        {
            display:inline-block;
            width:200px;
        }
        .div_design
        {
            padding-bottom:15px;
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
           @if(session()->has('message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                x</button>
                {{session()->get('message')}}

            </div>

            @endif
            <div class="center">
                <h1 class="font-size">Add Product</h1>
                <form action="{{url('/add_product')}}" method="POST" enctype="multipart/form-data">
                @csrf
            
                <div class="div_design">
                <label for="">Product Title : </label>
                <input class="text-color" type="text" name="title" placeholder="Add a Title" required="">
                </div>
                <div class="div_design">
                <label for="">Product Description : </label>
                <input class="text-color" type="text" name="description" placeholder="Add a Description" required="">
                </div>
                <div class="div_design">
                <label for="">Product Price : </label>
                <input class="text-color" type="number" min="0" name="price" placeholder="Enter Price" required="">
                </div>
                <div class="div_design">
                <label for="">Product Quantity : </label>
                <input class="text-color" type="number" name="quantity" placeholder="Add Quantity" required="">
                </div>
                <div class="div_design">
                <label for="">Discount Price : </label>
                <input class="text-color" type="number" name="dis_price" placeholder="Enter Price">
                </div>
                <div class="div_design">
                <label for="">Prduct Category : </label>

                <select class="text-color" name="category" id="" required="">
                <option value="" selected="">Add a Category Here</option>
                @foreach ($category as $category)
                    <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                @endforeach
                   
                </select>
                </div >
                <div class="div_design">
                <label for="">Product Image : </label>
                <input type="file" name="image" required="">
                </div>
                <div class="div_design">
                <div >
                <input type="submit" value="Add Product" class="btn btn-primary">
                </div>
              </form>
            </div>

          </div>
       </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>