<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Task;

class TasksController extends Controller
{
    public function index()
    {
        $data = [];
        if (\Auth::check()) { // 認証済みの場合
            // 認証済みユーザーを取得
            $user = \Auth::user();
            // ユーザーの投稿の一覧を作成日時の降順で取得
            $tasks = $user->tasks()->orderBy('created_at', 'desc')->paginate(10);
            $data = [
                'user' => $user,
                'tasks' => $tasks,
                
            ];
            return view('tasks.index', $data);
        }
        
        // トップページを表示させる
        return view('tasks.index');

    }
    
    
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'content' => 'required|max:255',
        ]);
        
        if (\Auth::check()) { // 認証済みの場合
        
        // 認証済みユーザー（閲覧者）の投稿として作成（リクエストされた値をもとに作成）
        $request->user()->tasks()->create([
            'content' => $request->content,
             ]);
        }
        
        // トップページを表示させる
        return redirect('/');
    }
    
    
    
        public function destroy(string $id)
    {
        // idの値で投稿を検索して取得
        $task = Task::findOrFail($id);
        
        // 認証済みユーザー（閲覧者）がその投稿の所有者である場合は投稿を削除
        if (\Auth::id() === $task->user_id) {
            $task->delete();
            return back()
                ->with('success','Delete Successful');
        }

        // トップページを表示させる
        return redirect('/');
    
    }
    
        // getでtasks/id/editにアクセスされた場合の「更新画面表示処理」
    public function edit($id)
    {
        // idの値でメッセージを検索して取得
        $task = Task::findOrFail($id);
        
        // 認証済みユーザー（閲覧者）がその投稿の所有者である場合はメッセージ編集ビューでそれを表示
        if (\Auth::id() === $task->user_id) {
            return view('tasks.edit', [
            'task' => $task,
             ]);
        }
        // トップページを表示させる
        return redirect('/');
    }
    
    
        // putまたはpatchでmessages/idにアクセスされた場合の「更新処理」
    public function update(Request $request, $id)
    {
        // idの値でメッセージを検索して取得
        $task = Task::findOrFail($id);
        
         // 認証済みユーザー（閲覧者）がその投稿の所有者である場合はタスクを更新
        if (\Auth::id() === $task->user_id) {
            $task->content = $request->content;
            $task->status = $request->status;
            $task->save();
        }
        // トップページを表示させる
        return redirect('/');
    }
    
    
        // getでmessages/createにアクセスされた場合の「新規登録画面表示処理」
    public function create()
    {
        if (\Auth::check()) { // 認証済みの場合
        
        $task = new Task;
        
        //メッセージ作成ビューを表示
        return view('tasks.create', [
            'task' => $task,
        ]);
        }
        
        // トップページを表示させる
        return redirect('/');
    }
    
    
    
         // getでtasks/（任意のid）にアクセスされた場合の「取得表示処理」
    public function show(string $id)
    {
        // idの値でメッセージを検索して取得
        $task = Task::findOrFail($id);
        
         // 認証済みユーザー（閲覧者）がその投稿の所有者である場合はタスクを更新
        if (\Auth::id() === $task->user_id) {

        // メッセージ詳細ビューでそれを表示
        return view('tasks.show', [
            'task' => $task,
        ]);
        }
        // トップページを表示させる
        return redirect('/');
    }
        
    
    
    
}

