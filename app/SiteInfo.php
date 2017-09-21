<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteInfo extends Model
{
    protected $fillable = ['url', 'logo', 'ip'];

    public function searches() {
        return $this->belongsToMany(Search::class, 'searches', 'site_info_id', 'id');
    }
}
