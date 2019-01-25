@if ($paginator->hasPages())
    <div class="card-footer bg-grey-lightest p-8 border-t border-grey-lighter flex items-center justify-center">
        @if ($paginator->hasMorePages())
        
            <a href="{{ $paginator->nextPageUrl() }}" target="_self" class="btn btn-grey-secondary">mai multe rezultate</a>
        
        @else
            <span class="text-grey-dark">Sfârșit!</span>
        @endif
    </div>
@endif

