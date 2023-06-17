<?php

namespace App\Services;


use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class Telegram
{

    protected $http;
    protected $bot;
    public $months = [
        '1' => 'Январь',
        '2' => 'Февраль',
        '3' => 'Март',
        '4' => 'Апрель',
        '5' => 'Май',
        '6' => 'Июнь',
        '7' => 'Июль',
        '8' => 'Август',
        '9' => 'Сентябрь',
        '10' => 'Октябрь',
        '11' => 'Ноябрь',
        '12' => 'Декабрь'
    ];

    const buttons = [
        'resize_keyboard' => true,
        // 'one_time_keyboard' => false,
        'keyboard' => [
            [
                [
                    'text' => 'Расходы в этом году',
                    'callback_data' => '1',
                ],
                [
                    'text' => 'Расходы в прошлом месяце',
                    'callback_data' => '2',
                ]
            ],
            [
                [
                    'text' => 'Расходы в этом месяце',
                    'callback_data' => '3',
                ],
                [
                    'text' => 'Сайт',
                    'callback_data' => '4',
                ],
            ],
        ]
    ];
    const url = 'https://api.telegram.org/bot';

    public function __construct($bot)
    {
        $this->http = Http::class;
        $this->bot = $bot;

    }


    function sendMessage($chat_id, $data)
    {
        $time = now();
        $name = $data['name'];
        $briquette = $data['briquette'];
        $bake = $data['bake'];
        $packed_1 = $data['packed_1'];
        $packed_2 = $data['packed_2'];
        return $this->http::post(self::url . $this->bot . '/sendMessage',
            [
                'chat_id' => $chat_id,
                'text' => (string)view('telegram.product',
                    compact('name', 'briquette', 'bake', 'packed_1', 'packed_2', 'time')),
                'parse_mode' => 'html',
            ]);


    }

    function editMessage($chat_id, $message, $message_id)
    {
        return $this->http::post(self::url . $this->bot . '/editMessageText',
            [
                'chat_id' => $chat_id,
                'message_id' => $message_id,
                'text' => '<i> -' . $message . '- EDIT </i>',
                'parse_mode' => 'html',
            ]);
    }

    function sendButton($chat_id, $message, $button = self::buttons)
    {
        $http_bot_mess = $this->http::post(self::url . $this->bot . '/sendMessage',
            [
                'chat_id' => $chat_id,
                'text' => '<i> -' . $message . '- </i>',
                'parse_mode' => 'html',
                'reply_markup' => $button
            ]);

        return $http_bot_mess;
    }


}
