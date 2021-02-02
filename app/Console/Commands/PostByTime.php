<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Comment;
class PostByTime extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:time';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Schedule post in time';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $comments = [
            'aberration' => 'a state or condition markedly different from the norm',
            'convivial' => 'occupied with or fond of the pleasures of good company',
            'diaphanous' => 'so thin as to transmit light',
            'elegy' => 'a mournful poem; a lament for the dead',
            'ostensible' => 'appearing as such but not necessarily so'
        ];
        $key = array_rand($comments);
        $value = $comments[$key];

        $comment = new Comment();
        $comment->content = $value;
        $comment->post_id = 1;
        $comment->user_id = 3;

        $comment->save();
        $this->info('Commented');
    }
}
