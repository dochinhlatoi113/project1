
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Document</title>
    <link href="{{asset('eshop/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('eshop/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('eshop/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('eshop/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('eshop/css/animate.css')}}"      rel="stylesheet">
	<link href="{{asset('eshop/css/main.css')}}"        rel="stylesheet">
	<link href="{{asset('eshop/css/responsive.css')}}"  rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">

    <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>-->
    <!--[if lt IE asset(]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
<style>
.color{
    border-radius: 10px;
    background-color: red;
    width: 20px;
   
}
.color-box{
    display: flex;
    justify-content: space-around;
}
.size{
   border:1px solid silver;
   width: 50px;
    height: 20px;
    text-align: center;

}
</style>
</head>
<body>
    
    <header id="header">   
        @include('layout.front.header')
    </header>

    <section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
                        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                            @include('front.sidebar.category')
                        </div>
                        <div class="brands_products"><!--brands_products-->
                            @include('front.sidebar.brand')
                        </div><!--/brands_products-->
                        <div class="price-range"><!--price-range-->
                            @include('front.sidebar.filter_condition')
                        </div><!--/price-range-->
                    </div> 
                </div>

                <div class="col-sm-9 padding-right">
                     @yield('content')
                </div>
             </div>
        </div>
    </section>

    <footer id="header">   
        @include('layout.front.footer')
    </footer>



    <!--
    <script src="{{asset('eshop/js/jquery.js')}}"></script>
	<script src="{{asset('eshop/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('eshop/js/jquery.scrollUp.min.js')}}"></script>
	<script src="{{asset('eshop/js/price-range.js')}}"></script>
    <script src="{{asset('eshop/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('eshop/js/main.js')}}"></script>
    <script src="js/imagepreview/imagepreview.min.js" type="text/javascript"></script>
    -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
	

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
 
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });     
    </script>

    @yield('script')

</body>
</html>