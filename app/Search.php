<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    protected $fillable = ['country', 'searcher_ip', 'site_info_id'];

    public function siteInfo(){
        return $this->hasOne(SiteInfo::class, 'id', 'site_info_id');
    }
}
