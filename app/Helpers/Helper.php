<?php 

if(!function_exists('curlGetRequest')){

    function curlGetRequest($url){
        $ch = curl_init();
        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_HEADER => 0,
            CURLOPT_POST => 0,
            CURLOPT_RETURNTRANSFER => true
        ); // cURL options
        curl_setopt_array($ch, $options);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
}

if(!function_exists('curlPostRequest')){
    function curlPostRequest($url, $postfields, $headers=[]) {
        $ch = curl_init();
        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_HEADER => false,
            CURLOPT_POST => 1,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_RETURNTRANSFER => true
        ); // cURL options
        curl_setopt_array($ch, $options);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }
}

if(!function_exists('decodeWayPoints')){
    
    function decodeWayPoints($string){
        # Step 11) unpack the string as unsigned char 'C'
        $byte_array = array_merge(unpack('C*', $string));
        $results = array();

        $index = 0; # tracks which char in $byte_array
        do {
          $shift = 0;
          $result = 0;
          do {
            $char = $byte_array[$index] - 63; # Step 10
            # Steps 9-5
            # get the least significat 5 bits from the byte
            # and bitwise-or it into the result
            $result |= ($char & 0x1F) << (5 * $shift);
            $shift++; $index++;
          } while ($char >= 0x20); # Step 8 most significant bit in each six bit chunk
            # is set to 1 if there is a chunk after it and zero if it's the last one
            # so if char is less than 0x20 (0b100000), then it is the last chunk in that num

          # Step 3-5) sign will be stored in least significant bit, if it's one, then 
          # the original value was negated per step 5, so negate again
          if ($result & 1)
            $result = ~$result;
          # Step 4-1) shift off the sign bit by right-shifting and multiply by 1E-5
          $result = ($result >> 1) * 0.00001;
          $results[] = $result;
        } while ($index < count($byte_array));

        # to save space, lat/lons are deltas from the one that preceded them, so we need to 
        # adjust all the lat/lon pairs after the first pair
        for ($i = 2; $i < count($results); $i++) {
          $results[$i] += $results[$i - 2];
        }
        
        # chunk the array into pairs of lat/lon values
        return array_chunk($results, 2);

    }
}

if(!function_exists('distanceBetweenTwoLatAndLang')){
    function distanceBetweenTwoLatAndLang($lat1, $lon1, $lat2, $lon2, $unit) {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);
        $distance = 0;
        if ($unit == "K") {
          $distance = ($miles * 1.609344);
        } else if ($unit == "N") {
            $distance = ($miles * 0.8684);
        } else {
            $distance = $miles;
        }
        return $distance;
    }
   
}

if(!function_exists('fetch')){
    function fetch($container =[], $key, $default= NULL){
        if(isset($container[$key])){
            return $container[$key];
        }else{
            return $default;
        }
    }
}

if(!function_exists('prepareData')){
    function prepareData(&$obj, $structure=[], $inputData=[] ){
        $data = [];
        foreach($structure as $str){
            $val = NULL;
            $default = isset($str['default'])?$str['default']:NULL;
            if(isset($str['runFunc'])){
                $fun =$str['runFunc'];
                $val = $obj->$fun();
            }else{
                $val = isset($inputData[$str['key']])?$inputData[$str['key']]:$default;
            }
            if(isset($str['key']) && !empty($str['key']) && !is_null($val)){
                $data[$str['key']] = $val;
            }
            
        }
        return $data;
    }
}

if(!function_exists('getVRNNo')){
    function getBookingNo($vrnNo){
        return 'VRN '.strtoupper(base_convert($vrnNo,10,36));  
    }
}


if(!function_exists('getUniqueStringHash')){
    function getUniqueStringHash(){
        return hash('sha256', uniqid());
    }
}


if(!function_exists('formatDateInterval')){
    function formatDateInterval($interval, $to = 's'){
        switch($to){
            case 's':{
                return $interval->days*86400+$interval->h*3600+$interval->i*60+$interval->s;
            }break;
            case 'i':{
                return $interval->days*1440+$interval->h*60+$interval->i;
            }break;
            case 'h':{
                return $interval->days*24+$interval->h;
            }break;
            case 'd':{
                return $interval->days;
            }break;
            default:
        }
    }
}
