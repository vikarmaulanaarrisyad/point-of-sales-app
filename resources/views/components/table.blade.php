<table {{ $attributes->merge(['class' => 'table table-bordered table-striped dataTable dtr-inline mt-3']) }}>
    @isset($thead)
    <thead class="">
        {{ $thead }}
    </thead>
    @endisset

    <tbody>
        {{ $slot }}
    </tbody>

    @isset($tfoot)
    <tfoot>
        {{ $tfoot }}
    </tfoot>
    @endisset
</table>
