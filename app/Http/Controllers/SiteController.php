<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Post;
use App\Feedback;
use App\Services\SendTelegramService;
class SiteController extends Controller
{
    public function home()
    {
        return view('home');
        // $shops = [
        //     ['name' => 'John Doe', 'type' => 'Stom'],
        //     ['name' => 'Buster Keaton', 'type' => 'Lor'],
        //     ['name' => 'Zafar', 'type' => 'Test'],
        //     ['name' => 'Nodir', 'type' => 'Test 2'],
        // ];
        // return view('home', compact('shops')); //['doctors' => $doctors] <=> compact('doctors')
    }

    public function shop()
    {
        return view('shop');
    }

    public function single()
    {
        return view('single');
    }

    public function checkout()
    {
        return view('checkout');
    }

    public function about()
    {
        return view('about');
    }

    public function blog()
    {
        // $posts = Post::orderBy('id', 'DESC')->paginate(3);
        $posts = Post::latest()->paginate(3);
        $links = $posts->links();

        $mosts = Post::orderBy('views', 'DESC')->limit(3)->get();

        return view('blog', compact('posts', 'links', 'mosts'));
    }

    public function blogs($slug)
    {
        $post = Post::slug($slug)->first();
        if (!$post)
            abort(404);

        $post->increment('views');

        $most_viewed = Post::orderBy('views', 'DESC')->limit(3)->get();

        return view('blogs', [
            'post' => $post,
            'most_posts' => $most_viewed
            ]);
    }

    // public function blogs()
    // {
    //     return view('blogs');
    // }

    public function card()
    {
        return view('card');
    }

    public function search(Request $request)
    {
        $key = $request->get('key');
        $key = '%'.trim($key).'%';
        $results = Post::where('title', 'LIKE', $key)
                   ->orWhere('short', 'LIKE', $key)
                   ->orWhere('content', 'LIKE', $key)
                   ->paginate(3);

      //  dd($results->toSql());

        $links = $results->links();

        return view('search', compact('results', 'links'));
    }


    public function contact()
    {
        return view('contact');
    }

    public function feedbackStore(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|min:3|max:100',
            'email'   => 'required|email|',
            'subject' => 'required|min:7|max:100',
            'message' => 'required|max:2048'
        ]);

        $message  = 'Ismi: '.$data['name'].PHP_EOL;
        $message .= 'Email: '.$data['email'].PHP_EOL;
        $message .= 'Subject: '.$data['subject'];

        Feedback::create([
            'name'    => $request->post('name'),
            'email'   => $request->post('email'),
            'subject' => $request->post('subject'),
            'message' => $request->post('message')
        ]);

        SendTelegramService::send($message);

        return redirect()
                ->route('contact')
                ->with('success', "Xabar uchun raxmat! Tez orada sizga javob qaytaramiz.");
    }
    public function switchLang($lang)
    {
        session()->put('lang', $lang);

        return redirect()->back();
    }
    public function test()
    {
        //$model = Post::findOrFail(2);

        //dd($model->category->name);
        // $model = Category::findOrFail(1);

        // dd($model->posts);
        $user = \App\User::find(1);
        dd($user->roles);
    }
}
