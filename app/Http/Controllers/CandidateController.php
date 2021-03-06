<?php

namespace App\Http\Controllers;

use App\UserRepository;
use Illuminate\Http\Request;
use Model\Candidate\CandidateRepository;


class CandidateController extends Controller
{
    /**
     * @var CandidateRepository
     */
    protected $candidateRepo;

    public  function  __construct(
        CandidateRepository $candidateRepo
    )
    {
        $this->candidateRepo = $candidateRepo;
    }


    public function index()
    {
        return view('user.index');
    }

    public function new()
    {
        return view('candidate.signup');
    }

    public function save(Request $request, UserRepository $userRepository){

        try{

            $data = $request->except('_token');
            $user = $userRepository->save([
                'email' => $data['email'],
                'password' => $data['password'],
                'corporate' => false
            ]);
    
            $data['user_id'] = $user->user_id;
            $data['active']  = true;
            unset($data['password']);

            $this->candidateRepo->save($data);

        } catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }

        toastr()->success('Seu cadastro foi criado com sucesso','Sucesso!');
        return redirect()->route('candidate.sign_up');

    }
}
