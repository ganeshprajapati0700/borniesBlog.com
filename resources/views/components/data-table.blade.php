@props(['columns' => [], 'rows' => []])

<div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b border-slate-200 bg-gradient-to-r from-slate-50 to-slate-100">
                    @foreach($columns as $column)
                        <th class="px-4 md:px-6 py-4 text-left text-xs md:text-sm font-bold text-slate-700 uppercase tracking-wider">
                            {{ $column }}
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                {{ $slot }}
            </tbody>
        </table>
    </div>
</div>
