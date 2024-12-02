@php
    $countReplies = $post->replies()->whereHas('user', function ($query) {
        $query->whereNull('deleted_at');
    })->count();
@endphp

<button class="btn m-0 p-1 shadow-none"><a class="text-dark" href="{{ route('reply.index', $post->id) }}" data-toggle="tooltip" title="返信"><i class="far fa-comment"></i></a></button>
<span id="reply-count-{{ $post->id }}" class="badge badge-pill">{{ $countReplies }}</span>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
