<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
class postTime extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:customtime';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'post by time';

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
        $posts = Post::all();
        foreach($posts as $post) {
            if($post->timePost != 0) {
                $post->published = 1;
                $post->save();
            }
        }
       
    }
}
