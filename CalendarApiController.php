<?php
/**
 * Note that our recommendations, report, and code samples being shared
 * (“Samples”) are not Ddrive products,and Ddrive will not support such Samples.
 * Samples are offered on as-is basis, and designed only to provide you with
 * certain examples of how such code samples could be utilized. Ddrive does not
 * provide any representation and warranty in relation to Samples.
 *
 * By implementing any of Samples, you agree to solely assume all responsibility
 * for any consequences that arise from such implementation.
 *
 * It is your responsibility to check that the form and content of your property
 * meet all applicable technical, security, legal, and any other compliance
 * requirements.
 */


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libs\GoogleCalendar;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;


class DevelCalendarApiController extends Controller
{

    /**
    * カレンダーのイベント一覧を取得
    * $client: Googleクライアント
    */
    public function listCalendarEvents($client) {

        // カレンダーサービス オブジェクトを生成
        $calendarClient = new \Google_Service_Calendar($client);

        $param = array(
            'orderBy' => 'startTime', // 開始日時順にソート
            'maxResults' => 10,
            'singleEvents' => true,
            'timeMin' => date('c')
        );

        // イベント一覧を取得
        $result = $calendarClient->events->listEvents('primary', $param);

        // レスポンスからイベント一覧を取得
        return $result->items;
    }


    public function demo_calendar($client) {
        $eventList = $this->listCalendarEvents($client);
        return view('listcalendar_ok')->with('list',$eventList);
    }

}
