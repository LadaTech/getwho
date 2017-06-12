<?php

include('whois.main.php');
function getwhois($query) {
    $con = mysql_connect("localhost", "root", "");
    mysql_select_db("getwhois");
    if (!$con) {
        die('Could not connect: ' . mysql_error());
    }
    $rows = mysql_query("select * from server_details where name='$query'");
    $norows = mysql_num_rows($rows);
    $whois = new Whois();
    $result = $whois->Lookup($query, false);
    $register1 = $result['regrinfo']['registered'];
//    echo $register1;   
//    echo "<pre>";
//    print_r($result);
//    echo "</pre>";   
//    exit;
    if (isset($result['regrinfo']['registered']) && $result['regrinfo']['registered'] == 'yes') {
        if (array_key_exists("regrinfo", $result)) {
            $regrinfo_result = $result['regrinfo'];
            $register['registered'] = $registered = $regrinfo_result['registered'];
            if (array_key_exists('domain', $regrinfo_result)) {
                $domain_result = $regrinfo_result['domain'];
                if (isset($domain_result['name'])) {
                    $name['name'] = $name_result = $domain_result['name'];
                }
                $nserver_result = $domain_result['nserver'];
                $status_result = $domain_result['status'];
                if (is_array($status_result)) {
                    $status['status'] = $status_value = $status_result[0];
                } else {
                    $status['status'] = $status_value = $domain_result['status'];
                }
                if (isset($domain_result['changed'])) {
                    $changed['changed'] = $changed_result = $domain_result['changed'];
                }
                if (isset($domain_result['created'])) {
                    $created['created'] = $created_result = $domain_result['created'];
                }
                if (isset($domain_result['expires'])) {
                    $expires['expires'] = $expires_result = $domain_result['expires'];
                }
                $server_keys = array_keys($nserver_result);
                $server_values = array_values($nserver_result);
                if (isset($server_keys['0'])) {
                    $server1['sname1'] = $servername1 = $server_keys['0'];
                }if (isset($server_keys['1'])) {
                    $server2['sname2'] = $servername2 = $server_keys['1'];
                }if (isset($server_keys['0'])) {
                    $svalue1['svalue1'] = $servervalue1 = $server_values['0'];
                }if (isset($server_keys['1'])) {
                    $svalue2['svalue2'] = $servervalue2 = $server_values['1'];
                }
            }
            $merge = array_merge($name, $server1, $server2, $svalue1, $svalue2, $status, $changed, $created, $created, $expires, $register);
        }
        if (array_key_exists("regyinfo", $result)) {
            $regyinfo_result = $result['regyinfo'];
            if (isset($regyinfo_result['registrar'])) {
                $registarar_data['registrar'] = $registrar_result = $regyinfo_result['registrar'];
            }
            if (isset($regyinfo_result['referrer'])) {
                $referrer_data['referrer'] = $referrer_result = $regyinfo_result['referrer'];
            }
            $servers_result = $regyinfo_result['servers'];
            if (isset($regyinfo_result['referrer'])) {
                $type_data['type'] = $type_result = $regyinfo_result['type'];
            }
            foreach ($servers_result as $values) {
                foreach ($values as $values1) {
                    $newArray[] = $values1;
                }
            }
            if (isset($newArray[0])) {
            $newarray1['server1'] = $newArray[0];
            }
            if (isset($newArray[1])){
            $newarray1['args1'] = $newArray[1];
            }
            if (isset($newArray[2])) {
            $newarray1['port1'] = $newArray[2];
            }
            if (isset($newArray[3])) {
            $newarray1['server2'] = $newArray[3];
            }
            if (isset($newArray[4])) {
            $newarray1['args2'] = $newArray[4];
            }
            if (isset($newArray[5])) {
            $newarray1['port2'] = $newArray[5];            
        }
           
//            foreach ($newarray1 as $server) {
//                if ((is_array($server))) {
//                    $list = array_merge($list, $server);
//                }
//            }
         
//            if (isset($newArray[0])) {
//                $server1_result['server1'] = $server1 = $newArray[0];
//            }
//            if (isset($newArray[1])) {
//                $args1_result['args1'] = $args1 = $newArray[1];
//            }
//            if (isset($newArray[2])) {
//                $port1_result['port1'] = $port1 = $newArray[2];
//            }
//            if (isset($newArray[3])) {
//                $server2_result['server2'] = $server2 = $newArray[3];
//            }
//            if (isset($newArray[4])) {
//                $args2_result['args2'] = $args2 = $newArray[4];
//            }
//            if (isset($newArray[5])) {
//                $port2_result['port2'] = $port2 = $newArray[5];
//            }
            

            $merge1 = array_merge($registarar_data, $referrer_data, $newarray1,$type_data);            
        }
        if (array_key_exists("rawdata", $result)) {
            $rawdata_result = $result['rawdata'];

//            $moreinformation['moreinfo'] = trim(mysql_real_escape_string(join('', $moreinfo)));
            $combined = array();
            $rawdataCount = count($rawdata_result);
            for ($i = 0; $i < $rawdataCount; $i++) {
                if (isset($rawdata_result[$i]) && trim($rawdata_result[$i]) != '') {
                    $Domain_name = explode(':', $rawdata_result[$i]);
                    $a1 = array(array_shift($Domain_name));
                    $a2 = array(join(':', $Domain_name));
                    $server_name = array_combine($a1, $a2);
                    $combined = array_merge($combined, $server_name);
                    if (strpos($a1[0], 'Last update of WHOIS database') !== false) {
                        $lastUpdateKey = $i + 1;
                        $moreinfo = array_splice($rawdata_result, $lastUpdateKey);
                    }
                }
            }
        }
        if (isset($combined['Domain Name'])) {
            $Domain_Name = $combined['Domain Name'];
        }

        if (isset($combined['Registry Domain ID'])) {
            $Registry_Domain_ID = trim(mysql_real_escape_string($combined['Registry Domain ID']));
        }
        if (isset($combined['Registrar WHOIS Server'])) {
            $Registrar_WHOIS_Server = trim(mysql_real_escape_string($combined['Registrar WHOIS Server']));
        }
        if (isset($combined['Registrar URL'])) {
            $Registrar_URL = trim(mysql_real_escape_string($combined['Registrar URL']));
        }

        if (isset($combined['Updated Date'])) {
            $Updated_Date = trim(mysql_real_escape_string($combined['Updated Date']));
        }
        if (isset($combined['Creation Date'])) {
            $Creation_Date = trim(mysql_real_escape_string($combined['Creation Date']));
        }
        if (isset($combined['Registrar Registration Expiration Date'])) {
            $Registrar_Registration_Expiration_Date = trim(mysql_real_escape_string($combined['Registrar Registration Expiration Date']));
        }
        if (isset($combined['Registrar'])) {
            $Registrar1 = trim(mysql_real_escape_string($combined['Registrar']));
        }
        if (isset($combined['Registrar IANA ID'])) {
            $Registrar2 = trim(mysql_real_escape_string($combined['Registrar IANA ID']));
        }
        if (isset($combined['Reseller'])) {
            $Reseller = trim(mysql_real_escape_string($combined['Reseller']));
        }
        if (isset($combined['Domain Status'])) {
            $Domain_Status = trim(mysql_real_escape_string($combined['Domain Status']));
        }
        if (isset($combined['Registry Registrant ID'])) {
            $Registry_Registrant_ID = trim(mysql_real_escape_string($combined['Registry Registrant ID']));
        }
        if (isset($combined['Registrant Name'])) {
            $Registrant_Name = trim(mysql_real_escape_string($combined['Registrant Name']));
        }
        if (isset($combined['Registrant Organization'])) {
            $Registrant_Organization = trim(mysql_real_escape_string($combined['Registrant Organization']));
        }
        if (isset($combined['Registrant Street'])) {
            $Registrant_Street = trim(mysql_real_escape_string($combined['Registrant Street']));
        }
        if (isset($combined['Registrant City'])) {
            $Registrant_City = trim(mysql_real_escape_string($combined['Registrant City']));
        }
        if (isset($combined['Registrant State/Province'])) {
            $Registrant_State = trim(mysql_real_escape_string($combined['Registrant State/Province']));
        }
        if (isset($combined['Registrant Postal Code'])) {
            $Registrant_Postal_Code = trim(mysql_real_escape_string($combined['Registrant Postal Code']));
        }
        if (isset($combined['Registrant Country'])) {
            $Registrant_Country = trim(mysql_real_escape_string($combined['Registrant Country']));
        }
        if (isset($combined['Registrant Phone'])) {
            $Registrant_Phone = trim(mysql_real_escape_string($combined['Registrant Phone']));
        }
        if (isset($combined['Registrant Phone Ext'])) {
            $Registrant_Phone_Ext = trim(mysql_real_escape_string($combined['Registrant Phone Ext']));
        }
        if (isset($combined['Registrant Fax'])) {
            $Registrant_Fax = trim(mysql_real_escape_string($combined['Registrant Fax']));
        }
        if (isset($combined['Registrant Fax Ext'])) {
            $Registrant_Fax_Ext = trim(mysql_real_escape_string($combined['Registrant Fax Ext']));
        }
        if (isset($combined['Registrant Email'])) {
            $Registrant_Email = trim(mysql_real_escape_string($combined['Registrant Email']));
        }
        if (isset($combined['Registry Admin ID'])) {
            $Registry_Admin_ID = trim(mysql_real_escape_string($combined['Registry Admin ID']));
        }
        if (isset($combined['Admin Name'])) {
            $Admin_Name = trim(mysql_real_escape_string($combined['Admin Name']));
        }
        if (isset($combined['Admin Organization'])) {
            $Admin_Organization = trim(mysql_real_escape_string($combined['Admin Organization']));
        }
        if (isset($combined['Admin Street'])) {
            $Admin_Street = trim(mysql_real_escape_string($combined['Admin Street']));
        }
        if (isset($combined['Admin City'])) {
            $Admin_City = trim(mysql_real_escape_string($combined['Admin City']));
        }
        if (isset($combined['Admin State/Province'])) {
            $Admin_State = trim(mysql_real_escape_string($combined['Admin State/Province']));
        }
        if (isset($combined['Admin Postal Code'])) {
            $Admin_Postal_Code = trim(mysql_real_escape_string($combined['Admin Postal Code']));
        }
        if (isset($combined['Admin Country'])) {
            $Admin_Country = trim(mysql_real_escape_string($combined['Admin Country']));
        }
        if (isset($combined['Admin Phone'])) {
            $Admin_Phone = trim(mysql_real_escape_string($combined['Admin Phone']));
        }
        if (isset($combined['Admin Phone Ext'])) {
            $Admin_Phone_Ext = trim(mysql_real_escape_string($combined['Admin Phone Ext']));
        }
        if (isset($combined['Admin Fax'])) {
            $Admin_Fax = trim(mysql_real_escape_string($combined['Admin Fax']));
        }
        if (isset($combined['Admin Email'])) {
            $Admin_Email = trim(mysql_real_escape_string($combined['Admin Email']));
        }
        if (isset($combined['Registry Tech ID'])) {
            $Registry_Tech_ID = trim(mysql_real_escape_string($combined['Registry Tech ID']));
        }
        if (isset($combined['Tech Name'])) {
            $Tech_Name = trim(mysql_real_escape_string($combined['Tech Name']));
        }
        if (isset($combined['Tech Organization'])) {
            $Tech_Organization = trim(mysql_real_escape_string($combined['Tech Organization']));
        }
        if (isset($combined['Tech Street'])) {
            $Tech_Street = trim(mysql_real_escape_string($combined['Tech Street']));
        }
        if (isset($combined['Tech City'])) {
            $Tech_City = trim(mysql_real_escape_string($combined['Tech City']));
        }
        if (isset($combined['Tech State/Province'])) {
            $Tech_State = trim(mysql_real_escape_string($combined['Tech State/Province']));
        }
        if (isset($combined['Tech Postal Code'])) {
            $Tech_Postal_Code = trim(mysql_real_escape_string($combined['Tech Postal Code']));
        }
        if (isset($combined['Tech Country'])) {
            $Tech_Country = trim(mysql_real_escape_string($combined['Tech Country']));
        }
        if (isset($combined['Tech Phone'])) {
            $Tech_Phone = trim(mysql_real_escape_string($combined['Tech Phone']));
        }
        if (isset($combined['Tech Phone Ext'])) {
            $Tech_Phone_Ext = trim(mysql_real_escape_string($combined['Tech Phone Ext']));
        }
        if (isset($combined['Tech Fax'])) {
            $Tech_Fax = trim(mysql_real_escape_string($combined['Tech Fax']));
        }
        if (isset($combined['Tech Fax Ext'])) {
            $Tech_Fax_Ext = trim(mysql_real_escape_string($combined['Tech Fax Ext']));
        }
        if (isset($combined['Registrant Fax'])) {
            $Tech_Email = trim(mysql_real_escape_string($combined['Tech Email']));
        }
        if (isset($combined['DNSSEC'])) {
            $DNSSEC = trim(mysql_real_escape_string($combined['DNSSEC']));
        }
        if (isset($combined['Registrar Abuse Contact Email'])) {
            $Registrar_Abuse_Contact_Email = trim(mysql_real_escape_string($combined['Registrar Abuse Contact Email']));
        }
        if (isset($combined['Registrar Abuse Contact Phone'])) {
            $Registrar_Abuse_Contact_Phone = trim(mysql_real_escape_string($combined['Registrar Abuse Contact Phone']));
        }
        if (isset($combined['URL of the ICANN WHOIS Data Problem Reporting System'])) {
            $URL_of_the_ICANN_WHOIS_Data_Problem_Reporting_System = trim(mysql_real_escape_string($combined['URL of the ICANN WHOIS Data Problem Reporting System']));
        }
        $moreinfo1['moreinfo'] = $moreinformation = trim(mysql_real_escape_string(join('', $moreinfo)));
        $merge2 = array_merge($combined, $moreinfo1);
        $merge3 = array_merge($merge, $merge1, $merge2);

        if ($norows >= 1) {
            return $merge3;
        } else {
            $query = "insert into server_details(name,servername1,servername2,servervalue1,servervalue2,status,changed,created,expires,registered,"
                    . "registrar,referrer,server1,args1,port1,server2,args2,port2,type,Domain_Name,Registry_Domain_ID,Registrar_WHOIS_Server,Registrar_URL,Updated_Date,Creation_Date,Registrar_Registration_Expiration_Date,"
                    . "Registrar1,Registrar2,Reseller,Domain_Status,Registry_Registrant_ID,Registrant_Name,Registrant_Organization,Registrant_Street,Registrant_City,Registrant_State,"
                    . "Registrant_Postal_Code,Registrant_Country,Registrant_Phone,Registrant_Phone_Ext,Registrant_Fax,Registrant_Fax_Ext,Registrant_Email,Registry_Admin_ID,Admin_Name,"
                    . "Admin_Organization,Admin_Street,Admin_City,Admin_State,Admin_Postal_Code,Admin_Country,Admin_Phone,Admin_Phone_Ext,Admin_Fax,Admin_Fax_Ext,Admin_Email,Registry_Tech_ID,"
                    . "Tech_Name,Tech_Organization,Tech_Street,Tech_City,Tech_State,Tech_Postal_Code,Tech_Country,Tech_Phone,Tech_Phone_Ext,Tech_Fax,Tech_Fax_Ext,Tech_Email,DNSSEC,Registrar_Abuse_Contact_Email,"
                    . "Registrar_Abuse_Contact_Phone,URL_of_the_ICANN_WHOIS_Data_Problem_Reporting_System,more_information)"
                    . "values"
                    . "('$name_result','$servername1','$servername2','$servervalue1','$servervalue2','$status_value','$changed_result','$created_result','$expires_result','$registered',"
                    . "'$registrar_result','$referrer_result','$server1','$args1','$port1','$server2','$args2','$port2','$type_result','$Domain_Name','$Registry_Domain_ID','$Registrar_WHOIS_Server','$Registrar_URL','$Updated_Date','$Creation_Date','$Registrar_Registration_Expiration_Date',"
                    . "'$Registrar1','$Registrar2','$Reseller','$Domain_Status','$Registry_Registrant_ID','$Registrant_Name','$Registrant_Organization','$Registrant_Street',"
                    . "'$Registrant_City','$Registrant_State','$Registrant_Postal_Code','$Registrant_Country','$Registrant_Phone','$Registrant_Phone_Ext',"
                    . "'$Registrant_Fax','$Registrant_Fax_Ext','$Registrant_Email','$Registry_Admin_ID','$Admin_Name','$Admin_Organization','$Admin_Street',"
                    . "'$Admin_City','$Admin_State','$Admin_Postal_Code','$Admin_Country','$Admin_Phone','$Admin_Phone_Ext','$Admin_Fax','$Admin_Fax_Ext','$Admin_Email',"
                    . "'$Registry_Tech_ID','$Tech_Name','$Tech_Organization','$Tech_Street','$Tech_City','$Tech_State','$Tech_Postal_Code','$Tech_Country',"
                    . "'$Tech_Phone','$Tech_Phone_Ext','$Tech_Fax','$Tech_Fax_Ext','$Tech_Email','$DNSSEC','$Registrar_Abuse_Contact_Email',"
                    . "'$Registrar_Abuse_Contact_Phone','$URL_of_the_ICANN_WHOIS_Data_Problem_Reporting_System','$moreinformation')";
            $sql = mysql_query($query, $con);
            return $merge3;
        }
    } else {
        return "not registered";
    }
}
?>



