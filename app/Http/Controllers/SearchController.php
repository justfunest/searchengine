<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Search;
use App\SiteInfo;

class SearchController extends Controller
{
    public function index() {
        $searches = Search::orderBy('created_at', 'desc')->paginate(10);
        return view('searches.index', ['searches' => $searches]);
    }

    public function store(SearchRequest $request) {

        $url = $request->input('url');
        $site_info = SiteInfo::where('url', $url)->first();

        if (!$site_info) {
            $site_info = $this->storeSiteInfo($url);
        }

        $search = new Search();
        $search->country = $request->input('country');
        $search->searcher_ip = $request->input('searcher_ip');
        $search->site_info_id = $site_info->id;
        $search->save();

        return redirect(route('home'));

    }

    private function storeSiteInfo($url) {
        $url_host = parse_url($url, PHP_URL_HOST);
        $url_ip = gethostbyname($url_host);

        $logoUrl = 'https://logo.clearbit.com/' . $url_host;
        $curl = curl_init($logoUrl);
        $image =  curl_exec($curl);
        $info = curl_getinfo($curl);

        $site_info = new SiteInfo();
        $site_info->url = $url;
        $site_info->logo = $info['request_size'] > 1 && $info['content_type'] == 'image/png' ? $logoUrl : '';
        $site_info->ip = $url_ip;
        $site_info->save();

        return $site_info;
    }
}
