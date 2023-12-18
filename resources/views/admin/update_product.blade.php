<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <title>Update_Product</title>
    <base href="/public">
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
                <h1 class="font-size">Update Product</h1>
                <form action="{{url('/update_product_confirm',$product->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
            
                <div class="div_design">
                <label for="">Product Title : </label>
                <input class="text-color" type="text" name="title" placeholder="Add a Title" required="" value="{{$product->title}}">
                </div>
                <div class="div_design">
                <label for="">Product Description : </label>
                <input class="text-color" type="text" name="description" placeholder="Add a Description" required="" value="{{$product->description}}">
                </div>
                <div class="div_design">
                <label for="">Product Price : </label>
                <input class="text-color" type="number" min="0" name="price" placeholder="Enter Price" required="" value="{{$product->price}}">
                </div>
                <div class="div_design">
                <label for="">Product Quantity : </label>
                <input class="text-color" type="number" name="quantity" placeholder="Add Quantity" required="" value="{{$product->quantity}}">
                </div>
                <div class="div_design">
                <label for="">Discount Price : </label>
                <input class="text-color" type="number" name="dis_price" placeholder="Enter Price" value="{{$product->discount_price}}">
                </div>
                <div class="div_design">
                <label for="">Product Category : </label>

                <select class="text-color" name="category" id="" required="" >
                <option value="{{$product->category}}" selected="">{{$product->category}}</option>
                @foreach ($category as $category)
                    <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                @endforeach
                   
                </select>
                </div >
                <div class="div_design">
                <label for="">Current Product Image : </label>
                <img style="margin:auto;" height=100 width=100 src="/product/{{$product->image}}" alt="">
                </div>
                <div class="div_design">
                <label for=""> Change Product Image : </label>
                <input  type="file" name="image" >
                </div>
                <div class="div_design">
                <div >
                <input type="submit" value="Update Product" class="btn btn-primary">
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