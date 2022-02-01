<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<div class="allcontainer">
    <div class="left">
        <h2 class='bag'>Bag</h2>

        <div class='row'>
            
            <input type='checkbox' class='check'>
            <div class="picture">
            <?php
                require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/images/showimage.php';

                $image = new Image();
                $src = $image->show("uploads/IMG-DEFAULTPROFILE.jpg");

                echo '<img class="pic" width=150px src="' . $src . '" />';
                ?>
            </div>

            <div class="elements">
                <div class="elementone">
                    <h2 class='name'>Torchlight</h2>
                    <input type='button' value='Edit' class='editbutton'>
                    <h3 class='price'>$15.99</h3>


                </div>

                <div class='tag'>
                    <p class='tagvalues'>Utility,Portable</p>
                </div>

                <div class='variants'>
                    <span class='variantoptions'>Color: Red</span>
                    <span class='variantoptions'>Size: Large</span>

                    <span class='variantoptions'>Weight: 5kg</span>

                </div>

                <div class='quantity'>
                    <p>Quantity: 2</p>
                </div>

                <div class='remove'>
                    <p>Remove from Cart</p>
                </div>
                

            </div>
            
            
        </div>

        <div class='row'>
            
            <input type='checkbox' class='check'>
            <div class="picture">
                <?php
                require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/images/showimage.php';

                $image = new Image();
                $src = $image->show("uploads/IMG-DEFAULTPROFILE.jpg");

                echo '<img class="pic" width=150px src="' . $src . '" />';
                ?>
            </div>

            <div class="elements">
                <div class="elementone">
                    <h2 class='name'>Torchlight</h2>
                    <input type='button' value='Edit' class='editbutton'>
                    <h3 class='price'>$15.99</h3>


                </div>

                <div class='tag'>
                    <p class='tagvalues'>Utility,Portable</p>
                </div>

                <div class='variants'>
                    <span class='variantoptions'>Color: Red</span>
                    <span class='variantoptions'>Size: Large</span>

                    <span class='variantoptions'>Weight: 5kg</span>

                </div>

                <div class='quantity'>
                    <p>Quantity: 2</p>
                </div>

                <div class='remove'>
                    <p>Remove from Cart</p>
                </div>
                

            </div>

    </div>


    

    </div>

    <div class="right">

        <div class='summary'>
            <h6>TPAMC</h6>
            <h4>SUMMARY</h4>

            <div class='subtotal'>
                <span>Subtotal</span>
                <span class='subtotalactl'>$11.98</span>
            </div>

            <div class='taxes'>
                <span>Taxes</span>
                <span>$11.98</span>
            </div>


            <div class='shipping'>
                <span>Shipping</span>
                <span>$11.98</span>
            </div>

            <div class='total'>
                <span>TOTAL</span>
                <span>$11.98</span>
            </div>

            <input type="submit" class='chkoutbtn' value='CHECKOUT' >


        
        </div>

        <div class='summaryone'>
            <h6 style='opacity:0'>TPAMC</h6>
            <h4 style='opacity:0'>SUMMARY</h4>

            <div style='opacity:0' class='subtotal'>
                <span>Subtotal</span>
                <span class='subtotalactl'>$11.98</span>
            </div>

            <div style='opacity:0' class='taxes'>
                <span>Taxes</span>
                <span>$11.98</span>
            </div>


            <div style='opacity:0' class='shipping'>
                <span>Shipping</span>
                <span>$11.98</span>
            </div>

            <div  style='opacity:0' class='total'>
                <span>TOTAL</span>
                <span>$11.98</span>
            </div>

            <input style='opacity:0' type="submit" class='chkoutbtn' value='CHECKOUT' >


        
        </div>
        



    
    </div>

    <style>
    <?php include 'product/css/viewcart.css'; ?>a {
        color: black !important;
    }
</style>