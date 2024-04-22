<?php

namespace App\Jobs;

use App\Mail\WelcomeEmail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

    class CreateUserJob
    {
        use Dispatchable;

        protected $data;
        protected $plaintextPassword; 


        public function __construct(array $data, string $plaintextPassword)
        {
            $this->data = $data;
            $this->plaintextPassword = $plaintextPassword;
        }

        public function handle()
        {
            $this->data['password'] = Hash::make($this->plaintextPassword);
            $this->data['first_time_login'] = 1;
            $user = User::create($this->data);
            $user->roles()->attach($this->data['role']);
            Mail::to($user->email)->send(new WelcomeEmail($user, $this->plaintextPassword));
            
            return $user;
        }
    }
