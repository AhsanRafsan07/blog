@extends('admin.layouts.app')
@section('content')

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Manage Products</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
          </div>

          <!-- Content Row -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>SL</th>
                      <th>SKU</th>
                      <th>Name</th>
                      <th>Image</th>
                      <th>Price</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>SL</th>
                      <th>SKU</th>
                      <th>Name</th>
                      <th>Image</th>
                      <th>Price</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php $i = 1; ?>
                    @foreach($data['products_list'] as $products)
                    <tr>
                      <td>{{ $i }}</td>
                      <td>{{ $products->product_sku }}</td>
                      <td>{{ $products->product_name }}</td>
                      <td><img class="" src="{{ asset('images/product_image/'.$products->product_image) }}"  width='50' height='50' alt="SHOW IMAGE HERE"></td>
                      <td>{{ $products->product_price }}</td>
                      <td></td>
                    </tr>
                    <?php $i++; ?>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
@endsection

     