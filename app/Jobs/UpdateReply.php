<?php

namespace App\Jobs;

use App\Models\Reply;

class UpdateReply
{
    /**
     * @var \App\Models\Reply
     */
    public $reply;

    /**
     * @var string
     */
    private $body;

    public function __construct(Reply $reply, string $body)
    {
        $this->reply = $reply;
        $this->body = $body;
    }

    public function handle()
    {
        $this->reply->body = $this->body;
        $this->reply->save();
    }
}
