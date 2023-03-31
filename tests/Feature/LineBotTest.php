<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot\Event\MessageEvent\TextMessage;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use LINE\LINEBot\QuickReplyBuilder\QuickReplyMessageBuilder;
use LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder;
use App\Models\Quiz;
use App\Models\Option;
use App\Models\Result;

class LineBotTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;

    public function testSendMessage()
    {
        $httpClient = new CurlHTTPClient(env('LINE_CHANNEL_ACCESS_TOKEN'));
        $bot = new LINEBot($httpClient, ['channelSecret' => env('LINE_CHANNEL_SECRET')]);

        $quiz = Quiz::inRandomOrder()->first();
        $options = [];
        foreach ($quiz->options as $option) {
            $options[] = new MessageTemplateActionBuilder($option->title, $option->title);
        }

        $message = new TextMessageBuilder($quiz->title, new QuickReplyMessageBuilder($options));
        $event = new TextMessage(['replyToken' => 'test', 'message' => ['text' => 'test']]);

        $response = $bot->replyMessage('test', $message);

        $this->assertEquals(200, $response->getHTTPStatus());
        $this->assertEquals($quiz->title, $response->getJSONDecodedBody()['messages'][0]['text']);
        $this->assertEquals(count($options), count($response->getJSONDecodedBody()['messages'][0]['quickReply']['items']));
    }
}
