@extends('layouts.app')

@section('content')
    @if (Auth::check())
        <div class="prose ml-4">
             <h2 class="text-lg">タスク一覧</h2>
        </div>
    
        <table class="table table-zebra w-full my-4">
             @if (isset($tasks))
             <thead>
                    <tr>
                        <th>id</th>
                        <th>ステータス</th>
                        <th>内容</th>
                    </tr>
            </thead>
    
            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td>
                            {{-- タスクID --}}
                            <p class="mb-0">ID: {{ $task->id }}</p>
                        </td>
                            
                        <td>
                            <p class="mb-0">{!! nl2br(e($task->status)) !!}</p>
                        </td>
                        
                        <td>
                            {{-- 投稿内容 --}}
                            <p class="mb-0">{!! nl2br(e($task->content)) !!}</p>
                        </td>    
                        
                        <td  class="text-right">
                            @if (Auth::id() == $task->user_id)
                                <div class="flex justify-end">
                                     {{-- 編集リンク --}}
                                    <a href="{{ route('tasks.edit', ['task' => $task->id]) }}" class="btn btn-primary btn-sm normal-case mr-2">
                                        編集
                                    </a>
                                      {{-- 投稿削除ボタンのフォーム --}}
                                    <form method="POST" action="{{ route('tasks.destroy', $task->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-error btn-sm normal-case" 
                                            onclick="return confirm('Delete id = {{ $task->id }} ?')">削除</button>
                                    </form>
                                </div>
                            @endif
                        </td>
                        
                        
                        
                    </tr>
               @endforeach
            </tbody>
            @endif

        {{-- ページネーションのリンク --}}
        {{ $tasks->links() }}
        
    @else
    
        <div class="prose hero bg-base-200 mx-auto max-w-full rounded">
            <div class="hero-content text-center my-10">
                <div class="max-w-md mb-10">
                    <h2>Welcome to the Tasklist</h2>
                    {{-- ユーザー登録ページへのリンク --}}
                    <a class="btn btn-primary btn-lg normal-case" href="{{ route('register') }}">Sign up now!</a>
                </div>
            </div>
        </div>
        
    @endif
@endsection