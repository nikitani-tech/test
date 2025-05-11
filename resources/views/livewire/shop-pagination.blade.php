<div class="d-flex justify-content-center mt-4">
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">Previous</span>
                </li>
            @else
                <li class="page-item">
                    <button class="page-link" wire:click="previousPage" wire:loading.attr="disabled">
                        Previous
                    </button>
                </li>
            @endif

            {{-- First 3 Pages --}}
            @for ($i = 1; $i <= min(3, $paginator->lastPage()); $i++)
                <li class="page-item {{ $i == $paginator->currentPage() ? 'active' : '' }}">
                    <button class="page-link" wire:click="gotoPage({{ $i }})">
                        {{ $i }}
                    </button>
                </li>
            @endfor

            {{-- Dots before middle section --}}
            @if ($paginator->currentPage() > 4)
                <li class="page-item disabled">
                    <span class="page-link">...</span>
                </li>
            @endif

            {{-- Middle pages --}}
            @for ($i = max(4, $paginator->currentPage() - 1); $i <= min($paginator->currentPage() + 1, $paginator->lastPage() - 2); $i++)
                <li class="page-item {{ $i == $paginator->currentPage() ? 'active' : '' }}">
                    <button class="page-link" wire:click="gotoPage({{ $i }})">
                        {{ $i }}
                    </button>
                </li>
            @endfor

            {{-- Dots after middle section --}}
            @if ($paginator->currentPage() < $paginator->lastPage() - 3)
                <li class="page-item disabled">
                    <span class="page-link">...</span>
                </li>
            @endif

            {{-- Last 2 pages --}}
            @for ($i = max($paginator->lastPage() - 1, 4); $i <= $paginator->lastPage(); $i++)
                <li class="page-item {{ $i == $paginator->currentPage() ? 'active' : '' }}">
                    <button class="page-link" wire:click="gotoPage({{ $i }})">
                        {{ $i }}
                    </button>
                </li>
            @endfor

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <button class="page-link" wire:click="nextPage" wire:loading.attr="disabled">
                        Next
                    </button>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">Next</span>
                </li>
            @endif
        </ul>
    </nav>
</div>
