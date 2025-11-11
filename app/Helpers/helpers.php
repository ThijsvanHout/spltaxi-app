<?php
    use Illuminate\Support\Facades\DB;
    use App\Models\LandWanted;
    use App\Models\Setting;

    if (! function_exists('getStatus')) {
        function getStatus() {
            return [
                'active' => 'Active',
                'pending' => 'Pending',
                'removed' => 'Removed',
                'suspended' => 'Suspended'
            ];
        }
    }

    if (! function_exists('getUserType')) {
        function getUserType() {
            return [
                'agent' => 'Agent',
                'owner' => 'Owner',
                'user' => 'User',
                'buyer' => 'Buyer',
                'admin' => 'Admin',
                'va' => 'Va',
                'leader' => 'Leader',
                'manager' => 'Manager',
                'advertiser' => 'Advertiser',
                'super' => 'Super',
                'assistant' => 'Assistant',
                'messenger' => 'Messenger',
                'sales' => 'Sales',
            ];
        }
    }

    if (! function_exists('getCustomUserType')) {
        function getCustomUserType() {
            return [
                'standard_user' => 'Standard User',
                'private_seller' => 'Private Seller',
                'agent' => 'Agent/Broker/Investor',
                'assistant' => 'Assistant',
                'leader' => 'Leader'
            ];
        }
    }

    if (! function_exists('getOriginalUserTypes')) {

        function getOriginalUserTypes($user_type) {
            if($user_type=="standard_user"){
                return ['user', 'buyer', 'advertiser'];
            }else if($user_type=="private_seller"){
                return ['owner'];
            }else if($user_type=="agent"){
                return ['agent'];
            }else if($user_type=="assistant"){
                return ['assistant'];
            }else if($user_type=="leader"){
                return ['leader'];
            }

        }
    }
    if (! function_exists('getOriginalUserType')) {

        function getOriginalUserType($user_type) {
            if($user_type=="standard_user"){
                return 'user';
            }else if($user_type=="private_seller"){
                return 'owner';
            }else if($user_type=="agent"){
                return 'agent';
            }else if($user_type=="assistant"){
                return 'assistant';
            }else if($user_type=="leader"){
                return 'leader';
            }

        }
    }

    if (! function_exists('createShortDescription')) {

        function createShortDescription($description, $limit = 150, $removeLinks = true) {
            $url_pattern = '/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/';
            $replaceLinkText = $removeLinks ? "" : '<a href="$0" target="_blank">Web Link</a>';

            $shortDescription = nl2br($description);
            $shortDescription = strip_tags($shortDescription);
            $shortDescription = html_entity_decode($shortDescription);
            $shortDescription = preg_replace($url_pattern, $replaceLinkText, $shortDescription);
            $shortDescription = substr($shortDescription, 0, $limit).'...';

            return $shortDescription;
        }
}
    if (! function_exists('getunAprovedSellerTestimonialCount')) {

        function getunAprovedSellerTestimonialCount() {
            $row_count = DB::table('users_comments')->where('isApproved', 0)->count('userCommentsPK');
            return $row_count;
        }
    }

    if (! function_exists('getLandlistingStatus')) {
        function getLandlistingStatus() {
            $statuses = DB::table('land_listing')->select('status')->distinct()->get();
            return $statuses;
        }
    }

    if (! function_exists('getSellerTestimonialStatus')) {

        function getSellerTestimonialStatus() {
            return [
                '1' => 'Approved',
                '0' => 'Not Approved'
            ];
        }
    }

    if (! function_exists('prettyDate')) {
        function prettyDate($date) {
            if (date('Y') == date("Y", strtotime($date))) {
                if (date('m') == date("m", strtotime($date))) {
                    if (date('d') == date("d", strtotime($date))) {
                        return "Today";
                    } elseif (date('d')-1 == date( "d", strtotime($date))) {
                        return "Yesterday";
                    }
                }
                return date( "M n", strtotime($date));
            }
            return date( "M n, Y", strtotime($date));
        }
    }
    if ( !function_exists( "secondsToTime" ) ) {
        function secondsToTime( $seconds ) {
            $dtF = new DateTime( '@0' );
            $dtT = new DateTime( "@$seconds" );
            $days = $dtF->diff( $dtT )->format('%a');
            $hours = $dtF->diff( $dtT )->format('%h');

            if (!$days) {
                if (!$hours) {
                    return $dtF->diff( $dtT )->format('%i minutes, %s seconds');
                } else {
                    return $dtF->diff( $dtT )->format('%h hours, %i minutes' );
                }

            } elseif (!$hours) {
                return $dtF->diff( $dtT )->format('%a days, %i minutes' );
            }

            return $dtF->diff( $dtT )->format( '%a days, %h hours' );
        }
    }

    if (!function_exists('get_all_states')){
        function get_all_states(){
            $states = array( 'Select State' => '','AL' => 'Alabama', 'AK' => 'Alaska', 'AZ' => 'Arizona', 'AR' => 'Arkansas', 'CA' => 'California', 'CO' => 'Colorado', 'CT' => 'Connecticut', 'DE' => 'Delaware', 'DC' => 'District Of Columbia', 'FL' => 'Florida', 'GA' => 'Georgia', 'GU' => 'Guam', 'HI' => 'Hawaii', 'ID' => 'Idaho', 'IL' => 'Illinois', 'IN' => 'Indiana', 'IA' => 'Iowa', 'KS' => 'Kansas', 'KY' => 'Kentucky', 'LA' => 'Louisiana', 'ME' => 'Maine', 'MD' => 'Maryland', 'MA' => 'Massachusetts', 'MI' => 'Michigan', 'MN' => 'Minnesota', 'MS' => 'Mississippi', 'MO' => 'Missouri', 'MT' => 'Montana', 'NE' => 'Nebraska', 'NV' => 'Nevada', 'NH' => 'New Hampshire', 'NJ' => 'New Jersey', 'NM' => 'New Mexico', 'NY' => 'New York', 'NC' => 'North Carolina', 'ND' => 'North Dakota', 'MP' => 'Northern Marianas Islands', 'OH' => 'Ohio', 'OK' => 'Oklahoma', 'OR' => 'Oregon', 'PA' => 'Pennsylvania', 'RI' => 'Rhode Island', 'SC' => 'South Carolina', 'SD' => 'South Dakota', 'TN' => 'Tennessee', 'TX' => 'Texas', 'UT' => 'Utah', 'VT' => 'Vermont', 'VA' => 'Virginia', 'WA' => 'Washington', 'WV' => 'West Virginia', 'WI' => 'Wisconsin', 'WY' => 'Wyoming');
            return $states;
        }
    }

    if(!function_exists('get_states_by_type')){
        function get_states_by_type($type = ""){
            $allStates = get_all_states();
            if($type == ""){
                return $allStates;
            }elseif($type == "landwanted"){
                $states = LandWanted::where('active', 1)->where('state', '<>', null)->select('state')->groupBy('state')->orderBy('state', 'asc')->get();
                $landwantedStates = array();
                foreach($states as $state){
                    if($state == "all"){
                        continue;
                    }
                    $landwantedStates[$state->state] = $allStates[$state->state];
                }
                return $landwantedStates;
            }


            // return $states;
        }
    }


    if (! function_exists('cleanUrl')) {
        function cleanUrl($url) {
            $parsedUrl = parse_url($url);

            if (isset($parsedUrl['host'])) {
                $host = $parsedUrl['host'];
                $host = str_ireplace(['http://', 'https://', 'www.'], '', $host);
                $url = str_ireplace($parsedUrl['host'], $host, $url);
            }

            return $url;
        }
    }
    if (! function_exists('getProfileImage')) {
        function getProfileImage($userID, $hasProfileImage) {
            return $hasProfileImage ? config('app.constants.AWS_IMAGE_URL')."/users/$userID/profileImage.jpg?".date('U') : asset(config('app.constants.DEFAULT_PROFILE_IMAGE'));
        }
    }

    if (! function_exists('getBannerImage')) {
        function getBannerImage($user) {
            return $user->hasBannerImage? config('app.constants.AWS_IMAGE_URL'). "/users/$user->userID/bannerImage.jpg" : asset(config('app.constants.DEFAULT_BANNER_IMAGE'));
        }
    }

    if (! function_exists('getLogoImage')) {
        function getLogoImage($user) {
            return $user->hasLogoImage? config('app.constants.AWS_IMAGE_URL'). "/users/$user->userID/logoImage.jpg?".date('U') : asset(config('app.constants.DEFAULT_LOGO_IMAGE'));
        }
    }

    if (! function_exists('loadSetting')) {
        function loadSetting() {
            $settings = Setting::orderBy('name')->get();

            $settingsData = [];
            foreach ($settings as $setting) {
                $settingsData[$setting->name] = $setting->value;
            }

            return (object) $settingsData;
        }
    }

    if (! function_exists('loadSetting')) {
        function getVideoHtmlWithDimensions($video, $height, $width) {
            $video = preg_replace('/height=[\"\'][0-9]+[\"\']/i', 'height="'.$height.'"', $video);
            $video = preg_replace('/width=[\"\'][0-9]+[\"\']/i', 'width="'.$width.'"', $video);
            return $video;
        }
    }

    if ( !function_exists( "shortenough" ) ) {
        function shortenough( $str, $len ) {
            $words = explode( " ", $str );
            foreach ( $words as $word ) {
                if ( $word == '<iframe' ) {
                    return "true";
                    break;
                }
                $length = strlen( $word );

                if ( $length > $len ) {
                    $testlength = false;
                } else {
                    $testlength = true;
                }
            }
        return $testlength;
        }
    }
    if ( !function_exists( "embedPremiumLinks" ) ) {
        function embedPremiumLinks($text, $isUser, $premium) {
            $url_pattern = '/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/';

            if ($premium) {
                return preg_replace($url_pattern, '<a href="$0" target="_blank">Web Link</a>', $text);

            } elseif ($isUser) {
                return preg_replace($url_pattern, '<a href="'.route("user.premium-options").'?info=embeddedlinks">(Why was my link removed?)</a>', $text);
            }

            return preg_replace($url_pattern, '', $text);
        }
    }
