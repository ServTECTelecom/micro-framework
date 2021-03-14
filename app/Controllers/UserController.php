<?php

namespace App\Controllers;

use Core\BaseController;
use App\Models\User;
use Core\Redirect;
use Core\Validator;
use Core\Authenticate;

class UserController extends BaseController
{
    use Authenticate;

    public function create()
    {
        $this->setPageTitle('New User');
        return $this->renderView('user/create', 'layout');
    }

    public function store($request)
    {
        $data = [
            'name' => $request->post->name,
            'email' => $request->post->email,
            'password' => $request->post->password,
            'password_confirmation' => $request->post->password_confirmation,
        ];

        if(Validator::make($data, User::rulesCreate())){
            return Redirect::route('/user/create');
        }

        $data['password'] = password_hash($request->post->password, PASSWORD_BCRYPT);

        try{
            $user = User::create($data);
            return Redirect::route('/', [
                'success' => ["Usuário $user->name criado com sucesso!"]
            ]);
        }catch(\Exception $e){
            return Redirect::route('/', [
                'errors' => [$e->getMessage()]
            ]);
        }
    }

    public function edit($id)
    {
        $this->setPageTitle('User edit');
        $this->view->user = User::find($id);
        return $this->renderView('user/edit', 'layout');
    }

    public function update($id, $request)
    {
        $data = [
            'name' => $request->post->name,
            'email' => $request->post->email,
            'password' => $request->post->password,
            'password_confirmation' => $request->post->password_confirmation,
        ];

        if(Validator::make($data, User::rulesUpdate($id))){
            return Redirect::route("/user/{$id}/edit");
        }

        $data['password'] = password_hash($request->post->password, PASSWORD_BCRYPT);

        try{
            $user = User::find($id)->update($data);
            return Redirect::route('/', [
                'success' => ["Usuário $user->name atualizado com sucesso!"]
            ]);
        }catch(\Exception $e){
            return Redirect::route('/', [
                'errors' => [$e->getMessage()]
            ]);
        }
    }

    public function delete($id)
    {
        $this->view->user = User::find($id)->delete();
    }

}