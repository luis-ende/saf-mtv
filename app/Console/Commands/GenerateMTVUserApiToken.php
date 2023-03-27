<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class GenerateMTVUserApiToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mtv:gen-token {user_id} {token_name=authToken}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Genera API Tokens para usuarios de MTV.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $user = User::find($this->argument('user_id'));
        if ($user) {
            $token = $user->createToken($this->argument('token_name'));
            $this->info("Token generado para el usuario {$user->rfc}: {$token->plainTextToken}");
        }

        return Command::SUCCESS;
    }
}
