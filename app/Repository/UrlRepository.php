<?php

namespace App\Repository;

use App\Models\ShortenUrl;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UrlRepository
{

    public function save($data)
    {
      return  ShortenUrl::create([
            'given_url' => $data['input'],
            'short_string' => $data['randomString'],
            'ip_address' => $data['ipAddress'],
            'created_at' => Carbon::now()
        ]);

    }

    public function  getRandomStringId($data)
    {
        return ShortenUrl::where('short_string', $data['randomString'])->first();
    }

    public function saveVisit($data)
    {
        return DB::table('visitors')->insert([
            'short_url_id' => $data['shortUrlId'],
            'ip_address' => $data['ipAddress'],
            'created_at' => Carbon::now()
        ]);
    }

}
