<!-- END: Content-->

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

<!-- BEGIN: Footer-->
<footer class="footer footer-static footer-light navbar-border navbar-shadow">
    <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-block d-md-inline-block">Copyright &copy; 2019 <a class="text-bold-800 grey darken-2" href="https://1.envato.market/modern_admin" target="_blank">PIXINVENT</a></span><span class="float-md-right d-none d-lg-block">Hand-crafted & Made with<i class="ft-heart pink"></i><span id="scroll-top"></span></span></p>
</footer>
<!-- END: Footer-->


<!-- BEGIN: Vendor JS-->
<script src="{{URL::asset('assets/app-assets/vendors/js/vendors.min.js')}}"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{URL::asset('assets/app-assets/vendors/js/charts/chart.min.js')}}"></script>
<script src="{{URL::asset('assets/app-assets/vendors/js/charts/raphael-min.js')}}"></script>
<script src="{{URL::asset('assets/app-assets/vendors/js/charts/morris.min.js')}}"></script>
<script src="{{URL::asset('assets/app-assets/vendors/js/charts/jvector/jquery-jvectormap-2.0.3.min.js')}}"></script>
<script src="{{URL::asset('assets/app-assets/vendors/js/charts/jvector/jquery-jvectormap-world-mill.js')}}"></script>
<script src="{{URL::asset('assets/app-assets/data/jvector/visitor-data.js')}}\"></script>
<script src="{{URL::asset('assets/app-assets/vendors/js/forms/icheck/icheck.min.js')}}"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{URL::asset('assets/app-assets/js/core/app-menu.js')}}"></script>
<script src="{{URL::asset('assets/app-assets/js/core/app.js')}}"></script>
<!-- END: Theme JS-->
@toastr_js
@toastr_render

@yield('script')
</body>
<!-- END: Body-->

</html>
