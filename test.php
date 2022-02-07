<style>


</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

<?php include 'product/css/productcss.php'; ?>



<style>
    .rectangle {

        flex-basis: 100%;
        height: 85vh;
        <?php
        require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/images/showimage.php';
        $image = new Image();

        $src = $image->show('uploads/IMG-DEFAULTPROFILE.jpg');
        echo "background:linear-gradient(rgba(0, 0, 0, 0.3),rgba(0, 0, 0, 0.3)), url('$src');";
        ?>background-position: center;
        background-size: cover;
        background-image: black;



    }
</style>

<html>

<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<div class='top'>
    <div class='left'>
        <div class='rectangle'>

        </div>

        <div class="tags">
            <p class='tagsheader'>Tags</p>
            <button class='tagsbtn'>Others</button>
            <button class='tagsbtn'>Utility</button>
        </div>

        <div class='extrainfo'>
            <div class='extrainforow'>
                <span>Delivery Available</span>
                <i class="tk fas fa-check-circle"></i>


            </div>

            <div class='extrainforow'>
                <span>Fixed Shipping Costs</span>
                <i class="tk fas fa-check-circle"></i>


            </div>

            <div class='extrainforow'>
                <span>Return/Refund</span>
                <i class="tk fas fa-times-circle"></i>




            </div>
        </div>

    </div>




    <div class="right">
        <p class='tpamc'>TPAMC</p>
        <h1 class='prodname'>Portable Torchlight v2</h1>

        <h3 class='price'>$5.99</h3>

        <div class='refunds'>
            <p class='refundsheader'>No returns/refunds</p>
            <p class='refundsbody'>Item is confirmed after payment confirmation. No
                refunds, returns or exchanges will be entertained
                except as required by law</p>
        </div>


        <div class="details">
            <p class="detailsheader">Details</p>
            <p class='detailsbody'>A flashlight (US, Canada) or torch (UK, Australia) is a portable hand-held electric lamp.
                Formerly, the light source typically was a miniature incandescent light bulb, but these have
                been displaced by light-emitting diodes (LEDs) since the mid-2000s. A typical flashlight consists
                of the light source mounted in a reflector, a transparent cover (sometimes combined with a lens)
                to protect the light source and reflector, a battery, and a switch, all enclosed in a case.
            </p>
        </div>



        <div class="typescontainer">
            <div class="typerow">
                <p class='typename'>Size</p>
                <div class="variants">
                    <ul class="donate-now">
                        <li>
                            <input type="radio" style='opacity:0' id="a25" name="amount" />
                            <label for="a25">Small</label>
                        </li>
                        <li>
                            <input type="radio" id="a50" name="amount" />
                            <label for="a50">Large</label>
                        </li>

                    </ul>




                </div>

            </div>

            <div class="typerow">
                <p class='typename'>Weight</p>
                <div class="variants">
                    <ul class="donate-now">
                        <li>
                            <input type="radio" style='opacity:0' id="5kg" name="weight" />
                            <label for="5kg">5kg</label>
                        </li>
                        <li>
                            <input type="radio" id="10kg" name="weight" />
                            <label for="10kg">10kg</label>
                        </li>

                    </ul>




                </div>

            </div>
        </div>


        <!-- <h1>Quantity İnput</h1> -->
        <div class='cont'>
            <p class='quantityheader'>Quantity</p>
            <div class="quantity-control" data-quantity="">
                <button class="quantity-btn" data-quantity-minus=""><svg viewBox="0 0 409.6 409.6">
                        <g>
                            <g>
                                <path d="M392.533,187.733H17.067C7.641,187.733,0,195.374,0,204.8s7.641,17.067,17.067,17.067h375.467 c9.426,0,17.067-7.641,17.067-17.067S401.959,187.733,392.533,187.733z" />
                            </g>
                        </g>
                    </svg></button>
                <input type="number" id='qnn' class="quantity-input" data-quantity-target="" value="1" step="1" min="1" max="10" name="quantity">
                <button class="quantity-btn" data-quantity-plus=""><svg viewBox="0 0 426.66667 426.66667">
                        <path d="m405.332031 192h-170.664062v-170.667969c0-11.773437-9.558594-21.332031-21.335938-21.332031-11.773437 0-21.332031 9.558594-21.332031 21.332031v170.667969h-170.667969c-11.773437 0-21.332031 9.558594-21.332031 21.332031 0 11.777344 9.558594 21.335938 21.332031 21.335938h170.667969v170.664062c0 11.777344 9.558594 21.335938 21.332031 21.335938 11.777344 0 21.335938-9.558594 21.335938-21.335938v-170.664062h170.664062c11.777344 0 21.335938-9.558594 21.335938-21.335938 0-11.773437-9.558594-21.332031-21.335938-21.332031zm0 0" />
                    </svg>
                </button>
            </div>

        </div>
        <p id='qnleft' style='opacity:0.7;margin-top:10px'>Only 3 left</p>


        <div class='lastpart'>
            <h1 class='totaloverall'>Total: $11.98</h1>
            <div class='lastpartbuttons'>
                <input class='addtocart' type="submit" value="ADD TO CART">
                <button class='afterfavoritebtn'><i class="far fa-heart"></i></button>
            </div>


        </div>








    </div>
</div>


<div class="addreview">
    <h3 class='addareview'>Add a review</h3>
    <div class='ratingreviewadd'>
        <p class='ratingreviewheader'>Rating</p>
        <input class='number' type="number" placeholder='1-5'>

    </div>

    <div class='productimageadd'>
        <p>Product Image</p>
        <input type='file'>
    </div>

    <textarea placeholder="I loved this product! I really hope I can get A for SWAP!" class='addreivewtextarea' style="width:100%"></textarea>

    <input type="submit" class='addreviewbtn' value='Post Publicly'>

</div>


<div class="allreviews">


    <h2 class='numberofreviews'>15 Reviews</h2>

    <form class="parentsectionreviews">

        

            <div class="parentleft">
                <div class='circle'>

                </div>

            </div>

            <div class="parentright">
                <div class='usernamereviewcontainer'>
                    <h4 class='usernamereview'>darrenong</h4>

                    <div class='kea'>
                        <a class="kebab-link" data-toggle="dropdown" data-target="#dropdown1"><i class="fa fa-ellipsis-v"></i></a>
                        <div class="dropdown kebab-dropdown dropdown-sm" id="dropdown1">
                            <div class="dropdown-menu dropdown-unroll dropdown-menu-right">
                                <a class="dropdown-item" href="#">Edit Product</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Delete Product</a>
                            </div>
                        </div>
                    </div>
                </div>



                <div class='reviewsrating'>
                    <i class="fas fa-cog"></i>
                    <i class="fas fa-cog"></i>
                    <i class="fas fa-cog"></i>
                    <i class="fas fa-cog"></i>
                    <i class="fas fa-cog"></i>


                </div>
                <p class='reviewdetails'>Very nice product. makes it portable stuanjsdnkasnkdanjskdankdsnksndnsdknsdskdksndff stuff.</p>

                <div class="imagescontainer">
                    <div class='picturesreview'>

                    </div>

                    <div class="picturesreview">

                    </div>
                </div>

                <p class='date'>2021-09-12 20:33</p>

                <div class="likeordislike">
                    <span class='like'>1&nbsp&nbsp<i class="fas fa-chevron-up"></i></span>
                    <span class='dislike'>1&nbsp&nbsp<i class="fas fa-chevron-down"></i></span>
                </div>

                <p class='replybtn'>Reply</p>


            </div>

        



    </form>

    <div class='childreview'>
        <form class="parentsectionreviews">

            <div class="parentleft">
                <div class='circle'>

                </div>

            </div>

            <div class="childright">
                <div class='usernamereviewcontainer'>
                    <h4 class='usernamereview'>darrenong</h4>

                    <div class='kea'>
                        <a class="kebab-link" data-toggle="dropdown" data-target="#dropdown2"><i class="fa fa-ellipsis-v"></i></a>
                        <div class="dropdown kebab-dropdown dropdown-sm" id="dropdown2">
                            <div class="dropdown-menu dropdown-unroll dropdown-menu-right">
                                <a class="dropdown-item" href="#">Edit Product</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Delete Product</a>
                            </div>
                        </div>

                    </div>



                </div>



                <!-- <div class='reviewsrating'>
                    <i class="fas fa-cog"></i>
                    <i class="fas fa-cog"></i>
                    <i class="fas fa-cog"></i>
                    <i class="fas fa-cog"></i>
                    <i class="fas fa-cog"></i>


                </div> -->
                <p class='reviewdetails'>Very nice product. makes it portable and stuff.</p>

                <!-- <div class="imagescontainer">
                    <div class='picturesreview'>

                    </div>

                    <div class="picturesreview">

                    </div>
                </div> -->

                <p class='date'>2021-09-12 20:33</p>

                <div class="likeordislike">
                    <span class='like'>1&nbsp&nbsp<i class="fas fa-chevron-up"></i></span>
                    <span class='dislike'>1&nbsp&nbsp<i class="fas fa-chevron-down"></i></span>
                </div>

                <p class='replybtn'>Reply</p>


            </div>





        </form>

    </div>




</div>

</html>



























<html>

<head>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
        }
    </style>

</head>

<script>
    $(document).ready(function(e) {
        // Add slideDown animation to Bootstrap dropdown when expanding.
        $('.dropdown').on('show.bs.dropdown', function() {
            $(this).find('.dropdown-unroll').first().stop(true, true).slideDown();
        }).on('hide.bs.dropdown', function() {
            $(this).find('.dropdown-unroll').first().stop(true, true).slideUp();
        });

    });
</script>

<script>
    (function() {
        "use strict";
        var jQueryPlugin = (window.jQueryPlugin = function(ident, func) {
            return function(arg) {
                if (this.length > 1) {
                    this.each(function() {
                        var $this = $(this);

                        if (!$this.data(ident)) {
                            $this.data(ident, func($this, arg));
                        }
                    });

                    return this;
                } else if (this.length === 1) {
                    if (!this.data(ident)) {
                        this.data(ident, func(this, arg));
                    }

                    return this.data(ident);
                }
            };
        });
    })();

    (function() {
        "use strict";

        function Guantity($root) {
            const element = $root;
            const quantity = $root.first("data-quantity");
            const quantity_target = $root.find("[data-quantity-target]");
            const quantity_minus = $root.find("[data-quantity-minus]");
            const quantity_plus = $root.find("[data-quantity-plus]");
            var quantity_ = quantity_target.val();
            $(quantity_minus).click(function() {

                // value=document.getElementById('qnn').value;


                if (parseInt(document.getElementById('qnn').value) > parseInt(document.getElementById('qnn').min)) {
                    quantity_target.val(--quantity_);

                }




            });
            $(quantity_plus).click(function() {

                if (parseInt(document.getElementById('qnn').value) < parseInt(document.getElementById('qnn').max)) {
                    quantity_target.val(++quantity_);

                }
            });
        }
        $.fn.Guantity = jQueryPlugin("Guantity", Guantity);
        $("[data-quantity]").Guantity();
    })();
</script>

</html>