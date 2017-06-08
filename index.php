
<?PHP include_once('header.php');
session_start();
?>
<!-- Hero Section -->
<div class="hero-area2" id="home">
    <div class="hero-caption">
        <div class="hero-caption-inner">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">                            
                        <h1>Get Who is</h1>
                        <h3>GET WHO IS Search, Domain Name, Website, and IP Tools</h3>
                        <div class="search">
                            <form action="search.php" method="POST">
                            <input type="text" name="domainsearch" id="domainsearch" class="form-control input-sm" maxlength="64" placeholder="Search" />
                            <button type="submit" class="btn btn-sm" name="submit" id="submit">Search</button>
                            </form>
                           </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="service-area inner-padding5">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="service-widget foo" data-sr='enter'>
                    <img src="img/icon-domain.png" alt="responsive img">

                    <p>Go beyond ordinary Get Whois to discover the people or organizations behind a domain name or IP address. </p>
                    <a href="#" class="btn btn-readmore" role="button">KNOW MORE</a>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="service-widget foo" data-sr='enter'>
                    <img src="img/icon-ip.png" alt="responsive img">

                    <p>“Connect the dots", discovering connections between domains, persons, organizations, IP addresses, etc. </p>
                    <a href="#" class="btn btn-readmore" role="button">KNOW MORE</a>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="service-widget foo" data-sr='enter'>
                    <img src="img/icon-whois.png" alt="responsive img">

                    <p>Protect tangible and digital assets and intellectual property against cybercrime, brand fraud, and theft.</p>
                    <a href="#" class="btn btn-readmore" role="button">KNOW MORE</a>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- End Service Section -->


<div class="whatwedo inner-padding5">
    <div class="container">
        <div class="row">
            <div class="container">
                <div class="row">
                    <h2 class="page-title">what we do</h2>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="whatwe-widget whatwe" data-sr='enter'>
                    <img src="img/whois-webservice.png" alt="responsive img">     
                    <div class="divider"></div>
                    <h4>API Webservice</h4>
                    <p>We Provides consistent, well-structured data in whois XML & JSON. Keeps most updated, accurate whois data accessible to your application 24/7.</p>

                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="whatwe-widget whatwe" data-sr='enter'>
                    <img src="img/whois-database.png" alt="responsive img">   
                    <div class="divider"></div>			
                    <h4>Whois Database Download</h4>						
                    <p>Provides historic Whois Database download in both parsed and raw format as csv file.</p>

                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="whatwe-widget whatwe" data-sr='enter'>
                    <img src="img/whois-lookup.png" alt="responsive img">    
                    <div class="divider"></div>
                    <h4>Bulk Whois Lookup</h4>
                    <p>You can do bulk lookup of hundred's of domain in single go.</p>

                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="whatwe-widget whatwe" data-sr='enter'>
                    <img src="img/reverse-search.png" alt="responsive img">  
                    <div class="divider"></div>
                    <h4>Reverse whois Search</h4>
                    <p>Enter a name and we will tell you, how many domain are registered in this name.</p>

                </div>
            </div>
            <div class="row col-md-12" style="margin: 35px auto 0px;text-align: center;">
                <a href="products-and-services.php" class="btn btn-default btn-sm-outline">Know More</a>
            </div>
        </div>
    </div>
</div>
<!-- End Service Section -->

<?php include_once('footer.php') ?>
