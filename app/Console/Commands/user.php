<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class user extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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

        $username = $this->ask('Enter your username');

        if (!$username) {
            die('Please provide username for your admin account');
        }

        $email = $this->ask('Enter your email address');

        $validator = Validator::make(
            [
                'email' => $email
            ],
            [
                'email' =>
                    'required|email'
            ]
        );

        if ($validator->fails()) {
            $this->warn($validator->currentRule);
            die();
        }

        $password = $this->secret('Enter password');

        if (!$password) {
            die('Please provide password');
        }

        $password_confirm = $this->secret('Confirm your password');

        if ($password_confirm !== $password) {
            die('Passwords did not match');
        }

        $admin = new \App\User();
        $admin->name = $username;
        $admin->email = $email;
        $admin->password = Hash::make($password);

        if (!$admin->save()) {
            die('Failed to save admin data to database');
        }

        die('Admin account created successfully ');
    }
}
