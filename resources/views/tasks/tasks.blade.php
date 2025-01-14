<div class="mt-4">
    @if (isset($tasks))
        <ul class="list-none">
            @foreach ($tasks as $task)
                <li class="flex items-start gap-x-2 mb-4">
                    <div>
                        <div>
                            {{-- ステータス --}}
                            <p class="mb-0">{!! nl2br(e($task->status)) !!}</p>
                        </div>
                        
                        <div>
                            {{-- 投稿内容 --}}
                            <p class="mb-0">{!! nl2br(e($task->content)) !!}</p>
                        </div>
                        
                        <div>
                            @if (Auth::id() == $task->user_id)
                                {{-- 投稿削除ボタンのフォーム --}}
                                <form method="POST" action="{{ route('tasks.destroy', $task->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-error btn-sm normal-case" 
                                        onclick="return confirm('Delete id = {{ $task->id }} ?')">Delete</button>
                                </form>
                            @endif
                        </div>
                        
                        
                        
                    </div>
                </li>
            @endforeach
        </ul>
        {{-- ページネーションのリンク --}}
        {{ $tasks->links() }}
    @endif
</div>