@props([
    'headers' => [],
    'paginator' => null,
    'perPage' => true,
    'perPageOptions' => [10, 25, 50, 100],
    'info' => true,
    'dropDirection' => 'up',
    'alignLast' => 'center',
    'fitLast' => true,
])



<div class="w-full overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
    <div class="overflow-x-auto">
        <table {{ $attributes->merge(['class' => 'w-full text-left text-sm']) }}>
            @if(count($headers))
                <thead class="bg-gray-50 dark:bg-gray-900/40">
                    <tr>
                        @foreach($headers as $header)
                            @php
                                $isLast = $loop->last;
                                $alignClass = $isLast && $alignLast === 'right'
                                    ? 'text-right'
                                    : ($isLast && $alignLast === 'center' ? 'text-center' : 'text-left');

                                $fitClass = ($isLast && $fitLast) ? 'w-px whitespace-nowrap' : '';
                                $padding = ($isLast && $fitLast) ? 'pl-2 pr-3 py-3.5' : 'px-5 py-3.5';
                            @endphp
                            <th class="{{ $padding }} font-medium text-gray-500 dark:text-gray-400 {{ $alignClass }} {{ $fitClass }}">
                                {{ $header }}
                            </th>
                        @endforeach
                    </tr>
                </thead>
            @endif

            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                {{ $slot }}
            </tbody>
        </table>
    </div>

    @if($paginator && $paginator->hasPages())
        <x-ui.table.table-paginator
            :paginator="$paginator"
            :per-page="$perPage"
            :per-page-options="$perPageOptions"
            :info="$info"
            :drop-direction="$dropDirection"
        />
    @endif
</div>