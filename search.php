<?PHP
include_once('header.php');
include_once('functions.php');
if (isset($_POST['submit'])) {
    $domain_name = $_POST['domainsearch'];
    $domain_list = explode(".", $domain_name);
    $name_domain = $domain_list[0];
    $domaintype = end(explode(".", $domain_name));
    $server_results = getwhois($domain_name);
    $con = mysql_connect("localhost", "root", "");
    mysql_select_db("getwhois");
    if (!$con) {
        die('Could not connect: ' . mysql_error());
    }
    $tdls = array('com' => '10', 'in' => '5', 'net' => '8.8', 'info' => '12.0', 'org' => '4', 'co.in' => '2', 'biz' => '12', 'social' => '19');

    foreach ($tdls as $tdl => $tdlValue) {
        $domaintype = end(explode(".", $domain_name));
        $domainName = str_replace('.' . $domaintype, '.' . $tdl, $domain_name);
        $server_result = getwhois($domainName, 0);
        if ($server_result == 'not registered') {
            $tdlsArray[$tdl] = 'Not Registered';
        } else {
            $tdlsArray[$tdl] = 'Registered';
        }
    }

    if (is_string($server_results)) {
        ?>

        <div class="row">
            <div class="col-md-12">
                <div class="takenDomaintitle">
                    <div class="domainTakenTT"> <?PHP echo $domain_name . "   " . $server_results ?> </div>. Interested in buying it? <a href="#">Make an Offer</a> 
                </div>
            </div>  
            <div class="col-md-12">           
                <div class="search-content">  
                    <?PHP
                    if (array_search($domaintype, $tdlsArray))
                        ; {
                        ?>
                        <div class = "blocks">
                            <div class = "domainType">
                                <strong><?PHP echo $domaintype; ?></strong>
                            </div>
                            <div class = "domainPrice">
                                $<?PHP echo $tdls[$domaintype]; ?>
                            </div>
                            <div class = "domainStatus domainAvailable">
                                Available
                            </div>
                        </div> 
                        <?PHP
                        unset($tdlsArray[$domaintype]);
                    }
                    foreach ($tdlsArray as $tdlKey => $tdlstatus) {


                        if ($tdlstatus == 'Registered') {
                            ?>
                            <div class = "blocks">
                                <div class = "domainType">
                                    <strong><?PHP echo $tdlKey; ?></strong>
                                </div>
                                <div class = "domainPrice">
                                    $<?PHP echo $tdls[$tdlKey]; ?>
                                </div>
                                <div class = "domainStatus domainTaken">
                                    Taken
                                </div>
                            </div>
                            <?PHP
                        } else {
                            ?>
                            <div class = "blocks">
                                <div class = "domainType">
                                    <strong><?PHP echo $tdlKey; ?></strong>
                                </div>
                                <div class = "domainPrice">
                                    $<?PHP echo $tdls[$tdlKey]; ?>
                                </div>
                                <div class = "domainStatus domainAvailable">
                                    Available
                                </div>
                            </div>
                            <?PHP
                        }
                    }
                    ?>
                    <div class = "col-md-12">
                        <a href = "#" class = "btn btn-success">Purchase selected domain</a>
                    </div>
                </div>


                <div class = "history-panel">
                    <h2><?PHP echo $domain_name
                    ?> - <span>Getwhois information</span></h2>
                    <h2>congratulations your searching Domain is available </h2>
                    <!--                    <a href="#" class="btn btn-info">Website info</a>
                                        <a href="#" class="btn btn-info">History</a>
                                        <a href="#" class="btn btn-info">DNS Records</a>
                                        <a href="#" class="btn btn-info">Diagnostics</a>-->
                </div>

            </div>			
        </div>
        <?PHP
    } else {
//        echo "<pre>";
//        print_r($server_results);
        if (isset($server_results['name'])) {
            $name = $server_results['name'];
        }
        if (isset($server_results['registrar'])) {
            $whois_server = $server_results['registrar'];
        }
        if (isset($server_results['referrer'])) {
            $referral_url = $server_results['referrer'];
        }
        if (isset($server_results['status'])) {
            $status = $server_results['status'];
        }
        if (isset($server_results['expires'])) {
            $expires_on = date('Y-m-d', strtotime($server_results['expires']));
        }
        if (isset($server_results['created'])) {
            $registered_on = date('Y-m-d', strtotime($server_results['created']));
        }
        if (isset($server_results['changed'])) {
            $updated_on = date('Y-m-d', strtotime($server_results['changed']));
        }
        if (isset($server_results['sname1'])) {
            $name_server1 = $server_results['sname1'];
        }
        if (isset($server_results['sname2'])) {
            $name_server2 = $server_results['sname2'];
        }
        if (isset($server_results['svalue1'])) {
            $server_value1 = $server_results['svalue1'];
        }
        if (isset($server_results['svalue2'])) {
            $server_value2 = $server_results['svalue2'];
        }
        if (isset($server_results['Registrant Name'])) {
            $registrant_name = $server_results['Registrant Name'];
        }
        if (isset($server_results['Registrant Street'])) {
            $registrant_address = $server_results['Registrant Street'];
        } elseif (isset($server_results['Registrant Street1'])) {
            $registrant_address = $server_results['Registrant Street1'];
        }
        if (isset($server_results['Registrant Organization'])) {
            $registrant_organization = $server_results['Registrant Organization'];
        }
        if (isset($server_results['Registrant City'])) {
            $registrant_city = $server_results['Registrant City'];
        }
        if (isset($server_results['Registrant State/Province'])) {
            $registrant_state = $server_results['Registrant State/Province'];
        }
        if (isset($server_results['Registrant Postal Code'])) {
            $registrant_postalcode = $server_results['Registrant Postal Code'];
        }
        if (isset($server_results['Registrant Country'])) {
            $registrant_country = $server_results['Registrant Country'];
        }
        if (isset($server_results['Registrant Phone'])) {
            $registrant_phone = $server_results['Registrant Phone'];
        }
        if (isset($server_results['Registrant Email'])) {
            $registrant_email = $server_results['Registrant Email'];
        }
        if (isset($server_results['Admin Name'])) {
            $administrative_name = $server_results['Admin Name'];
        }
        if (isset($server_results['Admin Organization'])) {
            $administrative_organization = $server_results['Admin Organization'];
        }
        if (isset($server_results['Admin Street'])) {
            $administrative_address = $server_results['Admin Street'];
        } elseif (isset($server_results['Admin Street1'])) {
            $administrative_address = $server_results['Admin Street1'];
        }
        if (isset($server_results['Admin City'])) {
            $administrative_city = $server_results['Admin City'];
        }
        if (isset($server_results['Admin State/Province'])) {
            $administrative_state = $server_results['Admin State/Province'];
        }
        if (isset($server_results['Admin Postal Code'])) {
            $administrative_postalcode = $server_results['Admin Postal Code'];
        }
        if (isset($server_results['Admin Country'])) {
            $administrative_country = $server_results['Admin Country'];
        }
        if (isset($server_results['Admin Phone'])) {
            $administrative_phone = $server_results['Admin Phone'];
        }
        if (isset($server_results['Admin Email'])) {
            $administrative_email = $server_results['Admin Email'];
        }
        if (isset($server_results['Tech Name'])) {
            $technical_name = $server_results['Tech Name'];
        }
        if (isset($server_results['Tech Organization'])) {
            $technical_organization = $server_results['Tech Organization'];
        }
        if (isset($server_results['Tech Street'])) {
            $technical_address = $server_results['Tech Street'];
        } elseif (isset($server_results['Tech Street1'])) {
            $technical_address = $server_results['Tech Street1'];
        }
        if (isset($server_results['Tech City'])) {
            $technical_city = $server_results['Tech City'];
        }
        if (isset($server_results['Tech State/Province'])) {
            $technical_state = $server_results['Tech State/Province'];
        }
        if (isset($server_results['Tech Postal Code'])) {
            $technical_postalcode = $server_results['Tech Postal Code'];
        }
        if (isset($server_results['Tech Country'])) {
            $technical_country = $server_results['Tech Country'];
        }
        if (isset($server_results['Tech Phone'])) {
            $technical_phone = $server_results['Tech Phone'];
        }
        if (isset($server_results['Tech Email'])) {
            $technical_email = $server_results['Tech Email'];
        }
        if (isset($server_results['Updated Date'])) {
            $updated_information = $server_results['Updated Date'];
        } elseif (isset($server_results['Last Updated On'])) {
            $updated_information = $server_results['Last Updated On'];
        }
        ?>
        <!-- Hero Section -->
        <div class="orange-bg">
            <div class="wrapper">
                <div class="dca-search">
                    <h2>Get a Domain Name</h2>
                    <div class="dmn-sbox">
                        <form name="domain-search" method="post" action="search.php">
                            <input type="hidden" value="enable" name="phrase_search">
                            <input type="hidden" value="check_availability" name="action">
                            <input type="text" name="domainsearch" id="domainsearch" value="">
                            <!--                            <button data-value="Search again">Search again</button>-->
                            <button type="submit" class="btn btn-sm" name="submit" id="submit" data-value="Search again">Search again</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="container inner-padding1">
            <div class="row">
                <div class="col-md-12">
                    <div class="takenDomaintitle">
                        <div class="domainTakenTT"> <?PHP echo $name; ?> is already registered</div>. Interested in buying it? <a href="#">Make an Offer</a> 
                    </div>
                </div>  
                <div class="col-md-12">
                    <div class="search-content">
                        <?PHP
                        if (array_search($domaintype, $tdlsArray))
                            ; {
                            ?>
                            <div class = "blocks">
                                <div class = "domainType">
                                    <strong><?PHP echo $domaintype; ?></strong>
                                </div>
                                <div class = "domainPrice">
                                    $<?PHP echo $tdls[$domaintype]; ?>
                                </div>
                                <div class = "domainStatus domainTaken">
                                    Taken
                                </div>
                            </div> 
                            <?PHP
                            unset($tdlsArray[$domaintype]);
                        }
                        foreach ($tdlsArray as $tdlKey => $tdlstatus) {
                            if ($tdlstatus == 'Registered') {
                                ?>
                                <div class = "blocks">
                                    <div class = "domainType">
                                        <strong><?PHP echo $tdlKey; ?></strong>
                                    </div>
                                    <div class = "domainPrice">
                                        $<?PHP echo $tdls[$tdlKey]; ?>
                                    </div>
                                    <div class = "domainStatus domainTaken">
                                        Taken
                                    </div>
                                </div>
                <?PHP
            } else {
                ?>
                                <div class = "blocks">
                                    <div class = "domainType">
                                        <strong><?PHP echo $tdlKey; ?></strong>
                                    </div>
                                    <div class = "domainPrice">
                                        $<?PHP echo $tdls[$tdlKey]; ?>
                                    </div>
                                    <div class = "domainStatus domainAvailable">
                                        Available
                                    </div>
                                </div>
                <?PHP
            }
        }
        ?>     
                        <div class="col-md-12">
                            <a href="#" class="btn btn-success">Purchase selected domain</a>
                        </div>
                    </div>


                    <div class="history-panel">
                        <h2><?PHP echo $domain_name; ?> - <span>Getwhois information</span></h2>
                        <a href="#" class="btn btn-info">Website info</a>
                        <a href="#" class="btn btn-info">History</a>
                        <a href="#" class="btn btn-info">DNS Records</a>
                        <a href="#" class="btn btn-info">Diagnostics</a>
                    </div>

                </div>			
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="domainInfo">
                        <div class="col-md-12 queryResponseHeader">
                            Registor Info
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-12 queryResponseBody">
                                <div class="row queryResponseBodyRow">
                                    <div class="col-md-4 queryResponseBodyKey">Name</div>
                                    <div class="col-md-8 queryResponseBodyValue"><?PHP echo $name; ?></div>
                                </div>
                                <div class="row queryResponseBodyRow ">
                                    <div class="col-md-4 queryResponseBodyKey">Whois Server</div>
                                    <div class="col-md-8 queryResponseBodyValue"><?PHP echo $whois_server; ?></div>
                                </div>
                                <div class="row queryResponseBodyRow" >
                                    <div class="col-md-4 queryResponseBodyKey">Referral URL</div>
                                    <div class="col-md-8 queryResponseBodyValue"><?PHP echo $referral_url; ?></div>
                                </div>
                                <div class="row queryResponseBodyRow">
                                    <div class="col-md-4 queryResponseBodyKey">Status</div>
                                    <div class="col-md-8 queryResponseBodyValue">
        <?PHP echo $status ?><br />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 queryResponseHeader">
                            Important Dates
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-12 queryResponseBody">
                                <div class="row queryResponseBodyRow">
                                    <div class="col-md-4 queryResponseBodyKey">Expires On</div>
                                    <div class="col-md-8 queryResponseBodyValue"><?PHP echo $expires_on; ?></div>
                                </div>
                                <div class="row queryResponseBodyRow">
                                    <div class="col-md-4 queryResponseBodyKey">Registered On</div>
                                    <div class="col-md-8 queryResponseBodyValue"><?PHP echo $registered_on; ?></div>
                                </div>
                                <div class="row queryResponseBodyRow">
                                    <div class="col-md-4 queryResponseBodyKey">Updated On</div>
                                    <div class="col-md-8 queryResponseBodyValue"><?PHP echo $updated_on; ?></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 queryResponseHeader">
                            Nameservers
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-12 queryResponseBody">
                                <div class="row queryResponseBodyRow">
                                    <div class="col-md-8 queryResponseBodyValue">
                                        <a href="$name_server1"><?PHP echo $name_server1; ?></a>
                                    </div>
                                    <div class="col-md-4 queryResponseBodyValue">
                                        <a href="$server_value1"><?PHP echo $server_value1; ?></a>
                                    </div>
                                </div><div class="row queryResponseBodyRow">
                                    <div class="col-md-8 queryResponseBodyValue">
                                        <a href="$name_server2"><?PHP echo $name_server2; ?></a>
                                    </div>
                                    <div class="col-md-4 queryResponseBodyValue">
                                        <a href="$server_value24"><?PHP echo $server_value2; ?></a>
                                    </div>
                                </div>	
                            </div>
                        </div>

                        <div class="col-md-12 queryResponseHeader">
                            Similar Domains
                        </div>

                        <div class="col-md-12">
                            <div class="col-md-12 queryResponseBody">
                                <div class="row queryResponseBodyRow">
                                    <div class="col-md-12 queryResponseBodyValue">
                                        <a href='/whois/ladat.com'><?PHP echo $name_domain; ?>.com</a> | <a href='/whois/ladat.es'><?php echo $name_domain ?>.es</a> | <a href='/whois/ladat.info'><?php echo $name_domain ?>.info</a> | <a href='/whois/ladat.net'><?php echo $name_domain ?>.net</a> | <a href='/whois/ladat.org'><?php echo $name_domain ?>.org</a> | <a href='/whois/ladat.ru'><?php echo $name_domain ?>.ru</a> | <a href='/whois/ladata-bwsk1.net'><?php echo $name_domain ?>.net</a> | <a href='/whois/ladata.cn'><?php echo $name_domain ?>.cn</a> | <a href='/whois/ladata.co'><?php echo $name_domain ?>.co</a> | <a href='/whois/ladata.com'><?php echo $name_domain ?>.com</a> | <a href='/whois/ladata.de'><?php echo $name_domain ?>.de</a> | <a href='/whois/ladata.info'><?php echo $name_domain ?>.info</a> | <a href='/whois/ladata.net'><?php echo $name_domain ?>.net</a> | <a href='/whois/ladata.org'><?php echo $name_domain ?>.org</a> | <a href='/whois/ladata.org.uk'><?php echo $name_domain ?>.org.uk</a> | <a href='/whois/ladata.ru'><?php echo $name_domain ?>.ru</a> | <a href='/whois/ladataappeals.com'><?php echo $name_domain ?>.com</a> | <a href='/whois/ladatab.io'><?php echo $name_domain ?>.io</a> | <a href='/whois/ladatabank.com'><?php echo $name_domain ?>.com</a> | <a href='/whois/ladatabase.com'><?php echo $name_domain ?>.com</a> |             </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 queryResponseHeader">
                            Registrar Data
                        </div>


                        <div class="col-md-12 queryResponseBodyValue">
                            <div class="rawWhois">
                                <div class="rawWhois">
                                    <div><strong>Registrant Contact Information:</strong></div>
                                    <div>
                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4"><strong>Name</strong></div>
                                            <div class="col-md-7"><?PHP echo $registrant_name; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4"><strong>Organization</strong></div>
                                            <div class="col-md-7"><?PHP echo $registrant_organization; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4"><strong>Address</strong></div>
                                            <div class="col-md-7"><?PHP echo $registrant_address; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4"><strong>City</strong></div>
                                            <div class="col-md-7"><?PHP echo $registrant_city; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4"><strong>State / Province</strong></div>
                                            <div class="col-md-7"><?PHP echo $registrant_state; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4"><strong>Postal Code</strong></div>
                                            <div class="col-md-7"><?PHP echo $registrant_postalcode; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4"><strong>Country</strong></div>
                                            <div class="col-md-7"><?PHP echo $registrant_country; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4"><strong>Phone</strong></div>
                                            <div class="col-md-7"><?PHP echo $registrant_phone; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4"><strong>Email</strong></div>
                                            <div class="col-md-7"><?PHP echo $registrant_email; ?></div>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                                <div class="rawWhois">
                                    <div><strong>Administrative Contact Information:</strong></div>
                                    <div>
                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4"><strong>Name</strong></div>
                                            <div class="col-md-7"><?PHP echo $administrative_name; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4"><strong>Organization</strong></div>
                                            <div class="col-md-7"><?PHP echo $administrative_organization; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4"><strong>Address</strong></div>
                                            <div class="col-md-7"><?PHP echo $administrative_address; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4"><strong>City</strong></div>
                                            <div class="col-md-7"><?PHP echo $administrative_city; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4"><strong>State / Province</strong></div>
                                            <div class="col-md-7"><?PHP echo $administrative_state; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4"><strong>Postal Code</strong></div>
                                            <div class="col-md-7"><?PHP echo $administrative_postalcode; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4"><strong>Country</strong></div>
                                            <div class="col-md-7"><?PHP echo $administrative_country; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4"><strong>Phone</strong></div>
                                            <div class="col-md-7"><?PHP echo $administrative_phone; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4"><strong>Email</strong></div>
                                            <div class="col-md-7"><?PHP echo $administrative_email; ?></div>
                                        </div>
                                    </div>
                                    <br>
                                </div>

                                <div class="rawWhois">
                                    <div><strong>Technical Contact Information:</strong></div>
                                    <div>
                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4"><strong>Name</strong></div>
                                            <div class="col-md-7"><?PHP echo $technical_name; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4"><strong>Organization</strong></div>
                                            <div class="col-md-7"><?PHP echo $technical_organization; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4"><strong>Address</strong></div>
                                            <div class="col-md-7"><?PHP echo $technical_address; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4"><strong>City</strong></div>
                                            <div class="col-md-7"><?PHP echo $technical_city; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4"><strong>State / Province</strong></div>
                                            <div class="col-md-7"><?PHP echo $technical_state; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4"><strong>Postal Code</strong></div>
                                            <div class="col-md-7"><?PHP echo $technical_postalcode; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4"><strong>Country</strong></div>
                                            <div class="col-md-7"><?PHP echo $technical_country; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4"><strong>Phone</strong></div>
                                            <div class="col-md-7"><?PHP echo $technical_phone; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4"><strong>Email</strong></div>
                                            <div class="col-md-7"><?PHP echo $technical_email; ?></div>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                                <div>Information Updated: <?PHP echo $updated_information; ?></div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

        </div>

        <!-- End Service Section -->

        <?PHP
    }
}
include_once('footer.php')
?>
