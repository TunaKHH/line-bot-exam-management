<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Option;
use App\Models\Result;
use Illuminate\Http\Request;
use LINE\LINEBot;
use LINE\LINEBot\Event\MessageEvent\TextMessage;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use LINE\LINEBot\QuickReplyBuilder\QuickReplyMessageBuilder;
use LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;

class LineBotController extends Controller
{
    public function handle(Request $request)
    {
        $httpClient = new CurlHTTPClient(env('LINE_CHANNEL_ACCESS_TOKEN'));

        $bot = new LINEBot($httpClient, ['channelSecret' => env('LINE_CHANNEL_SECRET')]);
        $signature = $request->header('X-Line-Signature');

        if (!$bot->validateSignature($request->getContent(), $signature)) {
            return response('Invalid signature', 400);
        }

        $events = $bot->parseEventRequest($request->getContent(), $signature);
        foreach ($events as $event) {
            if ($event instanceof TextMessage) {
                $quiz = Quiz::inRandomOrder()->first();

                $options = [];
                foreach ($quiz->options as $option) {
                    $options[] = new MessageTemplateActionBuilder($option->title, $option->title);
                }

                $message = new TextMessageBuilder($quiz->title, new QuickReplyMessageBuilder($options));


                $bot->replyMessage($event->getReplyToken(), $message);
            }
        }

        return response('OK', 200);
    }
}
