<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // if (Auth::check()) {
        //     // Пользователь вошёл в систему...
        //     return view('home');
        // }
        return view('home');
    }

    public function showRequest(Request $request)
    {
        $value = $request->session();
        dump($value);

        $value = $request->session()->get('key');
        dump($value);

        $value = $request->session()->get('key-default', 'default value key');
        dump($value);

        $value = $request->session()->get(
            'key-closure',
            function () {
                return 'default value key from closure';
            }
        );

        dump($value);

        // Получить кусок данных из сессии...
        $value = session('session-key');
        dump($value);

        // Указать значение по умолчанию...
        $value = session('session-key-default', 'session key default');
        dump($value);

        // Сохранить кусок данных в сессию...
        session(['my-key' => 'it is in session now']);

        dump(session('my-key'));

        $value = $request->session()->all();
        dump($value);

        if ($request->session()->has('users')) {
            dump($request->session('users'));
        }

        // Через экземпляр запроса...
        $request->session()->put('request-key', 'request value');

        // Через глобальный вспомогательный метод...
        session(['session-key' => 'session value']);

        $value = $request->session()->all();
        dump($value);
        // $request->session()->flash('status', 'Задание выполнено успешно!');
        // dump(session('status'));

        // dump($request->flash('message'));

        session(['username' => \Auth::user()->name]);
        session(['email' => 'test@my.com']);
        $request->flashOnly(['username', 'email']);

        // return redirect()->back()->withSuccess('Success Задание выполнено успешно!');

        session()->flash('message', 'Nice Job Dude!');
        session()->flash('type', 'success');
        return redirect('home');
    }
    
}
