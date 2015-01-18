<?php

class CronController extends ApiController
{
    public function fetchLatestPlayers($playerId)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://my.playstation.com/playstation/psn/profile/public/userData?onlineId=" . $playerId . "&_=1421398782492");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_HTTPHEADER,
            [
                //'SONYCOOKIE1=2925832384.20480.0000; psvisitM=w; oo_original_visit=1; oo_OODynamicRewrite_weight=0; oo_inv_percent=0; mbox=PC#1420385646156-695203.22_04#1422608368|check#true#1421398828|session#1421398767813-805409#1421400628; s_cc=true; s_ppv=72; oo_inv_hit=2; JSESSIONID=CLLFJ4SSs6D4cXGPpGyr4NsyQJ796T66DwmV0F4Wd1y120PCkg9Y!-1316795318; s_fid=67B5F3CC3A4A1784-2C7B7B89FC58BEA3; s_getNewRepeat=1421398780248-Repeat; gpv_pn=pdc%3Alogged-in%3Atrophies%3Apublic-trophies; s_sq=%5B%5BB%5D%5D; s_vi=[CS]v1|2A54AEBA0548F6A2-60000105C0032EB2[CE]',
                'Accept-Encoding: gzip, deflate, sdch',
                'Accept-Language: en-US,en;q=0.8',
                'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.99 Safari/537.36',
                'Accept: application/json, text/javascript, */*; q=0.01',
                'Referer: https://my.playstation.com/logged-in/trophies/public-trophies/',
                'X-Requested-With: XMLHttpRequest',
                'Connection: keep-alive'
            ]);


        $server_output = curl_exec($ch);

        //echo $server_output;
        $userInfo = json_decode($server_output, true);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "http://localhost/gamerboard/public/api/v1/psn");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, [
            'username'   => $userInfo['handle'],
            'level'      => $userInfo['curLevel'],
            'progress'   => $userInfo['progress'],
            'trophies'   => array_sum($userInfo),
            'bronze'     => $userInfo['trophies']['bronze'],
            'silver'     => $userInfo['trophies']['silver'],
            'gold'       => $userInfo['trophies']['gold'],
            'platinum'   => $userInfo['trophies']['platinum'],
            'avatar_url' => $userInfo['avatarUrl'],
            'api-key'    => 'e758645db188e30fd565e67fefb21388',
        ]);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);

        return $this->respond(['data' => $userInfo]);
    }
}