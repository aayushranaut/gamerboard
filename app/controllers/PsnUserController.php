<?php

use Illuminate\Support\Facades\Input;
use LiquidServe\Transformers\Psn\UserTransformer;

class PsnUserController extends \ApiController
{
    protected $userTransformer;

    function __construct(UserTransformer $userTransformer)
    {
        $this->userTransformer = $userTransformer;
    }

    /**
     * Display a listing of the resource.
     * GET /psn
     *
     * @return Response
     */
    public function index()
    {
        $psnUsers = PsnUser::all();

        return $this->respond([
            'data' => $this->userTransformer->transformCollection($psnUsers->all())
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * GET /psn/create
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * POST /psn
     *
     * @return Response
     */
    public function store()
    {
        if (!Input::has('username') ||
            !Input::has('trophies') ||
            !Input::has('bronze') ||
            !Input::has('silver') ||
            !Input::has('gold') ||
            !Input::has('platinum') ||
            !Input::has('level') ||
            !Input::has('api-key') ||
            Input::get('api-key') != self::API_KEY
        ) {

            return $this->setStatusCode(422)
                ->respondWithError("Parameters failed validation");
        }

        $psnUser = PsnUser::whereUsername(Input::get('username'))->first();

        if ($psnUser) {
            $psnUser->update([
                'avatar_url' => Input::get('avatar_url'),
                'trophies'   => Input::get('trophies'),
                'bronze'     => Input::get('bronze'),
                'silver'     => Input::get('silver'),
                'gold'       => Input::get('gold'),
                'platinum'   => Input::get('platinum'),
                'level'      => Input::get('level'),
                'progress'   => Input::get('progress'),
            ]);
            return $this->respondUpdated('Player successfully created');
        }
        else {
            PsnUser::create([
                'username'   => Input::get('username'),
                'avatar_url' => Input::get('avatar_url'),
                'trophies'   => Input::get('trophies'),
                'bronze'     => Input::get('bronze'),
                'silver'     => Input::get('silver'),
                'gold'       => Input::get('gold'),
                'platinum'   => Input::get('platinum'),
                'level'      => Input::get('level'),
                'progress'   => Input::get('progress')
            ]);
            return $this->respondCreated('Player successfully created');
        }
    }

    /**
     * Display the specified resource.
     * GET /psn/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $psnUser = PsnUser::whereUsername($id)->first();

        if (!$psnUser) {
            //TODO Queue the user to be scrapped

            return $this->respondNotFound('Psn User does not exists');
        }

        return $this->respond([
            'data' => $this->userTransformer->transform($psnUser),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * GET /psn/{id}/edit
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * PUT /psn/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /psn/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}