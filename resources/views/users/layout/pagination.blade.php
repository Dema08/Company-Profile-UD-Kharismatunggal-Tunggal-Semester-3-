@if ($paginator->hasPages())
<div class="pagination">

  {{-- Previous Page Link --}}
  @if ($paginator->onFirstPage())
    <a href="#" class="disabled" aria-disabled="true">&laquo;</a>
  @else
    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&laquo;</a>
  @endif

  {{-- Pagination Elements --}}
  @foreach ($elements as $element)
    @if (is_array($element))
      @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
          <a href="#" class="active">{{ $page }}</a>
        @else
          <a href="{{ $url }}">{{ $page }}</a>
        @endif
      @endforeach
    @endif
  @endforeach

  {{-- Next Page Link --}}
  @if ($paginator->hasMorePages())
    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&raquo;</a>
  @else
    <a href="#" class="disabled" aria-disabled="true">&raquo;</a>
  @endif
</div>
@endif
