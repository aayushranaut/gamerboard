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
        if (!Input::get('username') or
            !Input::get('trophies') or
            !Input::get('bronze') or
            !Input::get('silver') or
            !Input::get('gold') or
            !Input::get('platinum') or
            !Input::get('level') or
            !Input::get('api-key') or
            Input::get('api-key') != self::API_KEY
        ) {

            return $this->setStatusCode(422)
                ->respondWithError("Parameters failed validation");
        }

        $psnUser = PsnUser::whereUsername(Input::get('username'))->first();

        if ($psnUser) {
            $psnUser->trophies = Input::get('trophies');
            $psnUser->bronze   = Input::get('bronze');
            $psnUser->silver   = Input::get('silver');
            $psnUser->gold     = Input::get('gold');
            $psnUser->platinum = Input::get('platinum');
            $psnUser->level    = Input::get('level');
            $psnUser->save();
        }
        PsnUser::create();
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