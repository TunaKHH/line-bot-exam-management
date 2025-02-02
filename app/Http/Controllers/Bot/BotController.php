<?php

namespace App\Http\Controllers\Bot;

use App\Http\Controllers\Controller;
use App\Services\BotService;
use Illuminate\Http\Request;
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;

class BotController extends Controller
{
    protected $botService;

    public function __construct(BotService $botService)
    {
        $this->botService = $botService;
    }

    public function test(Request $request)
    {
        // 回傳 200
        return response()->json(['message' => 'ok'], 200);
    }

    public function chat(Request $request)
    {

        //實體化linebot物件
        $httpClient = new CurlHTTPClient(env('LINE_CHANNEL_ACCESS_TOKEN'));
        $bot = new LINEBot($httpClient, ['channelSecret' => env('LINE_CHANNEL_SECRET')]);

        //取得使用者id和訊息內容
        $text = $request->events[0]['message']['text'];
        $user_id = $request->events[0]['source']['userId'];
        $reply_token = $request->events[0]['replyToken'];

        // 取得測驗資料
        $quizData = $this->botService->start(1, $user_id);

        // 回覆訊息
        // $bot->replyText($reply_token, $quizData['quizTitle']);
        $textMessageBuilder = new TextMessageBuilder('test');
        $bot->replyMessage($reply_token, $textMessageBuilder);

        // 回傳 200
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

    private function getFlexMessage()
    {
        return [
            "type" => "bubble",
            "hero" => [
                "type" => "image",
                "url" => "https://scdn.line-apps.com/n/channel_devcenter/img/fx/01_5_carousel.png",
                "size" => "full",
                "aspectRatio" => "20:13",
                "aspectMode" => "cover",
                "action" => [
                    "type" => "uri",
                    "uri" => "http://linecorp.com/",
                ],
            ],
            "body" => [
                "type" => "box",
                "layout" => "vertical",
                "spacing" => "sm",
                "contents" => [
                    [
                        "type" => "text",
                        "text" => "Arm Chair, White",
                        "wrap" => true,
                        "weight" => "bold",
                        "size" => "xl",
                    ],
                    [
                        "type" => "box",
                        "layout" => "baseline",
                        "spacing" => "sm",
                        "contents" => [
                            [
                                "type" => "text",
                                "text" => "$49",
                                "wrap" => true,
                                "weight" => "bold",
                                "size" => "xl",
                                "flex" => 0,
                            ],
                            [
                                "type" => "text",
                                "text" => ".99",
                                "wrap" => true,
                                "weight" => "bold",
                                "size" => "sm",
                                "flex" => 0,
                            ],
                        ],
                    ],
                    [
                        "type" => "text",
                        "text" => "Temporarily out of stock",
                        "wrap" => true,
                        "size" => "xxs",
                        "margin" => "md",
                        "color" => "#ff5551",
                        "flex" => 0,
                    ],
                ],
            ],
            "footer" => [
                "type" => "box",
                "layout" => "vertical",
                "spacing" => "sm",
                "contents" => [
                    [
                        "type" => "button",
                        "style" => "primary",
                        "action" => [
                            "type" => "uri",
                            "label" => "Add to Cart",
                            "uri" => "https://linecorp.com",
                        ],
                    ],
                    [
                        "type" => "button",
                        "action" => [
                            "type" => "uri",
                            "label" => "Add to wishlist",
                            "uri" => "https://linecorp.com",
                        ],
                    ],
                ],
            ],
        ];
    }
}
