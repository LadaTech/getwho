<?PHP
include_once('header.php');
include_once('functions.php');
if (isset($_POST['submit'])) {
    $domain_name = $_POST['domainsearch'];  
    $domain_list= explode(".", $domain_name);
    $name_domain=$domain_list[0];
    $domaintype = end(explode(".", $domain_name));
//    $domaintype = array_shift(explode(".", $domain_name));    
//$domaintype_result= array_slice($domaintype,1);
//print_r($domaintype);exit;
    $server_results = getwhois($domain_name);
//print_r($findresult);exit;
    $con = mysql_connect("localhost", "root", "");
    mysql_select_db("getwhois");
    if (!$con) {
        die('Could not connect: ' . mysql_error());
    }
    $tdls = array('com' => '10', 'in' => '5', 'net' => '8.8', 'info' => '12.0', 'org' => '4', 'co.in' => '2', 'biz' => '12', 'social' => '19');
    foreach ($tdls as $tdl => $tdlValue) {
        $domaintype = end(explode(".", $domain_name));
        $domainName = str_replace('.' . $domaintype, '.' . $tdl, $domain_name);
        $server_result = getwhois($domainName);
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
                    <div class="domainTakenTT"> <?php echo $domain_name . "   " . $server_results ?> </div>. Interested in buying it? <a href="#">Make an Offer</a> 
                </div>
            </div>  
            <div class="col-md-12">           
                <div class="search-content">  
                    <?PHP
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
                    <h2><?php echo $domain_name
                    ?> - <span>Getwhois information</span></h2>
                    <a href="#" class="btn btn-info">Website info</a>
                    <a href="#" class="btn btn-info">History</a>
                    <a href="#" class="btn btn-info">DNS Records</a>
                    <a href="#" class="btn btn-info">Diagnostics</a>
                </div>

            </div>			
        </div>
        <?php
    } else {
        $name = $server_results['name'];
        $whois_server = $server_results['Registrar WHOIS Server'];
        $referral_url = $server_results['referrer'];
        $status = $server_results['status'];
        $expires_on = date('Y-m-d', strtotime($server_results['expires']));
        $registered_on = date('Y-m-d', strtotime($server_results['created']));
        $updated_on = date('Y-m-d', strtotime($server_results['changed']));
        $name_server1 = $server_results['sname1'];
        $name_server2 = $server_results['sname2'];
        $server_value1 = $server_results['svalue1'];
        $server_value2 = $server_results['svalue2'];
        $registrant_name = $server_results['Registrant Name'];
        $registrant_organization = $server_results['Registrant Organization'];
        $registrant_address = $server_results['Registrant Street'];
        $registrant_city = $server_results['Registrant City'];
        $registrant_state = $server_results['Registrant State/Province'];
        $registrant_postalcode = $server_results['Registrant Postal Code'];
        $registrant_country = $server_results['Registrant Country'];
        $registrant_phone = $server_results['Registrant Phone'];
        $registrant_email = $server_results['Registrant Email'];
        $administrative_name = $server_results['Admin Name'];
        $administrative_organization = $server_results['Admin Organization'];
        $administrative_address = $server_results['Admin Street'];
        $administrative_city = $server_results['Admin City'];
        $administrative_state = $server_results['Admin State/Province'];
        $administrative_postalcode = $server_results['Admin Postal Code'];
        $administrative_country = $server_results['Admin Country'];
        $administrative_phone = $server_results['Admin Phone'];
        $administrative_email = $server_results['Admin Email'];
        $technical_name = $server_results['Tech Name'];
        $technical_organization = $server_results['Tech Organization'];
        $technical_address = $server_results['Tech Street'];
        $technical_city = $server_results['Tech City'];
        $technical_state = $server_results['Tech State/Province'];
        $technical_postalcode = $server_results['Tech Postal Code'];
        $technical_country = $server_results['Tech Country'];
        $technical_phone = $server_results['Tech Phone'];
        $technical_email = $server_results['Tech Email'];
        $updated_information = $server_results['Updated Date'];
        ?>
        <!-- Hero Section -->

        <div class="container inner-padding7">
            <div class="row">
                <div class="col-md-12">
                    <div class="takenDomaintitle">
                        <div class="domainTakenTT"> <?php echo $name ?> is already registered</div>. Interested in buying it? <a href="#">Make an Offer</a> 
                    </div>
                </div>  
                <div class="col-md-12">
                    <div class="search-content">
                        <?PHP
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
                        <h2><?php echo $domain_name ?> - <span>Getwhois information</span></h2>
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
                                    <div class="col-md-8 queryResponseBodyValue"><?php echo $name; ?></div>
                                </div>
                                <div class="row queryResponseBodyRow ">
                                    <div class="col-md-4 queryResponseBodyKey">Whois Server</div>
                                    <div class="col-md-8 queryResponseBodyValue"><?php echo $whois_server ?></div>
                                </div>
                                <div class="row queryResponseBodyRow" >
                                    <div class="col-md-4 queryResponseBodyKey">Referral URL</div>
                                    <div class="col-md-8 queryResponseBodyValue"><?php echo $referral_url ?></div>
                                </div>
                                <div class="row queryResponseBodyRow">
                                    <div class="col-md-4 queryResponseBodyKey">Status</div>
                                    <div class="col-md-8 queryResponseBodyValue">
                                        <?php echo $status ?><br />
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
                                    <div class="col-md-8 queryResponseBodyValue"><?php echo $expires_on ?></div>
                                </div>
                                <div class="row queryResponseBodyRow">
                                    <div class="col-md-4 queryResponseBodyKey">Registered On</div>
                                    <div class="col-md-8 queryResponseBodyValue"><?php echo $registered_on ?></div>
                                </div>
                                <div class="row queryResponseBodyRow">
                                    <div class="col-md-4 queryResponseBodyKey">Updated On</div>
                                    <div class="col-md-8 queryResponseBodyValue"><?php echo $updated_on ?></div>
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
                                        <a href="$name_server1"><?php echo $name_server1 ?></a>
                                    </div>
                                    <div class="col-md-4 queryResponseBodyValue">
                                        <a href="$server_value1"><?php echo $server_value1 ?></a>
                                    </div>
                                </div><div class="row queryResponseBodyRow">
                                    <div class="col-md-8 queryResponseBodyValue">
                                        <a href="$name_server2"><?php echo $name_server2 ?></a>
                                    </div>
                                    <div class="col-md-4 queryResponseBodyValue">
                                        <a href="$server_value24"><?php echo $server_value2 ?></a>
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
                                        <a href='/whois/ladat.com'><?php echo $name_domain ?>.com</a> | <a href='/whois/ladat.es'><?php echo $name_domain ?>.es</a> | <a href='/whois/ladat.info'><?php echo $name_domain ?>.info</a> | <a href='/whois/ladat.net'>ladat.net</a> | <a href='/whois/ladat.org'>ladat.org</a> | <a href='/whois/ladat.ru'>ladat.ru</a> | <a href='/whois/ladata-bwsk1.net'>ladata-bwsk1.net</a> | <a href='/whois/ladata.cn'>ladata.cn</a> | <a href='/whois/ladata.co'>ladata.co</a> | <a href='/whois/ladata.com'>ladata.com</a> | <a href='/whois/ladata.de'>ladata.de</a> | <a href='/whois/ladata.info'>ladata.info</a> | <a href='/whois/ladata.net'>ladata.net</a> | <a href='/whois/ladata.org'>ladata.org</a> | <a href='/whois/ladata.org.uk'>ladata.org.uk</a> | <a href='/whois/ladata.ru'>ladata.ru</a> | <a href='/whois/ladataappeals.com'>ladataappeals.com</a> | <a href='/whois/ladatab.io'>ladatab.io</a> | <a href='/whois/ladatabank.com'>ladatabank.com</a> | <a href='/whois/ladatabase.com'>ladatabase.com</a> |             </div>
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
                                            <div class="col-md-7"><?php echo $registrant_name ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4"><strong>Organization</strong></div>
                                            <div class="col-md-7"><?php echo $registrant_organization ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4"><strong>Address</strong></div>
                                            <div class="col-md-7"><?php echo $registrant_address ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4"><strong>City</strong></div>
                                            <div class="col-md-7"><?php echo $registrant_city ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4"><strong>State / Province</strong></div>
                                            <div class="col-md-7"><?php echo $registrant_state ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4"><strong>Postal Code</strong></div>
                                            <div class="col-md-7"><?php echo $registrant_postalcode ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4"><strong>Country</strong></div>
                                            <div class="col-md-7"><?php echo $registrant_country ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4"><strong>Phone</strong></div>
                                            <div class="col-md-7"><?php echo $registrant_phone ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4"><strong>Email</strong></div>
                                            <div class="col-md-7"><?php echo $registrant_email ?></div>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                                <div class="rawWhois">
                                    <div><strong>Administrative Contact Information:</strong></div>
                                    <div>
                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4"><strong>Name</strong></div>
                                            <div class="col-md-7"><?php echo $administrative_name ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4"><strong>Organization</strong></div>
                                            <div class="col-md-7"><?php echo $administrative_organization ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4"><strong>Address</strong></div>
                                            <div class="col-md-7"><?php echo $administrative_address ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4"><strong>City</strong></div>
                                            <div class="col-md-7"><?php echo $administrative_city ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4"><strong>State / Province</strong></div>
                                            <div class="col-md-7"><?php echo $administrative_state ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4"><strong>Postal Code</strong></div>
                                            <div class="col-md-7"><?php echo $administrative_postalcode ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4"><strong>Country</strong></div>
                                            <div class="col-md-7"><?php echo $administrative_country ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4"><strong>Phone</strong></div>
                                            <div class="col-md-7"><?php echo $administrative_phone ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4"><strong>Email</strong></div>
                                            <div class="col-md-7"><?php echo $administrative_email ?></div>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                                <div class="rawWhois">
                                    <div><strong>Technical Contact Information:</strong></div>
                                    <div>
                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4"><strong>Name</strong></div>
                                            <div class="col-md-7"><?php echo $technical_name ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4"><strong>Organization</strong></div>
                                            <div class="col-md-7"><?php echo $technical_organization ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4"><strong>Address</strong></div>
                                            <div class="col-md-7"><?php echo $technical_address ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4"><strong>City</strong></div>
                                            <div class="col-md-7"><?php echo $technical_city ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4"><strong>State / Province</strong></div>
                                            <div class="col-md-7"><?php echo $technical_state ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4"><strong>Postal Code</strong></div>
                                            <div class="col-md-7"><?php echo $technical_postalcode ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4"><strong>Country</strong></div>
                                            <div class="col-md-7"><?php echo $technical_country ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4"><strong>Phone</strong></div>
                                            <div class="col-md-7"><?php echo $technical_phone ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4"><strong>Email</strong></div>
                                            <div class="col-md-7"><?php echo $technical_email ?></div>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                                <div>Information Updated: <?php echo $updated_information ?></div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

        </div>

        <!-- End Service Section -->

        <?php
    }
}
include_once('footer.php')
?>
