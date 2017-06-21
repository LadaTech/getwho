<?php

include_once('whois/whois.main.php');
include_once('config.php');
function getwhois($query, $insertdb = 1) {
    $whois = new Whois();
    $result = $whois->Lookup($query, false);

    if (isset($result['regrinfo']['registered']) && $result['regrinfo']['registered'] == 'yes') {
        if ($insertdb == 0) {
            return "registered";
        }
        $rows = mysql_query("select * from server_details where name='$query'");
        $norows = mysql_num_rows($rows);
        if (array_key_exists("regrinfo", $result)) {
            $regrinfo_result = $result['regrinfo'];
            $name['registered'] = $registered = $regrinfo_result['registered'];
            if (array_key_exists('domain', $regrinfo_result)) {
                $domain_result = $regrinfo_result['domain'];
                if (isset($domain_result['name'])) {
                    $name['name'] = $name_result = $domain_result['name'];
                }
                $nserver_result = $domain_result['nserver'];
                $status_result = $domain_result['status'];

                if (is_array($status_result)) {
                    $name['status'] = $status_value = $status_result[0];
                } elseif (isset($status_result)) {
                    $name['status'] = $status_value = $status_result['status'];
                }

                if (isset($domain_result['changed'])) {
                    $ipdates['changed'] = $changed_result = $domain_result['changed'];
                }
                if (isset($domain_result['created'])) {
                    $ipdates['created'] = $created_result = $domain_result['created'];
                }
                if (isset($domain_result['expires'])) {
                    $ipdates['expires'] = $expires_result = $domain_result['expires'];
                }

                $server_keys = array_keys($nserver_result);
                $server_values = array_values($nserver_result);
                if (isset($server_keys['0'])) {
                    $server1['sname1'] = $servername1 = $server_keys['0'];
                } else {
                    $server1['sname1'] = $servername1 = NULL;
                }
                if (isset($server_keys['1'])) {
                    $server1['sname2'] = $servername2 = $server_keys['1'];
                } else {
                    $server1['sname2'] = $servername2 = NULL;
                }
                if (isset($server_keys['0'])) {
                    $server1['svalue1'] = $servervalue1 = $server_values['0'];
                } else {
                    $server1['svalue1'] = $servervalue1 = NULL;
                }
                if (isset($server_keys['1'])) {
                    $server1['svalue2'] = $servervalue2 = $server_values['1'];
                } else {
                    $server1['svalue2'] = $servervalue2 = NULL;
                }

            }
            $merge = array_merge($name, $server1, $ipdates);
        }
        if (array_key_exists("regyinfo", $result)) {
            $regyinfo_result = $result['regyinfo'];
            if (isset($regyinfo_result['registrar'])) {
                $registarar_data['registrar'] = $registrar_result = $regyinfo_result['registrar'];
            }
            if (isset($regyinfo_result['referrer'])) {
                $registarar_data['referrer'] = $referrer_result = $regyinfo_result['referrer'];
            }
            $servers_result = $regyinfo_result['servers'];
            if (isset($regyinfo_result['type'])) {
                $registarar_data['type'] = $type_result = $regyinfo_result['type'];
            }
            foreach ($servers_result as $values) {
                foreach ($values as $values1) {
                    $newArray[] = $values1;
                }
            }

            if (isset($newArray[0])) {
                $newarray1['server1'] = $server1 = $newArray[0];
            } else {
                $newarray1['server1'] = $server1 = NULL;
            }
            if (isset($newArray[1])) {
                $newarray1['args1'] = $args1 = $newArray[1];
            } else {
                $newarray1['args1'] = $args1 = NULL;
            }
            if (isset($newArray[2])) {
                $newarray1['port1'] = $port1 = $newArray[2];
            } else {
                $newarray1['port1'] = $port1 = NULL;
            }
            if (isset($newArray[3])) {
                $newarray1['server2'] = $server2 = $newArray[3];
            } else {
                $newarray1['server2'] = $server2 = NULL;
            }
            if (isset($newArray[4])) {
                $newarray1['args2'] = $args2 = $newArray[4];
            } else {
                $newarray1['args2'] = NULL;
            }
            if (isset($newArray[5])) {
                $newarray1['port2'] = $port2 = $newArray[5];
            } else {
                $newarray1['port2'] = $port2 = NULL;
            }
            $merge1 = array_merge($registarar_data, $newarray1);
        }
        if (array_key_exists("rawdata", $result)) {
            $rawdata_result = $result['rawdata'];

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
        } else {
            $Domain_Name = NULL;
        }

        if (isset($combined['Registry Domain ID'])) {
            $Registry_Domain_ID = trim(mysql_real_escape_string($combined['Registry Domain ID']));
        } else {
            $Registry_Domain_ID = NULL;
        }
        if (isset($combined['Registrar WHOIS Server'])) {
            $Registrar_WHOIS_Server = trim(mysql_real_escape_string($combined['Registrar WHOIS Server']));
        } else {
            $Registrar_WHOIS_Server = NULL;
        }
        if (isset($combined['Registrar URL'])) {
            $Registrar_URL = trim(mysql_real_escape_string($combined['Registrar URL']));
        } else {
            $Registrar_URL = NULL;
        }

        if (isset($combined['Updated Date'])) {
            $Updated_Date = trim(mysql_real_escape_string($combined['Updated Date']));
        } else {
            $Updated_Date = NULL;
        }
        if (isset($combined['Creation Date'])) {
            $Creation_Date = trim(mysql_real_escape_string($combined['Creation Date']));
        } else {
            $Creation_Date = NULL;
        }
        if (isset($combined['Registrar Registration Expiration Date'])) {
            $Registrar_Registration_Expiration_Date = trim(mysql_real_escape_string($combined['Registrar Registration Expiration Date']));
        } else {
            $Registrar_Registration_Expiration_Date = NULL;
        }
        if (isset($combined['Registrar'])) {
            $Registrar1 = trim(mysql_real_escape_string($combined['Registrar']));
        } else {
            $Registrar1 = NULL;
        }
        if (isset($combined['Registrar IANA ID'])) {
            $Registrar2 = trim(mysql_real_escape_string($combined['Registrar IANA ID']));
        } else {
            $Registrar2 = NULL;
        }
        if (isset($combined['Reseller'])) {
            $Reseller = trim(mysql_real_escape_string($combined['Reseller']));
        } else {
            $Reseller = NULL;
        }
        if (isset($combined['Domain Status'])) {
            $Domain_Status = trim(mysql_real_escape_string($combined['Domain Status']));
        } else {
            $Domain_Status = NULL;
        }
        if (isset($combined['Registry Registrant ID'])) {
            $Registry_Registrant_ID = trim(mysql_real_escape_string($combined['Registry Registrant ID']));
        } else {
            $Registry_Registrant_ID = NULL;
        }
        if (isset($combined['Registrant Name'])) {
            $Registrant_Name = trim(mysql_real_escape_string($combined['Registrant Name']));
        } else {
            $Registrant_Name = NULL;
        }
        if (isset($combined['Registrant Organization'])) {
            $Registrant_Organization = trim(mysql_real_escape_string($combined['Registrant Organization']));
        } else {
            $Registrant_Organization = NULL;
        }
        if (isset($combined['Registrant Street'])) {
            $Registrant_Street = trim(mysql_real_escape_string($combined['Registrant Street']));
        } else {
            $Registrant_Street = NULL;
        }
        if (isset($combined['Registrant City'])) {
            $Registrant_City = trim(mysql_real_escape_string($combined['Registrant City']));
        } else {
            $Registrant_City = NULL;
        }
        if (isset($combined['Registrant State/Province'])) {
            $Registrant_State = trim(mysql_real_escape_string($combined['Registrant State/Province']));
        } else {
            $Registrant_State = NULL;
        }
        if (isset($combined['Registrant Postal Code'])) {
            $Registrant_Postal_Code = trim(mysql_real_escape_string($combined['Registrant Postal Code']));
        } else {
            $Registrant_Postal_Code = NULL;
        }
        if (isset($combined['Registrant Country'])) {
            $Registrant_Country = trim(mysql_real_escape_string($combined['Registrant Country']));
        } else {
            $Registrant_Country = NULL;
        }
        if (isset($combined['Registrant Phone'])) {
            $Registrant_Phone = trim(mysql_real_escape_string($combined['Registrant Phone']));
        } else {
            $Registrant_Phone = NULL;
        }
        if (isset($combined['Registrant Phone Ext'])) {
            $Registrant_Phone_Ext = trim(mysql_real_escape_string($combined['Registrant Phone Ext']));
        } else {
            $Registrant_Phone_Ext = NULL;
        }
        if (isset($combined['Registrant Fax'])) {
            $Registrant_Fax = trim(mysql_real_escape_string($combined['Registrant Fax']));
        } else {
            $Registrant_Fax = NULL;
        }
        if (isset($combined['Registrant Fax Ext'])) {
            $Registrant_Fax_Ext = trim(mysql_real_escape_string($combined['Registrant Fax Ext']));
        } else {
            $Registrant_Fax_Ext = NULL;
        }
        if (isset($combined['Registrant Email'])) {
            $Registrant_Email = trim(mysql_real_escape_string($combined['Registrant Email']));
        } else {
            $Registrant_Email = NULL;
        }
        if (isset($combined['Registry Admin ID'])) {
            $Registry_Admin_ID = trim(mysql_real_escape_string($combined['Registry Admin ID']));
        } else {
            $Registry_Admin_ID = NULL;
        }
        if (isset($combined['Admin Name'])) {
            $Admin_Name = trim(mysql_real_escape_string($combined['Admin Name']));
        } else {
            $Admin_Name = NULL;
        }
        if (isset($combined['Admin Organization'])) {
            $Admin_Organization = trim(mysql_real_escape_string($combined['Admin Organization']));
        } else {
            $Admin_Organization = NULL;
        }
        if (isset($combined['Admin Street'])) {
            $Admin_Street = trim(mysql_real_escape_string($combined['Admin Street']));
        } else {
            $Admin_Street = NULL;
        }
        if (isset($combined['Admin City'])) {
            $Admin_City = trim(mysql_real_escape_string($combined['Admin City']));
        } else {
            $Admin_City = NULL;
        }
        if (isset($combined['Admin State/Province'])) {
            $Admin_State = trim(mysql_real_escape_string($combined['Admin State/Province']));
        } else {
            $Admin_State = NULL;
        }
        if (isset($combined['Admin Postal Code'])) {
            $Admin_Postal_Code = trim(mysql_real_escape_string($combined['Admin Postal Code']));
        } else {
            $Admin_Postal_Code = NULL;
        }
        if (isset($combined['Admin Country'])) {
            $Admin_Country = trim(mysql_real_escape_string($combined['Admin Country']));
        } else {
            $Admin_Country = NULL;
        }
        if (isset($combined['Admin Phone'])) {
            $Admin_Phone = trim(mysql_real_escape_string($combined['Admin Phone']));
        } else {
            $Admin_Phone = NULL;
        }
        if (isset($combined['Admin Phone Ext'])) {
            $Admin_Phone_Ext = trim(mysql_real_escape_string($combined['Admin Phone Ext']));
        } else {
            $Admin_Phone_Ext = NULL;
        }
        if (isset($combined['Admin Fax'])) {
            $Admin_Fax = trim(mysql_real_escape_string($combined['Admin Fax']));
        } else {
            $Admin_Fax = NULL;
        }
        if (isset($combined['Admin FAX Ext'])) {
            $Admin_Fax_Ext = trim(mysql_real_escape_string($combined['Admin FAX Ext']));
        } else {
            $Admin_Fax_Ext = NULL;
        }
        if (isset($combined['Admin Email'])) {
            $Admin_Email = trim(mysql_real_escape_string($combined['Admin Email']));
        } else {
            $Admin_Email = NULL;
        }
        if (isset($combined['Registry Tech ID'])) {
            $Registry_Tech_ID = trim(mysql_real_escape_string($combined['Registry Tech ID']));
        } else {
            $Registry_Tech_ID = NULL;
        }
        if (isset($combined['Tech Name'])) {
            $Tech_Name = trim(mysql_real_escape_string($combined['Tech Name']));
        } else {
            $Tech_Name = NULL;
        }
        if (isset($combined['Tech Organization'])) {
            $Tech_Organization = trim(mysql_real_escape_string($combined['Tech Organization']));
        } else {
            $Tech_Organization = NULL;
        }
        if (isset($combined['Tech Street'])) {
            $Tech_Street = trim(mysql_real_escape_string($combined['Tech Street']));
        } else {
            $Tech_Street = NULL;
        }
        if (isset($combined['Tech City'])) {
            $Tech_City = trim(mysql_real_escape_string($combined['Tech City']));
        } else {
            $Tech_City = NULL;
        }
        if (isset($combined['Tech State/Province'])) {
            $Tech_State = trim(mysql_real_escape_string($combined['Tech State/Province']));
        } else {
            $Tech_State = NULL;
        }
        if (isset($combined['Tech Postal Code'])) {
            $Tech_Postal_Code = trim(mysql_real_escape_string($combined['Tech Postal Code']));
        } else {
            $Tech_Postal_Code = NULL;
        }
        if (isset($combined['Tech Country'])) {
            $Tech_Country = trim(mysql_real_escape_string($combined['Tech Country']));
        } else {
            $Tech_Country = NULL;
        }
        if (isset($combined['Tech Phone'])) {
            $Tech_Phone = trim(mysql_real_escape_string($combined['Tech Phone']));
        } else {
            $Tech_Phone = NULL;
        }
        if (isset($combined['Tech Phone Ext'])) {
            $Tech_Phone_Ext = trim(mysql_real_escape_string($combined['Tech Phone Ext']));
        } else {
            $Tech_Phone_Ext = NULL;
        }
        if (isset($combined['Tech Fax'])) {
            $Tech_Fax = trim(mysql_real_escape_string($combined['Tech Fax']));
        } else {
            $Tech_Fax = NULL;
        }
        if (isset($combined['Tech Fax Ext'])) {
            $Tech_Fax_Ext = trim(mysql_real_escape_string($combined['Tech Fax Ext']));
        } else {
            $Tech_Fax_Ext = NULL;
        }
        if (isset($combined['Registrant Fax'])) {
            $Tech_Email = trim(mysql_real_escape_string($combined['Tech Email']));
        } else {
            $Tech_Email = NULL;
        }
        if (isset($combined['DNSSEC'])) {
            $DNSSEC = trim(mysql_real_escape_string($combined['DNSSEC']));
        } else {
            $DNSSEC = NULL;
        }
        if (isset($combined['Registrar Abuse Contact Email'])) {
            $Registrar_Abuse_Contact_Email = trim(mysql_real_escape_string($combined['Registrar Abuse Contact Email']));
        } else {
            $Registrar_Abuse_Contact_Email = NULL;
        }
        if (isset($combined['Registrar Abuse Contact Phone'])) {
            $Registrar_Abuse_Contact_Phone = trim(mysql_real_escape_string($combined['Registrar Abuse Contact Phone']));
        } else {
            $Registrar_Abuse_Contact_Phone = NULL;
        }
        if (isset($combined['URL of the ICANN WHOIS Data Problem Reporting System'])) {
            $URL_of_the_ICANN_WHOIS_Data_Problem_Reporting_System = trim(mysql_real_escape_string($combined['URL of the ICANN WHOIS Data Problem Reporting System']));
        } else {
            $URL_of_the_ICANN_WHOIS_Data_Problem_Reporting_System = NULL;
        }
        $moreinfo1 = array();
        if (isset($moreinfo)) {
            $moreinfo1['moreinfo'] = $moreinformation = trim(mysql_real_escape_string(join('', $moreinfo)));
        }
        $merge2 = array_merge($merge, $merge1, $combined, $moreinfo1);



        if ($norows >= 1) {
            return $merge2;
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
            $sql = mysql_query($query);
            return $merge2;
        }
    } else {
        return "not registered";
    }
}
?>



