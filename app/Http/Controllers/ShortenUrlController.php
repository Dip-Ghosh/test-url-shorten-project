<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormValidationRequest;
use App\Models\ShortenUrl;
use App\Repository\UrlRepository;
use App\Service\UrlService;
use Illuminate\Http\Request;

class ShortenUrlController extends Controller
{

    /**
     * @details- this function will load the view for the shorten url
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     *
     */
    public function create()
    {
        return view('short-url');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createUrl(FormValidationRequest $request,UrlService $urlService,UrlRepository $repository)
    {
        $data['input'] = $request->given_url;
        $data['ipAddress'] = $request->ip();

        $data['randomString'] = $urlService->generateRandomString($data['input']);
        $shortLink = url('/').'/'.$data['randomString'];

        $repository->save($data);
        return response()->json([
            'success'=> 'Data is successfully added',
            'url' => $data['input'],
            'shortLink' => $shortLink,
            'randomString' => $data['randomString']
        ],200);
    }



    public function saveVisit(Request $request,UrlRepository $repository)
    {
       $data['ipAddress'] = $request->ip();
       $data['randomString'] = $request->randomString;

       $value = $repository->getRandomStringId($data);
       $data['shortUrlId'] = $value->id;

       $repository->saveVisit($data);

        return response()->json([
            'success'=> 'Data is successfully added',
        ],200);


    }

}
