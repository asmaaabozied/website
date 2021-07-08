<?php
namespace App;

class Googl
{
    public function client()
    {
        $client = new \Google_Client();
//        $client->setClientId("317296958571-hfghnto4qb0ugeqjkqksiticuqcd0j51.apps.googleusercontent.com");
//        $client->setClientSecret("iMTZzfqUks9U54mZCbidp5kF");
//        $client->setRedirectUri('http://localhost:8000/google/login/');
//        $client->setScopes(['email','profile','https://www.googleapis.com/auth/drive']);
//        $client->setApprovalPrompt(env('GOOGLE_APPROVAL_PROMPT'));
//        $client->setAccessType(env('GOOGLE_ACCESS_TYPE'));
//        $client->setAuthConfig(public_path().'/newdrive-d85460a2c0d2.json');

        $client->setClientId("317296958571-hfghnto4qb0ugeqjkqksiticuqcd0j51.apps.googleusercontent.com");
        $client->setClientSecret("iMTZzfqUks9U54mZCbidp5kF");
        $client->setRedirectUri('http://localhost:8000/google/login/');
        $client->setScopes(['email','profile','https://www.googleapis.com/auth/drive']);
        $client->setApprovalPrompt(env('GOOGLE_APPROVAL_PROMPT'));
        $client->setAccessType(env('GOOGLE_ACCESS_TYPE'));

        return $client;
    }


    public function drive($client)
    {
        $drive = new \Google_Service_Drive($client);
        return $drive;
    }
}