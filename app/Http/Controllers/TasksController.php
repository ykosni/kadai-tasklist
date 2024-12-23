<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Task;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     * getでtasks/にアクセスされた場合の「一覧表示処理」
     */
    public function index()
    {
        //タスク一覧を取得
        $tasks = Task::all();
        
        //メッセージ一覧ビューでそれを表示
        //第一引数：表示したいViewを指定。tasks.indexはresources/views/tasks/index.blade.phpを意味する
        //第二引数：そのViewに渡したいデータの配列を指定。$tasks=Tasks:all();で$messageに入ったデータを渡す。
        
        return view('tasks.index', [
            'tasks' => $tasks,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     * getでtasks/createにアクセスされた場合の「新規登録画面表示処理」
     */
    public function create()
    {
        $task = new Task;
        
        
        //メッセージ作成ビューを表示
        return view('tasks.create', [
            'task' => $task,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     * postでtasks/にアクセスされた場合の「新規登録処理」
     */
    public function store(Request $request)
    {
        //タスクを作成
        $task = new Task;
        $task->content = $request->content;
        $task->save();
        
        //トップページへリダイレクトさせる
        return redirect('/');
    
    }

    /**
     * Display the specified resource.
     * getでtasks/(任意のid)/にアクセスされた場合の「取得表示処理」
     */
    public function show(string $id)
    {
        //idの値でタスクを検索して取得
        $task = Task::findOrFail($id);
        
        //タスク詳細ビューでそれを表示
        return view('tasks.show', [
            'task' => $task,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     * getでtsasks/(任意のid)/editにアクセスされた場合の「更新画面表示処理」
     */
    public function edit(string $id)
    {
        //idの値でタスクを検索して取得
        $task = Task::findOrFail($id);
        
        //タスク編集ビューでそれを表示
        return view('tasks.edit', [
            'task' => $task,
            ]);
    }

    /**
     * Update the specified resource in storage.
     * putまたはpatchでtasks/(任意のid)/にアクセスされた場合の「更新処理」
     */
    public function update(Request $request, string $id)
    {
        //idの値でタスクを検索して取得
        $task = Task::findOrFail($id);
        //タスクを更新
        $task->content = $request->content;
        $task->save();
        
        //トップページへのリダイレクト
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     * deleteでtasks/(任意のid)にアクセスされた場合の「削除処理」
     */
    public function destroy(string $id)
    {
        //idの値でタスクを検索して取得
        $task = Task::findOrFail($id);
        //タスクを削除
        $task->delete();
        
        //トップページへのリダイレクト
        return redirect('/');
    }
}
