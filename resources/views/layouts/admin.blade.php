@extends('layouts.master')

@section('title')
	Admin - Dashboard
@endsection

@section('meta')
   <!-- Custom meta for this template -->
   @include('layouts.partials.admin._meta')
@endsection

@section('styles')
   <!-- Custom styles for this template -->
   @include('layouts.partials.admin._styles')
@endsection

@section('navbar')
    @include('layouts.partials.admin._navbar')
@endsection

@section('main')                    
<div id="wrapper">
    <!-- Sidebar -->
    @include('layouts.partials.admin._sidebar')
       
    <div id="content-wrapper">
        <div class="container-fluid">
            
            @yield('breadcrumb')
            @yield('content')
        </div><!-- /.container-fluid -->
        <!-- Sticky Footer -->
        @include('layouts.partials.admin._footer')
    </div><!-- /.content-wrapper -->
</div><!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Custom scripts for this template -->
    @include('layouts.partials.admin._scripts')
@endsection