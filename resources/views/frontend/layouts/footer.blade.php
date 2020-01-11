
    <footer>
        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3  col-md-3 col-sm-4 col-xs-6">
                        <h3> Support </h3>
                        <ul>
                            <li class="supportLi">
                                <p> For Issues And Concerns Contact Us </p>
                                <h4><a class="inline" href="tel:{{ $aboutinfo[0]->mobile }}"> <strong> <i class="fa fa-phone"> </i> {{ $aboutinfo[0]->mobile }} </strong> </a></h4>
                                <h4><a class="inline" href="mailto:{{ $aboutinfo[0]->email }}"> <i class="fa fa-envelope-o"> </i> {{ $aboutinfo[0]->email }} </a></h4>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-2  col-md-2 col-sm-4 col-xs-6">
                        <h3> Shop </h3>
                        <ul>
                            @foreach($topcategory as $category)
                            <li><a href="{{ url('category-product', [$category->id, str_slug($category->name)] )}}">{{$category->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div style="clear:both" class="hide visible-xs"></div>
                    <div class="col-lg-2  col-md-2 col-sm-4 col-xs-6">
                        <h3> Information </h3>
                        <ul class="list-unstyled footer-nav">
                            <li><a href="/our-blog"> Blog </a></li>
                            <li><a href="/policy"> Return Policy </a></li>
                            <li><a href="/terms"> Terms &amp; Conditions </a></li>
                            <li><a href="/contact">
                                    Contact Us
                                </a></li>
                        </ul>
                    </div>
                    <div class="col-lg-2  col-md-2 col-sm-4 col-xs-6">
                        <h3> Payment Methods </h3>
                        <ul>
                            <li>
                                Cash On Delivery - COD
                            </li>
                            <li>
                                Swipe On Delivery - SOD
                            </li>
                        </ul>
                    </div>
                    <div style="clear:both" class="hide visible-xs"></div>
                    <div class="col-lg-3  col-md-3 col-sm-6 col-xs-12 ">
                        <h3>Stay in touch </h3>
                        <ul>
                            <li>
                            </li>
                        </ul>
                        <ul class="social">
                            <li><a href="{{ $aboutinfo[0]->facebook }}" target=_blank> <i class=" fa fa-facebook"> &nbsp; </i> </a></li>
                            <li><a href="{{ $aboutinfo[0]->twitter }}" target=_blank> <i class=" fa fa-twitter"> &nbsp; </i> </a></li>
                            <li><a href="{{ $aboutinfo[0]->youtube }}" target=_blank> <i class=" fa fa-youtube"> &nbsp; </i> </a></li>
                            <li><a href="{{ $aboutinfo[0]->instagram }}" target=_blank> <i class=" fa fa-instagram"> &nbsp; </i> </a></li>
                        </ul>
                        <br />
                        <br />
                        <p>VOROSA SHOP is an online grocery store which delivers your prescription and non-prescription medicines and products to your home. Now buy medicines online and get it home delivered.</p>
                    </div>
                </div>
                <!--/.row-->
            </div>
            <!--/.container-->
        </div>
        <!--/.footer-->
        <div class="footer-bottom">
            <div class="container">
                <p class="pull-left"> &copy; VOROSA SHOP 2019. All right reserved. </p>
            </div>
        </div>
        <!--/.footer-bottom-->
    </footer>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/pace.min.js')}}"></script>
    <script src="{{asset('js/owl.carousel.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            function customPager() {
                $.each(this.owl.userItems, function (i) {
                    var pagination1 = $('.owl-controls .owl-pagination > div:first-child');
                    var pagination = $('.owl-controls .owl-pagination');
                    $(pagination[i]).append("<div class=' owl-has-nav owl-next'><i class='fa fa-angle-right'></i>  </div>");
                    $(pagination1[i]).before("<div class=' owl-has-nav owl-prev'><i class='fa fa-angle-left'></i> </div>");
                });
            }
            // YOU MAY ALSO LIKE  carousel
            $("#SimilarProductSlider").owlCarousel({
                navigation: false, // Show next and prev buttons
                afterInit: customPager,
                afterUpdate: customPager
            });
            var SimilarProductSlider = $("#SimilarProductSlider");
            SimilarProductSlider.owlCarousel({
                navigation: false, // Show next and prev buttons
                afterInit: customPager,
                afterUpdate: customPager
            });
            // Custom Navigation Events
            $("#SimilarProductSlider .owl-next").click(function () {
                SimilarProductSlider.trigger('owl.next');
            })
            $("#SimilarProductSlider .owl-prev").click(function () {
                SimilarProductSlider.trigger('owl.prev');
            })
        });
    </script>
    <script>
	    var ph = "Search Medicines And Product",
	        searchBar = $('#SearchAllProduct'),
	        // placeholder loop counter
	        phCount = 0;

	    // function to return random number between
	    // with min/max range
	    function randDelay(min, max) {
	        return Math.floor(Math.random() * (max - min + 1) + min);
	    }

	    // function to print placeholder text in a
	    // 'typing' effect
	    function printLetter(string, el) {
	        // split string into character seperated array
	        var arr = string.split(''),
	            input = el,
	            // store full placeholder
	            origString = string,
	            // get current placeholder value
	            curPlace = $(input).attr("placeholder"),
	            // append next letter to current placeholder
	            placeholder = curPlace + arr[phCount];

	        setTimeout(function() {
	            // print placeholder text
	            $(input).attr("placeholder", placeholder);
	            // increase loop count
	            phCount++;
	            // run loop until placeholder is fully printed
	            if (phCount < arr.length) {
	                printLetter(origString, input);
	            }
	            // use random speed to simulate
	            // 'human' typing
	        }, randDelay(50, 90));
	    }

	    // function to init animation
	    function placeholder() {
	        $(searchBar).attr("placeholder", "");
	        printLetter(ph, searchBar);
	    }

	    placeholder();
	    $('.submit').click(function(e) {
	        phCount = 0;
	        e.preventDefault();
	        placeholder();
		});
	    paceOptions = {
	        elements: true
	    };
	</script>
    <script>
        $('.add2cart').on('click', function(){
            var $this = $(this);
            var product_id = $this.attr('data-id');
            var url = "{{ route('cart.add') }}";
            $.ajax({
                type: "POST",
                url: url,
                data: { 
                    "_token": "{{ csrf_token() }}",
                    product_id: product_id,
                },
                success: function (data,i) {
                    var tbarcode= '';
                    var product = data.cart[product_id];
                    var itemId = product.product_id;
                    var qty = product.quantity;
                    var total_price = Math.ceil(product.total_price);
                    var rows = '<tr id="'+itemId+'">'
                        +'<td width="60%"><i class="fa fa-times-circle-o del_cart" onclick="removeCart('+itemId+')"></i>'+product.title+'</td>'
                        +'<td width="20%" align="right"><b>৳ '+Math.ceil(product.sales_price)+' X <span class="itemQty">'+qty+'</span></b></td>'
                        +'<td width="20%" align="right">৳ <span class="itemPrice">'+total_price+'</span></td>'
                        +'</tr>';

                    $(".miniCartTable tbody tr").each(function () {
                        tbarcode = $(this).attr('id');
                        if (tbarcode == itemId) {
                            $(this).find('.itemQty').text(qty);
                            $(this).find('.itemPrice').text(total_price);
                            return false;
                        }
                    });
                    if (tbarcode != itemId) {
                        $('.miniCartTable tbody').append(rows);
                    }
                    $(".cartPrice").text(sumPrice());
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        })

        function removeCart(param) {
            var product_id = param;
            var url = "{{ route('cart.remove') }}";
            $.ajax({
                type: "POST",
                url: url,
                data: { 
                  "_token": "{{ csrf_token() }}",
                  product_id: product_id 
                },
                success: function (data) {
                    $('.miniCartTable tbody #'+product_id).remove();
                    $('.cartTable tbody #'+product_id).remove();
                    $('.cartPrice').text(sumPrice());
                },
                error: function (data) {
                  console.log('Error:', data);
                }
            });
        };

        function sumPrice(){
            var sum = 0;
            $('.miniCartTable .itemPrice').each(function() {
                sum += +parseFloat($(this).text())||0;
            });
            return sum.toFixed(0);
        }
    </script>