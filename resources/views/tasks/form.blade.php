@if (Auth::id() == $user->id)
   
    <div class="prose ml-4">
        <h2 class="text-lg">タスク新規作成</h2>
    </div>
   
    <div class="mt-4">
        <form method="POST" action="{{ route('tasks.store') }}">
            @csrf
        
            <div class="form-control mt-4">
                <textarea rows="2" name="content" class="input input-bordered w-full"></textarea>
            </div>
        
            <button type="submit" class="btn btn-primary btn-block normal-case">Post</button>
        </form>
    </div>
@endif