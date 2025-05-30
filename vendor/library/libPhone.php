<?php

/*
	Library 	: libPhone
	Description	: For mobile number validations
	Author		: Shajahan Basha Syed
	
*/
	
class libPhone{
	function checknumber($countrycode,$phonenumber) {
        if (($countrycode == '93') && (strlen($phonenumber) >= '9') && (strlen($phonenumber) <= '9')) { return true; } //Afghanistan
        if (($countrycode == '355') && (strlen($phonenumber) >= '3') && (strlen($phonenumber) <= '9')) { return true; } //Albania
        if (($countrycode == '213') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '9')) { return true; } //Algeria
        if (($countrycode == '376') && (strlen($phonenumber) >= '6') && (strlen($phonenumber) <= '9')) { return true; } //&&orra
        if (($countrycode == '244') && (strlen($phonenumber) >= '9') && (strlen($phonenumber) <= '9')) { return true; } //Angola
        if (($countrycode == '54') && (strlen($phonenumber) >= '10') && (strlen($phonenumber) <= '10')) { return true; } //Argentina
        if (($countrycode == '374') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '8')) { return true; } //Armenia
        if (($countrycode == '297') && (strlen($phonenumber) >= '7') && (strlen($phonenumber) <= '7')) { return true; } //Aruba
        if (($countrycode == '61') && (strlen($phonenumber) >= '5') && (strlen($phonenumber) <= '15')) { return true; } //Australia
        if (($countrycode == '672') && (strlen($phonenumber) >= '6') && (strlen($phonenumber) <= '6')) { return true; } //Australian External Territories
        if (($countrycode == '43') && (strlen($phonenumber) >= '4') && (strlen($phonenumber) <= '13')) { return true; } //Austria
        if (($countrycode == '994') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '9')) { return true; } //Azerbaijan
        if (($countrycode == '973') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '8')) { return true; } //Bahrain
        if (($countrycode == '880') && (strlen($phonenumber) >= '6') && (strlen($phonenumber) <= '10')) { return true; } //Bangladesh
        if (($countrycode == '375') && (strlen($phonenumber) >= '9') && (strlen($phonenumber) <= '10')) { return true; } //Belarus
        if (($countrycode == '32') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '9')) { return true; } //Belgium
        if (($countrycode == '501') && (strlen($phonenumber) >= '7') && (strlen($phonenumber) <= '7')) { return true; } //Belize
        if (($countrycode == '229') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '8')) { return true; } //Benin
        if (($countrycode == '975') && (strlen($phonenumber) >= '7') && (strlen($phonenumber) <= '8')) { return true; } //Bhutan
        if (($countrycode == '591') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '8')) { return true; } //Bolivia (Plurinational State of)
        if (($countrycode == '599') && (strlen($phonenumber) >= '7') && (strlen($phonenumber) <= '7')) { return true; } //Bonaire Sint Eustatius && Saba
        if (($countrycode == '387') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '8')) { return true; } //Bosnia && Herzegovina
        if (($countrycode == '267') && (strlen($phonenumber) >= '7') && (strlen($phonenumber) <= '8')) { return true; } //Botswana
        if (($countrycode == '55') && (strlen($phonenumber) >= '10') && (strlen($phonenumber) <= '10')) { return true; } //Brazil
        if (($countrycode == '673') && (strlen($phonenumber) >= '7') && (strlen($phonenumber) <= '7')) { return true; } //Brunei Darussalam
        if (($countrycode == '359') && (strlen($phonenumber) >= '7') && (strlen($phonenumber) <= '9')) { return true; } //Bulgaria
        if (($countrycode == '226') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '8')) { return true; } //Burkina Faso
        if (($countrycode == '257') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '8')) { return true; } //Burundi
        if (($countrycode == '855') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '8')) { return true; } //Cambodia
        if (($countrycode == '237') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '8')) { return true; } //Cameroon
        if (($countrycode == '238') && (strlen($phonenumber) >= '7') && (strlen($phonenumber) <= '7')) { return true; } //Cape Verde
        if (($countrycode == '236') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '8')) { return true; } //Central African Rep.
        if (($countrycode == '235') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '8')) { return true; } //Chad
        if (($countrycode == '56') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '9')) { return true; } //Chile
        if (($countrycode == '86') && (strlen($phonenumber) >= '5') && (strlen($phonenumber) <= '12')) { return true; } //China
        if (($countrycode == '57') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '10')) { return true; } //Colombia
        if (($countrycode == '269') && (strlen($phonenumber) >= '7') && (strlen($phonenumber) <= '7')) { return true; } //Comoros
        if (($countrycode == '242') && (strlen($phonenumber) >= '9') && (strlen($phonenumber) <= '9')) { return true; } //Congo
        if (($countrycode == '682') && (strlen($phonenumber) >= '5') && (strlen($phonenumber) <= '5')) { return true; } //Cook Isl&&s
        if (($countrycode == '506') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '8')) { return true; } //Costa Rica
        if (($countrycode == '225') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '8')) { return true; } //C?te d'Ivoire
        if (($countrycode == '385') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '12')) { return true; } //Croatia
        if (($countrycode == '53') && (strlen($phonenumber) >= '6') && (strlen($phonenumber) <= '8')) { return true; } //Cuba
        if (($countrycode == '599') && (strlen($phonenumber) >= '7') && (strlen($phonenumber) <= '8')) { return true; } //Cura?ao
        if (($countrycode == '357') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '11')) { return true; } //Cyprus
        if (($countrycode == '420') && (strlen($phonenumber) >= '4') && (strlen($phonenumber) <= '12')) { return true; } //Czech Rep.
        if (($countrycode == '850') && (strlen($phonenumber) >= '6') && (strlen($phonenumber) <= '17')) { return true; } //Dem. People's Rep. of Korea
        if (($countrycode == '243') && (strlen($phonenumber) >= '5') && (strlen($phonenumber) <= '9')) { return true; } //Dem. Rep. of the Congo
        if (($countrycode == '45') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '8')) { return true; } //Denmark
        if (($countrycode == '246') && (strlen($phonenumber) >= '7') && (strlen($phonenumber) <= '7')) { return true; } //Diego Garcia
        if (($countrycode == '253') && (strlen($phonenumber) >= '6') && (strlen($phonenumber) <= '6')) { return true; } //Djibouti
        if (($countrycode == '593') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '8')) { return true; } //Ecuador
        if (($countrycode == '20') && (strlen($phonenumber) >= '7') && (strlen($phonenumber) <= '9')) { return true; } //Egypt
        if (($countrycode == '503') && (strlen($phonenumber) >= '7') && (strlen($phonenumber) <= '11')) { return true; } //El Salvador
        if (($countrycode == '240') && (strlen($phonenumber) >= '9') && (strlen($phonenumber) <= '9')) { return true; } //Equatorial Guinea
        if (($countrycode == '291') && (strlen($phonenumber) >= '7') && (strlen($phonenumber) <= '7')) { return true; } //Eritrea
        if (($countrycode == '372') && (strlen($phonenumber) >= '7') && (strlen($phonenumber) <= '10')) { return true; } //Estonia
        if (($countrycode == '251') && (strlen($phonenumber) >= '9') && (strlen($phonenumber) <= '9')) { return true; } //Ethiopia
        if (($countrycode == '500') && (strlen($phonenumber) >= '5') && (strlen($phonenumber) <= '5')) { return true; } //Falkl&& Isl&&s (Malvinas)
        if (($countrycode == '298') && (strlen($phonenumber) >= '6') && (strlen($phonenumber) <= '6')) { return true; } //Faroe Isl&&s
        if (($countrycode == '679') && (strlen($phonenumber) >= '7') && (strlen($phonenumber) <= '7')) { return true; } //Fiji
        if (($countrycode == '358') && (strlen($phonenumber) >= '5') && (strlen($phonenumber) <= '12')) { return true; } //Finl&&
        if (($countrycode == '33') && (strlen($phonenumber) >= '9') && (strlen($phonenumber) <= '9')) { return true; } //France
        if (($countrycode == '262') && (strlen($phonenumber) >= '9') && (strlen($phonenumber) <= '9')) { return true; } //French Departments && Territories in the Indian Ocean
        if (($countrycode == '594') && (strlen($phonenumber) >= '9') && (strlen($phonenumber) <= '9')) { return true; } //French Guiana
        if (($countrycode == '689') && (strlen($phonenumber) >= '6') && (strlen($phonenumber) <= '6')) { return true; } //French Polynesia
        if (($countrycode == '241') && (strlen($phonenumber) >= '6') && (strlen($phonenumber) <= '7')) { return true; } //Gabon
        if (($countrycode == '220') && (strlen($phonenumber) >= '7') && (strlen($phonenumber) <= '7')) { return true; } //Gambia
        if (($countrycode == '995') && (strlen($phonenumber) >= '9') && (strlen($phonenumber) <= '9')) { return true; } //Georgia
        if (($countrycode == '49') && (strlen($phonenumber) >= '6') && (strlen($phonenumber) <= '13')) { return true; } //Germany
        if (($countrycode == '233') && (strlen($phonenumber) >= '5') && (strlen($phonenumber) <= '9')) { return true; } //Ghana
        if (($countrycode == '350') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '8')) { return true; } //Gibraltar
        if (($countrycode == '30') && (strlen($phonenumber) >= '10') && (strlen($phonenumber) <= '10')) { return true; } //Greece
        if (($countrycode == '299') && (strlen($phonenumber) >= '6') && (strlen($phonenumber) <= '6')) { return true; } //Greenl&&
        if (($countrycode == '590') && (strlen($phonenumber) >= '9') && (strlen($phonenumber) <= '9')) { return true; } //Guadeloupe
        if (($countrycode == '502') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '8')) { return true; } //Guatemala
        if (($countrycode == '224') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '8')) { return true; } //Guinea
        if (($countrycode == '245') && (strlen($phonenumber) >= '7') && (strlen($phonenumber) <= '7')) { return true; } //Guinea-Bissau
        if (($countrycode == '592') && (strlen($phonenumber) >= '7') && (strlen($phonenumber) <= '7')) { return true; } //Guyana
        if (($countrycode == '509') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '8')) { return true; } //Haiti
        if (($countrycode == '504') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '8')) { return true; } //Honduras
        if (($countrycode == '852') && (strlen($phonenumber) >= '4') && (strlen($phonenumber) <= '9')) { return true; } //Hong Kong China
        if (($countrycode == '36') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '9')) { return true; } //Hungary
        if (($countrycode == '354') && (strlen($phonenumber) >= '7') && (strlen($phonenumber) <= '9')) { return true; } //Icel&&
        if (($countrycode == '91') && (strlen($phonenumber) > '9') && (strlen($phonenumber) <= '10')) { return true; } //India
        if (($countrycode == '62') && (strlen($phonenumber) >= '5') && (strlen($phonenumber) <= '10')) { return true; } //Indonesia
        if (($countrycode == '870') && (strlen($phonenumber) >= '9') && (strlen($phonenumber) <= '9')) { return true; } //Inmarsat SNAC
        if (($countrycode == '800') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '8')) { return true; } //International Freephone Service
        if (($countrycode == '882') && (strlen($phonenumber) >= '0') && (strlen($phonenumber) <= '0')) { return true; } //International Networks shared code
        if (($countrycode == '883') && (strlen($phonenumber) >= '0') && (strlen($phonenumber) <= '0')) { return true; } //International Networks shared code
        if (($countrycode == '979') && (strlen($phonenumber) >= '9') && (strlen($phonenumber) <= '9')) { return true; } //International Premium Rate Service (IPRS)
        if (($countrycode == '808') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '8')) { return true; } //International Shared Cost Service (ISCS)
        if (($countrycode == '98') && (strlen($phonenumber) >= '6') && (strlen($phonenumber) <= '10')) { return true; } //Iran (Islamic Republic of)
        if (($countrycode == '964') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '10')) { return true; } //Iraq
        if (($countrycode == '353') && (strlen($phonenumber) >= '7') && (strlen($phonenumber) <= '11')) { return true; } //Irel&&
        if (($countrycode == '972') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '9')) { return true; } //Israel
        if (($countrycode == '39') && (strlen($phonenumber) >= '1') && (strlen($phonenumber) <= '11')) { return true; } //Italy
        if (($countrycode == '81') && (strlen($phonenumber) >= '5') && (strlen($phonenumber) <= '13')) { return true; } //Japan
        if (($countrycode == '962') && (strlen($phonenumber) >= '5') && (strlen($phonenumber) <= '9')) { return true; } //Jordan
        if (($countrycode == '7') && (strlen($phonenumber) >= '10') && (strlen($phonenumber) <= '10')) { return true; } //Kazakhstan
        if (($countrycode == '254') && (strlen($phonenumber) >= '6') && (strlen($phonenumber) <= '10')) { return true; } //Kenya
        if (($countrycode == '686') && (strlen($phonenumber) >= '5') && (strlen($phonenumber) <= '5')) { return true; } //Kiribati
        if (($countrycode == '82') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '11')) { return true; } //Korea (Rep. of)
        if (($countrycode == '965') && (strlen($phonenumber) >= '7') && (strlen($phonenumber) <= '8')) { return true; } //Kuwait
        if (($countrycode == '996') && (strlen($phonenumber) >= '9') && (strlen($phonenumber) <= '9')) { return true; } //Kyrgyzstan
        if (($countrycode == '856') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '10')) { return true; } //Lao P.D.R.
        if (($countrycode == '371') && (strlen($phonenumber) >= '7') && (strlen($phonenumber) <= '8')) { return true; } //Latvia
        if (($countrycode == '961') && (strlen($phonenumber) >= '7') && (strlen($phonenumber) <= '8')) { return true; } //Lebanon
        if (($countrycode == '266') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '8')) { return true; } //Lesotho
        if (($countrycode == '231') && (strlen($phonenumber) >= '7') && (strlen($phonenumber) <= '8')) { return true; } //Liberia
        if (($countrycode == '218') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '9')) { return true; } //Libya
        if (($countrycode == '423') && (strlen($phonenumber) >= '7') && (strlen($phonenumber) <= '9')) { return true; } //Liechtenstein
        if (($countrycode == '370') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '8')) { return true; } //Lithuania
        if (($countrycode == '352') && (strlen($phonenumber) >= '4') && (strlen($phonenumber) <= '11')) { return true; } //Luxembourg
        if (($countrycode == '853') && (strlen($phonenumber) >= '7') && (strlen($phonenumber) <= '8')) { return true; } //Macao China
        if (($countrycode == '261') && (strlen($phonenumber) >= '9') && (strlen($phonenumber) <= '10')) { return true; } //Madagascar
        if (($countrycode == '265') && (strlen($phonenumber) >= '7') && (strlen($phonenumber) <= '8')) { return true; } //Malawi
        if (($countrycode == '60') && (strlen($phonenumber) >= '7') && (strlen($phonenumber) <= '9')) { return true; } //Malaysia
        if (($countrycode == '960') && (strlen($phonenumber) >= '7') && (strlen($phonenumber) <= '7')) { return true; } //Maldives
        if (($countrycode == '223') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '8')) { return true; } //Mali
        if (($countrycode == '356') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '8')) { return true; } //Malta
        if (($countrycode == '692') && (strlen($phonenumber) >= '7') && (strlen($phonenumber) <= '7')) { return true; } //Marshall Isl&&s
        if (($countrycode == '596') && (strlen($phonenumber) >= '9') && (strlen($phonenumber) <= '9')) { return true; } //Martinique
        if (($countrycode == '222') && (strlen($phonenumber) >= '7') && (strlen($phonenumber) <= '7')) { return true; } //Mauritania
        if (($countrycode == '230') && (strlen($phonenumber) >= '7') && (strlen($phonenumber) <= '7')) { return true; } //Mauritius
        if (($countrycode == '52') && (strlen($phonenumber) >= '10') && (strlen($phonenumber) <= '10')) { return true; } //Mexico
        if (($countrycode == '691') && (strlen($phonenumber) >= '7') && (strlen($phonenumber) <= '7')) { return true; } //Micronesia
        if (($countrycode == '373') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '8')) { return true; } //Moldova (Republic of)
        if (($countrycode == '377') && (strlen($phonenumber) >= '5') && (strlen($phonenumber) <= '9')) { return true; } //Monaco
        if (($countrycode == '976') && (strlen($phonenumber) >= '7') && (strlen($phonenumber) <= '8')) { return true; } //Mongolia
        if (($countrycode == '382') && (strlen($phonenumber) >= '4') && (strlen($phonenumber) <= '12')) { return true; } //Montenegro
        if (($countrycode == '212') && (strlen($phonenumber) >= '9') && (strlen($phonenumber) <= '9')) { return true; } //Morocco
        if (($countrycode == '258') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '9')) { return true; } //Mozambique
        if (($countrycode == '95') && (strlen($phonenumber) >= '7') && (strlen($phonenumber) <= '9')) { return true; } //Myanmar
        if (($countrycode == '264') && (strlen($phonenumber) >= '6') && (strlen($phonenumber) <= '10')) { return true; } //Namibia
        if (($countrycode == '674') && (strlen($phonenumber) >= '4') && (strlen($phonenumber) <= '7')) { return true; } //Nauru
        if (($countrycode == '977') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '9')) { return true; } //Nepal
        if (($countrycode == '31') && (strlen($phonenumber) >= '9') && (strlen($phonenumber) <= '9')) { return true; } //Netherl&&s
        if (($countrycode == '687') && (strlen($phonenumber) >= '6') && (strlen($phonenumber) <= '6')) { return true; } //New Caledonia
        if (($countrycode == '64') && (strlen($phonenumber) >= '3') && (strlen($phonenumber) <= '10')) { return true; } //New Zeal&&
        if (($countrycode == '505') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '8')) { return true; } //Nicaragua
        if (($countrycode == '227') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '8')) { return true; } //Niger
        if (($countrycode == '234') && (strlen($phonenumber) >= '7') && (strlen($phonenumber) <= '10')) { return true; } //Nigeria
        if (($countrycode == '683') && (strlen($phonenumber) >= '4') && (strlen($phonenumber) <= '4')) { return true; } //Niue
        if (($countrycode == '47') && (strlen($phonenumber) >= '5') && (strlen($phonenumber) <= '8')) { return true; } //Norway
        if (($countrycode == '968') && (strlen($phonenumber) >= '7') && (strlen($phonenumber) <= '8')) { return true; } //Oman
        if (($countrycode == '92') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '11')) { return true; } //Pakistan
        if (($countrycode == '680') && (strlen($phonenumber) >= '7') && (strlen($phonenumber) <= '7')) { return true; } //Palau
        if (($countrycode == '507') && (strlen($phonenumber) >= '7') && (strlen($phonenumber) <= '8')) { return true; } //Panama
        if (($countrycode == '675') && (strlen($phonenumber) >= '4') && (strlen($phonenumber) <= '11')) { return true; } //Papua New Guinea
        if (($countrycode == '595') && (strlen($phonenumber) >= '5') && (strlen($phonenumber) <= '9')) { return true; } //Paraguay
        if (($countrycode == '51') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '11')) { return true; } //Peru
        if (($countrycode == '63') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '10')) { return true; } //Philippines
        if (($countrycode == '48') && (strlen($phonenumber) >= '6') && (strlen($phonenumber) <= '9')) { return true; } //Pol&&
        if (($countrycode == '351') && (strlen($phonenumber) >= '9') && (strlen($phonenumber) <= '11')) { return true; } //Portugal
        if (($countrycode == '974') && (strlen($phonenumber) >= '3') && (strlen($phonenumber) <= '8')) { return true; } //Qatar
        if (($countrycode == '40') && (strlen($phonenumber) >= '9') && (strlen($phonenumber) <= '9')) { return true; } //Romania
        if (($countrycode == '7') && (strlen($phonenumber) >= '10') && (strlen($phonenumber) <= '10')) { return true; } //Russian Federation
        if (($countrycode == '250') && (strlen($phonenumber) >= '9') && (strlen($phonenumber) <= '9')) { return true; } //Rw&&a
        if (($countrycode == '247') && (strlen($phonenumber) >= '4') && (strlen($phonenumber) <= '4')) { return true; } //Saint Helena Ascension && Tristan da Cunha
        if (($countrycode == '290') && (strlen($phonenumber) >= '4') && (strlen($phonenumber) <= '4')) { return true; } //Saint Helena Ascension && Tristan da Cunha
        if (($countrycode == '508') && (strlen($phonenumber) >= '6') && (strlen($phonenumber) <= '6')) { return true; } //Saint Pierre && Miquelon
        if (($countrycode == '685') && (strlen($phonenumber) >= '3') && (strlen($phonenumber) <= '7')) { return true; } //Samoa
        if (($countrycode == '378') && (strlen($phonenumber) >= '6') && (strlen($phonenumber) <= '10')) { return true; } //San Marino
        if (($countrycode == '239') && (strlen($phonenumber) >= '7') && (strlen($phonenumber) <= '7')) { return true; } //Sao Tome && Principe
        if (($countrycode == '966') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '9')) { return true; } //Saudi Arabia
        if (($countrycode == '221') && (strlen($phonenumber) >= '9') && (strlen($phonenumber) <= '9')) { return true; } //Senegal
        if (($countrycode == '381') && (strlen($phonenumber) >= '4') && (strlen($phonenumber) <= '12')) { return true; } //Serbia
        if (($countrycode == '248') && (strlen($phonenumber) >= '7') && (strlen($phonenumber) <= '7')) { return true; } //Seychelles
        if (($countrycode == '232') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '8')) { return true; } //Sierra Leone
        if (($countrycode == '65') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '12')) { return true; } //Singapore
        if (($countrycode == '421') && (strlen($phonenumber) >= '4') && (strlen($phonenumber) <= '9')) { return true; } //Slovakia
        if (($countrycode == '386') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '8')) { return true; } //Slovenia
        if (($countrycode == '677') && (strlen($phonenumber) >= '5') && (strlen($phonenumber) <= '5')) { return true; } //Solomon Isl&&s
        if (($countrycode == '252') && (strlen($phonenumber) >= '5') && (strlen($phonenumber) <= '8')) { return true; } //Somalia
        if (($countrycode == '27') && (strlen($phonenumber) >= '9') && (strlen($phonenumber) <= '9')) { return true; } //South Africa
        if (($countrycode == '211') && (strlen($phonenumber) >= '1') && (strlen($phonenumber) <= '15')) { return true; } //South Sudan
        if (($countrycode == '34') && (strlen($phonenumber) >= '9') && (strlen($phonenumber) <= '9')) { return true; } //Spain
        if (($countrycode == '94') && (strlen($phonenumber) >= '9') && (strlen($phonenumber) <= '9')) { return true; } //Sri Lanka
        if (($countrycode == '249') && (strlen($phonenumber) >= '9') && (strlen($phonenumber) <= '9')) { return true; } //Sudan
        if (($countrycode == '597') && (strlen($phonenumber) >= '6') && (strlen($phonenumber) <= '7')) { return true; } //Suriname
        if (($countrycode == '268') && (strlen($phonenumber) >= '7') && (strlen($phonenumber) <= '8')) { return true; } //Swazil&&
        if (($countrycode == '46') && (strlen($phonenumber) >= '7') && (strlen($phonenumber) <= '13')) { return true; } //Sweden
        if (($countrycode == '41') && (strlen($phonenumber) >= '4') && (strlen($phonenumber) <= '12')) { return true; } //Switzerl&&
        if (($countrycode == '963') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '10')) { return true; } //Syrian Arab Republic
        if (($countrycode == '886') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '9')) { return true; } //Taiwan China
        if (($countrycode == '992') && (strlen($phonenumber) >= '9') && (strlen($phonenumber) <= '9')) { return true; } //Tajikistan
        if (($countrycode == '255') && (strlen($phonenumber) >= '9') && (strlen($phonenumber) <= '9')) { return true; } //Tanzania
        if (($countrycode == '888') && (strlen($phonenumber) >= '1') && (strlen($phonenumber) <= '15')) { return true; } //Telecommunications for Disaster Relief (TDR)
        if (($countrycode == '66') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '9')) { return true; } //Thail&&
        if (($countrycode == '389') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '9')) { return true; } //The Former Yugoslav Republic of Macedonia
        if (($countrycode == '670') && (strlen($phonenumber) >= '7') && (strlen($phonenumber) <= '7')) { return true; } //Timor-Leste
        if (($countrycode == '228') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '8')) { return true; } //Togo
        if (($countrycode == '690') && (strlen($phonenumber) >= '4') && (strlen($phonenumber) <= '4')) { return true; } //Tokelau
        if (($countrycode == '676') && (strlen($phonenumber) >= '5') && (strlen($phonenumber) <= '7')) { return true; } //Tonga
        if (($countrycode == '991') && (strlen($phonenumber) >= '1') && (strlen($phonenumber) <= '15')) { return true; } //Trial of a proposed new international service shared code
        if (($countrycode == '216') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '8')) { return true; } //Tunisia
        if (($countrycode == '90') && (strlen($phonenumber) >= '10') && (strlen($phonenumber) <= '10')) { return true; } //Turkey
        if (($countrycode == '993') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '8')) { return true; } //Turkmenistan
        if (($countrycode == '688') && (strlen($phonenumber) >= '5') && (strlen($phonenumber) <= '6')) { return true; } //Tuvalu
        if (($countrycode == '256') && (strlen($phonenumber) >= '9') && (strlen($phonenumber) <= '9')) { return true; } //Ug&&a
        if (($countrycode == '380') && (strlen($phonenumber) >= '9') && (strlen($phonenumber) <= '9')) { return true; } //Ukraine
        if (($countrycode == '971') && (strlen($phonenumber) >= '8') && (strlen($phonenumber) <= '9')) { return true; } //United Arab Emirates
        if (($countrycode == '44') && (strlen($phonenumber) >= '7') && (strlen($phonenumber) <= '10')) { return true; } //United Kingdom
        if (($countrycode == '1') && (strlen($phonenumber) >= '10') && (strlen($phonenumber) <= '10')) { return true; } //United States / Canada / Many Isl&& Nations
        if (($countrycode == '878') && (strlen($phonenumber) >= '1') && (strlen($phonenumber) <= '15')) { return true; } //Universal Personal Telecommunication (UPT)
        if (($countrycode == '598') && (strlen($phonenumber) >= '4') && (strlen($phonenumber) <= '11')) { return true; } //Uruguay
        if (($countrycode == '998') && (strlen($phonenumber) >= '9') && (strlen($phonenumber) <= '9')) { return true; } //Uzbekistan
        if (($countrycode == '678') && (strlen($phonenumber) >= '5') && (strlen($phonenumber) <= '7')) { return true; } //Vanuatu
        if (($countrycode == '39') && (strlen($phonenumber) >= '1') && (strlen($phonenumber) <= '11')) { return true; } //Vatican
        if (($countrycode == '379') && (strlen($phonenumber) >= '1') && (strlen($phonenumber) <= '11')) { return true; } //Vatican
        if (($countrycode == '58') && (strlen($phonenumber) >= '10') && (strlen($phonenumber) <= '10')) { return true; } //Venezuela (Bolivarian Republic of)
        if (($countrycode == '84') && (strlen($phonenumber) >= '7') && (strlen($phonenumber) <= '10')) { return true; } //Viet Nam
        if (($countrycode == '681') && (strlen($phonenumber) >= '6') && (strlen($phonenumber) <= '6')) { return true; } //Wallis && Futuna
        if (($countrycode == '967') && (strlen($phonenumber) >= '6') && (strlen($phonenumber) <= '9')) { return true; } //Yemen
        if (($countrycode == '260') && (strlen($phonenumber) >= '9') && (strlen($phonenumber) <= '9')) { return true; } //Zambia
        if (($countrycode == '263') && (strlen($phonenumber) >= '5') && (strlen($phonenumber) <= '10')) { return true; } //Zimbabwe
        
        return false;
    }
}
?>