
<?PHP include_once('header.php'); ?>
<!-- Hero Section -->


<!-- Pricing Section -->
<div class="pricing-area inner-padding7">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="section-title-area-4 foo" data-sr='enter'>
                    <h2 class="section-title">CHOOSE YOUR PACKAGE</h2>
                    <p>Daily Download of data within 24 hrs after domain registration</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="pricing-package foo" data-sr='enter'>
                    <div class="pricing-header">
                        <div class="pricing-tag">1
                            <p>Month</p>
                        </div>
                    </div>
                  
                    <div class="pricing-body">
                        <h2 class="pricing-title">INDIAN DOMAIN <Br> WHOIS DATABASE - GENERIC</h2>
                        <h3>$60 USD / Rs 3,000</h3>
                        <ul class="package">
                            <li>Daily Records :- 3000 - 4000</li>
                            <li>Generic Domains : </li>
                            <li>.com|.net|.org|.info|.biz  etc.</li>
                            <li><b>Complete whois details:</b></li>
                            <li>Domain Name, Create Date, Expiry Date </li>
                            <li>Registrar, Registrant Name, Company, Address, City</li>
                            <li> State, Zip, Country, Email, Phone </li>
                            <li> <a href="#">Download Sample Data</a></li>

                        </ul>
                    </div>                      
                    <?PHP
                    require 'simple_html_dom.php';
                    $html = '<h2 class="pricing-title">INDIAN DOMAIN WHOIS DATABASE-GENERIC</h2>';
                    $dom = new simple_html_dom();
                    $dom->load($html);
                    $title = $dom->find('h2', 0)->plaintext;                 
              
                    ?>
                    <div class="pricing-footer">
                        <a href='package_selection.php?type=<?PHP echo htmlentities(urlencode($title)) ?>' class="btn btn-default btn-sm" role="button" >Buy Now</a>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="pricing-package recommended foo" data-sr='enter'>
                    <div class="pricing-header">
                        <div class="pricing-tag">6
                            <p>month</p>
                        </div>
                    </div>
                    <div class="pricing-body">
                        <h2 class="pricing-title">HISTORIC WHOIS DATABASE</h2>
                        <h3>$150 USD/ Rs 10,000</h3>
                        <ul class="package">

                            <li>Monthly Records :- 3,000,000 - 4,500,000</li>
                            <li>Generic Domains: </li>
                            <li>.com|.net|.org|.info| .us etc.</li>
                            <li><b>Complete whois details:</b></li>
                            <li>Domain Name, Create Date, Expiry Date </li>
                            <li>Registrar, Registrant Name, Company, Address, City</li>
                            <li> State, Zip, Country, Email, Phone </li>
                            <li> <a href="#">Download Sample Data</a></li>
                        </ul>
                    </div>
                    <?PHP               
                    $html = '<h2 class="pricing-title">HISTORIC WHOIS DATABASE</h2>';              
                    $dom->load($html);
                    $title = $dom->find('h2', 0)->plaintext;                    
                    ?>
                    <div class="pricing-footer">
                        <a href='package_selection.php?type=<?PHP echo htmlentities(urlencode($title)) ?>' class="btn btn-default btn-sm" role="button">Buy Now</a>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="pricing-package foo" data-sr='enter'>
                    <div class="pricing-header">
                        <div class="pricing-tag">1
                            <p>month</p>
                        </div>
                    </div>
                    <div class="pricing-body">
                        <h2 class="pricing-title">GLOBAL DOMAIN <Br>
                            WHOIS DATABASE</h2>
                        <h3>$80 USD/ Rs 5,000</h3>
                        <ul class="package">


                            <li>Daily Records :- 100,000 – 150,000</li>
                            <li>Generic Domains : </li>
                            <li>.com|.net|.org|.info|.biz  etc.</li>
                            <li><b>Complete whois details:</b></li>
                            <li>Domain Name, Create Date, Expiry Date </li>
                            <li>Registrar, Registrant Name, Company, Address, City</li>
                            <li> State, Zip, Country, Email, Phone </li>
                            <li> <a href="#">Download Sample Data</a></li>
                        </ul>
                    </div>
                   <?PHP               
                    $html = '<h2 class="pricing-title">GLOBAL DOMAIN WHOIS DATABASE</h2>';              
                    $dom->load($html);
                    $title = $dom->find('h2', 0)->plaintext;                    
                    ?>
                    <div class="pricing-footer">
                        <a href='package_selection.php?type=<?PHP echo htmlentities(urlencode($title)) ?>' class="btn btn-default btn-sm" role="button">Buy Now</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- End Pricing Section -->


<?php include_once('footer.php') ?>
