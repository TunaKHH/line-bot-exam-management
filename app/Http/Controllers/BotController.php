<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;

class BotController extends Controller
{
    function chat(Request $request)
    {
        //實體化linebot物件
        $httpClient = new CurlHTTPClient(env('LINEBOT_TOKEN'));
        $bot = new LINEBot($httpClient, ['channelSecret' => env('LINEBOT_SECRET')]);

        //取得使用者id和訊息內容
        $text = $request->events[0]['message']['text'];
        $user_id = $request->events[0]['source']['userId'];
        $reply_token = $request->events[0]['replyToken'];
        // 回覆訊息
        $bot->replyText($reply_token, $text);
        // 回傳200
        return response()->json(['message' => 'ok'], 200);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 回傳200
        return response()->json(['message' => 'ok'], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
